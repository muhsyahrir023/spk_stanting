<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if($user = Auth::user()) {
            return redirect()->intended('home');
        }

        return view('login.view_login');
    }

    public function proses(Request $request)  {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
            ]
        );

        $kredensial = $request->only('username','password');

        if(Auth::attempt($kredensial)){
            $request->session()->regenerate();
            $user = Auth::user();
            // if ($user->level == '1') {
            //     return redirect()->intended('admin');
            // } elseif ($user->level == '2'){
            //     return redirect()->intended('petugas');
            // }elseif ($user->level == '3'){
            //     return redirect()->intended('apoteker');
            // }elseif ($user->level == '4'){
            //     return redirect()->intended('pimpinan');
            // }
            if($user){
                toastr()->success('Anda Berhasil Login');
                return redirect()->intended('home');
            }
            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Maaf username atau password anda salah',
        ])->onlyInput('username');
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
       
        return redirect('/login');
    }
}
