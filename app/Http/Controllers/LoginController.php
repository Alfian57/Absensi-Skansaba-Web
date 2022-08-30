<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Login Gagal', 'Masih Ada Field Yang Kosong');
            return redirect('/admin/login')->with('email', $request->email);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if ($request->role == "guru") {
            if (Auth::guard('teacher')->attempt($credentials)) {
                $request->session()->regenerate();
                session()->put('history', []);

                return redirect('/admin/home');
            }
        } else {
            if (Auth::guard('user')->attempt($credentials)) {
                $request->session()->regenerate();
                session()->put('history', []);

                return redirect('/admin/home');
            }
        }

        Alert::error('Login Gagal', 'Akun Tidak Ditemukan');
        return redirect('/admin/login')->with('email', $request->email);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('teacher')->check()) {
            Auth::guard('teacher')->logout();
        } else {
            Auth::guard('user')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function changePassword()
    {
        session()->push('history', [
            'route' => 'admin/changePassword',
            'name' => 'Ganti Password'
        ]);

        $user = null;
        if (Auth::guard('teacher')->check()) {
            $user = Auth::guard('teacher')->user();
        } else {
            $user = Auth::guard('user')->user();
        }
        $data = [
            'title' => 'Ganti Password',
            'user' => $user,
        ];
        return view('login.changePass', $data);
    }

    public function updatePassword(Request $request)
    {
        if (!Hash::check($request->oldPassword, $request->password)) {
            Alert::error('Password Lama Salah');
            return back();
        }

        $request->validate([
            'newPassword' => 'required|min:8'
        ]);

        if (Auth::guard('teacher')->check()) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
        } else {
            Teacher::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
        }

        return redirect('/admin/home')->with('success', 'Password Admin ' . Auth::user()->name . ' Berhasil Diubah');
    }

    public function changePic()
    {
        session()->push('history', [
            'route' => 'admin/changePic',
            'name' => 'Ganti Foto'
        ]);

        $user = null;
        if (Auth::guard('teacher')->check()) {
            $user = Auth::guard('teacher')->user();
        } else {
            $user = Auth::guard('user')->user();
        }

        $data = [
            'title' => 'Ganti Foto Profile',
            'user' => $user,
        ];
        return view('login.changePic', $data);
    }

    public function updatePic(Request $request)
    {
        $validatedData = $request->validate([
            'profile_pic' => 'image|file|max:10000'
        ]);

        if ($request->deleteImage == "true") {
            Storage::delete($request->old_profile_pic);
            $validatedData['profile_pic'] = null;
        } else {
            if ($request->profile_pic !== $request->old_profile_pic) {
                if ($request->profile_pic) {
                    if (Auth::guard('user')) {
                        $validatedData['profile_pic'] = $request->file('profile_pic')->store('user_profile_pic');
                    } else {
                        $validatedData['profile_pic'] = $request->file('profile_pic')->store('teacher_profile_pic');
                    }
                }
                if ($request->old_profile_pic) {
                    Storage::delete($request->old_profile_pic);
                }
            } else {
                $validatedData['profile_pic'] = $request->profile_pic;
            }
        }

        $profilePic = $validatedData['profile_pic'];

        if (Auth::guard('user')) {
            User::where('id', Auth::guard('user')->user()->id)->update([
                'profile_pic' => $profilePic
            ]);
        } else {
            Teacher::where('id', Auth::guard('teacher')->user()->id)->update([
                'profile_pic' => $profilePic
            ]);
        }

        return redirect('/admin/home')->with('success', 'Profile User Berhasil Diperbarui');
    }
}