<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
    public function checkStudent(Request $request)
{
    $data = $request->validate([
        'nama_lengkap' => ['required', 'string'],
        'nis' => ['required', 'string'],
        'kelas' => ['required', 'string'],
        'jurusan_id' => ['required', 'string'],
    ]);

    $siswa = Siswa::where('nis', $data['nis'])
        ->where('nama_lengkap', $data['nama_lengkap'])
        ->where('kelas', $data['kelas'])
        ->where('jurusan_id', $data['jurusan_id'])
        ->first();

    if (!$siswa) {
        return response()->json([
            'success' => false,
            'message' => 'Data siswa tidak ditemukan.'
        ], 404);
    }

    if ($siswa->user_id !== null) {
        return response()->json([
            'success' => false,
            'message' => 'Siswa ini sudah memiliki akun.'
        ], 422);
    }

    return response()->json([
        'success' => true,
        'message' => 'Data siswa ditemukan.',
        'siswa_id' => $siswa->id,
    ]);
}
}
