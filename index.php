<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, target-densitydpi=device-dpi" />
  <title>SIPRODAK</title>
  <link rel="icon" type="image/png" href="images/favicon.jpg" />
  <link rel="stylesheet" href="assets/frontend/css/main.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    .hidden {
      display: none;
    }
  </style>
</head>

<body>
  <!--============================
        PRELOADER START
    ==============================-->
  <!-- <div class="preloader_container" id="preloader">
    <div class="spinner"></div>
  </div> -->
  <!--============================
        PRELOADER END
    ==============================-->
  <!--============================
        MAIN MANU START
    ==============================-->
  <nav class="navbar navbar-expand-lg tf__main_menu">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">SIPRODAK</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
        <i class="far fa-times close_icon_close"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#hero">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#service">Manfaat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#cara">Cara</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tpi">Tempat TPI</a>
          </li>
        </ul>
        <ul class="tf__menu_btn d-flex flex-wrap align-items-center">
          <li><a href="login.php" class="tf__menu_2nd_btn">Log in</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--HERO-->
  <section class="tf__banner pt_160" id="hero">
    <div class="container">
      <div class="row">
        <div class="col-xl-7 m-auto">
          <div class="tf__banner_text">
            <h1>SIPRODAK TPI</h1>
            <p>
              Meningkatkan Pemantauan dan
              <br />
              Pengelolaan Data Produksi Ikan di Kabupaten Tuban
            </p>
          </div>
        </div>
      </div>
      <div class="container" style="padding: 10px;">
        <div class="row">
          <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
              </ol>
              <div class="carousel-inner" style="border-radius: 15px;">
                <div class="carousel-item active">
                  <img src="assets/frontend/images/TPI/kantor1.jpg" class="d-block w-100" alt="banner img 1">
                </div>
                <div class="carousel-item">
                  <img src="assets/frontend/images/TPI/bulu.jpg" class="d-block w-100" alt="banner img 2">
                </div>
                <div class="carousel-item">
                  <img src="assets/frontend/images/TPI/plaza.jpg" class="d-block w-100" alt="banner img 3">
                </div>
                <div class="carousel-item">
                  <img src="assets/frontend/images/TPI/tpi3.jpg" class="d-block w-100" alt="banner img 3">
                </div>
                <div class="carousel-item">
                  <img src="assets/frontend/images/TPI/tpi6.jpg" class="d-block w-100" alt="banner img 3">
                </div>
                <div class="carousel-item">
                  <img src="assets/frontend/images/TPI/tpi9.jpg" class="d-block w-100" alt="banner img 3">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--MANFAAT-->
  <section class="tf__service" id="service">
    <div class="tf__main_service pt_100 ml_70 mr_70 pb_75">
      <div class="container">
        <div class="row">
          <div class="col-xl-8 col-md-8 m-auto">
            <div class="tf__common_heading">
              <h6><span style="color: #ffca18;">MANFAAT</h6>
              <h2>MANFAAT SIPRODAK TPI</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12">
            <div class="row">
              <div class="col-xl-4 col-md-6 mb-4" style="align-items: center;">
                <div class="tf__single_service">
                  <span style="background-color: #ffca18;"><i class="fa-solid fa-check-double"></i></span>
                  <a class="tf__single_service_link">Meningkatkan akurasi
                    dan kelengkapan data</a>
                  <p>SIPRODAK TPI memungkinkan pengumpulan data produksi
                    ikan secara real-time dan terpusat, sehingga dapat
                    meningkatkan akurasi dan kelengkapan data.</p>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="tf__single_service">
                  <span style="background-color: #ffca18;"><i class="fa-solid fa-chart-simple"></i></span>
                  <a class="tf__single_service_link">Meningkatkan efisiensi
                    pengelolaan data:</a>
                  <p>SIPRODAK TPI mengotomatisasi proses pengumpulan dan
                    pengelolaan data produksi ikan, sehingga dapat menghemat
                    waktu dan sumber daya.</p>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="tf__single_service">
                  <span style="background-color: #ffca18;"><i class="fa-solid fa-chart-line"></i></span>
                  <a class="tf__single_service_link">Mempermudah
                    Analisis:</a>
                  <p>Fitur ini emungkinkan analisis data yang mendalam untuk
                    memahami tren dan pola produksi ikan.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--PENGERTIAN APLIKASI-->
  <section class="tf__benefits">
    <div class="tf___main_benefits pt_100 pb_100">
      <div class="container">
        <div class="row">
          <div class="col-xl-5 m-auto">
            <div class="tf__common_heading tf__common_heading2 tf__benefits_heading">
              <h6 style="color: #ffca18;">Pengertian</h6>
              <h2 class="tf__common_heading_color">
                Apa itu SIPRODAK TPI?
              </h2>
              <p>
                SIPRODAK TPI, singkatan dari Sistem Informasi Pelaporan
                Data Produksi Ikan di Tempat Pelelangan Ikan, adalah
                aplikasi web yang memungkinkan pengumpulan data produksi
                ikan secara real-time dan terpusat. Data yang dikumpulkan
                meliputi jenis ikan, jumlah ikan, harga jual, dan tanggal
                transaksi.
              </p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-5 mx-auto">
            <div class="tf__team_img">
              <img src="assets/frontend/images/TPI/tpi1.jpg" alt="team img" class="img-fluid w-100" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--FITUR UTAMA-->
  <section class="tf__team pb_95">
    <div class="container">
      <div class="row">
        <div class="col-xl-4 col-lg-5 mx-auto">
          <div class="tf__team_img">
            <img src="assets/frontend/images/TPI/tpi8.jpg" alt="team img" class="img-fluid w-100" />
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 mx-auto">
          <div class="tf__common_heading tf__common_heading2">
            <h6 style="color: #ffca18;">SIPRODAK TPI</h6>
            <h2 class="tf__common_heading_color">
              Fitur Utama SIPRODAK TPI:
            </h2>
            <p>
              1.Modul Pelaporan Produksi Ikan: Memungkinkan petugas TPI
              untuk melaporkan data produksi ikan secara
              real-time.<br />
              2.Mempermudah Analisis: Fitur ini memungkinkan analisis data
              yang mendalam untuk memahami tren dan pola
              produksi ikan.<br />
              3.Modul Pemantauan Produksi Ikan: Memungkinkan Dinas Perikanan
              dan Kelautan untuk memantau data produksi
              ikan secara real-time melalui grafik, tabel, dan peta.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--CARA PENGGUNAAN-->
  <section class="tf__work_process pt_20 pb_25" id="cara">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 m-auto">
          <div class="tf__common_heading">
            <h6 style="color: #ffca18;">CARA PENGGUNAAN</h6>
            <h2 class="tf__common_heading_color">APLIKASI SIPRODAK TPI</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-5 col-lg-6 m-auto">
          <div class="tf__work_process_img">
            <img src="assets/frontend/images/work_img-1.jpg" alt="process" class="img-fluid w-100" />
          </div>
        </div>
        <div class="col-xl-4 col-lg-5 mx-auto">
          <div class="tf__process_accordion">
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne01">
                  <button class="accordion-button tf__process_accordion_btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne01" aria-expanded="true" aria-controls="collapseOne01">
                    <span style="background-color: #ffca18;">1</span>
                    BUKA LINK
                  </button>
                </h2>
                <div id="collapseOne01" class="accordion-collapse collapse show" aria-labelledby="headingOne01"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>
                      Akses Link SIPRODAK dengan Browser yang Tersedia
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo02">
                  <button class="accordion-button collapsed tf__process_accordion_btn" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseTwo02" aria-expanded="false"
                    aria-controls="collapseTwo02">
                    <span style="background-color: #ffca18;">2</span>
                    PILIH TEMPAT TPI
                  </button>
                </h2>
                <div id="collapseTwo02" class="accordion-collapse collapse" aria-labelledby="headingTwo02"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>
                      Admin atau Pengelola Dapat Memilih Lokasi TPI yang
                      Sesuai dengan Tempat Kerja Mereka.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree03">
                  <button class="accordion-button collapsed tf__process_accordion_btn" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseThree03" aria-expanded="false"
                    aria-controls="collapseThree03">
                    <span style="background-color: #ffca18;">3</span>
                    MENGISI FORM
                  </button>
                </h2>
                <div id="collapseThree03" class="accordion-collapse collapse" aria-labelledby="headingThree03"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>
                      Admin atau Pengelola dapat Menyelesaikan Pengisian
                      Formulir
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <a href="https://www.youtube.com/watch?v=B-ytMSuwbf8" class="tf__common_btn play_btn">How It Works <i
              class="fa-sharp fa-regular fa-circle-play"></i></a> -->
        </div>
      </div>
    </div>
  </section>
  <!--TPI-->
  <!--FOOTER-->
  <section class="tf__footer">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-12 col-sm-12 col-md-3 d-flex justify-content-center">
          <a class="navbar-brand" href="index.html" style="color: black; font-weight: 800;">SIPRODAK</a>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-12 d-flex justify-content-center">
          <div class="tf__copyright mt-4 mb-3">
            <p>© 2024 SIPRODAK. All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--jquery library js-->
  <script src="assets/frontend/js/plugin.js"></script>
  <!--main js-->
  <script src="assets/frontend/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>