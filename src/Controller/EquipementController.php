<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;

class EquipementController extends AbstractController
{
    /**
     * @Route("/equipement", name="equipement")
     */
    public function index(EquipementRepository $repo)
    {
        
        $equipements = $repo->findAll();

        return $this->render('equipement/index.html.twig', [
            'equipements' => $equipements
        ]);
    }

    /**
     * @Route("/equipement/new", name="equipement_new")
     * @Route("/equipement/edit/{id}", name="equipement_edit")
     */
    public function form(Equipement $equipement = null , Request $request , ObjectManager $manager)
    {
        if(!$equipement){
        $equipement= new Equipement();
        }

        $form= $this->createForm(EquipementType::class, $equipement  );

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager->persist($equipement);
            $manager->flush(); 

            return $this->redirectToRoute('equipement');
        }
                    
        return $this->render('equipement/equipement_new.html.twig',[
            'formEquipement' => $form->createView(),
            'editMode' => $equipement->getId() !== null,
            'editTitle' => $equipement->getId() !== null
        ]);
        return $this->render('equipement/equipement_new.html.twig');
    }

    /**
     * @Route("equipement/delete/{id}", name="equipement_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Equipement::class);
        $equipement = $repository->find($id);

        $manager->remove($equipement);
        $manager->flush();
        
        return $this->redirectToRoute('equipement');
         
           }

}
