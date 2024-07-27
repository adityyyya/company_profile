        @extends('home/layout/app')

        @section('title','Susunan Direksi')

        @section('content')
        <div class="page-title dark-background" style="background-image: url('{{asset('home/assets/img/page-title-bg.jpg')}}');">
          <div class="container position-relative">
            <h1>Susunan Direksi</h1>
            <nav class="breadcrumbs">
              <ol>
                <li><a href="javascript:void(0)">Team / Susunan Direksi</a></li>
              </ol>
            </nav>
          </div>
        </div>
        <section id="team" class="team section">

          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <h2>Team</h2>
            <p>Susunan Direksi</p>
          </div><!-- End Section Title -->

          <div class="container">

            <div class="row gy-5">
              @foreach($data as $dt)
              <?php  
              $sosmed = App\Models\Page\SusunanDireksi::leftJoin('jabatan','jabatan.id_jabatan','=','direksi.id_jabatan')
              ->where('direksi.id_direksi',$dt->id_direksi)
              ->join('direksi_sosmed','direksi_sosmed.id_direksi','=','direksi.id_direksi')
              ->get();
              ?>
              <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                <div class="member-img">
                  <img src="{{asset('susunan_direksi')}}/{{$dt->foto_direksi}}" class="rounded-circle" width="200" height="200" alt="">
                  <div class="social">
                    @foreach($sosmed as $sos)
                    <a href="{{$sos->url}}"><i class="bi bi-{{$sos->jenis}}"></i></a>
                    @endforeach
                  </div>
                </div>
                <div class="member-info text-center">
                  <h4>{{$dt->nama_direksi}}</h4>
                  <span>{{$dt->nama_jabatan}}</span>
                  <p>{{$dt->keterangan}}</p>
                </div>
              </div><!-- End Team Member -->
              @endforeach
            </div>

          </div>

        </section><!-- /Team Section -->
        @endsection
        @section('scripts')
    <script type="text/javascript">
      $(document).ready(function() {
        $("#menu_direksi").addClass('active');
      });
    </script>
    @endsection