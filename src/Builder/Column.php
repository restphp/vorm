<?php


namespace VORM\Builder;


class Column implements Maps\ColumnInterface
{
    private $columnName = null;
    private $alias = null;

    public function __construct($columnName)
    {
        $this->columnName = $columnName;
    }

    /**
     * @return null|string
     */
    public function getColumnName(): ?string
    {
        return $this->columnName;
    }

    /**
     * @param string $columnName
     * @return Column
     */
    public function setColumnName(string $columnName): self
    {
        $this->columnName = $columnName;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAlias(): bool
    {
        return !empty($this->alias);
    }

    /**
     * @return null|string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     * @return Column
     */
    public function setAlias(string $alias): self
    {
        $this->alias = $alias;
        return $this;
    }


    public function __toString(): ?string
    {
        $column = $this->getColumnName();

        if ($this->hasAlias()) {
            $column .= ' AS ' . $this->getAlias();
        }

        return $column;
    }


}