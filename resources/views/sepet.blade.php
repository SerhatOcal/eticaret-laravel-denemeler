@extends('layouts.master')
@section('title','Sepet')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.include.alerts')
            @if(Count(Cart::content()) > 0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Adet Fiyatı</th>
                    <th>Adet</th>
                    <th class="text-right">Tutar</th>
                </tr>
            @foreach(Cart::content() as $urunCartItem)
                <tr>
                    <td style="width: 120px">
                            <img src="https://via.placeholder.com/120x100">
                    <td>
                        {{ $urunCartItem->name }}
                        <form action="{{ route('sepet.kaldir', $urunCartItem->rowId) }}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="submit" class="btn btn-danger" value="Sepeten Kaldır">
                        </form>
                    </td>
                    <td>{{ $urunCartItem->price }} ₺</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default urun-adet-azalt" data-id="{{ $urunCartItem->rowId }}" data-adet="{{$urunCartItem->qty-1}}">-</a>
                        <span style="padding: 20px 10px;">{{ $urunCartItem->qty }}</span>
                        <a href="#" class="btn btn-xs btn-default urun-adet-artir" data-id="{{ $urunCartItem->rowId }}" data-adet="{{$urunCartItem->qty+1}}">+</a>
                    </td>
                    <td class="text-right"> {{ $urunCartItem->subtotal }} ₺</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar (KDV Dahil)</th>
                    <th class="text-right">{{ Cart::subtotal() }} ₺</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <th class="text-right">{{ Cart::tax() }} ₺</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Genel Toplam</th>
                    <th class="text-right">{{ Cart::total() }} ₺</th>
                </tr>
            </table>
            <div>
                <form action="{{ route('sepet.bosalt', $urunCartItem->rowId) }}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input type="submit" class="btn btn-info" value="Sepeti Boşalt">
                </form>
                <a href="{{ route('odeme') }}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
            @else
                <p>Sepetinizde Ürün Yok</p>
            @endif
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(function () {
            $(".urun-adet-azalt, .urun-adet-artir").on('click', function () {
                var id = $(this).attr('data-id');
                var adet = $(this).attr('data-adet');
                $.ajax({
                    type:'PATCH',
                    url: '{{ url('sepet/guncelle') }}/' + id,
                    data:{adet:adet},
                    success: function (result) {
                        if (result.success == true){
                            window.location.href='{{ route('sepet') }}';
                        } else{
                            window.location.href='{{ route('sepet') }}';
                        }
                    }
                });
            });

        });
    </script>
@endsection

