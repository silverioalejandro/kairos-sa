<?php

namespace App\Providers;

use App\Models\Operator;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('token', function ($request) {
            if (is_null($request->bearerToken())) {
                return null;
            }

            $operator = Operator::where('api_token', $request->bearerToken())
                ->where('is_active', 1)
                ->latest()
                ->first();
            if (!$operator) {
                return null;
            }
            return $operator;
        });
    }
}
