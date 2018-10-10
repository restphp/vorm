<?php


namespace VORM\Model;

use VORM\Inflector;


class Table
{
    private $name = null;

    public function __construct(string $className)
    {
        $namespaces = explode(DIRECTORY_SEPARATOR, $className);
        $modelName = Inflector::toUnderscore(end($namespaces));
        $this->setName($modelName);
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function fieldExists(string $fieldName): bool
    {
        return true;
    }
}