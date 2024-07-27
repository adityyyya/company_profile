  @extends('page/layout/app')

  @section('title','Data Lowongan Kerja')

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
              <li class="breadcrumb-item"><a href="">Master Karir</a></li>
              <li class="breadcrumb-item active" aria-current="page">Lowongan Kerja</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Lowongan Kerja
          <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new" >
            <i class="bx bx-plus"></i> Buat Lowongan
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped dt-responseive nowrap" id="table_lowongan" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="2">No. </th>
                  <th data-priority="3">Posisi</th>
                  <th data-priority="4">Tanggal Buka</th>
                  <th data-priority="5">Tanggal Tutup</th>
                  <th data-priority="6">Poster/Gambar</th>
                  <th data-priority="7">Status</th>
                  <th data-priority="1">Action</th>
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
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_lowongan" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1"></h5>
        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
       <form method="post" id="lowoganForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-6 mb-2">
            <div class="form-group">
              <label class="">Posisi <span class="text-danger">*</span></label>
              <input type="" hidden="" id="id_lowongan" name="id_lowongan">
              <select class="form-control" style="width: 100%;" id="id_jabatan" name="id_jabatan">
                @foreach($jabatan as $jbt)
                <option value="{{$jbt->id_jabatan}}">{{$jbt->nama_jabatan}}</option>
                @endforeach
              </select>
              <span class="invalid-feedback" role="alert" id="id_jabatanError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <div class="form-group">
              <label class="">Poster Lowongan <span class="text-danger mandatory"></span></label>
              <input type="" hidden="" id="imageLama" name="imageLama">
              <input type="file" class="form-control" name="image" id="image">
              <span class="invalid-feedback d-block" role="alert" id="imageError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <div class="form-group">
              <label class="">Tanggal Buka <span class="text-danger">*</span></label>
              <input type="date" class="form-control" id="tanggal_buka" name="tanggal_buka">
              <span class="invalid-feedback" role="alert" id="tanggal_bukaError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <div class="form-group">
              <label class="">Tanggal Tutup <span class="text-danger">*</span></label>
              <input type="date" class="form-control" id="tanggal_tutup" name="tanggal_tutup">
              <span class="invalid-feedback" role="alert" id="tanggal_tutupError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <div class="form-group">
              <label class="">Persyaratan <span class="text-danger">*</span></label>
              <textarea class="form-control" rows="4" name="persyaratan" id="persyaratan"></textarea>
              <span class="invalid-feedback" role="alert" id="persyaratanError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <div class="form-group">
              <label class="">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
              <textarea class="form-control" rows="4" name="deskripsi" id="deskripsi"></textarea>
              <span class="invalid-feedback" role="alert" id="deskripsiError">
                <strong></strong>
              </span>
            </div>
          </div>
          <div class="col-lg-6 mb-2">
            <div class="form-group">
              <label class="">Status <span class="text-danger">*</span></label>
              <select class="form-control" style="width: 100%;" id="status" name="status">
                <option value="A">Aktif</option>
                <option value="I">Non Aktif</option>
              </select>
              <span class="invalid-feedback" role="alert" id="statusError">
                <strong></strong>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">
          <span>Tutup</span>
        </button>
        <button class="btn btn-primary ml-1 submit">
          <i class="bx bx-save"></i> <span>Simpan</span>
        </button>
      </div>
    </form>
    <!--  -->
    <!--  -->
  </div>
