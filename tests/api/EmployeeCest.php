<?php

use App\Models\Business;
use App\Models\Role;
use Codeception\Util\HttpCode;

class EmployeeCest
{
    protected $data;

    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('X-Authorization', $I->apiKey());
        $I->login($I);
        $I->haveHttpHeader('Authorization', 'Bearer ' . $I->getAccessToken());

        $this->data = [
            "email" => $I->faker()->email,
            "country" => $I->faker()->country,
            "password" => "password",
            "password_confirm" => "password",
            "last_name" => $I->faker()->firstName,
            "first_name" => $I->faker()->lastName,
            'phone_number' => $I->faker()->phoneNumber,
            'mobile_money_number' => $I->faker()->phoneNumber,
            'email_verified_at' => now(),
            'role' => Role::where('name', 'like', '%attendant%')->first()->name,
            'business_id' => Business::first()->id_hash
        ];
    }

    /**
     * Test creating of new employee
     *
     * @test
     * Route: POST /api/v1/employees
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I)
    {
        $I->user()->update(['type' => 'manager']);

        $form = $this->data;
        $I->sendPost('/v1/employees', $form);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();

        unset($form['business_id'],
        $form['email_verified_at'],
        $form['password_confirm'],
        $form['password']);

        $form["type"] = "employee";
        $I->seeResponseContainsJson(['data' => $form]);
    }

    /**
     * Test creating of new employee with 'attendant' acccount
     *
     * @test
     * Route: POST /api/v1/employees
     * @param ApiTester $I
     * @return void
     */
    public function createUnauthorizedTest(ApiTester $I)
    {
        $I->user()->update(['type' => 'attendant']);
        $I->sendPost('/v1/employees', $this->data);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => "This action is unauthorized."]);
        $I->seeResponseContainsJson(['status_code' => 500]);
    }
    //TODO!: Add updating & deleting of employees
}
