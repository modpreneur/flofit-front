<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Services\Browser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MealSystemsController
 *
 * @Route("/meal-systems")
 * @package FloFitBundle\Controller
 */
class MealSystemsController extends Controller
{
    /**
     * @Route("", name="flofit_meal_systems_index")
     * @Route("/", name="flofit_meal_systems_index_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 550;
        $vtidRemove = "pm";
        $vtidAppend = "ms";
        $priceOld = "$57";
        $price = 29.95;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "https://player.vimeo.com/external/149956356.hd.mp4?s=8b0cd18f86ba29c5e2bf4e1bdec14cc856de561f&profile_id=113";
        $productName = "Meal Systems";

        // is there anything to remove from vtid?
        if($vtidRemove)
        {
            // starting position
            $temp = strlen($vtid) - strlen($vtidRemove);
            // remove or no
            if($temp >= 0 && strpos($vtid, $vtidRemove, $temp) !== FALSE)
                $vtid = substr($vtid, 0, $temp);
        }
        // append vtid at the end
        $vtid .= $vtidAppend;

        $browser = $this->container->get("browser_detect_service");
        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $linkAccept = $cbService->buyLink($billingPlanId, null, $vtid, 13358, $cbf, 'a');
        $linkDecline = $cbService->buyLink($billingPlanId, null, $vtid, 13358, $cbf, 'd');

        return $this->render('FloFitBundle:MealSystems:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "useJW7" => $useJW7
        ));
    }

    /**
     * @Route("/dp", name="flofit_meal_systems_dp")
     * @Route("/dp/", name="flofit_meal_systems_dp_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 573;
        $vtidRemove = "pm";
        $vtidAppend = "ms";
        $priceOld = "$57";
        $price = 29.95;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "https://player.vimeo.com/external/149956356.hd.mp4?s=8b0cd18f86ba29c5e2bf4e1bdec14cc856de561f&profile_id=113";
        $productName = "Meal Systems";

        // is there anything to remove from vtid?
        if($vtidRemove)
        {
            // starting position
            $temp = strlen($vtid) - strlen($vtidRemove);
            // remove or no
            if($temp >= 0 && strpos($vtid, $vtidRemove, $temp) !== FALSE)
                $vtid = substr($vtid, 0, $temp);
        }
        // append vtid at the end
        $vtid .= $vtidAppend;

        $browser = $this->container->get("browser_detect_service");
        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $linkAccept = $cbService->buyLink($billingPlanId, null, $vtid, 13358, $cbf, 'a');
        $linkDecline = $cbService->buyLink($billingPlanId, null, $vtid, 13358, $cbf, 'd');

        return $this->render('FloFitBundle:MealSystems:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "useJW7" => $useJW7
        ));
    }
}
