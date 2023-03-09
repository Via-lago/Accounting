<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use Response;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $remember = $request->has('remember') ? true : false;
        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password],$remember)) {
            Alert::warning('Peringatan', 'Username atau kata sandi yang anda masukan salah');
            return redirect()->back();
        }

        return redirect()->route('beranda');
    }

    public function editPassword()
    {
        return view('auth.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'sandi_lama' => 'required',
            'sandi_baru' => 'required|confirmed|min:5',
        ]);

        if (Hash::check($validateData['sandi_lama'],Auth::user()->password)) {
            User::where('id',Auth::user()->id)->first()->update([
                'password' => $validateData['sandi_baru'],
            ]);

            Alert::success('Sukses', 'Sandi berhasil diupdate');
            return redirect()->back();
        }else {
            Alert::warning('Gagal', 'Sandi lama tidak sesuai');
            return redirect()->back();
        }
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('auth.profile', ['user' => $user]);
    }

    public function editProfile()
    {
        $user = User::find(Auth::user()->id);

        return view('auth.edit-profile',['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validateData = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
        ]);



        User::where('id',$user->id)->update([
            'nama' => $validateData['nama'],
            'username' => $validateData['username'],
        ]);

        Alert::success('Sukses', 'Profile berhasil diupdate');
        return redirect()->route('profile');


    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
