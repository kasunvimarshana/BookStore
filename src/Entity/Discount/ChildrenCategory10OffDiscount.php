<?php

namespace App\Entity\Discount;

use App\Entity\Discount\DiscountableInterface;
use App\Entity\Discount\CartDiscount;
use \Exception;
use App\Entity\Cart\CartInterface;

/**
 * Children Category 10% Off Discount Rule
 * @package App\Entity\Discount
 */
class ChildrenCategory10OffDiscount extends CartDiscount implements DiscountableInterface{
    //
    /**
     * Constructor
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart){
        $this->setName("10% Off Discount");
        $this->setCart($cart);
    }

    /**
     * {@inheritdoc}
     */
    public function calculateDiscount() : void{
        //
        $cart = $this->getCart();
        $sub_total = $cart->getSubTotal();
        $books = [];
        foreach($cart->getCart() as $k => $v){
            if( strcasecmp($v['categroy'], "Children") === 0 ){
                $books[$k] = $v;
            }
        }
        $book_count = array_sum(array_column($books, 'quantity'));
        if( $book_count > 5 ){
            $book_amount = array_sum(array_column($books, 'amount'));
            $this->discount = ($book_amount / 100) * 10;
            $cart->addDiscount($this->getName(), $this->discount);
        }
    }
}

?>