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
                                        <p class="title">Mata Kuliah</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('courses.create')}}" class="btn btn-standard--secondary"><i class="fas fa-plus fa-fw"></i>Mata Kuliah Baru</a></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="home__wrapper__table">
                                <p>List Mata Kuliah</p>
                                <table cellpadding="10" class="table shadow--outset">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Mata Kuliah</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $course->code }}</td>
                                                <td>{{ $course->name }}</td>
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
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection