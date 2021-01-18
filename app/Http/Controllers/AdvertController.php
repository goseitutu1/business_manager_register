<?php

namespace App\Http\Controllers;

use App\Api\Controllers\v1\MoMoPaymentController;
use App\Models\Advert;
use App\Models\AdvertPayment;
use App\Models\AdvertStatus;
use App\Models\MobileMoneyTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdvertController extends Controller
{
    public function index()
    {
        $ads = Advert::paginate(6);
        return view('advert.index', [
            'adverts' => $ads
        ]);
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'title' => 'required',
                // 'is_published' => 'required',
                // 'feature_image' => 'required|image|mimes:jpeg,jpg,png|dimensions:width=7360,height=3119',
            ]);

            try {
                // Handle Image
                $fileName = time() . '.' . $request->feature_image->extension();
                $request->feature_image->move(public_path('adverts'), $fileName);

                Advert::create([
                    'title' => $request->title,
                    'status_id' => AdvertStatus::where('name', 'like', 'pending approval')->first()->id,
                    'feature_image' => $fileName,
                    'author' => Auth()->user()->email
                ]);

                return redirect()->route('home')->with('alert-success', 'You have successfully added an ADVERT');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }

        return view('advert.create', [
            "page" => (object) [
                'title' => "Add New Advert", 'section' => 'Add Advert'
            ],
        ]);
    }


    public function delete(Request $request)
    {
        $item = Advert::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted advert: " . $item->name);

        return redirect()->route('advert.index')->with('alert-success', 'You have successfully DELETED an ADVERT');
    }

    public function view(Request $request)
    {
        $item = Advert::findOrFail($request->route('id', null));
        return view('advert.view', [
            "page" => (object) [
                'title' => "View Advert", 'section' => 'Advertisements'
            ],
            "data" => $item
        ]);
    }

    public function makePayment(Request $request)
    {
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'momo_number'   => 'required|string|max:20',
            ]);

            DB::transaction(function () {
                $inputs = request()->all();

                $inputs['business_id'] = session('business_id');
                $advert = Advert::findByIdHash($inputs['advert']);

                $advert_payment  = AdvertPayment::create([
                    "mobile_money_number" => $inputs['momo_number'],
                    // "amount" => $advert->price,
                    "amount" => 0.1,
                    "advert_id" => $advert->id,
                ]);
                $momo = $advert_payment->momo_transaction()->create([
                    "phone_number" => $inputs['momo_number'],
                    "amount" => $advert_payment->amount,
                    'business_id' => session('business_id'),
                    "vendor" => "MTN",
                    "message" => "MTN Business Manager advert payment",
                ]);
                $advert_payment->update(['momo_transaction_id' => $momo->id]);

                // Initiate mobile money payment
                MoMoPaymentController::initiatePaymentNew($momo,  "/api/v1/payments/adverts/callback");

                auth()->user()->log("initiated advert payment" . $this->business()->name);
            });

            return back()->with('alert-success', 'Advert Payment has been initiated. Check your wallet to authorize payment. Kindly refresh the page after approving the transaction.');
            // return redirect()->route('advert.index');
        }
    }

    /**
     * Handles Mobile Money payment api callback after initializing
     * a payment.
     * Updates the Mobile Money Transaction record with api response data
     *
     * @param Request $request
     * @return void
     */
    public function momoCallback(Request $request)
    {
        MobileMoneyTransaction::logger("Callback executed");
        try {
            $inputs = $request->all();
            logger($inputs);
            DB::transaction(function () use ($inputs) {
                $tranx = AdvertPayment::whereHas('momo_transaction', function ($row) use ($inputs) {
                    $row->where('transaction_id', $inputs['transaction_id']);
                })->first();

                $tranx->momo_transaction->update([
                    'response_status' => $inputs['status'],
                    'response_message' => $inputs['responseMessage'],
                ]);

                if (strtolower($inputs['status']) == 'success') {
                    $tranx->advert->update([
                        'status_id' => AdvertStatus::where('name', 'like', 'payment complete%')->first()->id,
                    ]);
                }
                MobileMoneyTransaction::logger($inputs['transaction_id'] . '||' . $inputs['status'] . "||" . $inputs['responseMessage']);
            });

            return ['status' => $inputs['responseMessage']];
        } catch (Exception $ex) {
            $message = $ex->getMessage() . "\t" . $ex->getLine() . "\n\n" . $ex->getTraceAsString();
            MobileMoneyTransaction::logger($message);
        }
    }
}
