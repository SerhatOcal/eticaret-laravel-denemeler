@extends('yonetim.layouts.master')
@section('title', 'Kategori Yönetimi')
@section('content')
    <h2 class="page-header">Kategori Yönetimi</h2>
    <form action="{{ route('yonetim.kategori.kaydet', @$kategori->id) }}" method="post">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ @$kategori->id > 0 ? "Güncelle" : "Kaydet" }}
            </button>
        </div>
        <h4 class="sub-header">
            <br>
            Kategori {{ @$kategori->id > 0 ? "Düzenle" : 'Ekle' }}
        </h4>
        @include('layouts.include.errors')
        @include('layouts.include.alerts')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ust_kategori_id">Üst Kategori</label>
                    <select name="ust_kategori_id" id="ust_kategori_id" class="form-control">
                        <option value="">Ana Kategori</option>
                        @foreach($kategoriler as $row)
                            <option value="{{ $row->kategori_id }}"> {{ $row->kategori_adi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="kategori_adi">Kategori Adı</label>
                    <input type="text" class="form-control" name="kategori_adi" id="kategori_adi" placeholder="Kategori Adı" value="{{ old('kategori_adi', $kategori->kategori_adi) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="original_slug" value="{{ old('slug', $kategori->slug) }}">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ old('slug', $kategori->slug) }}">
                </div>
            </div>
        </div>
    </form>
@endsection
