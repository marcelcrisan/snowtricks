<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Image;
use App\Entity\Video;
use App\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateTrickController extends AbstractController
{   
    
    
    /**
     * @Route("/trick/new", name="trick_create")
     */
    public function create(Request $request, ObjectManager $manager)
    { 
        $trick = new Trick();
        
        $now = new \DateTime();

        $form = $this->createForm(TrickType::class, $trick);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $trick->setCreatedAt($now)
                ->setEditAt($now);
                
            /** @var UploadedFile $files */
            $files = $form['images']->getData();

            foreach ($files as $fileImage) {

                $fileImage = $fileImage->getName();
                
                $fileName = md5(\uniqid()) . '.' . $fileImage->guessExtension();
                
                $image = new Image();
                $image->setName($fileName);

                $trick->addImage($image);

                $fileImage->move($this->getParameter('upload_directory'), $fileName);
            }
            
            /** @var UploadedFile $filesVideo */
            $filesVideo = $form['videos']->getData();

            foreach ($filesVideo as $fileVideo) {

                $fileVideo = $fileVideo->getName();
                
                $video = new Video();
                $video->setName($fileVideo);
                
                $trick->addVideo($video);     
            }
            
            $manager->persist($trick);
            $manager->flush();

            return $this->redirectToRoute('show_trick', [
                'id' => $trick->getId(),   
            ]); 
        }

        return $this->render('front/create_trick.html.twig', [
            'formTrick' => $form->createView(),
            'trick' => $trick,   
        ]);
    }
}