</div>
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
    $('#table_lowongan').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{ route('data.lowongan') }}",
        data: {status:'key'},
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_lowongan').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'nama_jabatan', 
        name: 'nama_jabatan', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'tanggal_buka', 
        name: 'tanggal_buka', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'tanggal_tutup', 
        name: 'tanggal_tutup', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'image', 
        name: 'image', 
        render: function (data, type, row) {
          return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center"><li data-bs-toggle="tooltip"data-popup="tooltip-custom"data-bs-placement="top" class="avatar avatar-xl pull-up" title="Poster Lowongan"><img src="{{asset('poster_lowongan')}}/'+data+'" alt="Avatar" class="rounded-circle" /></li></ul>';
        }  
      },
      { 
        data: 'status', 
        name: 'status', 
        render: function (data, type, row) {
          if (data == 'A') {
            return '<span class="badge bg-success text-white">Aktif</span>';
          }else{
            return '<span class="badge bg-danger text-white">Non Aktif</span>';
          }
        }  
      },
      { data: 'action', name: 'action', orderable: false, className: 'space' }
      ]
    });
  });
  $("#id_jabatan").select2({
    placeholder: ".: PILIH JABATAN :.",
    dropdownParent: $("#modal_form_lowongan")
  });
  $("#status").select2({
    placeholder: ".: STATUS LOWONGAN :.",
    dropdownParent: $("#modal_form_lowongan")
  });
  $(document).ready(function() {
    $(".new").click(function() {
      $("#loading").show();
      $("#lowoganForm")[0].reset();
      $(".mandatory").text('*');
      setTimeout(function() {
        $("#loading").hide();
        $("#id_jabatan").val(null).trigger('change');
        $("#status").val(null).trigger('change');
        $(".invalid-feedback").children("strong").text("");
        $("#lowoganForm input").removeClass("is-invalid");
        $("#lowoganForm select").removeClass("is-invalid");
        $("#lowoganForm textarea").removeClass("is-invalid");
        $(".modal-title").html('<i class="bx bx-plus"></i> Form Tambah Lowongan');
        $("#modal_form_lowongan").modal('show');
      }, 300);
    });
  });
  $(function () {
    $('#lowoganForm').submit(function (e) {
      e.preventDefault();
      if ($(this).data('submitted') === true) {
        return;
      }
      $(this).data('submitted', true);
      let formData = new FormData(this);
      $(".invalid-feedback").children("strong").text("");
      $("#lowoganForm input").removeClass("is-invalid");
      $("#lowoganForm select").removeClass("is-invalid");
      $("#lowoganForm textarea").removeClass("is-invalid");
      $(".error-tab").html('');
      $("#loading").show();
      $.ajax({
        method: "POST",
        headers: {
          Accept: "application/json"
        },
        contentType: false,
        processData: false,
        url : "{{route('save.lowongan')}}",
        data: formData,
        success: function (response) {
          $('#lowoganForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#lowoganForm")[0].reset();
            $('#modal_form_lowongan').modal('hide');
            showToast('bg-primary','Lowongan Success',response.message);
            $('#table_lowongan').DataTable().ajax.reload();
          } else {
            showToast('bg-danger','Susunan Direksi Error',response.message);
          }
        },
        error: function (response) {
          $('#lowoganForm').data('submitted', false);
          $("#loading").hide();
          if (response.status === 422) {
            let errors = response.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              var key_temp = key.replaceAll(".", "_");
              $("#" + key_temp).addClass("is-invalid");
              $("#" + key_temp + "Error").children("strong").text(errors[key][0]);
              var tab_id = $("#" + key_temp + "Error").closest(".tab-pane").attr("id");
            });
          } else {
            showToast('bg-danger','Lowongan Error',response.message);
          }
        }
      });
    });
  });
  function get_edit(lowonganID) {
    $.ajax({
      type: "GET",
      url: "{{url('page/master_karir/lowongan/get_edit')}}"+"/"+lowonganID,
      success: function(response) {
        $("#loading").hide();
        $.each(response, function(key, value) {
          $("#id_lowongan").val(value.id_lowongan);
          $("#id_jabatan").val(value.id_jabatan).trigger('change');
          $("#status").val(value.status).trigger('change');
          $("#imageLama").val(value.image);
          $("#tanggal_buka").val(value.tanggal_buka);
          $("#tanggal_tutup").val(value.tanggal_tutup);
          $("#persyaratan").val(value.persyaratan);
          $("#deskripsi").val(value.deskripsi);
        });
      },
      error: function(response) {
        get_edit(lowonganID);
      }
    });
  }
  $(document).on('click','.edit',function() {
    $("#loading").show();
    var lowonganID = $(this).attr('more_id');
    $("#lowoganForm")[0].reset();
    $(".mandatory").text('');
    $(".invalid-feedback").children("strong").text("");
    $("#lowoganForm input").removeClass("is-invalid");
    $("#lowoganForm textarea").removeClass("is-invalid");
    $("#lowoganForm select").removeClass("is-invalid");
    $("#id_jabatan").val(null).trigger('change');
    $("#status").val(null).trigger('change');
    $(".modal-title").html('<i class="bx bx-edit"></i> Form Ubah Lowongan');
    $("#modal_form_lowongan").modal('show');
    if (lowonganID) {
      get_edit(lowonganID);
    }
  });
  $(document).on('click', '.delete', function (event) {
    lowonganID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Lowongan Kerja akan dihapus secara Permanent!',
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
          url: "{{url('page/master_karir/lowongan/destroy')}}"+"/"+lowonganID,
          success:function(response)
          {
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Data Lowongan Kerja Dihapus',response.message);
                $('#table_lowongan').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Data Lowongan Kerja Error',response.message);
            }
          },
          error: function(response) {
            $("#loading").hide();
            showToast('bg-danger','Data Lowongan Kerja Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection