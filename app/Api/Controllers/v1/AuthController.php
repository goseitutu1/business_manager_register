<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\BusinessTransformer;
use App\Models\Business;
use App\Models\Employee;
use Illuminate\Http\Request;

/**
 * @group User Authentication
 *
 * APIs for authenticating users
 */
class AuthController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout', 'register']]);
    }

    /**
     * Login
     *
     * @bodyParam email string required The email of the user.
     * @bodyParam password string required The password of the user
     *
     * @responseFile responses/users.login.json
     * @response 401 {
     *  "status_code": 401,
     *  "message": "Invalid credentials"
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            $this->response->errorUnauthorized("Invalid credentials");
        }

        $user = auth('api')->user();
        $transform = new BusinessTransformer();
        $business = [];
        if (strtolower($user->type) == "manager")
            $business = $transform->transformCollection(Business::where('owner_id', $user->id)->get());
        if (strtolower($user->type) == "employee")
            $business = [$transform->transform(Employee::where('user_id', $user->id)->first()->business)];
        $response = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
            "message" => "Login successful",
            "status_code" => 200,
            "id" => $user->id_hash,
            "type" => $user->type,
            "businesses" => $business,
            ];
        return response()
//            ->withHeaders([
//                'Authorization' => 'Bearer '.$token,
//                'Content-Type' => 'application/json',
//            ])
            ->json($response);
    }




    /**
     * Logout
     *
     * @authenticated
     *
     * @response {
     *      "status_code": 200,
     *      "message": "Successfully logged out"
     * }
     * @response 401 {
     *  "status_code": 401,
     *  "message": "Token has expired or invalid token"
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out', 'status_code' => 200]);
    }

    //    /**
    //     * Refresh a token.
    //     *
    //     * @return \Illuminate\Http\JsonResponse
    //     */
    //    public function refresh() {
    //        return $this->respondWithToken(auth('api')->refresh());
    //    }

}
