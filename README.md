## Open Source Billing Platform

Ari is an Open Source Billing, Support, and Customer Management platform. We utilize Laravel (latest) as a base framework.

Features List (in development)

 * Customer Management
 * Customer Login
 * Customer Registration
 * Support Panel
 * Invoicing
 * Payments via PayPal, Bitcoin, and Stripe
 * Administration of Products, Services, Invoices, Support, Customers, etc.
 * and many more features!


The goal of Ari is be simple, clean, and fast. We are making Ari 100% free, and open-source. If you would like to donate you can donate via Bitcoin to `1D6itrmkshajGh9zSPvJGGpz9Gf3TPt1JD`

We use the Blade template engine in Laravel to make things easy for templating.

Ari has beautiful routing, that you can change on the fly, here's a few examples:

```php
// Routing
Route::get('/', 'WebsiteController@homepage'); // Homepage
Route::get('/about', 'WebsiteController@aboutpage'); // About Page
Route::get('/blog', 'BlogController@homepage'); // Built in Blogging System
Route::get('/blog/{id}', 'BlogController@viewBlogPost'); // Built in Blogging System
Route::get('/p/{slug}', 'CustomPageController@viewPage'); // Custom Pages
```


### Stuff used to make this:

 * [Laravel](https://github.com/laravel/laravel) for the core framework
 * [Cloud9](https://c9.io) as a testing environment

### Want to contribute?

Awesome! Feel free to submit pull requests, point out issues, or even pitch in on development!
