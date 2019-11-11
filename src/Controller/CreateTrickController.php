<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class CreateTrickController extends AbstractController
{   
    
    
    /**
     * @Route("/trick/new", name="trick_create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        // Pour faire formulaire c'est comme ca !!! 
        $trick = new Trick();

        $form = $this->createForm(TrickType::class, $trick);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $trick->setCreatedAt(new \DateTime());

            
            $manager->persist($trick);
            $manager->flush();
        
            return $this->redirectToRoute('trick', ['id' => $trick->getId()]);
        }

        return $this->render('front/create_trick.html.twig', [
            'formTrick' => $form->createView()
        ]);
    }
}