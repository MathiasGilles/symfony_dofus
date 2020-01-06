<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Monster;
use App\Form\MonsterType;
use App\Repository\MonsterRepository;


class MonsterController extends AbstractController
{
    /**
     * @Route("/monster", name="monster")
     */
    public function index(MonsterRepository $repo)
    {
        
        $monster = $repo->findAll();

        return $this->render('monster/index.html.twig', [
            'monster' => $monster
        ]);
    }

    /**
     * @Route("/monster/new", name="monster_new")
     * @Route("/monster/edit/{id}", name="monster_edit")
     */
    public function form(Monster $monster = null , Request $request , ObjectManager $manager)
    {
        if(!$monster){
        $monster= new Monster();
        }

        $form= $this->createForm(MonsterType::class, $monster  );
        
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager->persist($monster);
            $manager->flush(); 

            return $this->redirectToRoute('monster');
        }
                    
        return $this->render('monster/monster_new.html.twig',[
            'formMonster' => $form->createView(),
            'editMode' => $monster->getId() !== null,
            'editTitle' => $monster->getId() !== null
        ]);
        return $this->render('monster/monster_new.html.twig');
    }

    /**
     * @Route("monster/delete/{id}", name="monster_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Monster::class);
        $monster = $repository->find($id);

        $manager->remove($monster);
        $manager->flush();
        
        return $this->redirectToRoute('monster');
         
           }
}