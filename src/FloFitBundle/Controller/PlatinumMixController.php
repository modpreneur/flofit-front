<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Services\Browser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PlatinumMixController
 *
 * @Route("/platinum-mix")
 * @package FloFitBundle\Controller
 */
class PlatinumMixController extends Controller
{
    /**
     * @Route("", name="flofit_platinum_mix_index")
     * @Route("/", name="flofit_platinum_mix_index_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 548;
        $vtidRemove = "pc";
        $vtidAppend = "pm";
        $priceOld = "$79";
        $price = 37;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "https://player.vimeo.com/external/149956354.hd.mp4?s=29087c20dd3beb0e128fbb837761237bdcb759c1&profile_id=113";
        $productName = "Platinum Mix";

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

        return $this->render('FloFitBundle:PlatinumMix:index.html.twig', array(
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
     * @Route("/dp", name="flofit_platinum_mix_dp")
     * @Route("/dp/", name="flofit_platinum_mix_dp_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 572;
        $vtidRemove = "pc";
        $vtidAppend = "pm";
        $priceOld = "$79";
        $price = 37;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "https://player.vimeo.com/external/149956354.hd.mp4?s=29087c20dd3beb0e128fbb837761237bdcb759c1&profile_id=113";
        $productName = "Platinum Mix";

        $browser = $this->container->get("browser_detect_service");
        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

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

        $linkAccept = $cbService->buyLink($billingPlanId, null, $vtid, 13358, $cbf, 'a');
        $linkDecline = $cbService->buyLink($billingPlanId, null, $vtid, 13358, $cbf, 'd');

        return $this->render('FloFitBundle:PlatinumMix:index.html.twig', array(
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
