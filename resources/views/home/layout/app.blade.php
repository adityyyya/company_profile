<!DOCTYPE html>
<html lang="en">
<?php  
$profil_company = App\Models\Page\ProfileCompany::first();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title') - {{$profil_company->nama ?? ''}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('profil_perusahaan')}}/{{$profil_company->logo ?? ''}}" rel="icon">
  <link href="{{asset('profil_perusahaan')}}/{{$profil_company->logo ?? ''}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('home/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('home/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('home/assets/css/main.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: UpConstruction
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
@yield('css')
<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
   @include('home.layout.header')
 </header>

 <main class="main">

  @yield('content')

</main>

<footer id="footer" class="footer dark-background">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="index.html" class="logo d-flex align-items-center">
          <span class="sitename">{{$profil_company->nama ?? ''}}</span>
        </a>
        <div class="footer-contact pt-3">
          <p>{{$profil_company->alamat ?? ''}}</p>
          <p class="mt-3"><strong>Telepon:</strong> <span>{{$profil_company->telepon ?? ''}}</span></p>
          <p><strong>Email:</strong> <span>{{$profil_company->email ?? ''}}</span></p>
        </div>
       <!--  <div class="social-links d-flex mt-4">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a>
        </div> -->
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Informasi Perusahaan</h4>
        <ul>
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Tentang Perusahaan</a></li>
          <li><a href="#">Visi Misi</a></li>
          <li><a href="#">Susunan Direksi</a></li>
          <li><a href="#">Kontak</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Team Perusahaan</h4>
        <ul>
          <li><a href="#">Susunan Direksi</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Berita & Karir</h4>
        <ul>
          <li><a href="#">Project</a></li>
          <li><a href="#">Berita</a></li>
          <li><a href="#">Lowongan</a></li>
        </ul>
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>By</span> <strong class="px-1 sitename">{{$profil_company->nama ?? ''}}</strong> <span>All Rights Reserved</span></p>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you've purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
      Designed by <a href="">{{$profil_company->nama ?? ''}}</a>
    </div>
  </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{asset('home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('home/assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('home/assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('home/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('home/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('home/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('home/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('home/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>

<script src="{{asset('panel/assets/vendor/libs/jquery/jquery.js')}}"></script>
<!-- Main JS File -->
<script src="{{asset('home/assets/js/main.js')}}"></script>

</body>
@yield('scripts')
</html>