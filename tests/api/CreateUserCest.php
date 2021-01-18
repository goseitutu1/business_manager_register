<?php

use App\Models\User;
use Codeception\Util\HttpCode;
use Ejarnutowski\LaravelApiKey\Models\ApiKey;
use Faker\Factory;

class CreateUserCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('X-Authorization', $I->apiKey());
    }

    /**
     * Test user registration
     * @test
     * Route: POST /api/v1/users
     */
    public function registerTest(ApiTester $I)
    {
        $data = [
            "email" => "user7@user.com",
            "country" => "Ghana",
            "password" => "*aA1234567893",
            "password_confirm" => "*aA1234567893",
            "last_name" => $I->faker()->firstName,
            "first_name" => "{$I->faker()->lastName}",
            "phone_number" => "02415484587",
        ];

        $I->sendPost('/v1/users/register', $data);
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'User created successfully']);

        $I->seeResponseMatchesJsonType([
            'expires_in' => 'integer',
            'token_type' => 'string',
            'access_token' => 'string',
            'id' => 'string',
            'type' => 'string',
            'status_code' => 'integer',
        ]);
    }


    /**
     * Test user registration with invalid inputs
     * @test
     * Route: POST /api/v1/users
     */
    public function registerTestWithInvalidInputs(ApiTester $I)
    {
        $data = [
            "email" => "user7.com",
            "country" => "Ghana",
            "password" => "1234567",
            "password_confirm" => "1111111111",
            "last_name" => "John",
            "first_name" => "Doe",
            "phone_number" => "3467964324",
        ];

        // 1. Testing with invalid email
        $I->sendPost('/v1/users/register', $data);

        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
        $I->seeResponseIsJson();
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            "message" => "The email must be a valid email address.",
            "errors" => [
                "email" => ["The email must be a valid email address."],
                "password_confirm" => ["The password confirm and password must match."],
            ],
            "status_code" => 422
        ]);
    }
}
