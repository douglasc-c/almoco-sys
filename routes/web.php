<?php

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
    return redirect()->to('login');
});

Route::get('changeLang/{locale}', function ($locale) {
	if(in_array($locale, ['en', 'pt', 'es', 'kr', 'ch'])) {
        App::setLocale($locale);
    	\Session::put('locale', $locale);
    }

    return redirect()->back();
});

Auth::routes();

Route::get('profile/confirm-email/{token}', 'Dashboard\ProfileController@mailValidation');


Route::group(['middleware' => ['auth', 'needsRole:user'], 'prefix' => '/'], function () {
	# Home
	Route::get('/user', 'Dashboard\HomeController@index');

	# Profile
	Route::get('profile/backAdmin/', 'Dashboard\ProfileController@backToAdmin');
	Route::post('profile/update', 'Dashboard\ProfileController@updateProfile');
    Route::get('profile', 'Dashboard\ProfileController@index');

	Route::post('teste', 'Dashboard\HomeController@confirmMenu');

});

Route::group(['middleware' => ['auth', 'needsRole:admin'], 'prefix' => 'admin'], function () {
	# Home
	Route::get('/', 'Admin\HomeController@index')->name('admin');


});

Route::group(['middleware' => ['auth', 'needsRole:superadmin'], 'prefix' => 'superadmin'], function () {
	# Home


	Route::get('/', 'SuperAdmin\HomeController@index')->name('superadmin');
	Route::get('/usuarios', 'SuperAdmin\UsersController@index')->name('users');
	Route::get('/usuarios/data', 'SuperAdmin\UsersController@dataUsers')->name('users-data');
    Route::post('/usuarios/criar/usuario/', 'SuperAdmin\UsersController@createUser')->name('create-user');

    #Dashboard
    Route::get('/home/get-data/detail', 'SuperAdmin\HomeController@dataDetailMenu');

    # Foods
    Route::get('/food-categories', 'SuperAdmin\FoodController@foodCategoriesIndex')->name('foodCategories');
    Route::get('/food-categories/data/', 'SuperAdmin\FoodController@dataFoodsCategories')->name('food-categorties-data');
    Route::post('/food-categories/new/', 'SuperAdmin\FoodController@createCategory')->name('createCategory');
    Route::get('/foods', 'SuperAdmin\FoodController@foodIndex');
    Route::get('/food/data/', 'SuperAdmin\FoodController@dataFoods');

    #justifications
    Route::get('/menu/justifications/', 'SuperAdmin\HomeController@getJustifications');
    


});

Route::group(['middleware' => ['auth', 'needsRole:restaurantuser'], 'prefix' => 'restaurantuser'], function () {
	# Home

    Route::get('/', 'Restaurant\HomeController@index')->name('restaurantuser');

        # Foods
        Route::get('/foods', 'Restaurant\FoodController@foodIndex')->name('foods');
        Route::get('/food-categories/data/', 'Restaurant\FoodController@dataFoods')->name('foods-data');
        Route::post('/foods/new/', 'Restaurant\FoodController@createFood');

        #Menus
        Route::get('/menus', 'Restaurant\MenuController@index');
        Route::post('/menu/new/', 'Restaurant\MenuController@createMenu');
        Route::get('/menus/data/', 'Restaurant\MenuController@dataMenu');
        Route::get('/menus/show/{Day}', 'Restaurant\MenuController@show');
        Route::get('/menus/get-data/detail', 'Restaurant\MenuController@dataDetailMenu');

});
