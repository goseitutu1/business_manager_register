<?php

use App\Models\User;
use Codeception\Util\HttpCode;
use Illuminate\Support\Str;

class AuthCest
{
    protected $user;

    public function _before(ApiTester $I)
    {
        $this->user  = User::first();
        $I->haveHttpHeader('X-Authorization', $I->apiKey());
    }

    // Test user login
    public function loginTest(ApiTester $I)
    {
        $data = [
            "email" => $this->user->email,
            "password" => $I->password(),
        ];

        $I->sendPost('/v1/users/login', $data);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'Login successful']);
        $I->seeResponseMatchesJsonType([
            'expires_in' => 'integer',
            'token_type' => 'string',
            'access_token' => 'string',
            'id' => 'string',
            'type' => 'string',
            'status_code' => 'integer',
            'businesses' => 'array'
        ]);
        //TODO: test for existence of business created by the user
    }

    // Test user login with invalid password
    public function loginTestWithWrongPassword(ApiTester $I)
    {
        $data = [
            "email" => $this->user->email,
            "password" => Str::random(7),
        ];

        $I->sendPost('/v1/users/login', $data);
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "message" => "Invalid credentials", "status_code" => 401
        ]);

        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            'status_code' => 'integer',
        ]);
    }
    // Test user login with invalid password
    public function loginTestWithWrongEmail(ApiTester $I)
    {
        $data = [
            "email" => 'user1@fdfff.com',
            "password" => "password",
        ];

        $I->sendPost('/v1/users/login', $data);
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "message" => "Invalid credentials", "status_code" => 401
        ]);

        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            'status_code' => 'integer',
        ]);
    }
}
