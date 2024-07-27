        @extends('home/layout/app')

        @foreach($data as $dt)
        @section('title',"$dt->judul")

        @section('content')
        <!-- Projects Section -->
        <div class="page-title dark-background" style="background-image: url('{{asset('home/assets/img/page-title-bg.jpg')}}');">
          <div class="container position-relative">
            <h1>Project</h1>
            <nav class="breadcrumbs">
              <ol>
                <li><a href="javascript:void(0)">Project / {{$dt->nama_kategori}}</a></li>
              </ol>
            </nav>
          </div>
        </div>
        <!-- Projects Section -->
        
        <!-- Project Details Section -->
        <section id="project-details" class="project-details section">

          <div class="container" data-aos="fade-up">

            <div class="portfolio-details-slider swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            }
          }
        </script>
        <div class="swiper-wrapper align-items-center">

          <div class="swiper-slide">
            <img src="{{asset('project')}}/{{$dt->image}}" alt="">
          </div>

        </div>
      </div>

      <div class="row justify-content-between gy-4 mt-4">
       <?php
       function tanggal_indonesia($tgl, $tampil_hari=true){
        $nama_hari=array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        $nama_bulan = array (
          1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
          "September", "Oktober", "November", "Desember");
        $tahun=substr($tgl,0,4);
        $bulan=$nama_bulan[(int)substr($tgl,5,2)];
        $tanggal=substr($tgl,8,2);
        $text="";
        if ($tampil_hari) {
          $urutan_hari=date('w', mktime(0,0,0, substr($tgl,5,2), $tanggal, $tahun));
          $hari=$nama_hari[$urutan_hari];
          $text .= $hari.", ";
        }
        $text .=$tanggal ." ". $bulan ." ". $tahun;
        return $text;
      }
      ?>
      <div class="col-lg-8" data-aos="fade-up">
        <div class="portfolio-description">
          <h2>{{$dt->judul}}</h2>
          <?php
          $array = explode(PHP_EOL, $dt->deskripsi);
          $total = count($array);
          foreach($array as $item) {
            echo "<span>". $item . "</span>";
          }
          ?>
        </div>
      </div>

      <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="portfolio-info">
          <h3>Project Informasi</h3>
          <ul>
            <li><strong>Judul</strong> {{$dt->judul}}</li>
            <li><strong>Kategori</strong> {{$dt->nama_kategori}}</li>
            <li><strong>Tanggal</strong> {{tanggal_indonesia($dt->tanggal)}}</li>
          </ul>
        </div>
      </div>

    </div>

  </div>

</section><!-- /Project Details Section -->
@endforeach
@endsection
@section('css')
<style type="text/css">
  .project-details .portfolio-description blockquote {
    overflow: hidden;
    background-color: color-mix(in srgb, var(--default-color), transparent 95%);
    padding: 60px;
    position: relative;
    text-align: center;
    margin: 20px 0;
  }

  .project-details .portfolio-description blockquote p {
    color: var(--default-color);
    line-height: 1.6;
    margin-bottom: 0;
    font-style: italic;
    font-weight: 500;
    font-size: 22px;
  }

  .project-details .portfolio-description blockquote:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background-color: var(--accent-color);
    margin-top: 20px;
    margin-bottom: 20px;
  }
</style>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $("#menu_project").addClass('active');
  });
</script>
@endsection