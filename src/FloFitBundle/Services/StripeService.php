<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 23.09.15
 * Time: 14:46
 */

namespace FloFitBundle\Services;


use FloFitBundle\Entity\NormalProduct;
use FloFitBundle\Entity\Product;
use FloFitBundle\Entity\RecuringProduct;
use FloFitBundle\Entity\RequestParameters;
use FloFitBundle\Form\CreditCardForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StripeService
{
    private $container;

    /**
     * StripeService constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        \Stripe\Stripe::setApiKey($this->container->getParameter("stripe_secret_key"));
    }

    protected function getTokenFromRequest()
    {
        return $this->container->get("request")->get("stripeToken", null);
    }

    public function createStripeUserFromRequest()
    {
        $creditCardFormData = $this->container->get("request")->get(CreditCardForm::FORM_NAME, null);

        $stripeToken = $creditCardFormData[CreditCardForm::FIELD_STRIPE_TOKEN];
        $firstName = $creditCardFormData[CreditCardForm::FIELD_FIRST_NAME];
        $lastName = $creditCardFormData[CreditCardForm::FIELD_LAST_NAME];
        $email = $creditCardFormData[CreditCardForm::FIELD_EMAIL];

        return $this->createStripeUser($stripeToken, $firstName, $lastName, $email);
    }

    /**
     * @param $stripeToken
     * @param $firstName
     * @param $lastName
     * @param $email
     * @return \Stripe\Customer
     */
    public function createStripeUser($stripeToken, $firstName, $lastName, $email)
    {
        return \Stripe\Customer::create(
            array(
                "source"      => $stripeToken,
                "description" => $firstName . " " . $lastName,
                "email"       => $email,
                "metadata"    => array(
                    "name_f" => $firstName,
                    "name_l" => $lastName
                )
            )
        );
    }

    public function buyProductForUser($userId, NormalProduct $product)
    {
        $order = \Stripe\Order::create(
            array(
                "customer" => $userId,
                "currency" => $product->getCurrency(),
                "items"    => array(
                    array(
                        "type"   => "sku",
                        "parent" => strval($product->getSkuId()),
                    )
                )
            )
        );
        $order->pay();

        return $order;
    }

    public function createSubscriptionForUser($userId, RecuringProduct $product)
    {
        $customer = \Stripe\Customer::retrieve($userId);

        return $customer->subscriptions->create(
            array(
                "plan" => strval($product->getPlanId())
            )
        );
    }

    public function buyProduct(RequestParameters $parameters, Product $product)
    {
        if ($product instanceof NormalProduct) {
            /** @var NormalProduct $product */
            return $this->buyProductForUser($parameters->userId, $product);
        }

        if ($product instanceof RecuringProduct) {
            /** @var RecuringProduct $product */
            return $this->createSubscriptionForUser($parameters->userId, $product);
        }
    }
}