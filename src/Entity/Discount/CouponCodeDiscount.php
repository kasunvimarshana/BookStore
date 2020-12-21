<?php

namespace App\Entity\Discount;

use App\Entity\Discount\DiscountableInterface;
use App\Entity\Discount\CartDiscount;
use \Exception;
use App\Entity\Cart\CartInterface;

/**
 * Coupen Code Discount Rule
 * @package App\Entity\Discount
 */
class CouponCodeDiscount extends CartDiscount implements DiscountableInterface{
    //
    /**
     * Coupon Code
     * @var string $coupon_code
     */
    private $coupon_code;

    /**
     * Constructor
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart, $coupon_code){
        $this->coupon_code = $coupon_code;
        $this->setName("Coupon Code Discount");
        $this->setCart($cart);
    }
    /**
     * {@inheritdoc}
     */
    public function calculateDiscount() : void{
        //
        if( !$this->checkCouponCode() ){
            throw new Exception('Invalid Coupon Code');
        }

        $cart = $this->getCart();
        $sub_total = $cart->getSubTotal();
        $this->discount = ($sub_total / 100) * 15;
        $cart->addDiscount($this->getName(), $this->discount);
    }

    private function checkCouponCode(){
        return in_array($this->coupon_code, $this->getCouponCodes());
    }

    /**
     * Return Coupon Codes
     * @return array
     */
    private function getCouponCodes() : array{
        return [
            '000001',
            '000002',
            '000003',
            '000004',
            '000005'
        ];
    }
}

?>