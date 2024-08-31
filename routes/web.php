<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\home\TicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Service\HotelController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Route::get('/', [AdminController::class, 'index']);
Route::get('/home', [AdminController::class, 'index'])->name('home');
Route::get('/create_room', [AdminController::class, 'create_room'])->name('room.create');
Route::post('/add_room', [AdminController::class, 'add_room'])->name('room.store');
Route::get('/view_room', [AdminController::class, 'view_room'])->name('room.view');
Route::get('/delete_room/{id}', [AdminController::class, 'delete_room'])->name('room.delete');
Route::get('/update_room/{id}', [AdminController::class, 'update_room'])->name('room.update');
Route::post('/edit_room/{id}', [AdminController::class, 'edit_room'])->name('room.edit');

//ticket

Route::get('/ticket/create', [TicketController::class, 'create'])->name('home.user.ticket.create');
Route::post('/ticket/create', [TicketController::class, 'store'])->name('home.user.ticket.store');

Route::get('/ticket', [TicketController::class, 'index'])->name('home.user.ticket');

//home
Route::get('/', [HomeController::class, 'index'])->name('room.home');

Route::get('/room_details/{id}', [HomeController::class, 'room_details'])->name('room.home.details');
Route::post('/add_booking/{id}', [HomeController::class, 'add_booking'])->name('room.home.add');
Route::get('/room_details/{fetchRoom}/hotel_violation/{violation}', [HomeController::class, 'violation'])->name('room.home.violation');
Route::get('/hotel_details/{id}', [HomeController::class, 'hotel_details'])->name('hotel.home.details');

Route::post('/hotel_details/{id}/comment', [HomeController::class, 'commentStore'])->name('hotel.home.comment');
Route::post('/hotel_details/{id}/commentGuest', [HomeController::class, 'commentGuestStore'])->name('hotel.home.comment');

//Services Hotel

Route::get('/hotels', [HotelController::class, 'index'])->name('hotel.view');
Route::get('/hotel/add', [HotelController::class, 'create'])->name('hotel.add');
Route::get('/hotel/edit/{id}', [HotelController::class, 'edit'])->name('hotel.agent.edit');
Route::post('/hotel/update/{id}', [HotelController::class, 'update'])->name('hotel.agent.update');


Route::get('/agent/register', [HotelController::class, 'agentRegister'])->name('hotel.agent.register.view');
Route::post('/agent/register', [HotelController::class, 'agentRegisterStore'])->name('hotel.agent.register.store');

//Agents Hotels
Route::get('/agent/login', [HotelController::class, 'login'])->name('hotel.agent.login.view');
Route::post('/agent/login', [HotelController::class, 'checkLogin'])->name('hotel.agent.login.check');
Route::get('/agent/dashboard/{id}', [HotelController::class, 'agentDashboard'])->name('hotel.agent.dashboard');

// https://www.youtube.com/watch?v=1K-4KcTVGIs&list=PLm8sgxwSZofeShFFRAfENHymQoKemCGtR&index=3