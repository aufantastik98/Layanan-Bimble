  @extends('layouts.dashboard')
    
@section('title')
    Store Dashboard Jadwal
@endsection

    @section('content')
                  <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Produk Aku</h2>
                <p class="dashboard-subtitle">Lihat Produkmu</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                    <a
                      href="{{ route('dashboard-jadwal-create') }}"
                      class="btn btn-success"
                      >Tambahkan</a
                    >
                  </div>
                </div>
                <div class="row mt-4">
                   @foreach ($jadwals as $jadwal)
                      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a
                          href="{{ route('dashboard-jadwal-details', $jadwal->id) }}"
                          class="card card-dashboard-jadwal d-block"
                        >
                          <div class="card-body">
                            <img
                              src="{{ Storage::url($jadwal->galleries->first()->fotos ?? '') }}"
                              alt=""
                              class="w-100 mb-2"
                            />
                            <div class="jadwal-title">{{ $jadwal->name }}</div>
                            <div class="jadwal-category">{{ $jadwal->category->name }}</div>
                          </div>
                        </a>
                      </div>
                  @endforeach

                </div>
              </div>
            </div>
          </div>
@endsection