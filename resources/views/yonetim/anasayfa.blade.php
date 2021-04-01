@extends('yonetim.layouts.master')
@section('title', 'Anasayfa')
@section('content')
    <h1 class="page-header">Kontrol Paneli</h1>
    <section class="row text-center placeholders">
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Bekleyen Sipariş</div>
                <div class="panel-body">
                    <h4>{{ $istatistikler['bekleyen_siparis'] }}</h4>
                    <p>Adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Tamamlanan Siparis</div>
                <div class="panel-body">
                    <h4>{{ $istatistikler['tamamlanan_siparis'] }}</h4>
                    <p>Adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Ürün</div>
                <div class="panel-body">
                    <h4>{{ $istatistikler['toplam_urun'] }}</h4>
                    <p>Adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Kullanıcı</div>
                <div class="panel-body">
                    <h4>{{ $istatistikler['toplam_kullanici'] }}</h4>
                    <p>Kişi</p>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <canvas id="chartCokSatan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Aylara Göre Satışlar</div>
                <div class="panel-body">
                    <canvas id="chartAylaraGoreSatislar"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.bundle.min.js"></script>
    <script>
        @php
            $labels = "";
            $data = "";
            foreach ($cok_satan_urunler as $rapor){
                $labels.= "\"$rapor->urun_adi\", ";
                $data.= "$rapor->adet, ";

            }
        @endphp
        var ctx = document.getElementById('chartCokSatan').getContext('2d');
        var chartCokSatan = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [{!! $labels !!}],
                datasets: [{
                    label: 'Çok Satan Ürünler',
                    data: [{!! $data !!}],
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                }]
            },
            options: {
                legend:{
                    position:'bottom',
                    display:false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize:1
                        }
                    }]
                }
            }
        });

        @php
            $labels = "";
            $data = "";
            foreach ($aylara_gore_satislar as $rapor){
                $labels.= "\"$rapor->ay\", ";
                $data.= "$rapor->adet, ";

            }
        @endphp
        var ctx2 = document.getElementById('chartAylaraGoreSatislar').getContext('2d');
        var chartAylaraGoreSatislar = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [{!! $labels !!}],
                datasets: [{
                    label: 'Aylara Göre Satışlar',
                    data: [{!! $data !!}],
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                }]
            },
            options: {
                legend:{
                    position:'bottom'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize:1
                        }
                    }]
                }
            }
        });
    </script>

@endsection