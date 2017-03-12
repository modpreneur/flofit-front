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
        $vtid = $request->get("vtid");
        $productId = 2;
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

        $linkAccept = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=a&vtid={$vtid}&cbskin=13358";
        $linkDecline = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=d&vtid={$vtid}&cbskin=13358";

        return $this->render('FloFitBundle:PlatinumMix:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $productId,
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
        $vtid = $request->get("vtid");
        $productId = 11;
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

        $linkAccept = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=a&vtid={$vtid}&cbskin=13358";
        $linkDecline = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=d&vtid={$vtid}&cbskin=13358";

        return $this->render('FloFitBundle:PlatinumMix:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $productId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "useJW7" => $useJW7
        ));
    }
}
