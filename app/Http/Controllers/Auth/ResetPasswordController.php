<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * New password form
     *
     * @param string $token
     * @param string $email
     * @return View
     */
    public function form(string $token, string $email): View
    {
        return view('auth.reset-password', compact('token', 'email'));
    }

    /**
     * Set a new password
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Deletes the old password
        $expire = Carbon::now()->subMinute(60);
        DB::table('password_resets')
            ->where('created_at', '<', $expire)
            ->delete();

        // Check password restoration link
        $row = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();

        // If the link expired return an error
        if (!$row) {
            return back()->withErrors('Password restoration link was expired');
        }

        // Set a new password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Deletes a password from password_resets table
        DB::table('password_resets')
            ->where(['email'=> $request->email])
            ->delete();

        return redirect()
            ->route('auth.login')
            ->with('success', 'Your password has been successfully changed');
    }
}
