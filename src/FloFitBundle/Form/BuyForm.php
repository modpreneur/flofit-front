<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 23.09.15
 * Time: 16:00
 */

namespace FloFitBundle\Form;


use FloFitBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BuyForm extends AbstractType
{
    protected $product;
    protected $afterBuyRouteName;
    protected $userId;

    /**
     * CreditCardForm constructor.
     *
     * @param Product $product
     * @param null    $afterBuyRouteName
     */
    public function __construct(Product $product, $afterBuyRouteName = null, $userId = null)
    {
        $this->product = $product;
        $this->afterBuyRouteName = $afterBuyRouteName;
        $this->userId = $userId;
    }

    /**
     * Build form function
     *
     * @param FormBuilderInterface $builder the formBuilder
     * @param array                $options the options for this form
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $afterBuyRouteParams = array();
        if(!is_null($this->afterBuyRouteName))
        {
            $afterBuyRouteParams["data"] = $this->afterBuyRouteName;
        }
        $afterBuyRouteParams["mapped"] = false;

        $builder
            ->add("productId","hidden",
                array(
                    "mapped" => false,
                    "data" => $this->product->getId()
                )
            )
            ->add("afterBuyRouteName","hidden",$afterBuyRouteParams)
            ->add("submit","submit",
                array(
                    "label" => "Pay now!"
                )
            )
            ->add("userId","hidden",
                array(
                    "data"=>is_null($this->userId)? "" : $this->userId
                ));
    }

    /**
     * Return unique name for this form
     *
     * @return string
     */
    public function getName()
    {
        return "buyForm";
    }
}