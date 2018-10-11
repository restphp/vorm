<?php

namespace VORM\Database;

class Collection
{
    private static $databases = [];

    /**
     * @param Item $databaseItem
     * @return boolean
     * @throws \Exception
     */
    public static function add(Item $databaseItem): bool
    {
        if(null === $databaseItem->getName()){
            if(self::count() <= 0 || false === self::has("default")){
                $databaseItem->setName("default");
            }else{
                throw new \Exception("Database must have name.");
            }
        }

        self::$databases[$databaseItem->getName()] = $databaseItem;
        return true;
    }

    /**
     * @return array
     */
    public function list(): array
    {
        return self::$databases;
    }

    /**
     * @return array
     */
    public function listNames(): array
    {
        return array_keys(self::$databases);
    }

    /**
     * @param string $databaseName
     * @return bool
     */
    public function has(string $databaseName): bool
    {
        return isset(self::$databases[$databaseName]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count(self::$databases);
    }

    /**
     * @param string $databaseName
     * @return Item
     * @throws \Exception
     */
    public function get(string $databaseName): Item
    {
        if (!self::has($databaseName)) {
            throw new \Exception('Instance database "' . $databaseName . '" not exists.');
        }

        return self::$databases[$databaseName];
    }

    /**
     * @param string $databaseName
     * @return Collection
     * @throws \Exception
     */
    public function remove(string $databaseName): self
    {
        if (!self::has($databaseName)) {
            throw new \Exception('Instance database "' . $databaseName . '" not exists.');
        }

        unset(self::$databases[$databaseName]);
        return $this;
    }

}