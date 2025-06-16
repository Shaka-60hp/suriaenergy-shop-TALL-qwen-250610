<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('livewire.auth.login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            //  Redirigimos al URL intencionado o al home
            $intended = session('url.intended', route('home'));

            return redirect($intended);
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ])->onlyInput('email');
    }

    protected function authenticated(Request $request, $user)
    {
        // Si hay una URL intencionada (ej: /checkout), vuelve allí
        if ($intended = Session::get('url.intended')) {
            return redirect($intended);
        }

        // De lo contrario, redirige al home
        return redirect()->route('home');
    }
}
