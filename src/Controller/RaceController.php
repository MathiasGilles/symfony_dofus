<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Race;
use App\Form\RaceType;
use App\Repository\RaceRepository;


class RaceController extends AbstractController
{
    /**
     * @Route("/race", name="race")
     */
    public function index(RaceRepository $repo)
    {
        
        $race = $repo->findAll();

        return $this->render('race/index.html.twig', [
            'race' => $race
        ]);
    }

    /**
     * @Route("/race/new", name="race_new")
     * @Route("/race/edit/{id}", name="race_edit")
     */
    public function form(Race $race = null , Request $request , ObjectManager $manager)
    {
        if(!$race){
        $race= new Race();
        }

        $form= $this->createForm(RaceType::class, $race  );

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager->persist($race);
            $manager->flush(); 

            return $this->redirectToRoute('race');
        }
                    
        return $this->render('race/race_new.html.twig',[
            'formRace' => $form->createView(),
            'editMode' => $race->getId() !== null,
            'editTitle' => $race->getId() !== null
        ]);
        return $this->render('race/race_new.html.twig');
    }

    /**
     * @Route("race/delete/{id}", name="race_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Race::class);
        $race = $repository->find($id);

        $manager->remove($race);
        $manager->flush();
        
        return $this->redirectToRoute('race');
         
           }
}
 