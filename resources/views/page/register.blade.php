<!DOCTYPE html>
<?php  
$profil_company = App\Models\Page\ProfileCompany::first();
?>
<html
lang="en"
class="light-style layout-wide customizer-hide"
dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>REGISTER AKUN</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('logo-true.jpeg')}}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet" />

  <link rel="stylesheet" href="{{asset('panel/assets/vendor/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{asset('panel/assets/css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/css/pages/page-auth.css')}}" />

  <!-- Helpers -->
  <script src="{{asset('panel/assets/vendor/js/helpers.js')}}"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js')}} in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('panel/assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="authentication-wrapper container-p-y">
            <div class="authentication-inner">
              <!-- Register -->
              <div class="card">
                <div class="card-body">
                  <!-- Logo -->
                  <div class="app-brand justify-content-center">
                    <a href="" class="app-brand-link gap-2">
                      <span class="app-brand-text demo text-body fw-bold" style="text-transform: uppercase;">{{$profil_company->nama ?? ''}}</span>
                    </a>
                  </div>
                  <!-- /Logo -->
                  <p class="mb-4 text-center">Daftar Akun | Lengkapi form akun dibawah ini dengan benar.</p>

                  <form id="registerForm" class="mb-3">
                    @csrf
                    <div class="row">
                     <div class="col-lg-12 mb-3">
                      <label for="email" class="form-label">Nama</label>
                      <input type="text" class="form-control" id="" required="" name="name" placeholder="Nama" />
                    </div>
                    <div class="col-lg-12 mb-3 form-password-toggle">
                      <label for="email" class="form-label">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" required name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input
                      type="email"
                      class="form-control"
                      id=""
                      required
                      name="email"
                      placeholder="Email"/>
                    </div>
                    <div class="col-lg-12 mb-3">
                      <label for="email" class="form-label">NIK</label>
                      <input type="number" required="" class="form-control" id="" name="nik"/>
                      <div class="d-flex justify-content-between mt-3">
                        <a href="{{route('login')}}">
                          Sudah punya akun?<small> Login</small>
                        </a>
                      </div>
                    </div>
                    <div class="mt-3">
                      <button class="btn btn-primary w-100 register" type="submit">DAFTAR <span class="text submit_register"></span></button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
      </div>
      <div class="col-lg-2"></div>
    </div>
  </div>

  <!-- / Content -->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js')}} -->

  <script src="{{asset('panel/assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{asset('panel/assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{asset('panel/assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{asset('panel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('panel/assets/vendor/js/menu.js')}}"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="{{asset('panel/assets/js/main.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
<script type="text/javascript">
 $(function () {
  $('#registerForm').submit(function (e) {
    e.preventDefault();
    if ($(this).data('submitted') === true) {
      return;
    }
    $(this).data('submitted', true);
    let formData = new FormData(this);
    $(".submit_register").html('<div class="spinner-border spinner-border-sm" role="status"></div>');
    $(".register").attr('disabled',true);
    $.ajax({
      method: "POST",
      headers: {
        Accept: "application/json"
      },
      contentType: false,
      processData: false,
      url : "{{route('register.akun')}}",
      data: formData,
      success: function (response) {
        $('#registerForm').data('submitted', false);
        $(".submit_register").html('');
        $(".register").attr('disabled',false);

        if (response.status == 'true') {

          $("#registerForm")[0].reset();
          Swal.fire({
            title: 'Register Success',
            text: response.message,
            icon: 'success',
            type: 'success'
          }).then((result) => {
            if (result.isConfirmed) {
              document.location.href = "{{route('login')}}";
            }
          });
        } else {
         Swal.fire({
          title: 'Register Error',
          text: response.message,
          icon: 'error',
          type: 'error'
        });
       }
     },
     error: function (response) {
      $('#registerForm').data('submitted', false);
      $(".submit_register").html('');
      $(".register").attr('disabled',false);
      Swal.fire({
        title: 'Register Error',
        text: response.message,
        icon: 'error',
        type: 'error'
      });
    }
  });
  });
});
</script>
</html>
