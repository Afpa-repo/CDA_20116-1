<?php

namespace App\Controller;

use App\Form\ModifyPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/compte/mot-de-passe", name="password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $message = null;
        $user = $this->getUser();
        $form = $this->createForm(ModifyPasswordType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $old_password = $form->get('old_password')->getData();
            if($encoder->isPasswordValid($user, $old_password))
            {
                $new_password = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user, $new_password);
                $user->setPassword($password);
                $this->entityManager->flush();
                $message = 'Votre mot de passe à bien été mis à jour';
            }
            else
            {
                $message = 'Mot de passe incorrect';
            }

        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'message' => $message
        ]);
    }
}
