<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Discount;
use App\Entity\AssignedDiscount;
use App\Form\AssignedDiscountType;
use App\Repository\DiscountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AssignedDiscountRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class DiscountController extends AbstractController
{
    #[Route('/admin-panel/discounts', name: 'app_discount', priority: 2)]
    public function discounts(DiscountRepository $discounts): Response
    {
        return $this->render('discount/index.html.twig', [
            'discounts' => $discounts->findAll()
        ]);
    }

    #[Route('/admin-panel/discounts/add', name: 'app_discount_add', priority: 2)]
    public function addDiscount(
        DiscountRepository $discounts,
        Request $request
    ): Response {
        $discount = new Discount();

        $form = $this->createFormBuilder($discount)
            ->add('name')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discount = $form->getData();
            $discounts->add($discount, true);

            $this->addFlash('success', 'Your producer have been added');

            return $this->redirectToRoute('app_discount');
        }

        return $this->render('discount/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin-panel/discounts/remove/{id}', name: 'app_discount_delete')]
    public function deleteDiscount(
        DiscountRepository $discounts,
        Discount $discount,
        EntityManagerInterface $entityManager
    ): Response {
        foreach ($discount->getProducts() as $product) {
            $product->setDiscount(null);
            $entityManager->persist($product);
        }

        $discounts->remove($discount, true);
        $this->addFlash('success', 'The discount has been deleted.');

        return $this->redirectToRoute('app_discount');
    }

    #[Route('/admin-panel/discounts/edit/{id}', name: 'app_discount_edit')]
    public function editDiscount(
        DiscountRepository $discounts,
        Discount $discount,
        Request $request
    ): Response {
        $form = $this->createFormBuilder($discount)
            ->add('name')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discount = $form->getData();
            $discounts->add($discount, true);

            $this->addFlash('success', 'Your producer have been added');

            return $this->redirectToRoute('app_discount');
        }

        return $this->render('discount/edit.html.twig', [
            'form' => $form,
            'products' => $discount->getProducts()
        ]);
    }

    #[Route('/admin-panel/discounts/assign/{user}', name: 'app_discount_assign', priority: 2)]
    public function assignDiscount(
        AssignedDiscountRepository $assignedDiscounts,
        User $user,
        Request $request
    ): Response {
        $assignedDiscount = new AssignedDiscount();
        $assignedDiscount->setUser($user);
        $form = $this->createForm(AssignedDiscountType::class, $assignedDiscount);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assignedDiscount = $form->getData();
            $assignedDiscounts->add($assignedDiscount, true);

            $this->addFlash('success', 'Your discount have been assigned to user');

            return $this->redirectToRoute('app_discount');
        }

        return $this->render('discount/assign.html.twig', [
            'form' => $form
        ]);
    }
}
