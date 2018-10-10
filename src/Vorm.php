<?php

namespace VORM;

class Vorm
{

    public function __construct()
    {
        spl_autoload_register([$this, 'loader']);
    }

    public function loader($className)
    {
        if (!class_exists($className)) {
            $namespaces = explode(DIRECTORY_SEPARATOR, $className);
            if (mb_strtolower($namespaces[0]) === "vorm") {
                $class = end($namespaces);
                eval('namespace VORM; class ' . $class . ' extends \VORM\Model\Core {}');
            }
        }
    }


}