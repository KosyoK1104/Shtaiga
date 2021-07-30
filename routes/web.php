<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingsController;
use Illuminate\Http\Request;

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
Route::get('/', [ListingsController::class, 'index']);

Route::get('/listing/{slug}', [ListingsController::class, 'show'])->name('listing.show');

Route::get('/listings', [ListingsController::class, 'allListings']);

Route::get('/create', [ListingsController::class, 'create'])->name('listing.create');

Route::post('/listing/create', [ListingsController::class, 'store'])->name('listing.store');

Route::get('/contacts', function (){
    return view('contacts');
});
//Route::get('listing/{id}', ['ListingsController@show']);

Route::get('model', function (Request $request){
    $make = $request->make;
    $models = DB::table('cars')->select('model')->where('make', $make)->distinct()->get();

    return response()->json([
        //'id' => 'asd',
        'models' => $models
    ]);
})->name('models');
