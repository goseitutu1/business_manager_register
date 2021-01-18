<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

use Dingo\Api\Facade\Route as DingoRoute;
use Illuminate\Support\Facades\Route;

DingoRoute::version(['v1'], [], function () {

    // authentication endpoints
    DingoRoute::group(['middleware' => ['auth.apikey'], 'prefix' => 'v1/users', 'namespace' => 'App\Api\Controllers\v1'], function () {
        DingoRoute::post('register', ['uses' => 'UserController@register', 'as' => 'user.register']);
        DingoRoute::post('login', ['uses' => 'AuthController@login', 'as' => 'login']);
    });

    DingoRoute::group(['middleware' => ['api.auth', 'auth.apikey'], 'prefix' => 'v1', 'namespace' => 'App\Api\Controllers\v1'], function () {
        // user endpoints
        DingoRoute::group(['prefix' => 'users'], function () {
            DingoRoute::post('refresh', ['uses' => 'AuthController@refresh', 'as' => 'refresh']);
            DingoRoute::post('logout', ['uses' => 'AuthController@logout', 'as' => 'logout']);

            DingoRoute::post('password-reset', 'UserController@passwordReset');
            DingoRoute::match(['get', 'post'], '{id}', ['uses' => 'UserController@view', 'as' => 'user.view']);
            DingoRoute::put('{id}', ['uses' => 'UserController@update', 'as' => 'user.update']);
            DingoRoute::delete('{id}', ['uses' => 'UserController@delete', 'as' => 'user.delete']);
        });

        // business endpoints
        DingoRoute::group(['prefix' => 'businesses'], function () {
            DingoRoute::post('create', ['uses' => 'BusinessController@create', 'as' => 'business.create']);
            DingoRoute::post('{id}', ['uses' => 'BusinessController@update', 'as' => 'business.update']);
            DingoRoute::get('', ['uses' => 'BusinessController@view', 'as' => 'business.view']);
            DingoRoute::delete('{id}', ['uses' => 'BusinessController@delete', 'as' => 'business.delete']);
        });

        // currencies
        DingoRoute::get('currencies', ['uses' => 'CurrencyController@all', 'as' => 'currency.all']);

        // taxes
        DingoRoute::get('taxes', ['uses' => 'TaxController@all', 'as' => 'tax.all']);

        // account types
        DingoRoute::get('account-types', ['uses' => 'AccountTypeController@all', 'as' => 'account_type.all']);

        // accounts endpoints
        DingoRoute::group(['prefix' => 'accounts'], function () {
            DingoRoute::post('create', ['uses' => 'AccountController@create', 'as' => 'account.create']);
            DingoRoute::put('{id}', ['uses' => 'AccountController@update', 'as' => 'account.update']);
            DingoRoute::get('{id}', ['uses' => 'AccountController@view', 'as' => 'account.view']);
            DingoRoute::delete('{id}', ['uses' => 'AccountController@delete', 'as' => 'account.delete']);
        });

        // inventories
        DingoRoute::group(['prefix' => 'inventories', 'namespace' => 'Inventory'], function () {
            // other apis
            DingoRoute::get('all/{business_id}', ['uses' => 'MainController@all', 'as' => 'api.inventory.all']);

            // reorder
            DingoRoute::get('reorders/{business_id}', ['uses' => 'ReorderController@all', 'as' => 'api.inventory.reorder.all']);
            DingoRoute::post('reorders', ['uses' => 'ReorderController@create', 'as' => 'api.inventory.reorder.create']);

            // categories
            DingoRoute::get('categories', ['uses' => 'CategoryController@all', 'as' => 'api.inventory.category.all']);
            DingoRoute::get('categories/{id}', ['uses' => 'CategoryController@view', 'as' => 'api.inventory.category.view']);

            // products
            DingoRoute::post('/products', ['uses' => 'ProductController@create', 'as' => 'api.inventory.product.create']);
            DingoRoute::get('/products/{id}', ['uses' => 'ProductController@view', 'as' => 'api.inventory.product.view']);
            DingoRoute::get('{business_id}/products', ['uses' => 'ProductController@all', 'as' => 'api.inventory.product.all']);
            DingoRoute::put('/products/{id}', ['uses' => 'ProductController@update', 'as' => 'api.inventory.product.update']);
            DingoRoute::delete('/products/{id}', ['uses' => 'ProductController@delete', 'as' => 'api.inventory.product.delete']);

            // services
            DingoRoute::post('/services', ['uses' => 'ServiceController@create', 'as' => 'api.inventory.service.create']);
            DingoRoute::put('services/{id}', ['uses' => 'ServiceController@update', 'as' => 'api.inventory.service.update']);
            DingoRoute::get('{business_id}/services', ['uses' => 'ServiceController@all', 'as' => 'api.inventory.service.all']);
            DingoRoute::get('services/{id}', ['uses' => 'ServiceController@view', 'as' => 'api.inventory.service.view']);
            DingoRoute::delete('services/{id}', ['uses' => 'ServiceController@delete', 'as' => 'api.inventory.service.delete']);
        });

        // sales
        DingoRoute::group(['prefix' => 'sales', 'namespace' => 'Sales'], function () {
            // DingoRoute::post('/products', ['uses' => 'ProductController@create', 'as' => 'sales.product.create']);
            // DingoRoute::post('/products/multiple/{business_id}', ['uses' => 'ProductController@create_multiple', 'as' => 'sales.product.create_multiple']);
            DingoRoute::get('{id}', ['uses' => 'SalesController@view']);
            DingoRoute::get('{business_id}/all', ['uses' => 'SalesController@all']);
            // DingoRoute::put('/products/{id}', ['uses' => 'ProductController@update', 'as' => 'sales.product.update']);
            // DingoRoute::delete('products/{id}', ['uses' => 'ProductController@delete', 'as' => 'sales.product.delete']);

            // // products
            // DingoRoute::post('/products', ['uses' => 'ProductController@create', 'as' => 'sales.product.create']);
            // DingoRoute::post('/products/multiple/{business_id}', ['uses' => 'ProductController@create_multiple', 'as' => 'sales.product.create_multiple']);
            // DingoRoute::get('/products/{id}', ['uses' => 'ProductController@view', 'as' => 'sales.product.view']);
            // DingoRoute::get('{business_id}/products', ['uses' => 'ProductController@all', 'as' => 'sales.product.all']);
            // DingoRoute::put('/products/{id}', ['uses' => 'ProductController@update', 'as' => 'sales.product.update']);
            // DingoRoute::delete('products/{id}', ['uses' => 'ProductController@delete', 'as' => 'sales.product.delete']);

            // // services
            // DingoRoute::post('/services', ['uses' => 'ServiceController@create', 'as' => 'sales.service.create']);
            // DingoRoute::put('services/{id}', ['uses' => 'ServiceController@update', 'as' => 'sales.service.update']);
            // DingoRoute::get('{business_id}/services', ['uses' => 'ServiceController@all', 'as' => 'sales.service.all']);
            // DingoRoute::get('services/{id}', ['uses' => 'ServiceController@view', 'as' => 'sales.service.view']);
            // DingoRoute::delete('services/{id}', ['uses' => 'ServiceController@delete', 'as' => 'sales.service.delete']);
        });

        // payment
        DingoRoute::group(['prefix' => 'payments'], function () {
            DingoRoute::post('', ['uses' => 'PaymentController@create', 'as' => 'payment.create']);
            DingoRoute::get('{id}', ['uses' => 'PaymentController@view', 'as' => 'payment.view']);
            DingoRoute::get('all/{business_id}', ['uses' => 'PaymentController@all', 'as' => 'payment.all']);
            DingoRoute::get('/client-statement/{id}', ['uses' => 'PaymentController@client_statement', 'as' => 'customer.report.client_statement']);
            DingoRoute::put('{id}', ['uses' => 'PaymentController@update', 'as' => 'payment.update']);
            DingoRoute::delete('{id}', ['uses' => 'PaymentController@delete', 'as' => 'payment.delete']);
        });

        // shopping cart
        DingoRoute::group(['prefix' => 'shopping-cart'], function () {
            DingoRoute::post('add', ['uses' => 'ShoppingCartController@add_items', 'as' => 'cart.add_items']);
            DingoRoute::get('{id}', ['uses' => 'ShoppingCartController@view', 'as' => 'cart.view']);
            DingoRoute::delete('{id}', 'ShoppingCartController@delete');
        });

        // vendors
        DingoRoute::group(['prefix' => 'vendors'], function () {
            DingoRoute::post('', ['uses' => 'VendorController@create', 'as' => 'vendor.create']);
            DingoRoute::get('{id}', ['uses' => 'VendorController@view', 'as' => 'vendor.view']);
            DingoRoute::get('all/{business_id}', ['uses' => 'VendorController@all', 'as' => 'vendor.all']);
            DingoRoute::put('{id}', ['uses' => 'VendorController@update', 'as' => 'vendor.update']);
            DingoRoute::delete('{id}', ['uses' => 'VendorController@delete', 'as' => 'vendor.delete']);
        });

        // customers
        DingoRoute::group(['prefix' => 'customers'], function () {
            DingoRoute::post('', ['uses' => 'CustomerController@create', 'as' => 'customer.create']);
            DingoRoute::get('{id}', ['uses' => 'CustomerController@view', 'as' => 'customer.view']);
            DingoRoute::get('all/{business_id}', ['uses' => 'CustomerController@all', 'as' => 'customer.all']);
            DingoRoute::put('{id}', ['uses' => 'CustomerController@update', 'as' => 'customer.update']);
            DingoRoute::delete('{id}', ['uses' => 'CustomerController@delete', 'as' => 'customer.delete']);

            // reports
            DingoRoute::get('{business_id}/reports/total-customers', ['uses' => 'CustomerController@totalCustomers']);
        });

        // expenses
        DingoRoute::group(['prefix' => 'expenses', 'namespace' => 'Expense'], function () {
            // DingoRoute::post('', ['uses' => 'ExpenseController@create', 'as' => 'expense.create']);

            DingoRoute::post('paid', 'PaidExpenseController@create');
            DingoRoute::post('partial', 'PartialExpenseController@create');
            DingoRoute::post('owing', 'OwingExpenseController@create');

            DingoRoute::get('{id}', ['uses' => 'ExpenseController@view', 'as' => 'expense.view']);
            DingoRoute::get('categories/all', ['uses' => 'ExpenseController@categories', 'as' => 'expense.view']);
            DingoRoute::get('all/{business_id}', ['uses' => 'ExpenseController@all', 'as' => 'expense.all']);
            DingoRoute::put('{id}', ['uses' => 'ExpenseController@update', 'as' => 'expense.update']);
            DingoRoute::delete('{id}', ['uses' => 'ExpenseController@delete', 'as' => 'expense.delete']);

            DingoRoute::group(['prefix' => '{business_id}/reports'], function () {
                DingoRoute::get('summary', ['uses' => 'ReportController@summary']);
            });
        });

        // employees
        DingoRoute::group(['prefix' => 'employees'], function () {
            DingoRoute::post('', ['uses' => 'EmployeeController@create', 'as' => 'employee.create'])->middleware('can:create-employee');
            DingoRoute::get('{id}', ['uses' => 'EmployeeController@view', 'as' => 'employee.view']);
            DingoRoute::get('all/{business_id}', ['uses' => 'EmployeeController@all', 'as' => 'employee.all']);
            DingoRoute::put('{id}', ['uses' => 'EmployeeController@update', 'as' => 'employee.update'])->middleware('can:update-employee');;
            DingoRoute::delete('{id}', ['uses' => 'EmployeeController@delete', 'as' => 'employee.delete'])->middleware('can:delete-employee');;
        });

        // reports
        DingoRoute::group(['prefix' => 'reports/{business_id}'], function () {
            DingoRoute::get('debtors-list', 'ReportController@debtorsList');
            DingoRoute::get('sales', 'ReportController@sales');
            DingoRoute::get('inventory',  'ReportController@inventory');
            DingoRoute::get('finance', 'ReportController@finance');
            DingoRoute::get('users', 'ReportController@users');
            DingoRoute::get('all', 'ReportController@all');
        });

        // adverts
        DingoRoute::group(['prefix' => 'adverts'], function () {
            DingoRoute::get('all', 'AdvertController@all');
            DingoRoute::get('{id}', 'AdvertController@view');
        });

        // feedback
        DingoRoute::group(['prefix' => 'faq'], function () {
            DingoRoute::get('all', 'FAQController@all');
        });
    });

    // mobile money payment callbacks
    DingoRoute::group(['prefix' => 'v1/payments'], function () {
        DingoRoute::match(['get', 'post'], '/momo/callback', 'App\Api\Controllers\v1\MoMoPaymentController@momoCallback')->name('momo.callback');
        DingoRoute::match(['get', 'post'], 'subscriptions/callback', 'App\Http\Controllers\SubscriptionController@momoCallback')->name('subscription.callback');
        DingoRoute::match(['get', 'post'], 'adverts/callback', 'App\Http\Controllers\AdvertController@momoCallback')->name('advert.callback');
    });
});



