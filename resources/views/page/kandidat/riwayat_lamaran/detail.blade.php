  @extends('page/layout/app')

  @section('title', 'Penyewaan Detail')

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
              <li class="breadcrumb-item"><a href="">Lamaran</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail Lamaran</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <h5 class="card-header">Detail Lamaran <b>{{$dt->name}}</b></h5>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <span><i class="fa fa-info-circle"></i> Disini anda dapat melihat detail penyewaan mulai dari:</span>
              <ol start="1">
                <li>Detail Lamaran</li>
                <li>Informasi Kandidat</li>
                <li>Berkas Persyaratan Kandidat</li>
              </ol>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <h5 class="card-header">Data Kandidat: </h5>
            <div class="table-responsive">
              <table class="table table-striped table-borderless border-bottom">
                <tbody>
                  <tr>
                    <th class="text-nowrap">Nama Kandidat</th>
                    <td>:</td>
                    <td>
                     {{$dt->name}}
                   </td>
                 </tr>
                 <tr>
                  <th class="text-nowrap">Email</th>
                  <td>:</td>
                  <td>
                   <a href="mailto:{{$dt->email}}">{{$dt->email}}</a>
                 </td>
               </tr>
               <tr>
                <th class="text-nowrap">NIK</th>
                <td>:</td>
                <td>
                 {{$dt->nik}}
               </td>
             </tr>
             <tr>
               <th class="text-nowrap">No. Telp/WA</th>
               <td>:</td>
               <td>
                {{$dt->telepon}} / <a href="https://wa.me/62{{substr($dt->telepon,1)}}" target="_blank" class="btn btn-xs rounded-pill btn-success"><i class="bx bxl-whatsapp"></i> WhatsApp</a>
              </td>
            </tr>
            <tr>
             <tr>
              <th class="text-nowrap">Jenis Kelamin</th>
              <td>:</td>
              <td>
                @if($dt->jenis_kelamin == 'L')
                Laki-Laki
                @else
                Perempuan
                @endif
              </td>
            </tr>
            <tr>
              <th class="text-nowrap">Alamat</th>
              <td>:</td>
              <td>
               {{$dt->alamat}}
             </td>
           </tr>
         </tbody>
       </table>
     </div>
   </div>
   <div class="col-lg-6">
     <h5 class="card-header">Riwayat Apply: </h5>
     <div class="table-responsive">
      <table class="table table-striped table-borderless border-bottom">
        <tbody>
          <tr>
            <th class="text-nowrap">Posisi</th>
            <td>:</td>
            <td>
             {{$dt->nama_jabatan}}
           </td>
         </tr>
         <tr>
          <th class="text-nowrap">Deskripsi Pekerjaan</th>
          <td>:</td>
          <td>
            <?php
            $array = explode(PHP_EOL, $dt->deskripsi);
            $total = count($array);
            foreach($array as $item) {
              echo "<span>". $item . "</span><br>";
            }
            ?>
          </td>
        </tr>
        <tr>
          <th class="text-nowrap">Tanggal Apply</th>
          <td>:</td>
          <td>
           {{$dt->tanggal_apply}}
         </td>
       </tr>
     </tbody>
   </table>
 </div>
</div>

</div>
</div>
<!--  -->

<div class="card mt-2">
  <h5 class="card-header">Berkas Persyaratan Upload</h5>
  <div class="card-body">
    <div class="row">
      <!-- Custom content with heading -->
      <div class="col-lg-12">
        <div class="demo-inline-spacing">
          <div class="list-group list-group-horizontal-md text-md-center">
            <?php
            $filesString = $dt->berkas;
            $files = explode(';', trim($filesString, ';'));
            $names = ['CV', 'SURAT LAMARAN KERJA', 'KTP'];
            ?>
            <div class="tab-content px-0 mt-0" style="width: 100%;">
              <div class="tab-pane fade show active" id="tagihan-belum-bayar">
                <div class="table-responsive">
                  <table class="table table-striped" cellpadding="0" cellspacing="0" id="table_penyewaan" style="width: 100%;">
                    <thead class="bg-dark text-white">
                      <tr>
                        <th data-priority="" class="text-white">No. </th>
                        <th data-priority="" class="text-white">Nama</th>
                        <th data-priority="" class="text-white">File Berkas</th>
                        <th data-priority="" class="text-white">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($files as $index => $file)
                     <tr>
                      <td>{{ $index + 1 }}. </td>
                      <td>{{ $names[$index] }}</td>
                      <td>{{ $file }}</td>
                      <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_view_berkas{{$index+1}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @foreach($files as $index => $file)
            <div class="modal text-left" data-bs-backdrop="static" id="modal_view_berkas{{$index+1}}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel1">{{$names[$index]}}</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                     <embed src="{{asset('berkas_lamaran')}}/{{$file}}" class="form-control" width="100%"></embed>
                   </div>
                 </div>
               </div>
               <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                  <span>Tutup</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
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
<style type="text/css">
  /* The Modal (background) */
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

@endsection