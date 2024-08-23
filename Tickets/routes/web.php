<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ChatController;

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

// Login and normal user regristation
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

////////////////////// USER ROUTES //////////////////////
Route::middleware(['auth', 'user-access:user'])->group(function () {
    // User Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // User profile
    Route::get('/profile', [AllUsersController::class, 'userprofile'])->name('profile');
    Route::put('/user/profile/update/{id}', [AllUsersController::class, 'updateUser'])->name('user/profile/update');

    // User Tickets
    Route::get('/user/tickets', [TicketController::class, 'indexUser'])->name('user/tickets');
    Route::get('/user/tickets/create', [TicketController::class, 'create'])->name('user/tickets/create');
    Route::post('/user/tickets/store', [TicketController::class, 'store'])->name('user/tickets/store');
    Route::get('/user/tickets/show/{id}', [TicketController::class, 'showUser'])->name('user/tickets/showuser');
    Route::get('/user/tickets/edit/{id}', [TicketController::class, 'editUser'])->name('user/tickets/edit');
    Route::put('/user/tickets/update/{id}', [TicketController::class, 'update'])->name('user/tickets/update');
    Route::get('/user/tickets/cancell/{id}', [TicketController::class, 'cancell'])->name('user/tickets/cancell');
    Route::post('/user/chats/reply', [ChatController::class, 'reply'])->name('user.chats.reply');
});



////////////////////// ASSISTANT ROUTES //////////////////////
Route::middleware(['auth', 'user-access:assistant'])->group(function () {
    // Assistant Home
    Route::get('/assistant/landing', [HomeController::class, 'assistantHome'])->name('assistant/landing');
    // Assistant profile
    Route::get('/assistant/profile', [AllUsersController::class, 'assistantprofilepage'])->name('assistant/profile');
    Route::put('/assistant/profile/update/{id}', [AllUsersController::class, 'updateAssistant'])->name('assistant/profile/update');

    // Assignment Tickets Managment
    Route::get('/assistant/tickets', [AssignmentController::class, 'indexAssignedAssistant'])->name('assistant/tickets');
    Route::get('/assistant/tickets/edit/{id}', [AssignmentController::class, 'attend'])->name('assistant/tickets/attend');
    Route::put('/assistant/tickets/update/{id}', [AssignmentController::class, 'updateAttend'])->name('assistant/tickets/updateAttend');
    Route::post('/assistant/chats/answer', [ChatController::class, 'answer'])->name('assistant.chats.answer');

});



////////////////////// ADMIN ROUTES //////////////////////
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    // Admin Home
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');

    // Admin profile
    Route::get('/admin/profile', [AllUsersController::class, 'profilepage'])->name('admin/profile');
    Route::put('/admin/profile/update/{id}', [AllUsersController::class, 'updateAdmin'])->name('admin/profile/update');

    // Division Managment
    Route::get('/admin/divisions', [DivisionController::class, 'index'])->name('admin/divisions');
    Route::post('/admin/divisions/store', [DivisionController::class, 'store'])->name('admin.divisions.store');
    Route::put('/admin/divisions/update/{id}', [DivisionController::class, 'update'])->name('admin.divisions.update');

    Route::delete('/admin/divisions/destroy/{id}', [DivisionController::class, 'destroy'])->name('admin/divisions/destroy');

    // Users Managment
    Route::get('/admin/users', [AllUsersController::class, 'index'])->name('admin/users');
    Route::get('/admin/users/create', [AllUsersController::class, 'create'])->name('admin/users/create');
    Route::post('/admin/users/store', [AllUsersController::class, 'store'])->name('admin/users/store');
    Route::get('/admin/users/edit/{id}', [AllUsersController::class, 'edit'])->name('admin/users/edit');
    Route::put('/admin/users/update/{id}', [AllUsersController::class, 'update'])->name('admin/users/update');
    Route::delete('/admin/users/destroy/{id}', [AllUsersController::class, 'destroy'])->name('admin/users/destroy');

    // Ticket Managment
    Route::get('/admin/assignedtickets', [AssignmentController::class, 'indexAssignedAdmin'])->name('admin/assignedtickets');

    // Assigment Managment
    Route::get('/admin/tickets/assignAdmin/{id}', [AssignmentController::class, 'assignAdmin'])->name('admin/tickets/assignAdmin'); // create
    Route::post('/admin/tickets/storeAssigment', [AssignmentController::class, 'storeAssigment'])->name('admin/tickets/storeAssigment'); // store
    Route::post('/admin/chats/obervation', [ChatController::class, 'observation'])->name('admin.chats.observation');

});



