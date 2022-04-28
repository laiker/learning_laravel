<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('layout.tagscloud', function($view){
            $view->with('tagsCloud', \App\Tag::tagsCloud());
        });

        \Blade::directive("showAdminEditLink", function($value){
            if(auth()->user()->isAdmin()){ 
                return "<?php echo \"<a href='/admin/posts/\".($value)->code.\"/edit'>Изменить статью из админ. панели</a>\"?>";
            }

        });
    }
}
