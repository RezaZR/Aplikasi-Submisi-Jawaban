@extends('base')
@section('title', ' - Buat Tempat Pengumpulan Baru')
@section('content')
    
    <section class="crud">
        <div class="container">
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10">
                    <div class="crud__wrapper shadow--outset">
                        <div class="crud__wrapper__title">
                            <p>Tempat Pengumpulan Baru</p>
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
                                <form action="{{ url('/lecturer_courses/' . $course->id . '/assignments/') }}" method="post">
                                    @csrf
                                    <input class="form-control" id="course_id" name="course_id" type="hidden" value="{{ $course->id }}"/>
                                    <div class="field form-group">
                                        <label class="active" for="course_name">Nama Mata Kuliah</label>
                                        <input class="form-control" id="course_name" name="course_name" type="text" disabled value="{{ $course->name }}"/>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="title">Judul Tempat Pengumpulan</label>
                                        <input class="form-control" id="title" name="title" type="text"/>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="description">Deskripsi</label>
                                        <textarea class="form-control" name="description" id="description" cols="20" rows="10"></textarea>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="mode">Mode</label>
                                        <select class="form-control" id="mode" name="mode" value="">
                                            <option value="Assignment" selected>Tugas</option>
                                            <option value="Test">Kuis</option>
                                            <option value="Exam">Ujian</option>
                                        </select>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="is_on_time">Status Telat</label>
                                        <select class="form-control" id="is_on_time" name="is_on_time" value="">
                                            <option value="true">Diperbolehkan</option>
                                            <option value="false" selected>Tidak Diperbolehkan</option>
                                        </select>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="start_time">Tanggal dan Waktu Mulai</label>
                                        <input class="form-control no-arrow" id="start_time" name="start_time" type="datetime-local"/>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="end_time">Tanggal dan Waktu Selesai</label>
                                        <input class="form-control no-arrow" id="end_time" name="end_time" type="datetime-local"/>
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
                <div class="col-md-1">
                </div>
            </div>
        </div>
    </section>

@endsection