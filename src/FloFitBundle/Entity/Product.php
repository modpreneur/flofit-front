<?php

namespace FloFitBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * 
 * @ORM\Entity(repositoryClass="FloFitBundle\Entity\ProductRepository")
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var float
     *
     * @ORM\Column(name="firstPrice", type="float")
     */
    protected $firstPrice;

    /**
     * @var ArrayCollection<ProductItem>
     *
     * @ORM\OneToMany(targetEntity="FloFitBundle\Entity\ProductItem", mappedBy="product")
     */
    protected $productItems;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=3, options={"default"="usd"})
     */
    protected $currency = "usd";

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->productItems = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set firstPrice
     *
     * @param float $firstPrice
     *
     * @return Product
     */
    public function setFirstPrice($firstPrice)
    {
        $this->firstPrice = $firstPrice;

        return $this;
    }

    /**
     * Get firstPrice
     *
     * @return float
     */
    public function getFirstPrice()
    {
        return $this->firstPrice;
    }

    /**
     * @return ArrayCollection
     */
    public function getProductItems()
    {
        return $this->productItems;
    }

    /**
     * @param $productItem
     * @return $this
     * @internal param ArrayCollection $productItems
     */
    public function addProductItems($productItem)
    {
        $this->productItems->add($productItem);

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }
}

