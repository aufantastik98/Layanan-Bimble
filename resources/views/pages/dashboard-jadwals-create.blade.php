  @extends('layouts.dashboard')
    
@section('title')
    Store Dashboard Jadwal Create
@endsection

    @section('content')
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Menambahkan Produk Baru</h2>
                <p class="dashboard-subtitle">Buat Produkmu Sendiri</p>
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
                    <form action="{{ route('dashboard-jadwal-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="name">Nama Produk</label>
                                <input type="text" class="form-control" name="name"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="price">Harga</label>
                                 <input type="number" class="form-control" name="price"/>
                              </div>
                            </div>
                             <div class="col-md-12">
                    <div class="form-group">
                      <label>Layanan</label>
                      <select name="categories_id" class="form-control">
                        @foreach ($categories as $categories)
                          <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <textarea name="description" id="editor"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                                <label for="thumbnails">Thumbnails</label>
                                <input type="file" name="foto" class="form-control" />
                                <small class="text-muted">
                                  Bisa milih lebih dari satu
                                </small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col">
                          <button
                            type="submit"
                            class="btn btn-success btn-block px-5"
                          >
                            Simpan
                          </button>
                        </div>
                      </div>
                    </form>
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
    CKEDITOR.replace("editor");
  </script>
@endpush
