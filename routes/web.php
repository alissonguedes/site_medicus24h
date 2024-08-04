<?php

// Admin Controllers
use App\Http\Controllers\Admin\ApresentacaoController as Apresentacao;
use App\Http\Controllers\Admin\A_IbrController as A_Ibr;
use App\Http\Controllers\Admin\BannersController as Banners;
use App\Http\Controllers\Admin\PastoresController as Pastores;
use App\Http\Controllers\APIController as API;

// Clinica Controllers
use App\Http\Controllers\Clinica\Homecare\GestaoDeCuidadosController as Homecare;
use App\Http\Controllers\Clinica\Homecare\PacientesController as PacientesHomecare;
use App\Http\Controllers\Clinica\HomeController as ClinicaHome;
use App\Http\Controllers\Clinica\PacientesController as Pacientes;

// Main Controllers
use App\Http\Controllers\ProfileController;

// Site Controllers
use App\Http\Controllers\Site\HomeController;

// Admin Requests

// Illuminate
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

	Route::get('/', [HomeController::class, 'index'])->name('site.index');

});

Route::get('/profile/image/preview/{file_categ}/{file_id}', [API::class, 'show_image_profile'])->name('clinica.show-image-profile');

Route::middleware([
	'auth',
	'verified',
])->prefix('/clinica')->group(function () {

	Route::get('/', function () {
		return redirect()->route('clinica.dashboard');
	})->name('clinica.index');

	Route::get('/dashboard', [ClinicaHome::class, 'index'])->name('clinica.dashboard');
	Route::get('/agenda', [ClinicaHome::class, 'index'])->name('clinica.recursosmedicos.agenda.index');

	// Pacientes
	Route::prefix('/pacientes')->group(function () {

		Route::get('/', [Pacientes::class, 'index'])->name('clinica.pacientes.index');
		Route::get('/q/{search?}', [Pacientes::class, 'search'])->name('clinica.pacientes.search');
		Route::get('/id/{id}', [Pacientes::class, 'index'])->name('clinica.pacientes.edit');
		Route::post('/', [Pacientes::class, 'store'])->name('clinica.pacientes.post');
		Route::put('/', [Pacientes::class, 'update'])->name('clinica.pacientes.post');
		Route::delete('/', [Pacientes::class, 'destroy'])->name('clinica.pacientes.delete');

	});

	// HomeCare
	Route::prefix('/homecare')->group(function () {

		Route::get('/', function () {

			return redirect()->route('clinica.homecare.gestao-de-cuidados');

		})->name('clinica.homecare.index');

		Route::prefix('/gestao-de-cuidados')->group(function () {

			Route::get('/', [Homecare::class, 'index'])->name('clinica.homecare.gestao-de-cuidados');
			Route::get('/q/{search?}', [Homecare::class, 'search'])->name('clinica.homecare.gestao-de-cuidados.search');
			Route::get('/id/{id}', [Homecare::class, 'index'])->name('clinica.homecare.gestao-de-cuidados.edit');
			Route::post('/', [Homecare::class, 'store'])->name('clinica.homecare.gestao-de-cuidados.post');
			Route::put('/', [Homecare::class, 'update'])->name('clinica.homecare.gestao-de-cuidados.post');
			Route::delete('/', [Homecare::class, 'destroy'])->name('clinica.homecare.gestao-de-cuidados.delete');

			Route::prefix('/programas')->group(function () {

				Route::get('/q/{search?}', [Homecare::class, 'search_programas'])->name('clinica.homecare.programas.search');

			});

			Route::prefix('/tarefas')->group(function () {
				Route::get('/', [Homecare::class, 'addTarefa'])->name('clinica.homecare.gestao-de-cuidados.tarefas');
				Route::post('/', [Homecare::class, 'addTarefa'])->name('clinica.homecare.gestao-de-cuidados.tarefas');
			});

		});

		// Route::get('/tarefas', [Homecare::class, 'index'])->name('clinica.homecare.tarefas');

		Route::prefix('/pacientes')->group(function () {

			Route::prefix('/tickets')->group(function () {
				Route::get('/', [PacientesHomecare::class, 'tickets'])->name('clinica.homecare.pacientes.tickets');
			});

			Route::get('/', [PacientesHomecare::class, 'index'])->name('clinica.homecare.pacientes');
			Route::get('/q/{search?}', [PacientesHomecare::class, 'search'])->name('clinica.homecare.pacientes.search');
			Route::get('/id/{id}', [PacientesHomecare::class, 'index'])->name('clinica.homecare.pacientes.edit');
			Route::post('/', [PacientesHomecare::class, 'store'])->name('clinica.homecare.pacientes.post');

		});

	});

	// Recursos Médicos

	// Agendamentos

	// Tickets

	// Cadastros

	// Tabelas

	Route::get('/imagem/banner/{file_id}', [Banners::class, 'show'])->name('home.banners.show-image');
	Route::get('/imagem/post/{file_id}', [Apresentacao::class, 'show'])->name('home.apresentacao.show-image');
	Route::get('/imagem/pastor/{file_id}', [Pastores::class, 'show'])->name('home.pastores.show-image');
	Route::get('/imagem/a-ibr/{file_id}', [A_Ibr::class, 'show'])->name('home.a-ibr.show-image');
	Route::get('/imagem/paciente/{file_id}', [Pacientes::class, 'show'])->name('clinica.pacientes.show-image');

})->prefix('/admin')->group(function () {

	Route::get('/index', function () {
		return redirect()->route('admin.dashboard');
	})->name('admin.index');

	Route::get('/', function () {
		// return redirect()->route('admin.dashboard');
		return redirect()->route('clinica.dashboard');
	})->name('dashboard');

	Route::get('/dashboard', function () {
		// return view('admin.dashboard');
	})->name('admin.dashboard');

	/** banners */
	Route::prefix('/banners')->group(function () {

		Route::get('/', [Banners::class, 'index'])->name('admin.home.banners.index');
		Route::get('/{search}', [Banners::class, 'search'])->name('admin.home.banners.search');
		Route::get('/id/{id}', [Banners::class, 'create'])->name('admin.home.banners.edit');
		// Route::get('/imagem/{file_id}', [Banners::class, 'show'])->name('admin.home.banners.show-image');
		Route::post('/', [Banners::class, 'store'])->name('admin.home.banners.post');
		Route::put('/', [Banners::class, 'store'])->name('admin.home.banners.post');
		Route::delete('/', [Banners::class, 'destroy'])->name('admin.home.banners.delete');

	});

	/** Apresentação */
	Route::prefix('/apresentacao')->group(function () {

		Route::get('/', [Apresentacao::class, 'index'])->name('admin.home.apresentacao.index');
		Route::get('/{search}', [Apresentacao::class, 'search'])->name('admin.home.apresentacao.search');
		Route::get('/id/{id}', [Apresentacao::class, 'create'])->name('admin.home.apresentacao.edit');
		// Route::get('/imagem/{file_id}', [Apresentacao::class, 'show'])->name('admin.home.apresentacao.show-image');
		Route::post('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
		Route::put('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
		Route::delete('/', [Apresentacao::class, 'destroy'])->name('admin.home.apresentacao.delete');

	});

	/** Pastores */
	Route::prefix('/pastores')->group(function () {

		Route::get('/', [Pastores::class, 'index'])->name('admin.home.pastores.index');
		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.home.pastores.search');
		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.home.pastores.edit');
		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.home.pastores.show-image');
		Route::post('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
		Route::put('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.home.pastores.delete');

	});

	/** A_Ibr */
	Route::prefix('/a-ibr')->group(function () {

		Route::get('/', [A_Ibr::class, 'index'])->name('admin.a-ibr.index');
		Route::get('/{search}', [A_Ibr::class, 'search'])->name('admin.a-ibr.search');
		Route::get('/id/{id}', [A_Ibr::class, 'create'])->name('admin.a-ibr.edit');
		// Route::get('/imagem/{file_id}', [A_Ibr::class, 'show'])->name('admin.a-ibr.show-image');
		Route::post('/', [A_Ibr::class, 'store'])->name('admin.a-ibr.post');
		Route::put('/', [A_Ibr::class, 'store'])->name('admin.a-ibr.post');
		Route::delete('/', [A_Ibr::class, 'destroy'])->name('admin.a-ibr.delete');

	});

	/** Ministérios */
	Route::prefix('/ministerios')->group(function () {

		Route::get('/', [Pastores::class, 'index'])->name('admin.ministerios.index');
		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.ministerios.search');
		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.ministerios.edit');
		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.ministerios.show-image');
		Route::post('/', [Pastores::class, 'store'])->name('admin.ministerios.post');
		Route::put('/', [Pastores::class, 'store'])->name('admin.ministerios.post');
		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.ministerios.delete');

	});

	/** Cultos */
	Route::prefix('/cultos')->group(function () {

		Route::get('/', [Pastores::class, 'index'])->name('admin.cultos.index');
		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.cultos.search');
		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.cultos.edit');
		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.cultos.show-image');
		Route::post('/', [Pastores::class, 'store'])->name('admin.cultos.post');
		Route::put('/', [Pastores::class, 'store'])->name('admin.cultos.post');
		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.cultos.delete');

	});

	/** Eventos */
	Route::prefix('/eventos')->group(function () {

		Route::get('/', [Pastores::class, 'index'])->name('admin.eventos.index');
		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.eventos.search');
		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.eventos.edit');
		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.eventos.show-image');
		Route::post('/', [Pastores::class, 'store'])->name('admin.eventos.post');
		Route::put('/', [Pastores::class, 'store'])->name('admin.eventos.post');
		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.eventos.delete');

	});

	Route::middleware('auth')->group(function () {
		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	});

	// Clínica
});

require __DIR__ . '/auth.php';

// use App\Http\Controllers\Admin\ApresentacaoController as Apresentacao;
// use App\Http\Controllers\Admin\A_IbrController as A_Ibr;
// use App\Http\Controllers\Admin\BannersController as Banners;
// use App\Http\Controllers\Admin\PastoresController as Pastores;
// use App\Http\Controllers\APIController as API;

// // Admin Controllers
// use App\Http\Controllers\Clinica\HomeController as ClinicaHome;
// use App\Http\Controllers\Clinica\PacientesController as Pacientes;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\Site\HomeController;

// // Main Controllers

// // Admin Requests

// // Admin Models
// use Illuminate\Support\Facades\Route;

// Route::prefix('/')->group(function () {

// 	Route::get('/', [HomeController::class, 'index'])->name('site.index');

// });

// Route::get('/profile/image/preview/{file_categ}/{file_id}', [API::class, 'show_image_profile'])->name('clinica.show-image-profile');

// Route::middleware([
// 	'auth',
// 	'verified',
// ])->prefix('/clinica')->group(function () {

// 	Route::get('/', function () {
// 		return redirect()->route('clinica.dashboard');
// 	})->name('clinica.index');

// 	Route::get('/dashboard', [ClinicaHome::class, 'index'])->name('clinica.dashboard');
// 	Route::get('/agenda', [ClinicaHome::class, 'index'])->name('clinica.recursosmedicos.agenda.index');

// 	// Pacientes
// 	Route::prefix('/pacientes')->group(function () {

// 		Route::get('/', [Pacientes::class, 'index'])->name('clinica.pacientes.index');
// 		Route::get('/{search}', [Pacientes::class, 'search'])->name('clinica.pacientes.search');
// 		Route::get('/id/{id}', [Pacientes::class, 'index'])->name('clinica.pacientes.edit');
// 		Route::post('/', [Pacientes::class, 'store'])->name('clinica.pacientes.post');
// 		Route::put('/', [Pacientes::class, 'store'])->name('clinica.pacientes.post');
// 		Route::delete('/', [Pacientes::class, 'destroy'])->name('clinica.pacientes.delete');

// 	});

// 	// HomeCare

// 	// Recursos Médicos

// 	// Agendamentos

// 	// Tickets

// 	// Cadastros

// 	// Tabelas

// 	Route::get('/imagem/banner/{file_id}', [Banners::class, 'show'])->name('home.banners.show-image');
// 	Route::get('/imagem/post/{file_id}', [Apresentacao::class, 'show'])->name('home.apresentacao.show-image');
// 	Route::get('/imagem/pastor/{file_id}', [Pastores::class, 'show'])->name('home.pastores.show-image');
// 	Route::get('/imagem/a-ibr/{file_id}', [A_Ibr::class, 'show'])->name('home.a-ibr.show-image');
// 	Route::get('/imagem/paciente/{file_id}', [Pacientes::class, 'show'])->name('clinica.pacientes.show-image');

// })->prefix('/admin')->group(function () {

// 	Route::get('/index', function () {
// 		return redirect()->route('admin.dashboard');
// 	})->name('admin.index');

// 	Route::get('/', function () {
// 		// return redirect()->route('admin.dashboard');
// 		return redirect()->route('clinica.dashboard');
// 	})->name('dashboard');

// 	Route::get('/dashboard', function () {
// 		// return view('admin.dashboard');
// 	})->name('admin.dashboard');

// 	/** banners */
// 	Route::prefix('/banners')->group(function () {

// 		Route::get('/', [Banners::class, 'index'])->name('admin.home.banners.index');
// 		Route::get('/{search}', [Banners::class, 'search'])->name('admin.home.banners.search');
// 		Route::get('/id/{id}', [Banners::class, 'create'])->name('admin.home.banners.edit');
// 		// Route::get('/imagem/{file_id}', [Banners::class, 'show'])->name('admin.home.banners.show-image');
// 		Route::post('/', [Banners::class, 'store'])->name('admin.home.banners.post');
// 		Route::put('/', [Banners::class, 'store'])->name('admin.home.banners.post');
// 		Route::delete('/', [Banners::class, 'destroy'])->name('admin.home.banners.delete');

// 	});

// 	/** Apresentação */
// 	Route::prefix('/apresentacao')->group(function () {

// 		Route::get('/', [Apresentacao::class, 'index'])->name('admin.home.apresentacao.index');
// 		Route::get('/{search}', [Apresentacao::class, 'search'])->name('admin.home.apresentacao.search');
// 		Route::get('/id/{id}', [Apresentacao::class, 'create'])->name('admin.home.apresentacao.edit');
// 		// Route::get('/imagem/{file_id}', [Apresentacao::class, 'show'])->name('admin.home.apresentacao.show-image');
// 		Route::post('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
// 		Route::put('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
// 		Route::delete('/', [Apresentacao::class, 'destroy'])->name('admin.home.apresentacao.delete');

// 	});

// 	/** Pastores */
// 	Route::prefix('/pastores')->group(function () {

// 		Route::get('/', [Pastores::class, 'index'])->name('admin.home.pastores.index');
// 		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.home.pastores.search');
// 		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.home.pastores.edit');
// 		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.home.pastores.show-image');
// 		Route::post('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
// 		Route::put('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
// 		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.home.pastores.delete');

// 	});

// 	/** A_Ibr */
// 	Route::prefix('/a-ibr')->group(function () {

// 		Route::get('/', [A_Ibr::class, 'index'])->name('admin.a-ibr.index');
// 		Route::get('/{search}', [A_Ibr::class, 'search'])->name('admin.a-ibr.search');
// 		Route::get('/id/{id}', [A_Ibr::class, 'create'])->name('admin.a-ibr.edit');
// 		// Route::get('/imagem/{file_id}', [A_Ibr::class, 'show'])->name('admin.a-ibr.show-image');
// 		Route::post('/', [A_Ibr::class, 'store'])->name('admin.a-ibr.post');
// 		Route::put('/', [A_Ibr::class, 'store'])->name('admin.a-ibr.post');
// 		Route::delete('/', [A_Ibr::class, 'destroy'])->name('admin.a-ibr.delete');

// 	});

// 	/** Ministérios */
// 	Route::prefix('/ministerios')->group(function () {

// 		Route::get('/', [Pastores::class, 'index'])->name('admin.ministerios.index');
// 		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.ministerios.search');
// 		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.ministerios.edit');
// 		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.ministerios.show-image');
// 		Route::post('/', [Pastores::class, 'store'])->name('admin.ministerios.post');
// 		Route::put('/', [Pastores::class, 'store'])->name('admin.ministerios.post');
// 		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.ministerios.delete');

// 	});

// 	/** Cultos */
// 	Route::prefix('/cultos')->group(function () {

// 		Route::get('/', [Pastores::class, 'index'])->name('admin.cultos.index');
// 		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.cultos.search');
// 		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.cultos.edit');
// 		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.cultos.show-image');
// 		Route::post('/', [Pastores::class, 'store'])->name('admin.cultos.post');
// 		Route::put('/', [Pastores::class, 'store'])->name('admin.cultos.post');
// 		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.cultos.delete');

// 	});

// 	/** Eventos */
// 	Route::prefix('/eventos')->group(function () {

// 		Route::get('/', [Pastores::class, 'index'])->name('admin.eventos.index');
// 		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.eventos.search');
// 		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.eventos.edit');
// 		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.eventos.show-image');
// 		Route::post('/', [Pastores::class, 'store'])->name('admin.eventos.post');
// 		Route::put('/', [Pastores::class, 'store'])->name('admin.eventos.post');
// 		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.eventos.delete');

// 	});

// 	Route::middleware('auth')->group(function () {
// 		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// 		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// 		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// 	});

// 	// Clínica
// });

// require __DIR__ . '/auth.php';
