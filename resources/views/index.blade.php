@extends('base')
@section('title', ' - Home')
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
                    @if(Auth::user()->level == 'Admin')
                        <div class="home__wrapper__title">
                            <div class="d-flex align-items-center">
                                <div class="col-6">
                                    <div class="d-flex justify-content-start">
                                        <p class="title">Beranda</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('courses.create')}}" class="btn btn-standard--secondary"><i class="fas fa-plus fa-fw"></i>Mata Kuliah Baru</a></a>
                                        <a href="{{ route('users.create')}}" class="btn btn-standard--secondary"><i class="fas fa-plus fa-fw"></i>Pengguna Baru</a></a>
                                        <a href="{{ route('assigns.create') }}" class="btn btn-standard--secondary"><i class="fas fa-clipboard-list fa-fw"></i>Tugaskan Pengguna Ke Dalam MK</a></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Mata Kuliah Terbaru</p>
                                <table cellpadding="10" class="shadow--outset">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kode Mata Kuliah</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Tanggal Diubah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $course->code }}</td>
                                                <td>{{ $course->name }}</td>
                                                <td>{{ $course->created_at }}</td>
                                                <td>{{ $course->updated_at }}</td>
                                                <td>
                                                    <a href="{{ route('courses.show', $course->id)}}"><i class="fas fa-eye" title="Detail"></i></a>
                                                    <a href="{{ route('courses.edit', $course->id)}}"><i class="fas fa-pencil-alt" title="Ubah"></i></a>
                                                    <form action="{{ route('courses.destroy', $course->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-standard--transparent" type="submit"><i class="fas fa-trash" title="Hapus"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="empty" colspan="6">Kolom kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <p class="home__wrapper__table__link"><a href="{{ route('courses.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Admin Terbaru</p>
                                <table cellpadding="10" class="shadow--outset">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($userAdmin as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
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
                                                <td>
                                                    <a href="{{ route('users.show', $user->id)}}"><i class="fas fa-eye" title="Detail"></i></a>
                                                    <a href="{{ route('users.edit', $user->id)}}"><i class="fas fa-pencil-alt" title="Ubah"></i></a>
                                                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-standard--transparent" type="submit"><i class="fas fa-trash" title="Hapus"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="empty" colspan="12">Kolom kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <p class="home__wrapper__table__link"><a href="{{ route('users.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Dosen Terbaru</p>
                                <table cellpadding="10" class="shadow--outset">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($userLecturer as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
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
                                                <td>
                                                    <a href="{{ route('users.show', $user->id)}}"><i class="fas fa-eye" title="Detail"></i></a>
                                                    <a href="{{ route('users.edit', $user->id)}}"><i class="fas fa-pencil-alt" title="Ubah"></i></a>
                                                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-standard--transparent" type="submit"><i class="fas fa-trash" title="Hapus"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="empty" colspan="12">Kolom kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <p class="home__wrapper__table__link"><a href="{{ route('users.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Asisten Terbaru</p>
                                <table cellpadding="10" class="shadow--outset">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NPM</th>
                                            <th>Nama Pengguna</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>Nomor Telepon</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Tanggal Diubah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($userAssistant as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->npm }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->level }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->birth_date }}</td>
                                                <td>{{ $user->sex }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ $user->updated_at }}</td>
                                                <td>
                                                    <a href="{{ route('users.show', $user->id)}}"><i class="fas fa-eye" title="Detail"></i></a>
                                                    <a href="{{ route('users.edit', $user->id)}}"><i class="fas fa-pencil-alt" title="Ubah"></i></a>
                                                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-standard--transparent" type="submit"><i class="fas fa-trash" title="Hapus"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="empty" colspan="12">Kolom kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <p class="home__wrapper__table__link"><a href="{{ route('users.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Mahasiswa Terbaru</p>
                                <table cellpadding="10" class="shadow--outset">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NPM</th>
                                            <th>Nama Pengguna</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>Nomor Telepon</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Tanggal Diubah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($userStudent as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->npm }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->level }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->birth_date }}</td>
                                                <td>{{ $user->sex }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ $user->updated_at }}</td>
                                                <td>
                                                    <a href="{{ route('users.show', $user->id)}}"><i class="fas fa-eye" title="Detail"></i></a>
                                                    <a href="{{ route('users.edit', $user->id)}}"><i class="fas fa-pencil-alt" title="Ubah"></i></a>
                                                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-standard--transparent" type="submit"><i class="fas fa-trash" title="Hapus"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="empty" colspan="12">Kolom kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <p class="home__wrapper__table__link"><a href="{{ route('users.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a></p>
                                        </div>
                                    </div>
                                </div>
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
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                @foreach ($lecturerCourses as $course)
                                    <div class="col-md-3">
                                        <a href="{{ route('lecturer_courses.show', $course->course_id) }}">
                                            <div class="home__wrapper__box">
                                                <img class="w-100" src="http://via.placeholder.com/346x148"/>
                                                <div class="home__wrapper__box__info shadow--outset">
                                                    <p>{{ $course->course_name }}</p>
                                                    <p>{{ $course->course_code }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection