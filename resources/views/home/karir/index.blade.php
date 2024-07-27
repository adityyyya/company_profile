          @extends('home/layout/app')

          @section('title','Karir')

          @section('content')  <!-- Constructions Section -->
          <div class="page-title dark-background" style="background-image: url('{{asset('home/assets/img/page-title-bg.jpg')}}');">
            <div class="container position-relative">
              <h1>Karir</h1>
              <nav class="breadcrumbs">
                <ol>
                  <li><a href="javascript:void(0)">Karir / Lowongan Pekerjaan</a></li>
                </ol>
              </nav>
            </div>
          </div>

          <section id="karir" class="constructions section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Karir</h2>
              <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
            </div><!-- End Section Title -->

            <div class="container">
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
            <div class="row gy-4">
              @foreach($data as $dt)
              <?php  
              if (Auth::user()) {
                $cek = App\Models\Page\Lamaran::where('id_lowongan',$dt->id_lowongan)
                ->where('id_user',Auth::user()->id)
                ->first();
              }
              ?>
              <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-item">
                  <div class="row">
                    <div class="col-xl-5">
                      <div class="card-bg"><img src="{{asset('poster_lowongan')}}/{{$dt->image}}" alt=""></div>
                    </div>
                    <div class="col-xl-7 align-items-center">
                      <div class="card-body">
                        <h4 class="card-title">{{$dt->nama_jabatan}}</h4>
                        <small>{{tanggal_indonesia($dt->tanggal_buka)}} s/d {{tanggal_indonesia($dt->tanggal_tutup)}}</small>
                        <p>
                          Persyaratan:<br>
                          <?php
                          $array = explode(PHP_EOL, $dt->persyaratan);
                          $total = count($array);
                          foreach($array as $item) {
                            echo "<span>". $item . "</span><br>";
                          }
                          ?>
                        </p>
                      </div>
                      <a href="" id="view{{$dt->id_lowongan}}" data-bs-target="#detail{{$dt->id_lowongan}}" data-bs-toggle="modal" class="text-footer" style="color: #000;font-size: 12px;">Detail Pekerjaan <i class="fa fa-arrow-right"></i></a>
                      @if(Auth::user())
                      <br>
                      @if(empty($cek))
                      @if(Auth::user()->level == 'Kandidat')
                      <a href="{{route('form_lamar',['nama_jabatan'=>$dt->nama_jabatan,'id_lowongan'=>$dt->id_lowongan])}}" class="btn btn-sm btn-primary mt-2 w-100">Lamar</a>
                      @endif
                      @else
                      <span class="badge bg-success text-white"><i class="bx bx-info-circle"></i> Anda telah melamar di Lowongan ini</span>
                      @endif
                      @else
                      <a href="{{route('login')}}" class="btn btn-sm btn-primary mt-2 w-100">Lamar</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div><!-- End Card Item -->
              <div class="modal fade text-left" data-bs-backdrop="static" id="detail{{$dt->id_lowongan}}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="myModalLabel1">Detail Pekerjaan - {{$dt->nama_jabatan}}</h5>
                      <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12">
                         <div class="card-body">
                          <h4 class="card-title">{{$dt->nama_jabatan}}</h4>
                          <small>{{tanggal_indonesia($dt->tanggal_buka)}} s/d {{tanggal_indonesia($dt->tanggal_tutup)}}</small>
                          <p>
                            Persyaratan:<br>
                            <?php
                            $array = explode(PHP_EOL, $dt->persyaratan);
                            $total = count($array);
                            foreach($array as $item) {
                              echo "<span>". $item . "</span><br>";
                            }
                            ?>
                          </p>
                          <p>
                            Deskripsi Pekerjaan::<br>
                            <?php
                            $array = explode(PHP_EOL, $dt->deskripsi);
                            $total = count($array);
                            foreach($array as $item) {
                              echo "<span>". $item . "</span><br>";
                            }
                            ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach

          </div>

        </div>

      </section><!-- /Constructions Section -->
      @endsection
      @section('scripts')
      <script type="text/javascript">
        $(document).ready(function() {
          $("#menu_karir").addClass('active');
        });
      </script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      @if(!empty($_GET['keyword']))
      <script type="text/javascript">
        $(document).ready(function() {
         var id_lowongan = "{{ $_GET['keyword'] }}";
         $("#detail" + id_lowongan).modal('show');
       });
     </script>
     @endif
     @endsection