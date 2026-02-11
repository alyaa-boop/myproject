<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| Web Routes - Alumni 4B Malaysia Portal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/latar-belakang', function () {
    return view('pages.latar-belakang');
})->name('latar-belakang');

Route::get('/carta-organisasi', function () {
    return view('pages.carta-organisasi');
})->name('carta-organisasi');

Route::get('/hubungi-kami', function () {
    return view('pages.hubungi-kami');
})->name('hubungi-kami');

Route::get('/semakan-keahlian', function () {
    return view('pages.semakan-keahlian');
})->name('semakan-keahlian');

Route::get('/galeri', function () {
    return view('pages.galeri');
})->name('galeri');

Route::get('/aktiviti', function () {
    return view('pages.aktiviti');
})->name('aktiviti.index');

Route::get('/aktiviti/{id}', function ($id) {
    return view('pages.aktiviti-detail', ['id' => $id]);
})->name('aktiviti.show');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');



Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Find user by email in DB
    $user = User::where('email', $request->email)->first();
    // dd($request->email, $user?->email, $user?->role);
    // dd(Hash::check($request->password, $user->password), $request->password);


    // If user exists AND password matches hashed password in DB
    if ($user && Hash::check($request->password, $user->password)) {

        Session::put('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role, // 'hq' / 'setiausaha' / 'ahli'
        ]);

        // Redirect based on role
        if ($user->role === 'hq') {
            return redirect()->route('hq.dashboard');
        }

        if ($user->role === 'setiausaha') {
            return redirect()->route('dashboard');
        }

        // default (ahli)
        return redirect()->route('home');
    }

    return back()->with('error', 'Email atau kata laluan salah');
})->name('login.post');




Route::get('/logout', function () {
    Session::forget('user');
    return redirect()->route('home');
})->name('logout');

Route::get('/setiausaha/dashboard', function () {

    if (!session()->has('user')) {
        return redirect()->route('login');
    }

    if (session('user.role') !== 'setiausaha') {
        return redirect()->route('home');
    }

    return view('pages.setiausaha.dashboard');
})->name('dashboard');


// Route::get('/setiausaha/daftar-ahli', function () {

//     if (!session()->has('user')) {
//         return redirect()->route('login');
//     }

//     if (session('user.role') !== 'setiausaha') {
//         return redirect()->route('home');
//     }

//     return view('pages.setiausaha.daftar-ahli');
// })->name('daftar-ahli');

Route::get('/setiausaha/pengesahan', function () {

    if (!session()->has('user') || session('user.role') !== 'setiausaha') {
        return redirect()->route('login');
    }

    return view('pages.setiausaha.pengesahan');
})->name('pengesahan');


Route::get('/setiausaha/senarai-ahli', function () {

    if (!session()->has('user') || session('user.role') !== 'setiausaha') {
        return redirect()->route('login');
    }

    return view('pages.setiausaha.senarai-ahli');
})->name('senarai-ahli');




// =======================
// HQ Routes (Protected)
// =======================

Route::get('/hq/dashboard', function () {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    return view('pages.hq.dashboard');
})->name('hq.dashboard');

Route::get('/hq/pengesahan', function () {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    return view('pages.hq.pengesahan');
})->name('hq.pengesahan');

Route::get('/hq/laporan', function () {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    return view('pages.hq.laporan');
})->name('hq.laporan');

// HQ "Laman Utama" uses existing home view
Route::get('/hq', function () {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    return view('home');
})->name('hq.home');



