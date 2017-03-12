<?php

namespace FloFitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NormalProduct
 *
 * @ORM\Table()
 * @ORM\Entity()
 *
 */
class NormalProduct extends Product
{
    /**
     * @var string
     *
     * @ORM\Column(name="sku_id", type="string", length=200)
     */
    protected $skuId;

    /**
     * @return mixed
     */
    public function getSkuId()
    {
        return $this->skuId;
    }

    /**
     * @param mixed $skuId
     * @return $this
     */
    public function setSkuId($skuId)
    {
        $this->skuId = $skuId;

        return $this;
    }
}

