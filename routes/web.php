<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Keahlian;
use App\Models\PageContent;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes - Alumni 4B Malaysia Portal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $content = PageContent::getContent('home');
    $galleryContent = PageContent::getContent('galeri');
    $galleryItems = $galleryContent['items'] ?? [];
    return view('home', compact('content', 'galleryItems'));
})->name('home');

Route::get('/latar-belakang', function () {
    $content = PageContent::getContent('latar-belakang');
    return view('pages.latar-belakang', compact('content'));
})->name('latar-belakang');

Route::get('/carta-organisasi', function () {
    $content = PageContent::getContent('carta-organisasi');
    return view('pages.carta-organisasi', compact('content'));
})->name('carta-organisasi');

Route::get('/hubungi-kami', function () {
    return view('pages.hubungi-kami');
})->name('hubungi-kami');

Route::get('/semakan-keahlian', function () {
    return view('pages.semakan-keahlian');
})->name('semakan-keahlian');

Route::post('/semakan-keahlian', function (Request $request) {
    $request->validate([
        'method' => ['required', 'in:ic,membership'],
        'value' => ['required', 'string'],
    ]);
    $value = preg_replace('/\s+/', '', $request->value);
    $keahlian = null;
    if ($request->method === 'ic') {
        $keahlian = Keahlian::where('ic_number', $value)->first();
    } else {
        $keahlian = Keahlian::where('no_ahli', $value)->first();
    }
    if (!$keahlian) {
        return response()->json(['status' => 'not-found']);
    }
    if ($keahlian->status !== 'disahkan') {
        return response()->json(['status' => 'pending', 'message' => 'Permohonan anda masih dalam proses pengesahan. Sila tunggu kelulusan Setiausaha dan HQ.']);
    }
    $negeri = [
        'johor' => 'Johor', 'kedah' => 'Kedah', 'kelantan' => 'Kelantan', 'melaka' => 'Melaka',
        'negeri_sembilan' => 'Negeri Sembilan', 'pahang' => 'Pahang', 'perak' => 'Perak',
        'perlis' => 'Perlis', 'pulau_pinang' => 'Pulau Pinang', 'sabah' => 'Sabah',
        'sarawak' => 'Sarawak', 'selangor' => 'Selangor', 'terengganu' => 'Terengganu',
        'wp_kuala_lumpur' => 'WP Kuala Lumpur', 'wp_labuan' => 'WP Labuan', 'wp_putrajaya' => 'WP Putrajaya',
    ];
    return response()->json([
        'status' => 'found',
        'data' => [
            'name' => $keahlian->name,
            'icNumber' => $keahlian->ic_number,
            'membershipNumber' => $keahlian->no_ahli,
            'state' => $negeri[$keahlian->state] ?? ucfirst($keahlian->state),
            'registrationDate' => $keahlian->updated_at->format('d/m/Y'),
            'expiryDate' => $keahlian->updated_at->copy()->addYear()->format('d/m/Y'),
            'status' => 'active',
        ],
    ]);
})->name('semakan-keahlian.post');

Route::get('/galeri', function () {
    $content = PageContent::getContent('galeri');
    return view('pages.galeri', compact('content'));
})->name('galeri');

Route::get('/aktiviti', function () {
    $content = PageContent::getContent('aktiviti');
    return view('pages.aktiviti', compact('content'));
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

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'ic_number' => ['required', 'string', 'max:20', 'unique:keahlian,ic_number'],
        'email' => ['required', 'email'],
        'phone' => ['required', 'string', 'max:20'],
        'address' => ['required', 'string'],
        'postcode' => ['required', 'string', 'max:10'],
        'city' => ['required', 'string', 'max:100'],
        'state' => ['required', 'string', 'in:johor,kedah,kelantan,melaka,negeri_sembilan,pahang,perak,perlis,pulau_pinang,sabah,sarawak,selangor,terengganu,wp_kuala_lumpur,wp_labuan,wp_putrajaya'],
        'occupation' => ['required', 'string', 'max:255'],
        'employer' => ['required', 'string', 'max:255'],
        'physical_card' => ['nullable'],
        'agree_terms' => ['accepted'],
    ], [
        'agree_terms.accepted' => 'Sila sahkan bahawa maklumat anda benar dan bersetuju dengan terma.',
        'ic_number.unique' => 'Nombor kad pengenalan ini telah didaftarkan. Satu kad pengenalan hanya boleh daftar sekali.',
    ]);

    Keahlian::create([
        'name' => $request->name,
        'ic_number' => $request->ic_number,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'postcode' => $request->postcode,
        'city' => $request->city,
        'state' => $request->state,
        'occupation' => $request->occupation,
        'employer' => $request->employer,
        'previous_membership_number' => $request->previous_membership_number,
        'previous_membership_year' => $request->previous_membership_year,
        'physical_card' => (bool) $request->physical_card,
        'status' => 'menunggu',
    ]);

    return redirect()->route('register')->with('success', 'Pendaftaran berjaya dihantar! Permohonan anda akan disahkan oleh Setiausaha terlebih dahulu, kemudian HQ. Sila tunggu pengesahan.');
})->name('register.post');

