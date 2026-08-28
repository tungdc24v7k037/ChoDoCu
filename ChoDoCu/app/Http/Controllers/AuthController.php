<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function index(){
         return view('/main/login');
    }
    public function main(){
        return view('welcome');
    }
     public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()
            ->withErrors([
                'email' => 'Email hoặc mật khẩu không đúng.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function showRegister()
{
    return view('main.register');
}

public function register(Request $request)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:users,email',
        ],

        'password' => [
            'required',
            'string',
            'min:8',
            'max:32',
            'regex:/[A-Z]/',
            'regex:/[a-z]/',
            'regex:/[0-9]/',
            'confirmed',
        ],
    ], [
        'name.required' => 'Vui lòng nhập họ và tên.',

        'email.required' => 'Vui lòng nhập email.',
        'email.email' => 'Email không đúng định dạng.',
        'email.unique' => 'Email này đã được đăng ký.',

        'password.required' => 'Vui lòng nhập mật khẩu.',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        'password.max' => 'Mật khẩu tối đa 32 ký tự.',
        'password.regex' => 'Mật khẩu phải có chữ hoa, chữ thường và chữ số.',
        'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    Auth::login($user);

    $request->session()->regenerate();

    return redirect('/')
        ->with('success', 'Đăng ký tài khoản thành công!');
}
}