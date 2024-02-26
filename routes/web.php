<?php

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

/*
|--------------------------------------------------------------------------
| Welcome Login Page
|--------------------------------------------------------------------------
*/
Route::get('/', 'Auth\LoginController@welcome_login')->name('login');


/*
|--------------------------------------------------------------------------
| Universal SmartClock has clock-in and clock-out functions 
|--------------------------------------------------------------------------
*/
// Route::get('webclock', 'ClockController@index');
// Route::post('webclock/clocking', 'ClockController@clocking');

/*
|--------------------------------------------------------------------------
| Protected Routes Requires Authentication, and User Account Approval
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {

	Route::group(['middleware' => 'checkstatus'], function () {

		Route::group(['middleware' => 'admin'], function () {
			/*
			|--------------------------------------------------------------------------
			| Dashboard 
			|--------------------------------------------------------------------------
			*/
			Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('dashboard');	

			/*
			|--------------------------------------------------------------------------
			| Employees 
			|--------------------------------------------------------------------------
			*/
			Route::get('admin/employee', 'Admin\EmployeeController@index')->name('admin-employee');
			Route::get('admin/employee/add', 'Admin\EmployeeController@add');
			Route::post('admin/employee/store', 'Admin\EmployeeController@store');
			Route::get('admin/employee/view/{id}', 'Admin\EmployeeController@view');
			Route::get('admin/employee/edit/{id}', 'Admin\EmployeeController@edit');
			Route::post('admin/employee/update', 'Admin\EmployeeController@update');
			Route::get('admin/employee/archive/{id}', 'Admin\EmployeeController@archive');
			Route::get('admin/employee/delete/{id}', 'Admin\EmployeeController@delete');

			/*
			|--------------------------------------------------------------------------
			| Employee Attendance 
			|--------------------------------------------------------------------------
			*/
			Route::get('admin/default', 'Admin\DefaultController@index')->name('admin-default');
			Route::post('admin/default', 'Admin\DefaultController@filter');
			Route::get('admin/default/manual-entry', 'Admin\DefaultController@add');
			Route::post('admin/default/process_dataset', 'Admin\DefaultController@process');
			Route::get('admin/default/upload', 'Admin\DefaultController@upload');
			Route::post('admin/defau;t/add-entry', 'Admin\DefaultController@entry');
			Route::get('admin/default/delete/{id}', 'Admin\DefaultController@delete');
			
		
			/*
			|--------------------------------------------------------------------------
			| Reports 
			|--------------------------------------------------------------------------
			*/
			Route::get('admin/reports', 'Admin\ReportController@index')->name('admin-reports');
			Route::get('admin/reports/company-overview', 'Admin\ReportController@overview');
			Route::get('admin/reports/employee-birthdays', 'Admin\ReportController@birthdays');
			Route::get('admin/reports/employee-list', 'Admin\ReportController@employees');
			Route::get('admin/reports/user-accounts', 'Admin\ReportController@users');

			/*
			|--------------------------------------------------------------------------
			| Export Reports 
			|--------------------------------------------------------------------------
			*/
			Route::get('export/report/employees', 'Admin\ExportController@employees');
			Route::get('export/report/birthdays', 'Admin\ExportController@birthdays');
			Route::get('export/report/accounts', 'Admin\ExportController@users');

			/*
			|--------------------------------------------------------------------------
			| Users 
			|--------------------------------------------------------------------------
			*/
			Route::get('admin/users', 'Admin\UserController@index')->name('admin-users');
			Route::get('admin/users/add', 'Admin\UserController@add');
			Route::post('admin/users/register', 'Admin\UserController@register');
			Route::get('admin/users/edit/{id}', 'Admin\UserController@edit');
			Route::post('admin/users/update', 'Admin\UserController@update');
			Route::get('admin/users/delete/{id}', 'Admin\UserController@delete');

			
			/*
			|--------------------------------------------------------------------------
			| User Account 
			|--------------------------------------------------------------------------
			*/
			Route::get('admin/account', 'Admin\AccountController@account')->name('account');
			Route::post('admin/update/user', 'Admin\AccountController@updateUser');
			Route::post('admin/update/password', 'Admin\AccountController@updatePassword');

			/*
			|--------------------------------------------------------------------------
			| Settings 
			|--------------------------------------------------------------------------
			*/
			Route::get('admin/settings', 'Admin\SettingsController@settings')->name('admin-settings');
			Route::post('admin/settings/update', 'Admin\SettingsController@update');

		
		});

		

	});

});


Auth::routes();
Route::get('lang/{locale}', 'LanguageController@lang');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::view('permission-denied', 'errors.permission-denied')->name('denied');
Route::view('account-disabled', 'errors.account-disabled')->name('disabled');
Route::view('account-not-found', 'errors.account-not-found')->name('notfound');