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
 * @Route("")
 * @package FloFitBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("", name="flofit_def")
     * @Route("/", name="flofit_def_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->query->get("tid") ? $request->query->get("tid") : "homepage";

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-22";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = 'cont895';
        $pvtid = 'cont67';
        $dpvtid = 'cont97';

        if($mobile)
        {
            $vtid = 'mo' . $vtid;
            $pvtid = 'mo' . $pvtid;
            $dpvtid = 'mo' . $dpvtid;
        }

        $dBuyLink = $cbService->buyLink(624, 27220, $vtid, 13935); // FREE TRIAL - 7 day free, $8.95 monthly
        $pBuyLink = $cbService->buyLink(626, 26406, $pvtid, 13358); // $67    ///-$99-
        $dpBuyLink = $cbService->buyLink(588, 26406, $dpvtid, 13358); // 97 - AM PRODUCT - 45 ///-$199-

        return $this->render('FloFitBundle:Default:indexSalesPageCopyHp1.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => false,
            'liveChat' => true
        ));
    }

    /**
     * @Route("/hp", name="flofit_hp")
     * @Route("/hp/", name="flofit_hp_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function hpAction(Request $request)
    {
        return $this->redirectToRoute('flofit_def');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->query->get("tid") ? $request->query->get("tid") : "homepage";

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-7";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = 'variant1295';
        $pvtid = 'variant97';
        $dpvtid = 'variant197';

        if($mobile)
        {
            $vtid = 'mo' . $vtid;
            $pvtid = 'mo' . $pvtid;
            $dpvtid = 'mo' . $dpvtid;
        }

        $dBuyLink = $cbService->buyLink(625, 26601, $vtid, 13935); // FREE TRIAL - 7 day free, $12.95 monthly
        $pBuyLink = $cbService->buyLink(627, 26406, $pvtid, 13358); // $97 ///-$199-
        $dpBuyLink = $cbService->buyLink(601, 26406, $dpvtid, 13358); // $197 - amember product 64 ///-$399-

        return $this->render('FloFitBundle:Default:indexSalesPage3-97-nd.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => false,
            'liveChat' => true
        ));
    }
    /**
     * @Route("/hp1", name="flofit_hp_1")
     * @Route("/hp1/", name="flofit_hp_1_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function hp1Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->query->get("tid") ? $request->query->get("tid") : "homepage";

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-19";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = 'var2895';
        $pvtid = 'var267';
        $dpvtid = 'var297';

        if($mobile)
        {
            $vtid = 'mo' . $vtid;
            $pvtid = 'mo' . $pvtid;
            $dpvtid = 'mo' . $dpvtid;
        }

        $dBuyLink = $cbService->buyLink(624, 26600, $vtid, 13935); // FREE TRIAL - 7 day free, $8.95 monthly
        $pBuyLink = $cbService->$cbService->buyLink(626, 26406, $pvtid, 13358); // $67    ///-$99-
        $dpBuyLink = $cbService->$cbService->buyLink(588, 26406, $dpvtid, 13358); // 97 - AM PRODUCT - 45 ///-$199-

        return $this->render('FloFitBundle:Default:indexSalesPagehp1.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => false,
            'liveChat' => true
        ));
    }


    /**
     * @Route("/nd", name="flofit_def_nd")
     * @Route("/nd/", name="flofit_def_nd_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ndAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->query->get("tid") ? $request->query->get("tid") : "homepage";

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-7";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "homepagedefnd180516";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(631, 24663, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:indexSalesPage3-67.html.twig', array(
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
     * @Route("/a", name="flofit_def_a")
     * @Route("/a/", name="flofit_def_a_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAAction(Request $request)
    {
        return $this->redirectToRoute('flofit_def');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->query->get("tid") ? $request->query->get("tid") : "homepagea";
        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "splithomepagea";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $buyLink = $cbService->buyLink(594, 24310, $vtid, 13935);

        return $this->render('FloFitBundle:Default:indexSalesPage3-intro.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "buyLink" => $buyLink,
            "displayFBCode" => false
        ));
    }

    /**
     * @Route("/b", name="flofit_def_b")
     * @Route("/b/", name="flofit_def_b_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexBAction(Request $request)
    {
        return $this->redirectToRoute('flofit_def');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->query->get("tid") ? $request->query->get("tid") : "homepageb";
        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "splithomepageb";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(594, 21773, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:indexSalesPage3-intro-free-trial.html.twig', array(
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
     * @Route("/free-trial", name="flofit_free_trial")
     * @Route("/free-trial/", name="flofit_free_trial_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function freeTrialAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->query->get("tid") ? $request->query->get("tid") : "freetrial";

        $pixel = "<img src=\"//palaff.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "freetrialpalaff";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $buyLink = $cbService->buyLink(630, 24310, $vtid, 13837);

        return $this->render('FloFitBundle:Default:indexSalesPage3.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "buyLink" => $buyLink,
            "displayFBCode" => false
        ));
    }

    /**
     * @Route("/intro", name="flofit_def_intro")
     * @Route("/intro/", name="flofit_def_intro_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introPage1(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "intro";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-15";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "introdef2508";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(631, 24663, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(599, 24805, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:indexSalesPage3-37-intro-nd.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ));
    }

    /**
     * @Route("/intro/nodigi", name="flofit_def_intro_nodigi")
     * @Route("/intro/nodigi/", name="flofit_def_intro_nodigi_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introNodig(Request $request)
    {
        return $this->redirectToRoute('flofit_def_intro');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "intronodigi";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-12";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "intronodigi2408";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(631, 24663, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(599, 24805, $vtid, 13935);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:indexSalesPage3-37-intro-nodig-nd.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ));
    }

    /**
     * @Route("/intro/fb", name="flofit_def_fb")
     * @Route("/intro/fb/", name="flofit_def_fb_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introFBAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->get('tid') ? $request->get('tid') : 'introfb';
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//floft.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-12";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "introfb2408";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(632, 24663, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(602, 24805, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(604, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:indexSalesPage-intro-fb.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ));
    }

    /**
     * @Route("/intro/nd", name="flofit_def_intro_nd")
     * @Route("/intro/nd/", name="flofit_def_intro_nd_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introPageNd(Request $request)
    {
        return $this->redirectToRoute('flofit_def_intro');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "intro";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-12";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "introdefnd180516";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(631, 24663, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:indexSalesPage3-67-intro.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true
        ));
    }

    /**
     * @Route("/intro-free/a", name="flofit_def_a_intro")
     * @Route("/intro-free/a/", name="flofit_def_a_intro_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introFreeAAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "introfreea";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "introfreeaoff3";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(594, 21773, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:indexSalesPage3-intro-free-trial.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true
        ));
    }

    /**
     * @Route("/intro-fb", name="flofit_def_intro_fb")
     * @Route("/intro-fb/", name="flofit_def_intro_fb_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introPage2(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "introfb";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = true;
        $experimentId = "109399886-8";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "introfboff2";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(589, 21773, $vtid, 13358);
        $pBuyLink = $cbService->buyLink(590, null, $vtid, 13358);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:indexSalesPage3-intro-fb.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true
        ));
    }

    /**
     * @Route("/intro-free", name="flofit_def_intro_free")
     * @Route("/intro-free/", name="flofit_def_intro_free_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introPage3(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "introfree1608";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = '109399886-23';

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "infreecont";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $pBuyLink = $cbService->buyLink(599, 26406, $vtid, 13358); // $37
        $dpBuyLink = $cbService->$cbService->buyLink(588, 26406, $vtid, 13358); // $67

        $cookie = new Cookie("offerId", "introFree", 0, "/", ".flofit.com");

        $response = new Response();
        $response->headers->setCookie($cookie);

        return $this->render('FloFitBundle:Default:free-trial-lander+97.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ), $response);
    }

    /**
     * @Route("/intro-free/pa", name="flofit_def_intro_free_pa")
     * @Route("/intro-free/pa/", name="flofit_def_intro_free_pa_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introFreePaAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = $request->query->get("tid", "infreepa");

        $pixel = "<img src=\"//palaff.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";


        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "infreepa";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $pBuyLink = $cbService->buyLink(599, 26406, $vtid, 13358); // $37
        $dpBuyLink = $cbService->$cbService->buyLink(588, 26406, $vtid, 13358); // $67

        $cookie = new Cookie("offerId", "introFreePa", 0, "/", ".flofit.com");

        $response = new Response();
        $response->headers->setCookie($cookie);

        return $this->render('FloFitBundle:Default:free-trial-lander+97.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ), $response);
    }

    /**
     * @Route("/intro-free/hp", name="flofit_def_hp_free")
     * @Route("/intro-free/hp/", name="flofit_def_hp_free_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introFreeHPAction(Request $request)
    {
        return $this->redirectToRoute("flofit_def_intro_free");

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "introfree1608";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "infreevar";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dpBuyLink = $cbService->$cbService->buyLink(601, 26406, $vtid, 13358); // $67

        $cookie = new Cookie("offerId", "introFreeHp", 0, "/", ".flofit.com");

        $response = new Response();
        $response->headers->setCookie($cookie);

        return $this->render('FloFitBundle:Default:free-trial-lander+197HP.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ), $response);
    }

    /**
     * @Route("/intro-free/nlm", name="flofit_def_intro_free_nlm")
     * @Route("/intro-free/nlm/", name="flofit_def_intro_free_nlm_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introPageNlm(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "introfree1608";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-18";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "introfreenlm";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(631, 26408, $vtid, 13935); // FREE TRIAL - 7 day free, $4.95 monthly
        $pBuyLink = $cbService->buyLink(599, 26406, $vtid, 13358); // $37
        $dpBuyLink = $cbService->buyLink(591, 26406, $vtid, 13358); // $67

        return $this->render('FloFitBundle:Default:free-trial-lander-nlm.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ));
    }

    /**
     * @Route("/intro-free/mbb", name="flofit_def_intro_free_mbb")
     * @Route("/intro-free/mbb/", name="flofit_def_intro_free_mbb_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introPageMobileBannerBadge(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "introfree1608";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-16";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "introfreembb";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(631, 26408, $vtid, 13935); // FREE TRIAL - 7 day free, $4.95 monthly
        $pBuyLink = $cbService->buyLink(599, 26406, $vtid, 13358); // $37
        $dpBuyLink = $cbService->buyLink(591, 26406, $vtid, 13358); // $67

        return $this->render('FloFitBundle:Default:free-trial-lander-mbb.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ));
    }

    /**
     * @Route("/intro-free/nh", name="flofit_def_intro_free_nh")
     * @Route("/intro-free/nh/", name="flofit_def_intro_free_nh_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introPage4(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "introfreenh2608";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-12";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "introfreenh";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(631, 26408, $vtid, 13935); // FREE TRIAL - 7 day free, $4.95 monthly
        $pBuyLink = $cbService->buyLink(599, 26406, $vtid, 13935); // $37
        $dpBuyLink = $cbService->buyLink(591, 26406, $vtid, 13358); // $67

        return $this->render('FloFitBundle:Default:free-trial-lander-nh.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ));
    }

    /**
     * @Route("/header/1", name="flofit_def_new_header1")
     * @Route("/header/1/", name="flofit_def_new_header1_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexHeader1Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;
        $link = $cbService->buyLink(567, 21773, 'header1', 13358);

        $browser = $this->container->get("browser_detect_service");
        $mobile = $browser->isMobile();
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header1\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        return $this->render('FloFitBundle:Default:indexNewHeader1.html.twig', array(
            "price" => $price,
            "link" => $link,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId
        ));
    }

    /**
     * @Route("/header/2", name="flofit_def_new_header2")
     * @Route("/header/2/", name="flofit_def_new_header2_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexHeader2Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;
        $link = $cbService->buyLink(567, 21773, 'header2', 13358);

        $browser = $this->container->get("browser_detect_service");
        $mobile = $browser->isMobile();
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header2\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        return $this->render('FloFitBundle:Default:indexNewHeader2.html.twig', array(
            "price" => $price,
            "link" => $link,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId
        ));
    }

    /**
     * @Route("/header/3", name="flofit_def_new_header3")
     * @Route("/header/3/", name="flofit_def_new_header3_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexHeader3Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;
        $link = $cbService->buyLink(567, 21773, 'header3', 13358);

        $browser = $this->container->get("browser_detect_service");
        $mobile = $browser->isMobile();
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header3\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        return $this->render('FloFitBundle:Default:indexNewHeader3.html.twig', array(
            "price" => $price,
            "link" => $link,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId
        ));
    }

    /**
     * @Route("/header/4", name="flofit_def_new_header4")
     * @Route("/header/4/", name="flofit_def_new_header4_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexHeader4Action(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;
        $link = $cbService->buyLink(567, 21773, 'header4', 13358);

        $browser = $this->container->get("browser_detect_service");
        $mobile = $browser->isMobile();
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header4\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        return $this->render('FloFitBundle:Default:indexNewHeader4.html.twig', array(
            "price" => $price,
            "link" => $link,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId
        ));
    }

    /**
     * @Route("/sales-page", name="flofit_def_sales_page")
     * @Route("/sales-page/", name="flofit_def_sales_page_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexSalesPage(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;
        $link = $cbService->buyLink(567, 21773, 'header1', 13358);

        $browser = $this->container->get("browser_detect_service");
        $mobile = $browser->isMobile();
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header1\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        return $this->render('FloFitBundle:Default:indexSalesPage.html.twig', array(
            "price" => $price,
            "link" => $link,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId
        ));
    }

    /**
     * @Route("/sales-page/2", name="flofit_def_sales_page_2")
     * @Route("/sales-page/2/", name="flofit_def_sales_page_trailing_2")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexSalesPage2(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;
        $link = $cbService->buyLink(567, 21773, 'header1', 13358);

        $browser = $this->container->get("browser_detect_service");
        $mobile = $browser->isMobile();
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header1\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        return $this->render('FloFitBundle:Default:indexSalesPage2.html.twig', array(
            "price" => $price,
            "link" => $link,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId
        ));
    }

    /**
     * @Route("/product/welcome", name="testing_clickbank_product")
     * @Route("/product/welcome/", name="testing_clickbank_product_a")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testingProductForCBAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;

        $browser = $this->container->get("browser_detect_service");

        $billingPlanId= $request->get('p', false);

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
            "link" => $cbService->buyLink($billingPlanId, 21773, $vtid, 13358),
            "timer1" => 0,
//            "timer1" => 5000,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "useJW7" => $useJW7,
            "experiment" => $experiment,
            "isMobile" => $mobile
        ));
    }

    /**
     * @Route("/product/welcome/mob", name="testing_clickbank_product_mob")
     * @Route("/product/welcome/mob/", name="testing_clickbank_product_mob_2")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testingProductForCBMobAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $billingPlanId= $request->get('p', false);

        switch ($billingPlanId){
            case 39:
                $priceText = 'FREE TRIAL for 7 days, then $8.95/month';
                break;
            case 40:
                $priceText = 'FREE TRIAL for 7 days, then $12.95/month';
                break;

            case 418:
                $priceText = 'FREE TRIAL for 8 days, then $4.95/month';
                break;
            case 419:
                $priceText = 'FREE TRIAL for 9 days, then $4.95/month';
                break;
            case 420:
                $priceText = 'FREE TRIAL for 10 days, then $4.95/month';
                break;
            case 421:
                $priceText = 'FREE TRIAL for 11 days, then $4.95/month';
                break;
            case 422:
                $priceText = 'FREE TRIAL for 12 days, then $4.95/month';
                break;
            case 423:
                $priceText = 'FREE TRIAL for 13 days, then $4.95/month';
                break;
            case 424:
                $priceText = 'FREE TRIAL for 14 days, then $4.95/month';
                break;
            case 425:
                $priceText = 'Only for $4.95/month';
                break;
            case 426:
                $priceText = 'Only for $37';
                break;
            case 427:
                $priceText = 'Only for $67';
                break;
            case 428:
                $priceText = 'FREE TRIAL for 8 days, then $4.95/month';
                break;
            case 429:
                $priceText = 'FREE TRIAL for 9 days, then $4.95/month';
                break;
            case 435:
                $priceText = 'Only for $4.95/month';
                break;
            default:
                $priceText = 'Only for $37';
                break;
        }
        $link = $cbService->buyLink($billingPlanId, 21773, 'header4', 13358);

        $browser = $this->container->get("browser_detect_service");
        $mobile = $browser->isMobile();
        $tablet = $browser->isTablet();

        $pixel = "<img src=\"//rushfit.flofit.hop.clickbank.net?tid=header4\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "";

        return $this->render('FloFitBundle:Default:testingClickbankMobProduct.html.twig', array(
            "link" => $link,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "priceText" => $priceText
        ));
    }

    /**
     * @Route("/free-trial-lander", name="flofit_def_intro_free_trial_lander")
     * @Route("/free-trial-lander/", name="flofit_def_intro_free_trial_lander_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function introFreeTrialLander(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $price = 37;

        $browser = $this->container->get("browser_detect_service");
        $tablet = $browser->isTablet();

        $tid = "intronodigi";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

        $pixel = "<img src=\"//totaldom7.flofit.hop.clickbank.net?tid={$tid}\" width='1px' height='1px' style='position:absolute;left:-1000px'>";

        $experiment = false;
        $experimentId = "109399886-12";

        $mobile = $browser->isMobile() || $browser->isTablet();

        $vtid = "intronodigi2906";

        if($mobile)
        {
            $vtid = "mo" . $vtid;
        }

        $dBuyLink = $cbService->buyLink(631, 24663, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(599, 24805, $vtid, 13935);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render('FloFitBundle:Default:free-trial-lander.html.twig', array(
            "price" => $price,
            "pixel" => $pixel,
            "isMobile" => $mobile,
            "isTablet" => $tablet,
            "experiment" => $experiment,
            "experimentId" => $experimentId,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "displayFBCode" => true,
            'liveChat' => true
        ));
    }
}
