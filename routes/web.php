<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Jobs\PruneOldPostsJob;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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


Route::get('posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

Route::get('posts/create',[PostController::class, 'create'])->name('posts.create')->middleware('auth');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');

Route::post('/post/{post}', [CommentController::class, 'store'])->name('posts.comments.store')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/delete-old-posts', function () {

   $pruneOldPostsJob= new PruneOldPostsJob;
   dispatch($pruneOldPostsJob);

   return 'Removing older posts...';

});

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'email' => $githubUser->email,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect()->route('posts.index');
});

Route::get('/auth/redirect-g', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/auth/callback-g', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate([
        'email' => $googleUser->email,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect()->route('posts.index');
});

