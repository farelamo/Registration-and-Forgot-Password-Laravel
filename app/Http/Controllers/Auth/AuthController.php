<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiRequest;
use App\Jobs\ForgotPasswordJob;
use App\Jobs\RegistrationJob;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            alert()->error('Maaf', 'Username tidak ditemukan');
            return redirect('/');
        }

        if (Auth::Attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            alert()->success('👋 Welcome Back');
            return redirect('/dashboard');
        }

        alert()->error('Maaf', 'Password Salah');
        return redirect('/');
    }

    public function regist(Request $request)
    {
        return view('auth.register');
    }

    public function signup(PegawaiRequest $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:8',
            'username' => 'required|max:50|unique:users,username',
        ];

        Validator::make($request->all(), $rules, $messages =
            [
                'email.required' => 'email harus diisi',
                'email.email' => 'format email salah',
                'email.unique' => 'email sudah digunakan user lain',
                'username.required' => 'username harus diisi',
                'username.max' => 'maximal username 50 karakter',
                'username.unique' => 'username sudah digunakan user lain',
                'password.required' => 'password harus diisi',
                'password.max' => 'maximal password 8 karakter',
            ])->validate();

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'telp' => $request->telp,
            'role' => 'pegawai',
            'type' => $request->type,
            'gender' => $request->gender,
            'posisi' => $request->posisi,
            'domisili' => $request->domisili,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        dispatch(new RegistrationJob($user));

        alert()->success('Mantap', 'Akun berhasil dibuat');
        return redirect('/');
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function handleForgot(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        Validator::make($request->all(), $rules, $messages =
            [
                'email.required' => 'email harus diisi',
                'email.email' => 'format email salah',
                'email.exists' => 'email tidak ditemukan',
            ])->validate();

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        dispatch(new ForgotPasswordJob($request->email, $token));

        alert()->success('Mantap', 'Silahkan cek email anda');
        return redirect('/forgot');
    }

    public function reset($token)
    {
        $tokenReset = $token;
        return view('auth.reset', compact('tokenReset'));
    }

    public function handleReset(Request $request, $token)
    {
        $check = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();
        if (!$check) {
            alert()->error('Oops', 'Mohon klik kembali button reset di email');
            return redirect('/');
        }

        $user = User::where('email', $check->email)->first();
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        alert()->success('Mantap', 'Password berhasil direset');
        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        alert()->success('Mantap', 'Anda berhasil logout');
        return redirect('/');
    }
}
