<?php

use App\Http\Controllers\ProfileController;
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

//
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/',[\App\Http\Controllers\User\HomeController::class,'index'])->middleware('auth');

Route::prefix('/')->middleware(['auth'])->group(function (){
    Route::get('/test/{id}',[\App\Http\Controllers\User\TestController::class,'index'])->name('test.user.show');
    Route::get('/',[\App\Http\Controllers\User\HomeController::class,'index']);

    //Route Result
    Route::post('result',[\App\Http\Controllers\Admin\ResultController::class,'create'])->name('result.create');
    //Kiem tra dap an dung
    Route::post('/result/checkCorrectOption',[\App\Http\Controllers\User\TestController::class,'checkCorrectOption']);
});

Route::prefix('admin')->middleware(['roleMiddleware'])->group(function (){
    Route::get('/',[\App\Http\Controllers\Admin\AdminController::class,'index'])->name('question.index');
    Route::prefix('/questions')->group(function (){
        Route::get('/',[\App\Http\Controllers\Admin\QuestionController::class,'index'])->name('question.index');
        Route::get('/create',[\App\Http\Controllers\Admin\QuestionController::class,'create'])->name('question.create');
        Route::get('/edit/{id}',[\App\Http\Controllers\Admin\QuestionController::class,'edit'])->name('question.edit');
        Route::post('/store',[\App\Http\Controllers\Admin\QuestionController::class,'store'])->name('question.store');
        Route::delete('/delete/{id}',[\App\Http\Controllers\Admin\QuestionController::class,'delete'])->name('question.delete');
        Route::put('/update/{id}',[\App\Http\Controllers\Admin\QuestionController::class,'update'])->name('question.update');
        Route::get('/search',[\App\Http\Controllers\Admin\QuestionController::class,'search'])->name('question.search');
    });

    Route::prefix('/tests')->group(function (){
        Route::get('/',[\App\Http\Controllers\Admin\TestController::class,'index'])->name('test.index');
        Route::post('/create',[\App\Http\Controllers\Admin\TestController::class,'create'])->name('test.create');
        Route::put('/update/{id}',[\App\Http\Controllers\Admin\TestController::class,'update'])->name('test.update');
        Route::get('/show/{id}',[\App\Http\Controllers\Admin\TestController::class,'show'])->name('test.show');
        Route::delete('/delete/{id}',[\App\Http\Controllers\Admin\TestController::class,'delete'])->name('test.delete');
        Route::get('/add/{id}',[\App\Http\Controllers\Admin\TestController::class,'add_question'])->name('test.addQuestion');
        Route::post('/create/question',[\App\Http\Controllers\Admin\TestController::class,'handleAdd'])->name('test.handleAdd');
        Route::delete('/delete/question/{id}',[\App\Http\Controllers\Admin\TestController::class,'deleteQuestion'])->name('test.deleteQuestion');
        Route::put('/quickAdd/{id}',[\App\Http\Controllers\Admin\TestController::class,'quick_add_questions'])->name('test.quickAdd');
        Route::get('/search',[\App\Http\Controllers\Admin\TestController::class,'search'])->name('test.search');
        Route::post('/custom_sort',[\App\Http\Controllers\Admin\TestController::class,'custom_sort'])->name('test.custom_sort');
    });
});


Route::post('/custom-logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('custom-logout');



Route::post('/hihi', function () {
    // Xử lý logic ở đây
    return response()->json(['message' => 'Success']);
})->name('test.hi');

require __DIR__.'/auth.php';
