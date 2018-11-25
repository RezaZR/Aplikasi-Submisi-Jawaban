@extends('base')
@section('title', ' - Detail Pengguna: ' . $user->name)
@section('content')

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
                        <div class="register__wrapper__form">
                            <div class="field form-group">
                                <label for="name" class="active">Nama Lengkap</label>
                                <p>{{ $user->name }}</p>
                            </div>
                            <div class="field form-group">
                                <label for="npm" class="active">NPM</label>
                                <p>{{ $user->npm }}</p>
                            </div>
                            <div class="field form-group">
                                <label for="nik" class="active">NIK</label>
                                <p>{{ $user->nik }}</p>
                            </div>
                            <div class="field form-group">
                                <label for="email" class="active">Email</label>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="field form-group">
                                <label for="level" class="active">Level</label>
                                <p>{{ $user->level }}</p>
                            </div>
                            <div class="field form-group">
                                <label for="address" class="active">Alamat</label>
                                <p>{{ $user->address }}</p>
                            </div>
                            <div class="field form-group">
                                <label for="birth_date" class="active">No. Telpon</label>
                                <p>{{ $user->phone_number }}</p>
                            </div>
                            <div class="field form-group">                 
                                <div class="d-flex align-items-center">
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-end">
                                            <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-standard--primary"href="{{ route('users.edit', $user->id) }}">Ubah</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-start">
                                            <button class="btn btn-standard--delete" type="submit">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>

@endsection