<?php

namespace VORM;

/**
 * Class Builder
 * @package VORM
 */
class Builder
{
    const ALLOW_SYNTAX_COLUMN = "column";
    const ALLOW_SYNTAX_WHERE = "where";

    private $stack = [];

    /**
     * @param $object
     * @return Builder
     * @throws \Exception
     */
    public function add($object): self
    {
        $clause = $this->getClause($object);

        if (null === $clause) {
            throw new \Exception("Invalid builder component.");
        }

        $this->stack[$clause][] = $object;
        return $this;
    }

    /**
     * @param array $objects
     * @return Builder
     * @throws \Exception
     */
    public function set(array $objects): self
    {
        if (empty($objects)) {
            throw new \Exception("Builder component can not be empty.");
        }

        foreach ($objects as $object) {
            $this->add($object);
        }

        return $this;
    }

    private function getClause($syntax): ?string
    {
        if ($syntax instanceof Builder\Column) {
            return self::ALLOW_SYNTAX_COLUMN;
        } elseif ($syntax instanceof Builder\Where) {
            return self::ALLOW_SYNTAX_WHERE;
        }

        return null;
    }

    public function getSql()
    {
        $sql = "SELECT ";

        $sql .= implode(",", $this->stack[self::ALLOW_SYNTAX_COLUMN]);

        $sql .= " WHERE ";
        $sql .= "(".implode(") AND (", $this->stack[self::ALLOW_SYNTAX_WHERE]).")";

        return $sql;
    }

}
