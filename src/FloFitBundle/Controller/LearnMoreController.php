<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Form\CreditCardForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LearnMoreController
 *
 * @Route("/learn-more")
 * @package FloFitBundle\Controller
 */
class LearnMoreController extends Controller
{
   /**
     * @Route("", name="learn_more")
     * @Route("/", name="learn_more_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $newPrice = "$37";
        $oldPrice = "$79";
        $link = "http://7.flofit.pay.clickbank.net?cbfid=21773&vtid=learnmore&cbskin=13358";

        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "learnmore070616";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $dBuyLink = "http://33.flofit.pay.clickbank.net?cbfid=24663&vtid={$vtid}&cbskin=13935";
        $pBuyLink = "http://34.flofit.pay.clickbank.net?vtid={$vtid}&cbskin=13935&cbfid=24805";
        $dpBuyLink = "http://25.flofit.pay.clickbank.net?cbfid=21773&vtid={$vtid}&cbskin=13358";

        return $this->render("FloFitBundle:LearnMore:new2.html.twig", array(
            "videoSource" => $videoSource,
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "digitalBuyLink" => $dBuyLink,
            "physicalBuyLink" => $pBuyLink,
            "digphyBuyLink" => $dpBuyLink,
            "link" => $link
        ));
    }

    /**
     * @Route("/dp", name="learn_more_dp")
     * @Route("/dp/", name="learn_more_dp_trailing")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dpAction()
    {
        $newPrice = "$37";
        $oldPrice = "$79";
        $link = "http://9.flofit.pay.clickbank.net?cbfid=22868&vtid=learnmoredp&cbskin=13358";

        return $this->render('FloFitBundle:LearnMore:general.html.twig', array(
            "newPrice" => $newPrice,
            "oldPrice" => $oldPrice,
            "link" => $link));
    }

    /**
      * @Route("/2", name="learn_more_2")
      * @Route("/2/", name="learn_more_2_trailing")
      * @param Request $request
      * @return \Symfony\Component\HttpFoundation\Response
      */
     public function new2Action(Request $request)
     {
         $newPrice = "$37";
         $oldPrice = "$79";
         $link = "http://7.flofit.pay.clickbank.net?cbfid=21773&vtid=learnmore&cbskin=13358";

         $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";

         return $this->render("FloFitBundle:LearnMore:general.html.twig", array(
             "videoSource" => $videoSource,
             "newPrice" => $newPrice,
             "oldPrice" => $oldPrice,
             "link" => $link
         ));
     }
}
