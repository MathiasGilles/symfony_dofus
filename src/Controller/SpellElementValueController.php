<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpellElementValueController extends AbstractController
{
    /**
     * @Route("/spell/element/value", name="spell_element_value")
     */
    public function index()
    {
        return $this->render('spell_element_value/index.html.twig', [
            'controller_name' => 'SpellElementValueController',
        ]);
    }
}
