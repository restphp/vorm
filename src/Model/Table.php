<?php


namespace VORM\Model;

use VORM\Inflector;


class Table
{
    private $name = null;

    public function __construct($className)
    {
        $namespaces = explode(DIRECTORY_SEPARATOR, $className);
        $modelName = Inflector::toUnderscore(end($namespaces));
        $this->setName($modelName);
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

}