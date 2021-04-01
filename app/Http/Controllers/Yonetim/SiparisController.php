<?php

namespace App\Http\Controllers\Yonetim;


use App\Models\Siparis;
use App\Http\Controllers\Controller;

class SiparisController extends Controller
{
    public function index()
    {
        if (request()->filled('aranan')){
            request()->flash();
            $aranan = request('aranan');
            $siparisler = Siparis::with('sepet.kullanici')
                ->where('adsoyad', 'like', "%$aranan%")
                ->orWhere('id', $aranan)
                ->orderByDesc('id')
                ->paginate(8)
                ->appends('aranan', $aranan);
        } else {
            $siparisler = Siparis::with('sepet.kullanici')->orderByDesc('id')->paginate(8);
        }

        return view('yonetim.siparis.index', compact('siparisler'));
    }

    public function form($id = 0)
    {
        if ($id > 0) {
            $siparis = Siparis::with('sepet.sepet_urunler.urun')->find($id);
        }
        return view('yonetim.siparis.form', compact('siparis'));
    }

    public function kaydet($id = 0)
    {
        $this->validate(request(), [
            'adsoyad'   => 'required',
            'adres'     => 'required',
            'telefon'   => 'required'
        ]);

        $data = request()->only('adsoyad', 'adres', 'telefon', 'ceptelefonu','durum');

        if ($id > 0) {
            $siparis = Siparis::where('id', $id)->firstOrFail();
            $siparis->update($data);
        }

        return redirect()->route('yonetim.siparis.duzenle', $siparis->id)
            ->with('mesaj_tur', 'success')
            ->with('mesaj', 'Güncellendi');
    }

    public function sil($id)
    {
        Siparis::destroy($id);

        return redirect()->route('yonetim.siparis')
            ->with('mesaj_tur', 'success' )
            ->with('mesaj', 'Kayıt Silindi');
    }
}
