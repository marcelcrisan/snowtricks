<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResetPassController extends AbstractController
{
    /**
     * @Route("/resetpass/user/{token}", name="reset_pass", requirements={"token"="[^.]+"})
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        if (false === $request->isMethod('POST')) {
            
            return $this->render('security/resetpass.html.twig', ['token' => $token]);
        }
        $manager = $this->getDoctrine()->getManager();
    
        if (null === $user = $manager->getRepository(User::class)->findOneByResetToken($token)) {
            $this->addFlash('danger', 'Token Inconnu');

            return $this->redirectToRoute('security_registration');
        }

        $user->setResetToken(null);

        $user->setPassword($encoder->encodePassword($user, $request->request->get('_password')));

        $manager->persist($user);
        $manager->flush();
        $this->addFlash('notice', 'Mot de passe mis à jour');

        return $this->redirectToRoute('security_login'); 
    }
}