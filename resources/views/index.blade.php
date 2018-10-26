@extends('base')
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
    <section class="home">
        <div class="row">
            <div class="col-md-12">
                <div class="home__wrapper">
                    @if(Session::get('level') == 'Admin')
                        <div class="home__wrapper__title">
                            <div class="d-flex align-items-center">
                                <div class="col-6">
                                    <div class="d-flex justify-content-start">
                                        <p class="title">Beranda</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-end">
                                        <a href="/course" class="btn btn-standard--secondary"><i class="fas fa-plus fa-fw"></i>Mata Kuliah Baru</a></a>
                                        <a href="/register" class="btn btn-standard--secondary"><i class="fas fa-plus fa-fw"></i>Pengguna Baru</a></a>
                                        <a href="/course" class="btn btn-standard--secondary"><i class="fas fa-clipboard-list fa-fw"></i>Tugaskan Pengguna Ke Dalam MK</a></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Mata Kuliah</p>
                                <table cellpadding="10">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kode Mata Kuliah</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Tanggal Diubah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><td>
                                            <td><td>
                                            <td><td>
                                            <td><td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Pengguna</p>
                                <table cellpadding="10">
                                    <thead>
                                        <th>ID</th>
                                        <th>NPM</th>
                                        <th>NIK</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Nomor Telepon</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Tanggal Diubah</th>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ ++$j }}</td>
                                                <td>{{ $user->npm }}</td>
                                                <td>{{ $user->nik }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->level }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->birth_date }}</td>
                                                <td>{{ $user->sex }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ $user->updated_at }}</td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="home__wrapper__title">
                            <div class="d-flex align-items-center">
                                <div class="col-6">
                                    <div class="d-flex justify-content-start">
                                        <p class="title">Beranda</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-end">
                                        <a href="/register" class="btn btn-standard--secondary"><i class="fas fa-plus fa-fw"></i>Pengguna Baru</a></a>
                                        <a href="/course" class="btn btn-standard--secondary"><i class="fas fa-plus fa-fw"></i>Mata Kuliah Baru</a></a>
                                        <a href="/course" class="btn btn-standard--secondary"><i class="fas fa-clipboard-list fa-fw"></i>Tugaskan Pengguna Ke Dalam MK</a></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="">
                                <div class="home__wrapper__box">
                                    <img class="w-100" src="http://via.placeholder.com/346x148"/>
                                    <div class="home__wrapper__box__info shadow--outset">
                                        <p>{{Session::get('name')}}</p>
                                        <p>AIF181101-03</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection