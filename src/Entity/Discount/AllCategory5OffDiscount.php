<?php

namespace App\Entity\Discount;

use App\Entity\Discount\DiscountableInterface;
use App\Entity\Discount\CartDiscount;
use \Exception;
use App\Entity\Cart\CartInterface;

/**
 * All Category 5% Off Discount Rule
 * @package App\Entity\Discount
 */
class AllCategory5OffDiscount extends CartDiscount implements DiscountableInterface{
    //
    /**
     * Constructor
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart){
        $this->setName("5% Off Discount");
        $this->setCart($cart);
    }

    /**
     * {@inheritdoc}
     */
    public function calculateDiscount() : void{
        //
        $cart = $this->getCart();
        $sub_total = $cart->getSubTotal();
        $quantity = $cart->countItems();
        $book_count = array_sum(array_column($cart->getCart(), 'quantity'));
        if( $book_count > 10 ){
            $book_amount = array_sum(array_column($cart->getCart(), 'amount'));
            $this->discount = ($book_amount / 100) * 5;
            $cart->addDiscount($this->getName(), $this->discount);
        }
    }
}

?>