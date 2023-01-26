<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class VerifyEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Message after registration
     *
     * @return View
     */
    public function message(): View
    {
        return view('auth.verify-message');
    }

    /**
     * Account activation
     *
     * @param string $token
     * @param int $id
     * @return RedirectResponse
     */
    public function verify(string $token, int $id): RedirectResponse
    {
        // Delete users which didn't verify their emails
        $expire = Carbon::now()->subMinutes(60);
        User::whereNull('email_verified_at')->where('created_at', '<', $expire)->delete();

        // Find a user by id
        $user = User::find($id);
        if (!($user && md5($user->email . $user->name) === $token)) {
            return redirect()
                ->route('auth.create')
                ->withErrors('A verify link was outdated');
        }

        // If all checks were passed, then activate an account
        $user->update(['email_verified_at' => Carbon::now()]);

        return redirect()
            ->route('auth.login')
            ->with('success', 'You successfully verified your account');
    }
}
