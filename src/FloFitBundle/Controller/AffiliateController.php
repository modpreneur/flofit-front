<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Services\Browser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AffiliateController
 *
 * @Route("/affiliate")
 * @package FloFitBundle\Controller
 */
class AffiliateController extends Controller
{
    /**
     * @Route("", name="affiliate")
     * @Route("/", name="affiliate_trailing")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $cbService = $this->get('clickbank_service');

        $newPrice = "$37.00";
        $oldPrice = "$74.99";

        $experiment = false;
        $experimentId = "109399886-10";

        $browser = $this->container->get("browser_detect_service");

        $vtid = "affiliate";

        if($browser->isMobile() || $browser->isTablet())
            $vtid = "mo".$vtid;

        $tid = "affiliate";
        if($request->query->has("utm_campaign"))
        {
            $tid = $request->query->get("utm_campaign");
        }

//        $videoSource = "https://player.vimeo.com/external/149957289.hd.mp4?s=4bbb74429080d458c96df4711a0113056faf8470&profile_id=113";
        $videoSource = "https://player.vimeo.com/external/154173671.sd.mp4?s=f5a4bafde312b8f8821d9e6988d5f976166fb7ef&profile_id=112";

        $ie = ($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_POCKET_IE || $browser->getBrowser() == "Windows" || $browser->getBrowser() == "Windows CE" );
        $mobile = $browser->isMobile() || $browser->isTablet();
        $useJW7 = $mobile && !$ie;

        $dBuyLink = $cbService->buyLink(598, 24663, $vtid, 13935);
        $pBuyLink = $cbService->buyLink(599, 24805, $vtid, 13935);
        $dpBuyLink = $cbService->buyLink(591, 21773, $vtid, 13358);

        return $this->render("FloFitBundle:Welcome:block-free-digital-both.html.twig", array(
            "videoSource" => $videoSource,
            "link" => $cbService->buyLink(567, 21773, $vtid, 13358),
            "linkFree" => $cbService->buyLink(598, 21773, $vtid, 13358),
            "linkDigital" => $cbService->buyLink(595, 21773, $vtid, 13358),
            "linkDigitalShipping" => $cbService->buyLink(596, 21773, $vtid, 13358),
            "linkGetStarted" => $cbService->buyLink(567, 21773, 'welnobumptest', 13358),
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
            'liveChat' => true
        ));
    }


}
