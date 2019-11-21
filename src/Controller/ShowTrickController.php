<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowTrickController extends AbstractController
{
    /**
     * @Route("/trick/{id}", name="show_trick")
     */
    public function trickPage(Trick $trick, Request $request, ObjectManager $manager)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = new User();

            $comment->setCreatedAt(new \DateTime())
                    ->setTrick($trick)
                    ->setAuthor($user);

            $manager->persist($comment);
            $manager->flush(); 
            
            return $this->redirectToRoute('show_trick', ['id' => $trick->getId()]);
        }

        return $this->render('front/show_trick.html.twig', [
            'trick' => $trick,
            'commentForm' => $form->createView()
        ]);
    }
}