<?php

namespace App\Controller;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowTrickController extends AbstractController
{
    /**
     * @Route("/trick/{id}", name="show_trick")
     */
    public function trickPage(Trick $trick)
    {
        return $this->render('front/show_trick.html.twig', [
            'trick' => $trick,
        ]);
    }
}