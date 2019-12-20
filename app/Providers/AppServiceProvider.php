<?php

namespace App\Providers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

session_start();

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
        $listSort = [
            'Rate : High to low' => '1',
            'Rate : Low to high' => '2',
            'Price : High to low' => '3',
            'Price : Low to high' => 4
        ];
        $listPerPage = [
            'Show 12' => '12',
            'Show 16' => '16',
            'Show 20' => '20'
        ];

        if (!Redis::get('list_sort')) {
            Redis::set('list_sort', json_encode($listSort));
        }

        if (!Redis::get('list_per_page')) {
            Redis::set('list_per_page', json_encode($listPerPage));
        }
    }
}
