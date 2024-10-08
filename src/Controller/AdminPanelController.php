<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
