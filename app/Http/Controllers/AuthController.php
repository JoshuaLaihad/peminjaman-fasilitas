<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showLoginForm', 'login', 'showRegistrationForm', 'register']);
        $this->middleware('checkrole:admin')->only(['User', 'store', 'update', 'destroy']);
    }

    public function showLoginForm()
    {
        $title = "Login";
        return view('auth.login', compact('title'));
    }

    public function User()
    {
        $title = "Data User";
        $users = User::all();
        return view('admin.user', compact('title', 'users'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin'){
                return redirect()->route('admin.dashboard')->with('success', 'Login Berhasil!');
            } elseif ($user->role == 'user'){
                return redirect()->route('user.dashboard')->with('success', 'Login Berhasil!');
            }
        }

        return redirect()->route('login')->with('failed', 'Username atau Password Salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $cookies = $request->cookies->all();
        foreach ($cookies as $key => $value){
            Cookie::queue(Cookie::forget($key));
        }

        return redirect()->route('login')->with('success', 'Anda Berhasil Logout!');
    }

    public function showRegistrationForm()
    {
        $title = "Register";
        return view('auth.register', compact('title'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_handphone' => 'required|string|max:15',
            'asal_departemen' => 'required|string|max:255',
            'chat_id' => 'nullable|string',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_handphone' => $request->no_handphone,
            'asal_departemen' => $request->asal_departemen,
            'chat_id' => $request->chat_id,
        ]);

        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if(Auth::attempt($login)){
            return redirect()->route('login')->with('success', 'Pendaftaran Berhasil, Silahkan Login!');
        } else {
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
            'asal_departemen' => 'required|string|max:255',
            'role' => 'required',
            'chat_id' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_handphone' => $request->no_handphone,
            'asal_departemen' => $request->asal_departemen,
            'role' => $request->role,
            'chat_id' => $request->chat_id,
        ]);

        return redirect()->route('admin.user')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'no_handphone' => 'required|numeric',
            'asal_departemen' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'required',
            'chat_id' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'no_handphone' => $request->no_handphone,
            'asal_departemen' => $request->asal_departemen,
            'role' => $request->role,
            'chat_id' => $request->chat_id,
        ];

        if($request->filled('password')){
            $userData['password'] = Hash::make($request->password);
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
