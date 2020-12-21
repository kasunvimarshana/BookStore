<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Category;
use App\Entity\Book;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager){
        // $product = new Product();
        // $manager->persist($product);
        $childrenCategory = new Category();
        $childrenCategory->setName("Children");
        $manager->persist($childrenCategory);

        $frictionCategory = new Category();
        $frictionCategory->setName("Friction");
        $manager->persist($frictionCategory);

        $manager->flush();

        $book = new Book();
        $book->setName("Book 1");
        $book->setPrice(100);
        $book->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nisi.");
        $book->setCategoryId($childrenCategory);
        $manager->persist($book);

        $book = new Book();
        $book->setName("Book 2");
        $book->setPrice(200);
        $book->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nisi.");
        $book->setCategoryId($childrenCategory);
        $manager->persist($book);

        $book = new Book();
        $book->setName("Book 3");
        $book->setPrice(300);
        $book->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nisi.");
        $book->setCategoryId($frictionCategory);
        $manager->persist($book);

        $book = new Book();
        $book->setName("Book 4");
        $book->setPrice(400);
        $book->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nisi.");
        $book->setCategoryId($frictionCategory);
        $manager->persist($book);

        $manager->flush();
    }

}
