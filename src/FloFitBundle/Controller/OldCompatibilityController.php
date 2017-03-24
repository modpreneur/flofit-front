<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Form\CreditCardForm;
use FloFitBundle\Services\Browser;
use FloFitBundle\Services\StripeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OldCompatibilityController
 *
 * @Route("/old")
 * @package FloFitBundle\Controller
 */
class OldCompatibilityController extends Controller
{
    /**
     * @Route("/homepage", name="old_flofit_def")
     *
     * Digital | Physical | Digital + Physical
     *     $37 |      $67 |                $67
     * homepage - run before 1.4.2016
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepageDigitalAndPhysicalAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=oldhomepage\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "oldnewhomepage";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(589, 21773, $vtid, 13358);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Old:homepage3products.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => false
        ));
    }
}
