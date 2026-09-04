<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->with(['prompt' => 'select_account consent'])->redirect();
    }

    public function handleGoogle()
    {
        $googleUser = Socialite::driver('google')->user();

        $customerRole = Role::query()
            ->where('name', 'customer')
            ->where('guard_name', 'web')
            ->first();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt(Str::random(32)),
                'email_verified_at' => now(),
                'role_id' => $customerRole->id,
            ]
        );

        $user->syncRoles(['customer']);

        Auth::login($user);

        // Check if there's a redirect URL stored in session
        if (session()->has('url.intended')) {
            $redirectUrl = session()->get('url.intended');
            session()->forget('url.intended');
            return redirect()->to($redirectUrl);
        }

        // Check if there's a redirect_after_login in sessionStorage (passed via session)
        if (session()->has('redirect_after_login')) {
            $redirectUrl = session()->get('redirect_after_login');
            session()->forget('redirect_after_login');
            return redirect()->to($redirectUrl);
        }

        return redirect()->route('customer.dashboard');
    }
}
