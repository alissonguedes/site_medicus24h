<?php

use App\Http\Controllers\Clinica\HomeController as ClinicaHome;
use App\Http\Controllers\Clinica\PacientesController as Pacientes;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

	Route::get('/', [HomeController::class, 'index'])->name('site.index');

});

Route::middleware([
	'auth',
	'verified',
	// Admin
])->prefix('/admin')->group(function () {

	Route::get('/', function () {
		echo 'Página admin';
	})->name('admin.index');

	// Clínica
})->prefix('/clinica')->group(function () {

	Route::get('/', [ClinicaHome::class, 'index'])->name('clinica.index');
	Route::get('/', [ClinicaHome::class, 'index'])->name('clinica.index');
	Route::get('/dashboard', [ClinicaHome::class, 'index'])->name('dashboard');
	Route::get('/agenda', [ClinicaHome::class, 'index'])->name('clinica.recursosmedicos.agenda.index');

	// Pacientes
	Route::prefix('/pacientes')->group(function () {

		Route::get('/', [Pacientes::class, 'index'])->name('clinica.pacientes.index');
		Route::get('/{id}', [Pacientes::class, 'index'])->name('clinica.pacientes.edit');
		Route::post('/', [Pacientes::class, 'store'])->name('clinica.pacientes.post');
		Route::put('/', [Pacientes::class, 'update'])->name('clinica.pacientes.post');

	});

	// HomeCare

	// Recursos Médicos

	// Agendamentos

	// Tickets

	// Cadastros

	// Tabelas

});

require __DIR__ . '/auth.php';
