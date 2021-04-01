<?php

namespace App\Http\Controllers\Yonetim;

use App\Models\Kategori;
use App\Models\Kullanici;
use App\Models\KullaniciDetay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KategoriController extends Controller
{
    public function index()
    {
        if (request()->filled('aranan') || request()->filled('ust_kategori_id')) {
            request()->flash();
            $aranan          = request('aranan');
            $ust_kategori_id = request('ust_kategori_id');
            $kategoriler     = Kategori::with('ust_kategori')
                ->where('kategori_adi', 'like', "%$aranan%")
                ->where('ust_kategori_id', $ust_kategori_id)
                ->orderByDesc('id')
                ->paginate(8)
                ->appends(['aranan' => $aranan, 'ust_kategori_id' => $ust_kategori_id]);
        } else {
            request()->flash();
            $kategoriler = Kategori::with('ust_kategori')->orderByDesc('id')->paginate(8);
        }

        $anakategoriler = Kategori::whereRaw('ust_kategori_id is null')->get();

        return view('yonetim.kategori.index', compact('kategoriler', 'anakategoriler'));
    }

    public function form($id = 0)
    {
        $kategori = new Kategori;
        if ($id > 0) {
            $kategori = Kategori::find($id);
        }

        $kategoriler = Kategori::all();

        return view('yonetim.kategori.form', compact('kategori', 'kategoriler'));
    }

    public function kaydet($id = 0)
    {
        $data = request()->only('kategori_adi', 'slug', 'kategori_ust_id');
        if (!request()->filled('slug')) {
            $data['slug'] = str_slug(request('kategori_adi'));
            request()->merge(['slug' => $data['slug']]);
        }

        $this->validate(request(), [
            'kategori_adi' => 'required',
            'slug' => (request('original_slug') != request('slug') ? 'unique:kategori,slug' : '')
        ]);

        if ($id > 0) {
            $kategori = Kategori::where('id', $id)->firstOrFail();
            $kategori->update($data);
        } else {
            $kategori = Kategori::create($data);
        }

        return redirect()->route('yonetim.kategori.duzenle', $kategori->id)
            ->with('mesaj_tur', 'success')
            ->with('mesaj', ($id > 0 ? 'Güncellendi' : 'Kaydedildi'));
    }

    public function sil($id)
    {
        $kategori = Kategori::find($id);
        $kategori->urunler()->detach();
        $kategori->delete();

        return redirect()->route('yonetim.kategori')
            ->with('mesaj_tur', 'success')
            ->with('mesaj', 'Kayıt Silindi');
    }

}
