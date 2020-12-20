<?php

namespace App\Entity;

use App\Entity\Discountable;

/**
 * Children Category 5% Off Discount Rule
 * @package App\Entity
 */
class Children10OffDiscount extends Discountable{
    //
    /**
     * @Override
     */
    public function calculateDiscount() : float{
        return 0;
    }
}

?>