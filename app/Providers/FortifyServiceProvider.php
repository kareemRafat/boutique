<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
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
        if(isAdminRoute()) {

            config([

                'fortify.guard' => 'admin',

                'fortify.prefix' => 'admin',

                'fortify.home' => 'admin/'

            ]);

        }

        // login Response
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {

            public function toResponse($request)
            {

                // return isAdminRoute() ?  redirect('/admin') : redirect('/home');
                return isAdminRoute() ?  redirect('/admin') : abort(404);

            }

        });

        // logout Response
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {

            public function toResponse($request)
            {

                // return isAdminRoute() ?  redirect('/admin/login') : redirect('/login');
                return isAdminRoute() ?  redirect('/admin/login') : abort(404);

            }
        });
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

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


        // customize login view
        Fortify::loginView(function () {

            // return isAdminRoute() ?  view('admin.auth.login') : view('auth-users.login');
            return isAdminRoute() ?  view('admin.auth.login') : abort(404) ;

        });

        // customize register view
        Fortify::registerView(function () {

            // return isAdminRoute() ?  view('admin.auth.register') : view('auth-users.register');
            return isAdminRoute() ?  view('admin.auth.register') : abort(404);

        });
    }
}
