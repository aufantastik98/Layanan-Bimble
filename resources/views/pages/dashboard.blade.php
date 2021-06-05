  @extends('layouts.dashboard')
    
@section('title')
    Store Dashboard
@endsection

    @section('content')
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Dasbor</h2>
                <p class="dashboard-subtitle">Belanja Kamu</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Pelanggan</div>
                        <div class="dashboard-card-subtitle"> {{ number_format($customer) }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Pendapatan</div>
                        <div class="dashboard-card-subtitle">${{ number_format($revenue) }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Transaksi</div>
                        <div class="dashboard-card-subtitle">{{ number_format($transaction_count) }}</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 mt-2">
                    <h5 class="mb-3">Transaksi Terbaru</h5>
                    <a
                      class="card card-list d-block"
                      href="/dashboard-transactions-details.html"
                    >
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img
                              src="/images/dashboard-icon-jadwal-1.png"
                              alt=""
                            />
                          </div>
                          <div class="col-md-4">Gucci</div>
                          <div class="col-md-3">Aufa Dhiya Aydan</div>
                          <div class="col-md-3">2 Oktober, 2020</div>
                          <div class="col-md-1 d-none d-md-block">
                            <img
                              src="/images/dashboard-arrow-right.svg"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                    </a>
                  @foreach ($transaction_data as $transaction)
                    <a
                      class="card card-list d-block"
                      href="{{ route('dashboard-transaction-details', $transaction->id) }}"
                    >
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img
                              src="{{ Storage::url($transaction->jadwal->galleries->first()->fotos ?? '') }}"
                              class="w-75"
                            />
                          </div>
                          <div class="col-md-4"> {{ $transaction->jadwal->name ?? '' }}</div>
                          <div class="col-md-3">{{ $transaction->transaction->user->name ?? '' }}</div>
                          <div class="col-md-3">{{  $transaction->created_at ?? '' }}</div>
                          <div class="col-md-1 d-none d-md-block">
                            <img
                              src="/images/dashboard-arrow-right.svg"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                    </a>
                    @endforeach
        </div>
    </div>
    </div>
</div>
</div>
@endsection