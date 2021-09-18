<?php

declare(strict_types=1);

namespace App\Service\Password;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class EncoderService
{
    public function __construct(private UserPasswordEncoderInterface $encoder) {
    }

    public function generateEncodedPassword(UserInterface $user, string $password): string
    {
         if (\strlen($password) < 6) {
             throw new BadRequestException('Password too short');
         }

         return $this->encoder->encodePassword($user, $password);
    }

    public function isValidPassword(UserInterface $user, string $oldPassword): bool
    {
        return $this->encoder->isPasswordValid($user, $oldPassword);
    }
}
