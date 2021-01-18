<?php

namespace Tests\Unit;

use Tests\TestCase;

//use Illuminate\Foundation\Testing\TestCase;

class UserTest extends TestCase {

    /**
     * Test user registration
     * @test
     * Route: POST /api/v1/users
     */
    public function register() {
        $data = [
            "email" => "user7@user.com",
            "country" => "Ghana",
            "password" => "*aA1234567893",
            "password_confirm" => "*aA1234567893",
            "last_name" => $this->faker->firstName,
            "first_name" => "{$this->faker->lastName}",
            "phone_number" => "{$this->faker->phoneNumber}",
        ];
        $response = $this->postJson($this->v1Url . '/users/register', $data, $this->headers);
        $response->assertStatus(201)
                 ->assertJson([
                     'message' => "User created successfully",
                 ]);
        $data = (array) json_decode($response->content());
        self::assertArrayHasKey("access_token", $data);
        self::assertArrayHasKey("message", $data);
        self::assertArrayHasKey("id", $data);
        self::assertArrayHasKey("token_type", $data);
        self::assertArrayHasKey("expires_in", $data);
        self::assertEquals("bearer", $data["token_type"]);
    }


}
