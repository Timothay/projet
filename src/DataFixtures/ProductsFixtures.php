<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Products;
use App\Entity\Category;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
        $category=new Category();
        $category->setName("sweat");
          $manager->persist($category);
        for ($i=1;$i<=10;$i++){
            $products=new Products();
            $products->setName("Produit n°$i")
                     ->setPrice("$i")
                     ->setCategory($category);
            $manager->persist($products);
        }

        $manager->flush();
    }
}
