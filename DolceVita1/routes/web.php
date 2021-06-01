<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Notification;


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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    
    Route::get('/reteta', 'AdminController@index')->name('add.recipe');
    Route::get('/istoric-tombole', 'AdminController@tombola')->name('admin.tombola');
    Route::post('/adauga-reteta', 'AdminController@store')-> name('store.recipe');
    Route::get('/formarea-pretului', 'AdminController@finalPrice')->name('show.price');
 
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('acasa');
Route::get('/{pages}', 'PagesController@Pages')->name('pages')
->where('pages','contacte|despre|plati&livrare|cum_cumperi|termeni_conditii|politica_rambursari|contestatii');
Route::get('/tutoriale', 'PagesController@index')->name('tutoriale');
Auth::routes();

Route::middleware('auth')->group(function () {    
    Route::resource('cos','CartController');
    Route::get('/reteta-personalizata', 'PersonalOrderController@index')->name('recipe');
    Route::get('/favorite', 'WishListController@show')-> name('favorite');
    Route::get('/istoric-comanda','PagesController@istoric')->name('history'); 
    //for personal order
    
    Route::get('/sterge-produs/{produs}', 'PersonalOrderController@destroy')-> name('sterge.produsP');
    Route::post('/modifica-produs/{produs}', 'PersonalOrderController@update')-> name('update.produsP');
    Route::post('/reteta-personalizata/trimite', 'PersonalOrderController@store')->name('recipe.store');
    // end personalOrder
    Route::post('/adauga-favorite/{produs}', 'WishListController@wishList')-> name('adauga.favorite');
    Route::get('/sterge-favorite/{produs}', 'WishListController@destroy')-> name('sterge.favorite');

    Route::get('/finalizare-comanda', 'OrdersController@index')->name('finalizare.comanda');

    Route::post('/finalizare-comanda/achitare','OrdersController@checkout')->name('achitare');  //stripe payment page
    Route::post('/finalizare-comanda/procesat','OrdersController@procesat')->name('procesat');  //final page
    Route::post('/procesat','OrdersController@stripeProcesat')->name('procesat.stripe'); //insert DB after payment
    Route::post('/tombola/incarcare-fisier', 'PagesController@upload')->name('upload');
});


Route::post('/filter','CategoriesController@filter')->name('filters');
Route::post('/contacte/trimite.mesaj', 'PagesController@send')->name('trimite.mesaj');
Route::post('/contestatii/trimite.mesaj', 'PagesController@contestatie')->name('trimite.contest');



Route::get('/categorii/{categorie:descriere}', 'CategoriesController@Category')->name('categories');
Route::get('/rezultat-cautari','SearchController@index')->name('search');
Route::get('categorii/{categorii:denumire}/detalii/{detalii:nume}','ProductController@detail')->name('categorii.detalii');


Route::get('/test','PagesController@test');
