<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Services\Browser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RipMixController
 *
 * @Route("/rip-mix")
 * @package FloFitBundle\Controller
 */
class RipMixController extends Controller
{
    /**
     * @Route("", name="flofit_rip_mix_index")
     * @Route("/", name="flofit_rip_mix_index_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 552;
        $vtidRemove = "ms";
        $vtidRemove2 = "pm";
        $vtidAppend = "rm";
        $priceOld = "$39.95";
        $price = 19.95;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "https://player.vimeo.com/external/149956353.hd.mp4?s=25cd861c41eeaabbfd6159dac3ca1c162e523a09&profile_id=113";
        $productName = "Rip Mix";

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
            if($temp >= 0 && strpos($vtid, $vtidRemove, $temp) !== FALSE || $temp >= 0 && strpos($vtid, $vtidRemove2, $temp) !== FALSE)
                $vtid = substr($vtid, 0, $temp);
        }
        // append vtid at the end
        $vtid .= $vtidAppend;

        $linkAccept = $cbService->buyLink($billingPlanId, null, $vtid, 13358, $cbf, 'a');
        $linkDecline = $cbService->buyLink($billingPlanId, null, $vtid, 13358, $cbf, 'd');

        return $this->render('FloFitBundle:RipMix:index.html.twig', array(
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
     * @Route("/dp", name="flofit_rip_mix_dp")
     * @Route("/dp/", name="flofit_rip_mix_dp_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 574;
        $vtidRemove = "ms";
        $vtidAppend = "rm";
        $priceOld = "$39.95";
        $price = 19.95;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "https://player.vimeo.com/external/149956353.hd.mp4?s=25cd861c41eeaabbfd6159dac3ca1c162e523a09&profile_id=113";
        $productName = "Rip Mix";

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

        return $this->render('FloFitBundle:RipMix:index.html.twig', array(
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
