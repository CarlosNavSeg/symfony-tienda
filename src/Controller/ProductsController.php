<?php

namespace App\Controller;

use App\Services\BookServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
