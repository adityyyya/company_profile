<?php
$currentRoute = request()->route()->getName();
$isMenuMaster = false;
$isDataMaster = false;
$isDataKarir = false;

if (in_array($currentRoute, ['data.beranda','data.profil','data.visi_misi','data.direksi','data.project','data.berita'])) {
  $isMenuMaster = true;
}
if (in_array($currentRoute, ['index.jabatan','index.kategori','index.user'])) {
  $isDataMaster = true;
}
if (in_array($currentRoute, ['data.lowongan','riwayat_lamaran'])) {
  $isDataKarir = true;
}
// if (in_array($currentRoute, ['index.penyewaan','index.pembayaran','index.pengeluaran'])) {
//   $isPengelolaan = true;
// }
// if (in_array($currentRoute, ['laporan.penyewaan','laporan.pembayaran','laporan.pengeluaran','laporan.keuangan'])) {
//   $isLaporan = true;
// }
?>
<div class="app-brand demo">
  <a href="javascript:void(0)" class="app-brand-link text-center" style="margin: auto;">
    <span class="app-brand-logo demo">
    </span>
    <span class="app-brand-text demo menu-text fw-bold">{{implode(" ", array_slice(explode(" ",Auth::user()->name),0,2))}}</span>
    <!-- <span class="app-brand-text menu-text">Hello, <b>{{implode(" ", array_slice(explode(" ",Auth::user()->name),0,2))}}!</b></span> -->
  </a>

  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
  </a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
  @if(Auth::user()->level == 'Kandidat')
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Riwatar Lamaran Kerja</span>
  </li>
  <li class="menu-item {{ (route('riwayat_lamaran') == url()->current()) ? ' active' : '' }}">
    <a
    href="{{route('riwayat_lamaran')}}"
    class="menu-link">
    <i class="menu-icon tf-icons bx bx-time-five"></i>
    <div data-i18n="Email">Riwayat Lamaran</div>
  </a>
</li>
@endif
@if(Auth::user()->level == 'Admin')
<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Dashboard</span>
</li>
<li class="menu-item {{ (route('index.dashboard') == url()->current()) ? ' active' : '' }}">
  <a
  href=" {{ route('index.dashboard') }}"
  class="menu-link">
  <i class="menu-icon tf-icons bx bx-home"></i>
  <div data-i18n="Email">Dashboard</div>
</a>
</li>
<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Data Master</span>
</li>
<li class="menu-item{{ $isDataMaster ? ' active open' : '' }}">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-slider-alt"></i>
    <div data-i18n="Dashboards">Master Data</div>
    <div class="badge bg-label-primary rounded-pill ms-auto">3</div>
  </a>
  <ul class="menu-sub">
    <li class="menu-item {{ (route('index.jabatan') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('index.jabatan')}}" class="menu-link">
        <div data-i18n="">Jabatan</div>
      </a>
    </li>
    <li class="menu-item {{ (route('index.kategori') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('index.kategori')}}" class="menu-link">
        <div data-i18n="">Kategori</div>
      </a>
    </li>
    <li class="menu-item {{ (route('index.kandidat') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('index.kandidat')}}" class="menu-link">
        <div data-i18n="">Kandidat</div>
      </a>
    </li>
  </ul>
</li>
<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Company Setting</span>
</li>
<li class="menu-item{{ $isMenuMaster ? ' active open' : '' }}">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-category-alt"></i>
    <div data-i18n="Dashboards">Master Menu</div>
    <div class="badge bg-label-primary rounded-pill ms-auto">6</div>
  </a>
  <ul class="menu-sub">
    <li class="menu-item {{ (route('data.beranda') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('data.beranda')}}" class="menu-link">
        <div data-i18n="">Beranda</div>
      </a>
    </li>
    <li class="menu-item {{ (route('data.profil') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('data.profil',['menu'=>'profil_perusahaan'])}}" class="menu-link">
        <div data-i18n="">Profil & Tentang</div>
      </a>
    </li>
    <li class="menu-item {{ (route('data.visi_misi') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('data.visi_misi')}}" class="menu-link">
        <div data-i18n="">Visi Misi</div>
      </a>
    </li>
    <li class="menu-item {{ (route('data.direksi') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('data.direksi')}}" class="menu-link">
        <div data-i18n="">Susunan Direksi</div>
      </a>
    </li>
    <li class="menu-item {{ (route('data.project') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('data.project')}}" class="menu-link">
        <div data-i18n="">Project</div>
      </a>
    </li>
    <li class="menu-item {{ (route('data.berita') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('data.berita')}}" class="menu-link">
        <div data-i18n="">Berita</div>
      </a>
    </li>
  </ul>
</li>
<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Pesan & Masukkan</span>
</li>
<li class="menu-item {{ (route('index.pesan_masukkan') == url()->current()) ? ' active' : '' }}">
  <a
  href="{{route('index.pesan_masukkan')}}"
  class="menu-link">
  <i class="menu-icon tf-icons bx bx-mail-send"></i>
  <div data-i18n="Email">Pesan & Masukkan</div>
</a>
</li>
<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Data Karir</span>
</li>
<li class="menu-item{{ $isDataKarir ? ' active open' : '' }}">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-analyse"></i>
    <div data-i18n="Dashboards">Master Karir</div>
    <div class="badge bg-label-primary rounded-pill ms-auto">2</div>
  </a>
  <ul class="menu-sub">
    <li class="menu-item {{ (route('data.lowongan') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('data.lowongan')}}" class="menu-link">
        <div data-i18n="">Lowongan</div>
      </a>
    </li>
    <li class="menu-item {{ (route('riwayat_lamaran') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('riwayat_lamaran')}}" class="menu-link">
        <div data-i18n="">Lamaran Kerja</div>
      </a>
    </li>
  </ul>
</li>
@endif
</ul>
