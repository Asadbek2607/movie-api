<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Component\User\UserFullNameDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UserFullNameAction extends AbstractController
{
    //to get user data and convert it PHP object

    public function __invoke(Request $request, SerializerInterface $serializer): UserFullNameDto
    {
        return $serializer->deserialize($request->getContent(), UserFullNameDto::class, 'json');
    }
}
