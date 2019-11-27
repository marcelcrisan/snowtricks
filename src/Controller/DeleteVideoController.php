<?php

namespace App\Controller;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class DeleteVideoController extends AbstractController
{  
    /**
     * @Route("/video/{id}/delete", name="video_delete")
    */
    public function deleteVideo (Video $video, ObjectManager $manager, Request $request)
    {
        if (!$video) {
            throw $this->createNotFoundException('Cette video n\'existe pas !');
        }

        $manager->remove($video);
        $manager->flush();
        
        return $this->redirect($request->headers->get('referer'));
    }

}