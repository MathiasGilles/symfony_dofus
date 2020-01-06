<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Equipement;

class EquipementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $equipement= new Equipement();
            $equipement->setName("Equipement n°$i")
                    ->setPrice("20")
                    ->setPanoID("5");

            $manager->persist($equipement);
        }

        $manager->flush();
    }
}