Route::post('register/user','apiController@register');
Route::any('tmp/registration', 'apiController@tmp_register')->name('api.register');
Route::any('login', ['uses' => 'apiController@login', 'as' => 'login']);
Route::prefix('subscription')->group(function (){
    Route::any('list', ['uses' => 'apiController@subscription_list', 'as' => 'subscription.list']);
    Route::any('pay', ['uses' => 'apiController@subscriptionPayment', 'as' => 'subscription.payment']);
    Route::any('callback', ['uses' => 'apiController@subscription_cbk', 'as' => 'subscription.cbk']);
    Route::any('checkPayment', ['uses' => 'apiController@checkPayment', 'as' => 'subscription.checkPayment']);
    Route::any('all', ['uses' => 'apiController@all', 'as' => 'subscription.all']);
    Route::any('getExpiry', ['uses' => 'apiController@getExpiry', 'as' => 'subscription.getExpiry']);
    Route::any('setExpiry', ['uses' => 'apiController@setExpiry', 'as' => 'subscription.setExpiry']);
    Route::any('getSubscriptionList', ['uses' => 'apiController@getSubscription', 'as' => 'subscription.list.ussd']);
    Route::any('subscribeUser', ['uses' => 'apiController@subscribeUser', 'as' => 'subscription.user']);
});

Route::any('legal/check', 'apiController@check_legal_status')->name('api.check.legal');

