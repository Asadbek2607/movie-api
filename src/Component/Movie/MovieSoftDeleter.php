<?php
declare(strict_types=1);
namespace App\Component\Movie;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;

class MovieSoftDeleter
{
    private EntityManagerInterface $entityManager;



    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // softDelete function: marking a record as deleted in the database, without actually removing it from the table.
    public function softDelete(Movie $movie): void
    {
        //only retrieve records from the database that have not been marked as deleted
        $this->entityManager->getFilters()->enable('softdeleteable');

        //Sets the deletedAt property of the Movie entity to the current date and time. This property is used to keep track of when the record was deleted.
        $movie->setDeletedAt(new \DateTimeImmutable());

        //Persists the Movie entity using the Doctrine Entity Manager. This tells Doctrine to update the entity in the database.
        $this->entityManager->persist($movie);

        // writes the changes made to the Movie entity to the database.
        $this->entityManager->flush();

    }
}