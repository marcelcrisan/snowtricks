<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class DeleteTrickController extends AbstractController
{  
    /**
     * @Route("/trick/{id}/delete", name="trick_delete")
    */

    public function deleteTrick (Trick $trick, ObjectManager $manager)
    {
        if (!$trick) {
            throw $this->createNotFoundException('Cette figure n\'existe pas !');
        }
    
        $manager->remove($trick);
        $manager->flush();
    
        return $this->redirectToRoute('home_page');
    }

}