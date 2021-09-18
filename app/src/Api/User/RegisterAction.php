<?php

declare(strict_types=1);

namespace App\Api\User;

use App\Entity\User;
use App\Http\DTO\RegisterRequest;
use App\Repository\UserRepository;
use App\Service\User\RegisterService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterAction
{

    public function __construct(private RegisterService $registerService)
    { }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = $this->registerService->__invoke($request->getName(), $request->getEmail(), $request->getPassword());


        return new JsonResponse($user->toArray(), Response::HTTP_CREATED);
    }
}
