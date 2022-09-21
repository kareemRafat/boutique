<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\VerifyEmailResponse;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (isAdminRoute()) {

            config([

                'fortify.guard' => 'admin',

                'fortify.prefix' => 'admin',

                'fortify.home' => 'admin/',

                'fortify.passwords' => 'admins'

            ]);
        }

        // Customizing view responses
        return $this->viewResoponses();

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Customizing admin Authentication to check is admin veririfed
        $this->authenticateAdmin();

        // customize login view (private methods)
        $this->adminLogin();

        // customize register view (private methods)
        $this->adminRegister();

        // customize forgot password view (private methods)
        $this->adminForgotPassword();

        // customize password reset view (private methods)
        $this->adminPasswordReset();

        // customize email verification view (private methods)
        $this->adminEmailVerification();

        // customize password confirmation view (private methods)
        $this->adminPasswordConfirmation();

        // customize two-factor challenge view (private methods)
        $this->adminTwoFactorChallenge();
    }

    /**
     *  Customizing view responses
     *
     */
    private function viewResoponses()
    {
        // login Response
        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {
                // return isAdminRoute() ?  redirect('/admin') : redirect('/home');
                return isAdminRoute() ?  redirect('/admin') : abort(404);
            }
        });

        // logout Response
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse
        {
            public function toResponse($request)
            {
                // return isAdminRoute() ?  redirect('/admin/login') : redirect('/login');
                return isAdminRoute() ?  redirect('/admin/login') : abort(404);
            }
        });

        // VerifyEmailResponse
        $this->app->instance(VerifyEmailResponse::class, new class implements VerifyEmailResponse
        {
            public function toResponse($request)
            {
                // if admin verifiy it`s email don`t login to the site
                // because admin wain to owner verification
                if(isAdminRoute()){

                    Auth::logout();

                    $request->session()->invalidate();

                    $request->session()->regenerateToken();

                    return redirect('/admin/login')
                        ->with('status' , 'email verified and waiting admin approval');

                } else {

                    // return redirect('/login');

                    abort(404);

                }
            }
        });
    }

    /**
     *  Customizing User Authentication to check is admin veririfed
     *  login logic modification
     *
     * @return admin
     */
    private function authenticateAdmin()
    {
        Fortify::authenticateUsing(function (Request $request) {
            $admin = Admin::where('email', $request->email)->first();

            if ($admin) {
                if (!Hash::check($request->password, $admin->password)) {
                    throw ValidationException::withMessages([
                        Fortify::username() => "These credentials do not match our records."
                    ]);
                } elseif (!$admin->verified) {
                    throw ValidationException::withMessages([
                        Fortify::username() => "user is not verified yet . Please contact back the owner.",
                    ]);
                }

                if(!$admin->hasVerifiedEmail()){
                    // send verification email if admin not email verified yet
                    $admin->sendEmailVerificationNotification();
                }

                return $admin;
            }
        });
    }

    /**
     * customize login view
     *
     * @return view
     */
    private function adminLogin()
    {
        Fortify::loginView(function () {
            // return isAdminRoute() ?  view('admin.auth.login') : view('auth-users.login');
            return isAdminRoute()
                ?  view('admin.auth.login')
                : abort(404);
        });
    }

    /**
     * customize register view
     *
     * @return view
     */
    private function adminRegister()
    {
        Fortify::registerView(function () {
            // return isAdminRoute() ?  view('admin.auth.register') : view('auth-users.register');
            return isAdminRoute()
                ?  view('admin.auth.register')
                : abort(404);
        });
    }

    /**
     * customize forgot password view
     *
     * @return view
     */
    private function adminForgotPassword()
    {
        Fortify::requestPasswordResetLinkView(function () {
            return isAdminRoute()
                ?  view('admin.auth.passwords.forgot-password')
                : abort(404);
        });
    }

    /**
     * customize password reset view
     *
     * @return view
     */
    private function adminPasswordReset()
    {
        Fortify::resetPasswordView(function ($request) {
            return isAdminRoute()
                ?  view('admin.auth.passwords.reset-password', ['request' => $request])
                : abort(404);
        });
    }

    /**
     * customize password confirmation view
     * use middleware('password.confirm') in products controller
     * @return view
     */
    private function adminPasswordConfirmation()
    {
        Fortify::confirmPasswordView(function () {
            return isAdminRoute()
                ?  view('admin.auth.passwords.confirm-password')
                : abort(404);
        });
    }

    /**
     * customize email verification view
     *
     * @return view
     */
    private function adminEmailVerification()
    {
        Fortify::verifyEmailView(function () {
            return isAdminRoute()
                ?  view('admin.auth.verify-email')
                : abort(404);
        });
    }

    /**
     * customize two-factor challenge view
     *
     * @return view
     */
    private function adminTwoFactorChallenge()
    {
        Fortify::twoFactorChallengeView(function () {
            return isAdminRoute()
                ?  view('admin.auth.two-factor-challenge')
                : abort(404);
        });
    }
}
