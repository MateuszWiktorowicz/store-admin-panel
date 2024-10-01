<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/admin-panel/products', name: 'app_product')]
    public function index(ProductRepository $products): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $products->findAll(),
            'productCount' => $products->count()
        ]);
    }

    #[Route('/admin-panel/products/add', name: 'app_product_add', priority: 2)]
    public function add(
        Request $request,
        ProductRepository $products
    ): Response {
        $form = $this->createForm(ProductType::class, new Product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $products->add($product, true);

            $this->addFlash('success', 'Your product have been added');

            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin-panel/products/delete/{id}', name: 'app_product_delete', priority: 2)]
    public function delete(
        Product $product,
        ProductRepository $products
    ): Response {
        $products->remove($product, true);
        $this->addFlash('success', 'The product has been deleted.');

        return $this->redirectToRoute('app_product');
    }
}
