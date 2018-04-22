<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 16.03.2018
 * Time: 20:12
 */

interface IDBEngine
{
    public function getAllContent(string $tableName) : string;
    public function InsertAllContent(string $tableName, $data) : bool;
}