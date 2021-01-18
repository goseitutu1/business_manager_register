<?php

use App\Models\Business;
use App\Models\FAQ;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/home', 'HomeController@index')->middleware(['auth'])->name('home');


// change the active business to new business
Route::get('/change-business/{id?}', function ($id = null) {
    $user = auth()->user();
    if ("employee" == $user->type) {
        return redirect()->route('dashboard');
    }
    if ($id != null) {
        $business = Business::findByIdHash($id);
        Session::put('business_id', $business->id);
    } else if ($id == null) {
        $business = $user->businesses()->first();
        Session::put('business_id', $business->id);
    }
    return redirect()->route('dashboard');
})->middleware(['auth', 'selected-business'])->name('change-business');


Route::group(['middleware' => ['auth']], function () {
    Route::match(['get', 'post'], 'business/setup-business', ['uses' => 'BusinessController@createFromSignupPage', 'as' => 'business.create_from_signup']);
});

Route::group(['middleware' => ['auth', 'selected-business']], function () {

    // Subscriptions
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::group(['prefix' => 'payments'], function () {
            Route::get('', ['uses' => 'SubscriptionController@index', 'as' => 'subscription.payment.index']);
            Route::match(['get', 'post'], 'make-payment', ['uses' => 'SubscriptionController@create', 'as' => 'subscription.payment.create']);
        });
        Route::group(['prefix' => 'plans', 'namespace' => 'Subscription'], function () {
            Route::get('', ['uses' => 'SubscriptionPlanController@index', 'as' => 'subscription.plan.index']);
            Route::match(['get', 'post'], 'subscribe', ['uses' => 'SubscriptionPlanController@subscribe', 'as' => 'subscription.plan.create']);
            Route::match(['get', 'post'], 'subscription-august-promotion', ['uses' => 'SubscriptionPlanController@promotion', 'as' => 'subscription.plan.promotion']);
            Route::match(['get'], 'activate-subscription-plan/{planId}', ['uses' => 'SubscriptionPlanController@activatePlan', 'as' => 'subscription.plan.activate']);
        });
    });

    Route::match(['get', 'post'], 'business/choose-subscription-plan', ['uses' => 'BusinessController@subscriptionPackages', 'as' => 'business.choose_subscription_plan']);
    Route::match(['get', 'post'], 'change-logo', ['uses' => 'BusinessController@changeLogo', 'as' => 'business.change_lgo']);

    // Customer Support
    Route::group(['prefix' => 'customer-support'], function () {
        // Frequently Asked Questions (FAQ)
        Route::get('frequently-asked-questions', function () {
            return view('faq', ['faq' => FAQ::all()]);
        })->name('customer_support.faq');

        // Feedback
        Route::group(['prefix' => 'feedback'], function () {
            Route::get('', ['uses' => 'FeedbackController@index', 'as' => 'customer_support.feedback.index']);
            Route::match(['get', 'post'], 'create', ['uses' => 'FeedbackController@create', 'as' => 'customer_support.feedback.create']);
            Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'FeedbackController@edit', 'as' => 'customer_support.feedback.edit']);
            Route::match(['get'], 'delete/{id}', ['uses' => 'FeedbackController@delete', 'as' => 'customer_support.feedback.delete']);
        });
    });

    Route::group(['middleware' => ['is-subscription-expired']], function () {

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::group(['prefix' => 'inventory', 'namespace' => 'Inventory'], function () {
            // categories
            Route::group(['prefix' => 'category'], function () {
                Route::get('', ['uses' => 'CategoryController@index', 'as' => 'inventory.category.index']);
                Route::match(['get', 'post'], 'create', ['uses' => 'CategoryController@create', 'as' => 'inventory.category.create']);
                Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'CategoryController@edit', 'as' => 'inventory.category.edit']);
                Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'CategoryController@delete', 'as' => 'inventory.category.delete']);
            });

            // services
            Route::group(['prefix' => 'service'], function () {
                Route::get('', ['uses' => 'ServiceController@index', 'as' => 'inventory.service.index']);
                Route::match(['get', 'post'], 'create', ['uses' => 'ServiceController@create', 'as' => 'inventory.service.create']);
                Route::match(['get', 'post'], 'import', ['uses' => 'ServiceController@import', 'as' => 'inventory.service.import']);
                Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'ServiceController@edit', 'as' => 'inventory.service.edit']);
                Route::match(['get'], 'view/{id}', ['uses' => 'ServiceController@view', 'as' => 'inventory.service.view']);
                Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'ServiceController@delete', 'as' => 'inventory.service.delete']);

                Route::get('/download-template', function () {
                    return response()->download(public_path('storage/templates/inventory_services.xlsx'));
                })->name('inventory.service.download_template');
            });

            // products
            Route::group(['prefix' => 'product'], function () {
                Route::get('', ['uses' => 'ProductController@index', 'as' => 'inventory.product.index']);
                Route::get('view/{id}', ['uses' => 'ProductController@view', 'as' => 'inventory.product.view']);
                Route::match(['post', 'get'], 'import', ['uses' => 'ProductController@import', 'as' => 'inventory.product.import']);
                Route::match(['get', 'post'], 'create', ['uses' => 'ProductController@create', 'as' => 'inventory.product.create']);
                Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'ProductController@edit', 'as' => 'inventory.product.edit']);
                Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'ProductController@delete', 'as' => 'inventory.product.delete']);

                Route::get('/download-template', function () {
                    return response()->download(public_path('storage/templates/inventory_products.xlsx'));
                })->name('inventory.product.download_template');
            });
        });

        // sales
        Route::group(['prefix' => 'sales', 'namespace' => 'Sales'], function () {
            // services sales
            Route::group(['prefix' => 'services'], function () {
                Route::get('', ['uses' => 'ServiceController@index', 'as' => 'sales.service.index']);
                Route::get('print', ['uses' => 'ServiceController@receiptPrint', 'as' => 'sales.service.print']);
                Route::match(['get', 'post'], 'create', ['uses' => 'ServiceController@create', 'as' => 'sales.service.create']);
                Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'ServiceController@edit', 'as' => 'sales.service.edit']);
            });

            // product sales
            Route::group(['prefix' => 'product'], function () {
                Route::get('', ['uses' => 'ProductController@index', 'as' => 'sales.product.index']);
                Route::get('print', ['uses' => 'ProductController@receiptPrint', 'as' => 'sales.product.print']);
                Route::match(['get', 'post'], 'create', ['uses' => 'ProductController@create', 'as' => 'sales.product.create']);
                Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'ProductController@edit', 'as' => 'sales.product.edit']);
            });

            // payments
            Route::group(['prefix' => 'payment', 'namespace' => 'Payments'], function () {
                // paid
                Route::get('paid', ['uses' => 'PaidController@index', 'as' => 'sales.payment.paid']);

                // owing & parital
                Route::get('owing', ['uses' => 'OwingController@index', 'as' => 'sales.payment.owing.index']);
                // Route::match(['get', 'post'], 'create', ['uses' => 'ProductController@create', 'as' => 'sales.product.create']);
                Route::match(['get', 'post'], 'update-payment/{id}', ['uses' => 'OwingController@update', 'as' => 'sales.payment.owing.update']);
                // Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'ProductController@delete', 'as' => 'sales.product.delete']);
            });
        });

        // customers
        Route::group(['prefix' => 'customers'], function () {
            Route::get('', ['uses' => 'CustomerController@index', 'as' => 'customer.index']);
            Route::get('view/{id}', ['uses' => 'CustomerController@view', 'as' => 'customer.view']);
            Route::get('transactions/{id}', ['uses' => 'CustomerController@transactions', 'as' => 'customer.transactions']);
            Route::match(['get', 'post'], 'create', ['uses' => 'CustomerController@create', 'as' => 'customer.create']);
            Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'CustomerController@edit', 'as' => 'customer.edit']);
            Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'CustomerController@delete', 'as' => 'customer.delete']);
        });

        // accounts
        Route::group(['prefix' => 'journal', 'namespace' => 'Account'], function () {
            // gl accounts
            // Route::group(['prefix' => 'accounts'], function () {
            //     Route::get('', ['uses' => 'GLController@index', 'as' => 'account.gl.index']);
            // });

            // general journal
            Route::group(['prefix' => 'general-journal'], function () {
                Route::get('', ['uses' => 'JournalController@index', 'as' => 'account.journal.index']);
                Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'JournalController@edit', 'as' => 'account.journal.edit']);
                Route::get('view/{id}', ['uses' => 'JournalController@view', 'as' => 'account.journal.view']);
                Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'JournalController@delete', 'as' => 'account.journal.delete']);
            });
        });

        // expense
        Route::group(['prefix' => 'expenses', 'namespace' => 'Expense'], function () {
            // main
            Route::group(['prefix' => ''], function () {
                Route::get('', ['uses' => 'ExpenseController@index', 'as' => 'expense.index']);
                Route::match(['get', 'post'], 'create', ['uses' => 'ExpenseController@create', 'as' => 'expense.create']);
                Route::get('{expense}/edit', 'ExpenseController@edit')->name('expense.edit');
                Route::patch('{expense}/update', 'ExpenseController@update')->name('expense.update');
                Route::any('{expense}/delete', 'ExpenseController@destroy')->name('expense.delete');
            });

            // expense payments
            Route::group(['prefix' => '{expense_id}/payments'], function () {
                Route::get('', ['uses' => 'PaymentsController@index', 'as' => 'expense.payments.index']);
                Route::match(['get', 'post'], 'create', ['uses' => 'PaymentsController@create', 'as' => 'expense.payments.create']);
                Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'PaymentsController@delete', 'as' => 'expense.payments.delete']);
            });

            // categories
            Route::group(['prefix' => 'category'], function () {
                Route::get('', ['uses' => 'CategoryController@index', 'as' => 'expense.category.index']);
                Route::match(['get', 'post'], 'create', ['uses' => 'CategoryController@create', 'as' => 'expense.category.create']);
                Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'CategoryController@edit', 'as' => 'expense.category.edit']);
                Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'CategoryController@delete', 'as' => 'expense.category.delete']);
            });
        });

        // employees
        Route::group(['prefix' => 'employees'], function () {
            Route::get('', ['uses' => 'EmployeeController@index', 'as' => 'employee.index']);
            Route::match(['get', 'post'], 'create', ['uses' => 'EmployeeController@create', 'as' => 'employee.create']);
            Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'EmployeeController@edit', 'as' => 'employee.edit']);
            Route::match(['get', 'post'], 'delete/{id}', ['uses' => 'EmployeeController@delete', 'as' => 'employee.delete']);
        });

        // business
        Route::group(['prefix' => 'business'], function () {
            Route::get('', ['uses' => 'BusinessController@index', 'as' => 'business.index']);
            Route::match(['get', 'post'], 'create', ['uses' => 'BusinessController@create', 'as' => 'business.create']);
            Route::match(['get'], 'view/{id}', ['uses' => 'BusinessController@view', 'as' => 'business.view']);
            Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'BusinessController@edit', 'as' => 'business.edit']);
        });

        // suppliers
        Route::group(['prefix' => 'suppliers'], function () {
            Route::get('', ['uses' => 'SupplierController@index', 'as' => 'suppliers.index']);
            Route::match(['get', 'post'], 'create', ['uses' => 'SupplierController@create', 'as' => 'suppliers.create']);
            Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'SupplierController@edit', 'as' => 'suppliers.edit']);
            Route::match(['get'], 'view/{id}', ['uses' => 'SupplierController@view', 'as' => 'suppliers.view']);
            Route::match(['get'], 'delete/{id}', ['uses' => 'SupplierController@delete', 'as' => 'suppliers.delete']);
        });

        // Adverts
        Route::group(['prefix' => 'adverts'], function () {
            Route::get('index', ['uses' => 'AdvertController@index', 'as' => 'advert.index']);
            Route::post('make-payment', ['uses' => 'AdvertController@makePayment', 'as' => 'advert.make_payment']);
            Route::match(['get', 'post'], 'create', ['uses' => 'AdvertController@create', 'as' => 'advert.create']);
            Route::match(['get'], 'delete/{id}', ['uses' => 'AdvertController@delete', 'as' => 'advert.delete']);
            Route::match(['get'], 'view/{id}', ['uses' => 'AdvertController@view', 'as' => 'advert.view']);
        });
    });
});
