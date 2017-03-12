<?php

namespace FloFitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class RecuringProduct extends Product
{
    /**
     * @var string
     *
     * @ORM\Column(name="plan_id", type="string", length=200)
     */
    protected $planId;

    /**
     * @return mixed
     */
    public function getPlanId()
    {
        return $this->planId;
    }

    /**
     * @param mixed $planId
     * @return $this
     */
    public function setPlanId($planId)
    {
        $this->planId = $planId;

        return $this;
    }
}

