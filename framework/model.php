<?php

abstract class Model 
{
	protected $id;
	protected static $table;
	protected $attributes = [];

	public function __construct($attributes = [])
	{
		global $config;
		$this->attributes = $attributes;
	}    

	public function __set($key, $val)
    {
        $this->attributes[$key] = htmlspecialchars($val);
    }

    public function __get($key)
    {
        if ($key == 'id')
            return $this->id;
        elseif(!array_key_exists($key, $this->attributes))
            return null;

        return htmlspecialchars_decode($this->attributes[$key]);
    }

    protected static function xml()
    {
    	static $xml;

    	if(!$xml)
    		$xml = simplexml_load_file(static::tablePath());

        return $xml;
    }

    public function save()
    {
        $xml = static::xml();

        if ($this->id) 
        {
            $cvor = static::findNodes(array('id' => $this->id))[0];
            foreach ($this->attributes as $key => $val) 
                $cvor->$key = $val;
        } 
        else 
        {
            $this->id = $this->nextID();
            $cvor = $xml->addChild(strtolower(get_class($this)));
            $cvor->addChild('id', $this->id);
            foreach ($this->attributes as $key => $val) {
                $cvor->addChild($key, $val);
            }
        }

        $this->updateTable();
    }

    public static function find($conditions, $condition = 'and')
    {
        $results = [];
        $nodes = '';
        if($condition == 'and')
            $nodes = static::findNodes($conditions);
        else if($condition == 'or')
            $nodes = static::findNodesWithOrConditions($conditions);

        foreach ($nodes as $node) {
            $results[] = static::createModelFromXMLNode($node);
        }
        return $results;
    }

    public static function first($conditions)
    {
        $results = '';
        if($condition == 'and')
            $results = static::findNodes($conditions);
        else if($condition == 'or')
            $results = static::findNodesWithOrConditions($conditions);

        return (empty($results) ? null : $results[0]);
    }

    public static function all()
    {
        return static::find(array());
    }

    protected function findNodes($conditions)
    {
        $xml = static::xml();
        $results = [];
        foreach ($xml->children() as $child) 
        {            
            $match = true;

            foreach ($conditions as $atribut => $ocekivano)
            {
                if ($child->$atribut != $ocekivano)
                {
                    $match = false;
                    break;
                }
            }

            if($match)
                $results[] = $child;
        }
        return $results;
    }

    protected function findNodesWithOrConditions($conditions)
    {
        $xml = static::xml();
        $results = [];
        foreach ($xml->children() as $child) 
        {            
            $match = false;

            foreach ($conditions as $atribut => $ocekivano)
            {
                if(is_array($ocekivano))
                {
                    foreach($ocekivano as $jednoOdOcekivanih)
                    {
                        if ($child->$atribut == $jednoOdOcekivanih)
                        {
                            $match = true;
                            break 2;
                        }
                    }
                }
                else 
                {
                    if ($child->$atribut == $ocekivano)
                    {
                        $match = true;
                        break;
                    }
                }
            }

            if($match)
                $results[] = $child;
        }
        return $results;
    }

    protected static function createModelFromXMLNode(SimpleXMLElement $node)
    {
        $attrs = [];
        foreach ($node->children() as $child)
            if (($name = $child->getName()) != 'id')
                $attrs[$name] = (string)$child;

        $model = new static($attrs);
        $model->id = (int)$node->id;

        return $model;
    }

    // definitivno generise unikatan ID
    protected function nextID()
    {
        $xml = static::xml();
        $noviID = 0;
        foreach($xml->children() as $model)
        {
            $nodeID = (int)$model->id;
            if($nodeID > $noviID)
                $noviID = $nodeID;
        }
        
        return ++$noviID;
    }

    protected function tablePath()
    {
    	return APP_DIR . 'persistence/' . static::$table . '.xml';
    }

    protected function updateTable()
    {
        // SimpleXML po defaultu ne izbacuje formatiran output.
        // Iako ovo nije baš fino niti efikasno, koristicemo
        // DOMDocument da imamo 'prettified' output XML-a
        $dom = new DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML(static::xml()->asXML());

        file_put_contents(static::tablePath(), $dom->saveXML());
    }
}

?>
