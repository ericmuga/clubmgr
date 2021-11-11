<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradingRuleController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MakeupController;
use App\Http\Controllers\RegistrantController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\OccurrenceController;
use App\Http\Controllers\GradingHistoryController;
use App\Models\GradingRule;
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

Route::get('/reporter', [ReportsController::class, 'index'])
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

Route::delete('members/{member}', [MemberController::class, 'destroy'])
    ->name('members.destroy')
    ->middleware('auth');

    //zoom
// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');


Route::get('/show/{code?}/{state?}', [MeetingController::class, 'show'])
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
    
 Route::get('/zoom/refresh', [MeetingController::class, 'refreshUsers'])
        ->name('zoom.refresh')
        ->middleware('auth');

Route::get('/zoom/meetings', [MeetingController::class, 'meetings'])
        ->name('zoom.meetings')
        ->middleware('auth');

Route::get('/zoom/account', [DashboardController::class, 'participants'])
        ->name('zoom.accounts')
        ->middleware('auth');

//meetings

Route::get('/meetings', [MeetingController::class, 'index'])
        ->name('meetings')
        ->middleware('auth');

Route::get('/meetings/filtered', [MeetingController::class, 'filtered'])
        ->name('meetings.filtered')
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


 Route::get('/meetings/{meeting}/participants', [MeetingController::class, 'fetchMeetingParticipants'])
        ->name('meeting.participants')
        ->middleware('auth'); 


 Route::get('/meetings/{meeting}/registrants', [MeetingController::class, 'fetchMeetingRegistrants'])
        ->name('meeting.registrants')
        ->middleware('auth'); 

 Route::get('/meetings/{meeting}/instances', [MeetingController::class, 'fetchMeetingInstances'])
        ->name('meeting.instances')
        ->middleware('auth');  


 Route::get('/meetings/{meeting}/occurrences', [MeetingController::class, 'fetchMeetingOccurrences'])
        ->name('meeting.occurrences')
        ->middleware('auth');     
    //authorize            
    //authorize      
    //authorize

//grading_rules


Route::get('/gradingrules', [GradingRuleController::class, 'index'])
        ->name('gradingrules')
        ->middleware('auth');

Route::get('/gradingrules/create', [GradingRuleController::class, 'create'])
        ->name('gradingrules.create')
        ->middleware('auth');


Route::get('/gradingrules/{gradingrule}/edit', [GradingRuleController::class, 'edit'])
        ->name('gradingrules.edit')
        ->middleware('auth');

Route::put('/gradingrules/{gradingrule}', [GradingRuleController::class, 'update'])
        ->name('gradingrules.update')
        ->middleware('auth');


Route::post('/gradingrules', [GradingRuleController::class, 'store'])
        ->name('gradingrules.store')
        ->middleware('auth');


Route::delete('/gradingrules/{gradingrule}/delete', [GradingRuleController::class, 'delete'])
        ->name('gradingrules.delete')
        ->middleware('auth');
        ///////////////////End of grading rules////////////////////////



///instances 
Route::get('/instances', [InstanceController::class, 'index'])
        ->name('instances')
        ->middleware('auth');
Route::get('/instances/create', [InstanceController::class, 'create'])
        ->name('instances.create');

Route::post('/instances', [InstanceController::class, 'store'])
        ->name('instances.store');

Route::get('/instances/{instance}/edit', [InstanceController::class, 'edit'])
        ->name('instances.edit')
        ->middleware('auth');

Route::put('/instances/{instance}', [InstanceController::class, 'update'])
        ->name('instances.update')
        ->middleware('auth');

Route::delete('/instances/{instance}', [InstanceController::class, 'destroy'])
        ->name('instances.destroy')
        ->middleware('auth');

Route::get('/instance/{instance}/registrants', [InstanceController::class, 'fetchInstanceRegistrants'])
        ->name('instance.registrants')
        ->middleware('auth');

