<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Services\Browser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WelcomeController
 *
 * @Route("/welcome")
 * @package FloFitBundle\Controller
 */
class WelcomeController extends Controller
{
    /**
     * @Route("", name="welcome")
     * @Route("/", name="welcome_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = true;
        $experimentId = "109399886-10";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "welnobump040516";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $tid = "welcome";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }
        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

//        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";
        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $dBuyLink = "http://33.flofit.pay.clickbank.net?cbfid=26408&vtid={$vtid}&cbskin=13935";
        $pBuyLink = "http://34.flofit.pay.clickbank.net?vtid={$vtid}&cbskin=13358&cbfid=26406";
        $dpBuyLink = "http://25.flofit.pay.clickbank.net?cbfid=26406&vtid={$vtid}&cbskin=13358";

        return $this->render("FloFitBundle:Welcome:block-free-digital-both.html.twig", array(
            "videoSource" => $videoSource,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
//            "timer1" => (22 * 60 + 55) * 1000, // 22:55
            "timer1" => 0,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile,
            "pixelImg" => $pixel,
            'liveChat' => true
        ));
    }


    /**
     * @Route("/vl", name="welcome_vl")
     * @Route("/vl/", name="welcome_vl_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function vlAction(Request $request)
    {
        return $this->redirectToRoute('welcome');

        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = true;
        $experimentId = "109399886-10";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "welnobump040516";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $tid = "welcome";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }
        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

//        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";
        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $dBuyLink = "http://33.flofit.pay.clickbank.net?cbfid=24663&vtid={$vtid}&cbskin=13935";
        $pBuyLink = "http://34.flofit.pay.clickbank.net?vtid={$vtid}&cbskin=13935&cbfid=24805";
        $dpBuyLink = "http://25.flofit.pay.clickbank.net?cbfid=21773&vtid={$vtid}&cbskin=13358";

        return $this->render("FloFitBundle:Welcome:vl-block-free-digital-both.html.twig", array(
            "videoSource" => $videoSource,
            "link" => "http://7.flofit.pay.clickbank.net?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "linkFree" => "http://33.flofit.pay.clickbank.net?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "linkDigital" => "http://30.flofit.pay.clickbank.net/?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "linkDigitalShipping" => "http://31.flofit.pay.clickbank.net/?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "linkGetStarted" => "http://7.flofit.pay.clickbank.net?cbfid=21773&vtid=welnobumptest&cbskin=13358",
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
//            "timer1" => (22 * 60 + 55) * 1000, // 22:55
            "timer1" => 0,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile,
            "pixelImg" => $pixel
        ));
    }


    /**
     * @Route("/block", name="welcome_block")
     * @Route("/block/", name="welcome_block_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function blockAction(Request $request)
    {
        return $this->redirectToRoute('welcome');

        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;
        $experimentId = "";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "welcomeblock";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        return $this->render("FloFitBundle:Welcome:block.html.twig", array(
            "videoSource" => $videoSource,
            "linkDigital" => "http://30.flofit.pay.clickbank.net/?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "linkDigitalShipping" => "http://31.flofit.pay.clickbank.net/?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "linkGetStarted" => "http://7.flofit.pay.clickbank.net?cbfid=21773&vtid=welnobumptest&cbskin=13358",
//            "timer1" => (22 * 60 + 55) * 1000, // 22:55
            "timer1" => 0,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile
        ));
    }

    /**
     * @Route("/video", name="welcome_video")
     * @Route("/video/", name="welcome_video_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexVideoAction(Request $request)
    {
        return $this->redirectToRoute('welcome');

        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;
        $experimentId = "";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "welbumptest";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

//        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";
        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        return $this->render("FloFitBundle:Welcome:general.html.twig", array(
            "videoSource" => $videoSource,
            "link" => "http://16.flofit.pay.clickbank.net?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "timer1" => (22 * 60 + 55) * 1000, // 22:55
//            "timer1" => 5000,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile
        ));
    }



    /**
     * @Route("/dp", name="welcome_dp")
     * @Route("/dp/", name="welcome_dp_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpAction(Request $request)
    {
        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = true;
        $experimentId = "109399886-11";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "weldpnobump050516";
        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $pixel = "";
        if($request->get("tid",false))
        {
            $pixel = "<img src=\"//totaldom8.flofit.hop.clickbank.net?tid=".$request->get("tid")."\" width='1px' height='1px' style='position:absolute;left:-1000px'>";
        }

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == 'Windows' || $browser->getBrowser() == 'Windows CE');
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $dBuyLink = "http://33.flofit.pay.clickbank.net?cbfid=26485&vtid={$vtid}&cbskin=13935"; // FREE TRIAL - 7 day free, $4.95 monthly
        $pBuyLink = "http://34.flofit.pay.clickbank.net?vtid={$vtid}&cbskin=13358&cbfid=26407"; // $37
        $dpBuyLink = "http://25.flofit.pay.clickbank.net?cbfid=26407&vtid={$vtid}&cbskin=13358"; // $67

        return $this->render("FloFitBundle:Welcome:block-free-digital-both.html.twig", array(
            "videoSource" => $videoSource,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
//            "timer1" => (22 * 60 + 55) * 1000, // 22:55
            "timer1" => 0,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile,
            "pixelImg" => $pixel
        ));
    }


    /**
     * @Route("/dp/block", name="welcome_dp_block")
     * @Route("/dp/block/", name="welcome_dp_block_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpblockAction(Request $request)
    {
        return $this->redirectToRoute('welcome_dp');

        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;
        $experimentId = "";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "weldpnobumpblock";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $pixel = "";
        if($request->get("tid",false))
        {
            $pixel = "<img src=\"//totaldom8.flofit.hop.clickbank.net?tid=".$request->get("tid")."\" width='1px' height='1px' style='position:absolute;left:-1000px'>";
        }

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        return $this->render("FloFitBundle:Welcome:block.html.twig", array(
            "videoSource" => $videoSource,
            "linkDigital" => "http://30.flofit.pay.clickbank.net/?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "linkDigitalShipping" => "http://31.flofit.pay.clickbank.net/?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "linkGetStarted" => "http://9.flofit.pay.clickbank.net?cbfid=22868&vtid=".$vtid."&cbskin=13358",
//            "timer1" => (22 * 60 + 55) * 1000, // 22:55
            "timer1" => 0,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile,
            "pixelImg" => $pixel
        ));
    }


    /**
     * @Route("/dp-video", name="welcome_dp_video")
     * @Route("/dp-video/", name="welcome_dp_video_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpVideoAction(Request $request)
    {
        return $this->redirectToRoute('welcome_dp');

        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;
        $experimentId = "";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "weldpbumptest";
        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $pixel = "";
        if($request->get("tid",false))
        {
            $pixel = "<img src=\"//totaldom8.flofit.hop.clickbank.net?tid=".$request->get("tid")."\" width='1px' height='1px' style='position:absolute;left:-1000px'>";
        }

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        return $this->render("FloFitBundle:Welcome:general.html.twig", array(
            "videoSource" => $videoSource,
            "link" => "http://19.flofit.pay.clickbank.net?cbfid=22868&vtid=".$vtid."&cbskin=13358",
            "pixelImg" => $pixel,
            "timer1" => (22 * 60 + 55) * 1000, // 22:55
//            "timer1" => 5000,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile
        ));
    }

    /**
     * @Route("/product-a", name="welcome_product_a")
     * @Route("/product-a/", name="welcome_product_a_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newProductAAction(Request $request)
    {
        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;

        $browser = $this->container->get("browser_detect_service");

        $vtid = "newproducta";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

//        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";
        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        return $this->render("FloFitBundle:Welcome:product.html.twig", array(
            "videoSource" => $videoSource,
            "link" => "http://17.flofit.pay.clickbank.net?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "timer1" => (22 * 60 + 55) * 1000, // 22:55
//            "timer1" => 5000,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "isMobile" => $mobile
        ));
    }

    /**
     * @Route("/product-b", name="welcome_product_b")
     * @Route("/product-b/", name="welcome_product_b_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newProductBAction(Request $request)
    {
        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;

        $browser = $this->container->get("browser_detect_service");

        $vtid = "newproductb";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

//        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";
        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        return $this->render("FloFitBundle:Welcome:product.html.twig", array(
            "videoSource" => $videoSource,
            "link" => "http://18.flofit.pay.clickbank.net?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "timer1" => (22 * 60 + 55) * 1000, // 22:55
//            "timer1" => 5000,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "isMobile" => $mobile
        ));
    }

    /**
     * @Route("/fb", name="welcome_fb")
     * @Route("/fb/", name="welcome_fb_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexFBAction(Request $request)
    {
        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = true;
        $experimentId = "109399886-6";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "welfbnobumptest";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

//        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";
        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=flofb\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        return $this->render("FloFitBundle:Welcome:fb.html.twig", array(
            "videoSource" => $videoSource,
            "link" => "http://22.flofit.pay.clickbank.net?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "timer1" => (22 * 60 + 55) * 1000, // 22:55
//            "timer1" => 5000,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile,
            "pixel" => $pixel
        ));
    }

    /**
     * @Route("/fb/video", name="welcome_fb_video")
     * @Route("/fb/video/", name="welcome_fb_video_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexFBVideoAction(Request $request)
    {
        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;
        $experimentId = "";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "welfbbumptest";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

//        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";
        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=flofb\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        return $this->render("FloFitBundle:Welcome:fb.html.twig", array(
            "videoSource" => $videoSource,
            "link" => "http://21.flofit.pay.clickbank.net?cbfid=21773&vtid=".$vtid."&cbskin=13358",
            "timer1" => (22 * 60 + 55) * 1000, // 22:55
//            "timer1" => 5000,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "isMobile" => $mobile,
            "pixel" => $pixel
        ));
    }
}
