<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'showWelcomePage'])->name('welcome');

Route::get('authorization', [LoginController::class, 'authorization'])->name('authorization');

Route::get('categories/{title}-{id}/products', [CategoryProductController::class, 'showProducts'])->name('categories.products.show');

Route::get('products/{title}-{id}', [ProductController::class, 'showProduct'])->name('products.show');

Route::get('products/{title}-{id}/purchase', [ProductController::class, 'purchaseProduct'])->name('products.purchase');

Route::get('products/publish', [ProductController::class, 'showPublishProductForm'])->name('products.publish');

Route::post('products/publish', [ProductController::class, 'publishProduct']);

/*
 Route::get('/', function () {
    return view('welcome');
});
 */

// Desactivamos las opciones de Registrarse e incluso "Recuperar contraseña".
Auth::routes([
    'register'  => false,
    'reset'     => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home/purchases', [App\Http\Controllers\HomeController::class, 'showPurchases'])->name('purchases');

Route::get('/home/products', [App\Http\Controllers\HomeController::class, 'showProducts'])->name('products');
