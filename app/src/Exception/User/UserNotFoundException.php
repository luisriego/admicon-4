<?php

declare(strict_types=1);

namespace App\Exception\User;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'Usuário com email %s não encontrado';

    public static function fromEmail(string $email): void
    {
        throw new self(\sprintf(self::MESSAGE, $email));
    }
}
