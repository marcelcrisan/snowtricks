<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route@Route("/", name="home_page")
     */

    public function home()
    {
        return $this->render('front/front.html.twig', [
            'title' => 'Bienvenue !',
        ]);
    } 
}