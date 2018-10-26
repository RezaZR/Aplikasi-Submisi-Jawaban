<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title></title>

    <link rel="shortcut icon" href="{{asset('assets/images/logo-main.jpg')}}" type="image/x-icon">
    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap-mod.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/asset.css')}}" />

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/tether.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.4.1/js/all.js"></script>
    <script src="{{asset('assets/js/login-register.js')}}"></script>
    <script src="{{asset('assets/js/all.js')}}"></script>
</head>
<body>
    <header class="header shadow">
        <div class="container-fluid">
            <div class="row">
                <div class="header__wrapper">
                    <div class="d-flex align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-start">
                                <div class="header__wrapper__info">
                                    <p>{{Session::get('name')}} /   
                                        <span>
                                            @if(Session::get('level') == 'Admin' || Session::get('level') == 'Lecturer')
                                                <span>{{ Session::get('nik') }}</span>
                                            @else
                                                <span>{{ Session::get('npm') }}</span>
                                            @endif
                                        </span>
                                    </p>
                                    @if(Session::get('level') == 'Admin')
                                        <p>Tata Usaha</p>
                                    @endif
                                    @if(Session::get('level') == 'Lecturer')
                                        <p>Dosen</p>
                                    @endif
                                    @if(Session::get('level') == 'Student')
                                        <p>Mahasiswa</p>
                                    @endif
                                    @if(Session::get('level') == 'Assistant')
                                        <p>Asisten</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
</html>
