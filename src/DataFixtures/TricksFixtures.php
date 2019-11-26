<?php

namespace App\DataFixtures;

use App\Entity\GroupTrick;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Comment;
use App\Entity\User;
use DirectoryIterator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Psr\Container\ContainerInterface;
use Gedmo\Sluggable\Util\Urlizer;

class TricksFixtures extends Fixture
{
    /**
     * Encodeur de mot de passe
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct($uploadsPath, $fixturesFilePath, UserPasswordEncoderInterface $encoder, ContainerInterface $container)
    {
        $this->encoder = $encoder;
        $this->container = $container;
        $this->uploadsPath = $uploadsPath;
        $this->fixturesFilePath = $fixturesFilePath;
    }

 

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('user@snowtricks.com')
            ->setUsername('usertrick')
            ->setPassword($this->encoder->encodePassword($user, 'snowpass'));

        $manager->persist($user);

        $groupTricks = ['Les grabs', 'Les rotations', 'Les flips', 'Les rotations désaxées', 'Les slides', 'Les one foot tricks', 'Old school'];
        // Créer 10 group fakées
        foreach ($groupTricks as $groupTrickName) {
       // for ($i = 1; $i <= 10; $i++) {
            $groupTrick = new GroupTrick();
        //    $groupTrick->setTitle($faker->sentence());
            $groupTrick->setTitle($groupTrickName);
            $manager->persist($groupTrick);

            // Créer entre 4 et 6 tricks par group
            for ($j = 1; $j <= mt_rand(4, 6); $j++) {
                $trick = new Trick();

                $content = join($faker->paragraphs());
                $now = new \DateTime();

                $trick->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setEditAt($now)
                    ->setGroupTrick($groupTrick);

                $manager->persist($trick);

                // Créer 3 - 5 images par trick
                for ($k = 1; $k <= mt_rand(3, 5); $k++) {
                    /** @var UploadedFile $file */
                    $dirUpload = $this->uploadsPath;
                    $dirFixtures = $this->fixturesFilePath;

                    //$filesImages = new DirectoryIterator($dirFixtures);
                    
                  $fileImage = $faker->file($dirFixtures, $dirUpload, false);
                  
                
                    $image = new Image();
                    $image->setName($fileImage)
                        ->setTrick($trick);
                    
                    
                    


                    $manager->persist($image);
                }

                // Créer 3 - 5 videos par trick
                for ($j = 1; $j <= mt_rand(3, 5); $j++) {
                    $videoArray = array('https://www.youtube.com/embed/1fo7Gy92MIM', 'https://www.youtube.com/embed/1MQfbMoCfb4', 'https://www.youtube.com/embed/fHtdw43_qAw', 'https://www.youtube.com/embed/KoHzXi7Usl8');
                    $fileVideo = $faker->randomElement($videoArray);
                    $video = new Video();

                    $video->setName($fileVideo)
                        ->setTrick($trick);

                    $manager->persist($video);
                }

                // Créer entre 4 et 10 commentaires par article
                for ($l = 1; $l <= mt_rand(4, 10); $l++) {
                    $comment = new Comment();

                    $content = join($faker->paragraphs(2));

                    $now = new \DateTime();
                    $interval = $now->diff($trick->getCreatedAt());
                    $days = $interval->days;
                    $minimum = '-' . $days . ' days';

                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween($minimum))
                            ->setTrick($trick);

                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}