<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 16.03.2018
 * Time: 20:20
 */

interface IDB
{
    public function SelectById(string $tableName, int $id): array;
    public function SelectAll(string $tableName): string;
    public function Insert(string $tableName, array $product): void;
    public function DeleteById(string $tableName, int $id): bool;
    public function Update(string $tableName, int $id, array $product) : bool;
}