Route::get('/registeracc', function () {
    return view('pages.registeracc');
})->name('registeracc');

Route::post('/registeracc', function (Request $request) {
    $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'in:setiausaha,hq'],
    ];
    if ($request->role === 'setiausaha') {
        $rules['state'] = ['required', 'in:johor,kedah,kelantan,melaka,negeri_sembilan,pahang,perak,perlis,pulau_pinang,sabah,sarawak,selangor,terengganu,wp_kuala_lumpur,wp_labuan,wp_putrajaya'];
    }
    $request->validate($rules);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'state' => $request->role === 'setiausaha' ? $request->state : null,
        'approved' => false,
    ]);

    return redirect()->route('login')->with('success', 'Pendaftaran berjaya! Sila tunggu pengesahan daripada pentadbir sebelum anda boleh log masuk.');
})->name('registeracc.post');

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

        // Setiausaha/HQ mesti diluluskan oleh pentadbir dahulu
        if (in_array($user->role, ['setiausaha', 'hq']) && !$user->approved) {
            return back()->with('error', 'Akaun anda belum diluluskan. Sila tunggu pengesahan daripada pentadbir.');
        }

        Session::put('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'state' => $user->state, // negeri untuk setiausaha, null untuk hq
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
    if (!session()->has('user') || session('user.role') !== 'setiausaha') {
        return session()->has('user') ? redirect()->route('home') : redirect()->route('login');
    }
    $userState = session('user.state');
    $q = Keahlian::query();
    if ($userState) {
        $q->where('state', $userState);
    }
    $menunggu = (clone $q)->where('status', 'menunggu')->orderBy('created_at', 'desc')->take(5)->get();
    $menungguHq = (clone $q)->where('status', 'menunggu_hq')->orderBy('updated_at', 'desc')->take(4)->get();
    $countMenunggu = (clone $q)->where('status', 'menunggu')->count();
    $countMenungguHq = (clone $q)->where('status', 'menunggu_hq')->count();
    $stateLabel = $userState ? Keahlian::namaNegeri($userState) : 'Alumni 4B';

    return view('pages.setiausaha.dashboard', compact('menunggu', 'menungguHq', 'countMenunggu', 'countMenungguHq', 'stateLabel'));
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
        return session()->has('user') ? redirect()->route('home') : redirect()->route('login');
    }
    $userState = session('user.state');
    $q = Keahlian::query();
    if ($userState) {
        $q->where('state', $userState);
    }
    $menunggu = (clone $q)->where('status', 'menunggu')->orderBy('created_at', 'desc')->get();
    $menungguHq = (clone $q)->where('status', 'menunggu_hq')->orderBy('updated_at', 'desc')->get();
    $stateLabel = $userState ? Keahlian::namaNegeri($userState) : 'Alumni 4B';

    return view('pages.setiausaha.pengesahan', compact('menunggu', 'menungguHq', 'stateLabel'));
})->name('pengesahan');

Route::post('/setiausaha/keahlian/{id}/sahkan', function ($id) {
    if (!session()->has('user') || session('user.role') !== 'setiausaha') {
        return redirect()->route('login');
    }
    $keahlian = Keahlian::findOrFail($id);
    $userState = session('user.state');
    if ($userState && $keahlian->state !== $userState) {
        return back()->with('error', 'Anda tidak dibenarkan mengurus permohonan negeri ini.');
    }
    if ($keahlian->status !== 'menunggu') {
        return back()->with('error', 'Permohonan ini telah diproses.');
    }

    $keahlian->update(['status' => 'menunggu_hq']);

    return back()->with('success', 'Permohonan berjaya disahkan. Permohonan akan dihantar ke HQ untuk kelulusan akhir.');
})->name('keahlian.sahkan');

