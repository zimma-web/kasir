<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/');
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users', function ($attribute, $value, $fail) {
                if (strtolower($value) !== $value) {
                    $fail('The ' . $attribute . ' must be lowercase.');
                }
            }],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', function ($attribute, $value, $fail) {
                if (strtolower($value) !== $value) {
                    $fail('The ' . $attribute . ' must be lowercase.');
                }
            }],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:admin,petugas,user'], // Assuming these are the valid roles
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role,
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'petugas') {
            return redirect()->route('pembelian.index');
        }

        return redirect('/');
    }
}
