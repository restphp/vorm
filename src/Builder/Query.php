<?php
/**
 * Created by PhpStorm.
 * User: mkowalczyk
 * Date: 11.10.18
 * Time: 12:59
 */

namespace VORM\Builder;


use VORM\Inflector;

class Query
{
    const ALLOW_SYNTAX = [
        "column"
    ];

    private $stack = [];

    /**
     * @param $object
     * @return Query
     * @throws \Exception
     */
    public function add($object):self
    {
        $clause = $this->getAllowSyntax($object);
        if (null === $clause) {
            throw new \Exception("Invalid builder component.");
        }

        $this->stack[$clause][] = $object;
        return $this;
    }

    /**
     * @param array $objects
     * @return Query
     * @throws \Exception
     */
    public function set(array $objects):self
    {
        if(empty($objects)){
            throw new \Exception("Builder component can not be empty.");
        }

        foreach ($objects as $object){
            $this->add($object);
        }

        return $this;
    }

    private function getAllowSyntax($syntax): ?string
    {
        $implements = class_implements($syntax);
        if (!empty($implements)) {
            foreach ($implements as $implement) {
                $clause = Inflector::getClass($implement);
                $clause = strtolower(str_replace("Interface", "", $clause));

                if (in_array($clause, self::ALLOW_SYNTAX)) {
                    return $clause;
                }
            }
        }
        return null;
    }

}