<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Component\User\UserFactory;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{

    public function __construct(private UserFactory $userFactory)
    {
    }

    public function __invoke(User $data):void
    {
        $user = $this->userFactory->create($data->getEmail(), $data->getPassword());

        print_r($user);

        exit();
    }
}