<?php

namespace App\Entity;

use App\Entity\Cart;

/**
 * Abstract Class Discountable
 * @package App\Entity
 */
abstract class Discountable{
    //
    /**
     * The Cart Object
     * @var Cart $cart
     */
    protected $cart;

    /**
     * Discount Name
     * @var string $name
     */
    protected $name;

    /**
     * Calculate Cart Discount
     * @return float
     */
    abstract public function calculateDiscount() : float;
    
    /**
     * Set the Cart Object
     * @param Cart $cart
     * @return void
     */
    final public function setCart(Cart $cart){
        $this->cart = $cart;
    }

    /**
     * Return the Cart Object
     * @return Cart
     */
    final public function getCart() : Cart{
        return $this->cart;
    }

    /**
     * Return Discount Name
     * @return string
     */
    final public function getName() : string{
        //
        return ($this->name) 
            ? $this->name : get_class($this);
    }

    /**
     * Set Discount Name
     * @param string
     */
    public function setName($name){
        //
        $this->name = $name;
    }
}

?>