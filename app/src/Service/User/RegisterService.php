<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Password\EncoderService;
use Symfony\Bundle\SecurityBundle\Command\UserPasswordEncoderCommand;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class RegisterService
{
    public function __construct(private UserRepository $userRepository, private EncoderService $encoderService) {
    }

    public function __invoke(string $name, string $email, string $password): User
    {
        $user = new User($name, $email);
        $user->setPassword($this->encoderService->generateEncodedPassword($user, $password));
        $this->userRepository->save($user);
        
        return $user;
    }
}
