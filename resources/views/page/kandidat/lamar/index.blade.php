  @extends('page/layout/app')

  @section('title', 'Form Lamaran')

  @section('content')
  @foreach($data as $dt)
  <div class="loading" id="loading" style="display: none;">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <h4>Loading</h4>
  </div>
  <div class="page-heading" id="pagePenyewaan">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Lowongan</a></li>
              <li class="breadcrumb-item active" aria-current="page">Lamar</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
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
    <section class="section">
      <div class="card">
        <h5 class="card-header">Form Lamssaran Kerja - Posisi : <u>{{$dt->nama_jabatan}}</u></h5>
        <div class="card-body">
          <div class="row">
            <!-- Custom content with heading -->
            <div class="col-lg-12">
              <div class="demo-inline-spacing mt-3">
                <div class="list-group list-group-horizontal-md text-md-center">
                  <a
                  class="list-group-item list-group-item-action active"
                  id="home-list-item"
                  data-bs-toggle="list"
                  href="#tagihan-belum-bayar"
                  >Detail Lowongan (tahap lamar 1)</a
                  >
                  <a
                  class="list-group-item list-group-item-action"
                  id="profile-list-item"
                  data-bs-toggle="list"
                  href="#tagihan-sudah-bayar"
                  >Profil (tahap lamar 2)</a
                  >
                  <a
                  class="list-group-item list-group-item-action"
                  id="messages-list-item"
                  data-bs-toggle="list"
                  href="#pembayaran-kos-belum-dikofirmasi"
                  >Berkas Persyaratan (tahap lamar 3)
                  </a
                  >
                </div>
                <form id="lamarForm" enctype="multipart/form-data" method="post">
                  @csrf
                  <div class="tab-content px-0 mt-0">
                    <div class="tab-pane fade show active" id="tagihan-belum-bayar">
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
                    <div class="tab-pane fade" id="tagihan-sudah-bayar">
                      <div class="row">
                        <div class="col-lg-6 mb-2">
                          <div class="form-group">

                            <label class="">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$profil->email}}" disabled="" required="">
                          </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                         <div class="form-group">
                          <label class="">NIK <span class="text-danger">*</span></label>
                          <input type="number" disabled="" value="{{$profil->nik}}" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-lg-6 mb-2">
                       <div class="form-group">
                        <label class="">Nama <span class="text-danger">*</span></label>
                        <input type="text" value="{{$profil->name}}" class="form-control" required="" name="name">
                      </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                     <div class="form-group">
                      <label class="">Jenis Kelamin <span class="text-danger">*</span></label>
                      <select class="form-control" required="" name="jenis_kelamin">
                        <option value="">PILIH JENIS KELAMIN</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-2">
                   <div class="form-group">
                    <label class="">no. Telepon/WhatsApp aktif <span class="text-danger">*</span></label>
                    <input type="text" value="{{$profil->telepon}}" class="form-control" required="" name="telepon">
                  </div>
                </div>
                <div class="col-lg-6 mb-2">
                 <div class="form-group">
                  <label class="">Alamat <span class="text-danger">*</span></label>
                  <input type="text" value="{{$profil->alamat}}" class="form-control" required="" name="alamat">
                </div>
              </div>
              <div class="col-lg-12 mb-2">
                <input type="" hidden="" id="fotoLama" name="fotoLama" value="{{$profil->foto}}">
                <img src="" alt="foto profil" class="d-block rounded img_preview" height="100" width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload Foto</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" id="upload" name="foto" class="account-file-input" hidden accept="image/png, image/jpeg" />
                  </label>
                  <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>
                </div>
                <span class="invalid-feedback d-block" role="alert" id="uploadError">
                  <strong></strong>
                </span>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pembayaran-kos-belum-dikofirmasi">
            <i class="bx bx-info-circle"></i> Sesuaikan upload berkas dengan persyaratan yang tertera.
            <?php  
            $berkas = array('CV','Surat Lamaran','KTP');
            ?>
            <div class="row mt-3">
              @foreach($berkas as $bks)
              <div class="col-lg-12 mb-2">
                <div class="form-group">
                  <label class="form-col-label">{{$bks}} <span class="text-danger">*</span></label>
                  <input type="file" required="" class="form-control" name="berkas[]">
                </div>
              </div>
              @endforeach
            </div>
            <div class="row mt-4">
              <div class="col-lg-4">
                <button class="btn btn-success"><i class="fa fa-paper-plane"></i> Kirim Lamaran</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</section>
