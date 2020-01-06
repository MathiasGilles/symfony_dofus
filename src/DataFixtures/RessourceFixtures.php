<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Ressource;

class RessourceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $ressource= new Ressource();
            $ressource->setName("Ressource n°$i")
                    ->setDescription("Description de la ressource n°$i")
                    ->setPrice("20")
                    ->setMonster("Abraknyde");

            $manager->persist($ressource);
        }

        $manager->flush();
    }
}
