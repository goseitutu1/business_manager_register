<?php

use Codeception\Util\HttpCode;

class BusinessCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('X-Authorization', $I->apiKey());
        $I->login($I);
        $I->haveHttpHeader('Authorization', 'Bearer ' . $I->getAccessToken());
    }

    /**
     * Test creating of new business
     *
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I)
    {
        $data = [
            "name" => $I->faker()->company,
            'location' => $I->faker()->address,
            'type' => "company",
            'logo' => $I->faker()->imageUrl(),
            'currency' => App\Models\Currency::first()->code,
            'reg_no' => substr(str_shuffle(md5(time())), 0, 10),
            'vat_no' => substr(str_shuffle(md5(time())), 0, 10),
            'tax_no' => substr(str_shuffle(md5(time())), 0, 10),
            'owner_id' => $I->getUserId(),
        ];

        $I->sendPost('/v1/businesses/create', $data);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'string',
            "name" => "string",
            "nature" => "string",
            "location" => "string",
            "owner" => "string",
            'reg_no' => 'string|null',
            'tax_no' => 'string|null',
            'vat_no' => 'string|null',
            'logo' => 'string:url|null',
            'currency' => ['code' => 'string']

        ], "$.data");
    }

    /**
     * Test deleting of business
     *
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I)
    {
        $data = [
            "name" => $I->faker()->company,
            'location' => $I->faker()->address,
            'type' => "company",
            'logo' => $I->faker()->imageUrl(),
            'currency' => App\Models\Currency::first()->code,
            'reg_no' => substr(str_shuffle(md5(time())), 0, 10),
            'vat_no' => substr(str_shuffle(md5(time())), 0, 10),
            'tax_no' => substr(str_shuffle(md5(time())), 0, 10),
            'owner_id' => $I->getUserId(),
        ];

        $I->sendPost('/v1/businesses/create', $data);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'id' => 'string',
            "name" => "string",
            "nature" => "string",
            "location" => "string",
            "owner" => "string",
            'reg_no' => 'string|null',
            'tax_no' => 'string|null',
            'vat_no' => 'string|null',
            'logo' => 'string:url|null',
            'currency' => ['code' => 'string']

        ], "$.data");

        $resp = json_decode($I->grabResponse())->data;
        $I->sendDELETE('/v1/businesses/' . $resp->id);

        $resp = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "message" => "Business deleted successfully",
            "status_code" => 200
        ]);
        $I->seeResponseMatchesJsonType([
            'status_code' => 'integer',
            "message" => "string",
        ]);
    }

    /**
     * @Test
     *
     * Test deleting of business which does not exists
     *
     * @param ApiTester $I
     * @return void
     */
    public function deleteBusinessDoesNotExistTest(ApiTester $I)
    {
        $I->sendDELETE('/v1/businesses/id-does-not-exists');

        // $resp = json_decode($I->grabResponse());
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "message" => "Business not found",
            "status_code" => 404
        ]);
        $I->seeResponseMatchesJsonType([
            'status_code' => 'integer',
            "message" => "string",
        ]);
    }

    // TODO!: Add updating of business test
}
