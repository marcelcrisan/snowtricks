<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class LogInController extends AbstractController
{
     /**
     * @Route("/connexion", name="security_login")
     * @param \Symfony\Component\HttpFoundation\Response
     */
    public function login():Response
    {
        $username = new User();

        // if user not connected
        if (!$username) return $this->json([
            'code' => 403,
            'message' => "Oups vous n'êtes pas encore inscrit"
        ], 403);

        $username = $username->getUsername();
        return $this->json([
            'code' => 200,
            'message' => 'Bienvenue ' . $username . ' !',
        ], 200);

        //return $this->render('security/login.html.twig');
    }
}