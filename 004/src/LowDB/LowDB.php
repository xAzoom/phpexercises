<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 16.03.2018
 * Time: 20:19
 */

namespace LowDB;

use IDB;

class LowDB implements IDB
{
    private $DBEngine;

    /**
     * LowDB constructor.
     */
    public function __construct()
    {
        $this->DBEngine = new DBEngine();
    }

    public function SelectById(string $tableName, int $id): array
    {
        $data = $this->DBEngine->getAllContent($tableName);
        $decode = json_decode($data, true);

        if (array_key_exists($id, $decode)) {
            return $decode[$id];
        }
        return array();
    }

    public function SelectAll(string $tableName): string
    {
        return $this->DBEngine->getAllContent($tableName);
    }

    public function Insert(string $tableName, array $product): void
    {
        $randomID = random_int(100000, 10000000);
        $data = $this->DBEngine->getAllContent($tableName);

        $decode = json_decode($data, true);

        while (array_key_exists($randomID, $decode)) {
            $randomID = random_int(100000, 10000000);
        }

        $decode[$randomID] = $product;

        $this->DBEngine->InsertAllContent($tableName, json_encode($decode, JSON_PRETTY_PRINT));
    }

    public function DeleteById(string $tableName, int $id): bool
    {
        $data = $this->DBEngine->getAllContent($tableName);
        $decode = json_decode($data, true);

        if (array_key_exists($id, $decode)) {
            unset($decode[$id]);
            $this->DBEngine->InsertAllContent($tableName, json_encode($decode, JSON_PRETTY_PRINT));
            return true;
        }
        return false;
    }

    public function Update(string $tableName, int $id, array $product): bool
    {
        $data = $this->DBEngine->getAllContent($tableName);
        $decode = json_decode($data, true);

        if (array_key_exists($id, $decode)) {
            $decode[$id] = $product;
            $this->DBEngine->InsertAllContent($tableName, json_encode($decode, JSON_PRETTY_PRINT));
            return true;
        }
        return false;
    }
}