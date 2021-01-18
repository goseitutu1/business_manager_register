<?php

namespace Tests;

use App\Models\User;
use Ejarnutowski\LaravelApiKey\Models\ApiKey;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
    use CreatesApplication, DatabaseMigrations;

    protected $faker;
    protected $v1Url = "/api/v1";
    protected $headers;

    // models
    protected $user;


    public function setUp() : void {
        parent::setUp();

        $this->faker = Factory::create();
        $this->user = factory(User::class, 3)->create();

        // create api key
        $key = ApiKey::generate();
        $apiKey = new ApiKey;
        $apiKey->name = "testing";
        $apiKey->key = $key;
        $apiKey->save();
        $this->headers = ["HTTP_X_Authorization" => $key];
    }
}
