<?php

namespace App\Controller;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * @Route("/trick/{id}", name="trick")
     */
    public function trickPage(Trick $trick)
    {
        return $this->render('front/trick.html.twig', [
            'trick' => $trick,
        ]);
    }
}