<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\DataTables\BusinessDataTable;
use App\Http\Requests\BusinessRequest;
use App\Models\Business;
use App\Models\Currency;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    public function index(BusinessDataTable $dataTable)
    {
        return $dataTable->render('business.index', [
            "page" => (object) [
                'title' => "Businesses", 'section' => 'Businesses'
            ],
        ]);
    }

    /**
     * Returns a views which new users will choose a subscription plan
     * @param BusinessRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscriptionPackages(BusinessRequest $request)
    {
        return view('business.subscription_packages', [
            'currencies' => Currency::all(),
            'plans' => SubscriptionPlan::all()
        ]);
    }

    /**
     * Creates new business after creating an account.
     * It uses login view template so this function can not be
     * used in the General>Business section
     *
     * @param BusinessRequest $request
     * @return void
     */
    public function createFromSignUpPage(BusinessRequest $request)
    {
        if ("POST" == request()->method()) {
            DB::transaction(function () use (&$request) {
                $this->store($request);
                $data = ['user' => auth()->user()];

                Mail::send("emails.new_subscriber", $data, function ($mail) use ($data) {
                    $mail->subject("MTN Business Manager Registration")
                         ->to($data['user']->email);
                });


                if (now()->year == 2020 && in_array(now()->month, [7, 8,9])) {
                    $user = auth()->user();
                    $plan = SubscriptionPlan::query()->where('name', 'like', 'Enterprise')->first();

                    if (isset($user->subscription)) {
                        $user->subscription->update([
                            'plan_id' => $plan->id,
                            'status' => 'paid',
                            'is_active' => true,
                            'is_first_time' => false,
                            'expiry_date' => now()->addDays(30),
                            'last_payment_date' => now()
                        ]);
                    } else {
                        $user->subscriptions()->create([
                            'plan_id' => $plan->id,
                            'status' => 'paid',
                            'is_active' => true,
                            'is_first_time' => false,
                            'expiry_date' => now()->addDays(30),
                            'last_payment_date' => now(),
                        ]);
                    }

                    $user->log("Subscribed user to august promotion" . $this->business()->name);
                    Session::flash('alert-success', "Congratulations! You have been given a 30 Day free trial subscription on our Enterprise Plan");
                }


            });

//            return redirect()->route('home');
            return redirect()->route('myregister');
            // return redirect()->route('business.choose_subscription_plan');
        }

        return view('business.new', [
            'currencies' => Currency::all()
        ]);
    }

    /**
     * Create new business from the General>Business side bar
     * It uses default dashboard view it can be called anywhere
     * except on any view which uses login page
     *
     * @param BusinessRequest $request
     * @return void
     */
    public function create(BusinessRequest $request)
    {
        if ("POST" == request()->method()) {
            $this->store($request);
            return redirect()->route('business.index');
        }

        return view('business.create', [
            'currencies' => Currency::all(),
            "page" => (object) [
                'title' => "Businesses", 'section' => 'Business | Create'
            ],
        ]);
    }

    public function view(BusinessRequest $request)
    {
        $business = Business::findOrFail($request->route('id', null));

        return view('business.view', [
            "page" => (object) [
                'title' => "Businesses", 'section' => 'Business | Details'
            ],
            'data' => $business
        ]);
    }

    public function edit(BusinessRequest $request)
    {
        $business = Business::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $inputs = $request->all();
            $inputs['owner_id'] = auth()->user()->id;

            // save business logo
            if (request()->hasFile('logo')) {
                $file = $request->file('logo');
                $name = $inputs['name'] . '.' . $file->extension();
                $path = $file->storeAs('/public/logos', $name);
                $inputs['logo'] = Storage::url("$path");
            }
            $business->update($inputs);

            auth()->user()->log("updated business " . $business->name);

            Session::flash('alert-success', 'Business Updated Successfully');
            return redirect()->route('business.index');
        }

        return view('business.edit', [
            "page" => (object) [
                'title' => "Edit Businesses", 'section' => 'Business | Details'
            ],
            'data' => $business,
            'currencies' => Currency::all()
        ]);
    }

    public function changeLogo(Request $request)
    {
        if ($request->hasFile('business_logo_file')) {
            $file = $request->file('business_logo_file');
            $name = $this->business()->name . '.' . $file->extension();
            $path = $file->storeAs('/public/logos', $name);
            $this->business()->update(['logo' => Storage::url("$path")]);
        }
        return back();
    }

    private function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['owner_id'] = auth()->user()->id;
        $inputs['currency_id'] = 1;

        // save business logo
        if (request()->hasFile('logo')) {
            $file = $request->file('logo');
            $name = $inputs['name'] . '.' . $file->extension();
            $path = $file->storeAs('/public/logos', $name);
            $inputs['logo'] = Storage::url("$path");
        }
        $business = Business::create($inputs);

        Session::put('business_id', $business->id);

        auth()->user()->log("created new business " . $business->name);

        Session::flash('alert-success', 'Business Created Successfully');
    }
}