Route::post('/setiausaha/keahlian/{id}/tolak', function ($id) {
    if (!session()->has('user') || session('user.role') !== 'setiausaha') {
        return redirect()->route('login');
    }
    $keahlian = Keahlian::findOrFail($id);
    $userState = session('user.state');
    if ($userState && $keahlian->state !== $userState) {
        return back()->with('error', 'Anda tidak dibenarkan mengurus permohonan negeri ini.');
    }
    if ($keahlian->status !== 'menunggu') {
        return back()->with('error', 'Permohonan ini telah diproses.');
    }

    $keahlian->update(['status' => 'tolak']);

    return back()->with('success', 'Permohonan telah ditolak.');
})->name('keahlian.tolak');


Route::get('/setiausaha/senarai-ahli', function (Request $request) {
    if (!session()->has('user') || session('user.role') !== 'setiausaha') {
        return redirect()->route('login');
    }
    $userState = session('user.state');
    $query = Keahlian::where('status', 'disahkan')->whereNotNull('no_ahli')->orderBy('updated_at', 'desc');
    if ($userState) {
        $query->where('state', $userState);
    }
    if ($q = $request->get('q')) {
        $query->where(function ($qry) use ($q) {
            $qry->where('name', 'like', "%{$q}%")
                ->orWhere('no_ahli', 'like', "%{$q}%")
                ->orWhere('ic_number', 'like', "%{$q}%");
        });
    }
    $ahli = $query->get();
    $stateLabel = $userState ? Keahlian::namaNegeri($userState) : 'Alumni 4B';
    return view('pages.setiausaha.senarai-ahli', compact('ahli', 'stateLabel'));
})->name('senarai-ahli');




// =======================
// HQ Routes (Protected)
// =======================

Route::get('/hq/dashboard', function () {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $menungguHq = Keahlian::where('status', 'menunggu_hq')->orderBy('updated_at', 'desc')->take(5)->get();
    $diluluskan = Keahlian::where('status', 'disahkan')->orderBy('updated_at', 'desc')->take(5)->get();
    $countMenungguHq = Keahlian::where('status', 'menunggu_hq')->count();
    $countDiluluskan = Keahlian::where('status', 'disahkan')->count();
    $negeriStats = Keahlian::where('status', 'disahkan')
        ->selectRaw('state, count(*) as jumlah')
        ->groupBy('state')
        ->orderByDesc('jumlah')
        ->get();
    $totalAhli = Keahlian::where('status', 'disahkan')->count();
    return view('pages.hq.dashboard', compact('menungguHq', 'diluluskan', 'countMenungguHq', 'countDiluluskan', 'negeriStats', 'totalAhli'));
})->name('hq.dashboard');

Route::get('/hq/pengesahan', function () {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $menungguHq = Keahlian::where('status', 'menunggu_hq')->orderBy('updated_at', 'desc')->get();
    $diluluskan = Keahlian::where('status', 'disahkan')->orderBy('updated_at', 'desc')->get();
    return view('pages.hq.pengesahan', compact('menungguHq', 'diluluskan'));
})->name('hq.pengesahan');

Route::post('/hq/keahlian/{id}/luluskan', function ($id) {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $keahlian = Keahlian::findOrFail($id);
    if ($keahlian->status !== 'menunggu_hq') {
        return back()->with('error', 'Permohonan ini telah diproses.');
    }
    $countApproved = Keahlian::where('status', 'disahkan')->count();
    $keahlian->update([
        'status' => 'disahkan',
        'no_ahli' => 'A' . str_pad($countApproved + 1, 5, '0', STR_PAD_LEFT),
    ]);
    return back()->with('success', 'Permohonan berjaya diluluskan dan nombor ahli telah diberi.');
})->name('keahlian.hq.luluskan');

