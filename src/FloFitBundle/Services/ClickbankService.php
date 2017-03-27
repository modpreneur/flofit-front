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
    private $necktieUrl;

    /**
     * ClickbankService constructor.
     */
    public function __construct($clickbankSite, $clickbankApiAuth, $necktieUrl)
    {
        $this->clickbankSite = $clickbankSite;
        $this->clickbankApiAuth = $clickbankApiAuth;
        $this->necktieUrl = $necktieUrl;
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

    /**
     * Return a buy link URL
     *
     * @param int $billingPlanId
     * @param string $cbFid
     * @param string $vtId
     * @param int $cbSkin
     *
     * @param string $cbf
     * @param string $cbur
     *
     * @return string
     */
    public function buyLink(
        int $billingPlanId,
        string $cbFid = null,
        string $vtId = null,
        int $cbSkin = null,
        string $cbf = null,
        string $cbur = null
    ) {
        return 'http://' . $this->necktieUrl . '/payment/click-bank/buy/billing/' . $billingPlanId.
            ($cbFid!==null? '?cbfid='. $cbFid : '') .
            ($vtId!==null? '&vtid=' . $vtId : '') .
            ($cbSkin!==null? '&cbskin=' . $cbSkin : '') .
            ($cbf!==null? '&cbf=' . $cbf : '') .
            ($cbur!==null? '&cbur=' . $cbur : '') .
            '&project=1';
    }
}
