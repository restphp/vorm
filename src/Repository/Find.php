<?php

namespace VORM\Repository;


use VORM\Builder\Query;
use VORM\Database\Collection as DatabaseCollection;

class Find
{

    private $databaseName = null;

    public static function find($params = null)
    {
        return "OK";
    }

    public static function builder(): Query
    {
        return new Query();
    }


    /**
     * @param string $databaseName
     * @return Find
     * @throws \Exception
     */
    public function useDatabase(string $databaseName): self
    {
        if (!DatabaseCollection::has($databaseName)) {
            throw new \Exception('Instance database "' . $databaseName . '" not exists.');
        }
        $this->databaseName = $databaseName;
        return $this;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getDatabase(): string
    {
        return $this->databaseName;
    }

}