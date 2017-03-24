<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Services\Browser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ConfirmationController
 *
 * @Route("/confirmation")
 * @package FloFitBundle\Controller
 */
class ConfirmationController extends Controller
{
    /**
     * @Route("", name="flofit_confirmation_index")
     * @Route("/", name="flofit_confirmation_index_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 555;
        $vtidRemove = "";
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

            $this->get("session")->set("FIRST_UPSELL", $request->get("item"));
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

        $linkAccept = $cbService->buyLink($billingPlanId, null, null, null, $cbf, 'a');
        $linkDecline = $cbService->buyLink($billingPlanId, null, null, null, $cbf, 'd');

        $response = null;
        $pixelView = is_null($request->cookies->get("pixel_view", null));
        if($pixelView)
        {
            $cookie = new Cookie("pixel_view",true,(new \DateTime())->add(new \DateInterval("P1M")));
            $response = new Response();
            $response->headers->setCookie($cookie);
        }

        return $this->render('FloFitBundle:Confirmation:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7,
            "displayPixel" => $pixelView
        ),$response);
    }

    /**
     * @Route("/dp", name="flofit_confirmation_dp")
     * @Route("/dp/", name="flofit_confirmation_dp_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 571;
        $vtidRemove = "";
        $vtidAppend = "pc";
        $priceOld = "$79";
        $price = 0;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "https://player.vimeo.com/external/149956352.hd.mp4?s=cadf84e706e8c71e2e23521245dc29198f103cd4&profile_id=113";
        $productName = "Platinum Club";

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

        $browser = $this->container->get("browser_detect_service");
        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $response = null;
        $linkAccept = $cbService->buyLink($billingPlanId, null, null, null, $cbf, 'a');
        $linkDecline = $cbService->buyLink($billingPlanId, null, null, null, $cbf, 'd');

        return $this->render('FloFitBundle:Confirmation:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7,
            "displayPixel" => false
        ),$response);
    }

    /**
     * @Route("/free", name="flofit_confirmation_index_free")
     * @Route("/free/", name="flofit_confirmation_index_free_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function freeAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 555;
        $vtidRemove = "";
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

        $linkAccept = $cbService->buyLink($billingPlanId, null, null, null, $cbf, 'a');
        $linkDecline = $cbService->buyLink($billingPlanId, null, null, null, $cbf, 'd');

        $response = null;
        $pixelView = is_null($request->cookies->get("pixel_view", null));
        if($pixelView)
        {
            $cookie = new Cookie("pixel_view",true,(new \DateTime())->add(new \DateInterval("P1M")));
            $response = new Response();
            $response->headers->setCookie($cookie);
        }

        return $this->render('FloFitBundle:Confirmation:free.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7,
            "displayPixel" => $pixelView
        ),$response);
    }

    /**
     * @Route("/pif", name="flofit_confirmation_lifetime_digital_index")
     * @Route("/pif/", name="flofit_confirmation_lifetime_digital_index_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pifAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 597;
        $vtidRemove = "";
        $vtidAppend = "ld";
        $priceOld = "$67";
        $price = 37;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "";
        $productName = "Lifetime Digital";

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

        $initialPurchase = null;
        // if the parameter is set
        if($request->get("item"))
        {
            $initialPurchase["productId"] = $request->get("item");  // product ID of initial purchase
            $initialPurchase["price"] = 0;
            $initialPurchase["productName"] = "FLO FIT Free Trial";
        }

        // show pixels
        $response = null;
        $pixelView = is_null($request->cookies->get("pixel_view", null));
        if($pixelView)
        {
            $cookie = new Cookie("pixel_view",true,(new \DateTime())->add(new \DateInterval("P1M")));
            $response = new Response();
            $response->headers->setCookie($cookie);
        }

        $previousProduct = null;
        try
        {
            $clickbankService = $this->get('product_solver_service');
            $previousProduct = $clickbankService->findProduct($request->query->get('item'));
        }
        catch(\Exception $e)
        {

        }

        return $this->render('FloFitBundle:Confirmation:pif.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7,
            "displayPixel" => $pixelView,
            "previousProduct" => $previousProduct
        ), $response);
    }

    /**
     * @Route("/pif/43", name="flofit_confirmation_lifetime_digital_43")
     * @Route("/pif/43/", name="flofit_confirmation_lifetime_digital_43_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pif43Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 628;
        $vtidRemove = "";
        $vtidAppend = "ld";
        $priceOld = "$67";
        $price = 67;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "";
        $productName = "Lifetime Digital";

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

        $initialPurchase = null;
        // if the parameter is set
        if($request->get("item"))
        {
            $initialPurchase["productId"] = $request->get("item");  // product ID of initial purchase
            $initialPurchase["price"] = 0;
            $initialPurchase["productName"] = "FLO FIT Free Trial";
        }

        // show pixels
        $response = null;
        $pixelView = is_null($request->cookies->get("pixel_view", null));
        if($pixelView)
        {
            $cookie = new Cookie("pixel_view",true,(new \DateTime())->add(new \DateInterval("P1M")));
            $response = new Response();
            $response->headers->setCookie($cookie);
        }

        $previousProduct = null;
        try
        {
            $clickbankService = $this->get('product_solver_service');
            $previousProduct = $clickbankService->findProduct($request->query->get('item'));
        }
        catch(\Exception $e)
        {

        }

        return $this->render('FloFitBundle:Confirmation:pif.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7,
            "displayPixel" => $pixelView,
            "previousProduct" => $previousProduct
        ), $response);
    }

    /**
     * @Route("/pif/44", name="flofit_confirmation_lifetime_digital_44")
     * @Route("/pif/44/", name="flofit_confirmation_lifetime_digital_44_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pif44Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 629;
        $vtidRemove = "";
        $vtidAppend = "ld";
        $priceOld = "$67";
        $price = 97;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "";
        $productName = "Lifetime Digital";

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

        $initialPurchase = null;
        // if the parameter is set
        if($request->get("item"))
        {
            $initialPurchase["productId"] = $request->get("item");  // product ID of initial purchase
            $initialPurchase["price"] = 0;
            $initialPurchase["productName"] = "FLO FIT Free Trial";
        }

        // show pixels
        $response = null;
        $pixelView = is_null($request->cookies->get("pixel_view", null));
        if($pixelView)
        {
            $cookie = new Cookie("pixel_view",true,(new \DateTime())->add(new \DateInterval("P1M")));
            $response = new Response();
            $response->headers->setCookie($cookie);
        }

        $previousProduct = null;
        try
        {
            $clickbankService = $this->get('product_solver_service');
            $previousProduct = $clickbankService->findProduct($request->query->get('item'));
        }
        catch(\Exception $e)
        {

        }

        return $this->render('FloFitBundle:Confirmation:pif.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7,
            "displayPixel" => $pixelView,
            "previousProduct" => $previousProduct
        ), $response);
    }

    /**
     * @Route("/pif/dp", name="flofit_confirmation_lifetime_digital_dp")
     * @Route("/pif/dp/", name="flofit_confirmation_lifetime_digital_dp_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pifDPAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 616;
        $vtidRemove = "";
        $vtidAppend = "ld";
        $priceOld = "$67";
        $price = 37;
        $priceNew = "$".$price;
        $cbf = $request->get("cbf");
        $videoSource = "";
        $productName = "Lifetime Digital";

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

        $initialPurchase = null;
        // if the parameter is set
        if($request->get("item"))
        {
            $initialPurchase["productId"] = $request->get("item");  // product ID of initial purchase
            $initialPurchase["price"] = 0;
            $initialPurchase["productName"] = "FLO FIT Free Trial";
        }

        // show pixels
        $response = null;
        $pixelView = is_null($request->cookies->get("pixel_view", null));
        if($pixelView)
        {
            $cookie = new Cookie("pixel_view",true,(new \DateTime())->add(new \DateInterval("P1M")));
            $response = new Response();
            $response->headers->setCookie($cookie);
        }

        $previousProduct = null;
        try
        {
            $clickbankService = $this->get('product_solver_service');
            $previousProduct = $clickbankService->findProduct($request->query->get('item'));
        }
        catch(\Exception $e)
        {

        }

        return $this->render('FloFitBundle:Confirmation:pif.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7,
            "displayPixel" => $pixelView,
            "previousProduct" => $previousProduct
        ), $response);
    }

    /**
     * @Route("/be/5", name="flofit_platinum_club_be_5")
     * @Route("/be/5/", name="flofit_platinum_club_be_5_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function be5Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $vtid = $request->get("vtid");
        $billingPlanId= 555;
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

        $linkAccept = $cbService->buyLink($billingPlanId, null, null, null, $cbf, 'a');
        $linkDecline = $cbService->buyLink($billingPlanId, null, null, null, $cbf, 'd');

        return $this->render('FloFitBundle:PlatinumClub:index.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $billingPlanId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "initialPurchase" => $initialPurchase,
            "useJW7" => $useJW7
        ));
    }
}
