<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProFile\EmployeeProFileController;
use App\Http\Controllers\ProFile\EmployerProFileController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\EmployerDashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {

    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);
    Route::post('/contact-us' , [HomeController::class, 'contactUsMail']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('/me', [HomeController::class, 'me']);
        Route::post('change-password', [ChangePasswordController::class, 'changePassword']);
        Route::post('contact-us-auth', [HomeController::class, 'contactUsMail']);

        Route::middleware('isAdmin')->group(function() {
            Route::apiResource('users', UserController::class);
        });

        Route::middleware('isEmployee')->group(function() {
            Route::put('employee-update', [EmployeeProFileController::class, 'update']);
            Route::get('employee-show', [EmployeeProFileController::class, 'show']);
            Route::apiResource('timesheet', TimesheetController::class);

        });

        Route::middleware('isEmployer')->group(function() {
            Route::put('employer-update', [EmployerProFileController::class, 'update']);
            Route::get('employer-show', [EmployerProFileController::class, 'show']);
            Route::apiResource('timesheets-dashboard', EmployerDashboardController::class);
            Route::put('timesheet-accept/{timesheet}', [TimesheetController::class, 'accept']);
            Route::put('timesheet-reject/{timesheet}', [TimesheetController::class, 'reject']);

        });
    });

    Route::post('vacancies',  VacancyController::class);
});

Route::get('jobs', [JobController::class, 'getJobs']); // WTF ??) який таки джоб контрроллер ?
