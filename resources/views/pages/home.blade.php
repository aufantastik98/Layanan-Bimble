@extends('layouts.app')

@section('title')
    Store Homepage
@endsection

@section('content')
    <div class="page-content page-home">
        <section class="store-carousel">
        <div class="container">
            <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
                <div
                id="storeCarousel"
                class="carousel slide"
                data-ride="carousel"
                >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img
                        src="/images/posterys.jpg"
                        alt="Carousel Image"
                        class="d-block w-100"
                    />
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Mata Pelajaran</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementCategory = 0 @endphp
                    @forelse ($categories as $category)
                        <div
                            class="col-6 col-md-3 col-lg-2"
                            data-aos="fade-up"
                            data-aos-delay="{{ $incrementCategory+= 100 }}"
                        >
                            <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img
                                    src="{{  Storage::url($category->foto) }}"
                                    alt=""
                                    class="w-100"
                                    />
                                </div>
                                <p class="categories-text">
                                    {{  $category->name }}
                                </p>
                            </a>
                        </div>
                    @empty
                        <div
                            class="col-12 text-center py-5"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                           Tidak Menemukan Layanan
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="store-new-jadwals">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Pilihan Jadwal </h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementJadwal = 0 @endphp
                    @forelse ($jadwals as $jadwal)
                        <div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="{{  $incrementJadwal += 100 }}"
                        >
                            <a href="{{ route('detail', $jadwal->slug) }}" class="component-jadwals d-block">
                                <div class="jadwals-thumbnail">
                                    <div
                                    class="jadwals-image"
                                    style="
                                        @if($jadwal->galleries->count())
                                            background-image: url('{{ Storage::url($jadwal->galleries->first()->fotos) }}');
                                        @else
                                            background-color: #eee;
                                        @endif
                                    "
                                    ></div>
                                </div>
                                <div class="jadwals-text">
                                    {{  $jadwal->name }}
                                </div>
                                <div class="jadwals-price">
                                    ${{ $jadwal->price }}
                                </div>
                            </a>
                        </div>
                    @empty
                        <div
                                class="col-12 text-center py-5"
                                data-aos="fade-up"
                                data-aos-delay="100"
                            >
                                Tidak Menemukan Produk
                            </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection