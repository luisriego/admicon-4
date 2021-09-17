<?php

declare(strict_types=1);

namespace App\Api\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterAction
{

    public function __construct(private UserRepository $userRepository)
    { }

    public function __invoke(Request $request): JsonResponse
    {
        $responseData = \json_decode($request->getContent(), true);

        $user = new User($responseData['name'], $responseData['email']);
        $user->setPassword($responseData['password']);
        $this->userRepository->save($user);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
