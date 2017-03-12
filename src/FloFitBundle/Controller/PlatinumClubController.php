<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Services\Browser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PlatinumClubController
 *
 * @Route("/platinum-club")
 * @package FloFitBundle\Controller
 */
class PlatinumClubController extends Controller
{

    /**
     * @Route("", name="flofit_platinum_club_index")
     * @Route("/", name="flofit_platinum_club_index_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $vtid = $request->get("vtid");
        $productId = 5;
        $vtidRemove = "ld";
        $vtidAppend = "pc";
        $priceOld = "$79";
        $price = 0;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");

        $videoSource = "https://player.vimeo.com/external/149956352.hd.mp4?s=cadf84e706e8c71e2e23521245dc29198f103cd4&profile_id=113";
        $productName = "Platinum Club";

        $browser = $this->container->get("browser_detect_service");
        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $initialPurchase = null;
        // if the parameter is set
        if($request->get("item"))
        {
            $initialPurchase["productId"] = $request->get("item");  // product ID of initial purchase
            $initialPurchase["price"] = 37;
            $initialPurchase["productName"] = "FLO FIT";
        }

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

        $linkAccept = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=a&vtid={$vtid}";
        $linkDecline = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=d&vtid={$vtid}";

        return $this->render('FloFitBundle:PlatinumClub:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $productId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7
        ));
    }


    /**
     * @Route("/dp", name="flofit_platinum_club_dp")
     * @Route("/dp/", name="flofit_platinum_club_dp_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpAction(Request $request)
    {
        $vtid = $request->get("vtid");
        $productId = 10;
        $vtidRemove = "ld";
        $vtidAppend = "pc";
        $priceOld = "$79";
        $price = 0;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");

        $videoSource = "https://player.vimeo.com/external/149956352.hd.mp4?s=cadf84e706e8c71e2e23521245dc29198f103cd4&profile_id=113";
        $productName = "Platinum Club";

        $browser = $this->container->get("browser_detect_service");
        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $initialPurchase = null;
        // if the parameter is set
        if($request->get("item"))
        {
            $initialPurchase["productId"] = $request->get("item");  // product ID of initial purchase
            $initialPurchase["price"] = 37;
            $initialPurchase["productName"] = "FLO FIT";
        }

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

        $linkAccept = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=a&vtid={$vtid}";
        $linkDecline = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=d&vtid={$vtid}";

        return $this->render('FloFitBundle:PlatinumClub:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $productId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7
        ));
    }

}
