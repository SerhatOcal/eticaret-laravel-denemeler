@extends('yonetim.layouts.master')
@section('title', 'Kategori Yönetimi')
@section('content')
    <h2 class="page-header">Kategori Yönetimi</h2>
    <h4 class="sub-header"> Kategori Listesi </h4>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{ route('yonetim.kategori.yeni') }}" type="button" class="btn btn-primary">Yeni</a>
        </div>
        <form action="{{ route('yonetim.kategori') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" class="form-control form-control-sm" name="aranan" id="aranan" placeholder="Kategori Ara..." value="{{ old('aranan') }}">
                <label for="ust_kategori_id">Üst Kategori</label>
                <select name="ust_kategori_id" id="ust_kategori_id" class="form-control">
                    <option value="">Seçiniz</option>
                    @foreach($anakategoriler as $row)
                        <option value="{{ $row->id }}" {{ old('ust_kategori_id') == $row->id ? 'selected' : '' }}> {{ $row->kategori_adi }}</option>
                    @endforeach
                </select>

            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
            <a href="{{ route('yonetim.kategori') }}" class="btn btn-primary">Temizle</a>
        </form>
    </div>
    @include('layouts.include.alerts')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Üst Kategori</th>
                <th>Slug</th>
                <th>Kategori Adı</th>
                <th>Kayıt Tarihi</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @if (count($kategoriler) == 0)
                <tr>
                    <td colspan="6"> Kayıt Bulunamadı</td>
                </tr>
            @endif
            @foreach($kategoriler as $kategori)
            <tr>
                <td>{{ $kategori->id }}</td>
                <td>{{ $kategori->ust_kategori->kategori_adi }}</td>
                <td>{{ $kategori->slug }}</td>
                <td>{{ $kategori->kategori_adi }}</td>
                <td>{{ $kategori->olusturulma_tarihi }}</td>
                <td style="width: 100px">
                    <a href="{{ route('yonetim.kategori.duzenle', $kategori->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{ route('yonetim.kategori.sil', $kategori->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misiniz ?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $kategoriler->links() }}
    </div>
@endsection
