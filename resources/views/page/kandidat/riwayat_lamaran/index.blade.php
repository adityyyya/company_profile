  @extends('page/layout/app')

  @section('title','Riwayat Lamaran')

  @section('content')
  <div class="loading" id="loading" style="display: none;">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <h4>Loading</h4>
  </div>
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Kandidat</a></li>
              <li class="breadcrumb-item active" aria-current="page">Riwayat Lamaran</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Riwayat Lamaran
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="table_lamaran" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="1">No. </th>
                  @if(Auth::user()->level == 'Admin')
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  @endif
                  <th>Posisi</th>
                  <th>Tanggal Apply</th>
                  <th data-priority="2">Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection
  @section('css')
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
  <script type="text/javascript">
    $(function () {
      var level = "{{ Auth::user()->level }}";
      var columns = [
      { data: 'DT_RowIndex', name: 'DT_RowIndex' },
      { 
        data: 'nama_jabatan', 
        name: 'nama_jabatan', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'tanggal_apply', 
        name: 'tanggal_apply', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'tanggal_apply', 
        name: 'tanggal_apply', 
        render: function (data, type, row) {
          // var route = '{{ route("index.karir", ["keyword" => ""]) }}' + row.id_lowongan + '#karir';
          if (level == 'Admin') {
            var text = 'Lihat Data Pelamar';
          }else{
            var text = 'Lihat Riwayat Lamaran';
          }
          var detail = '{{ url("page/riwayat_lamaran/view") }}/' + row.id_lamaran;
          return '<a href="'+detail+'" class="btn btn-sm btn-primary rounded-pill">'+text+' <i class="fa fa-eye"></i></a>';
        }  
      }
      ];

    // Conditionally add the 'name' column for Admin users
    if (level === 'Admin') {
      columns.splice(1, 0, {
        data: 'name',
        name: 'name',
        render: function (data, type, row) {
          return data;
        }
      });
      columns.splice(2, 0, {
        data: 'email',
        name: 'email',
        render: function (data, type, row) {
          return data;
        }
      });
      columns.splice(3, 0, {
        data: 'telepon',
        name: 'telepon',
        render: function (data, type, row) {
          return data;
        }
      });
    }

    $('#table_lamaran').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      ajax: {
        url: "{{ route('riwayat_lamaran') }}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_lamaran').DataTable().ajax.reload();
        }
      },
      columns: columns
    });
  });

</script>
@endsection