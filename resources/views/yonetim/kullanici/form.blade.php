@extends('yonetim.layouts.master')
@section('title', 'Kullanici Yönetimi')
@section('content')
    <h2 class="page-header">Kullanıcı Yönetimi</h2>
    <form action="{{ route('yonetim.kullanici.kaydet', @$kullanici->id) }}" method="post">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ @$kullanici->id > 0 ? "Güncelle" : "Kaydet" }}
            </button>
        </div>
        <h4 class="sub-header">
            <br>
            Kullanıcı {{ @$kullanici->id > 0 ? "Düzenle" : 'Ekle' }}
        </h4>
        @include('layouts.include.errors')
        @include('layouts.include.alerts')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="adsoyad">Ad Soyad</label>
                    <input type="text" class="form-control" name="adsoyad" id="adsoyad" placeholder="Ad Soyad" value="{{ old('adsoyad', $kullanici->adsoyad) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email', $kullanici->email) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sifre">Şifre</label>
                    <input type="password" class="form-control" name="sifre" id="sifre" placeholder="Şifre">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="adres">Adres</label>
                    <input type="text" class="form-control" name="adres" id="adres" placeholder="Adres" value="{{ old('adres', $kullanici->detay->adres) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="telefon">Telefon</label>
                    <input type="text" class="form-control" name="telefon" id="telefon" placeholder="Telefon" value="{{ old('telefon', $kullanici->detay->telefon) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ceptelefonu">Cep Telefon</label>
                    <input type="text" class="form-control" name="ceptelefonu" id="ceptelefonu" placeholder="Cep Telefon" value="{{ old('ceptelefonu', $kullanici->detay->ceptelefonu) }}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="aktif_mi" value="0">
                <input type="checkbox" name="aktif_mi" value="1" {{ old('aktif_mi', $kullanici->aktif_mi) ? 'checked' : '' }}> Aktif mi ?
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="yonetici_mi" value="0">
                <input type="checkbox" name="yonetici_mi" value="1" {{ old('yonetici_mi', $kullanici->yonetici_mi) ? 'checked' : '' }}> Yönetici mi ?
            </label>
        </div>
    </form>
@endsection
