<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class IndexController extends AbstractController{
    //
    /**
     * @Route("/asd", name="home")
     * @return Response
     */
    public function index() : Response {
        //return new Response("Home");
        return $this->render('base.html.twig', []);
    }
}

?>