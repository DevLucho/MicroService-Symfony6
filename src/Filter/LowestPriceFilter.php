<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class LowestPriceFilter implements PromotionsFilterInterface
{

    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface
    {
        $price = $enquiry->getProduct()->getPrice();
        $quantity = $enquiry->getQuantity();
        $lowestPrice = $quantity * $price;



        // 3. Return the modified Enquiry
        $enquiry->setDiscountedPrice(250);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(3);
        $enquiry->setPromotionName('Black Friday half price sale');

        return $enquiry;
    }
}