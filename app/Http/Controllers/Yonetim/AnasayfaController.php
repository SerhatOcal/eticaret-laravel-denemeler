<?php

namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnasayfaController extends Controller
{
    public function index()
    {
        $cok_satan_urunler = DB::select("
            SELECT
                 u.urun_adi,
                 SUM(su.adet) AS adet
            FROM siparis AS si
            INNER JOIN sepet AS s ON s.id = si.sepet_id
            INNER JOIN sepet_urun AS su ON s.id = su.sepet_id
            INNER JOIN urun AS u ON u.id = su.urun_id
            GROUP BY u.urun_adi
            ORDER BY SUM(su.adet) DESC 
        ");

        $aylara_gore_satislar = DB::select("
            SELECT
                DATE_FORMAT(si.olusturulma_tarihi, '%Y-%m') AS ay,
                SUM(su.adet) AS adet
            FROM siparis AS si
            INNER JOIN sepet AS s ON s.id = si.sepet_id
            INNER JOIN sepet_urun AS su ON s.id = su.sepet_id
            GROUP BY DATE_FORMAT(si.olusturulma_tarihi, '%Y-%m')
            ORDER BY DATE_FORMAT(si.olusturulma_tarihi, '%Y-%m') 
        ");
        return view('yonetim.anasayfa', compact('cok_satan_urunler', 'aylara_gore_satislar'));
    }
}
