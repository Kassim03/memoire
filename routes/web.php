<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\GestionReservationController;
use App\Http\Controllers\Admin\GestionClientController;
use App\Http\Controllers\Admin\GestionEmplacementController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/reservation/{id}', [ReservationController::class, 'show'])->name('reservation.show')->middleware('auth');
Route::post('/valider', [ReservationController::class, 'valider'])->name('reservation.valider')->middleware('auth');;
Route::get('/paiement', [ReservationController::class, 'paiement'])->name('paiement.page')->middleware('auth');

Route::post('/reservation/statut/{id}', [ReservationController::class, 'updateStatut'])->name('update')->middleware('auth');
Route::post('/annuler/reservation', [ReservationController::class, 'stop'])->name('stop')->middleware('auth');

Route::get('/profil', [ProfilController::class, 'index'])->name('')->middleware('auth');

Route::get('/mesreservation', [HistoriqueController::class, 'index'])->name('reservation.list')->middleware('auth');


Route::get('/adminboard', [AdminController::class, 'index'])->name('adminboard');

Route::post('/reservation/cancel/{id}', [HistoriqueController::class, 'cancel'])->name('reservation.cancel')->middleware('auth');

Route::put('/update/reservation/{id_reservation}/{id_user}', [HistoriqueController::class, 'updateReservation'])->name('reservation.update')->middleware('auth');

Route::post('/download/pdf/{id}', [HistoriqueController::class, 'downloadpdf'])->name('reservation.recu')->middleware('auth');

Route::post('update/profil', [AuthController::class,'updateProfil'])->name('update.profil')->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/Reservations',[GestionReservationController::class, 'reservation'])->name('gestionreservation')->middleware('auth');
    Route::get('/User', [GestionClientController::class, 'user'])->name('gestionclient')->middleware('auth');
    Route::get('/Emplacements', [GestionEmplacementController::class, 'emplacement'])->name('gestionemplacement')->middleware('auth');
});

Route::get('/profil', [ProfilController::class, 'index'])->name('')->middleware('auth');

use App\Http\Controllers\EmplacementController;
Route::resource('emplacements', EmplacementController::class);

//Trois points sur Action dans le Tableau
Route::get('/emplacements', [EmplacementController::class, 'index'])->name('emplacements.index');

//Ajouter un emplacement
Route::get('/emplacements/create', [EmplacementController::class, 'create'])->name('emplacements.create');
Route::post('/emplacements', [EmplacementController::class, 'store'])->name('emplacements.store');


Route::get('/Emplacement/Modifier/{id}', [EmplacementController::class, 'edit'])->name('emplacements.edit');
Route::put('/Emplacement/Modifier/{id}', [EmplacementController::class, 'update'])->name('emplacements.update');
Route::delete('/Emplacement/Supprimer/{id}', [EmplacementController::class, 'destroy'])->name('emplacements.destroy');

Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');

Route::put('/Reservation/Modifier/{id}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/Reservation/Supprimer/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
Route::get('/Reservation/Modifier/{id}', [ReservationController::class, 'edit'])->name('reservations.edit');


