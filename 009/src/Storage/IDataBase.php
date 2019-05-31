<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 16.03.2018
 * Time: 20:20
 */

namespace Storage;

use Ramsey\Uuid\Uuid;

interface IDataBase
{
    public function SelectById(string $tableName, string $id): array;
    public function SelectAll(string $tableName): string;
    public function Insert(string $tableName, string $id, array $product): void;
    public function DeleteById(string $tableName, string $id): bool;
    public function Update(string $tableName, string $id, array $product) : bool;
}