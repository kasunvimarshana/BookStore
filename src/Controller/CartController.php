<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Discount\DiscountHelper;
use App\Entity\Cart\CartInterface;
use \Exception;
use App\Entity\Order;
use App\Entity\OrderBook;
use App\Entity\Book;

class CartController extends BaseController{
    //
    /**
    * Display a listing of Cart Items.
    * @Route("/cart", name="cart_index")
    * @return Response
    */
    public function index(CartInterface $cart, DiscountHelper $dh){
        //
        return $this->render('View/cart.html.twig', [
            'cart' => $cart,
        ]);
    }

    /**
    * Add Book to cart
    * @Route("/cart/add/{book}", name="cart_add_book")
    * @return Response
    */
    public function addBook($book, CartInterface $cart) : Response{
        //
        $cart->addItem($book);
        return $this->redirectToRoute('home');
    }

    /**
    * Remove Book from cart
    * @Route("/cart/remove/{book}", name="cart_remove_book")
    * @return Response
    */
    public function removeBook($book, CartInterface $cart) : Response{
        //
        $cart->deleteItem($book);
        return $this->redirectToRoute('home');
    }

    /**
    * Goto Checkot page
    * @Route("/cart/checkout", name="cart_checkout")
    * @return Response
    */
    public function checkout(CartInterface $cart, DiscountHelper $dh, Request $request) : Response{
        //
        $coupon_code = $request->get('coupon_code');
        try{
            $cart->clearDiscount();
            if($coupon_code){
                $dh->calculateDiscountUsingCoupoCode( $coupon_code );
            }else{
                $dh->calculateCartDiscount();
            }
        }catch(Exception $e){
            return $this->redirectToRoute('cart_index');
        }
        
        $action = $this->generateUrl('compleate_order', []);

        return $this->render('View/checkout.html.twig', [
            'cart' => $cart,
            'action' => $action
        ]);
    }
}

?>