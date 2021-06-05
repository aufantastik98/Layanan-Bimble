    @extends('layouts.success')
    
@section('title')
    Store Success Page
@endsection

    @section('content')
  <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/images/success.png" alt="" class="mb-4" />
              <h2>Menunggu proses transaksi</h2>
              <p>
                Silahkan untuk mengecek email anda <br />
                Kami akan mengirimkan resi lewat email tersebut
              </p>
              <div>
                <a class="btn btn-success w-50 mt-4" href="/dashboard.html">
                  My Dashboard
                </a>
                <a class="btn btn-signup w-50 mt-2" href="/index.html">
                  Yuk pesan lagi !
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection