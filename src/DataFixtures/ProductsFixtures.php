<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Products;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1;$i<=10;$i++){
            $products=new Products();
            $products->setName("Produit n°$i")
                     ->setPrice("$i");
            $manager->persist($products);
        }

        $manager->flush();
    }
}
