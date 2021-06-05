    @extends('layouts.app')
    
@section('title')
    Store Detail Page
@endsection

    @section('content')
    <div class="page-content page-details">
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
                    Rincian Kelas
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="store-gallery mb-3" id="gallery">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img
                  :key="fotos[activeFoto].id"
                  :src="fotos[activeFoto].url"
                  class="w-100 main-image"
                  alt=""
                />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div
                  class="col-3 col-lg-12 mt-2 mt-lg-0"
                  v-for="(foto, index) in fotos"
                  :key="foto.id"
                  data-aos="zoom-in"
                  data-aos-delay="100"
                >
                  <a href="#" @click="changeActive(index)">
                    <img
                      :src="foto.url"
                      class="w-100 thumbnail-image"
                      :class="{ active: index == activeFoto }"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <h1>{{ $jadwal->name }}</h1>
               <div class="owner">By {{ $jadwal->user->id_member }}</div>
                <div class="price">${{ number_format($jadwal->price) }}</div>
              </div>
              <div class="col-lg-2" data-aos="zoom-in">
                @auth
                    <form action="{{ route('detail-add', $jadwal->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <button
                        type="submit"
                        class="btn btn-success px-4 text-white btn-block mb-3"
                      >
                        Tambahkan Keranjang
                      </button>
                    </form>
                @else
                    <a
                      href="{{ route('login') }}"
                      class="btn btn-success px-4 text-white btn-block mb-3"
                    >
                      Sign in untuk Menambahkan
                    </a>
                @endauth
              </div>
            </div>
          </div>
        </section>
        <section class="store-description">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8">
               {!! $jadwal->description !!}
              </div>
            </div>
          </div>
        </section>
        <section class="store-review">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8 mt-3 mb-3">
                <h5> Kata Mereka Tentang Citra Muda</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-8">
                <ul class="list-unstyled">
                  <li class="media">
                    <img
                      src="/images/icon.png"
                      class="mr-3 rounded-circle"
                      alt=""
                    />
                    <div class="media-body">
                      <h5 class="mt-2 mb-1">Aufa (Teknik Komputer UI)</h5>
                     Ikut belajar di Citra Muda membuat aku berhasil masuk PTN, Alhamdulillah. Recommended banget guyss!
                    </div>
                  </li>
                  <li class="media my-4">
                    <img
                      src="/images/icon.png"
                      class="mr-3 rounded-circle"
                      alt=""
                    />
                    <div class="media-body">
                      <h5 class="mt-2 mb-1">Ahya Amaniy (FKM UI)</h5>
                      Gurunya enak dalam menerangkannya. Modul-Modulnya yang diberikan juga mudah dipahami. Mantab.
                    </div>
                  </li>
                  <li class="media">
                    <img
                      src="/images/icon.png"
                      class="mr-3 rounded-circle"
                      alt=""
                    />
                    <div class="media-body">
                      <h5 class="mt-2 mb-1">Ailsa SYaffa (FT UI)</h5>
                    Belajar disini tuh gakerasa kaya lagi dibimble, ramah banget kakak-kakaknya, serta modul yang diberikan terstrukstur dengan baik. Pembelajarannya asik deh pokoknya dan lingkungannya juga sangat baik.
                    </div>
                  </li>
                  <li class="media">
                    <img
                      src="/images/icon.png"
                      class="mr-3 rounded-circle"
                      alt=""
                    />
                    <div class="media-body">
                      <h5 class="mt-2 mb-1">Wisnu Prabowo (Mesin UNJ)</h5>
                    Tentornya ramah sekali, bimbingannya pun sangat asik.
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    @endsection

   @push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activeFoto: 0,
          fotos: [
            @foreach ($jadwal->galleries as $gallery)
            {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->fotos) }}",
            },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activeFoto = id;
          },
        },
      });
    </script>
@endpush