<?php

namespace App\Controller;

use App\Entity\Element;
use App\Form\ElementType;
use App\Repository\ElementRepository;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ElementController extends AbstractController
{
    /**
     * @Route("/element", name="element")
     */
    public function index(ElementRepository $repo)
    {
        
        $element = $repo->findAll();

        return $this->render('element/index.html.twig', [
            'element' => $element
        ]);
    }

    /**
     * Require ROLE_ADMIN for only this controller method.
     * @Route ("/element/new", name="element_new")
     * @Route("/element/edit/{id}", name="element_edit")
     * /**
     */
    public function form(Element $element = null , Request $request , ObjectManager $manager)
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null ,'You have to be admin');

        if(!$element){
        $element= new Element();
        }

        $form= $this->createForm(ElementType::class, $element  );

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager->persist($element);
            $manager->flush(); 

            return $this->redirectToRoute('element');
        }
                    
        return $this->render('element/element_new.html.twig',[
            'formElement' => $form->createView(),
            'editMode' => $element->getId() !== null,
            'editTitle' => $element->getId() !== null
        ]);
        return $this->render('element/element_new.html.twig');
    }
    

      /**
     * Require ROLE_ADMIN for only this controller method.
     * @Route("element/delete/{id}", name="element_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null ,'You have to be admin');

        $repository = $this->getDoctrine()->getRepository(Element::class);
        $element = $repository->find($id);

        $manager->remove($element);
        $manager->flush();
        
        return $this->redirectToRoute('element');
         
           }

}
