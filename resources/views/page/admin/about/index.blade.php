@extends('page/layout/app')

@section('title','Tentang Perusahaan')

@section('content')
<div class="loading" id="loading" style="display: none;">
  <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
  <h4>Loading</h4>
</div>
<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item">
        <a class="nav-link" href="?menu=profil_perusahaan"><i class="bx bx-buildings"></i> Profil Perusahaan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="?menu=tentang_perusahaan"
        ><i class="bx bx-info-circle"></i> Tentang Perusahaan</a
        >
      </li>
    </ul>
    <div class="card mb-4">
      <h5 class="card-header">Tentang Perusahaan</h5>
      <!-- Account -->
      <form id="aboutPerusahaanForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="row">
           <input type="" value="{{ $data->image ?? '' }} " name="imageLama" id="imageLama" hidden="">
           <input type="" value="{{ $data->id_about ?? '' }} " name="id_about" id="id_about" hidden="">
           <div class="col-lg-8">
            <div class="row">
              <div class="mb-3 col-lg-12">
                <label for="lastName" class="form-label">Deskripsi Tentang Perusahaan</label>
                <textarea class="ckeditor" name="deskripsi" id="deskripsi">{{ $data->deskripsi ?? '' }}</textarea>
                <span class="invalid-feedback" role="alert" id="deskripsiError">
                  <strong></strong>
                </span>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label class="col-form-label">Foto/Gambar Perusahaan <span class="text-danger mandatory"></span></label>
                  <div class="file-upload" style="width:100%;">
                    <div class="image-upload-wrap">
                      <input class="file-upload-input" name="image" id="image" type='file' onchange="readURL(this);" accept="image/*" />
                      <div class="drag-text">
                        <h3>Unggah Gambar</h3>
                      </div>
                    </div>
                  </div>
                  <div class="file-upload-content">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <div class="image-title-wrap">
                      <button type="button" onclick="removeUpload()" class="remove-image">Hapus <span class="image-title">Uploaded Gambar</span></button>
                    </div>
                  </div>
                  <span class="invalid-feedback d-block" role="alert" id="imageError">
                    <strong></strong>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            @if(!empty($data))
            <img src="{{asset('about')}}/{{ $data->image}}" class="img img-thumbnail mt-3">
            @endif
          </div>
        </div>
        <div class="mt-2">
          <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i> Simpan</button>
          <button type="reset" class="btn btn-outline-secondary">Reset</button>
        </div>
      </div>
    </form>
    <!-- /Account -->
  </div>
  @if(!empty($data))
  <div class="card">
    <h5 class="card-header">Hapus Data</h5>
    <div class="card-body">
      <div class="mb-3 col-12 mb-0">
        <div class="alert alert-warning">
          <h6 class="alert-heading mb-1">Apakah anda ingin mengahapus Tentang Perusahaan?</h6>
          <p class="mb-0">Tentang Perusahaan saat ini akan dihapus secara permanent.</p>
        </div>
      </div>
      <div class="form-check mb-3">
        <input
        class="form-check-input"
        type="checkbox"
        value="true"
        name="konfirmasi"
        id="konfirmasi" />
        <label class="form-check-label" for="accountActivation"
        >Konfirmasi pengahapusan Menu Tentang Perusahaan</label
        >
      </div>
      <button type="submit" class="btn btn-danger delete"><i class="bx bx-trash"></i> Hapus Akun</button>
    </div>
  </div>
  @endif
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
  var profilPerusahaan = "{{$data}}";
  let ajaxUrl;
  if (profilPerusahaan != '') {
    ajaxUrl = "{{route('update.about')}}";
  }else{
    ajaxUrl = "{{route('save.about')}}";
  }
  $(function () {
    $('#aboutPerusahaanForm').submit(function (e) {
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
      $("#aboutPerusahaanForm input").removeClass("is-invalid");
      $("#aboutPerusahaanForm select").removeClass("is-invalid");
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
          $('#aboutPerusahaanForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#aboutPerusahaanForm")[0].reset();
            $('#modal_form_beranda').modal('hide');
            showToast('bg-primary','Tentang Perusahaan Success',response.message);
            setTimeout(function() {
              document.location.href='';
            }, 500);
          } else {
            showToast('bg-danger','Tentang Perusahaan Error',response.message);
          }
        },
        error: function (response) {
          $('#aboutPerusahaanForm').data('submitted', false);
          $("#loading").hide();
          if (response.status === 422) {
            let errors = response.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              $("#" + key).addClass("is-invalid");
              $("#" + key + "Error").children("strong").text(errors[key][0]);
            });
          } else {
            showToast('bg-danger','Tentang Perusahaan Error',response.message);
          }
        }
      });
    });
  });
  $(document).on('click', '.delete', function (event) {
    if ($("#konfirmasi").prop('checked')) {
      aboutID = "{{ $data->id_about ?? '' }}";
      event.preventDefault();
      Swal.fire({
        title: 'Lanjut Hapus Data?',
        text: 'Tentang Perusahaan akan dihapus secara Permanent!',
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
            url: "{{url('page/company_menu/about/destroy')}}"+"/"+aboutID,
            success:function(response)
            {
              $("#loading").hide();
              if (response.status == 'true') {
                setTimeout(function(){
                  showToast('bg-success','Tentang Perusahaan Dihapus',response.message);
                  setTimeout(function() {
                    document.location.href='';
                  }, 400);
                }, 50);
              }else{
                showToast('bg-danger','Tentang Perusahaan Error',response.message);
              }
            },
            error: function(response) {
              $("#loading").hide();
              showToast('bg-danger','Tentang Perusahaan Error',response.message);
            }
          })
        }
      });
    }else{
      alert('Setujui konfirmasi hapus data.');
    }
  });
</script>
@endsection