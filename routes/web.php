<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MakeupController;
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

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations

Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');

// Members
Route::get('members', [MemberController::class, 'index'])
    ->name('members')
    ->middleware('auth');

Route::get('members/create', [MemberController::class, 'create'])
    ->name('members.create')
    ->middleware('auth');

Route::post('members/store', [MemberController::class, 'store'])
    ->name('members.store')
    ->middleware('auth');

Route::get('members/{member}/edit', [MemberController::class, 'edit'])
->name('members.edit')
->middleware('auth');

Route::put('members/{member}', [MemberController::class, 'update'])
    ->name('members.update')
    ->middleware('auth');


    //zoom
// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');


Route::get('/show/{code?}/{state?}', [DashboardController::class, 'show'])
    ->name('show')
    ->middleware('auth');


 //Zoom setups

Route::get('/zoom', [ZoomController::class, 'index'])
    ->name('setup')
    ->middleware('auth');

Route::post('/zoom', [ZoomController::class, 'create'])
    ->name('setup.create')
    ->middleware('auth');

Route::get('/zoom/{setup}/edit', [ZoomController::class, 'edit'])
    ->name('setup.edit')
    ->middleware('auth');


Route::put('/zoom/{setup}', [ZoomController::class, 'update'])
    ->name('setup.update')
    ->middleware('auth');

Route::delete('/zoom/{setup}', [ZoomController::class, 'destroy'])
        ->name('setup.delete')
        ->middleware('auth');
    
 Route::get('/zoom/refresh', [DashboardController::class, 'refreshUsers'])
        ->name('zoom.refresh')
        ->middleware('auth');

Route::get('/zoom/meetings', [DashboardController::class, 'meetings'])
        ->name('zoom.meetings')
        ->middleware('auth');

Route::get('/zoom/account', [DashboardController::class, 'participants'])
        ->name('zoom.accounts')
        ->middleware('auth');

//meetings

Route::get('/meetings', [MeetingController::class, 'index'])
        ->name('meetings')
        ->middleware('auth');

Route::get('/meetings/create', [MeetingController::class, 'create'])
        ->name('meetings.create')
        ->middleware('auth');

 Route::get('/meetings/{meeting}/edit', [MeetingController::class, 'edit'])
        ->name('meetings.edit')
        ->middleware('auth');

Route::post('/meetings', [MeetingController::class, 'store'])
        ->name('meetings.store')
        ->middleware('auth');

Route::put('/meetings/{meeting}', [MeetingController::class, 'update'])
        ->name('meetings.update')
        ->middleware('auth');

Route::delete('/meetings/{meeting}', [MeetingController::class, 'destroy'])
        ->name('meetings.destroy')
        ->middleware('auth');
    //authorize

Route::get('/makeups', [MakeupController::class, 'index'])
        ->name('makeups')
        ->middleware('auth');



Route::get('/makeups/create', [MakeupController::class, 'create'])
        ->name('makeups.create');

Route::post('/makeups', [MakeupController::class, 'store'])
        ->name('makeups.store');

Route::get('/makeups/{makeup}/edit', [MakeupController::class, 'edit'])
        ->name('makeups.edit')
        ->middleware('auth');
        


