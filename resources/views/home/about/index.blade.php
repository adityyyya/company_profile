        @extends('home/layout/app')

        @foreach($about as $abt)
        @section('title','Tentang Perusahaan')

        @section('content')
        <div class="page-title dark-background" style="background-image: url('{{asset('home/assets/img/page-title-bg.jpg')}}');">
          <div class="container position-relative">
            <h1>Tentang Perusahaan</h1>
            <nav class="breadcrumbs">
              <ol>
                <li><a href="#about">About</a> / <a href="#visi_misi">Visi Misi</a></li>
              </ol>
            </nav>
          </div>
        </div>
        <section id="about" class="about section">

          <div class="container mt-4">

            <div class="row position-relative">

              <div class="col-lg-7 about-img" data-aos="zoom-out" data-aos-delay="200"><img src="{{asset('about')}}/{{$abt->image}}"></div>

              <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                <h2 class="inner-title">Tentang Perusahaan</h2>
                <div class="our-story">
                  <?php
                  $array = explode(PHP_EOL, $abt->deskripsi);
                  $total = count($array);
                  foreach($array as $item) {
                    echo "<span>". $item . "</span>";
                  }
                  ?>
                </div>
              </div>

            </div>

          </div>

        </section><!-- /About Section -->
        <!-- Features Section -->
        <section id="visi_misi" class="features section">

          <div class="container">

            <ul class="nav nav-tabs row g-2 d-flex" data-aos="fade-up" data-aos-delay="100" role="tablist">
              @foreach($visi_misi as $vm)
              @if($vm->jenis == 'Visi')
              <li class="nav-item col-6" role="presentation">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1" aria-selected="true" role="tab">
                  <h4>{{$vm->jenis}}</h4>
                </a>
              </li><!-- End tab nav item -->
              @endif
              @if($vm->jenis == 'Misi')
              <li class="nav-item col-6" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2" aria-selected="false" tabindex="-1" role="tab">
                  <h4>{{$vm->jenis}}</h4>
                </a><!-- End tab nav item -->
              </li>
              @endif
              @endforeach
            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
              @foreach($visi_misi as $vm)
              @if($vm->jenis == 'Visi')
              <div class="tab-pane fade active show" id="features-tab-1" role="tabpanel">
                <div class="row">
                  <div class="col-lg-6">
                    <?php
                    $array = explode(PHP_EOL, $vm->deskripsi);
                    $total = count($array);
                    foreach($array as $item) {
                      echo "<span>". $item . "</span>";
                    }
                    ?>
                  </div>
                  <div class="col-lg-6">
                    <img src="{{asset('visi_misi')}}/{{$vm->image}}" alt="" class="img-fluid">
                  </div>
                </div>
              </div><!-- End tab content item -->
              @endif
              @if($vm->jenis == 'Misi')
              <div class="tab-pane fade" id="features-tab-2" role="tabpanel">
                <div class="row">
                  <div class="col-lg-6">
                   <?php
                   $array = explode(PHP_EOL, $vm->deskripsi);
                   $total = count($array);
                   foreach($array as $item) {
                    echo "<span>". $item . "</span>";
                  }
                  ?>
                </div>
                <div class="col-lg-6">
                  <img src="{{asset('visi_misi')}}/{{$vm->image}}" alt="" class="img-fluid">
                </div>
              </div>
            </div><!-- End tab content item -->
            @endif
            @endforeach

          </div>

        </div>

      </section><!-- /Features Section -->
      @endsection
      @endforeach
      @section('scripts')
      <script>
        const listItems = document.querySelectorAll('.our-story ul li');
        listItems.forEach(function(item) {
          const icon = document.createElement('i');
          icon.className = 'bi bi-check-circle';
          item.insertBefore(icon, item.firstChild);
        });
        $(document).ready(function() {
          $("#menu_about").addClass('active');
        });
      </script>
      @endsection