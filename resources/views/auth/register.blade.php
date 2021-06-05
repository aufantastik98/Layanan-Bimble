@extends('layouts.auth')

@section('content')
  <div class="page-content page-auth mt-5" id="register">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4">
              <h2>
                Daftarkan segera akunmu <br />
                biar bisa belajar-belajar
              </h2>
               <form class="mt-3" method="POST" action="{{ route('register') }}">
                        @csrf
                <div class="form-group">
                  <label>Nama Akun</label>
                <input 
                                v-model="name"
                                id="name" 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autocomplete="name" 
                                autofocus
                            >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input 
                                v-model="email"
                                @change="checkForEmailAvailability()"
                                id="email" 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                :class="{ 'is-invalid': this.email_unavailable }"
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email"
                            >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group">
                  <label>Kata Sandi</label>
                  <input 
                                id="password" 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" 
                                required 
                                autocomplete="new-password"
                            >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi</label>
                            <input 
                                id="password-confirm" 
                                type="password" 
                                class="form-control @error('password_corfirmation') is-invalid @enderror" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                            >
                             @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group">
                  <label>Kartu Member</label>
                  <p class="text-muted">
                    Apa kamu punya kartu member?
                  </p>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      class="custom-control-input"
                      type="radio"
                      name="is_store_open"
                      id="openStoreTrue"
                      v-model="is_store_open"
                      :value="true"
                    />
                    <label class="custom-control-label" for="openStoreTrue"
                      >Punya</label
                    >
                  </div>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      class="custom-control-input"
                      type="radio"
                      name="is_store_open"
                      id="openStoreFalse"
                      v-model="is_store_open"
                      :value="false"
                    />
                    <label
                      makasih
                      class="custom-control-label"
                      for="openStoreFalse"
                      >Enggak Punya</label
                    >
                  </div>
                </div>
                <div class="form-group" v-if="is_store_open">
                  <label>ID Member</label>
                            <input 
                                v-model="id_member"
                                id="id_member" 
                                type="text" 
                                class="form-control @error('id_member') is-invalid @enderror" 
                                name="id_member" 
                                value="{{ old('id_member') }}" 
                                required 
                                autocomplete="id_member" 
                                autofocus
                            >
                            @error('id_member')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group" v-if="is_store_open">
                  <label>Layanan</label>
                  <select name="categories_id" class="form-control">
                    <option value="" disabled>Select Category</option>
                     @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                  </select>
                </div>
                 <button
                            type="submit"
                            class="btn btn-success btn-block mt-4"
                            :disabled="this.email_unavailable"
                        >
                            Sign Up Sekarang
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                            Kembali Sign In
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
       
        },
        methods: {
            checkForEmailAvailability: function () {
                var self = this;
                axios.get('{{ route('api-register-check') }}', {
                        params: {
                            email: this.email
                        }
                    })
                    .then(function (response) {
                        if(response.data == 'Available') {
                            self.$toasted.show(
                                "Mohon maaf, email anda sudah tersedia!", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = false;
                        } else {
                            self.$toasted.error(
                                "Mohon maaf, email anda sudah terdaftar!", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = true;
                        }
                        // handle success
                        console.log(response.data);
                    })
            }
        },
        data() {
            return {
                name: "Aufa Dhiya Aydan",
                email: "aufa.aydan@gmail.com",
                is_store_open: true,
                id_member: "",
                email_unavailable: false
            }
        },
      });
    </script>
@endpush