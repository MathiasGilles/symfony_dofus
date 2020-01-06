<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Panoplie;

class PanoplieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $panoplie= new Panoplie();
            $panoplie->setName("Panoplie n°$i")
                    ->setDescription("Description de la panoplie n°$i")
                    ->setPrice("20")
                    ->setEquipement("coiffe bouftou");

            $manager->persist($panoplie);
        }

        $manager->flush();
    }
}
