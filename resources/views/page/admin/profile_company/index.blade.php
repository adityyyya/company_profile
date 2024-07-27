@extends('page/layout/app')

@section('title','Profil Perusahaan')

@section('content')
<div class="loading" id="loading" style="display: none;">
  <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
  <h4>Loading</h4>
</div>
<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item">
        <a class="nav-link active" href="?menu=profil_perusahaan"><i class="bx bx-buildings"></i> Profil Perusahaan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?menu=tentang_perusahaan"
        ><i class="bx bx-info-circle"></i> Tentang Perusahaan</a
        >
      </li>
    </ul>
    <div class="card mb-4">
      <h5 class="card-header">Profil Perusahaan</h5>
      <!-- Account -->
      <form id="profilPerusahaanForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img
            src="{{ isset($data) && $data->logo ? asset('profil_perusahaan/' . $data->logo) : asset('thumbnail.png') }}"
            alt="user-avatar"
            class="d-block rounded"
            height="100"
            width="100"
            id="uploadedAvatar" />
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload Logo</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input
                type="file"
                id="upload"
                name="logo"
                class="account-file-input"
                hidden
                accept="image/png, image/jpeg" />
              </label>
              <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button>
            </div>
          </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3 col-md-12">
                <input type="" value="{{ $data->logo ?? '' }} " name="logoLama" id="logoLama" hidden="">
                <input type="" value="{{ $data->id_profil ?? '' }} " name="id_profil" id="id_profil" hidden="">
                <label for="firstName" class="form-label">Nama Perusahaan</label>
                <input
                class="form-control"
                type="text"
                id="nama"
                name="nama"
                value="{{ $data->nama ?? '' }}"
                autofocus />
                <span class="invalid-feedback" role="alert" id="namaError">
                  <strong></strong>
                </span>
              </div>
              <div class="mb-3 col-md-12">
                <label for="email" class="form-label">E-mail</label>
                <input
                class="form-control"
                type="email"
                id="email"
                name="email"
                value="{{ $data->email ?? '' }}"
                placeholder="" />
                <span class="invalid-feedback" role="alert" id="emailError">
                  <strong></strong>
                </span>
              </div>
              <div class="mb-3 col-md-12">
                <label for="lastName" class="form-label">Telepon</label>
                <input class="form-control" value="{{ $data->telepon ?? '' }}" type="number" name="telepon" id="telepon" />
                <span class="invalid-feedback" role="alert" id="teleponError">
                  <strong></strong>
                </span>
              </div>
              <div class="mb-3 col-md-12">
                <label for="lastName" class="form-label">Alamat</label>
                <input class="form-control" value="{{ $data->alamat ?? '' }}" type="text" name="alamat" id="alamat" />
                <span class="invalid-feedback" role="alert" id="alamatError">
                  <strong></strong>
                </span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="lastName" class="form-label">Deskripsi Profil Perusahaan</label>
                  <textarea class="ckeditor" name="deskripsi" id="deskripsi">{{ $data->deskripsi ?? '' }}</textarea>
                  <span class="invalid-feedback" role="alert" id="deskripsiError">
                    <strong></strong>
                  </span>
                </div>
              </div>
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
      <h5 class="card-header">Hapus Profil</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading mb-1">Apakah anda ingin mengahapus Profil Perusahaan?</h6>
            <p class="mb-0">Profil Perusahaan saat ini akan dihapus secara permanent.</p>
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
          >Konfirmasi pengahapusan Menu Profil Perusahaan</label
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
<script src="{{asset('panel/assets/js/pages-account-settings-account.js')}}"></script>
<script type="text/javascript">
  var profilPerusahaan = "{{$data}}";
  let ajaxUrl;
  if (profilPerusahaan != '') {
    ajaxUrl = "{{route('update.profil')}}";
  }else{
    ajaxUrl = "{{route('save.profil')}}";
  }
  $(function () {
    $('#profilPerusahaanForm').submit(function (e) {
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
      $("#profilPerusahaanForm input").removeClass("is-invalid");
      $("#profilPerusahaanForm select").removeClass("is-invalid");
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
          $('#profilPerusahaanForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
            $("#profilPerusahaanForm")[0].reset();
            $('#modal_form_beranda').modal('hide');
            showToast('bg-primary','Profil Perusahaan Success',response.message);
            setTimeout(function() {
              document.location.href='';
            }, 500);
          } else {
            showToast('bg-danger','Profil Perusahaan Error',response.message);
          }
        },
        error: function (response) {
          $('#profilPerusahaanForm').data('submitted', false);
          $("#loading").hide();
          if (response.status === 422) {
            let errors = response.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              $("#" + key).addClass("is-invalid");
              $("#" + key + "Error").children("strong").text(errors[key][0]);
            });
          } else {
            showToast('bg-danger','Profil Perusahaan Error',response.message);
          }
        }
      });
    });
  });
  $(document).on('click', '.delete', function (event) {
    if ($("#konfirmasi").prop('checked')) {
      profilID = "{{ $data->id_profil ?? '' }}";
      event.preventDefault();
      Swal.fire({
        title: 'Lanjut Hapus Data?',
        text: 'Profil Perusahaan akan dihapus secara Permanent!',
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
            url: "{{url('page/company_menu/profil/destroy')}}"+"/"+profilID,
            success:function(response)
            {
              $("#loading").hide();
              if (response.status == 'true') {
                setTimeout(function(){
                  showToast('bg-success','Profil Perusahaan Dihapus',response.message);
                  setTimeout(function() {
                    document.location.href='';
                  }, 400);
                }, 50);
              }else{
                showToast('bg-danger','Profil Perusahaan Error',response.message);
              }
            },
            error: function(response) {
              $("#loading").hide();
              showToast('bg-danger','Profil Perusahaan Error',response.message);
            }
          })
        }
      });
    }else{
      alert('Setujui konfirmasi hapus profil');
    }
  });
</script>
@endsection