        @extends('home/layout/app')

        @section('title','Berita')

        @section('content')
        <!-- Projects Section -->
        <div class="page-title dark-background" style="background-image: url('{{asset('home/assets/img/page-title-bg.jpg')}}');">
          <div class="container position-relative">
            <h1>Berita</h1>
            <nav class="breadcrumbs">
              <ol>
                <li><a href="javascript:void(0)">Berita</a></li>
              </ol>
            </nav>
          </div>
        </div>
        <!-- Projects Section -->
        <section id="blog-posts" class="blog-posts section">
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
          <div class="container">
            <div class="row gy-4">
              @foreach($data as $dt)
              <div class="col-lg-4">
                <article class="position-relative h-100">

                  <div class="post-img position-relative overflow-hidden">
                    <img src="{{asset('berita')}}/{{$dt->image}}" class="img-fluid" alt="">
                    <span class="post-date">{{tanggal_indonesia($dt->tanggal)}}</span>
                  </div>

                  <div class="post-content d-flex flex-column">

                    <h3 class="post-title">{{$dt->judul}}</h3>

                    <?php
                    $array = explode(PHP_EOL, substr($dt->deskripsi,0,100));
                    $total = count($array);
                    foreach($array as $item) {
                      echo "<span>". $item . "</span>";
                    }
                    ?>

                    <hr>

                    <a href="{{route('view_berita',['judul'=>$dt->judul,'id_berita'=>$dt->id_berita])}}" class="readmore stretched-link"><span>Baca Selengkapnya</span><i class="bi bi-arrow-right"></i></a>

                  </div>

                </article>
              </div><!-- End post list item -->
              @endforeach
            </div>
          </div>

        </section><!-- /Blog Posts Section -->
        @endsection
        @section('scripts')
        <script type="text/javascript">
          $(document).ready(function() {
            $("#menu_berita").addClass('active');
          });
        </script>
        @endsection