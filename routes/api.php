<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\agendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use App\Models\servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//servico
Route::post('servico/store', [ServicoController::class, 'store']);
Route::get('servico/retornarTodos', [ServicoController::class, 'retornarTodos']);
Route::post('servico/procurarNome', [ServicoController::class, 'pesquisarPorNome']);
Route::post('servico/procurar/descricao', [ServicoController::class, 'pesquisarPorDescricao']);
Route::delete('servico/delete/{id}', [ServicoController::class, 'excluir']);
Route::put('servico/update', [ServicoController::class, 'update']);
Route::get('servico/pesquisarPor/{id}', [ServicoController::class, 'pesquisarPorId']);
Route::get('servico/exportar/csv', [ServicoController::class, 'exportarCsv']);

//cliente
Route::post('adm/cliente/cadastro', [ClienteController::class, 'store']);
Route::get('adm/cliente/retornarTodos', [ClienteController::class, 'retornarTodos']);
Route::post('adm/cliente/procurarNome', [ClienteController::class, 'pesquisarPorNome']);
Route::post('adm/cliente/procurarCpf', [ClienteController::class, 'pesquisarPorCpf']);
Route::post('adm/cliente/procurarCelular', [ClienteController::class, 'pesquisarPorCelular']);
Route::post('adm/cliente/procurarEmail', [ClienteController::class, 'pesquisarPorEmail']);
Route::delete('adm/excluir/cliente/{id}', [ClienteController::class, 'excluir']);
Route::put('adm/cliente/atualizar', [ClienteController::class, 'update']);
Route::post('adm/cliente/esqueciSenha', [ClienteController::class, 'esqueciSenha']);
Route::get('adm/cliente/pesquisarPor/{id}', [ClienteController::class, 'pesquisarPorId']);
Route::get('adm/cliente/Exportar/csv', [ClienteController::class, 'exportarCsv']);
Route::post('adm/cliente/esqueciSenha', [ClienteController::class, 'esqueciSenhaCliente']);

//profissional
Route::post('adm/profissional/cadastro', [ProfissionalController::class, 'store']);
Route::get('adm/profissional/retornarTodos', [ProfissionalController::class, 'retornarTodos']);
Route::post('adm/profissional/procurarNome', [ProfissionalController::class, 'pesquisarPorNome']);
Route::post('adm/profissional/procurarCpf', [ProfissionalController::class, 'pesquisarPorCpf']);
Route::post('adm/profissional/procurarCelular', [ProfissionalController::class, 'pesquisarPorCelular']);
Route::post('adm/profissional/procurarEmail', [ProfissionalController::class, 'pesquisarPorEmail']);
Route::delete('adm/excluir/Profissional/{id}', [ProfissionalController::class, 'excluir']);
Route::put('adm/profissional/atualizar', [ProfissionalController::class, 'update']);
Route::get('adm/profissional/pesquisarPor/{id}', [ProfissionalController::class, 'pesquisarPorId']);
Route::get('adm/profissional/Exportar/csv', [ProfissionalController::class, 'exportarCsv']);
Route::post('profissional/esqueciSenha', [ProfissionalController::class, 'esqueciSenha']);
Route::post('profissional/cadastroAgenda', [agendaController::class, 'store']);
Route::post('profissional/cliente/cadastro', [ClienteController::class, 'store']);

//agenda
Route::post('cadastroAgenda', [agendaController::class, 'store']);
Route::post('procurarAgenda', [agendaController::class, 'pesquisarPorAgenda']);
Route::delete('excluirAgenda/{id}', [agendaController::class, 'excluir']);
Route::put('atualizarAgenda', [agendaController::class, 'update']);
Route::get('retornarTodosAgenda', [agendaController::class, 'retornarTodos']);

//ADM
Route::post('adm/cadastro', [AdmController::class, 'cadastroAdm']);
Route::get('adm/retornarTodos', [AdmController::class, 'retornarTodos']);
Route::delete('adm/excluir/{id}', [AdmController::class, 'excluir']);
Route::put('adm/atualizar', [AdmController::class, 'update']);
Route::post('adm/esqueciSenha', [AdmController::class, 'esqueciSenhaAdm']);

Route::post('adm/servico/cadastro',[ServicoController::class, 'store']);
Route::put('adm/servico/atualizar',[ServicoController::class, 'update']);
Route::delete('adm/servico/excluir/{id}',[ServicoController::class, 'excluir']);

Route::post('adm/agenda/cadastro',[agendaController::class, 'store']);
Route::put('adm/agenda/atualizar',[agendaController::class, 'atualizar']);
Route::delete('adm/agenda/excluir/{id}',[agendaController::class, 'excluir']);

//Pagamento
Route::post('adm/pagamento/cadastro',[PagamentoController::class, 'store']);
Route::delete('adm/pagamento/excluir',[PagamentoController::class,'excluir']);

