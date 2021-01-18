<?php

namespace Helper;

use ApiTester;
use App\Models\User;
use Codeception\Util\HttpCode;
use Ejarnutowski\LaravelApiKey\Models\ApiKey;
use Faker\Factory;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{
    protected $faker;
    protected $v1Url = "/v1";
    protected $headers;
    protected $key;

    protected $_accessToken;
    protected $_userId;

    // models
    protected $user;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function _before(\Codeception\TestInterface $test)
    {
        $this->user = User::first();

        // create api key
        $key = ApiKey::generate();
        $apiKey = new ApiKey;
        $apiKey->name = "testing";
        $apiKey->key = $key;
        $apiKey->save();
        $this->key = $key;
    }

    public function user()
    {
        return $this->user;
    }

    public function faker()
    {
        return $this->faker;
    }

    public function apiKey()
    {
        return $this->key;
    }

    public function password()
    {
        return "password";
    }

    public function getUserId()
    {
        return $this->_userId;
    }

    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    public function login(ApiTester $I)
    {
        $this->user  = User::first();
        $I->haveHttpHeader('X-Authorization', $this->apiKey());

        $data = [
            "email" => $this->user->email,
            "password" => $this->password(),
        ];

        $I->sendPost('/v1/users/login', $data);
        $resp = json_decode($I->grabResponse());

        $this->_accessToken = $resp->access_token;
        $this->_userId = $resp->id;
    }
}
