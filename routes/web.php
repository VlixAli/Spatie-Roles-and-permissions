<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->controller(ProfileController::class)
    ->name('profile.')->prefix('/profile')
    ->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::resource('/roles', RoleController::class);
    Route::controller(RoleController::class)->name('roles.')
        ->prefix('/roles/{role}/permissions')->group(function () {
            Route::post('/', 'givePermission')->name('permissions');
            Route::delete('/{permission}', 'revokePermission')->name('permissions.revoke');
        });

    Route::resource('/permissions', PermissionController::class);
    Route::controller(PermissionController::class)
        ->prefix('/permissions/{permission}/roles')->name('permissions.')
        ->group(function () {
            Route::post('/', 'assignRole')->name('roles');
            Route::delete('/{role}', 'removeRole')->name('roles.remove');
        });

    Route::controller(UserController::class)
        ->prefix('/users')->name('users.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::prefix('/{user}')->group(function () {
                Route::get('/', 'show')->name('show');
                Route::delete('/', 'destroy')->name('destroy');
                Route::post('/roles', 'assignRole')->name('roles');
                Route::delete('/roles/{role}', 'removeRole')->name('roles.remove');
                Route::post('/permissions', 'givePermission')->name('permissions');
                Route::delete('/permissions/{permission}', 'revokePermission')->name('permissions.revoke');
            });
        });
});

require __DIR__.'/auth.php';
