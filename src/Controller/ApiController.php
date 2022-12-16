<?php
namespace App\Controller;

use App\Entity\book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:'/api')]
class ApiController extends AbstractController
{
    #[Route('/show/{id}', name: 'api-show',  methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, $id): JsonResponse
    {
        $repository = $doctrine->getRepository(Book::class);
        $book = $repository->find($id);
        if (!$book)
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);
        
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
}
?>
