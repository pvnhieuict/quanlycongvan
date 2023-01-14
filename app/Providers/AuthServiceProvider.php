<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Documentout;
use App\Models\Permission;
use App\Policies\DocumentoutPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        // <option value="0">Người dùng thường</option>
        // <option value="1">Văn thư</option>
        // <option value="2">Lãnh đạo</option>
        // <option value="3">Quản trị hệ thống</option>

        $this->registerPolicies();

        Gate::define('nguoidungthuong', function ($user) {
            return $user->role == 0;
        });

        Gate::define('vanthu', function ($user) {
            return $user->role == 1;
        });

        Gate::define('lanhdao', function ($user) {
            return $user->role == 2;
        });

       Gate::define('quantrihethong',function($user)
        {
           return $user->role==3;
        });
    }
}
