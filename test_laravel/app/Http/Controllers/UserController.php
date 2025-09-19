<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Create/Register User
    public function create(User $user) {
        return view('users.register', [
            'user' => $user
        ]);
    }

    // Create User
    public function store(UserCreateRequest $request) {
        $formFields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email', // Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        // Login
        auth()->guard()->login($user);

        return redirect('/')
            ->with('message', 'User created successfully');
    }

    // Logout
    public function logout(Request $request) {
        auth()->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('massage', 'Logout successfully');
    }

    public function login() {
        return view('users.login');
    }

    // Authenticate
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')
                ->with('massage', 'Login successfully');
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->onlyInput('email');
    }
}
