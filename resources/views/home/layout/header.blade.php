 <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

  <a href="{{route('index.beranda')}}" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <!-- <img src="{{asset('home/assets/img/logo.png')}}" alt=""> -->
    <h1 class="sitename">{{$profil_company->nama ?? ''}}</h1> <span>.</span>
  </a>

  <nav id="navmenu" class="navmenu">
    <ul>
      <li><a href="{{route('index.beranda')}}" id="menu_beranda">Home</a></li>
      <li><a href="{{route('index.about')}}" id="menu_about">About</a></li>
      <li><a href="{{route('index.direksi')}}" id="menu_direksi">Susunan Direksi</a></li>
      <li><a href="{{route('index.project')}}" id="menu_project">Project</a></li>
      <li><a href="{{route('index.berita')}}" id="menu_berita">Berita</a></li>
      <li><a href="{{route('index.kontak')}}" id="menu_kontak">Kontak</a></li>
      <li><a href="{{route('index.karir')}}" id="menu_karir">Karir</a></li>
      @if(Auth::user())
      <?php  
      if (Auth::user()->level == 'Admin') {
        $text = "Dashboard";
        $route = route('data.beranda');
      }else{
        $text = "Riwayat Lamaran";
        $route = route('riwayat_lamaran');
      }
      ?>
      <li> <a href="{{$route}}" class="btn btn-outline-warning" style="padding: 5px;"> {{$text}}</a></li>
      @else
      <li> <a href="{{route('login')}}" class="btn btn-outline-warning" style="padding: 5px;"> Login</a></li>
      @endif
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
  </nav>

</div>