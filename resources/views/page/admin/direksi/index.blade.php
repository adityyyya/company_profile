  @extends('page/layout/app')

  @section('title','Susunan Direksi')

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
              <li class="breadcrumb-item"><a href="">Master Menu</a></li>
              <li class="breadcrumb-item active" aria-current="page">Susunan Direksi</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Susunan Direksi
          <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new" >
            <i class="bx bx-plus"></i> Tambah Data
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped dt-responseive nowrap" id="table_direksi" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="2">No. </th>
                  <th data-priority="3">Nama</th>
                  <th data-priority="4">Jabatan</th>
                  <th data-priority="5">Foto</th>
                  <th data-priority="6">Keterangan</th>
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
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_direksi" tabindex="-1" role="dialog"
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
       <form method="post" id="direksiForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-12 mb-2">
                <div class="form-group">
                  <label class="">Nama <span class="text-danger">*</span></label>
                  <input type="" hidden="" id="id_direksi" name="id_direksi">
                  <input type="text" class="form-control input_view" id="nama_direksi" name="nama_direksi">
                  <span class="invalid-feedback" role="alert" id="nama_direksiError">
                    <strong></strong>
                  </span>
                </div>
              </div>
              <div class="col-lg-12 mb-2">
                <div class="form-group">
                  <label class="">Jabatan <span class="text-danger">*</span></label>
                  <select style="width: 100%;" class="form-control change_view" id="id_jabatan" name="id_jabatan">
                    @foreach($jabatan as $jbt)
                    <option value="{{$jbt->id_jabatan}}">{{$jbt->nama_jabatan}}</option>
                    @endforeach
                  </select>
                  <span class="invalid-feedback" role="alert" id="id_jabatanError">
                    <strong></strong>
                  </span>
                </div>
              </div>
              <div class="col-lg-12 mb-2">
                <input type="" hidden="" id="uploadLama" name="uploadLama">
                <img src="{{asset('thumbnail.png')}}" alt="user-avatar" class="d-block rounded img_preview" height="100" width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload Foto</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" id="upload" name="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
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
              <div class="col-lg-12 mb-2">
                <div class="form-group">
                  <label class="">Keterangan <span class="text-danger">*</span></label>
                  <textarea class="form-control" rows="4" name="keterangan" id="keterangan"></textarea>
                  <span class="invalid-feedback" role="alert" id="keteranganError">
                    <strong></strong>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12" id="tab_detail">
            <div class="nav nav-tabs justify-content-left">
              <a class="nav-item nav-link active" data-toggle="tab" href="#sosmed-pane"><i class="bx bx-conversation"></i> 
                Sosial Media
                <span class="error-tab text-danger">Error</span>
              </a>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="tab-content">
              <div class="tab-pane show active" id="sosmed-pane">
                <input type="" hidden="" id="id_sosmed_del" name="id_sosmed_del">
                <button type="button" id="new_sosmed_detail" hidden="" class="btn btn-info btn-sm mb-3">
                  <i class="fa fa-plus"></i> Tambah Sosmed
                </button>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered table-striped responsive-table">
                    <thead>
                      <tr>
                        <th>No. </th>
                        <th>Jenis</th>
                        <th>URL Sosmed</th>
                        <th>Preview</th>
                      </tr>
                    </thead>
                    <tbody id="table_sosmed_detail">
                    </tbody>
                  </table>
                </div>
              </div>
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
    <div style="display:none;">
      <table id="sample_table_sosmed">
        <tr id="">
          <td data-label="No."><span class="sn" style="vertical-align:middle;"></span></td>   
          <td data-label="Jenis Sosmed">
            <input autocomplete="off" name="sosmed[0][id_direksi_sosmed]" hidden="" id="sosmed_0_id_direksi_sosmed" class="form-control form-control-sm id_direksi_sosmed_input">
            <input type="text" readonly="" name="sosmed[0][jenis]" id="sosmed_0_jenis" class="form-control form-control-sm jenis_input">
            <span class="invalid-feedback jenis_input_error" role="alert" id="sosmed_0_jenisError">
              <strong></strong>
            </span>
          </td>
          <td data-label="URL Sosmed">
            <input type="url" name="sosmed[0][url]" id="sosmed_0_url" class="url_input form-control form-control-sm" style="width: 100%;"></select>
            <span class="invalid-feedback url_input_error" role="alert" id="sosmed_0_urlError">
              <strong></strong>
            </span>
          </td>
          <td data-label="Preview">
            <a href="javascript:void(0)" id="sosmed_0_preview" class="preview_input btn btn-sm btn-primary">Preview URL <i class="fa fa-eye"></i></a>
          </td>
        </tr>
      </table>
    </div>
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
<script src="{{asset('panel/assets/js/pages-account-settings-account.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $('#table_direksi').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{ route('data.direksi') }}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_direksi').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'nama_direksi', 
        name: 'nama_direksi', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'nama_jabatan', 
        name: 'nama_jabatan', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'foto_direksi', 
        name: 'foto_direksi', 
        render: function (data, type, row) {
          return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center"><li data-bs-toggle="tooltip"data-popup="tooltip-custom"data-bs-placement="top" class="avatar avatar-xl pull-up" title="Foto"><img src="{{asset('susunan_direksi')}}/'+data+'" alt="Avatar" class="rounded-circle" /></li></ul>';
        }  
      },
      { 
        data: 'keterangan', 
        name: 'keterangan', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { data: 'action', name: 'action', orderable: false, className: 'space' }
      ]
    });
  });
  var ajaxUrl = "";
  $("#id_jabatan").select2({
    placeholder: ".: PILIH JABATAN :.",
    dropdownParent: $("#modal_form_direksi")
  });
  let global_id_sosmed = 0;
  $(document).on('click', '#new_sosmed_detail', function () {
    var content = jQuery("#sample_table_sosmed tr"),
    size = global_id_sosmed++,
    element = null,
    element = content.clone();
    element.attr('id','rec-'+size);
    element.attr('class','rec');
    // element.find('.delete-record').attr('data-id', size);

    element.find('.id_direksi_sosmed_input').attr('id', 'sosmed_' + size + '_id_direksi_sosmed');
    element.find('.id_direksi_sosmed_input').attr('name', 'sosmed[' + size + '][id_direksi_sosmed]');

    element.find('.jenis_input').attr('id', 'sosmed_' + size + '_jenis');
    element.find('.jenis_input').attr('name', 'sosmed[' + size + '][jenis]');
    element.find('.jenis_input_error').attr('id', 'sosmed_' + size + '_jenisError');

    element.find('.preview_input').attr('id', 'sosmed_' + size + '_preview');
    element.find('.preview_input').attr('hidden', true);
    element.find('.preview_input').attr('target', '_blank');
    
    element.find('.url_input').attr('id', 'sosmed_' + size + '_url');
    element.find('.url_input').attr('name', 'sosmed[' + size + '][url]');
    element.find('.url_input_error').attr('id', 'sosmed_' + size + '_urlError');
    element.find('.url_input').on('input',function(e) {
      if (e.target.value != '') {
        element.find('.preview_input').attr('hidden', false);
        element.find('.preview_input').attr('href', e.target.value);
      }else{
        element.find('.preview_input').attr('hidden', true);
        element.find('.preview_input').attr('href', 'javascript:void(0)');
      }
    });

    element.appendTo('#table_sosmed_detail');
    $('#table_sosmed_detail tr').each(function (index) {
      $(this).find('span.sn').html(index + 1);
    });
  });
  function triggerClickWithJenis(jenis) {
    $('#new_sosmed_detail').trigger('click');
    let lastElement = $('#table_sosmed_detail tr').last();
    lastElement.find('.jenis_input').val(jenis);
  }
  // $(document).on('click', '.delete-record', function () {
  //   var id = jQuery(this).attr('data-id');
  //   var more_id = jQuery(this).attr('more_id');
  //   var currentValues = $("#id_sosmed_del").val();
  //   if (currentValues) {
  //     if (more_id) {
  //       $("#id_sosmed_del").val(currentValues + ',' + more_id);
  //     }
  //   } else {
  //     $("#id_sosmed_del").val(more_id);
  //   }
  //   var targetDiv = jQuery(this).attr('targetDiv');
  //   jQuery('#rec-' + id).remove();
  //   var row = $(this).closest('tr.rec');
  //   row.remove();
  //   $('#table_sosmed_detail tr').each(function (index) {
  //     $(this).find('span.sn').html(index + 1);
  //   });
  //   return true;
  // });
  $(document).ready(function() {
    $(".new").click(function() {
      $("#loading").show();
      $("#direksiForm")[0].reset();
      jQuery('.rec').remove();
      global_id_sosmed = 0;
      setTimeout(function() {
        $("#loading").hide();
        $(".account-image-reset").show();
        $(".account-image-reset").trigger('click');
        $(".error-tab").html('');
        $("#id_jabatan").val(null).trigger('change');
        $(".invalid-feedback").children("strong").text("");
        $("#direksiForm input").removeClass("is-invalid");
        $("#direksiForm select").removeClass("is-invalid");
        $("#direksiForm textarea").removeClass("is-invalid");
        $(".modal-title").html('<i class="bx bx-plus"></i> Form Tambah Susunan Direksi');
        $("#modal_form_direksi").modal('show');
        ajaxUrl = "{{route('save.direksi')}}";
      }, 300);
      setTimeout(function() {
        triggerClickWithJenis('instagram');
        triggerClickWithJenis('facebook');
        triggerClickWithJenis('linkedin');
      }, 300);
    });
  });
  $(function () {
    $('#direksiForm').submit(function (e) {
      e.preventDefault();
      if ($(this).data('submitted') === true) {
        return;
      }
      $(this).data('submitted', true);
      let formData = new FormData(this);
      $(".invalid-feedback").children("strong").text("");
      $("#direksiForm input").removeClass("is-invalid");
      $("#direksiForm select").removeClass("is-invalid");
      $("#direksiForm textarea").removeClass("is-invalid");
      $(".error-tab").html('');
      $("#loading").show();
      $.ajax({
        method: "POST",
        headers: {
          Accept: "application/json"
        },
        contentType: false,
        processData: false,
        url : ajaxUrl,
        data: formData,
        success: function (response) {
          $('#direksiForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#direksiForm")[0].reset();
            $('#modal_form_direksi').modal('hide');
            showToast('bg-primary','Susunan Direksi Success',response.message);
            $('#table_direksi').DataTable().ajax.reload();
          } else {
            showToast('bg-danger','Susunan Direksi Error',response.message);
          }
        },
        error: function (response) {
          $('#direksiForm').data('submitted', false);
          $("#loading").hide();
          if (response.status === 422) {
            let errors = response.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              var key_temp = key.replaceAll(".", "_");
              $("#" + key_temp).addClass("is-invalid");
              $("#" + key_temp + "Error").children("strong").text(errors[key][0]);
              var tab_id = $("#" + key_temp + "Error").closest(".tab-pane").attr("id");
              if (tab_id != undefined) {
                $("#tab_detail").find("[href$='#" + tab_id + "']").find(".error-tab").html("<i class='bx bx-info-circle'></i> Required");
              }
            });
          } else {
            showToast('bg-danger','User Error',response.message);
          }
        }
      });
    });
  });
  function get_edit(direksiID) {
    $.ajax({
      type: "GET",
      url: "{{url('page/company_menu/susunan_direksi/get_edit')}}"+"/"+direksiID,
      success: function(response) {
        global_id_sosmed = 0;
        $("#loading").hide();
        $.each(response.data, function(key, value) {
          $("#id_direksi").val(value.id_direksi);
          $("#nama_direksi").val(value.nama_direksi);
          $("#keterangan").val(value.keterangan);
          $("#uploadLama").val(value.foto_direksi);
          $("#id_jabatan").val(value.id_jabatan).trigger('change');
          $('.img_preview').attr("src","{{asset('susunan_direksi')}}/"+value.foto_direksi);
        });
        $.each(response.sosmed, function(key, value_sosmed) {
          $("#new_sosmed_detail").trigger('click');
        });
        setTimeout(function () {
          $('#table_sosmed_detail tr').each(function (index) {
           $(this).find('span.sn').html(index + 1);
           $(this).find('.id_direksi_sosmed_input').val(response.sosmed[index].id_direksi_sosmed);
           $(this).find('.jenis_input').val(response.sosmed[index].jenis);
           $(this).find('.url_input').val(response.sosmed[index].url);
           $(this).find('.preview_input').attr('hidden',false);
           $(this).find('.preview_input').attr('href',response.sosmed[index].url);
         }); 
        }, 500);
      },
      error: function(response) {
        get_edit(direksiID);
      }
    });
  }
  $(document).on('click','.edit',function() {
    $("#loading").show();
    var direksiID = $(this).attr('more_id');
    $("#direksiForm")[0].reset();
    $(".account-image-reset").hide();
    $(".account-image-reset").trigger('click');
    $(".invalid-feedback").children("strong").text("");
    $("#direksiForm input").removeClass("is-invalid");
    $("#direksiForm textarea").removeClass("is-invalid");
    $("#direksiForm select").removeClass("is-invalid");
    jQuery('.rec').remove();
    $(".error-tab").html('');
    $("#id_jabatan").val(null).trigger('change');
    $(".modal-title").html('<i class="bx bx-edit"></i> Form Ubah Susunan Direksi');
    $("#modal_form_direksi").modal('show');
    ajaxUrl = "{{route('update.direksi')}}";
    if (direksiID) {
      get_edit(direksiID);
    }
  });
  $(document).on('click', '.delete', function (event) {
    direksiID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Susunan Direksi akan dihapus secara Permanent!',
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
          url: "{{url('page/company_menu/susunan_direksi/destroy')}}"+"/"+direksiID,
          success:function(response)
          {
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Susunan Direksi Dihapus',response.message);
                $('#table_direksi').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Susunan Direksi Error',response.message);
            }
          },
          error: function(response) {
            $("#loading").hide();
            showToast('bg-danger','Susunan Direksi Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection