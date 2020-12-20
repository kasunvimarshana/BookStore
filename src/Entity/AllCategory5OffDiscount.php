<?php

namespace App\Entity;

use App\Entity\Discountable;

/**
 * AllCategory 5% Off Discount Rule
 * @package App\Entity
 */
class AllCategory5OffDiscount extends Discountable{
    //
    /**
     * @Override
     */
    public function calculateDiscount() : float{
        return 0;
    }
}

?>