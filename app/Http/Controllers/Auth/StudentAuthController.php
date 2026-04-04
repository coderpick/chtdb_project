<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PortfolioSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login (web guard)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login using 'web' guard
        if (Auth::guard('web')->attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // Ensure user is a student
            if (Auth::user()->role !== 'student') {
                Auth::logout();

                return back()->withErrors(['email' => 'Unauthorized access.']);
            }

            return redirect()->intended(route('student.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput($request->only('email'));
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle registration (web)
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create user with student role
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);

        // Create empty related records
        $user->profile()->create();
        $user->training()->create();
        $user->career()->create();
        $user->socialLinks()->create();
        $user->portfolioSetting()->create([
            'slug' => $this->generateUniqueSlug($user->name),
        ]);

        // Log the user in
        Auth::guard('web')->login($user);

        return redirect()->route('student.dashboard')->with('success', 'Registration successful! Welcome.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }

    // Generate unique slug
    private function generateUniqueSlug($name, $id = null)
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        $query = PortfolioSetting::where('slug', $slug);
        if ($id) {
            $query->where('user_id', '!=', $id);
        }
        while ($query->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
            $query = PortfolioSetting::where('slug', $slug);
            if ($id) {
                $query->where('user_id', '!=', $id);
            }
        }

        return $slug;
    }
}
