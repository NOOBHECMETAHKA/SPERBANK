<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(["namespace" => "Bank", "prefix" => "admin", "middleware" => "accountant"], function ($id){
    Route::get("/banks", [\App\Http\Controllers\Bank\BankIndexController::class, 'index', ])->name('bank.index');
    Route::post("/banks/store", [\App\Http\Controllers\Bank\BankAddController::class, 'store'])->name('bank.store');
    Route::post("/banks/update/{id}", [\App\Http\Controllers\Bank\BankUpdateController::class, 'update'])->where(['id' => '[0-9]+'])->name('bank.update');
    Route::post('/banks/delete/{id}', [\App\Http\Controllers\Bank\BankDeleteController::class, 'delete'])->where(['id' => '[0-9]+'])->name('bank.delete');
});

Route::group(["namespace" => "CardType", "prefix" => "admin", "middleware" => "accountant"], function ($id){
    Route::get("/card-types", [\App\Http\Controllers\CardType\CardTypeIndexController::class, 'index'])->name('card.type.index');
    Route::post("/card-types/store", [\App\Http\Controllers\CardType\CardTypeAddController::class, 'store'])->name('card.type.store');
    Route::post("/card-types/update/{id}", [\App\Http\Controllers\CardType\CardTypUpdateController::class, 'update'])->where(['id' => '[0-9]+'])->name('card.type.update');
    Route::post("/card-types/delete/{id}", [\App\Http\Controllers\CardType\CardTypUpdateController::class, 'delete'])->where(['id' => '[0-9]+'])->name('card.type.delete');
});

Route::group(["namespace" => "ScoreType", "prefix" => "admin", "middleware" => "accountant"], function ($id){
    Route::get("/score-types", [\App\Http\Controllers\ScoreType\ScoreTypeIndexController::class, 'index'])->name('score.type.index');
    Route::post("/score-types/store", [\App\Http\Controllers\ScoreType\ScoreTypeAddController::class, 'store'])->name('score.type.store');
    Route::post("/score-types/update/{id}", [\App\Http\Controllers\ScoreType\ScoreTypeUpdateController::class, 'update'])->where(['id' => '[0-9]+'])->name('score.type.update');
    Route::post("/score-types/delete/{id}", [\App\Http\Controllers\ScoreType\ScoreTypeDeleteController::class, 'delete'])->where(['id' => '[0-9]+'])->name('score.type.delete');
});

Route::group(["namespace" => "Employee", "prefix" => "admin", "middleware" => "admin"], function ($id){
   Route::get("/employees", [\App\Http\Controllers\Employee\EmployeeIndexController::class, 'index'])->name('employee.index');
   Route::get('/employee/add', [\App\Http\Controllers\Employee\EmployeeAddController::class, 'add'])->name('employee.add');
   Route::post("/employees/store", [\App\Http\Controllers\Employee\EmployeeAddController::class, 'store'])->name('employee.store');
   Route::get("/employees/edit/{id}", [\App\Http\Controllers\Employee\EmployeeUpdateController::class, 'edit'])->where(['id' => '[0-9]+'])->name('employee.edit');
   Route::post("/employees/update/{id}", [\App\Http\Controllers\Employee\EmployeeUpdateController::class, 'update'])->where(['id' => '[0-9]+'])->name('employee.update');
   Route::post("/employees/delete/{id}", [\App\Http\Controllers\Employee\EmployeeDeleteController::class, 'delete'])->where(['id' => '[0-9]+'])->name('employee.delete');
});

Route::group(["prefix" => "main", "middleware" => "auth"], function ($id) {
    Route::get("/configuration", [\App\Http\Controllers\HomeController::class, 'config'])->name('main.configuration');
    Route::get("/profile/information/edit", [\App\Http\Controllers\HomeController::class, 'profile'])->name('main.profile');
    Route::get("/profile/password/edit", [\App\Http\Controllers\HomeController::class, 'editPassword'])->name('main.password.edit');

    Route::post("/profile/password/update", [\App\Http\Controllers\HomeController::class, 'updatePassword'])->name('main.password.update');
    Route::post("/profile/information/update", [\App\Http\Controllers\HomeController::class, 'update'])->name('main.profile.update');
});

Route::group(["namespace" => "Score", "prefix" => "admin", "middleware" => "admin"], function ($id) {
   Route::get('/scores', [\App\Http\Controllers\Score\ScoreIndexController::class, 'index'])->name('score.index');
   Route::post('/scores/delete/{id}', [\App\Http\Controllers\Score\ScoreDeleteController::class, 'delete'])->where(['id' => '[0-9]+'])->name('score.delete');
    Route::post("/scores/store", [\App\Http\Controllers\Score\ScoreAddController::class, 'storeAdmin'])->name('score.admin.store');
});


Route::group(["namespace" => "Score", "prefix" => "main", "middleware" => "auth"], function () {
    Route::post("/scores/store", [\App\Http\Controllers\Score\ScoreAddController::class, 'store'])->name('score.store');
});

Route::group(["namespace" => "Operation", "prefix" => "main", "middleware" => "auth"], function () {
    Route::post("/operations/store", [\App\Http\Controllers\Operation\OperationAddController::class, 'store'])->name('operation.store');
});

Route::group(["namespace" => "Card", "prefix" => "main", "middleware" => "auth"], function () {
    Route::post("/cards/store", [\App\Http\Controllers\Card\CardAddController::class, 'store'])->name('card.store');
});

Route::group(["namespace" => "History", "prefix" => "admin", "middleware" => "admin"], function ($id) {
    Route::get('/history/score', [\App\Http\Controllers\History\HistoryScoreController::class, 'index'])->name('history.score.index');
    Route::get('/history/users', [\App\Http\Controllers\History\HistoryIndexController::class, 'index'])->name('history.index');
});
