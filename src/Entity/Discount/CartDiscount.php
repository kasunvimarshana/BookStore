<?php

namespace App\Entity\Discount;

use App\Entity\Discount\DiscountableInterface;
use App\Entity\Cart\CartInterface;
use \Exception;
//use Doctrine\ORM\EntityManagerInterface;

/**
 * Abstract Class Cart Discount
 * @package App\Entity\Discount
 */
abstract class CartDiscount implements DiscountableInterface{
    //
    /**
     * The Cart Object
     * @var CartInterface $cart
     */
    protected $cart;

    /**
     * Discount Name
     * @var string $name
     */
    protected $name;

    /**
     * Discount Value
     * @var float $discount
     */
    protected $discount;

    /**
     * Calculate Cart Discount And Set
     * @return void
     * @throws Exception
     */
    abstract public function calculateDiscount() : void;
    
    /**
     * Set the Cart Object
     * @param Cart $cart
     * @return void
     */
    public function setCart(CartInterface $cart) : void{
        $this->cart = $cart;
    }

    /**
     * Set Discount Name
     * @param string
     */
    public function setName($name) : void{
        $this->name = $name;
    }

    /**
     * Return the Cart Object
     * @return Cart
     */
    public function getCart() : CartInterface{
        return $this->cart;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() : string{
        return ($this->name) ? $this->name : get_class($this);
    }

    /**
     * {@inheritdoc}
     */
    public function getDiscount() : float{
        return $this->discount;
    }
}

?>