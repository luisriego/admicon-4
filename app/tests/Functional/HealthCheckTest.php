<?php

declare(strict_types=1);

namespace App\Tests\Functional;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HealthCheckTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/health-check';

    public function testHealthCheck(): void
    {
        self::$baseClient->request(Request::METHOD_GET, self::ENDPOINT);

        $response = self::$baseClient->getResponse();

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }
}
