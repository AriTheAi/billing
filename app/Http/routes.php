<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'WebsiteController@homepage');
    Route::get('/about', 'WebsiteController@aboutpage');
    Route::get('/blog', 'BlogController@homepage');
    Route::get('/blog/{id}', 'BlogController@viewBlogPost');
    Route::get('/p/{slug}', 'CustomPageController@viewPage');
    // Client Controller Section
    Route::get('/client', 'ClientController@landingPage');
    Route::get('/client/login', 'ClientController@loginPage');
    Route::post('/client/login', 'ClientController@loginAttempt');
    Route::get('/client/register', 'ClientController@registerPage');
    Route::post('/client/register', 'ClientController@registerAttempt');
    Route::get('/client/home', 'ClientController@clientHomepage');
    Route::get('/client/products/list', 'ClientController@productListPage');
    Route::get('/client/products/c/{id}', 'ClientController@viewProductsInCategory');
    Route::get('/client/product/{id}', 'ClientController@viewProductByID');
    Route::get('/client/purchase/{id}', 'ClientController@purchaseProductPage');
    Route::get('/client/invoices', 'ClientController@listInvoices');
    Route::get('/client/invoice/{id}', 'ClientController@viewInvoiceByID');
    
    // Password Recovery
    Route::get('/client/forgotpassword','ClientController@forgetPasswordPage');
    Route::post('/client/forgotpassword','ClientController@sendResetEmail');
    Route::get('/client/reset/{token}','ClientController@resetPasswordDialog');
    Route::post('/client/reset/{token}','ClientController@resetPassword');
});