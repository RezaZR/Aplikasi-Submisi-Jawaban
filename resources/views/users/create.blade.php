<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Aplikasi Submisi Jawaban - Buat Pengguna Baru</title>

    <link rel="shortcut icon" href="{{asset('assets/images/logo-main.jpg')}}" type="image/x-icon">
    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap-mod.css')}}" />
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Auth::user()->level == 'Admin')
                            <div class="register__wrapper__form">
                                {!! Form::open(['route' => 'users.store', 'method' => 'post']) !!}
                                    @csrf
                                    <div class="field form-group">
                                        {{ Form::label('name', 'Nama Lengkap', ['class' => 'active']) }}
                                        {{ Form::text('name', ['class' => 'form-control']) }}
                                    </div>
                                    <div class="field form-group">
                                        {{ Form::label('npm', 'NPM', ['class' => 'active']) }}
                                        {{ Form::text('npm', ['class' => 'form-control']) }}
                                    </div>
                                    <div class="field form-group">
                                        {{ Form::label('nik', 'NIK', ['class' => 'active']) }}
                                        {{ Form::text('nik', ['class' => 'form-control']) }}
                                    </div>
                                    <div class="field form-group">
                                        {{ Form::label('email', 'Email', ['class' => 'active']) }}
                                        {{ Form::email('email', ['class' => 'form-control']) }}
                                    </div>
                                    <div class="field form-group">
                                        {{ Form::label('password', 'Password', ['class' => 'active']) }}
                                        {{ Form::password('password', ['class' => 'form-control']) }}
                                    </div>                    
                                    <div class="field form-group">
                                        {{ Form::label('conf_password', 'Ulangi Password', ['class' => 'active']) }}
                                        {{ Form::password('conf_password', ['class' => 'form-control']) }}
                                    </div>   
                                    <div class="field form-group">
                                        {{ Form::label('level', 'Level', ['class' => 'active']) }}
                                        {{ Form::select('level', ['Admin' => 'Tata Usaha', 'Lecturer' => 'Dosen', 'Assistant' => 'Asisten', 'Student' => 'Mahasiswa'], null, ['class' => 'form-control']) }}
                                    </div>   
                                    <div class="field form-group">
                                        {{ Form::label('address', 'Alamat', ['class' => 'active']) }}
                                        {{ Form::text('address', ['class' => 'form-control']) }}
                                    </div>
                                    <div class="field form-group">
                                        {{ Form::label('phone_number', 'Nomor Telepon', ['class' => 'active']) }}
                                        {{ Form::text('phone_number', ['class' => 'form-control']) }}
                                    </div>
                                    <div class="field form-group">                 
                                        <div class="d-flex align-items-center">
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Batal</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-start">
                                                    <button class="btn btn-standard--primary" type="submit">Daftarkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>
</body>
</html>