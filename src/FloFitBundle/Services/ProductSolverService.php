<?php
/**
 * Created by PhpStorm.
 * User: ondrejbohac
 * Date: 26.10.16
 * Time: 12:38
 */

namespace FloFitBundle\Services;


use Doctrine\Bundle\DoctrineBundle\Registry;
use FloFitBundle\Entity\ClickbankProduct;
use FloFitBundle\Entity\Product;

class ProductSolverService
{
    private $clickbankService;
    private $doctrine;

    /**
     * ProductSolverService constructor.
     */
    public function __construct(ClickbankService $clickbankService, Registry $doctrine)
    {
        $this->clickbankService = $clickbankService;
        $this->doctrine = $doctrine;
    }

    public function findProduct($cbSku)
    {
        $entityManager = $this->doctrine->getManager();

        $product = $entityManager->getRepository('FloFitBundle\Entity\ClickbankProduct')
            ->findOneBy(array('sku' => $cbSku));

        if(null == $product)
        {
            $productInfo = $this->clickbankService->getProductInfo($cbSku);

            if(null !== $productInfo)
            {
                $product = $this->createProductFromClickbankResponse($productInfo);

                $entityManager->persist($product);
                $entityManager->flush();
            }
        }

        return $product;
    }

    private function createProductFromClickbankResponse($clickbankResponse)
    {
        $product = new ClickbankProduct();
        $product->setSku($clickbankResponse['@sku']);
        $product->setSite($clickbankResponse['site']);
        $product->setDigital($clickbankResponse['digital'] == "true");
        $product->setPhysical($clickbankResponse['physical'] == "true");
        $product->setDigitalRecuring($clickbankResponse['digitalRecurring'] == "true");
        $product->setPhysicalRecuring($clickbankResponse['physicalRecurring'] == "true");

        $product->setTitle($clickbankResponse['title']);

        $product->setFirstPrice($clickbankResponse['pricings']['pricing']['standard']['price']['native_price']);

        if(isset($clickbankResponse['pricings']['pricing']['recurring']))
        {
            $product->setSecondPrice($clickbankResponse['pricings']['pricing']['recurring']['price']['native_price']);
            $product->setRecuringFrequency($clickbankResponse['pricings']['pricing']['recurring']['frequency']);
            $product->setDuration($clickbankResponse['pricings']['pricing']['recurring']['duration']);
            $product->setTrialDays($clickbankResponse['pricings']['pricing']['recurring']['trial_days']);
        }

        return $product;
    }
}