<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 09.03.15
 * Time: 22:06
 */

namespace FloFitBundle\Services;

use Assetic\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Strikeiron {

    protected $serviceContainer;
    const USER_ID = "41E2BC484DF888C6E440";
    const PASSWORD = null;

    const TIMEOUT = 30;
    const WSDL = 'http://ws.strikeiron.com/emv6Hygiene?WSDL';
    const THRESHOLD = 212;

    const BAD_EMAIL_ADDRESS_MESSAGE = "Sorry, your email is invalid or service is not available.";


    /**
     * Strikeiron constructor.
     *
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->serviceContainer = $containerInterface;
    }

    public function checkEmail($emailAddress)
    {
        $client = new \SoapClient(self::WSDL, array('trace' => 1, 'exceptions' => 1));

        $registered_user = array("RegisteredUser" => array("UserID" => self::USER_ID,"Password" => self::PASSWORD));
        $header = new \SoapHeader("http://ws.strikeiron.com", "LicenseInfo", $registered_user);

        $client->__setSoapHeaders($header);

        try
        {
            $params = array("Email" => $emailAddress,"Timeout" => self::TIMEOUT);

            $result = $client->__soapCall("VerifyEmail", array($params), null, null, $output_header);

            if(0 == $output_header['SubscriptionInfo']->RemainingHits)
            {
                return false;
            }

            return self::THRESHOLD >= $result->VerifyEmailResult->ServiceResult->Reason->Code;
        }
        catch (Exception $ex)
        {
            return false;
        }
    }

    public function checkEmailAndGetResponseArray($emailAddress)
    {
        if($this->checkEmail($emailAddress))
        {
            return array("is-ok" => true);
        }
        else
        {
            return array("is-ok" => false, "message" =>self::BAD_EMAIL_ADDRESS_MESSAGE);
        }
    }
}
