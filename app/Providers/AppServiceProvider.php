<?php /** @noinspection ALL */

namespace App\Providers;

use App\Models\Employee;
use App\Models\Expense;
use App\Models\ExpensePayment;
use App\Models\Payment;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\SubscriptionPayment;
use App\Observers\EmployeeObserver;
use App\Observers\ExpenseObserver;
use App\Observers\ExpensePaymentObserver;
use App\Observers\PaymentObserver;
use App\Observers\SalesItemObserver;
use App\Observers\SalesObserver;
use App\Observers\SubscriptionPaymentObserver;
use Dingo\Api\Auth\Auth;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
   {
        // if ($this->app->isLocal()) {
        //     $this->app->register(TelescopeServiceProvider::class);
        //     //            Telescope::ignoreMigrations();
        // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $app_user = 'mtnapiuser';
//        $key = '785627664981125567';
//        $client_secrete = '$!pO3t&89n*&xxzq-45972nn@56!!';
//        $encrypted = hash_hmac('sha256', $key, $client_secrete);
//        dd($encrypted);

//        $app_user = 'testapiuser';
//        $key = '785627664981125123';
//        $client_secrete = '&xxzq-45972nn@56!!$!pO3t&89n*1';
//        $encrypted = hash_hmac('sha256', $key, $client_secrete);
//        dd($encrypted);


        Schema::defaultStringLength(191);
        Payment::observe(PaymentObserver::class);
        Expense::observe(ExpenseObserver::class);
        ExpensePayment::observe(ExpensePaymentObserver::class);
        SalesItem::observe(SalesItemObserver::class);
        Sales::observe(SalesObserver::class);
        Employee::observe(EmployeeObserver::class);
        SubscriptionPayment::observe(SubscriptionPaymentObserver::class);
    }
}