</div>
@endforeach
<!--  -->
@endsection
@section('css')
<link href="{{asset('home/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<style type="text/css">
  .lds-roller,
  .lds-roller div,
  .lds-roller div:after {
    box-sizing: border-box;
  }
  .lds-roller {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
  }
  .lds-roller div {
    animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    transform-origin: 40px 40px;
  }
  .lds-roller div:after {
    content: " ";
    display: block;
    position: absolute;
    width: 7.2px;
    height: 7.2px;
    border-radius: 50%;
    background: currentColor;
    margin: -3.6px 0 0 -3.6px;
  }
  .lds-roller div:nth-child(1) {
    animation-delay: -0.036s;
  }
  .lds-roller div:nth-child(1):after {
    top: 62.62742px;
    left: 62.62742px;
  }
  .lds-roller div:nth-child(2) {
    animation-delay: -0.072s;
  }
  .lds-roller div:nth-child(2):after {
    top: 67.71281px;
    left: 56px;
  }
  .lds-roller div:nth-child(3) {
    animation-delay: -0.108s;
  }
  .lds-roller div:nth-child(3):after {
    top: 70.90963px;
    left: 48.28221px;
  }
  .lds-roller div:nth-child(4) {
    animation-delay: -0.144s;
  }
  .lds-roller div:nth-child(4):after {
    top: 72px;
    left: 40px;
  }
  .lds-roller div:nth-child(5) {
    animation-delay: -0.18s;
  }
  .lds-roller div:nth-child(5):after {
    top: 70.90963px;
    left: 31.71779px;
  }
  .lds-roller div:nth-child(6) {
    animation-delay: -0.216s;
  }
  .lds-roller div:nth-child(6):after {
    top: 67.71281px;
    left: 24px;
  }
  .lds-roller div:nth-child(7) {
    animation-delay: -0.252s;
  }
  .lds-roller div:nth-child(7):after {
    top: 62.62742px;
    left: 17.37258px;
  }
  .lds-roller div:nth-child(8) {
    animation-delay: -0.288s;
  }
  .lds-roller div:nth-child(8):after {
    top: 56px;
    left: 12.28719px;
  }
  @keyframes lds-roller {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
</style>
@endsection
@section('scripts')
<script src="{{asset('panel/assets/js/pages-account-settings-account.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $('#lamarForm').submit(function (e) {
      e.preventDefault();
      if ($(this).data('submitted') === true) {
        return;
      }
      $(this).data('submitted', true);
      let formData = new FormData(this);
      $("#loading").show();
      $.ajax({
        method: "POST",
        headers: {
          Accept: "application/json"
        },
        contentType: false,
        processData: false,
        url : "{{route('kirim_lamaran')}}",
        data: formData,
        success: function (response) {
          $('#lamarForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            Swal.fire({
              title: 'Lamaran berhasil.',
              text: response.message,
              icon: 'success',
              type: 'success'
            }).then((result) => {
              if (result.isConfirmed) {
                document.location.href = "{{route('riwayat_lamaran')}}";
              }
            });
          }else{
            Swal.fire({
              title: 'Error.',
              text: response.message,
              icon: 'error',
              type: 'error'
            });
          }
        },
        error: function (response) {
          $('#lamarForm').data('submitted', false);
          $("#loading").hide();
          Swal.fire({
            title: 'Error.',
            text: response.message,
            icon: 'error',
            type: 'error'
          });
        }
      });
    });
  });
</script>
@endsection