<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;

class CategoryController extends BaseController{
    //
    /**
    * Display a listing of Categories.
    */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new Category.
     * @Route("/categories/create", name="category_create")
     * @return Response
     */
    public function create(){
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        $action = $this->generateUrl('category_store');
        return $this->render('Category/create.html.twig', [
            'action' => $action,
            'categories' => $categories
        ]);
    }

    /**
    * Store a newly created Category in Database.
    * @Route("/categories/store", name="category_store")
    * @return Response
    */
    public function store(Request $request){
        //
        $entityManager = $this->getDoctrine()->getManager();
        $name = $request->get('name');
        $category = new Category();
        $category->setName( $name );
        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('category_create');
    }

    /**
    * Display the specified Category.
    */
    public function show($id){
        //
    }

    /**
    * Show the form for editing the specified Category.
    * @Route("/categories/edit/{id}", name="category_edit")
    * @return Response
    */
    public function edit($id){
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->findOneBy(array('id' => $id));
        $action = $this->generateUrl('category_update', [
            'id' => $id
        ]);
        return $this->render('Category/edit.html.twig', [
            'action' => $action,
            'category' => $category
        ]);
    }

    /**
    * Update the specified Category in Database.
    * @Route("/categories/update/{id}", name="category_update")
    * @return Response
    */
    public function update($id, Request $request){
        //
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(Category::class);
        $category = $repository->find($id);
        $name = $request->get('name');
        
        $category->setName( $name );
        $entityManager->flush();

        return $this->redirectToRoute('category_create');
    }

    /**
    * Remove the specified Category from Database.
    * @Route("/categories/destroy/{id}", name="category_destroy")
    * @return Response
    */
    public function destroy($id){
        //
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(Category::class);
        $category = $repository->find($id);
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('category_create');
    }
}

?>