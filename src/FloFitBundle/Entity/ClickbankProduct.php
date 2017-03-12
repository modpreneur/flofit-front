<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 26.10.16
 * Time: 11:53
 */

namespace FloFitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ClickbankProduct
 * @package FloFitBundle\Entity
 * @ORM\Entity()
 */
class ClickbankProduct
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
     * @ORM\Column(name="sku", type="string", length=100)
     */
    protected $sku;

    /**
     * @var string
     * @ORM\Column(name="site", type="string", length=50)
     */
    protected $site;

    /**
     * @var boolean
     * @ORM\Column(name="digital", type="boolean", options={"default"=0})
     */
    protected $digital;

    /**
     * @var boolean
     * @ORM\Column(name="physical", type="boolean", options={"default"=0})
     */
    protected $physical;

    /**
     * @var boolean
     * @ORM\Column(name="digital_recuring", type="boolean", options={"default"=0})
     */
    protected $digitalRecuring;

    /**
     * @var boolean
     * @ORM\Column(name="physical_recuring", type="boolean", options={"default"=0})
     */
    protected $physicalRecuring;

    /**
     * @var string
     * @ORM\Column(name="title", type="text")
     */
    protected $title;

    /**
     * @var float
     * @ORM\Column(name="first_price", type="float")
     */
    protected $firstPrice;

    /**
     * @var float
     * @ORM\Column(name="second_price", type="float")
     */
    protected $secondPrice;

    /**
     * @var string
     * @ORM\Column(name="recuring_frequency", type="string", length=30)
     */
    protected $recuringFrequency;

    /**
     * @var integer
     * @ORM\Column(name="duration", type="integer")
     */
    protected $duration;

    /**
     * @var integer
     * @ORM\Column(name="trial_days", type="integer")
     */
    protected $trialDays;

    /**
     * ClickbankProduct constructor.
     */
    public function __construct()
    {
        $this->secondPrice = 0;
        $this->recuringFrequency = 0;
        $this->duration = 0;
        $this->trialDays = 0;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return boolean
     */
    public function isDigital()
    {
        return $this->digital;
    }

    /**
     * @param boolean $digital
     */
    public function setDigital($digital)
    {
        $this->digital = $digital;
    }

    /**
     * @return boolean
     */
    public function isPhysical()
    {
        return $this->physical;
    }

    /**
     * @param boolean $physical
     */
    public function setPhysical($physical)
    {
        $this->physical = $physical;
    }

    /**
     * @return boolean
     */
    public function isDigitalRecuring()
    {
        return $this->digitalRecuring;
    }

    /**
     * @param boolean $digitalRecuring
     */
    public function setDigitalRecuring($digitalRecuring)
    {
        $this->digitalRecuring = $digitalRecuring;
    }

    /**
     * @return boolean
     */
    public function isPhysicalRecuring()
    {
        return $this->physicalRecuring;
    }

    /**
     * @param boolean $physicalRecuring
     */
    public function setPhysicalRecuring($physicalRecuring)
    {
        $this->physicalRecuring = $physicalRecuring;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getFirstPrice()
    {
        return $this->firstPrice;
    }

    /**
     * @param float $firstPrice
     */
    public function setFirstPrice($firstPrice)
    {
        $this->firstPrice = $firstPrice;
    }

    /**
     * @return float
     */
    public function getSecondPrice()
    {
        return $this->secondPrice;
    }

    /**
     * @param float $secondPrice
     */
    public function setSecondPrice($secondPrice)
    {
        $this->secondPrice = $secondPrice;
    }

    /**
     * @return string
     */
    public function getRecuringFrequency()
    {
        return $this->recuringFrequency;
    }

    /**
     * @param string $recuringFrequency
     */
    public function setRecuringFrequency($recuringFrequency)
    {
        $this->recuringFrequency = $recuringFrequency;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getTrialDays()
    {
        return $this->trialDays;
    }

    /**
     * @param int $trialDays
     */
    public function setTrialDays($trialDays)
    {
        $this->trialDays = $trialDays;
    }

    /**
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param string $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }
}