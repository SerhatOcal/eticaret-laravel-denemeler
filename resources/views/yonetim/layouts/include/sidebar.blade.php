<div class="list-group">
    <a href="{{ route('yonetim.anasayfa') }}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Kontrol Paneli</a>
    <a href="{{ route('yonetim.urun') }}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Ürünler
    </a>
    <a href="{{ route('yonetim.kategori') }}" class="list-group-item">
        <span class="fa fa-fw fa-folder"></span> Kategoriler
    </a>
    <a href="{{ route('yonetim.kategori') }}" class="list-group-item">
        <span class="fa fa-fw fa-comment"></span> Ürün Yorumları
    </a>
    <a href="#" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar"><span class="fa fa-fw fa-folder"></span> Kategorileri Ürünler<span class="caret arrow"></span></a>
    <div class="list-group collapse" id="submenu1">
        <a href="#" class="list-group-item">Category</a>
        <a href="#" class="list-group-item">Category</a>
    </div>
    <a href="{{ route('yonetim.kullanici') }}" class="list-group-item">
        <span class="fa fa-fw fa-users"></span> Kullanicilar
    </a>
    <a href="{{ route('yonetim.siparis') }}" class="list-group-item">
        <span class="fa fa-fw fa-shopping-cart"></span> Siparişler
    </a>
    <a href="#" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar"><span class="fa fa-fw fa-dashboard"></span> Raporlar <span class="caret arrow"></span></a>
    <div class="list-group collapse" id="submenu1">
        <a href="#" class="list-group-item">Category</a>
        <a href="#" class="list-group-item">Category</a>
    </div>
    <a href="#" class="list-group-item">
        <span class="fa fa-fw fa-cogs"></span> Site Ayarları
    </a>
</div>
