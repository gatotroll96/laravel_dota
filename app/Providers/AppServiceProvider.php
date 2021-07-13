<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use DB;
use Session;
use App\Http\View\Composers\ProfileComposer;
use Illuminate\Http\Request;

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
        
        View::composer('home.layout.header', function ($view) {
            $category   = DB::table('category')
                            ->select('id', 'name', 'tenkdau')
                            ->where('id' ,'>' , 0)
                            ->get();
                //->select('post.name','post.id','post.tenkdau','post.images','category.name as category')
                           
                
                
                    
            $view->with('category',$category);
            
        });
    }
}
