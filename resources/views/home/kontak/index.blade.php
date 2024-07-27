        @extends('home/layout/app')

        @section('title','Kontak')

        @section('content')
        <!-- Projects Section -->
        <div class="page-title dark-background" style="background-image: url('{{asset('home/assets/img/page-title-bg.jpg')}}');">
          <div class="container position-relative">
            <h1>Kontak</h1>
            <nav class="breadcrumbs">
              <ol>
                <li><a href="javascript:void(0)">Kontak</a></li>
              </ol>
            </nav>
          </div>
        </div>
        <!-- Contact Section -->
        <section id="contact" class="contact section">

          <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

              <div class="col-lg-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Alamat</h3>
                  <p>{{$company_name->alamat ?? ''}}</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-lg-3 col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Telepon</h3>
                  <p>{{$company_name->telepon ?? ''}}</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-lg-3 col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email</h3>
                  <p>{{$company_name->email ?? ''}}</p>
                </div>
              </div><!-- End Info Item -->

            </div>

            <div class="row gy-4 mt-1">
              <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <iframe src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q={{$company_name->nama ?? ''}}+{{$company_name->alamat ?? ''}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div><!-- End Google Maps -->

              <div class="col-lg-6">
                <form method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="400" id="pesanForm">
                  @csrf
                  <div class="row gy-4">

                    <div class="col-md-6">
                      <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                      <span class="invalid-feedback" role="alert" id="namaError">
                        <strong></strong>
                      </span>
                    </div>

                    <div class="col-md-6 ">
                      <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                      <span class="invalid-feedback" role="alert" id="emailError">
                        <strong></strong>
                      </span>
                    </div>

                    <div class="col-md-12">
                      <textarea class="form-control" name="isi" id="isi" rows="6" placeholder="Pesan"></textarea>
                      <span class="invalid-feedback" role="alert" id="isiError">
                        <strong></strong>
                      </span>
                    </div>

                    <div class="col-md-12 text-center">
                      <div class="loading">Loading</div>
                      <div class="sent-message"></div>
                      <button type="submit"><i class="fa fa-paper-plane"></i> Kirim Pesan</button>
                    </div>

                  </div>
                </form>
              </div><!-- End Contact Form -->

            </div>

          </div>

        </section><!-- /Contact Section -->
        @endsection
        @section('scripts')
        <script type="text/javascript">
          $(document).ready(function() {
            $("#menu_kontak").addClass('active');
          });
          $(function () {
            $('#pesanForm').submit(function (e) {
              e.preventDefault();
              if ($(this).data('submitted') === true) {
                return;
              }
              $(".loading").show();
              $(".sent-message").hide();
              $(this).data('submitted', true);
              let formData = new FormData(this);
              $(".invalid-feedback").children("strong").text("");
              $("#pesanForm input").removeClass("is-invalid");
              $("#pesanForm textarea").removeClass("is-invalid");
              $.ajax({
                method: "POST",
                headers: {
                  Accept: "application/json"
                },
                contentType: false,
                processData: false,
                url : "{{route('save.kirim_pesan')}}",
                data: formData,
                success: function (response) {
                  $(".loading").hide();
                  $(".sent-message").show();
                  $('#pesanForm').data('submitted', false);
                  if (response.status == 'true') {
                    $("#pesanForm")[0].reset();
                    $(".sent-message").html(response.message);
                  } else {
                    $(".sent-message").html(response.message);
                  }
                },
                error: function (response) {
                  $('#pesanForm').data('submitted', false);
                  $(".loading").hide();
                  if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                      $("#" + key).addClass("is-invalid");
                      $("#" + key + "Error").children("strong").text(errors[key][0]);
                    });
                  } else {
                    $(".sent-message").show();
                    $(".sent-message").html(response.message);
                  }
                }
              });
            });
          });
        </script>
        @endsection