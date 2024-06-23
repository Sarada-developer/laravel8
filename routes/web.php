<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\Login;
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

Route::get('/login',[AdminController::class,'index']); 
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');
Route::group(['middleware'=>'admin_auth'],function(){
    Route::get('/admin',[AdminController::class,'dashboard']);
    Route::get('/category',[AdminController::class,'category']);
    Route::get('/product',[AdminController::class,'product']);
    Route::post('/insert',[AdminController::class,'insert']);
    Route::post('/product_insert',[AdminController::class,'product_insert']);
    Route::get('/product_table',[AdminController::class,'product_table']);
    Route::get('/category_table',[AdminController::class,'category_table']);
    Route::get('category/edit/{id}',[AdminController::class,'category_edit']);
    Route::post('category/update/{id}',[AdminController::class,'update_category'])->name('category.update');
    Route::get('category/delete/{id}',[AdminController::class,'delete']);
    Route::get('product/edit/{id}',[AdminController::class,'product_edit']);
    Route::post('product/update/{id}',[AdminController::class,'update_product'])->name('product.update');
    Route::get('product/delete/{id}',[AdminController::class,'delete_product']);
  
});
Route::get('/',[UserController::class,'index']);
Route::post('/signup',[UserController::class,'insert']);
Route::get('/get/city/{id}',[UserController::class,'getcity']);
Route::post('/user_login',[UserController::class,'user_login']);
// Route::post('user/auth',[UserController::class,'user_auth'])->name('user.auth');
Route::get('/logout', function () {
    Session::forget('register_users');
    return redirect('/');;
  });
// Route::post('/login_insert',[Login::class,'login_insert']);
