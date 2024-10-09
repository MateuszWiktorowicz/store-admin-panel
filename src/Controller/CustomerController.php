<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\UserProfile;
use App\Form\UserProfileType;
use App\Repository\UserRepository;
use App\Repository\UserProfileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[IsGranted('ROLE_ADMIN')]
class CustomerController extends AbstractController
{
    #[Route('/admin-panel/customers', name: 'app_customer')]
    public function index(UserRepository $users): Response
    {
        return $this->render('customer/index.html.twig', [
            'customers' => $users->findCustomers()
        ]);
    }

    #[Route('/admin-panel/customers/add', name: 'app_customer_add')]
    public function add(
        UserRepository $users,
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response {
        $form = $this->createForm(UserType::class, new User);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainPassword = $form->get('password')->getData();
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
            $user->setRoles(["ROLE_CUSTOMER"]);

            $userProfile = new UserProfile;
            $user->setProfile($userProfile);
            $users->add($user, true);

            $this->addFlash('success', 'Your customer have been added');

            return $this->redirectToRoute('app_customer');
        }

        return $this->render('customer/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin-panel/customer/{id}/edit', name: 'app_customer_edit')]
    public function edit(
        User $user,
        UserRepository $users,
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainPassword = $form->get('password')->getData();
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $users->add($user, true);

            $this->addFlash('success', 'Your customer have been changed');

            return $this->redirectToRoute('app_customer');
        }

        return $this->render('customer/edit.html.twig', [
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('/admin-panel/customers/delete/{id}', name: 'app_customer_delete', priority: 2)]
    public function delete(
        User $user,
        UserRepository $users
    ): Response {
        $users->remove($user, true);
        $this->addFlash('success', 'The customer has been deleted.');

        return $this->redirectToRoute('app_customer');
    }

    #[Route('/admin-panel/customer-profile/{id}/edit', name: 'app_customer_profile')]
    public function editProfile(
        User $user,
        UserProfileRepository $profiles,
        Request $request,
    ): Response {
        $profile = $user->getProfile();
        $form = $this->createForm(UserProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile = $form->getData();

            $profiles->add($profile, true);

            $this->addFlash('success', 'Your customer profile have been changed');

            return $this->redirectToRoute('app_customer');
        }

        return $this->render('customer/profile.html.twig', [
            'form' => $form,
            'user' => $profile
        ]);
    }
}
