<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{Fungsi::app_nama()}}</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <link href="{{ asset('/') }}assets/vendor/aos/aos.css" rel="stylesheet"> -->
    <!-- <link href="{{ asset('/') }}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="{{ asset('/') }}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <!-- <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> -->
    <link href="{{ asset('/') }}assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/landing.css">
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/baemon.css">
</head>

<body>

  <div id="app">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="{{url('/')}}">{{Fungsi::app_nama()}}</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      {{-- <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active" href="index.html">Beranda</a></li>
          <li class="dropdown"><a href="#"><span>Portofolio</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li class="dropdown"><a href="#"><span>Website</span> <i class="bi bi-chevron-right"></i></a>
                  <ul>
                    <li><a href="#">Laravel</a></li>
                    <li><a href="#">Vue</a></li>
                    <li><a href="#">React</a></li>
                    <li><a href="#">Tailwind</a></li>
                    <li><a href="#">Native</a></li>
                  </ul>
                </li>
              <li><a href="#">Animasi</a></li>
              <li><a href="#">Game</a></li>
            </ul>
          </li>
          <li><a href="#">Contact</a></li>

          <li><a class="getstarted" href="#">Github</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav> --}}
      <!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">
      <div class="container">
        <div class="row d-flex ">
          <div class="bg-holder bg-size" style="background-image:url({{asset('/')}}assets/img/bg/dot-bg.png);background-position:bottom right;background-size:auto;">
          </div>
          <!--/.bg-holder-->

          <div class="col-lg-5 z-index-2 mt-5">
            <form class="row g-3" action="{{ route('login') }}" method="POST" >
              @csrf
              <div class="col-md-12">
                <label  for="inputName">Username :</label>
                <input class="form-control form-livedoc-contro @error('identity')
                is-invalid
                @enderror" id="inputName"  placeholder="Username" autocomplete="nope" name="identity" />
                  @error('identity')
                  <div class="invalid-feedback text-danger">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="col-md-12">
                <label  for="inputPhone">Password :</label>
                <input class="form-control form-livedoc-control @error('password')
                is-invalid
                @enderror" type="password" placeholder="Password" autocomplete="nope" name="password" />
                @error('password')
                <div class="invalid-feedback text-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="d-flex flex-row-reverse">
                  <button class="btn btn-primary rounded-pill" type="submit">Login</button>
              </div>
            </form>
          </div>
          <div class="col-lg-7 z-index-2 mb-5"><img class="w-100" src="{{url('/')}}/assets/img/undraw/undraw_maintenance_re_59vn.svg" alt="..." /></div>


        </div>

      </div>
  </main>


  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-end">
          <div class="col-lg-11">
            <div class="row justify-content-end">

              <div class="col-lg-4 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box py-5">
                  <h4>Sebagai : Admin</h4>
                  <label  for="inputPhone">Username : admin</label>
                  <br>
                  <label  for="inputPhone">Password : admin</label>
                </div>
              </div>


              <div class="col-lg-4 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box pb-5 pt-0 pt-lg-5">
                    <h5>Sebagai : Operator</h5>
                    <label  for="inputPhone">Username : operator</label>
                    <br>
                    <label  for="inputPhone">Password : operator</label>
                </div>
              </div>

              <div class="col-lg-4 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box pb-5 pt-0 pt-lg-5">
                    <h5>Sebagai : Kepala Gedung</h5>
                    <label  for="inputPhone">Username : kepalagedung</label>
                    <br>
                    <label  for="inputPhone">Password : kepalagedung</label>
                </div>
              </div>

            </div>
          </div>
        </div>


      </div>
    </section><!-- End About Section -->



  </main><!-- End #main -->



    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>BaemonTeamDev</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>


  </div>


  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{ asset('/') }}assets/js/baemon.js"></script>

  <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
  <!-- <script>
    AOS.init();
  </script> -->

  <script src="{{ asset('/') }}assets/vendor/aos/aos.js"></script>
  <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('/') }}assets/vendor/purecounter/purecounter.js"></script>
  <script src="{{ asset('/') }}assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/') }}assets/js/landing.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
