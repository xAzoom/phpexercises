<?php

use Ramsey\Uuid\Uuid;

/**
 * Created by PhpStorm.
 * User: moren
 * Date: 24.05.2018
 * Time: 21:09
 */

class Book
{
    /** @var Uuid */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $author;
    //   /** @var bool */
//    private $accessibility;
//    /** @var int */
//    private $dateBorrowed;
//    /** @var int */
//    private $dateOfReturn;

    public function __construct(Uuid $id, string $title, string $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->accessibility = true;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

}