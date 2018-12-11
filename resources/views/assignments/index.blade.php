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
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-start">
                                        <p class="title">Tugas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Tugas</p>
                                <table cellpadding="10" class="table shadow--outset">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Mata Kuliah</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>Judul Tempat Pengumpulan</th>
                                            <th>Tanggal & Waktu Mulai</th>
                                            <th>Tanggal & Waktu Selesai</th>
                                            <th>Mode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($courseAssignments as $courseAssignment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $courseAssignment->course_code }}</td>
                                                <td>{{ $courseAssignment->course_name }}</td>
                                                <td>{{ $courseAssignment->title }}</td>
                                                <td>{{ $courseAssignment->start_time }}</td>
                                                <td>{{ $courseAssignment->end_time }}</td>
                                                <td>{{ $courseAssignment->mode }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="empty" colspan="7">Kolom kosong</td>
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