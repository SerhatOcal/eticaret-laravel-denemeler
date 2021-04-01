@extends('yonetim.layouts.master')
@section('title', 'Ürün Yönetimi')
@section('content')
    <h2 class="page-header">Ürün Yönetimi</h2>
    <h4 class="sub-header"> Ürün Listesi </h4>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{ route('yonetim.urun.yeni') }}" type="button" class="btn btn-primary">Yeni</a>
        </div>
        <form action="{{ route('yonetim.urun') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" class="form-control form-control-sm" name="aranan" id="aranan" placeholder="Ürün Ara..." value="{{ old('aranan') }}">
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
            <a href="{{ route('yonetim.urun') }}" class="btn btn-primary">Temizle</a>
        </form>
    </div>
    @include('layouts.include.alerts')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Resim</th>
                <th>Slug</th>
                <th>Ürün Adı</th>
                <th>Fiyatı</th>
                <th>Kayıt Tarihi</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @if (count($urunler) == 0)
                <tr>
                    <td colspan="7"> Kayıt Bulunamadı</td>
                </tr>
            @endif
            @foreach($urunler as $urun)
            <tr>
                <td>{{ $urun->id }}</td>
                <td>
                    <img src="{{ $urun->detay->urun_resmi != null ? asset('/uploads/urunler/' . $urun->detay->urun_resmi) : 'https://via.placeholder.com/50x50' }}" class="img-responsive" style="width: 50px;">
                </td>
                <td>{{ $urun->slug }}</td>
                <td>{{ $urun->urun_adi }}</td>
                <td>{{ $urun->fiyat }}</td>
                <td>{{ $urun->olusturulma_tarihi }}</td>
                <td style="width: 100px">
                    <a href="{{ route('yonetim.urun.duzenle', $urun->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{ route('yonetim.urun.sil', $urun->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misiniz ?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $urunler->links() }}
    </div>
@endsection
