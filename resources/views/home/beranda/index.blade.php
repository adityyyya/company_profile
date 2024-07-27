     @extends('home/layout/app')

     @foreach($beranda as $br)
     @section('title',"$company_name")

     @section('content')
     <section id="hero" class="hero section dark-background">

      <div class="info d-flex align-items-center">
        <div class="container">
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-6 text-center">
              <h2>{{$br->judul}}</h2>
                <?php
                $array = explode(PHP_EOL, $br->deskripsi);
                $total = count($array);
                foreach($array as $item) {
                  echo "<span>". $item . "</span>";
                }
                ?>
            </div>
          </div>
        </div>
      </div>

      <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active">
          <img src="{{asset('beranda')}}/{{$br->image}}" alt="" style="background-size: 100% 100% cover;background-repeat: no-repeat;">
        </div>
      </div>

    </section><!-- /Hero Section -->
    @endsection
    @endforeach
    @section('scripts')
    <script type="text/javascript">
      $(document).ready(function() {
        $("#menu_beranda").addClass('active');
      });
    </script>
    @endsection