<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\AttributRepository;
use App\Entity\Attribut;
use App\Form\AttributType;

use Doctrine\Common\Persistence\ObjectManager;

class AttributController extends AbstractController
{
    /**
     * @Route("/attribut", name="attribut")
     */
    public function index(AttributRepository $repo)
    {
        
        $attribut = $repo->findAll();

        return $this->render('attribut/index.html.twig', [
            'attribut' => $attribut
        ]);
    }

    /**
     * @Route("/attribut/new", name="attribut_new")
     * @Route("/attribut/edit/{id}", name="attribut_edit")
     */
    public function form(Attribut $attribut = null , Request $request , ObjectManager $manager)
    {
        if(!$attribut){
        $attribut= new Attribut();
        }

        $form= $this->createForm(AttributType::class, $attribut  );

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager->persist($attribut);
            $manager->flush(); 

            return $this->redirectToRoute('attribut');
        }
                    
        return $this->render('attribut/attribut_new.html.twig',[
            'formAttribut' => $form->createView(),
            'editMode' => $attribut->getId() !== null,
            'editTitle' => $attribut->getId() !== null
        ]);
        return $this->render('attribut/attribut_new.html.twig');
    }

    /**
     * @Route("attribut/delete/{id}", name="attribut_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Attribut::class);
        $attribut = $repository->find($id);

        $manager->remove($attribut);
        $manager->flush();
        
        return $this->redirectToRoute('attribut');
         
           }
}