Route::get('/hq/laporan', function (Request $request) {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }

    $disahkan = Keahlian::where('status', 'disahkan');

    // Laporan Tahunan: tahun, jumlah (kumulatif), baru (ahli baru tahun itu)
    $ahliByYear = (clone $disahkan)
        ->selectRaw('YEAR(created_at) as tahun, COUNT(*) as baru')
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->pluck('baru', 'tahun')
        ->toArray();

    $tahunList = array_keys($ahliByYear);
    if (empty($tahunList)) {
        $tahunMin = (int) date('Y');
    } else {
        $tahunMin = (int) min($tahunList);
    }
    $tahunMax = (int) date('Y');

    $laporan = [];
    $jumlahKumulatif = 0;
    for ($y = $tahunMin; $y <= $tahunMax; $y++) {
        $baru = (int) ($ahliByYear[$y] ?? 0);
        $jumlahKumulatif += $baru;
        $laporan[] = [
            'tahun' => $y,
            'jumlah' => $jumlahKumulatif,
            'baru' => $baru,
            'tamat' => 0,
            'meninggal' => 0,
        ];
    }

    // Statistik Negeri: jumlah ahli disahkan mengikut state
    $jumlahNegeri = (clone $disahkan)
        ->selectRaw('state, COUNT(*) as jumlah')
        ->groupBy('state')
        ->orderByDesc('jumlah')
        ->get()
        ->map(fn ($r) => ['negeri' => Keahlian::namaNegeri($r->state), 'jumlah' => (int) $r->jumlah, 'state_key' => $r->state])
        ->toArray();

    $tahunPilih = $request->get('tahun', (string) $tahunMax);

    // Ahli baru tahun pilih mengikut BULAN (sort by month untuk tahun yang dipilih)
    $ahliByMonth = (clone $disahkan)
        ->whereYear('created_at', $tahunPilih)
        ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('jumlah', 'bulan')
        ->toArray();

    $namaBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April', 5 => 'Mei', 6 => 'Jun',
        7 => 'Julai', 8 => 'Ogos', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember',
    ];
    $laporanBulanan = [];
    for ($m = 1; $m <= 12; $m++) {
        $laporanBulanan[] = [
            'bulan' => $m,
            'nama_bulan' => $namaBulan[$m],
            'jumlah' => (int) ($ahliByMonth[$m] ?? 0),
        ];
    }

    // Ahli baru tahun pilih mengikut negeri
    $baruByNegeri = (clone $disahkan)
        ->whereYear('created_at', $tahunPilih)
        ->selectRaw('state, COUNT(*) as jumlah')
        ->groupBy('state')
        ->orderByDesc('jumlah')
        ->get()
        ->map(fn ($r) => ['negeri' => Keahlian::namaNegeri($r->state), 'jumlah' => (int) $r->jumlah])
        ->toArray();

    // Demografi Kaum & Permohonan Tukar Negeri: tiada dalam DB
    $demografi = [];
    $tukarNegeri = [];

    return view('pages.hq.laporan', compact(
        'laporan', 'demografi', 'jumlahNegeri', 'baruByNegeri',
        'tukarNegeri', 'tahunMin', 'tahunMax', 'tahunPilih', 'laporanBulanan'
    ));
})->name('hq.laporan');

Route::get('/hq/senarai-ahli', function (Request $request) {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $query = Keahlian::where('status', 'disahkan')->whereNotNull('no_ahli')->orderBy('updated_at', 'desc');
    if ($q = $request->get('q')) {
        $query->where(function ($qry) use ($q) {
            $qry->where('name', 'like', "%{$q}%")
                ->orWhere('no_ahli', 'like', "%{$q}%")
                ->orWhere('ic_number', 'like', "%{$q}%");
        });
    }
    $ahli = $query->get();
    $stateLabel = 'Alumni 4B Malaysia';
    return view('pages.hq.senarai-ahli', compact('ahli', 'stateLabel'));
})->name('hq.senarai-ahli');

// HQ Pengurusan Pengguna
Route::get('/hq/pengurusan-pengguna', function () {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $users = User::whereIn('role', ['hq', 'setiausaha'])->orderBy('role')->orderBy('state')->orderBy('name')->get();
    return view('pages.hq.pengurusan-pengguna', compact('users'));
})->name('hq.pengurusan-pengguna');

Route::post('/hq/pengurusan-pengguna', function (Request $request) {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'in:setiausaha,hq'],
    ];
    if ($request->role === 'setiausaha') {
        $rules['state'] = ['required', 'in:johor,kedah,kelantan,melaka,negeri_sembilan,pahang,perak,perlis,pulau_pinang,sabah,sarawak,selangor,terengganu,wp_kuala_lumpur,wp_labuan,wp_putrajaya'];
    }
    $request->validate($rules);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'state' => $request->role === 'setiausaha' ? $request->state : null,
        'approved' => true,
    ]);

    return redirect()->route('hq.pengurusan-pengguna')->with('success', 'Pengguna berjaya ditambah. Akaun boleh log masuk dengan serta-merta.');
})->name('hq.pengurusan-pengguna.store');

