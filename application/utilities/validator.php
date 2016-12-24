<?php

class Validator 
{
	private $error_messages = [
        'email' => 'Neispravna e-mail adresa.',
        'required' => 'Polje $REPLACE$ ne smije biti prazno.',
        'min' => 'Polje $REPLACE$ mora imati određeni minimalan broj karaktera.',
        'max' => 'Polje $REPLACE$ mora imati određeni maksimalan broj karaktera.',
        'identical' => 'Polja $REPLACE$ se ne poklapaju.'
    ];


    private $input;    
    private $rules;
    public $errors = [];

	public function __construct(array $input, array $rules)
    {
        $this->input = $input;
        $this->rules = $rules;
    }

    public function validate()
    {
        $valid = true;

        foreach ($this->rules as $field => $rules) 
        {
            $arrRules = explode('|', $rules);
            foreach ($arrRules as $strRule) 
            {
            	$ruleParams = explode(':', $strRule);
            	$ruleName = $ruleParams[0];
                if (!$this->validateField($field, $ruleName, $ruleParams)) 
                {
                    $valid = false;
                    $this->errors[$field] = str_replace('$REPLACE$', "'" . $field . "'", $this->error_messages[$ruleName]);
                    break;
                }
            }
        }

        return $valid;
    }

    private function input($fieldName)
    {
    	if(!array_key_exists($fieldName, $this->input))
    		return '';

    	return $this->input[$fieldName];
    }

    private function validateField($fieldName, $ruleName, $allParams)
    {
        $field = $this->input($fieldName);

        switch ($ruleName) 
        {
            case 'email':
                return $this->email($field);
                break;
            case 'required':
                return $this->required($field);
                break;
            case 'min':
            	return $this->min($field, (int)$allParams[1]);
            	break;
        	case 'max':
            	return $this->max($field, (int)$allParams[1]);
        		break;
    		case 'identical':
            	return $this->identical($field, $allParams[1]);
        		break;
        }
    }

    private function email($field)
    {
        return filter_var($field, FILTER_VALIDATE_EMAIL);
    }

    private function required($field)
    {
        return $field !== '';
    }

    private function min($field, $n)
    {
    	if(strlen($field) < $n)
    		return false;

    	return true;
    }

    private function max($field, $n)
    {
    	return !($this->min($field, $n));
    }

    private function identical($field, $field2)
    {
    	return $field === $this->input($field2);
    }
}

?>