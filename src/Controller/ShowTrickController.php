<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowTrickController extends AbstractController
{
    /**
     * @Route("/trick/{id}", name="show_trick")
     */
    public function trickPage(Trick $trick, Request $request, EntityManagerInterface $manager)
    {
        $id = $trick->getId();

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            
            
            
            $comment->setCreatedAt(new \DateTime())
                    ->setTrick($trick);

            $manager->persist($comment);
            $manager->flush(); 
            
            return $this->redirectToRoute('show_trick', ['id' => $id]);
        }
        $comments = $manager->getRepository(Comment::class)->findBy(['trick' => $id], ['id' => 'DESC']);

        return $this->render('front/show_trick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'commentForm' => $form->createView(),
            'title' => $trick->getTitle()
        ]);
    }
}