Route::delete('/hq/pengurusan-pengguna/{id}', function ($id) {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $user = User::findOrFail($id);
    if ($user->id === session('user.id')) {
        return back()->with('error', 'Anda tidak boleh nyahaktif akaun anda sendiri.');
    }
    $user->delete();
    return back()->with('success', 'Akaun telah dinyahaktifkan.');
})->name('hq.pengurusan-pengguna.deactivate');

// HQ Edit Public Pages
Route::get('/hq/edit-page/{slug}', function ($slug) {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $allowed = ['home', 'latar-belakang', 'carta-organisasi', 'aktiviti', 'galeri'];
    if (!in_array($slug, $allowed)) {
        return redirect()->route('hq.dashboard');
    }
    $page = PageContent::ensureExists($slug);
    return view('pages.hq.edit-page', ['slug' => $slug, 'page' => $page, 'content' => $page->content]);
})->name('hq.edit-page')->where('slug', 'home|latar-belakang|carta-organisasi|aktiviti|galeri');

Route::post('/hq/edit-page/{slug}', function (Request $request, $slug) {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    $allowed = ['home', 'latar-belakang', 'carta-organisasi', 'aktiviti', 'galeri'];
    if (!in_array($slug, $allowed)) {
        return redirect()->route('hq.dashboard');
    }
    $page = PageContent::where('page_slug', $slug)->firstOrFail();
    $content = $request->input('content');
    if (is_string($content)) {
        $content = json_decode($content, true) ?? [];
    }
    if ($slug === 'latar-belakang' && isset($content['objektif']) && is_string($content['objektif'])) {
        $content['objektif'] = array_filter(array_map('trim', explode("\n", $content['objektif'])));
    }
    if ($slug === 'galeri' && isset($content['items']) && is_array($content['items'])) {
        foreach ($content['items'] as $i => &$item) {
            if ($request->hasFile('gallery_image_' . $i)) {
                $file = $request->file('gallery_image_' . $i);
                if ($file->isValid()) {
                    $path = $file->store('gallery', 'public');
                    $item['image'] = $path;
                }
            } elseif (empty($item['image']) && !empty($page->content['items'][$i]['image'] ?? null)) {
                $item['image'] = $page->content['items'][$i]['image'];
            }
        }
    }
    if ($slug === 'carta-organisasi') {
        if (!empty($content['chart_tree']) && is_array($content['chart_tree'])) {
            $chartImages = $request->file('chart_image');
            if (is_array($chartImages)) {
                $index = 0;
                $applyChartImages = function (&$nodes) use ($chartImages, &$index, &$applyChartImages) {
                    if (!is_array($nodes)) return;
                    foreach ($nodes as &$node) {
                        if (isset($chartImages[$index]) && $chartImages[$index]->isValid()) {
                            $node['image'] = $chartImages[$index]->store('chart', 'public');
                        }
                        $index++;
                        if (!empty($node['children'])) {
                            $applyChartImages($node['children']);
                        }
                    }
                };
                $applyChartImages($content['chart_tree']);
            }
        }
        if (!empty($content['executive']) && is_array($content['executive'])) {
            foreach ($content['executive'] as $i => &$member) {
                if ($request->hasFile('executive_image_' . $i)) {
                    $file = $request->file('executive_image_' . $i);
                    if ($file->isValid()) {
                        $member['image'] = $file->store('chart', 'public');
                    }
                } elseif (empty($member['image']) && !empty($page->content['executive'][$i]['image'] ?? null)) {
                    $member['image'] = $page->content['executive'][$i]['image'];
                }
            }
        }
    }
    $merged = array_replace_recursive($page->content ?? [], $content);
    $page->update(['content' => $merged]);
    return redirect()->route('hq.edit-page', $slug)->with('success', 'Kandungan halaman berjaya disimpan.');
})->name('hq.edit-page.update')->where('slug', 'home|latar-belakang|carta-organisasi|aktiviti|galeri');

// HQ "Laman Utama" uses existing home view
Route::get('/hq', function () {
    if (!session()->has('user') || session('user.role') !== 'hq') {
        return redirect()->route('login');
    }
    return view('home');
})->name('hq.home');



