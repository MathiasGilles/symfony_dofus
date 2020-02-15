<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Element;
use App\Form\ElementType;
use App\Repository\ElementRepository;

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
     * @Route ("/element/new", name="element_new")
     * @Route("/element/edit/{id}", name="element_edit")
     */
    public function form(Element $element = null , Request $request , ObjectManager $manager)
    {
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
     * @Route("element/delete/{id}", name="element_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Element::class);
        $element = $repository->find($id);

        $manager->remove($element);
        $manager->flush();
        
        return $this->redirectToRoute('element');
         
           }

}
