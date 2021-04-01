<?php

namespace App\Providers;

use App\Models\Kullanici;
use App\Models\Siparis;
use App\Models\Urun;
use App\Models\Ayar;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
        /*
            $bitisZamanı = now()->addMinutes(10);
            $istatistikler = Cache::remember('istatistikler', $bitisZamanı, function () {
                return [
                    'bekleyen_siparis' => Siparis::where('durum', 'Siparişiniz Alındı')->count(),
                ];
            });
    
            View::share('istatistikler', $istatistikler);
        */
        View::composer(['yonetim.*'], function($view){

            $bitisZamanı = now()->addMinutes(10);
            $istatistikler = Cache::remember('istatistikler', $bitisZamanı, function () {
                return [
                    'bekleyen_siparis'      => Siparis::where('durum', 'Siparişiniz Alındı')->count(),
                    'tamamlanan_siparis'    => Siparis::where('durum', 'Sipariş Tamamlandı')->count(),
                    'toplam_urun'           => Urun::count(),
                    'toplam_kullanici'      => Kullanici::count()
                ];
            });

            View::share('istatistikler', $istatistikler);
        });

        foreach (Ayar::all() as $ayar){
            Config::set('ayar'. $ayar->anahtar, $ayar->deger);
        }
        
    }
}


