  @extends('layouts.dashboard')
    
@section('title')
    Store Dashboard Transaction
@endsection

    @section('content')
              <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">#{{ $transaction->code }}</h2>
                <p class="dashboard-subtitle">Rincian Transaksi</p>
              </div>
              <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-md-4">
                           <img
                    src="{{ Storage::url($transaction->jadwal->galleries->first()->fotos ?? '') }}"
                    class="w-100 mb-3"
                    alt=""
                  />
                          </div>
                          <div class="col-12 col-md-8">
                            <div class="row">
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Nama Pelanggan</div>
                                 <div class="jadwal-subtitle">{{ $transaction->transaction->user->name }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Nama Produk</div>
                                <div class="jadwal-subtitle"> {{ $transaction->jadwal->name }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">
                                  Tanggal Transaksi
                                </div>
                                <div class="jadwal-subtitle">
                                  {{ $transaction->created_at }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Status Pembayaran</div>
                                <div class="jadwal-subtitle text-danger">
                                 {{ $transaction->transaction->transaction_status }}
                      </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Total</div>
                                <div class="jadwal-subtitle">  ${{ number_format($transaction->transaction->total_price) }}
                      </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Nomor WA</div>
                                <div class="jadwal-subtitle">
                                  {{ $transaction->transaction->user->nomor_WA }}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                       <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                        <div class="row">
                          <div class="col-12 mt-4">
                            <h5>Informasi Pengiriman</h5>
                            <div class="row">
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Alamat</div>
                                <div class="jadwal-subtitle"> {{ $transaction->transaction->user->alamat }}
                        </div>
                              </div>
                               <div class="col-12 col-md-6">
                                <div class="jadwal-title">Provinsi</div>
                                <div class="jadwal-subtitle">{{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                        </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Kota</div>
                                <div class="jadwal-subtitle"> {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                        </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Kode Post</div>
                                <div class="jadwal-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                               </div>
                              <div class="col-12 col-md-6">
                                <div class="jadwal-title">Negara</div>
                                <div class="jadwal-subtitle">{{ $transaction->transaction->user->country }}</div>
                              </div>
                               <div class="col-12 col-md-3">
                        <div class="jadwal-title">Status Pengiriman</div>
                        <select
                          name="shipping_status"
                          id="status"
                          class="form-control"
                          v-model="status"
                        >
                          <option value="PENDING">Menunggu</option>
                          <option value="SHIPPING">Mengirim</option>
                          <option value="SUCCESS">Sukses</option>
                        </select>
                      </div>
                                 <template v-if="status == 'SHIPPING'">
                        <div class="col-md-3">
                          <div class="jadwal-title">Input Resi</div>
                          <input
                            type="text"
                            class="form-control"
                            name="resi"
                            v-model="resi"
                          />
                        </div>
                        <div class="col-md-2">
                          <button
                            type="submit"
                            class="btn btn-success btn-block mt-4"
                          >
                            Update Resi
                          </button>
                        </div>
                      </template>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-12 text-right">
                    <button
                      type="submit"
                      class="btn btn-success btn-lg mt-4"
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
</div>
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script>
    var transactionDetails = new Vue({
      el: "#transactionDetails",
      data: {
        status: "{{ $transaction->shipping_status }}",
        resi: "{{ $transaction->resi }}",
      },
    });
  </script>
@endpush