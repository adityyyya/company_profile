 <div class="row" id="contentForm">
  <div class="col-12">
    <div class="form-group">
      <label class="col-form-label">Judul <span class="text-danger">*</span></label>
      <input type="" hidden="" id="id_berita" name="id_berita">
      <input type="text" class="form-control" id="judul" name="judul">
      <span class="invalid-feedback" role="alert" id="judulError">
        <strong></strong>
      </span>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <label class="col-form-label">Tanggal <span class="text-danger">*</span></label>
      <input type="date" class="form-control" id="tanggal" name="tanggal">
      <span class="invalid-feedback" role="alert" id="tanggalError">
        <strong></strong>
      </span>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <label class="col-form-label">Deskripsi <span class="text-danger">*</span></label>
      <textarea class="ckeditor" id="deskripsi" name="deskripsi"></textarea>
      <span class="invalid-feedback" role="alert" id="deskripsiError">
        <strong></strong>
      </span>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <label class="col-form-label">Foto/Gambar <span class="text-danger mandatory"></span></label>
      <input type="" hidden="" id="imageLama" name="imageLama">
      <div class="file-upload" style="width:100%;">
        <div class="image-upload-wrap">
          <input class="file-upload-input" name="image" id="image" type='file' onchange="readURL(this);" accept="image/*" />
          <div class="drag-text">
            <h3>Unggah File Image</h3>
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