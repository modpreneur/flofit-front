<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 17.12.15
 * Time: 17:08
 */

namespace FloFitBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;

class MaropostConnector {

    protected $serviceContainer;
    const TOKEN = "05a55cea6962eedc1afcd80881d6f9937a76927d";
    const ACCONT_ID = 478;

    const URL_BASE = "http://api.maropost.com/accounts/";
    const URL_CONTACT = "/contacts/email.json?contact[email]=";
    const URL_SUBSCRIBE= "/lists/%d/contacts";


    /**
     * MaropostConnector constructor.
     *
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->serviceContainer = $containerInterface;
    }

    private function getToken()
    {
        return $this::TOKEN;
    }

    private function getAccountId()
    {
        return $this::ACCONT_ID;
    }

    private function getUrl($nextPart)
    {
        if(strpos($nextPart,"?") === false)
            return self::URL_BASE . $this->getAccountId() . $nextPart . "?auth_token=" . $this->getToken();

        return self::URL_BASE . $this->getAccountId() . $nextPart . "&auth_token=" . $this->getToken();
    }

    public function getUserInfo($email)
    {

        $curl = curl_init($this->getUrl(self::URL_CONTACT . $email));

        $headers = array(
            "Content-Type: application/json",
            "Accept: application/json",
        );

        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);

        $response = curl_exec($curl);

        $jsonResponse = json_decode($response,true);

        return $jsonResponse;
    }

    public function getMaropostUserId($email)
    {
        $userInfo = $this->getUserInfo($email);

        if(is_null($userInfo))
            return 0;

        return $userInfo["id"];
    }

    public function subscribeLists($email, $list)
    {
        return $this->listAPI($email, $list);
    }

    private function listAPI($email, $list)
    {
        $url = $this->getUrl(sprintf(self::URL_SUBSCRIBE, $list));

        $curl = curl_init($url);

        $headers = array(
            "Content-Type: application/json",
            "Accept: application/json",
        );

        $data = array(
            "contact" => array(
                "email" => $email
            )
        );

        $jsonData = json_encode($data);

        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($curl,CURLOPT_POSTFIELDS,$jsonData);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);

        $response = curl_exec($curl);

        $jsonResponse = json_decode($response,true);

        return $jsonResponse;
    }

} 