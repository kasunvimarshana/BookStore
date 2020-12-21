<?php

namespace App\Entity\Discount;

use App\Entity\Cart\CartInterface;
use \Exception;
/**
 * Discount Helper Process The Discount
 * @package App\Entity\Discount
 */
class DiscountHelper{
    //
    /**
     * Cart
     * @var CartInterface $cart
     */
    private $cart;
    /**
     * Constructor
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart){
        $this->setCart($cart);
    }
    /**
     * Set Cart
     * @param CartInterface $cart
     * @return void
     */
    public function setCart(CartInterface $cart) : void{
        $this->cart = $cart;
    }
    /**
     * Return Cart
     * @return CartInterface
     */
    public function getCart() : CartInterface{
        return $this->cart;
    }

    /**
     * Calculate Discount Using Coupon
     * @param string $coupon
     * @return void
     * @throws Exception
     */
    public function calculateDiscountUsingCoupoCode( $coupon ) : void{
        try{
            $discount = new CouponCodeDiscount($this->getCart(), $coupon);
            $discount->calculateDiscount();
        }catch(Exception $e){
            throw $e;
        }
    }

    /**
     * Calculate Discount Using Coupon
     * @return void
     * @throws Exception
     */
    public function calculateCartDiscount() : void{
        try{
            foreach($this->discountRules() as $rule){
                $discount = new $rule( $this->getCart() );
                $discount->calculateDiscount();
            }
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * Return Discount Rules
     * @return array
     */
    private function discountRules() : array{
        return [
            AllCategory5OffDiscount::class,
            ChildrenCategory10OffDiscount::class
        ];
    }
}

?>