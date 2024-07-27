  @extends('page/layout/app')

  @section('title','Pesan Masukkan')

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
              <li class="breadcrumb-item active" aria-current="page">Pesan & Masukkan</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-header">
          Data Pesan & Masukkan
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="table_saranmasukan" style="width: 100%;">
              <thead>
                <tr>
                  <th data-priority="1">No. </th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Deskripsi</th>
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
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_pesan" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
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
        <div class="row" id="contentView" style="color: #000;">
          <div class="col-lg-4">
            <label class="col-form-label">Nama</label>
          </div>
          <div class="col-lg-1">:</div>
          <div class="col-lg-7">
            <div class="form-group">
              <span id="nama_view"></span>
            </div>
          </div>
          <div class="col-lg-4">
            <label class="col-form-label">Email</label>
          </div>
          <div class="col-lg-1">:</div>
          <div class="col-lg-7">
            <div class="form-group">
              <span id="email_view"></span>
            </div>
          </div>
         <div class="col-lg-4">
            <label class="col-form-label">Isi</label>
          </div>
          <div class="col-lg-1">:</div>
          <div class="col-lg-7">
            <div class="form-group">
              <span id="deskripsi_view"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">
          <span>Tutup</span>
        </button>
      </div>
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
<script type="text/javascript">
  $(function () {
    $('#table_saranmasukan').DataTable({
      processing: true,
      pageLength: 10,
      responsive: true,
      colReorder: true,
      responsive: true,
      ajax: {
        url: "{{route('index.pesan_masukkan')}}",
        error: function (jqXHR, textStatus, errorThrown) {
          $('#table_saranmasukan').DataTable().ajax.reload();
        }
      },
      columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex'},
      { 
        data: 'nama', 
        name: 'nama', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'email', 
        name: 'email', 
        render: function (data, type, row) {
          return data;
        }  
      },
      { 
        data: 'isi', 
        name: 'isi', 
        render: function (data, type, row) {
         var div = document.createElement("div");
         div.innerHTML = data;
         var textContent = div.textContent || div.innerText || "";
         var maxLength = 100;
         if (data.length > 100) {
           var truncatedText = textContent.length > maxLength ? textContent.substring(0, maxLength) + "..." : textContent;
           var readMoreButton = truncatedText+' <a href="javascript:void(0)" class="read-more view" more_id="'+row.id_pesan+'">Lihat Selengkapnya</a>';
           return readMoreButton;
         }else{
          return textContent;
        }
      }  
    },
    { data: 'action', name: 'action', orderable: false, className: 'space' }
    ]
  });
  });
  var ajaxUrl = "";
  function get_edit(pesanID) {
    $.ajax({
      type: "GET",
      url: "{{url('page/pesan_masukkan/get_view')}}"+"/"+pesanID,
      success: function(response) {
        $("#loading").hide();
        $.each(response, function(key, value) {
          $("#nama_view").html(value.nama);
          $("#email_view").html(value.email);
          $("#deskripsi_view").html(value.isi);
        });
      },
      error: function(response) {
        get_edit(pesanID);
      }
    });
  }
  $(document).on('click','.view',function() {
    $("#loading").show();
    var pesanID = $(this).attr('more_id');
    $(".modal-title").html('<i class="bx bx-list-ul"></i> View Detail');
    $("#modal_form_pesan").modal('show');
    ajaxUrl = "";
    if (pesanID) {
      get_edit(pesanID);
    }
  });
  $(document).on('click', '.delete', function (event) {
    pesanID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
      title: 'Lanjut Hapus Data?',
      text: 'Data akan dihapus secara Permanent!',
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
          url: "{{url('page/pesan_masukkan/destroy')}}"+"/"+pesanID,
          success:function(response)
          {
            $("#loading").hide();
            if (response.status == 'true') {
              setTimeout(function(){
                showToast('bg-success','Data Dihapus',response.message);
                $('#table_saranmasukan').DataTable().ajax.reload();         
              }, 50);
            }else{
              showToast('bg-danger','Data Error',response.message);
            }
          },
          error: function(response) {
            $("#loading").hide();
            showToast('bg-danger','Data Error',response.message);
          }
        })
      }
    });
  });
</script>
@endsection