<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use App\Entity\Category;

class IndexController extends BaseController{
    //
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(Request $request) : Response {
        $search = $request->get('search');
        $entityManager = $this->getDoctrine()->getManager();
        $bookRepository = $entityManager->getRepository(Book::class);

        $query = $bookRepository->createQueryBuilder('b')
            ->join('b.category_id', 'c')
            ->where('c.name LIKE :c_name')
            ->setParameter('c_name', '%'.$search.'%')
            ->getQuery();

        $books = $query->getResult();

        return $this->render('View/home.html.twig', [
            'books' => $books
        ]);
    }
}

?>