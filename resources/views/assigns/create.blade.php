@extends('base')
@section('title', ' - Tugaskan Pengguna Ke Dalam Mata Kuliah')
@section('content')
    
    <section class="crud">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="crud__wrapper shadow--outset">
                        <div class="crud__wrapper__title">
                            <p>Tugaskan Pengguna Ke Dalam Mata Kuliah</p>
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
                            <div class="tabs">
                                <div class="tab--sm">
                                    <label class="tab-label" for="tab-1">Dosen</label>
                                    <input id="tab-1" name="tabs" class="link" type="radio" checked="checked">
                                    <div class="tab__content">
                                        <div class="col-md-12">
                                            <div class="crud__wrapper__form">
                                                <form action="{{ route('lecturer_courses.store') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="lecturer_id">Nama Dosen</label>
                                                        <select class="form-control" name="lecturer_id" required id="lecturer_id">
                                                            <option value="" disabled selected>Pilih dosen</option>
                                                            @foreach($lecturers as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_id">Nama Mata Kuliah</label>
                                                        <select class="form-control" name="course_id" required id="course_id">
                                                            <option value="" disabled selected>Pilih mata kuliah</option>
                                                            @foreach($courses as $course)
                                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                            @endforeach
                                                        </select>
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
                                                                    <button class="btn btn-standard--primary" type="submit">Tugaskan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab--sm">
                                    <label class="tab-label" for="tab-2">Asisten</label>
                                    <input id="tab-2" name="tabs" class="link" type="radio">
                                    <div class="tab__content">
                                        <div class="col-md-12">
                                            <div class="crud__wrapper__form">
                                                <form action="{{ route('assistant_courses.store') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="assistant_id">Nama Asisten</label>
                                                        <select class="form-control" name="assistant_id" required id="assistant_id">
                                                            <option value="" disabled selected>Pilih asisten</option>
                                                            @foreach($assistants as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_id">Nama Mata Kuliah</label>
                                                        <select class="form-control" name="course_id" required id="course_id">
                                                            <option value="" disabled selected>Pilih mata kuliah</option>
                                                            @foreach($courses as $course)
                                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                            @endforeach
                                                        </select>
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
                                                                    <button class="btn btn-standard--primary" type="submit">Tugaskan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab tab--sm">
                                    <label class="tab-label" for="tab-3">Mahasiswa</label>
                                    <input id="tab-3" name="tabs" class="link" type="radio">
                                    <div class="tab__content">
                                        <div class="col-md-12">
                                            <div class="crud__wrapper__form">
                                                <form action="{{ route('student_courses.store') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="student_id">Nama Mahasiswa</label>
                                                        <select class="form-control" name="student_id" required id="student_id">
                                                            <option value="" disabled selected>Pilih mahasiswa</option>
                                                            @foreach($students as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_id">Nama Mata Kuliah</label>
                                                        <select class="form-control" name="course_id" required id="course_id">
                                                            <option value="" disabled selected>Pilih mata kuliah</option>
                                                            @foreach($courses as $course)
                                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                            @endforeach
                                                        </select>
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
                                                                    <button class="btn btn-standard--primary" type="submit">Tugaskan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>

@endsection