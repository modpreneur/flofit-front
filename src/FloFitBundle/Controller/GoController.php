<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Form\CreditCardForm;
use FloFitBundle\Services\StripeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GoController
 *
 * @Route("/go")
 * @package FloFitBundle\Controller
 */
class GoController extends Controller
{
    /**
     * @Route("", name="flofit_go")
     * @Route("/", name="flofit_go_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute("affiliate");
    }

}
