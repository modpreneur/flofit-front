<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Form\CreditCardForm;
use FloFitBundle\Services\Browser;
use FloFitBundle\Services\StripeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TestingController
 *
 * @Route("/testing")
 * @package FloFitBundle\Controller
 */
class TestingController extends Controller
{

    /**
     * @Route("lazy/0", name="flofit_test_lazy_0")
     * @Route("/lazy/0/", name="flofit_test_lazy_0_trailings")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexSalesPageLazy0Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header1\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "newhomepage";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(589, 21773, $vtid, 13358);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Testing:indexSalesPageLazy0.html.twig', array(
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

    /**
     * @Route("lazy/1", name="flofit_test_lazy_1")
     * @Route("/lazy/1/", name="flofit_test_lazy_1_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexSalesPageLazy1Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header1\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "newhomepage";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(589, 21773, $vtid, 13358);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Testing:indexSalesPageLazy1.html.twig', array(
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

    /**
     * @Route("lazy/2", name="flofit_test_lazy_2")
     * @Route("/lazy/2/", name="flofit_test_lazy_2_trailings")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexSalesPageLazy2Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header1\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "newhomepage";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(589, 21773, $vtid, 13358);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Testing:indexSalesPageLazy2.html.twig', array(
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

    /**
     * @Route("lazy/3", name="flofit_test_lazy_3")
     * @Route("/lazy/3/", name="flofit_test_lazy_3_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexSalesPageLazy3Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header1\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "newhomepage";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(589, 21773, $vtid, 13358);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Testing:indexSalesPageLazy3.html.twig', array(
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
