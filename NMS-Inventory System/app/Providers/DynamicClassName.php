<?php
namespace App\Providers;
use App\item;
use Illuminate\Support\ServiceProvider;

class DynamicClassName extends ServiceProvider{
    public function boot(){
        view()->composer('*', function($view){
            $view->with('category', item::all());
        });
    }
}
?>