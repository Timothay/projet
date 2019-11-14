<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Activities;

class EvenementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1;$i<=10;$i++){
        $activities = new Activities();
        $activities->setName("Activité n°$i")
                     ->setDescription("Description de l'activité")
                     ->setDate(new \DateTime())
                     ->setImage("https://picsum.photos/200/300");
                     
        $manager->persist($activities);
        }

        $manager->flush();
    }
}
