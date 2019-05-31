<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 30.05.2018
 * Time: 21:21
 */

namespace Infrastructure;

interface ITransactionFinder
{
    public function findAll(int $limit = 10, int $offset = 0);
}