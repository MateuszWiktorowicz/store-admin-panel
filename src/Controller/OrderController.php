<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/admin-panel/orders', name: 'app_order')]
    public function index(OrderRepository $orders): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orders->findAll()
        ]);
    }

    #[Route('/admin-panel/order/{id}', name: 'app_order_info')]
    public function info(Order $order): Response
    {
        return $this->render('order/info.html.twig', [
            'order' => $order
        ]);
    }

    #[Route('/admin-panel/order/edit/{id}', name: 'app_order_edit')]
    public function edit(
        Request $request,
        Order $order,
        OrderRepository $orders
    ): Response {
        $isEdit = $order->getId() !== null;

        $form = $this->createForm(OrderType::class, $order, [
            'is_edit' => $isEdit
        ]);
        $form->handleRequest($request);

        $user = $order->getUser();


        if ($form->isSubmitted() && $form->isValid()) {
            $order->setUser($user);
            $orders->add($order, true);

            $this->addFlash('success', 'Order and its items updated successfully.');

            return $this->redirectToRoute('app_order_edit', [
                'id' => $order->getId()
            ]);
        }

        return $this->render('order/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin-panel/order/add', name: 'app_order_add', priority: 2)]
    public function add(
        Request $request,
        OrderRepository $orders,
    ): Response {
        $order = new Order();

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form);
            $order = $form->getData();

            $orders->add($order, true);

            $this->addFlash('success', 'Order added successfully.');

            return $this->redirectToRoute('app_order');
        }

        return $this->render('order/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin-panel/orders/delete/{id}', name: 'app_order_delete')]
    public function delete(
        Order $order,
        OrderRepository $orders,
    ): Response {


        $orders->remove($order, true);
        $this->addFlash('success', 'The order has been deleted.');

        return $this->redirectToRoute('app_order');
    }
}