Route::get('/instance/{instance}/participants', [InstanceController::class, 'fetchInstanceParticipants'])
        ->name('instance.participants')
        ->middleware('auth');

Route::get('/instance/{instance}', [InstanceController::class, 'generateTemplate'])
        ->name('instance.generateTemplate')
        ->middleware('auth');

Route::post('/instance/uploadParticipants', [InstanceController::class, 'uploadParticipants'])
        ->name('instance.uploadParticipants')
        ->middleware('auth');



//occurrences
Route::get('/occurs', [OccurrenceController::class, 'index'])
        ->name('occurs')
        ->middleware('auth');
Route::get('/occurs/create', [OccurrenceController::class, 'create'])
        ->name('occurs.create');

Route::post('/occurs', [OccurrenceController::class, 'store'])
        ->name('occurs.store');

Route::get('/occurs/{occur}/edit', [OccurrenceController::class, 'edit'])
        ->name('occurs.edit')
        ->middleware('auth');

Route::put('/occurs/{occur}', [OccurrenceController::class, 'update'])
        ->name('occurs.update')
        ->middleware('auth');

Route::delete('/occurs/{occur}', [OccurrenceController::class, 'destroy'])
        ->name('occurs.destroy')
        ->middleware('auth');

Route::get('/occurrence/{occurrence}/registrants', [OccurrenceController::class, 'fetchOccurrenceRegistrants'])
        ->name('occs.registrants')
        ->middleware('auth');

Route::get('/occur/{occurrence}/participants', [OccurrenceController::class, 'fetchOccurrenceParticipants'])
        ->name('occs.participants')
        ->middleware('auth');


      //makeups

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

Route::put('/makeups/{makeup}', [MakeupController::class, 'update'])
        ->name('makeups.update')
        ->middleware('auth');

Route::delete('/makeups/{makeup}', [MakeupController::class, 'destroy'])
        ->name('makeups.destroy')
        ->middleware('auth');



//registrants
Route::get('/registrants', [RegistrantController::class, 'index'])
        ->name('registrants')
        ->middleware('auth');

Route::get('/registrants/{registrant}/edit', [RegistrantController::class, 'edit'])
        ->name('registrants.edit')
        ->middleware('auth');

Route::post('/registrants', [RegistrantController::class, 'store'])
        ->name('registrants.store')
        ->middleware('auth');

Route::put('/registrants/{registrant}', [RegistrantController::class, 'update'])
        ->name('registrants.update')
        ->middleware('auth');

Route::delete('/registrants/{registrant}', [RegistrantController::class, 'destroy'])
        ->name('registrants.destroy')
        ->middleware('auth');

Route::get('/registrants/create', [RegistrantController::class, 'create'])
        ->name('registrants.create')
        ->middleware('auth');

//participants

Route::get('/part', [ParticipantController::class, 'index'])
        ->name('participants')
        ->middleware('auth');  



Route::get('/participants/create', [ParticipantController::class, 'create'])
        ->name('participants.create')
        ->middleware('auth');   
Route::post('/participants/filter', [ParticipantController::class, 'filteredParticipants'])
        ->name('participants.filtered')
        ->middleware('auth'); 

Route::post('/participants', [ParticipantController::class, 'store'])
        ->name('participants.store')
        ->middleware('auth');

Route::get('/participants/{registrant}/edit', [ParticipantController::class, 'edit'])
        ->name('participants.edit')
        ->middleware('auth');
Route::put('/participants/{registrant}', [ParticipantController::class, 'update'])
        ->name('participants.update')
        ->middleware('auth');

Route::delete('/participants/{registrant}', [ParticipantController::class, 'destroy'])
        ->name('participants.destroy')
        ->middleware('auth');

Route::get('/gradings', [GradingHistoryController::class, 'index'])
        ->name('gradings')
        ->middleware('auth');

Route::get('ap/members',[MemberController::class, 'api'])
       ->name('ap.members')
       ->middleware('auth');

 Route::get('/gradinghistory/{filename}',[GradingHistory::class,'fetchFile'] );








