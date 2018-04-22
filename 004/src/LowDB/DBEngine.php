<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 16.03.2018
 * Time: 20:04
 */

namespace LowDB;

use IDBEngine;
use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;

class DBEngine implements IDBEngine
{
    private $adapter;
    private $filesystem;
    /**
     * DBEngine constructor.
     */
    public function __construct()
    {
        $this->adapter = new LocalAdapter(__DIR__."\..\..\..\DB");
        $this->filesystem = new Filesystem($this->adapter);
    }

    public function getAllContent(string $tableName) : string {
        $read = $this->filesystem->get('products');
        return $read->getContent();
    }

    public function InsertAllContent(string $tableName, $data): bool
    {
        $this->filesystem->write($tableName, $data, true);
        return true;
    }


}