@extends('base')
@section('title', ' - Ubah Detail Pengguna')
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
                            <form action="{{ route('users.update', $user->id) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="field form-group">
                                    <label for="name" class="active">Nama Lengkap</label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{ $user->name }}" />
                                </div>
                                <div class="field form-group">
                                    <label for="npm" class="active">NPM</label>
                                    <input class="form-control" id="npm" name="npm" type="text" value="{{ $user->npm }}" />
                                </div>
                                <div class="field form-group">
                                    <label for="nik" class="active">NIK</label>
                                    <input class="form-control" id="nik" name="nik" type="text" value="{{ $user->nik }}" />
                                </div>
                                <div class="field form-group">
                                    <label for="email" class="active">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" value="{{ $user->email }}" />
                                </div>
                                <div class="field form-group">
                                    <label for="password" class="active">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" />
                                </div>
                                <div class="field form-group">
                                    <label for="conf_password" class="active">Ulangi Password</label>
                                    <input class="form-control" id="conf_password" name="conf_password" type="password" />
                                </div>
                                <div class="form-group">
                                    <label for="level" class="active">Level</label>
                                    <select class="form-control" id="level" name="level" value="{{ $user->level }}">
                                        dd(@if($user->level == 'Admin') @endif)
                                        @if($user->level == 'Admin')
                                            <option value="Admin" selected>Tata Usaha</option>
                                            <option value="Lecturer">Dosen</option>
                                            <option value="Assistant">Asisten</option>
                                            <option value="Student">Mahasiswa</option>
                                        @elseif($user->level == 'Lecturer')
                                            <option value="Admin">Tata Usaha</option>
                                            <option value="Lecturer" selected>Dosen</option>
                                            <option value="Assistant">Asisten</option>
                                            <option value="Student">Mahasiswa</option>
                                        @elseif($user->level == 'Assistant')
                                            <option value="Admin">Tata Usaha</option>
                                            <option value="Lecturer">Dosen</option>
                                            <option value="Assistant" selected>Asisten</option>
                                            <option value="Student">Mahasiswa</option>
                                        @else
                                            <option value="Admin">Tata Usaha</option>
                                            <option value="Lecturer">Dosen</option>
                                            <option value="Assistant">Asisten</option>
                                            <option value="Student" selected>Mahasiswa</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="field form-group">
                                    <label for="address" class="active">Alamat</label>
                                    <input class="form-control" id="address" name="address" type="text" value="{{ $user->address }}" />
                                </div>
                                <div class="form-group">
                                    <label for="sex" class="active">Jenis Kelamin</label>
                                    <select class="form-control" id="sex" name="sex" value="{{ $user->sex }}">
                                        @if($user->sex == 'Male')
                                            <option value="Male" selected>Pria</option>
                                            <option value="Female">Wanita</option>
                                        @else
                                            <option value="Male">Pria</option>
                                            <option value="Female" selected>Wanita</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="field form-group">
                                    <label for="phone_number" class="active">Nomor Telepon</label>
                                    <input class="form-control" id="phone_number" name="phone_number" type="text" value="{{ $user->phone_number }}" />
                                </div>
                                <div class="field form-group">
                                    <label for="birth_date" class="active">Tanggal Lahir</label>
                                    <input class="form-control" id="birth_date" name="birth_date" type="date" value="{{ $user->birth_date }}" />
                                </div>
                                <div class="field form-group">                 
                                    <div class="d-flex align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-start">
                                                <button class="btn btn-standard--primary" type="submit">Ubah</button>
                                            </div>
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

@endsection