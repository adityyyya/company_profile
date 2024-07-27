        @extends('home/layout/app')

        @foreach($data as $dt)
        @section('title',"$dt->judul")

        @section('content')
        <!-- Projects Section -->
        <div class="page-title dark-background" style="background-image: url('{{asset('home/assets/img/page-title-bg.jpg')}}');">
          <div class="container position-relative">
            <h1>Detail Berita</h1>
            <nav class="breadcrumbs">
              <ol>
                <li><a href="javascript:void(0)">{{$dt->judul}}</a></li>
              </ol>
            </nav>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-lg-8">
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
              <!-- Blog Details Section -->
              <section id="blog-details" class="blog-details section">
                <div class="container">

                  <article class="article">

                    <div class="post-img">
                      <img src="{{asset('berita')}}/{{$dt->image}}" alt="" class="img-fluid">
                    </div>

                    <h2 class="title">{{$dt->judul}}</h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="{{$dt->tanggal}}">{{tanggal_indonesia($dt->tanggal)}}</time></a></li>
                      </ul>
                    </div><!-- End meta top -->

                    <div class="content">
                      <?php
                      $array = explode(PHP_EOL, $dt->deskripsi);
                      $total = count($array);
                      foreach($array as $item) {
                        echo "<span>". $item . "</span>";
                      }
                      ?>
                    </div><!-- End post content -->

                  </article>

                </div>
              </section><!-- /Blog Details Section -->

            </div>
            <div class="col-lg-4 sidebar">

              <div class="widgets-container">

                <!-- Search Widget -->
                <!-- Categories Widget -->
                <!-- Recent Posts Widget -->
                <div class="recent-posts-widget widget-item">

                  <h3 class="widget-title">Berita Lainnya</h3>
                  @foreach($lain as $ln)
                  <div class="post-item">
                    <img src="{{asset('berita')}}/{{$ln->image}}" alt="" class="flex-shrink-0">
                    <div>
                      <h4><a href="{{route('view_berita',['judul'=>$ln->judul,'id_berita'=>$ln->id_berita])}}">{{substr($ln->judul,0,20)}}</a></h4>
                      <time datetime="{{$ln->tanggal}}">{{tanggal_indonesia($ln->tanggal)}}</time>
                    </div>
                  </div>
                  @endforeach
                </div><!--/Recent Posts Widget -->

                <!-- Tags Widget -->
              </div>

            </div>
          </div>
        </div>
        @endforeach
        @endsection
        @section('scripts')
        <script type="text/javascript">
          $(document).ready(function() {
            $("#menu_berita").addClass('active');
          });
        </script>
        @endsection