  @extends('page/layout/app')

  @section('title','Data Project')

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
              <li class="breadcrumb-item active" aria-current="page">Project</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Project
          <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block new" >
            <i class="bx bx-plus"></i> Tambah Project
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="table_project" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="1">No. </th>
                  <th data-priority="3">Judul</th>
                  <th data-priority="4">Kategori</th>
                  <th data-priority="5">Tanggal</th>
                  <th data-priority="7">Deskripsi</th>
                  <th data-priority="6">Gambar</th>
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
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_project" tabindex="-1" role="dialog"
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
       <form method="post" id="projectForm" enctype="multipart/form-data">
        @csrf
        @include('page.admin.project.form')
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
  function tanggal_indonesia(dateString) {
    const bulan = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
    ];

    const tanggal = dateString.split('-');
    const hari = tanggal[2];
    const bulanIndex = parseInt(tanggal[1]) - 1;
    const tahun = tanggal[0];

    return `${hari} ${bulan[bulanIndex]} ${tahun}`;
  }
  $(function () {
    $('#table_project').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{route('data.project')}}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_project').DataTable().ajax.reload();
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
        data: 'nama_kategori', 
        name: 'nama_kategori', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'tanggal', 
        name: 'tanggal', 
        render: function (data, type, row) {
          return tanggal_indonesia(data);
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
         if (data.length > 100) {
           var truncatedText = textContent.length > maxLength ? textContent.substring(0, maxLength) + "..." : textContent;
           var readMoreButton = truncatedText+' <a href="javascript:void(0)" class="read-more view" more_id="'+row.id_project+'">Lihat Selengkapnya</a>';
           return readMoreButton;
         }else{
          return textContent;
        }
      }  
    },
    { 
      data: 'image', 
      name: 'image', 
      render: function (data, type, row) {
        return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center"><li data-bs-toggle="tooltip"data-popup="tooltip-custom"data-bs-placement="top" class="avatar avatar-xl pull-up" title="Section"><img src="{{asset('project')}}/'+data+'" alt="Avatar" class="rounded-circle" /></li></ul>';
      }  
    },
    { data: 'action', name: 'action', orderable: false, className: 'space' }
    ]
  });
  });
  // function cek_beranda() {
  //   $.ajax({
  //     type: "GET",
  //     url: "{{route('cek_beranda')}}",
  //     success: function(response) {
  //       if (response.length > 0) {
  //         $(".new").hide();
  //       }else{
  //         $(".new").show();
  //       }
  //     },
  //     error: function(response) {
  //       cek_beranda();
  //     }
  //   });
  // }
  // $(document).ready(function() {
  //   cek_beranda();
  // });
  $("#id_kategori").select2({
    placeholder: ".: PILIH KATEGORI :.",
    dropdownParent: $("#modal_form_project")
  });
  var ajaxUrl = "";
  $(document).ready(function() {
    $(".new").click(function() {
      modal_popup('new');
      $("#loading").show();
      $(".mandatory").text('*');
      setTimeout(function() {
        $("#loading").hide();
        $("#projectForm")[0].reset();
        $("#id_kategori").val(null).trigger('change');
        $(".remove-image").trigger('click');
        CKEDITOR.instances.deskripsi.setData('');
        $(".invalid-feedback").children("strong").text("");
        $("#projectForm input").removeClass("is-invalid");
        $("#projectForm textarea").removeClass("is-invalid");
        $("#projectForm select").removeClass("is-invalid");
        $(".modal-title").html('<i class="bx bx-plus"></i> Form Tambah Project');
        $("#modal_form_project").modal('show');
        ajaxUrl = "{{route('save.project')}}";
      }, 300);
    });
  });
  $(function () {
    $('#projectForm').submit(function (e) {
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
      $("#projectForm input").removeClass("is-invalid");
      $("#projectForm select").removeClass("is-invalid");
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
          $('#projectForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#projectForm")[0].reset();
            $('#modal_form_project').modal('hide');
            showToast('bg-primary','Data Success',response.message);
            $('#table_project').DataTable().ajax.reload();
          } else {
            showToast('bg-danger','Data Error',response.message);
          }
        },
        error: function (response) {
          $('#projectForm').data('submitted', false);
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
  function get_edit(projectID,type=null) {
    $.ajax({
      type: "GET",
      url: "{{url('page/company_menu/project/get_edit')}}"+"/"+projectID,
      success: function(response) {
        $("#loading").hide();
        $.each(response, function(key, value) {
          if (type == 'edit') {
            $("#id_project").val(value.id_project);
            $("#judul").val(value.judul);
            $("#tanggal").val(value.tanggal);
            $("#id_kategori").val(value.id_kategori).trigger('change');
            $("#imageLama").val(value.image);
            CKEDITOR.instances.deskripsi.setData(value.deskripsi);
          }
        });
      },
      error: function(response) {
        get_edit(projectID,'edit');
      }
    });
  }
  $(document).on('click','.edit',function() {
    $("#loading").show();
    modal_popup('edit');
    $(".mandatory").text('');
    $(".remove-image").trigger('click');
    var projectID = $(this).attr('more_id');
    $("#projectForm")[0].reset();
    $("#id_kategori").val(null).trigger('change');
    $(".invalid-feedback").children("strong").text("");
    $("#projectForm input").removeClass("is-invalid");
    $("#projectForm textarea").removeClass("is-invalid");
    $("#projectForm select").removeClass("is-invalid");
    $(".modal-title").html('<i class="bx bx-edit"></i> Form Ubah Project');
    $("#modal_form_project").modal('show');
    ajaxUrl = "{{route('save.project')}}";
    if (projectID) {
      get_edit(projectID,'edit');
    }
  });
  $(document).on('click', '.delete', function (event) {
    projectID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Data Project akan dihapus secara Permanent!',
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
          url: "{{url('page/company_menu/project/destroy/')}}"+"/"+projectID,
          success:function(response)
          {
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Project Dihapus',response.message);
                $('#table_project').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Project Error',response.message);
            }
          },
          error: function(response) {
            $("#loading").hide();
            showToast('bg-danger','Project Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection