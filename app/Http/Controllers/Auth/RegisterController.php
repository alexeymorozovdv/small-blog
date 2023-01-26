<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Registration form
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Create a user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Send a verify email
        $token = str_replace('=', '', md5($user->email . $user->name));
        $link = route('auth.verify-email', ['token' => $token, 'id' => $user->id]);
        Mail::send(
            'email.verify-email',
            ['link' => $link],
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Verify email');
            }
        );

        return redirect()->route('auth.verify-message');
    }
}
