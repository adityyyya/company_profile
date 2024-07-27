        @extends('home/layout/app')

        @section('title','Project')

        @section('content')
        <!-- Projects Section -->
        <div class="page-title dark-background" style="background-image: url('{{asset('home/assets/img/page-title-bg.jpg')}}');">
          <div class="container position-relative">
            <h1>Project</h1>
            <nav class="breadcrumbs">
              <ol>
                <li><a href="javascript:void(0)">Team / Susunan Direksi</a></li>
              </ol>
            </nav>
          </div>
        </div>
        <!-- Projects Section -->
        <section id="projects" class="projects section">
         <div class="container section-title" data-aos="fade-up">
          <h2>Project</h2>
        </div><!-- End Section Title -->
        <div class="container">

          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            </ul><!-- End Portfolio Filters -->

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              @foreach($data as $dt)
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                <div class="portfolio-content h-100">
                  <img src="{{asset('project')}}/{{$dt->image}}" class="img-fluid" alt="">
                  <div class="portfolio-info">
                    <h4>{{$dt->nama_kategori}}</h4>
                    <p>{{$dt->judul}}</p>
                    <a href="{{asset('project')}}/{{$dt->image}}" title="{{$dt->judul}}" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="{{route('project_view',Crypt::encryptString($dt->id_project))}}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div><!-- End Portfolio Item -->
              @endforeach

            </div><!-- End Portfolio Container -->

          </div>

        </div>

      </section><!-- /Projects Section -->
      @endsection
      @section('scripts')
    <script type="text/javascript">
      $(document).ready(function() {
        $("#menu_project").addClass('active');
      });
    </script>
    @endsection