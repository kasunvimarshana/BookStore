<?php

namespace App\Entity;

use App\Entity\Discountable;

/**
 * Coupen Code Discount Rule
 * @package App\Entity
 */
class CouponCodeDiscount extends Discountable{
    //
    /**
     * @Override
     */
    public function calculateDiscount() : float{
        return 0;
    }
}

?>