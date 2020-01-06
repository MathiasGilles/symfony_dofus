<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Ressource;
use App\Form\RessourceType;
use App\Repository\RessourceRepository;


class RessourceController extends AbstractController
{
    /**
     * @Route("/ressource", name="ressource")
     */
    public function index(RessourceRepository $repo)
    {
        
        $ressources = $repo->findAll();

        return $this->render('ressource/index.html.twig', [
            'ressource' => $ressources
        ]);
    }

    /**
     * @Route("/ressource/new", name="ressource_new")
     * @Route("/ressource/edit/{id}", name="ressource_edit")
     */
    public function form(Ressource $ressource = null , Request $request , ObjectManager $manager)
    {
        if(!$ressource){
        $ressource= new Ressource();
        }

        $form= $this->createForm(RessourceType::class, $ressource  );

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager->persist($ressource);
            $manager->flush(); 

            return $this->redirectToRoute('ressource');
        }
                    
        return $this->render('ressource/ressource_new.html.twig',[
            'formRessource' => $form->createView(),
            'editMode' => $ressource->getId() !== null,
            'editTitle' => $ressource->getId() !== null
        ]);
        return $this->render('ressource/ressource_new.html.twig');
    }

    /**
     * @Route("ressource/delete/{id}", name="ressource_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Ressource::class);
        $ressource = $repository->find($id);

        $manager->remove($ressource);
        $manager->flush();
        
        return $this->redirectToRoute('ressource');
         
           }
}
 