<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $role = $request->input('role', 'penghuni');

        // Base validation rules
        $rules = [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:penghuni,pemilik'],
        ];

        // Role-specific rules
        if ($role === 'penghuni') {
            $rules['institution'] = ['required', 'string', 'max:255'];
        } else {
            $rules['kos_name']    = ['required', 'string', 'max:255'];
            $rules['kos_address'] = ['required', 'string', 'max:500'];
            $rules['kos_rooms']   = ['required', 'integer', 'min:1'];
        }

        $validated = $request->validate($rules);

        $user = User::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'password'    => Hash::make($validated['password']),
            'role'        => $role,
            'institution' => $role === 'penghuni' ? ($validated['institution'] ?? null) : null,
            'kos_name'    => $role === 'pemilik'  ? ($validated['kos_name']    ?? null) : null,
            'kos_address' => $role === 'pemilik'  ? ($validated['kos_address'] ?? null) : null,
            'kos_rooms'   => $role === 'pemilik'  ? ($validated['kos_rooms']   ?? null) : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang di KostSobat 🎉');
    }
}
