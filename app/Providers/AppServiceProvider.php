<?php

namespace App\Providers;

use App\Http\Controllers\Helper\AuthApi;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // can permission directive
//        Blade::if('can', function ($module , $operation) {
//
//            $module  = explode("." , $module);
//            $user = session()->get('user');
//
//            if(isset($user->subrole->permissions)){
//                $permissions  = json_decode($user->subrole->permissions);
//
//            }
//            else{
//                $permissions = [];
//            }
//
//            // dd($permissions);
//
//            // $permission =
//            $counter = 0;
//            foreach($module as $m){
//                if($counter == 0){
//                    if(isset($permissions->{$m})){
//
//                        $permissions = $permissions->{$m};
//                        // dd($permissions);
//                    }
//                    else{
//                        // dd( "Module ($m) does not exist");
//                        return false;
//                    }
//                }
//                else{
//                    if(isset($permissions->childs->{$m})){
//
//                        $permissions = $permissions->childs->{$m};
//                    }
//                    else{
//                        // dd( "Module ($m) does not exist");
//                        return false;
//
//                    }
//                }
//
//                $counter = $counter +1;
//
//            }
//
//            $module = $permissions;
//
//            if(isset($module)){
//
//                if(in_array($operation , $module->operations)){
//                    return true;
//                }
//                else{
//
//                    return false;
//                }
//            }else{
//                dd( "Module does not exit");
//            }
//
//        });
        Blade::if('can', function ($module) {

            $user_role_permissions = session()->get('user_role_permissions');
            if(isset($module)){
                foreach ($user_role_permissions as $permission){
                    if ($permission->slug==$module){
                        return true;
                    }
                }
                return false;
            }else{
                return false;
            }
        });


        Blade::if('StoreOwner', function () {
            return AuthApi::hasStore();
        });


    }
}
