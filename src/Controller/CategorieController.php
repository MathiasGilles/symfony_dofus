<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index(CategorieRepository $repo)
    {
        
        $categorie = $repo->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categorie
        ]);
    }

    /**
     * @Route ("/categorie/new", name="categorie_new")
     * @Route("/categorie/edit/{id}", name="categorie_edit")
     */
    public function form(Categorie $categorie = null , Request $request , ObjectManager $manager)
    {
        if(!$categorie){
        $categorie= new Categorie();
        }

        $form= $this->createForm(CategorieType::class, $categorie  );

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager->persist($categorie);
            $manager->flush(); 

            return $this->redirectToRoute('categorie');
        }
                    
        return $this->render('categorie/categorie_new.html.twig',[
            'formCategorie' => $form->createView(),
            'editMode' => $categorie->getId() !== null,
            'editTitle' => $categorie->getId() !== null
        ]);
        return $this->render('categorie/categorie_new.html.twig');
    }

      /**
     * @Route("categorie/delete/{id}", name="categorie_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repository->find($id);

        $manager->remove($categorie);
        $manager->flush();
        
        return $this->redirectToRoute('categorie');
         
           }

}
