<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 24.09.15
 * Time: 13:58
 */

namespace FloFitBundle\Entity;


class RequestParameters
{
    public $userId;
    public $timestamp;
    public $customArray;
    public $routeName;

    /**
     * RequestParameters constructor.
     *
     * @param           $userId
     * @param \DateTime $timestamp
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->timestamp = new \DateTime();

        $this->customArray = array();
    }
}