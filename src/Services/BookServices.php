<?php
namespace App\Services;
   
use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
   
class BookServices{
    private $doctrine;
   
    public function __construct(ManagerRegistry $doctrine)
    {
        //Como hace falta acceder a ManagerRegistry lo inyectamos en el constructor
        $this->doctrine = $doctrine;
    }
    public function getProducts(): ?array{
        $repository = $this->doctrine->getRepository(Book::class);
        return $repository->findAll();
    }
}