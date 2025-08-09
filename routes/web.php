<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard;
use App\Livewire\Channel\EditChannel;
use App\Livewire\Video\CreateVideo;
use App\Livewire\Video\EditVideo;
use App\Livewire\Video\AllVideo;
use App\Livewire\Video\WatchVideo;
use App\Livewire\HomePage;


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

//Route::get('/', function () {
 //   return view('welcome');
//});
Route::get('/', HomePage::class)->name('home');

Route::post('/send-email', [ContactUsController::class, 'sendEmail']);
Route::get('/login', Login::class)->name('auth.login');
Route::get('/register', Register::class)->name('auth.register');
Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/channel/{channel}/edit', EditChannel::class)->name('edit.channel');
Route::get('/videos/{channel}/create', CreateVideo::class)->name('video.create');
Route::get('/videos/{channel}/{video}/edit', EditVideo::class)->name('video.edit');
Route::get('/allvideos', AllVideo::class)->name('video.all');
Route::get('/watch/{video}', WatchVideo::class)->name('video.watch');


Route::get('/phpinfo', function () {
    phpinfo();
});