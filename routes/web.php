<?php
use App\Http\Controllers\TodoController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/todo',[TodoController::class, 'index'])->name('todo');
Route::post('/todo',[TodoController::class, 'store'])->name('todo.post');
Route::put('/todo/{id}',[TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}',[TodoController::class, 'destroy'])->name('todo.delete');


