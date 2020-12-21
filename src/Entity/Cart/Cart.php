<?php

namespace App\Entity\Cart;

use App\Entity\Cart\CartInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;

/**
 * Cart
 * @package App\Entity\Cart
 */
class Cart implements CartInterface{
    //
    /**
     * Session Storage
     * @var SessionInterface $session
     */
    private $session;

    /**
     * Entity Manager
     * @var EntityManagerInterface $em
     */
    private $em;

    /**
     * Cart Value
     * @var array $cart
     */
    private $cart;

    /**
     * Cart Name
     * @var string $name
     */
    private $name;

    public function __construct(SessionInterface $session, EntityManagerInterface $em){
        $this->session = $session;
        $this->em = $em;
        $this->init();
    }

    /**
     * Init
     * @return void
     */
    public function init(){
        $this->name = "book_cart";
        //if( $this->session->has($this->name) ){ }
        $this->read();
    }

    /**
     * {@inheritdoc}
     */
    public function addItem($id) : void{
        if( $this->isItemExists($id) ){
            /*array_walk($this->cart['items'], function (&$value, $key) use ($id){
                if($key === $id){ 
                    $value = $value + 1;
                }
            });*/
            $this->updateItem($id, ($this->cart['items'][$id]['quantity'] + 1));
        }else{
            $book = $this->em->getRepository(Book::class)
                ->findOneBy(['id'=>$id]);

            $this->cart['items'][$id] = [
                'name' => $book->getName(),
                'categroy' => $book->getCategoryId()->getName(),
                'quantity' => 1,
                'price' => $book->getPrice(),
                'amount' => ($book->getPrice() * 1)
            ];
        }
        $this->write();
    }
    /**
     * {@inheritdoc}
     */
    public function updateItem($id, $quantity) : void{
        $this->cart['items'][$id]['quantity'] = $quantity;
        $amount = ($this->cart['items'][$id]['price'] * $quantity);
        $this->cart['items'][$id]['amount'] = $amount;
        $this->write();
    }
    /**
     * {@inheritdoc}
     */
    public function deleteItem($id) : void{
        /*if (($key = array_search($id, $this->getCart())) !== false) {
            array_splice($this->cart['items'], $key, 1);
            $this->write();
            die($key);
        }*/ 
        if ( array_key_exists($id, $this->getCart()) ) {
            unset($this->cart['items'][$id]); 
            $this->write();
        } 
    }
    /**
     * {@inheritdoc}
     */
    public function countItems() : int{
        //return count($this->getCart());
        return array_sum(array_column($this->getCart(), 'quantity'));
    }
    /**
     * {@inheritdoc}
     */
    public function getCart() : array{
        return $this->cart['items'] ?? [];
    }
    /**
     * {@inheritdoc}
     */
    public function isItemExists($id) : bool{
        return array_key_exists($id, $this->getCart());
    }
    /**
     * {@inheritdoc}
     */
    public function addDiscount($discount_name, $amount) : void{
        if( $this->isDiscountExists($discount_name) ){
            $this->updateDiscount($discount_name, $amount);
        }else{
            $this->cart['discounts'][$discount_name] = [
                'name' => $discount_name,
                'amount' => $amount
            ];
        }
        $this->write();
    }
    /**
     * {@inheritdoc}
     */
    public function updateDiscount($discount_name, $amount) : void{
        $this->cart['discounts'][$discount_name] = [
            'name' => $discount_name,
            'amount' => $amount
        ];
        $this->write();
    }
    /**
     * {@inheritdoc}
     */
    public function deleteDiscount($discount_name) : void{
        if (($key = array_search($discount_name, $this->getDiscount())) !== false) {
            array_splice($this->cart['discounts'], $key, 1);
            $this->write();
        }
    }
    /**
     * {@inheritdoc}
     */
    public function isDiscountExists($discount_name) : bool{
        return array_key_exists($discount_name, $this->getDiscount());
    }
    /**
     * {@inheritdoc}
     */
    public function getDiscount() : array{
        return $this->cart['discounts'] ?? [];
    }
    /**
     * {@inheritdoc}
     */
    public function clearCart() : void{
        $this->session->remove( $this->name );
    }
    /**
     * {@inheritdoc}
     */
    public function clearDiscount() : void{
        $this->cart['discounts'] = [];
        $this->write();
    }
    /**
     * {@inheritdoc}
     */
    public function getSubTotal() : float{
        return array_sum(array_column($this->getCart(), 'amount'));
    }
    /**
     * {@inheritdoc}
     */
    public function getDiscountSum() : float{
        return array_sum(array_column($this->getDiscount(), 'amount'));
    }
    /**
     * {@inheritdoc}
     */
    public function getTotal() : float{
        return $this->getSubTotal() - $this->getDiscountSum();
    }
    /**
     * Read Cart Data
     * @return void
     */
	private function read(){
		$this->cart = $this->session->get($this->name, []);
	}

	/**
     * Write Cart Data
     * @return void
     */
	private function write(){
        $this->session->set($this->name, $this->cart);
	}
}

?>