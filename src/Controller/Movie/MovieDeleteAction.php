<?php
declare(strict_types=1);

namespace App\Controller\Movie;

use App\Component\Movie\MovieSoftDeleter;
use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieDeleteAction extends AbstractController
{
    public function __construct(private MovieSoftDeleter $movieSoftDeleter)
    {

    }

    public function __invoke(Movie $movie):void
    {

        $this->movieSoftDeleter->softDelete($movie,true);

    }
}