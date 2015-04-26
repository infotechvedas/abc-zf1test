<?php

class Application_Model_Category
{
	protected $_desc;
    protected $_createddt;
	protected $_updateddt;
    protected $_name;
    protected $_id;
 
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function __set($name, $value)
    {
        $method = 'set' . $name; 
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid category property' . $name);
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name; 
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid category property ' . $name);
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
 
    public function setDesc($text)
    {
        $this->_desc = (string) $text;
        return $this;
    }
 
    public function getDesc()
    {
        return $this->_desc;
    }
 
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }
 
    public function getName()
    {
        return $this->_name;
    }
 
    public function setCreateddt($ts)
    {
        $this->_createddt = $ts;
        return $this;
    }
 
    public function getCreateddt()
    {
        return $this->_createddt;
    }
 
    public function setUpdateddt($ts)
    {
        $this->_updateddt = $ts;
        return $this;
    }
 
    public function getUpdateddt()
    {
        return $this->_updateddt;
    }
	
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}

