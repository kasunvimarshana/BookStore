<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;
use App\Entity\Category;

class BookController extends BaseController{
    //
    /**
    * Display a listing of Books.
    */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new Book.
     * @Route("/books/create", name="book_create")
     * @return Response
     */
    public function create(){
        $bookRepository = $this->getDoctrine()->getRepository(Book::class);
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $books = $bookRepository->findAll();
        $categories = $categoryRepository->findAll();
        $action = $this->generateUrl('book_store');
        return $this->render('Book/create.html.twig', [
            'action' => $action,
            'books' => $books,
            'categories' => $categories
        ]);
    }

    /**
    * Store a newly created Book in Database.
    * @Route("/books/store", name="book_store")
    * @return Response
    */
    public function store(Request $request){
        //
        $entityManager = $this->getDoctrine()->getManager();
        $categoryRepository = $entityManager->getRepository(Category::class);
        $name = $request->get('name');
        $price = $request->get('price');
        $category_id = $request->get('category_id');
        $description = $request->get('description');

        $category = $categoryRepository->find($category_id);

        $book = new Book();
        $book->setName( $name );
        $book->setPrice( $price );
        $book->setCategoryId( $category );
        $book->setDescription( $description );
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_create');
    }

    /**
    * Display the specified Book.
    */
    public function show($id){
        //
    }

    /**
    * Show the form for editing the specified Book.
    * @Route("/books/edit/{id}", name="book_edit")
    * @return Response
    */
    public function edit($id){
        $bookRepository = $this->getDoctrine()->getRepository(Book::class);
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $book = $bookRepository->findOneBy(array('id' => $id));
        $categories = $categoryRepository->findAll();
        $action = $this->generateUrl('book_update', [
            'id' => $id
        ]);
        return $this->render('Book/edit.html.twig', [
            'action' => $action,
            'book' => $book,
            'categories' => $categories
        ]);
    }

    /**
    * @Route("/books/update/{id}", name="book_update")
    * @return Response
    */
    public function update($id, Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $bookRepository =  $entityManager->getRepository(Book::class);
        $categoryRepository = $entityManager->getRepository(Category::class);
        $book = $bookRepository->find($id);
        $name = $request->get('name');
        $price = $request->get('price');
        $category_id = $request->get('category_id');
        $description = $request->get('description');
        $category = $categoryRepository->find($category_id);
        $book->setName( $name );
        $book->setPrice( $price );
        $book->setCategoryId( $category );
        $book->setDescription( $description );
        $entityManager->flush();

        return $this->redirectToRoute('book_create');
    }

    /**
    * Remove the specified Book from Database.
    * @Route("/books/destroy/{id}", name="book_destroy")
    * @return Response
    */
    public function destroy($id){
        //
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(Book::class);
        $book = $repository->find($id);
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_create');
    }
}

?>