<?php

use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\ClienteController;
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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TerceirizadoController;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');


Route::get('atendimentos', [AtendimentoController::class, 'index'])->middleware('auth')->name('atendimentos');
Route::get('atendimentos/{user}', [AtendimentoController::class, 'viewCliente'])->middleware('auth')->name('atendimentos-cliente');
Route::get('atendimento/adicionar', [AtendimentoController::class, 'addAtendimento'])->middleware('auth')->name('add-atendimento');
Route::post('atendimento/adicionar', [AtendimentoController::class, 'store'])->middleware('auth')->name('atendimento-store');
Route::get('atendimento/{atendimento}/visualizar',[AtendimentoController::class, 'view'])->middleware('auth')->name('view-atendimento');
Route::get('atendimento/{atendimento}/edit',[AtendimentoController::class, 'edit'])->middleware('auth')->name('editar-atendimento');
Route::post('atendimento/{atendimento}/edit',[AtendimentoController::class, 'update'])->middleware('auth')->name('atendimento-edit');

Route::get('clientes',[ClienteController::class, 'index'])->middleware('auth')->name('clientes');
Route::get('clientes/adicionar',[ClienteController::class, 'addCliente'])->middleware('auth')->name('add-cliente');
Route::post('clientes/adicionar',[ClienteController::class, 'store'])->middleware('auth')->name('cliente-store');
Route::get('clientes/{cliente}/excluir',[ClienteController::class, 'destroy'])->middleware('auth')->name('cliente-destroy');
Route::get('clientes/{cliente}/edit',[ClienteController::class, 'edit'])->middleware('auth')->name('editar-cliente');
Route::post('clientes/{cliente}/edit',[ClienteController::class, 'update'])->middleware('auth')->name('cliente-edit');
Route::get('clientes/{cliente}/visualizar',[ClienteController::class, 'view'])->middleware('auth')->name('view-cliente');


Route::get('terceirizados',[TerceirizadoController::class, 'index'])->middleware('auth')->name('terceirizados');
Route::get('terceirizados/adicionar',[TerceirizadoController::class, 'addTerceirizado'])->middleware('auth')->name('add-terceirizado');
Route::post('terceirizados/adicionar',[TerceirizadoController::class, 'store'])->middleware('auth')->name('terceirizado-store');
Route::get('terceirizados/{terceirizado}/edit',[TerceirizadoController::class, 'edit'])->middleware('auth')->name('editar-terceirizado');
Route::post('terceirizados/{terceirizado}/edit',[TerceirizadoController::class, 'update'])->middleware('auth')->name('terceirizado-edit');


Route::get('funcionarios',[FuncionarioController::class, 'index'])->middleware('auth')->name('funcionarios');
Route::get('funcionarios/adicionar',[FuncionarioController::class, 'addFuncionario'])->middleware('auth')->name('add-funcionario');
Route::post('funcionarios/adicionar',[FuncionarioController::class, 'store'])->middleware('auth')->name('funcionario-store');
Route::get('funcionarios/{funcionario}/edit',[FuncionarioController::class, 'edit'])->middleware('auth')->name('editar-funcionario');
Route::post('funcionarios/{funcionario}/edit',[FuncionarioController::class, 'update'])->middleware('auth')->name('funcionario-edit');


Route::get('servicos',[ServicoController::class, 'index'])->middleware('auth')->name('servicos');
Route::post('servicos',[ServicoController::class, 'store'])->middleware('auth')->name('add-servico');
Route::delete('servicos/{id}', [ServicoController::class, 'destroy'])->middleware('auth')->name('servico-destroy');


Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});