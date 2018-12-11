@extends('base')
@section('title', ' - List Mata Kuliah')
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
                                        <p class="title">Aktifitas Pengguna</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Aktifitas Pengguna</p>
                                <table cellpadding="10" class="table shadow--outset">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pengguna</th>
                                            <th>Level</th>
                                            <th>IP</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($logs as $log)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $log->created_by }}</td>
                                                <td>
                                                    @if($log->user_level == "Admin")
                                                        Tata Usaha
                                                    @elseif($log->user_level == "Lecturer")
                                                        Dosen
                                                    @elseif($log->user_level == "Assistant")
                                                        Asisten
                                                    @elseif($log->user_level == "Student")
                                                        Mahasiswa
                                                    @endif
                                                </td>
                                                <td>{{ $log->user_ip }}</td>
                                                <td>{{ $log->action }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="empty" colspan="6">Kolom kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection