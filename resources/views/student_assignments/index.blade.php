@extends('base')
@section('title', ' - Mata Kuliah: ' . $lecturerCourse->name)
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
    
    <section class="crud">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="crud__wrapper shadow--outset">
                        <div class="crud__wrapper__title">
                            <div class="d-flex align-items-center">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-start">
                                        <p>{{ $course->code }} - {{ $course->name }}</p>
                                    </div>
                                </div>
                            </div>
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
                        <div class="crud__wrapper__form--md">
                            <div class="crud__wrapper__form--md__title">
                                <div class="d-flex align-items-center">
                                    <div class="col-md-6 no-padding">
                                        <div class="d-flex justify-content-start">
                                            <p class="color--black">{{ $assignment->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="crud__wrapper__form--md__body">
                                @if($studentAssignments != null)
                                    <p class="color--black"><span>Status Pengumpulan</span>
                                        @if($studentAssignments->file_status == "Not Submitted")
                                            <span>: Belum Mengumpulkan</span>
                                            @elseif($studentAssignments->file_status == "Submitted")
                                            <span>: Terkumpul</span>
                                        @else
                                            <span>: Sudah Dinilai</span>
                                        @endif
                                    </p>
                                    <p class="color--black last-p"><span>File</span>
                                        <span>: 
                                            <a href="{{ url('/uploads/' . $studentAssignments->file) }}" download>{{ $studentAssignments->file }}</a>
                                        </span>
                                    </p>
                                    @if($studentAssignments->file_status != "Graded")
                                        <div class="d-flex align-items-center">
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-start">
                                                    <a class="btn btn-standard--primary "href="{{ url('/student_courses/' . $course->id . '/assignments/' . $assignment->id . '/student_assignments/' . $studentAssignments->id . '/edit') }}">Ubah</a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center">
                                            <div class="col-md-4">
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-standard--primary "href="{{ url('/student_courses/' . $course->id . '/assignments/' . $assignment->id . '/student_assignments/' . $studentAssignments->id . '/edit') }}">Ubah</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex justify-content-start">
                                                    <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Lihat Nilai</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <p class="color--black"><span>Status Pengumpulan</span>
                                        <span>: Belum Mengumpulkan</span>
                                    </p>
                                    <p class="color--black last-p"><span>File</span>
                                        <span>: -</span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-start">
                                                <a class="btn btn-standard--primary "href="{{ url('/student_courses/' . $course->id . '/assignments/' . $assignment->id . '/student_assignments/create') }}">Submit Jawaban</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection