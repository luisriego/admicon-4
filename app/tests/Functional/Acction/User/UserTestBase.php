<?php

declare(strict_types=1);

namespace App\Tests\Functional\Acction\User;

use App\Tests\Functional\FunctionalTestBase;

class UserTestBase extends FunctionalTestBase
{
    protected string $endpoint;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = '/api/v1/users';
    }
}
