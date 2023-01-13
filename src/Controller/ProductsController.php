<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use App\Services\BookServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/product', name: 'app_products')]
    public function index(BookServices $bookService): Response
    {
    $books = $bookService->getProducts();
    return $this->render('products/products.html.twig', compact('books'));
    }
    
    #[Route('/book/{id}', name: 'product.detail')]
    public function detail(Book $product, Request $request, CartManager $cartManager)
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setBook($product);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addItem($item)
            ;
            $cartManager->save($cart);

            return $this->redirectToRoute('product.detail', ['id' => $product->getId()]);
        }

        return $this->render('products/details.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
