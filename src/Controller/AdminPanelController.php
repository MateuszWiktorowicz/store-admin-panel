<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class AdminPanelController extends AbstractController
{
    #[Route('/', name: 'app_admin_panel')]
    public function index(OrderRepository $orders): Response
    {
        return $this->render('admin_panel/dashboard.html.twig', [
            'orders' => $orders->findAll(),
            'todayOrders' => $orders->getTodayOrders()
        ]);
    }
}
