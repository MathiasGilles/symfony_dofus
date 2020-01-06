<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Panoplie;
use App\Form\PanoplieType;
use App\Repository\PanoplieRepository;


class PanoplieController extends AbstractController
{
    /**
     * @Route("/panoplie", name="panoplie")
     */
    public function index(PanoplieRepository $repo)
    {
        
        $panoplie = $repo->findAll();

        return $this->render('panoplie/index.html.twig', [
            'panoplies' => $panoplie
        ]);
    }

    /**
     * @Route("/panoplie/new", name="panoplie_new")
     * @Route("/panoplie/edit/{id}", name="panoplie_edit")
     */
    public function form(Panoplie $panoplie = null , Request $request , ObjectManager $manager)
    {
        if(!$panoplie){
        $panoplie= new Panoplie();
        }
        
        $form= $this->createForm(PanoplieType::class, $panoplie  );

        $form->handleRequest($request);
        
        if($form->isSubmitted()){

            $manager->persist($panoplie);
            $manager->flush();
           

            return $this->redirectToRoute('panoplie');
        }
                    
        return $this->render('panoplie/panoplie_new.html.twig',[
            'formPanoplie' => $form->createView(),
            'editMode' => $panoplie->getId() !== null,
            'editTitle' => $panoplie->getId() !== null
        ]);
        return $this->render('panoplie/panoplie_new.html.twig');
    }

    /**
     * @Route("panoplie/delete/{id}", name="panoplie_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Panoplie::class);
        $panoplie = $repository->find($id);

        $manager->remove($panoplie);
        $manager->flush();
        
        return $this->redirectToRoute('panoplie');
         
           }
}
 