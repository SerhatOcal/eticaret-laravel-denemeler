@extends('yonetim.layouts.master')
@section('title', 'Ürün Yönetimi')
@section('content')
    <h2 class="page-header">Ürün Yönetimi</h2>
    <form action="{{ route('yonetim.urun.kaydet', @$urun->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ @$urun->id > 0 ? "Güncelle" : "Kaydet" }}
            </button>
        </div>
        <h4 class="sub-header">
            <br>
            Ürün {{ @$urun->id > 0 ? "Düzenle" : 'Ekle' }}
        </h4>
        @include('layouts.include.errors')
        @include('layouts.include.alerts')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="urun_adi">Ürün Adı</label>
                    <input type="text" class="form-control" name="urun_adi" id="urun_adi" placeholder="Ürün Adı" value="{{ old('urun_adi', $urun->urun_adi) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="original_slug" value="{{ old('slug', $urun->slug) }}">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ old('slug', $urun->slug) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="aciklama">Açıklama</label>
                    <textarea class="form-control" id="aciklama" name="aciklama" cols="30" rows="10" placeholder="Açıklama">
                        {{ old('urun_adi', $urun->urun_adi) }}
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fiyat">Fiyatı</label>
                    <input type="text" class="form-control" name="fiyat" id="fiyat" placeholder="Ürün Fiyatı" value="{{ old('fiyat', $urun->fiyat) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kategoriler">Kategoriler</label>
                    <select name="kategoriler[]" class="form-control" id="kategoriler" multiple>
                        @foreach($kategoriler as $kategori)
                            <option value="{{ $kategori->id }}" {{ collect(old('kategoriler', $urun_kategorileri))->contains($kategori->id) ? 'selected' : '' }}>{{ $kategori->kategori_adi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="goster_slider" value="0">
                <input type="checkbox" name="goster_slider" value="1" {{ old('goster_slider', $urun->detay->goster_slider) ? 'checked' : '' }}> Slider'da Göster
            </label>
            <label>
                <input type="hidden" name="goster_gunun_firsati" value="0">
                <input type="checkbox" name="goster_gunun_firsati" value="1" {{ old('goster_gunun_firsati', $urun->detay->goster_gunun_firsati) ? 'checked' : '' }}> Günün Fırsatında Göster
            </label>
            <label>
                <input type="hidden" name="goster_one_cikan" value="0">
                <input type="checkbox" name="goster_one_cikan" value="1" {{ old('goster_one_cikan', $urun->detay->goster_one_cikan) ? 'checked' : '' }}> Öne Çıkan'da Göster
            </label>
            <label>
                <input type="hidden" name="goster_cok_satan" value="0">
                <input type="checkbox" name="goster_cok_satan" value="1" {{ old('goster_cok_satan', $urun->detay->goster_cok_satan) ? 'checked' : '' }}> Çok Satan'da Göster
            </label>
            <label>
                <input type="hidden" name="goster_indirimli" value="0">
                <input type="checkbox" name="goster_indirimli" value="1" {{ old('goster_indirimli', $urun->detay->indirimli) ? 'checked' : '' }}> İndirimli Ürünler'de Göster
            </label>
        </div>
        <div class="form-group">
            @if ($urun->detay->urun_resmi !=  null)
                <img src="/uploads/urunler/{{ $urun->detay->urun_resmi }}" alt="{{ $urun->urun_adi }}" style="height: 100px; margin-right: 20px;" class="thumbnail pull-left">
            @endif
            <label for="urun_resmi">Ürün Resmi</label>
            <input type="file" name="urun_resmi" id="urun_resmi">
        </div>

    </form>
@endsection
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        $(function () {
            $('#kategoriler').select2({
                placeholder: "Kategori Seçiniz"
            });

            var options = {
                uiColor: '#f4645f',
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            }

            CKEDITOR.replace('aciklama', options);
        });
    </script>
@endsection
