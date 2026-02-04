<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // ✅ FIX

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirect after registration
     */
    protected $redirectTo = '/candidate/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validate registration data
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create user
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'candidate', // ✅ default role
        ]);
    }

    /**
     * After successful registration
     */
    protected function registered(Request $request, $user)
    {
        return redirect()->route('candidate.dashboard');
    }
}
