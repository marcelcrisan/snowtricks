<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route@Route("/", name="home_page")
     */

    public function home()
    {
        return $this->render('front/home.html.twig', [
            'title' => 'Bienvenue !',
        ]);
    } 
}