    @extends('layouts.app')
    
@section('title')
    Store Cart Page
@endsection

    @section('content')
       <div class="page-content page-cart">
      <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Cart
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="store-cart">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table
                class="table table-borderless table-cart"
                aria-describedby="Cart"
              >
                <thead>
                  <tr>
                    <th scope="col">Gambar</th>
                    <th scope="col">Jadwal &amp; Kode Pengajar</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Menu</th>
                  </tr>
                </thead>
                 <tbody>
                  @php $totalPrice = 0 @endphp
                  @foreach ($carts as $cart)
                    <tr>
                      <td style="width: 20%;">
                        @if($cart->jadwal->galleries)
                          <img
                            src="{{ Storage::url($cart->jadwal->galleries->first()->fotos) }}"
                            alt=""
                            class="cart-image"
                          />
                        @endif
                      </td>
                      <td style="width: 35%;">
                        <div class="jadwal-title">{{ $cart->jadwal->name }}</div>
                        <div class="jadwal-subtitle">oleh {{ $cart->jadwal->user->id_member }}</div>
                      </td>
                      <td style="width: 35%;">
                        <div class="jadwal-title">Rp.{{ number_format($cart->jadwal->price) }}</div>
                        <div class="jadwal-subtitle">Free</div>
                      </td>
                      <td style="width: 20%;">
                        <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-remove-cart" type="submit">
                            Hapus
                          </button>
                        </form>
                      </td>
                    </tr>
                    @php $totalPrice += $cart->jadwal->price @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12">
              <h2 class="mb-4">Isi Form Dulu !</h2>
            </div>
          </div>
         <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input
                    type="text"
                    class="form-control"
                    id="alamat"
                    name="alamat"
                    value=""
                  />
                </div>
              </div>
            <div class="col-md-4">
              <div class="form-group">
                  <label for="provinces_id">Provinsi</label>
                  <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id" v-if="provinces">
                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="regencies_id">Kota</label>
                  <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                    <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="zip_code">Kode Pos</label>
                  <input
                    type="text"
                    class="form-control"
                    id="zip_code"
                    name="zip_code"
                    value=""
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Negara</label>
                  <input
                    type="text"
                    class="form-control"
                    id="country"
                    name="country"
                    value="Indonesia"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nomor_WA">Nomor WA</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nomor_WA"
                    name="nomor_WA"
                    value=""
                  />
                </div>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12">
              <h2>Rincian</h2>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-4 col-md-2">
              <div class="jadwal-title">Rp.0</div>
              <div class="jadwal-subtitle">Modul</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="jadwal-title">Rp.0</div>
              <div class="jadwal-subtitle">Fasilitas</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="jadwal-title">Rp.0</div>
              <div class="jadwal-subtitle">Pembelajaran</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="jadwal-title text-success">Rp.{{ number_format($totalPrice ?? 0) }}</div>
              <div class="jadwal-subtitle">Total</div>
            </div>
            <div class="col-8 col-md-3">
              <button
                  type="submit"
                  class="btn btn-success mt-4 px-4 btn-block"
                >
                Checkout 
              </a>
            </div>
          </div>
         </form>
        </div>
      </section>
    </div>
    @endsection

    @push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
              .then(function (response) {
                  self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
              .then(function (response) {
                  self.regencies = response.data;
              })
          },
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
          },
        }
      });
    </script>
@endpush