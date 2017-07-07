<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use App\Tahun;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        //
        $default_url = '';
        View::share('default_url', $default_url);

        $tahun = array();
        $list_tahun = Tahun::get();
        foreach ($list_tahun as $row) {
          $tahun[]=$row->tahun;
        }

        //$tahun = ['2010','2011','2012','2013','2014','2015','2016','2017','2018','2019','2020'];
        View::share('tahun', $tahun);

        $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','Oktober','Nopember','Desember'];
        View::share('bulan', $bulan);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
