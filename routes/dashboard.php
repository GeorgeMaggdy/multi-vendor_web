<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\CategoriesController;

// Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');
// route::resource('dashboard/categories',CategoriesController::class);

Route::group([
   'middleware' => ['auth'],
   'as' => 'dashboard.', // Prefix for all route names within the group
   'prefix' => 'dashboard',
], function () {

   
   Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // Route for /dashboard/index
   Route::get('/categories/trash',[CategoriesController::class,'Trash'])->name('categories.trash');
   Route::put('/categories/{category}/restore',[CategoriesController::class,'Restore'])->name('categories.restore');
   Route::delete('/categories/{category}/force-Delete',[CategoriesController::class,'forceDelete'])->name('categories.forceDelete');
   Route::resource('/categories', CategoriesController::class);
   Route::resource('/products', ProductController::class);

});


// Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth']);
// Route::resource('dashboard/categories',CategoriesController::class)->middleware(['auth']);
