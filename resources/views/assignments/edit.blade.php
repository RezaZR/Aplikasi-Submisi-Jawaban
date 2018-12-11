@extends('base')
@section('title', ' - Ubah Detail Tempat Pengumpulan')
@section('content')
    
    <section class="crud">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="crud__wrapper shadow--outset">
                        <div class="crud__wrapper__title">
                            <p>Ubah Detail {{ $course->name }}</p>
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
                        @if(Auth::user()->level == 'Lecturer')
                            <div class="crud__wrapper__form">
                                <form action="{{ url('/lecturer_courses/' . $course->id . '/assignments/' . $assignment->id) }}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <input class="form-control" id="course_id" name="course_id" type="hidden" value="{{ $course->id }}"/>
                                    <div class="field form-group">
                                        <label class="active" for="course_name">Nama Mata Kuliah</label>
                                        <input class="form-control" id="course_name" name="course_name" type="text" disabled value="{{ $course->name }}"/>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="title">Judul Tempat Pengumpulan</label>
                                        <input class="form-control" id="title" name="title" type="text" value="{{ $assignment->title }}"/>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="description">Deskripsi</label>
                                        <textarea class="form-control" name="description" id="description" cols="20" rows="10">{{ $assignment->description }}</textarea>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="mode">Mode</label>
                                        <select class="form-control" id="mode" name="mode" value="">
                                            @if($assignment->mode === "Assignment")
                                                <option value="Assignment" selected>Tugas</option>
                                                <option value="Quiz">Kuis</option>
                                                <option value="Exam">Ujian</option>
                                            @elseif($assignment->mode === "Quiz")
                                                <option value="Assignment">Tugas</option>
                                                <option value="Quiz" selected>Kuis</option>
                                                <option value="Exam">Ujian</option>
                                            @else
                                                <option value="Assignment">Tugas</option>
                                                <option value="Quiz">Kuis</option>
                                                <option value="Exam" selected>Ujian</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="is_on_time">Status Telat</label>
                                        <select class="form-control" id="is_on_time" name="is_on_time" value="">
                                            @if($assignment->mode === "Assignment")
                                                <option value="false" selected>Tidak Diperbolehkan</option>
                                                <option value="true">Diperbolehkan</option>
                                            @else
                                                <option value="false">Tidak Diperbolehkan</option>
                                                <option value="true" selected>Diperbolehkan</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="start_time">Tanggal dan Waktu Mulai</label>
                                        <input class="form-control" id="start_time" name="start_time" type="datetime-local" value="{{ $assignment->start_time }}"/>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="end_time">Tanggal dan Waktu Selesai</label>
                                        <input class="form-control" id="end_time" name="end_time" type="datetime-local" value="{{ $assignment->end_time }}"/>
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
                                                    <button class="btn btn-standard--primary" type="submit">Buat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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