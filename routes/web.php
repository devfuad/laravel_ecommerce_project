<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });


//frontend

Route::get('/', [FrontendController::class, 'home'])->name('index');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
// Route::get('/master', [FrontendController::class, 'master']);
// Route::get('/index', [FrontendController::class, 'index']);
Route::get('/product/details/{slug}', [FrontendController::class, 'details'])->name('product.details');
Route::post('/getSize', [FrontendController::class, 'getSize']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// users
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/users/delete/{user_id}', [UserController::class, 'delete'])->name('delete');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/name/update', [UserController::class, 'name_update'])->name('name.update');
Route::post('/pass/update', [UserController::class, 'pass_update'])->name('pass.update');
Route::post('/photo/update', [UserController::class, 'photo_update'])->name('photo.update');

// category 
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/restore/{category_id}', [CategoryController::class, 'category_restore'])->name('category.restore');
Route::get('/category/force/delete/{category_id}', [CategoryController::class, 'category_force_delete'])->name('category.force.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');

// subcategory
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/store', [SubcategoryController::class, 'subcategory_store'])->name('subcategory.store');
// Route::post('/getsubcategory', [SubcategoryController::class, 'getsubcategory'])

// product
Route::get('/add/product', [ProductController::class, 'add_product'])->name('add.product');
Route::POST('/getsubcategory', [ProductController::class, 'getsubcategory']);
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('/product/inventory/{product_id}', [ProductController::class, 'product_inventory'])->name('product.inventory');
Route::post('/product/inventory/store', [ProductController::class, 'inventory_store'])->name('inventory.store');
Route::get('/product/inventory/delete/{inventory_id}', [ProductController::class, 'inventory_delete'])->name('inventory.delete');
Route::get('/product/delete/{product_id}', [ProductController::class, 'product_delete'])->name('product.delete');

//variation
Route::get('/product/variation', [ProductController::class, 'product_variation'])->name('product.variation');
Route::post('/add/color', [ProductController::class, 'add_color'])->name('add.color');
Route::get('/color/delete/{color_id}', [ProductController::class, 'color_delete'])->name('color.delete');
Route::post('/add/size', [ProductController::class, 'add_size'])->name('add.size');
Route::get('/size/delete/{size_id}', [ProductController::class, 'size_delete'])->name('size.delete');

//customer login/registration
Route::get('/customer/register/login', [FrontendController::class, 'customer_register_login'])->name('customer.register.login');
Route::post('/customer/store', [CustomerRegisterController::class, 'customer_store'])->name('customer.store');
Route::post('/customer/login', [CustomerLoginController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/logout', [CustomerLoginController::class, 'customer_logout'])->name('customer.logout');

//cart
Route::post('/cart/store', [CartController::class, 'cart_store'])->name('cart.store');
Route::get('/cart/remove/{cart_id}', [CartController::class, 'remove_cart'])->name('remove.cart');
Route::get('/clear/cart', [CartController::class, 'clear_cart'])->name('clear.cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'update_cart'])->name('update.cart');

//coupon
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/coupon/store', [CouponController::class, 'coupon_store'])->name('coupon.store');
Route::get('/coupon/delete/{coupon_id}', [CouponController::class, 'coupon_delete'])->name('coupon.delete');

//checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/getCity', [CheckoutController::class, 'getCity']);
Route::post('/order/store', [CheckoutController::class, 'order_store'])->name('order.store');
Route::get('/order/success', [CheckoutController::class, 'order_success'])->name('order.success');



?>
