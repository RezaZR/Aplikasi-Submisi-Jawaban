@extends('base')
@section('title', ' - List Penugasan Pengguna')
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
                                        <p class="title">Penugasan Pengguna Ke Dalam Mata Kuliah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tabs">
                            <div class="tab--sm">
                                <label class="tab-label" for="tab-1">Tata Usaha</label>
                                <input id="tab-1" name="tabs" class="link" type="radio" checked="checked">
                                <div class="tab__content">
                                    <div class="col-md-12">
                                        <div class="home__wrapper__table">
                                            <table cellpadding="10" class="table shadow--outset">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Asisten</th>
                                                        <th>Kode Mata Kuliah</th>
                                                        <th>Nama Mata Kuliah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($assignedAssistants as $assigned)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $assigned->user_name }}</td>
                                                            <td>{{ $assigned->code }}</td>
                                                            <td>{{ $assigned->course_name }}</td>
                                                            <td>
                                                                <form action="{{ route('assigns.destroy', $assigned->id)}}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-standard--transparent" type="submit"><i class="fas fa-trash" title="Hapus"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="empty" colspan="4">Kolom kosong</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab--sm">
                                <label class="tab-label" for="tab-2">Dosen</label>
                                <input id="tab-2" name="tabs" class="link" type="radio">
                                <div class="tab__content">
                                    <div class="col-md-12">
                                        <div class="home__wrapper__table">
                                        <table cellpadding="10" class="table shadow--outset">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Dosen</th>
                                                        <th>Kode Mata Kuliah</th>
                                                        <th>Nama Mata Kuliah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($assignedLecturers as $assigned)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $assigned->user_name }}</td>
                                                            <td>{{ $assigned->code }}</td>
                                                            <td>{{ $assigned->course_name }}</td>
                                                            <td>
                                                                <form action="{{ route('assigns.destroy', $assigned->id)}}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-standard--transparent" type="submit"><i class="fas fa-trash" title="Hapus"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="empty" colspan="4">Kolom kosong</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab--sm">
                                <label class="tab-label" for="tab-4">Mahasiswa</label>
                                <input id="tab-4" name="tabs" class="link" type="radio">
                                <div class="tab__content">
                                    <div class="col-md-12">
                                        <div class="home__wrapper__table">
                                            <table cellpadding="10" class="table shadow--outset">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Mahasiswa</th>
                                                        <th>Kode Mata Kuliah</th>
                                                        <th>Nama Mata Kuliah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($assignedStudents as $assigned)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $assigned->user_name }}</td>
                                                            <td>{{ $assigned->code }}</td>
                                                            <td>{{ $assigned->course_name }}</td>
                                                            <td>
                                                                <form action="{{ route('assigns.destroy', $assigned->id)}}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-standard--transparent" type="submit"><i class="fas fa-trash" title="Hapus"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="empty" colspan="4">Kolom kosong</td>
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