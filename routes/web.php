<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DrugController;
use App\Http\Controllers\Admin\DrugTypeController;
use App\Http\Controllers\Admin\DrugFormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\UserProfileController;
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
Route::get("/katalog-produk", [ProductCatalogController::class, "index"])->name("product-catalog");
Route::post("/katalog-produk", [ProductCatalogController::class, "searchProduct"])->name("search-product");
Route::get("/katalog-produk/{drug_type:slug}", [ProductCatalogController::class, "showByCategory"])->name("show-by-category");
Route::get("/produk/{drug:slug}", [ProductCatalogController::class, "detailProduct"])->name("product-detail");

Route::group(["middleware" => "auth"], function () {
    Route::get("/checkout", [CheckoutController::class, "index"])->name("checkout");
    Route::post("/payment-success", [CheckoutController::class, "process"])->name("process-purchase");
    Route::delete("/keranjang/destroy-selected-item", [CartController::class, "massDestroy"])->name("keranjang.massDestroy");
    Route::resource("/keranjang", CartController::class);
    Route::resource("/profil-akun", UserProfileController::class)->except("create", "store", "destroy", "show");
});

Route::group(["as" => "admin.", "prefix" => "admin-panel", "middleware" => ["auth", "admin"]], function () {
    Route::delete('drugs/destroy', [DrugController::class, "massDestroy"])->name('drugs.massDestroy');
    Route::delete('drug-types/destroy', [DrugTypeController::class, "massDestroy"])->name('drug-types.massDestroy');
    Route::delete('drug-forms/destroy', [DrugFormController::class, "massDestroy"])->name('drug-forms.massDestroy');
    Route::delete('brands/destroy', [BrandController::class, "massDestroy"])->name('brands.massDestroy');
    Route::delete('users/destroy', [UserController::class, "massDestroy"])->name('users.massDestroy');
    Route::delete('permissions/destroy', [PermissionController::class, "massDestroy"])->name('permissions.massDestroy');
    Route::delete('roles/destroy', [RoleController::class, "massDestroy"])->name('roles.massDestroy');

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
