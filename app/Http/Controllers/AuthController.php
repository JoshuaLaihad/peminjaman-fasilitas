<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function User()
    {
        // Retrieve all categories
        $users = User::all();
        
        // Return the categories to a view (e.g., categories.index)
        return view('admin.user', compact('users'));
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin'){
                return redirect()->route('admin.dashboard')->with('success', 'Login Berhasil!');
            }elseif($user->role == 'user'){
                return redirect()->route('user.dashboard')->with('success', 'Login Berhasil!');
            }
        }

        return redirect()->route('login')->with('failed', 'Username atau Password Salah!');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda Berhasil Logout!');
    }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_handphone' => 'required|string|max:15',
            'asal_instansi' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_handphone' => $request->no_handphone,
            'asal_instansi' => $request->asal_instansi,
        ]);

        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if(Auth::attempt($login)){
            return redirect()->route('login')->with('success', 'Pendaftaran Berhasil, SIlahkan Login!');
        }else{
            return redirect()->route('login')->with('failed', 'Pendaftaran Gagal');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_handphone' => 'required|string|max:15',
            'asal_instansi' => 'required|string|max:255',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_handphone' => $request->no_handphone,
            'asal_instansi' => $request->asal_instansi,
            'role' => $request->role, 
        ]);

    return redirect()->route('admin.user')->with('success', 'Data berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'no_handphone' => 'required|numeric',
            'asal_instansi' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'required',
        ]);

    $user = User::findOrFail($id);

    $userData = [
        'name' => $request->name,
        'username' => $request->username,
        'no_handphone' => $request->no_handphone,
        'asal_instansi' => $request->asal_instansi,
        'role' => $request->role,
    ];

    if($request->filled('password')){
        $user['password'] = Hash::make($request->password);
    }

    $user->update($userData);

    return redirect()->route('admin.user')->with('success', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
            
        return redirect()->route('admin.user')->with('success', 'Data berhasil dihapus');
    }
}