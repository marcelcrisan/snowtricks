<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;


class ForgotPassController extends AbstractController
{
    /**
     * @Route("/forgotpass", name="forgot_pass")
     */
    public function forgotPass(Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator): Response
    {
        
        if ($request->isMethod('POST')) {
            $username = $request->request->get('_username');
            
            $manager = $this->getDoctrine()->getManager();
            $user = $manager->getRepository(User::class)->findOneBy(['username' => $username]);
 
            if ($user === null) {
                $this->addFlash('danger', 'Utilisateur Inconnu');

                return $this->redirectToRoute('security_registration');
            }

            $token = $tokenGenerator->generateToken();
 
            try{
                $user->setResetToken($token);
                $manager->flush();
            } 
            
            catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());

                return $this->redirectToRoute('homepage_tricks');
            }
 
            $url = $this->generateUrl('reset_pass',['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
 
            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('snow.tricks.symf@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "Voici un lien pour réinitialiser votre mot de passe : " . $url,
                    'text/html'
                );
 
            $mailer->send($message);
 
            $this->addFlash('success', 'Mail envoyé');
 
            return $this->redirectToRoute('reset_pass',['token' => $token]);
        }
        // Génération du template
        return $this->render('security/forgotpass.html.twig', [
            'title' => 'Mot de passe oublié'
        ]);
    }
}