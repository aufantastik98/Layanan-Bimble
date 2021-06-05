  @extends('layouts.dashboard')
    
@section('title')
    Store Dashboard Jadwal Detail
@endsection

    @section('content')
<div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Gucci</h2>
                <p class="dashboard-subtitle">
                  Rincian Kelas
                </p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                 @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <form action="{{ route('dashboard-jadwal-update', $jadwal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nama Produk</label>
                      <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $jadwal->name }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Harga</label>
                      <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="{{ $jadwal->price }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Layanan</label>
                      <select name="categories_id" class="form-control">
                        <option value="{{ $jadwal->categories_id }}">Tidak diganti ({{ $jadwal->category->name }})</option>
                        @foreach ($categories as $categories)
                          <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" id="editor">{!! $jadwal->description !!}</textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button
                      type="submit"
                      class="btn btn-success px-5 btn-block"
                    >
                      Simpan
                    </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
               <div class="row mt-2">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                @foreach ($jadwal->galleries as $gallery)
                  <div class="col-md-4">
                    <div class="gallery-container">
                      <img
                        src="{{ Storage::url($gallery->fotos ?? '') }}"
                        alt=""
                        class="w-100"
                      />
                      <a href="{{ route('dashboard-jadwal-gallery-delete', $gallery->id) }}" class="delete-gallery">
                        <img src="/images/icon-delete.svg" alt="" />
                      </a>
                    </div>
                  </div>
                @endforeach
                <div class="col-12">
                  <form action="{{ route('dashboard-jadwal-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $jadwal->id }}" name="jadwals_id">
                    <input
                      type="file"
                      name="fotos"
                      id="file"
                      style="display: none;"
                      multiple
                      onchange="form.submit()"
                    />
                    <button
                      type="button"
                      class="btn btn-secondary btn-block mt-3"
                      onclick="thisFileUpload()"
                    >
                      Tambahkan Foto
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /#page-content-wrapper -->
      </div>
    </div>
    @endsection

@push('addon-script')
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
  <script>
    CKEDITOR.replace("editor");
  </script>
@endpush
