<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function hash_check($user, $request)
    {
        if (! hash_equals((string) $request->route('hash'),
                          sha1($user->getEmailForVerification()))) {
            return false;
        }

        return true;
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $user = User::find($request->route('id'));

        if (! $user || ! $this->hash_check($user, $request)) {
            abort(403);
        }

        Auth::login($user);

        $required_role = $user->roles->pluck('name')[0];

        if ($user->hasVerifiedEmail()) {
            return redirect($required_role . RouteServiceProvider::HOME . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect($required_role . RouteServiceProvider::HOME . '?verified=1');
    }
}
