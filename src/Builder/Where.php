<?php


namespace VORM\Builder;

/**
 * Class Where
 * @package VORM\Builder
 */
class Where
{
    private $synax = "";
    private $params = [];
    private $ors = [];

    public function __construct($synax)
    {
        $this->synax = $synax;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return Where
     */
    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param string $name
     * @param $value
     * @return Where
     */
    public function addParam(string $name, $value): self
    {
        $this->params[$name] = $value;
        return $this;
    }

    public function addOr(Where $where)
    {
        $this->ors[] = $where;
    }


    public function __toString(): ?string
    {
        $sql = $this->synax;

        if (!empty($this->params)) {
            foreach ($this->params as $paramName => $paramValue) {
                $sql = str_replace($paramName, $paramValue, $sql);
            }
        }

        if (!empty($this->ors)) {
            $sql .= " OR ";
            $sql .= implode(" OR ", $this->ors);
        }

        return $sql;
    }


}