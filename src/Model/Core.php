<?php

namespace VORM\Model;

use VORM\Inflector;
use VORM\Exception\ColumnNotFoundException;
use VORM\Repository\Find;

class Core extends Find
{
    private $_data = [];
    private $_table = [];

    public function __construct()
    {
        $this->_table = new Table(get_class($this));
    }

    public function table()
    {
        return $this->_table;
    }

    public function __call($name, $arguments)
    {
        $prefix = substr($name,0,3);

        if("get" === $prefix || "set" === $prefix){
            $field = Inflector::toUnderscore(substr($name,3));

            $this->table()->fieldExists($field);

            if("get" === $prefix){
                if(!isset($this->_data[$field])){
                    throw new ColumnNotFoundException('Column "'.$field.'" not found."', 4000);
                }
            }
            var_dump($field);
        }
        // TODO: Implement __call() method.
    }


}