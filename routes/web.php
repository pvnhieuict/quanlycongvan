<?php


use App\Http\Controllers\DocumentinController;
use App\Http\Controllers\DocumentoutController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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
Route::view('/error','error');
Route::get('/',[CustomAuthController::class, 'dashboard']);
//Route::resource('quyen',PermissionController::class);
Route::resource('loai-cong-van',TypeController::class)->middleware('auth');
Route::resource('cong-van-den',DocumentinController::class)->middleware('auth');
Route::patch('cvd-lanhdaogiaoviec/{cong_van_den}',[DocumentinController::class,'lanhdaogiaoviec'])->middleware('auth')->name('documentins.lanhdaogiaoviec');
Route::patch('cvd-lanhdaogiaoviec/{cong_van_di}',[DocumentoutController::class,'lanhdaogiaoviec'])->middleware('auth')->name('documentouts.lanhdaogiaoviec');
Route::get('ql-cong-van-den',[DocumentinController::class,'index_qlcvd'])->name('qlcvd');
Route::get('ql-cong-van-den-tre-han',[DocumentinController::class,'index_qlcvdth'])->name('qlcvdth');
Route::get('ql-cong-van-di-tre-han',[DocumentoutController::class,'index_qlcvdith'])->name('qlcvdith');
Route::patch('cvdaxuly/{cong_van_den}',[DocumentinController::class,'cvdaxuly'])->middleware('auth')->name('documentins.cvdaxuly');
Route::patch('cvdidaxuly/{cong_van_di}',[DocumentoutController::class,'cvdidaxuly'])->middleware('auth')->name('documentouts.cvdidaxuly');
Route::resource('cong-van-di',DocumentoutController::class)->middleware('auth');
Route::get('ql-cong-van-di',[DocumentoutController::class,'index_qlcvdi'])->middleware('auth')->name('qlcvdi');
Route::get('congviec',[WorkController::class,'index'])->middleware('auth')->name('congviec');
Route::resource('don-vi',GroupController::class);
Route::resource('nguoi-dung',UserController::class)->middleware('auth');
Route::get('editProfileGet/{nguoi_dung}/profile',[UserController::class,'profile'])->middleware('auth')->name('editProfileGet');
Route::patch('updateprofile/{nguoi_dung}',[UserController::class,'updateprofile'])->middleware('auth')->name('nguoi-dung.updateprofile');

Route::get('/truy-luc', SearchController::class)->name('truy-luc');
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('/changePassword', [CustomAuthController::class, 'changePasswordPost'])->name('changePasswordPost');
Route::get('/changePassword', [CustomAuthController::class, 'showChangePasswordGet'])->name('changePasswordGet');
Route::get('autocomplete', [UserController::class, 'autocomplete'])->name('autocomplete');