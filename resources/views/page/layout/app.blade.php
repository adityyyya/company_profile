<!DOCTYPE html>
<html
lang="en"
class="light-style layout-menu-fixed layout-compact"
dir="ltr"
data-theme="theme-default">
<head>
  <?php  
  $profil_company = App\Models\Page\ProfileCompany::first();
  ?>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | {{$profil_company->nama ?? ''}}</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('profil_perusahaan')}}/{{$profil_company->logo ?? ''}}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet" />

  <!-- datatable -->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
  <!-- <link href="{{asset('panel/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"> -->
  <!-- <link href="{{asset('panel/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet"> -->
  <!-- <link href="{{asset('panel/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet"> -->
  <link href="{{asset('panel/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
  <!-- <link href="{{asset('panel/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <!--  -->
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/css/custom.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{asset('panel/assets/css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{asset('panel/assets/vendor/libs/apex-charts/apex-charts.css')}}" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">

  <!-- Helpers -->
  <script src="{{asset('panel/assets/vendor/js/helpers.js')}}"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('panel/assets/js/config.js')}}"></script>
  </head>
  <style type="text/css">
   .modal-loading {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 9999;
    visibility: hidden;
  }
  .modal-body {
    position: relative;
  }
  .modal.show .modal-loading {
    visibility: visible;
  }
  #loading {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.5);
    z-index: 9999;
    text-align: center;
  }
  @media (min-width: 801px) {
    #loading{
      padding-top: 20%;
    }
  }
  @media (max-width: 800px) {
    #loading{
      padding-top: 80%;
    }
  }
  #loading_page {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.5);
    z-index: 9999;
    text-align: center;
  }
  @media (min-width: 801px) {
    #loading_page{
      padding-top: 20%;
    }
    #header_notifikasi{
      width: 350px;
    }
    #header_cabang{
      width: 400px;
    }

  }
  @media (max-width: 800px) {
    #loading_page{
      padding-top: 80%;
    }
  }
  .swal2-container {
    z-index: 99999; /* Sesuaikan dengan z-index yang Anda butuhkan */
  }
  .select2-hidden-accessible + .select2-container .select2-selection {
    height: 36px;
    padding-top: 2px;
  }
  .select2-hidden-accessible + .select2-container .select2-selection__arrow, .select2-hidden-accessible + .select2-container .select2-selection_clear{
    height: 40px;
  }
  select[readonly].select2-hidden-accessible + .select2-container {
    pointer-events: none;
    touch-action: none;
  }
  select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
    background: #e8ebed;
    box-shadow: none;
  }

  select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection_clear {
    display: none;
  }
  .is-invalid:valid + .select2 .select2-selection{
    border-color: #dc3545!important;
  }
  *:focus{
    outline:0px;
  }
  .file-upload {
    background-color: #ffffff;
    width: 600px;
    margin: 0 auto;
    padding: 20px;
  }

  .file-upload-btn {
    width: 100%;
    margin: 0;
    color: #fff;
    background: #1FB264;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #15824B;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
  }

  .file-upload-btn:hover {
    background: #1AA059;
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
  }

  .file-upload-btn:active {
    border: 0;
    transition: all .2s ease;
  }

  .file-upload-content {
    display: none;
    text-align: center;
  }

  .file-upload-input {
    position: absolute;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    outline: none;
    opacity: 0;
    cursor: pointer;
  }

  .image-upload-wrap {
    /*margin-top: 20px;*/
    border: 4px dashed #4540f7;
    position: relative;
  }

  .image-dropping,
  .image-upload-wrap:hover {

  }

  .image-title-wrap {
    padding: 0 15px 15px 15px;
    color: #222;
  }

  .drag-text {
    text-align: center;
  }

  .drag-text h3 {
    font-weight: 100;
    text-transform: uppercase;
    color: grey;
    padding: 60px 0;
  }

  .file-upload-image {
    max-width: 500px;
    /*width: auto;*/
    max-height: auto;
    margin: auto;
    padding: 20px;
  }

  .remove-image {
    width: 200px;
    margin: 0;
    color: #fff;
    background: #cd4535;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #b02818;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
  }

  .remove-image:hover {
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
  }

  .remove-image:active {
    border: 0;
    transition: all .2s ease;
  }
</style>
@yield('css')
<body>
  <div class="loading_page" id="loading_page" style="display: none;text-align: center;">
  </div>
  <div
  class="bs-toast toast toast-placement-ex m-2"
  role="alert"
  aria-live="assertive"
  aria-atomic="true"
  data-bs-delay="2000">
  <div class="toast-header">
    <i class="bx bx-bell me-2"></i>
    <div class="me-auto fw-medium" id="titleText"></div>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body" id="messageText"></div>
</div>
<select class="form-select placement-dropdown" hidden="" id="selectPlacement">
  <option value="top-0 end-0">Top right</option>
</select>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      @include('page/layout/sidebar')
    </aside>
    <!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->

      <nav
      class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
      id="layout-navbar">
      @include('page.layout.header')
    </nav>

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-lg-12 mb-4 order-0">
            @yield('content')
            <div class="modal text-left" data-bs-backdrop="static" id="my_profil" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
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
                  <form method="post" id="profilForm" action="{{route('edit_profil')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      @if(Auth::user()->level == 'Admin')
                      <div class="col-12">
                        <div class="form-group">
                          <label>Nama <span class="text-danger">*</span></label>
                          <input type="text" value="{{Auth::user()->name}}" required="" class="form-control" id="name_profil" name="name_profil">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Email <span class="text-danger">*</span></label>
                          <input type="text" value="{{Auth::user()->email}}" required="" class="form-control" id="email_profil" name="email_profil">
                        </div>
                      </div>
                      @endif
                      <div class="col-12">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="text" class="form-control" id="password_profil" name="password_profil">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                      <span>Tutup</span>
                    </button>
                    <button class="btn btn-primary ml-1 submit">
                      <i class="bx bx-edit"></i> <span>Ubah</span>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
      @include('page.layout.footer')
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

   <!--  <div class="buy-now">
      <a
      href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/"
      target="_blank"
      class="btn btn-danger btn-buy-now"
      >Upgrade to Pro</a
      >
    </div> -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{asset('panel/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('panel/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('panel/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('panel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('panel/assets/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('panel/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{asset('panel/assets/js/ui-popover.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('panel/assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
    <script src="{{asset('panel/assets/js/main.js')}}"></script>
    <script src="{{asset('panel/assets/js/custom.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page JS -->
    <script src="{{asset('panel/assets/js/dashboards-analytics.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js')}}"></script>
    <!-- datatable -->
    <script src="{{asset('panel/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('panel/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('panel/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
  </body>
  <script type="text/javascript">
   $(document).ready(function() {
    $(".btn_profil").click(function() {
      $(".modal-title").html('<i class="bx bx-user"></i> Profil');
      $("#my_profil").modal('show');
    });
  });
</script>
@yield('scripts')
</html>
