<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Entity\Product;
use FloFitBundle\Entity\RequestParameters;
use FloFitBundle\Form\BuyForm;
use FloFitBundle\Form\CreditCardForm;
use FloFitBundle\Services\StripeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 *
 * @Route("")
 * @package FloFitBundle\Controller
 */
class UserCardController extends Controller
{
    /**
     * @Route("/product/{id}", name="flofit_card_1")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, Product $product)
    {
        $form = $this->createForm(new CreditCardForm());
        $form->add("submit","submit",array("label"=>"PAY NOW!"));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var StripeService $stripeService */
            $stripeService = $this->get("stripeService");

            $stripeUser = $stripeService->createStripeUserFromRequest();

            $params = new RequestParameters($stripeUser->id);

            $stripeService->buyProduct($params,$product);

            $paymentHelper = $this->get("paymentHelperService");

            return $this->redirectToRoute($request->get("redirectRoute"),$paymentHelper->makeRequestParameters($params));
        }

        return $this->render('FloFitBundle:UserCard:index.html.twig',
            array(
                "form" => $form->createView(),
                "product" => $product
            ));
    }

    /**
     * @param Request $request
     * @Route("/buy", name="flofit_buy_1")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function buyProduct(Request $request)
    {
        $paymentHelper = $this->get("paymentHelperService");

        $product = new Product();
        $form = $this->createForm(new BuyForm($product));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $userId = $form->get("userId")->getData();

            if(strlen($userId == 0))
            {
                return $this->redirectToRoute("flofit_card_1",
                    array(
                        "id" => $form->get("productId")->getData(),
                        "redirectRoute" => $form->get("afterBuyRouteName")->getData()
                    )
                );
            }

            /** @var StripeService $stripeService */
            $stripeService = $this->get("stripeService");

            $product = $paymentHelper->findProductById($form->get("productId")->getData());

            $parameters = new RequestParameters($form->get("userId")->getData());
            $stripeService->buyProduct($parameters,$product);

            return $this->redirectToRoute(
                $form->get("afterBuyRouteName")->getViewData(),
                $paymentHelper->makeRequestParameters($parameters)
            );
        }

        ladybug_dump_die($form->getErrors(true)->current());
        return new Response("Yep. That is fucked up.");
    }
}
