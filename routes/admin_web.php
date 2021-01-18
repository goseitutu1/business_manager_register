<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'is-admin']], function () {
    Route::get('home', function () {
        dd("working");
    })->name('admin.home');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    // Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('', 'UserController@index')->name('admin.user.index');
        Route::match(['get', 'post'], '/create', 'UserController@create')->name('admin.user.create');
        Route::match(['get', 'post'], '/edit/{id}', 'UserController@edit')->name('admin.user.edit');
        Route::get('view/{id}', 'UserController@view')->name('admin.user.view');
        Route::get('delete/{id}', 'UserController@delete')->name('admin.user.delete');
    });

    // Adverts
    Route::group(['prefix' => 'ads'], function () {
        Route::get('', 'AdvertController@index')->name('admin.advert.index');
        Route::post('set-price', 'AdvertController@setPrice')->name('admin.advert.set_price');
        // Route::match(['get', 'post'], '/edit/{id}', 'UserController@edit')->name('admin.user.edit');
        Route::get('view/{id}', 'AdvertController@view')->name('admin.advert.view');
        Route::get('publish/{id}', 'AdvertController@publish')->name('admin.advert.publish');
        Route::get('unpublish/{id}', 'AdvertController@unpublish')->name('admin.advert.unpublish');
        Route::get('delete/{id}', 'AdvertController@delete')->name('admin.advert.delete');
    });

    // Subscriptions
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::group(['prefix' => 'payments'], function () {
            Route::get('', ['uses' => 'SubscriptionController@userSubscriptions', 'as' => 'admin.subscription.payment.index']);
            Route::get('payment-history/{subscriptionId}', ['uses' => 'SubscriptionController@paymentHistory', 'as' => 'admin.subscription.payment.history']);
        });
        Route::group(['prefix' => 'plans'], function () {
            Route::get('', ['uses' => 'SubscriptionController@plans', 'as' => 'admin.subscription.plan.index']);
            Route::match(['get', 'post'], 'view/{id}', ['uses' => 'SubscriptionController@edit', 'as' => 'admin.subscription.plan.edit']);
        });
    });

    // Businesses
    Route::group(['prefix' => 'businesses'], function () {
        Route::get('', 'BusinessController@index')->name('admin.business.index');
        Route::get('view/{id}', 'BusinessController@view')->name('admin.business.view');
        Route::get('branches/{ownerId}', 'BusinessController@branches')->name('admin.business.branches');
        Route::get('employee/{businessId}', 'BusinessController@employees')->name('admin.business.employees');
    });

    // Reports
    Route::group(['prefix' => 'reports'], function () {
        Route::get('adverts', 'ReportController@adverts')->name('admin.reports.advert');
        Route::match(['get', 'post'], 'subscription-payments', ['uses' => 'ReportController@subscriptionPayments', 'as' => 'admin.reports.subscription_payment']);
        Route::get('feedback', 'ReportController@feedback')->name('admin.reports.feedback');
    });

    // Support
    Route::group(['prefix' => 'customer-support'], function () {
        // Frequently Asked Questions (FAQ)
        Route::group(['prefix' => 'frequently-asked-questions'], function () {
            Route::get('', ['uses' => 'FAQController@index', 'as' => 'admin.customer_support.faq.index']);
            Route::match(['get', 'post'], 'create', ['uses' => 'FAQController@create', 'as' => 'admin.customer_support.faq.create']);
            Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'FAQController@edit', 'as' => 'admin.customer_support.faq.edit']);
            Route::match(['get'], 'delete/{id}', ['uses' => 'FAQController@delete', 'as' => 'admin.customer_support.faq.delete']);
        });

        // Feedback
        Route::group(['prefix' => 'feedback'], function () {
            Route::get('', ['uses' => 'FeedbackController@index', 'as' => 'admin.customer_support.feedback.index']);
            Route::match(['get', 'post'], 'edit/{id}', ['uses' => 'FeedbackController@edit', 'as' => 'admin.customer_support.feedback.edit']);
            Route::get('close-feedback/{id}', ['uses' => 'FeedbackController@close', 'as' => 'admin.customer_support.feedback.close']);
            Route::match(['get'], 'delete/{id}', ['uses' => 'FeedbackController@delete', 'as' => 'admin.customer_support.feedback.delete']);
        });
    });
});
