<?php

namespace App\Controller;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

class DeleteTrickController extends AbstractController
{  
    /**
     * @Route("/trick/{id}/delete", name="trick_delete")
    */

    public function deleteTrick (Trick $trick, EntityManagerInterface $manager)
    {
        if (!$trick) {
            throw $this->createNotFoundException('Cette figure n\'existe pas !');
        }
        $images = $trick->getImages();
        foreach ($images as $image) {
            $filesystem = new Filesystem();

            $fileImage = $image->getName();
    
            $filesystem->remove(($this->getParameter('upload_directory')). '/'. $fileImage);
        }

        $manager->remove($trick);
        $manager->flush();
    
        return $this->redirectToRoute('homepage_tricks');
    }

}