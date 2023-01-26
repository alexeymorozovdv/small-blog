<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Email form
     *
     * @return View
     */
    public function form(): View
    {
        return view('auth.forgot');
    }

    /**
     * Send an email
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function mail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(60);
        DB::table('password_resets')->insert(
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        $link = route('auth.reset-form', ['token' => $token, 'email' => $request->email]);
        Mail::send(
            'email.reset-password',
            [
                'link' => $link
            ],
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Restore a password');
            }
        );

        return back()->with('success', 'The link for password recovery has been sent to the mail');
    }
}
