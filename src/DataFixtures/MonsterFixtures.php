<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Monster;

class MonsterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $monster= new Monster();
            $monster->setName("Monstre n°$i")
                    ->setDescription("Description du monstre n°$i")
                    ->setFindWhere("tainela")
                    ->setRessource("poudre de perlimpinpin");

            $manager->persist($monster);
        }

        $manager->flush();
    }
}
