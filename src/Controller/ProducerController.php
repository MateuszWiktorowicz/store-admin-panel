<?php

namespace App\Controller;

use App\Entity\Producer;
use App\Form\ProducerType;
use App\Repository\ProducerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProducerController extends AbstractController
{
    #[Route('/admin-panel/producers', name: 'app_producer')]
    public function index(ProducerRepository $producers): Response
    {
        return $this->render('producer/index.html.twig', [
            'producers' => $producers->findAll(),
            'producersCount' => $producers->count()
        ]);
    }

    #[Route('/admin-panel/producers/add', name: 'app_producer_add', priority: 2)]
    public function add(
        Request $request,
        ProducerRepository $producers
    ): Response {
        $form = $this->createForm(ProducerType::class, new Producer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $producer = $form->getData();
            $producers->add($producer, true);

            $this->addFlash('success', 'Your producer have been added');

            return $this->redirectToRoute('app_producer');
        }

        return $this->render('producer/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin-panel/{producer}/edit', name: 'app_producer_edit', priority: 2)]
    public function edit(
        Producer $producer,
        Request $request,
        ProducerRepository $producers
    ): Response {
        $form = $this->createForm(ProducerType::class, $producer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $producer = $form->getData();
            $producers->add($producer, true);

            $this->addFlash('success', 'Your producer have been added');

            return $this->redirectToRoute('app_producer');
        }

        return $this->render('producer/edit.html.twig', [
            'form' => $form,
            'producer' => $producer
        ]);
    }

    #[Route('/admin-panel/producers/delete/{id}', name: 'app_producer_delete', priority: 2)]
    public function delete(
        Producer $producer,
        ProducerRepository $producers,
        EntityManagerInterface $entityManager
    ): Response {
        foreach ($producer->getProducts() as $product) {
            $product->setProducer(null);
            $entityManager->persist($product);
        }

        $producers->remove($producer, true);
        $this->addFlash('success', 'The producer has been deleted.');

        return $this->redirectToRoute('app_producer');
    }
}
