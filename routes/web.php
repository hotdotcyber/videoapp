<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GoogleAuthController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard;
use App\Livewire\Channel\EditChannel;
use App\Livewire\Video\CreateVideo;
use App\Livewire\Video\EditVideo;
use App\Livewire\Video\AllVideo;
use App\Livewire\Video\WatchVideo;
use App\Livewire\HomePage;
use App\Livewire\ChangePassword;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Channel\ChannelVideos;
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
Route::get('/forgot-password', ForgotPasswordPage::class)->name('auth.forgot-password');
Route::get('/reset-password/{token}', ResetPasswordPage::class)->name('password.reset');

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/channel/{channel}/edit', EditChannel::class)->name('edit.channel');
Route::get('/videos/{channel}/create', CreateVideo::class)->name('video.create');
Route::get('/videos/{channel}/{video}/edit', EditVideo::class)->name('video.edit');
Route::get('/allvideos', AllVideo::class)->name('video.all');
Route::get('/watch/{video}', WatchVideo::class)->name('video.watch');

Route::get('/channels/{channel}', ChannelVideos::class)->name('channels.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', ChangePassword::class)->name('change-password');
});

Route::get('auth/google',[GoogleAuthController::class,'redirect'])->name('google-auth');
Route::get('auth/google/callback',[GoogleAuthController::class, 'callbackGoogle']);


