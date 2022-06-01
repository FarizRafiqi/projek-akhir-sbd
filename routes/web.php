<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\DrugTypeController;
use App\Http\Controllers\DrugFormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get("/", [HomeController::class, "index"])->name("home");

Route::group(["as" => "admin.", "prefix" => "admin-panel", "middleware" => ["auth", "admin"]], function () {
    Route::get("/", [DashboardController::class, "index"])->name("dashboard");
    Route::resource("activity-logs", ActivityLogController::class)->except("create", "store", "edit", "update", "destroy");
    Route::resources([
        "drugs" => DrugController::class,
        "drug-types" => DrugTypeController::class,
        "drug-forms" => DrugFormController::class,
        "brands" => BrandController::class,
        "purchases" => PurchaseController::class,
        "users" => UserController::class,
        "permissions" => PermissionController::class,
        "roles" => RoleController::class,
    ]);
});

Auth::routes();
