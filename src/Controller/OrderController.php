<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Cart\CartInterface;
use \Exception;
use App\Entity\Order;
use App\Entity\OrderBook;
use App\Entity\Book;

class OrderController extends BaseController{
    /**
    * Display a listing of Orders.
    * @Route("/order", name="order_index")
    * @return Response
    */
    public function index(){
        //
        $orderRepository = $this->getDoctrine()->getRepository(Order::class);
        $orders = $orderRepository->findAll();

        return $this->render('View/order.html.twig', [
            'orders' => $orders,
        ]);
    }
    /**
    * Compleate Order
    * @Route("/order/compleate", name="compleate_order")
    * @return Response
    */
    public function completeOrder(Request $request, CartInterface $cart) : Response{
        //
        $entityManager = $this->getDoctrine()->getManager();
        $orderRepository =  $entityManager->getRepository(Order::class);
        $orderBookRepository = $entityManager->getRepository(OrderBook::class);
        $bookRepository = $entityManager->getRepository(Book::class);

        $cart_sub_total = $cart->getSubTotal();
        $cart_discount = $cart->getDiscountSum();
        $billing_address = $request->get('billing_address');

        $order = new Order();
        $order->setBillingAddress( $billing_address );
        $order->setAmount( $cart_sub_total );
        $order->setDiscount( $cart_discount );
        $entityManager->persist($order);
        $entityManager->flush();
        foreach( $cart->getCart() as $k => $v ){
            $orderBook = new OrderBook();
            $orderBook->setQuantity($v['quantity']);
            $orderBook->setUnitPrice($v['price']);
            $orderBook->setOrderId($order);
            $orderBook->setBookId( $bookRepository->find($k) );
            $entityManager->persist($orderBook);
            $entityManager->flush();
        }

        $cart->clearCart();
        return $this->redirectToRoute('home');
    }
}

?>