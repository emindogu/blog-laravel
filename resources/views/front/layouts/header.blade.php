<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Emin Doğu" />
  <meta name="author" content="emindogu.net" />
  <title>@yield('title') - {{$config->title}}</title>
  <link rel="icon" type="image/x-icon" href="{{asset('font')}}/assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="{{asset('font')}}/css/styles.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/png" href="{{$config->favicon}}">
</head>
<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
      @if($config->logo!=null)
    <a href="{{route('admin.login')}}"><img src="{{asset($config->logo)}}" width="150" alt="logo"></a>
  @else
    <span style="color:white" ><a href="{{route('admin.login')}}"> {{$config->title}}</a></span>
  @endif
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menü
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto py-4 py-lg-0">
          <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('homepage')}}">AnaSayfa</a></li>
          @foreach($pages as $page)
            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('page',$page->slug)}}">{{$page->title}}</a></li>
          @endforeach
          <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('contact')}}">İletişim</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page Header-->
  <header class="masthead" style="background-image: url('@yield('bg',asset('font/assets/img/home-bg.jpg'))')">
    <div class="container position-relative px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-12">
          <div class="site-heading">
            <h1>@yield('title')</h1>
            <span class="subheading">Laravel İle Oluşturulmaya Çalışılıyor...</span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Main Content-->
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
