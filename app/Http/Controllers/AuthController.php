<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        Log::info('This is an information message.');

        try {
            $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'role' => ['required', 'string', 'in:student,faculty,admin'],
                'profile_picture_preview' => ['image', 'max:2048'] 
            ]);

            if ($request->hasFile('profile_picture_preview')) 
            {
                $profilePicPath = $request->file('profile_picture_preview')->store('public/profile_pictures');
                $profilePicUrl = Storage::url($profilePicPath);
                Log::info('Coming inside has file'); 
            } else {
                $profilePicUrl = 'profile_pictures/upload.png';
                Log::info('Coming inside not has file'); 
            }

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'profile_picture' => $profilePicUrl
            ]);

            Log::info('User registered successfully.', ['user_id' => $user->id]);            
            auth()->login($user);

            session(['role' => $request->role]);
            session(['username' => $request->username]);

            return "true";
        } catch (\Exception $e) {
            Log::error('User registration failed: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Registration failed. Please try again later.']);
        }
    }

    /**
     * Log in an existing user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            session(['id' => $user->id]);
            session(['role' => $user->role]);
            session(['profilePicUrl' => $user->profile_picture]);
            session(['username' => $user->username]);
            Log::info('User logged in.');

            return "true";
        }
        else{
            Log::info('User logged in failed.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\Http\Response
     */

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
