<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\SessionUser;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->userAdmin();
        $this->roleAdmin();
        $this->busesPermission();
        $this->servicePermission();
        //$this->ticketPermission();
        $this->cartypePermission();
        $this->newsPermission();
        //quản lý user

    }

    public function userAdmin(){
        Gate::define('list_user', function (SessionUser $user) {
            return $user->checkPermissionAccess('list_user');
        });
        Gate::define('add_user', function (SessionUser $user) {
            return $user->checkPermissionAccess('add_user');
        });
        Gate::define('update_user', function (SessionUser $user) {
            return $user->checkPermissionAccess('edit_user');
        });
        Gate::define('delete_user', function (SessionUser $user) {
            return $user->checkPermissionAccess('delete_user');
        });
    }

    public function roleAdmin(){
        Gate::define('list_role', function (SessionUser $user) {
            return $user->checkPermissionAccess('list_role');
        });
        Gate::define('add_role', function (SessionUser $user) {
            return $user->checkPermissionAccess('add_role');
        });
        Gate::define('update_role', function (SessionUser $user) {
            return $user->checkPermissionAccess('edit_role');
        });
        Gate::define('delete_role', function (SessionUser $user) {
            return $user->checkPermissionAccess('delete_role');
        });
    }

    public function busesPermission(){
        Gate::define('list_buses', function (SessionUser $user) {
            return $user->checkPermissionAccess('list_buses');
        });
        Gate::define('add_buses', function (SessionUser $user) {
            return $user->checkPermissionAccess('add_buses');
        });
        Gate::define('edit_buses', function (SessionUser $user) {
            return $user->checkPermissionAccess('edit_buses');
        });
        Gate::define('delete_buses', function (SessionUser $user) {
            return $user->checkPermissionAccess('delete_buses');
        });
    }
    public function carPermission(){
        Gate::define('list_car', function (SessionUser $user) {
            return $user->checkPermissionAccess('list_car');
        });
        Gate::define('add_car', function (SessionUser $user) {
            return $user->checkPermissionAccess('add_car');
        });
        Gate::define('edit_car', function (SessionUser $user) {
            return $user->checkPermissionAccess('edit_car');
        });
        Gate::define('delete_car', function (SessionUser $user) {
            return $user->checkPermissionAccess('delete_car');
        });
    }

    public function servicePermission(){
        Gate::define('list_service', function (SessionUser $user) {
            return $user->checkPermissionAccess('list_service');
        });
        Gate::define('add_service', function (SessionUser $user) {
            return $user->checkPermissionAccess('add_service');
        });
        Gate::define('edit_service', function (SessionUser $user) {
            return $user->checkPermissionAccess('edit_service');
        });
        Gate::define('delete_service', function (SessionUser $user) {
            return $user->checkPermissionAccess('delete_service');
        });
    }

    // public function ticketPermission(){
    //     Gate::define('list_ticket', function (SessionUser $user) {
    //         return $user->checkPermissionAccess('list_ticket');
    //     });
    //     Gate::define('add_ticket', function (SessionUser $user) {
    //         return $user->checkPermissionAccess('add_ticket');
    //     });
    //     Gate::define('update_ticket', function (SessionUser $user) {
    //         return $user->checkPermissionAccess('edit_ticket');
    //     });
    //     Gate::define('delete_ticket', function (SessionUser $user) {
    //         return $user->checkPermissionAccess('delete_ticket');
    //     });
    // }

    public function cartypePermission(){
        Gate::define('list_cartype', function (SessionUser $user) {
            return $user->checkPermissionAccess('list_cartype');
        });
        Gate::define('add_cartype', function (SessionUser $user) {
            return $user->checkPermissionAccess('add_cartype');
        });
        Gate::define('edit_cartype', function (SessionUser $user) {
            return $user->checkPermissionAccess('edit_cartype');
        });
        Gate::define('delete_cartype', function (SessionUser $user) {
            return $user->checkPermissionAccess('delete_cartype');
        });
    }

    public function newsPermission(){
        Gate::define('list_news', function (SessionUser $user) {
            return $user->checkPermissionAccess('list_news');
        });
        Gate::define('add_news', function (SessionUser $user) {
            return $user->checkPermissionAccess('add_news');
        });
        Gate::define('edit_news', function (SessionUser $user) {
            return $user->checkPermissionAccess('edit_news');
        });
        Gate::define('delete_news', function (SessionUser $user) {
            return $user->checkPermissionAccess('delete_news');
        });
    }
}
