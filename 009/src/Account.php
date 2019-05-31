<?php

use Ramsey\Uuid\Uuid;

/**
 * Created by PhpStorm.
 * User: moren
 * Date: 24.05.2018
 * Time: 21:03
 */

class Account
{
    /** @var Uuid */
    private $id;
    /** @var string */
    private $passowrd;
//    /** @var int */
//    private $amountOfBorrowedBooks;
//
//    private $penalty;


    public function __construct(Uuid $id, string $passowrd)
    {
        $this->id = $id;
        $this->passowrd = $passowrd;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPassowrd(): string
    {
        return $this->passowrd;
    }


}