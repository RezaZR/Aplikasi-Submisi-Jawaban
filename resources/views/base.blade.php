<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-param" content="authenticity_token"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="UNPAR, Universitas Katolik Parahyangan, FTIS, IT, Teknologi Informasi, Informatika, Submisi, Submisi Jawaban, E-Learning"/>
    <meta name="description" content="Website ini adalah website yang diperuntukan untuk kalangan FTIS khususnya jurusan Informatika Universitas Katolik Parahyangan yang berguna sebagai tempat submisi jawaban."/>
    <meta name="subject" content="Website Aplikasi Submisi Jawaban">
    <meta name="copyright"content="Reza Zacky Ramadan | 2013730068">
    <meta name="language" content="EN IN">
    <meta name="Classification" content="E-Learning">
    <meta name="author" content="Reza Zacky Ramadan, rezazramadhan@gmail.com">
    <meta name="designer" content="Reza Zacky Ramadan">
    <meta name="owner" content="Reza Zacky Ramadan">
    <meta name="coverage" content="Informatika, FTIS, Universitas Katolik Parahyangan">
    <meta name="distribution" content="Informatika, FTIS, Universitas Katolik Parahyangan">
    <!-- <meta name="url" content=""> -->
    <!-- <meta name="identifier-URL" content=""> -->
    <!-- <meta name="robots" content="index,follow" /> -->

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="yes" name="apple-touch-fullscreen" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    

    <title>Aplikasi Submisi Jawaban @yield('title')</title>

    <link rel="shortcut icon" href="{{asset('assets/images/logo-main.jpg')}}" type="image/x-icon">
    
    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap-mod.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/asset.css')}}" />

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/tether.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://use.fontawesome.com/releases/v5.4.1/js/all.js"></script>
    <script src="{{asset('assets/js/login-register.js')}}"></script>
    <script src="{{asset('assets/js/layout.js')}}"></script>
</head>
<body>
    <header class="header shadow">
        <div class="container-fluid">
            <div class="row">
                <div class="header__wrapper">
                    <div class="d-flex align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-start">
                                        <div class="header__wrapper__info">
                                            <p>{{ Auth::user()->name }} /   
                                                <span>
                                                    @if(Auth::user()->level == 'Admin' || Auth::user()->level == 'Lecturer')
                                                        <span>{{ Auth::user()->nik }}</span>
                                                    @else
                                                        <span>{{ Auth::user()->npm }}</span>
                                                    @endif
                                                </span>
                                            </p>
                                            @if(Auth::user()->level == 'Admin')
                                                <p>Tata Usaha</p>
                                            @endif
                                            @if(Auth::user()->level == 'Lecturer')
                                                <p>Dosen</p>
                                            @endif
                                            @if(Auth::user()->level == 'Student')
                                                <p>Mahasiswa</p>
                                            @endif
                                            @if(Auth::user()->level == 'Assistant')
                                                <p>Asisten</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-start">
                                        @if(Auth::user()->level == 'Admin')
                                            <a href="/">Beranda</a>
                                            <a href="{{ route('courses.index')}}">Mata Kuliah</a>
                                            <a href="{{ route('users.index')}}">Pengguna</a>
                                            <a href="{{ route('logs.index')}}">Logs</a>
                                        @else
                                            <a href="/">Beranda</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-end">
                                <a href="/logout" class="btn btn-standard--transparent"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container-fluid main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer__wrapper">
                        <div class="d-flex justify-content-end">
                            <p>Aplikasi Submisi Jawaban</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="{{asset('assets/js/main.js')}}"></script>
</html>
