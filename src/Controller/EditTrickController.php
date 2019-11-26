<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class EditTrickController extends AbstractController
{   
    /**
     * @Route("/trick/{id}/edit", name="trick_edit")
     */
    public function editTrick(Trick $trick,Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(TrickType::class, $trick);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $trick->setEditAt(new \DateTime());

            
            $manager->persist($trick);
            $manager->flush();
        
            return $this->redirectToRoute('show_trick', ['id' => $trick->getId()]);
        }
        return $this->render('front/edit_trick.html.twig', [
            'formTrick' => $form->createView(),
            'images' => $trick->getImages(),
            'videos' => $trick->getVideos()
        ]);
    }
}