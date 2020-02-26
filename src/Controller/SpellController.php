<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Spell;
use App\Form\SpellType;
use App\Repository\SpellRepository;


class SpellController extends AbstractController
{
    /**
     * @Route("/spell", name="spell")
     */
    public function index(SpellRepository $repo)
    {
        
        $spell = $repo->findAll();
    
        return $this->render('spell/index.html.twig', [
            'spell' => $spell
        ]);
    }

    /**
     * @Route("/spell/new", name="spell_new")
     * @Route("/spell/edit/{id}", name="spell_edit")
     */
    public function form(Spell $spell = null , Request $request , ObjectManager $manager,SpellRepository $repo)
    {
        if(!$spell){
        $spell= new Spell();
        }

        $spellToDisplay=$repo->findAll();

        $form= $this->createForm(SpellType::class, $spell );

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager->persist($spell);
            $manager->flush();
            dump($spell);
            return $this->render('spell/index.html.twig',[
                'spell' => $spellToDisplay
            ]);
        }
                    
        return $this->render('spell/spell_new.html.twig',[
            'formSpell' => $form->createView(),
            'editMode' => $spell->getId() !== null,
            'editTitle' => $spell->getId() !== null
        ]);
        return $this->render('spell/spell_new.html.twig');
    }

    /**
     * @Route("spell/delete/{id}", name="spell_delete")
     */
    public function delete($id, Request $request, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Spell::class);
        $spell = $repository->find($id);

        $manager->remove($spell);
        $manager->flush();
        
        return $this->redirectToRoute('spell');
         
           }
}
 