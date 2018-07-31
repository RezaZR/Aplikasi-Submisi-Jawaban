<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="author" href="https://plus.google.com/+Scoopthemes">
    <link rel="publisher" href="https://plus.google.com/+Scoopthemes">

    <link rel="canonical" href="">

    <title>Login | Aplikasi Submisi Jawaban</title>

    <link rel="shortcut icon" href="{{asset('assets/images/logo-main.jpg')}}" type="image/x-icon">
    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/asset.css')}}" />

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/tether.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/fontawesome-all.js')}}"></script>
    <script src="{{asset('assets/js/login-register.js')}}"></script>

    <!--[if lt IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="login__wrapper shadow--outset">
                        <div class="login__wrapper__logo">
                            <img src="{{asset('assets/images/logo-main.jpg')}}" alt="Logo Informatika UNPAR"/>
                        </div>
                        @if(\Session::has('alert'))
                            <div class="alert alert-danger">
                                <div>{{Session::get('alert')}}</div>
                            </div>
                        @endif
                        @if(\Session::has('alert-success'))
                            <div class="alert alert-success">
                                <div>{{Session::get('alert-success')}}</div>
                            </div>
                        @endif
                        <div class="login__wrapper__form">
                            <form action="{{ url('/loginPost') }}" method="post">
                                {{ csrf_field() }}
                                <div class="field form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" required/>
                                </div>
                                <div class="field form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" required/>
                                </div>                    
                                <div class="field form-group">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-standard--primary" type="submit">Masuk</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>
</body>
</html>