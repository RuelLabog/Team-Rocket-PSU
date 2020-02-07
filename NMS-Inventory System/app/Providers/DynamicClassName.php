<?php
namespace App\Providers;
use App\category;
use Illuminate\Support\ServiceProvider;

class DynamicClassName extends ServiceProvider{
    public function boot(){
        view()->composer('*', function($view){
            $view->with('category', category::all());
        });
    }
}
?>