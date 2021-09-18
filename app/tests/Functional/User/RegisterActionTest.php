<?php

declare(strict_types=1);

namespace App\Tests\Functional\User;

use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterActionTest extends UserTestBase
{
    public function testRegister(): void
    {
        $payload = [
            'name' => 'Stewie',
            'email' => 'stewie@api.com',
            'password' => '123456',
        ];

        self::$baseClient->request('POST', \sprintf('%s/register', $this->endpoint), [], [], [], \json_encode($payload));

        $response = self::$baseClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        // self::assertEquals('Peter', $responseData['user']['name']);
    }

   public function testRegisterRepeatedUser(): void
   {
       $payload = [
           'name' => 'Stewie',
           'email' => 'stewie@api.com',
           'password' => '123456',
       ];

       self::$baseClient->request('POST', \sprintf('%s/register', $this->endpoint), [], [], [], \json_encode($payload));

       $response = self::$baseClient->getResponse();

       $this->assertEquals(JsonResponse::HTTP_CONFLICT, $response->getStatusCode());
   }

   public function testRegisterWithInvalidPassword(): void
   {
       $payload = [
           'name' => 'Stewie',
           'email' => 'stewie@api.com',
           'password' => '1',
       ];

       self::$baseClient->request('POST', \sprintf('%s/register', $this->endpoint), [], [], [], \json_encode($payload));

       $response = self::$baseClient->getResponse();

       $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
   }
}
