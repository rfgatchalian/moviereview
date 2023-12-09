<?php
use Laravel\Socialite\Facades\Socialite;

Route::view('/', 'auth.register');
Route::view('terms-and-conditions','terms')->name('terms');
Route::view('about','about')->name('about');
Route::get('/movies-list','MovieController@index')->name('movieList');
Route::get('/get-movies','MovieController@getMovies')->name('user.getMovies');
Route::get('/get-movies/{id}','MovieController@show')->name('user.getMoviesShow');
Route::post('/submit-review','MovieController@submitReview')->name('user.submitReview');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');


Auth::routes();

Route::get('login/google',[App\Http\Controllers\Auth\LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback',[App\Http\Controllers\Auth\LoginController::class,'handleGoogleCallback']);

Route::get('login/facebook',[App\Http\Controllers\Auth\LoginController::class,'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback',[App\Http\Controllers\Auth\LoginController::class,'handleFacebookCallback']);

Route::group(['prefix' => 'admins', 'as' => 'admins.', 'namespace' => 'Admins', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/','MovieController@index')->name('home');
    Route::get('/users','UsersController@index')->name('index');

    Route::get('/get-users','UsersController@getUsers')->name('getUsers');
    Route::post('/delete-users','UsersController@destroy')->name('deleteUser');

    Route::get('/get-movies','MovieController@getMovies')->name('getMovies');
    Route::post('/create-movies','MovieController@store')->name('createMovie');
    Route::post('/update-movies','MovieController@update')->name('updateMovie');
    Route::post('/delete-movies','MovieController@destroy')->name('deleteMovie');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Genre
    Route::delete('genres/destroy', 'GenreController@massDestroy')->name('genres.massDestroy');
    Route::resource('genres', 'GenreController');

    // Movie
    Route::delete('movies/destroy', 'MovieController@massDestroy')->name('movies.massDestroy');
    Route::post('movies/media', 'MovieController@storeMedia')->name('movies.storeMedia');
    Route::post('movies/ckmedia', 'MovieController@storeCKEditorImages')->name('movies.storeCKEditorImages');
    Route::resource('movies', 'MovieController');

    // Rating
    Route::delete('ratings/destroy', 'RatingController@massDestroy')->name('ratings.massDestroy');
    Route::resource('ratings', 'RatingController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', function(){
        return redirect('/movies-list');
    })->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Genre
    Route::delete('genres/destroy', 'GenreController@massDestroy')->name('genres.massDestroy');
    Route::resource('genres', 'GenreController');

    // Movie
    Route::delete('movies/destroy', 'MovieController@massDestroy')->name('movies.massDestroy');
    Route::post('movies/media', 'MovieController@storeMedia')->name('movies.storeMedia');
    Route::post('movies/ckmedia', 'MovieController@storeCKEditorImages')->name('movies.storeCKEditorImages');
    Route::resource('movies', 'MovieController');

    // Rating
    Route::delete('ratings/destroy', 'RatingController@massDestroy')->name('ratings.massDestroy');
    Route::resource('ratings', 'RatingController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
