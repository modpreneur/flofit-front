<?php

namespace FloFitBundle\Services;

use Doctrine\ORM\EntityManager;

/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 09.11.15
 * Time: 14:50
 */
class ClickbankService
{
    private $clickbankApiAuth;
    private $clickbankSite;

    /**
     * ClickbankService constructor.
     */
    public function __construct($clickbankSite, $clickbankApiAuth)
    {
        $this->clickbankSite = $clickbankSite;
        $this->clickbankApiAuth = $clickbankApiAuth;
    }

    public function getProductInfo($cbId)
    {
        $params = array();
        $params['site'] = $this->clickbankSite;

        $URL = "https://api.clickbank.com/rest/1.3/products/{$cbId}?" . http_build_query($params);

        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Length: 0',
                'Accept: application/json',
                "Authorization: {$this->clickbankApiAuth}",
            ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = json_decode(curl_exec($ch), true);

        curl_close($ch);

        return $result;
    }
}