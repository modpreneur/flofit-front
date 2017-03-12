<?php

namespace FloFitBundle\Controller;

use FloFitBundle\Services\Strikeiron;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ConfirmationController
 *
 * @Route("/affiliates")
 * @package FloFitBundle\Controller
 */
class AffiliatesController extends Controller
{
    const COOKIE = 'email-success-affiliatess';


    /**
     * @Route("/", name="affiliates")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        $showlinkLearnMore = null;
        $emailSuccess = false;

        $appendvtid = "flofitaff";
        $response = new Response();

        $cookies = $request->cookies->get(self::COOKIE);

        # if
        if ($cookies)
        {
            $emailSuccess = true;
        }

        return $this->render('FloFitBundle:Affiliates:view.html.twig', array(
            "appendvtid" => $appendvtid,
            "emailSuccess" => $emailSuccess,
            "showlinkLearnMore" => $showlinkLearnMore
        ));
    }


    /**
     * @Route("/check-email/", name="check-email")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function CheckEmailAction(Request $request)
    {
        $emailAddress = $request->get("emailAddress");
        $list = $request->get("list");

        $strikeIron = $this->get("strikeiron_service");
        $maropost = $this->get("maropost_connector_service");
        $payload = $strikeIron->checkEmailAndGetResponseArray($emailAddress);
        if($payload["is-ok"])
        {
            $subs = $maropost->subscribeLists($emailAddress, $list);

            $response = new JsonResponse($subs);
            $response->headers->setCookie(new Cookie(self::COOKIE, 1, time() + 183 * 3600 * 24));

            return $response;
        }
        else
        {
            return new JsonResponse();
        }
    }


}