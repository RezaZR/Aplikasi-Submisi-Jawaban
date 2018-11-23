@extends('base')
@section('title', ' - List Pengguna')
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
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-start">
                                        <p class="title">Pengguna</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('users.create')}}" class="btn btn-standard--secondary"><i class="fas fa-plus fa-fw"></i>Pengguna Baru</a></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tabs">
                            <div class="tab">
                                <label for="tab-1">Tata Usaha</label>
                                <input id="tab-1" name="tabs" class="link" type="radio" checked="checked">
                                <div class="tab__content">
                                    <div class="col-md-12">
                                        <div class="home__wrapper__table">
                                            <table cellpadding="10" class="shadow--outset">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>NIK</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Level</th>
                                                        <th>Nomor Telepon</th>
                                                        <th>Alamat</th>
                                                        <th>Tanggal Lahir</th>
                                                        <th>Jenis Kelamin</th>
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
                                                            <td>
                                                                @if($user->sex == "Male")
                                                                    Pria
                                                                @else
                                                                    Wanita
                                                                @endif
                                                            </td>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab">
                                <label for="tab-2">Dosen</label>
                                <input id="tab-2" name="tabs" class="link" type="radio">
                                <div class="tab__content">
                                    <div class="col-md-12">
                                        <div class="home__wrapper__table">
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
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($userLecturer as $user)
                                                        <tr>
                                                            <td>{{ ++$j }}</td>
                                                            <td>{{ $user->nik }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->level }}</td>
                                                            <td>{{ $user->phone_number }}</td>
                                                            <td>{{ $user->address }}</td>
                                                            <td>{{ $user->birth_date }}</td>
                                                            <td>
                                                                @if($user->sex == "Male")
                                                                    Pria
                                                                @else
                                                                    Wanita
                                                                @endif
                                                            </td>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab">
                                <label for="tab-3">Asisten</label>
                                <input id="tab-3" name="tabs" class="link" type="radio">
                                <div class="tab__content">
                                    <div class="col-md-12">
                                        <div class="home__wrapper__table">
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
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($userAssistant as $user)
                                                        <tr>
                                                            <td>{{ ++$k }}</td>
                                                            <td>{{ $user->npm }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->level }}</td>
                                                            <td>{{ $user->phone_number }}</td>
                                                            <td>{{ $user->address }}</td>
                                                            <td>{{ $user->birth_date }}</td>
                                                            <td>
                                                                @if($user->sex == "Male")
                                                                    Pria
                                                                @else
                                                                    Wanita
                                                                @endif
                                                            </td>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab">
                                <label for="tab-4">Mahasiswa</label>
                                <input id="tab-4" name="tabs" class="link" type="radio">
                                <div class="tab__content">
                                    <div class="col-md-12">
                                        <div class="home__wrapper__table">
                                            <table cellpadding="10" class="shadow--outset">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>NIK</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Level</th>
                                                        <th>Nomor Telepon</th>
                                                        <th>Alamat</th>
                                                        <th>Tanggal Lahir</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($userStudent as $user)
                                                        <tr>
                                                            <td>{{ ++$l }}</td>
                                                            <td>{{ $user->npm }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->level }}</td>
                                                            <td>{{ $user->phone_number }}</td>
                                                            <td>{{ $user->address }}</td>
                                                            <td>{{ $user->birth_date }}</td>
                                                            <td>
                                                                @if($user->sex == "Male")
                                                                    Pria
                                                                @else
                                                                    Wanita
                                                                @endif
                                                            </td>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection