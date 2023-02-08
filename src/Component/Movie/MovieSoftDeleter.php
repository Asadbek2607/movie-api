<?php
declare(strict_types=1);
namespace App\Component\Movie;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\SoftDeleteable\SoftDeleteableListener;

class MovieSoftDeleter
{
    private EntityManagerInterface $entityManager;



    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function softDelete(Movie $movie, bool $flush = false): void
    {
        $this->entityManager->getFilters()->enable('softdeleteable');

        $movie->setDeletedAt(new \DateTimeImmutable());
        $this->entityManager->persist($movie);
        $this->entityManager->flush();

    }
}