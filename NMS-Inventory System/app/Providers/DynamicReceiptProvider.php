<?php
namespace App\Providers;
use App\receipt; // write model name here 
use Illuminate\Support\ServiceProvider;
class DynamicReceiptProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('receipt', receipt::all());
        });
    }
}
