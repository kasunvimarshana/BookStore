<?php

namespace App\Entity\Discount;

/**
 * Interface Discountable
 * @package App\Entity\Discount
 */
interface DiscountableInterface{
    //
    /**
     * Return the Discount
     * @return float
     */
    public function getDiscount() : float;

    /**
     * Return Discount Name
     * @return string
     */
    public function getName() : string;
}

?>