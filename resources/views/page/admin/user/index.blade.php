  @extends('page/layout/app')

  @section('title','Data Kandidat')

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
              <li class="breadcrumb-item"><a href="">Master Data</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kandidat</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Kandidat
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="table_user" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="1">No. </th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>NIK</th>
                  <th>Telepon</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Foto</th>
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
  @section('scripts')
  <script type="text/javascript">
   $(function () {
    $('#table_user').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{ route('index.kandidat') }}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_user').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'name', 
        name: 'name', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'email', 
        name: 'email', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'nik', 
        name: 'nik', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'telepon', 
        name: 'telepon', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'jenis_kelamin', 
        name: 'jenis_kelamin', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'alamat', 
        name: 'alamat', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'foto', 
        name: 'foto', 
        render: function (data, type, row) {
          return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center"><li data-bs-toggle="tooltip"data-popup="tooltip-custom"data-bs-placement="top" class="avatar avatar-xl pull-up" title="Foto"><img src="{{asset('foto_profil')}}/'+data+'" alt="Avatar" class="rounded-circle" /></li></ul>';
        }  
      },
      { data: 'action', name: 'action', orderable: false, className: 'space' }
      ]
    });
  });
   $(document).on('click', '.delete', function (event) {
    jabatanID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Data Kandidat akan dihapus secara Permanent!',
      icon: 'warning',
      type: 'warning',
      showCancelButton: !0,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: 'Lanjutkan'
    }).then((result) => {
      if (result.isConfirmed) {
        $("#loading").show();
        $.ajax({
          method: "GET",
          url: "{{url('page/master_data/kandidat/destroy')}}"+"/"+jabatanID,
          success:function(response)
          {
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Kandidat Dihapus',response.message);
                $('#table_user').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Kandidat Error',response.message);
            }
          },
          error: function(response) {
            $("#loading").hide();
            showToast('bg-danger','Kandidat Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection