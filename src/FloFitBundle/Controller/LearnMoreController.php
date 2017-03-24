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
        $cbService = $this->get('clickbank_service');

        $newPrice = "$37";
        $oldPrice = "$79";
        $link = $cbService->buyLink(567, 21773, 'learnmore', 13358);

        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "learnmore070616";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $dBuyLink = $cbService->buyLink(598, 24663, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(599, 24805, $vtid, 13935);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

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
        $cbService = $this->get('clickbank_service');

        $newPrice = "$37";
        $oldPrice = "$79";
        $link = $cbService->buyLink(570, 22868, 'learnmoredp', 13358);

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
         $cbService = $this->get('clickbank_service');

         $newPrice = "$37";
         $oldPrice = "$79";
         $link = $cbService->buyLink(567, 21773, 'learnmore', 13358);

         $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";

         return $this->render("FloFitBundle:LearnMore:general.html.twig", array(
             "videoSource" => $videoSource,
             "newPrice" => $newPrice,
             "oldPrice" => $oldPrice,
             "link" => $link
         ));
     }
}
