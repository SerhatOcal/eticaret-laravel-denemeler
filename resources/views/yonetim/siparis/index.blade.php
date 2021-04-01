@extends('yonetim.layouts.master')
@section('title', 'Sipariş Yönetimi')
@section('content')
    <h2 class="page-header">Sipariş Yönetimi</h2>
    <h4 class="sub-header"> Sipariş Listesi </h4>
    <div class="well">
        <form action="{{ route('yonetim.siparis') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" class="form-control form-control-sm" name="aranan" id="aranan" placeholder="Sipariş Ara..." value="{{ old('aranan') }}">
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
            <a href="{{ route('yonetim.siparis') }}" class="btn btn-primary">Temizle</a>
        </form>
    </div>
    @include('layouts.include.alerts')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Sipariş Kodu</th>
                <th>Kullanıcı</th>
                <th>Tutar</th>
                <th>Durum</th>
                <th>Sipariş Tarihi</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @if (count($siparisler) == 0)
                <tr>
                    <td colspan="7"> Kayıt Bulunamadı</td>
                </tr>
            @endif
            @foreach($siparisler as $siparis)
            <tr>
                <td>SP-{{ $siparis->id }}</td>
                <td>{{ $siparis->sepet->kullanici->adsoyad }}</td>
                <td>{{ $siparis->siparis_tutari * ((100 + config('cart.tax')) / 100) }} ₺</td>
                <td>{{ $siparis->durum }}</td>
                <td>{{ $siparis->olusturulma_tarihi }}</td>
                <td style="width: 100px">
                    <a href="{{ route('yonetim.siparis.duzenle', $siparis->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{ route('yonetim.siparis.sil', $siparis->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misiniz ?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $siparisler->links() }}
    </div>
@endsection
