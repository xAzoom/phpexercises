<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 24.05.2018
 * Time: 22:07
 */

namespace Storage;


use Ramsey\Uuid\Uuid;

class FileDB implements IDataBase
{
    /** @var FileDB */
    private $DBEngine;

    public function __construct()
    {
        $this->DBEngine = new FileDBEngine();
    }

    public function SelectById(string $tableName, string $id): array
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

    public function Insert(string $tableName, string $id, array $data): void
    {
        $table = $this->DBEngine->getAllContent($tableName);

        $decode = json_decode($table, true);
        $decode[$id] = $data;

        $this->DBEngine->InsertAllContent($tableName, json_encode($decode, JSON_PRETTY_PRINT));
    }

    public function DeleteById(string $tableName, string $id): bool
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

    public function Update(string $tableName, string $id, array $product): bool
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