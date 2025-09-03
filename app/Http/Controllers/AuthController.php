<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm() {
        return view('auth.register');
    }
    public function register(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:profesor,administrador',
        
    ]);

    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);
if ($request->role === 'profesor') {
    Auth::attempt($request->only('email', 'password'));
    return redirect()->route('docentes.create');
}

return redirect()->route('welcome')->with('success', 'Registro exitoso. Ahora inicia sesión.');

    
}

  
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

     if (Auth::attempt($credentials)) {
        // Autenticación exitosa
        $user = Auth::user();

        if ($user->role === 'administrador') {
    return redirect()->route('home_de_admins');
} else {
    return redirect()->route('docentes.home_de_docentes');
}


    }

    
    return back()->withErrors([
        'email' => 'Usuario o contraseña incorrectos.',
    ]);
}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('welcome');
}

}
