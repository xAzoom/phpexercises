<?php


/**
 * Created by PhpStorm.
 * User: moren
 * Date: 26.04.2018
 * Time: 20:09
 */

abstract class Command
{
    /** @var DataTime */
    private $created;

    /**
     * Command constructor.
     * @param DataTime $created
     */
    public function __construct(DataTime $created = null)
    {
        $this->created = $created;
    }


}