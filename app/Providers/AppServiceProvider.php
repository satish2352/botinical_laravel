<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\
{
EmployeesModel,User
}; // Replace YourModel with the actual model you are using

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
        view()->composer('*', function ($view) {
        
            $dashboard=EmployeesModel::where('email',session()->get('u_email'))->get();
            // dd($dashboard,session()->all());
            $view->with('dashboard', $dashboard);
        });
    }
}
