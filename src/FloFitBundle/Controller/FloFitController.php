<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Form\CreditCardForm;
use FloFitBundle\Services\Browser;
use FloFitBundle\Services\StripeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 *
 * @Route("/flo-fit")
 * @package FloFitBundle\Controller
 */
class FloFitController extends Controller
{
    /**
     * @Route("/pif", name="flofit_flofit_lifetime_digital_index")
     * @Route("/pif/", name="flofit_flofit_lifetime_digital_index_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pifAction(Request $request)
    {
        $vtid = $request->get("vtid");
        $productId = 32;
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

        $linkAccept = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=a&vtid={$vtid}&cbskin=13358";
        $linkDecline = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=d&vtid={$vtid}&cbskin=13358";

        $initialPurchase = null;
        // if the parameter is set
        if($request->get("item")) {
            $initialPurchase["productId"] = $request->get("item");  // product ID of initial purchase
            $initialPurchase["price"] = 0;
            $initialPurchase["productName"] = "FLO FIT Free Trial";
            
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

        return $this->render('FloFitBundle:FloFit:pif.html.twig', array(
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
            "useJW7" => $useJW7,
            "previousProduct" => $previousProduct
        ));
    }


    /**
     * @Route("/pif/43", name="flofit_flofit_lifetime_digital_43")
     * @Route("/pif/43/", name="flofit_flofit_lifetime_digital_43_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pif43Action(Request $request)
    {
        $vtid = $request->get("vtid");
        $productId = 43;
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

        $linkAccept = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=a&vtid={$vtid}&cbskin=13358";
        $linkDecline = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=d&vtid={$vtid}&cbskin=13358";

        $previousProduct = null;

        try
        {
            $sessionManager = $this->get('session');

            if($sessionManager->has('FIRST_UPSELL'))
            {
                $itemId = $sessionManager->get('FIRST_UPSELL');
            }else{
                $itemId = $request->query->get('item', null);
            }

            $clickbankService = $this->get('product_solver_service');
            $previousProduct = $clickbankService->findProduct($itemId);
        }
        catch(\Exception $e)
        {

        }

        return $this->render('FloFitBundle:FloFit:pif.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => "67",
            "productId" => $productId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "useJW7" => $useJW7,
            "previousProduct" => $previousProduct
        ));
    }

    /**
     * @Route("/pif/dp", name="flofit_flofit_lifetime_digital_dp")
     * @Route("/pif/dp/", name="flofit_flofit_lifetime_digital_dp_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pifDPAction(Request $request)
    {
        $vtid = $request->get("vtid");
        $productId = 38;
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

        $linkAccept = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=a&vtid={$vtid}&cbskin=13358";
        $linkDecline = "http://{$productId}.flofit.pay.clickbank.net?cbf={$cbf}&cbur=d&vtid={$vtid}&cbskin=13358";

        $previousProduct = null;
        try
        {
            $clickbankService = $this->get('product_solver_service');
            $previousProduct = $clickbankService->findProduct($request->query->get('item'));
        }
        catch(\Exception $e)
        {

        }

        return $this->render('FloFitBundle:FloFit:pif.html.twig', array(
            "linkAccept" => $linkAccept,
            "linkDecline" => $linkDecline,
            "priceOld" => $priceOld,
            "priceNew" => $priceNew,
            "price" => $price,
            "productId" => $productId,
            "cbf" => $cbf,
            "videoSource" => $videoSource,
            "productName" => $productName,
            "useJW7" => $useJW7,
            "previousProduct" => $previousProduct
        ));
    }
}
