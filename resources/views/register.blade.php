<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title></title>

    <link rel="shortcut icon" href="{{asset('assets/images/logo-main.jpg')}}" type="image/x-icon">
    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/asset.css')}}" />

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/tether.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/fontawesome-all.js')}}"></script>
    <script src="{{asset('assets/js/login-register.js')}}"></script>
</head>
<body>
    <section class="register">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="register__wrapper shadow--outset">
                        <div class="register__wrapper__logo">
                            <img src="{{asset('assets/images/logo-main.jpg')}}" alt="Logo Informatika UNPAR"/>
                        </div>
                        <div class="register__wrapper__form">
                            <form action="">
                                <div class="field">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" type="text" required/>
                                </div>
                                <div class="field">
                                    <label for="address">Alamat</label>
                                    <input id="address" type="text" required/>
                                </div>
                                <div class="field">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" required/>
                                </div>
                                <div class="field">
                                    <label for="phone">No. Telepon</label>
                                    <input id="phone" type="text" required/>
                                </div>
                                <div class="field">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" required/>
                                </div>                    
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-standard--primary" type="submit">Daftarkan</button>
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