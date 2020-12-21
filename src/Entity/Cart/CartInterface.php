<?php

namespace App\Entity\Cart;

/**
 * Interface Cart
 * @package App\Entity\Cart
 */
interface CartInterface {
    /**
     * Add Cart Item
     * @param int $id
     * @return void
     */
    public function addItem($id) : void;
    /**
     * Update Cart Item
     * @param int $id
     * @param int $quantity
     * @return void
     */
    public function updateItem($id, $quantity) : void;
    /**
     * Delete Cart Item
     * @param int $id
     * @return void
     */
    public function deleteItem($id) : void;
    /**
     * Return Cart Item Count
     * @return int
     */
    public function countItems() : int;
    /**
     * Add Cart Items as Array [[ 0 => id, 1 => quantity]]
     * @param int $id
     * @param int $quantity
     * @return void
     */
    public function getCart() : array;
    /**
     * Check Cart Item is exists or not
     * @param int $id
     * @return bool
     */
    public function isItemExists($id) : bool;
    /**
     * Add Cart Discount
     * @param string $discount_name
     * @param float $amount
     * @return void
     */
    public function addDiscount($discount_name, $amount) : void;
    /**
     * Update Discount by name
     * @param string $discount_name
     * @param float $amount
     * @return void
     */
    public function updateDiscount($discount_name, $amount) : void;
    /**
     * Delete Discount by name
     * @param string $discount_name
     * @return void
     */
    public function deleteDiscount($discount_name) : void; 
    /**
     * Check Discount is exists or not
     * @param string $discount_name
     * @return bool
     */
    public function isDiscountExists($discount_name) : bool;
    /**
     * Return Cart Discounts as Array [[0 => name, 1 => value]]
     * @return array
     */
    public function getDiscount() : array;
    /**
     * Clear Cart
     * @return void
     */
    public function clearCart() : void;
    /**
     * Clear Cart Discount
     * @return void
     */
    public function clearDiscount() : void;  
    /**
     * Return Cart Sub Total
     * @return float
     */
    public function getSubTotal() : float;
    /**
     * Return Sum of Cart Discount
     * @return float
     */
    public function getDiscountSum() : float;
    /**
     * Return Cart Total [subtotal - discount]
     * @return float
     */
    public function getTotal() : float;
}

?>