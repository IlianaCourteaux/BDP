<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UsersType;
use App\Form\UsersPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UsersController extends AbstractController
{

    /** Modification du profil des utilisateurs*/

    #[Security('is_granted("ROLE_USER") and user === selectedUser')]
    #[Route('/user/edit/{id}', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Users $selectedUser, Request $request, EntityManagerInterface $emi, UserPasswordHasherInterface $hasher): Response
    {
        // if(!$this->getUser()){
        //     return $this->redirectToRoute('app_login');
        // }

        // if($this->getUser() !== $user){ 
        //     return $this->redirectToRoute('app_home');
        // }

        $form = $this->createForm(UsersType::class, $selectedUser);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            // if ($hasher->isPasswordValid($user, $form->getData()->getPassword())) {
                $selectedUser->setUpdatedAt(new \DateTimeImmutable());
                $user = $form->getData();

                $this->addFlash(
                    'success',
                    'Vos informations ont bien été modifiées'
                );

                $emi->persist($user);
                $emi->flush();

            // } else {
            //     $this->addFlash(
            //         'warning',
            //         'Le mot de passe est incorrect'
            //     );
            // }
        }

        return $this->render('users/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Security('is_granted("ROLE_USER") and user === selectedUser')]
    #[Route('/user/edit-password/{id}', name: 'app_user_password_edit', methods: ['GET', 'POST'])]
    public function editPassword(Users $selectedUser, Request $request, EntityManagerInterface $emi, UserPasswordHasherInterface $hasher): Response
    {
        // if (!$this->getUser()) {
        //     return $this->redirectToRoute('app_login');
        // }

        // if ($this->getUser() !== $selectedUser) {
        //     return $this->redirectToRoute('app_home');
        // }
        
        $form = $this->createForm(UsersPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($hasher->isPasswordValid($selectedUser, $form->getData()['password'])) {
                $selectedUser->setUpdatedAt(new \DateTimeImmutable());
                $selectedUser->setPassword($form->getData()['newPassword']);

                $this->addFlash(
                    'success',
                    'Le mot de passe a bien été modifié.'
                );

                $emi->persist($selectedUser);
                $emi->flush();

            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe est incorrect.'
                );
            }
        }

        return $this->render('users/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
