<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route@Route("/", name="home_page")
     */

    public function home(TrickRepository $repo)
    { 

        return $this->render('front/home.html.twig', [
            'tricks' => $repo->findAll(),
        ]);
    } 
}