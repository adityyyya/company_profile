  @extends('page/layout/app')

  @section('title','Data Beranda')

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
              <li class="breadcrumb-item active" aria-current="page">Beranda</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Beranda
          <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new" >
            <i class="bx bx-plus"></i> Tambah Data
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="table_beranda" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="1">No. </th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Background Gambar</th>
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
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_beranda" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-white" style="margin-bottom:12px;" id="myModalLabel1">Pesan Pengingat</h5>
        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
       <form method="post" id="berandaForm" enctype="multipart/form-data">
        @csrf
        @include('page.admin.beranda.form')
        @include('page.admin.beranda.view')
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
  .truncate {
    max-width: 200px; /* Sesuaikan sesuai kebutuhan Anda */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
@endsection
@section('scripts')
<script src="{{asset('panel/assets/vendor/libs/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('.image-upload-wrap').hide();
        $('.file-upload-image').attr('src', e.target.result);
        $('.file-upload-content').show();
        $('.image-title').html(input.files[0].name);
      };
      reader.readAsDataURL(input.files[0]);
    } else {
      removeUpload();
    }
  }
  function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
    $("#image").val('');
    $("#image").empty();
  }
  $('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
  });
  function modal_popup(type) {
    if (type == 'new' || type == 'edit') {
      $("#contentForm").show();
      $("#contentView").hide();
      $(".modal-footer").show();
    }else{
      $("#contentForm").hide();
      $("#contentView").show();
      $(".modal-footer").hide();
    }
  }
  $(function () {
    $('#table_beranda').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{route('data.beranda')}}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_beranda').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'judul', 
        name: 'judul', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'deskripsi', 
        name: 'deskripsi', 
        render: function (data, type, row) {
         var div = document.createElement("div");
         div.innerHTML = data;
         var textContent = div.textContent || div.innerText || "";
         var maxLength = 100;
         var truncatedText = textContent.length > maxLength ? textContent.substring(0, maxLength) + "..." : textContent;
         var readMoreButton = truncatedText+' <a href="javascript:void(0)" class="read-more view" more_id="'+row.id_beranda+'">Baca Selengkapnya</a>';
         return readMoreButton;
       }  
     },
     { 
      data: 'image', 
      name: 'image', 
      render: function (data, type, row) {
        return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center"><li data-bs-toggle="tooltip"data-popup="tooltip-custom"data-bs-placement="top" class="avatar avatar-xl pull-up" title="Section"><img src="{{asset('beranda')}}/'+data+'" alt="Avatar" class="rounded-circle" /></li></ul>';
      }  
    },
    { data: 'action', name: 'action', orderable: false, className: 'space' }
    ]
  });
  });
  function cek_beranda() {
    $.ajax({
      type: "GET",
      url: "{{route('cek_beranda')}}",
      success: function(response) {
        if (response.length > 0) {
          $(".new").hide();
        }else{
          $(".new").show();
        }
      },
      error: function(response) {
        cek_beranda();
      }
    });
  }
  $(document).ready(function() {
    cek_beranda();
  });
  var ajaxUrl = "";
  $(document).ready(function() {
    $(".new").click(function() {
      modal_popup('new');
      $("#loading").show();
      $(".mandatory").text('*');
      setTimeout(function() {
        $("#loading").hide();
        $("#berandaForm")[0].reset();
        $(".remove-image").trigger('click');
        CKEDITOR.instances.deskripsi.setData('');
        $(".invalid-feedback").children("strong").text("");
        $("#berandaForm input").removeClass("is-invalid");
        $("#berandaForm textarea").removeClass("is-invalid");
        $(".modal-title").html('<i class="bx bx-plus"></i> Form Menu Beranda');
        $("#modal_form_beranda").modal('show');
        ajaxUrl = "{{route('save.beranda')}}";
      }, 300);
    });
  });
  $(function () {
    $('#berandaForm').submit(function (e) {
      e.preventDefault();
      for (var instanceName in CKEDITOR.instances) {
        CKEDITOR.instances[instanceName].updateElement();
      }
      if ($(this).data('submitted') === true) {
        return;
      }
      $(this).data('submitted', true);
      let formData = new FormData(this);
      $(".invalid-feedback").children("strong").text("");
      $("#berandaForm input").removeClass("is-invalid");
      $("#berandaForm select").removeClass("is-invalid");
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
          cek_beranda();
          $('#berandaForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#berandaForm")[0].reset();
            $('#modal_form_beranda').modal('hide');
            showToast('bg-primary','Data Success',response.message);
            $('#table_beranda').DataTable().ajax.reload();
          } else {
            showToast('bg-danger','Data Error',response.message);
          }
        },
        error: function (response) {
          cek_beranda();
          $('#berandaForm').data('submitted', false);
          $("#loading").hide();
          if (response.status === 422) {
            let errors = response.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              $("#" + key).addClass("is-invalid");
              $("#" + key + "Error").children("strong").text(errors[key][0]);
            });
          } else {
            showToast('bg-danger','Data Error',response.message);
          }
        }
      });
    });
  });
  function get_edit(berandaID,type=null) {
    $.ajax({
      type: "GET",
      url: "{{url('page/company_menu/beranda/get_edit')}}"+"/"+berandaID,
      success: function(response) {
        $("#loading").hide();
        $.each(response, function(key, value) {
          if (type == 'edit') {
            $("#id_beranda").val(value.id_beranda);
            $("#judul").val(value.judul);
            $("#imageLama").val(value.image);
            CKEDITOR.instances.deskripsi.setData(value.deskripsi);
          }else{
            $("#judul_view").html(value.judul);
            $("#deskripsi_view").html(value.deskripsi);
            $("#image_view").html('<img src="{{asset('beranda')}}/'+value.image+'" alt="Background Section" class="img img-thumbnail" />')
          }
        });
      },
      error: function(response) {
        get_edit(berandaID,'edit');
      }
    });
  }
  $(document).on('click','.edit',function() {
    $("#loading").show();
    modal_popup('edit');
    $(".mandatory").text('');
    $(".remove-image").trigger('click');
    var berandaID = $(this).attr('more_id');
    $("#berandaForm")[0].reset();
    $(".invalid-feedback").children("strong").text("");
    $("#berandaForm input").removeClass("is-invalid");
    $("#berandaForm textarea").removeClass("is-invalid");
    $(".modal-title").html('<i class="bx bx-edit"></i> Form Menu Beranda');
    $("#modal_form_beranda").modal('show');
    ajaxUrl = "{{route('update.beranda')}}";
    if (berandaID) {
      get_edit(berandaID,'edit');
    }
  });
  $(document).on('click','.view',function() {
    $("#loading").show();
    modal_popup('view');
    var berandaID = $(this).attr('more_id');
    $(".modal-title").html('<i class="bx bx-list-ul"></i> View Detail');
    $("#modal_form_beranda").modal('show');
    ajaxUrl = "";
    if (berandaID) {
      get_edit(berandaID,'view');
    }
  });
  $(document).on('click', '.delete', function (event) {
    berandaID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Data Menu Beranda akan dihapus secara Permanent!',
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
          url: "{{url('page/company_menu/beranda/destroy/')}}"+"/"+berandaID,
          success:function(response)
          {
            cek_beranda();
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Menu Beranda Dihapus',response.message);
                $('#table_beranda').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Menu Beranda Error',response.message);
            }
          },
          error: function(response) {
            cek_beranda();
            $("#loading").hide();
            showToast('bg-danger','Menu Beranda Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection