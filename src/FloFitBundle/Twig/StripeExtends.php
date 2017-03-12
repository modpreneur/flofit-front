<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 23.09.15
 * Time: 16:14
 */

namespace FloFitBundle\Twig;


use Symfony\Component\DependencyInjection\ContainerInterface;

class StripeExtends extends \Twig_Extension
{
    private $container;

    /**
     * StripeExtends constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function renderStripeInit()
    {
        return $this->container->get("templating")
            ->render("@FloFit/Stripe/init.html.twig",
                array(
                    "public_key"=>$this->container->getParameter("stripe_publishable_key"))
            );
    }

    public function getFunctions()
    {
        return array(
            "renderStripeInit" => new \Twig_Function_Method($this,"renderStripeInit", array("is_safe" => array("html"))),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "stripe_extends";
    }
}