<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 24.09.15
 * Time: 12:13
 */

namespace FloFitBundle\Services;


use FloFitBundle\Entity\Product;
use FloFitBundle\Entity\RequestParameters;
use FloFitBundle\Form\BuyForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PaymentHelperService
{
    const PARAMS_KEY = "params";

    private $container;

    /**
     * PaymentHelperService constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function createBuyForm(Product $product, $redirectRouteName, $data = null,array $options = array())
    {
        if(!array_key_exists("action", $options))
        {
            $options["action"] = $this->container->get('router')->generate("flofit_buy_1");
        }

        $parameters = $this->getRequestParameters();

        $userId = null;
        if(!is_null($parameters))
            $userId = $parameters->userId;

        $form = $this->container->get('form.factory')->create(
            new BuyForm($product, $redirectRouteName, $userId), $data, $options
        );

        $form->handleRequest($this->getRequest());

        return $form;
    }

    /**
     * @param string $parameterName
     * @return RequestParameters|null
     */
    public function getRequestParameters($parameterName = self::PARAMS_KEY)
    {
        $request = $this->getRequest();

        $paramsString = $request->get($parameterName,null);

        if(is_null($paramsString))
            return null;

        // TODO crypt

        return unserialize($paramsString);
    }

    private function getRequest()
    {
        return $this->container->get("request");
    }

    public function findProductById($billingPlanId)
    {
        return $this->container->get("doctrine")->getManager()->getRepository("FloFitBundle:Product")
            ->find($billingPlanId);
    }

    public function makeRequestParameters(RequestParameters $params, $parameter = self::PARAMS_KEY)
    {
        $paramsSerialized = serialize($params);

        // TODO encrypt

        return array($parameter => $paramsSerialized);
    }
}