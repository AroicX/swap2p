<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProofController;
use App\Http\Middleware\Administrator;
use Twilio\Rest\Client;

Route::get('/', [HomeController::class, "index"])->name('home')->middleware('auth');
Route::get('/backoffice', [HomeController::class, "index"])->name('dashboard')->middleware('auth');
Route::get('/signup/{ref}', [AuthController::class, "referral_link"])->name('referral.link');
Route::get('/backoffice/login', [AuthController::class, "login"])->name('login');
Route::post('/backoffice/signin', [AuthController::class, "signin"])->name('signin');
Route::get('/backoffice/signup', [AuthController::class, "signup"])->name('signup');
Route::post('/backoffice/register', [AuthController::class, "register"])->name('register');
Route::get('/backoffice/reset/password', [AuthController::class, "reset"])->name('reset');
Route::get('/backoffice/logout', [AuthController::class, "logout"])->name('logout')->middleware('auth');


//
Route::get('/backoffice/profile', [HomeController::class, "profile"])->name('profile')->middleware('auth');
Route::get('/backoffice/profile/edit', [HomeController::class, "edit_profile"])->name('edit.profile')->middleware('auth');
Route::get('/backoffice/profile/verify', [HomeController::class, "activate"])->name('activate')->middleware('auth');
Route::get('/backoffice/profile/bank/details', [HomeController::class, "bank"])->name('bank')->middleware('auth');
Route::get('/backoffice/referral/downlines', [HomeController::class, "downlines"])->name('downlines')->middleware('auth');
Route::get('/backoffice/referral/genealogy', [HomeController::class, "genealogy"])->name('genealogy')->middleware('auth');
Route::get('/backoffice/payment/history', [HomeController::class, "payment_history"])->name('payment.history')->middleware('auth');
///
Route::post('/backoffice/profile/update', [UserController::class, "update_profile"])->name('update.profile')->middleware('auth');
Route::post('/backoffice/profile/password', [UserController::class, "update_password"])->name('update.password')->middleware('auth');
Route::post('/backoffice/profile/bank/details/update', [UserController::class, "update_bank"])->name('bank.update')->middleware('auth');
Route::post('/backoffice/profile/activation', [UserController::class, "verify"])->name('verify')->middleware('auth');
Route::get('/backoffice/merging', [UserController::class, "merging"])->name('merging')->middleware('auth');
Route::get('/backoffice/queue', [UserController::class, "queue"])->name('queue')->middleware('auth');
Route::get('/backoffice/growth', [UserController::class, "growth"])->name('growth')->middleware('auth');
Route::get('/backoffice/upload/proof', [UserController::class, "upload_proof"])->name('upload.proof')->middleware('auth');
Route::post('/backoffice/proof/save', [ProofController::class, "upload"])->name('save.proof')->middleware('auth');
Route::post('/backoffice/proof/delete', [ProofController::class, "remove"])->name('delete.proof')->middleware('auth');
Route::get('/backoffice/proof/{pid}', [ProofController::class, "view"])->name('view.proof')->middleware('auth');
Route::post('/backoffice/proof/verify', [ProofController::class, "verify"])->name('verify.proof')->middleware('auth');
Route::get('/backoffice/upgrade', [UserController::class, "upgrade"])->name('upgrade')->middleware('auth');
Route::post('/backoffice/upgrade/stage', [UserController::class, "stage_upgrade"])->name('stage.upgrade')->middleware('auth');

//
Route::get('/expired/acount', [HomeController::class, "expired"])->middleware('auth');
//

Route::middleware(['admin'])->group(function () {


  Route::get('/manage-activites', [AdministratorController::class, "activites"])->name('admin.activites');
  Route::get('/manage-users', [AdministratorController::class, "users"])->name('admin.users');
  Route::get('/delete-user/{user_id}', [AdministratorController::class, "delete_user"])->name('admin.delete_user');
  Route::get('/delete-user/mergings/{user_id}', [AdministratorController::class, "deleteMerings"])->name('admin.deleteMerings');
  Route::get('/manage-mergings', [AdministratorController::class, "manage_merging"])->name('admin.merging');
  Route::get('/manage-toReceive/{pid}', [AdministratorController::class, "toReceive"])->name('admin.toReceive');
  // Route::get('/time-left,', [AdministratorController::class, "countdown"])->name('admin.countdown');



});