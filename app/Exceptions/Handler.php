<?php

namespace App\Exceptions;

use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        $this->sendErrorToControlPanel($exception);
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // if (config('app.debug')) {
        //     $whoops = new \Whoops\Run;

        //     if ($request->ajax()) {
        //         $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);
        //     } else {
        //         $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        //     }

        //     return response(
        //         $whoops->handleException($exception),
        //         $exception->getStatusCode(),
        //         $exception->getHeaders()
        //     );
        // }


        return parent::render($request, $exception);
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception  $e
     * @return mixed
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug')) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

            return response()->make(
                $whoops->handleException($e),
                method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
                method_exists($e, 'getHeaders') ? $e->getHeaders() : []
            );
        }

        return parent::convertExceptionToResponse($e);
    }

    /**
     * Sends errors to control panel api
     * @param Exception $exception
     */
    private function sendErrorToControlPanel(Exception $exception)
    {
        //error message  to submit
        $requestParam = [
            'message' => '"' . $exception->getMessage() . '" in file "' . $exception->getFile() . '" line ' . $exception->getLine(),
            'current_url' => url()->current(),
            'session' => session()->all()
        ];


        // if we are in local development, do not send error
        // omit this check if testing, ensure support is aware this is just a test.
        if (app()->environment('local')) return;

        //initialize curl
        $curl = curl_init();
        //prepare data to be sent
        $data = [
            'application_id' => 5, // using the api endpoint in the docs, ensure you use the id for this app. if id does not exist, ensure it is created
            'description' => json_encode($requestParam),
            'secret' => 'VZKXKKD8GNJNABSOSRELFTUCBVBUGIXGEHZVJA5NRAFZ7BHGRDYQY5HAUYW9'
        ];

        //attach the client name and email if authenticated.
        if (Auth::user() != null) {
            //use the field in the table for the application ie name, fullname, username etc
            $data['client_name'] = auth()->user()->first_name . ' ' . auth()->user()->last_name;
            //if email is available, add this line
            $data['client_email'] = auth()->user()->email;
        }

        //set curl parameters
        curl_setopt_array($curl,
            [
                CURLOPT_URL => "https://controlpanel-api.npontu.com/api/v1/tickets/alert/application",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data
            ]
        );

        //response from the api
        $response = curl_exec($curl);
        curl_close($curl);
        $this->log($response);
    }

    /**
     * Log activities
     * @param $message
     */
    private function log($message)
    {
        $now = Carbon::parse(now());
        file_put_contents(storage_path() . '/logs/control-panel-responses.log', "\n" . 'INFO: ' . $now . ' || ' . $message . PHP_EOL, FILE_APPEND);
    }
}
