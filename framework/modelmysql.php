<?php

require_once(ROOT_DIR . 'framework/db.php');

abstract class ModelMySQL
{
	protected $id;
	protected static $table;
	protected $attributes = [];
    protected $db;

	public function __construct($attributes = [])
	{
		global $config;
		$this->attributes = $attributes;
        foreach($attributes as $k => $v)
            $this->$k = $v;

        $this->db = DB::get();
	}    

	public function __set($key, $val)
    {
        $this->attributes[$key] = $val;
    }

    public function __get($key)
    {
        if ($key == 'id')
            return $this->id;
        elseif(!array_key_exists($key, $this->attributes))
            return null;

        return $this->attributes[$key];
    }

    public function save()
    {
        if ($this->id) 
        {
            // radimo update
            $query = "UPDATE " . static::$table . " SET ";
            $params = [];
            foreach ($this->attributes as $key => $val) 
            {
                if($key != 'id')
                {
                    $query .= $key . " = ?, ";
                    $params[] = $val;
                }
            }
            $query = substr($query, 0, strlen($query) - 2); // brise zarez i razmak sa kraja
            $query .= ' WHERE id = ?';
            $params[] = $this->id;
            $statement = $this->db->prepare($query);
            $statement->execute($params);
        } 
        else 
        {
            $params = [];
            $query = "INSERT INTO " . static::$table . "(";
            foreach ($this->attributes as $key => $val) 
            {
                if($key != 'id')
                {
                    $query .= $key . ", ";
                }
            }
            $query = substr($query, 0, strlen($query) - 2); // brise zarez i razmak sa kraja
            $query .= ") VALUES (";
            foreach ($this->attributes as $key => $val) 
            {
                if($key != 'id')
                {
                    $query .= "?, ";
                    $params[] = $val;
                }
            }
            $query = substr($query, 0, strlen($query) - 2); // brise zarez i razmak sa kraja
            $query .= ")";
            $statement = $this->db->prepare($query);
            $statement->execute($params);
        }

    }

    public function delete()
    {
        if ($this->id) 
        {
            $query = "DELETE FROM " . static::$table . " WHERE id = ?";
            $statement = $this->db->prepare($query);
            $statement->execute(array($this->id));
        } 

    }

    public function find($conditions, $condition = 'and', $limit = false)
    {
        $query = "SELECT * FROM " . static::$table;
        if(count($conditions) > 0 )
            $query .= " WHERE ";
        $params = "";
        $prepared = [];
        foreach($conditions as $k => $v)
        {
            if(!is_array($v))
            {                
                $params .= $k . ' = ? ' . $condition . ' ';
                $prepared[] = $v;
            }
            else 
            {
                if($condition == 'and_or')
                {                    
                    $params .= "(";
                    foreach($v as $podvalue)
                    {
                        $params .= $k . ' = ? OR ';
                        $prepared[] = $podvalue;
                    }
                    $params = substr($params, 0, strlen($params) - 3);
                    $params .= ") AND ";
                }
                else if($condition == 'or_and')
                {
                    $params .= "(";
                    foreach($v as $podvalue)
                    {
                        $params .= $k . ' = ? AND ';
                        $prepared[] = $podvalue;
                    }
                    $params = substr($params, 0, strlen($params) - 4);
                    $params .= ") OR ";
                }
                else if($condition == 'like_or')
                {
                    $params .= "(";
                    foreach($v as $podvalue)
                    {
                        $params .= $k . ' LIKE ? OR ';
                        $prepared[] = '%' . $podvalue . '%';
                    }
                    $params = substr($params, 0, strlen($params) - 3);
                    $params .= ") OR ";
                }
                else if($condition == 'like_and')
                {
                    $params .= "(";
                    foreach($v as $podvalue)
                    {
                        $params .= $k . ' LIKE ? OR ';
                        $prepared[] = '%' . $podvalue . '%';
                    }
                    $params = substr($params, 0, strlen($params) - 3);
                    $params .= ") AND ";
                }
            }
        }
        //$params .= '1 = 1'; // da ne brisem zadnji AND/OR ili sta vec xD
        $params = substr($params, 0, strlen($params) - 4);
        $query = $query . $params;  
        if($limit !== false)
        {
            $query .= " LIMIT $limit";     
        }
        $statement = $this->db->prepare($query);
        $statement->execute($prepared);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $results = [];
        foreach($rows as $row) 
        {
            $results[] = static::createModelFromArray($row);
        }

        return $results;

    }

    public function first($conditions, $condition = 'and')
    {
        $results = static::find($conditions, $condition);

        return (empty($results) ? null : $results[0]);
    }

    public function getById($id)
    {
        return $this->createModelFromArray(static::first(array('id' => $id)));
    }

    public function all()
    {
        return $this->find(array());
    }

    public function toArray()
    {
        return $this->attributes;
    }

    protected static function createModelFromArray($arr)
    {
        $attrs = [];
        foreach ($arr as $k => $v)
            $attrs[$k] = $v;

        $model = new static($attrs);

        return $model;
    }

}

?>
