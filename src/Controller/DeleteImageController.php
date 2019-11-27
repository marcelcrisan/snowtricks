<?php

namespace App\Controller;

use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

class DeleteImageController extends AbstractController
{  
    /**
     * @Route("/image/{id}/delete", name="image_delete")
    */
    public function deleteImage (Image $image, ObjectManager $manager, Request $request)
    {
        if (!$image) {
            throw $this->createNotFoundException('Cette image n\'existe pas !');
        }
        $filesystem = new Filesystem();

        $fileImage = $image->getName();

        $filesystem->remove(($this->getParameter('upload_directory')). '/'. $fileImage);

        $manager->remove($image);
        $manager->flush();
        
        return $this->redirect($request->headers->get('referer'));
    }

}