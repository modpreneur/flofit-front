<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 23.09.15
 * Time: 15:21
 */

namespace FloFitBundle\Entity;


class OrderObject
{

    public $billingPlanId;
    public $amount;

    /**
     * OrderObject constructor.
     *
     * @param $orderId
     */
    public function __construct($billingPlanId, $amount)
    {
        $this->productId = $billingPlanId;
        $this->amount = $amount;
    }

}
