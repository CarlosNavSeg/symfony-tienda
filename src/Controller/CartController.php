<?php

namespace App\Controller;

use App\Entity\Book;
use App\Services\CartService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:'/cart')]
class CartController extends AbstractController
{
    private $doctrine;
    private $repository;
    private $cart;
    //Le inyectamos CartService como una dependencia
    public  function __construct(ManagerRegistry $doctrine, CartService $cart)
    {
        $this->doctrine = $doctrine;
        $this->repository = $doctrine->getRepository(Book::class);
        $this->cart = $cart;
    }

    #[Route('/', name: 'app_cart')]
    public function index(): Response
    {
        $books = $this->repository->getFromCart($this->cart);
        //hay que añadir la cantidad de cada booko
        $books = [];
        $totalCart = 0;
        foreach($books as $book){
            $book = [
                "id"=> $book->getId(),
                "title" => $book->getTitle(),
                "author" => $book->getAuthor(),
                "price" => $book->getPrice(),
                "publishing_house" => $book->getPublishingHouse(),
                "photo" => $book->getPhoto(),
                "quantity" => $this->cart->getCart()[$book->getId()]
            ];
            $totalCart += $book["quantity"] * $book["price"];
            $books[] = $book;
        }

        return $this->render('cart/index.html.twig', ['books' => $books, 'totalCart' => $totalCart]);
    }

    #[Route('/add/{id}', name: 'cart_add', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function cart_add(int $id): Response
    {
        $book = $this->repository->find($id);
        if (!$book)
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);

        $this->cart->add($id, 1);
	    
        $data = [
            "id"=> $book->getId(),
            "title" => $book->getTitle(),
            "author" => $book->getAuthor(),
            "price" => $book->getPrice(),
            "publishing_house" => $book->getPublishingHouse(),
            "photo" => $book->getPhoto()
        ];
        return new JsonResponse($data, Response::HTTP_OK);

    }
    #[Route('/cart/update/{id}/{quantity}', name: 'cart_update', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function update(int $id, int $quantity = 1) {
        $book = $this->repository->find($id);
        if (!$book)
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);

        $this->cart->add($id, $quantity);
	    
        $data = [
            "id"=> $book->getId(),
            "title" => $book->getTitle(),
            "author" => $book->getAuthor(),
            "price" => $book->getPrice(),
            "publishing_house" => $book->getPublishingHouse(),
            "photo" => $book->getPhoto(),
            "quantity" => $quantity
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
?>