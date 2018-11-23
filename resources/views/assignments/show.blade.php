@extends('base')
@section('title', ' - Mata Kuliah: ' . $course->name)
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
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-start">
                                        <p>{{ $course->code }} - {{ $course->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        @if(Auth::user()->level != 'Student')
                                            <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                        @endif
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
                                    <div class="col-md-12 no-padding">
                                        <div class="d-flex justify-content-start">
                                            <p class="color--black">{{ $assignment->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="crud__wrapper__form--md__body">
                                @if(Auth::user()->level == 'Student')
                                    @if(is_null($studentAssignment->user_assignments_id) == false)
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="color--black"><span>Status Pengumpulan</span>
                                                        @if($studentAssignment->file_status == "Not Submitted")
                                                            <span class="color--red">: Belum mengumpulkan</span>
                                                        @elseif($studentAssignment->file_status == "Submitted")
                                                            <span class="color--orange">: Telah mengumpulkan, belum dinilai</span>
                                                        @else
                                                            <span class="color--green">: Sudah dinilai</span>
                                                        @endif
                                                    </p>
                                                    <p class="color--black"><span>File</span>
                                                        <span>: 
                                                            <a title="Unduh berkas milik {{$studentAssignment->user_name}}" href="{{ url('/uploads/' . $fileShortStudent) }}" download>{{ $fileShortStudent }}</a>
                                                        </span>
                                                    </p>
                                                    <p class="color--black"><span>Nilai</span>
                                                        @if($studentAssignment->file_status == "Graded")
                                                            <span>: {{ $studentAssignment->grade }}</span>
                                                        @else
                                                            <span>: -</span>
                                                        @endif
                                                    </p>
                                                    <p class="color--black last-p"><span>Waktu Pemeriksaan</span>
                                                        @if($studentAssignment->file_status == "Graded")
                                                            <span>: {{ $studentAssignment->examine_time }}</span>
                                                        @else
                                                            <span>: -</span>
                                                        @endif
                                                    </p>
                                                    @if($studentAssignment->file_status == "Submitted")
                                                        <div class="d-flex align-items-center">
                                                            <div class="col-md-6">
                                                                <div class="d-flex justify-content-end">
                                                                    <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="d-flex justify-content-start">
                                                                    <a class="btn btn-standard--primary "href="{{ url('/user_courses/' . $course->id . '/assignments/' . $assignment->id . '/student_assignments/' . $studentAssignment->user_assignments_id . '/edit') }}">Ubah</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif($studentAssignment->file_status == "Graded")
                                                        <div class="d-flex align-items-center">
                                                            <div class="col-md-12">
                                                                <div class="d-flex justify-content-center">
                                                                    <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="color--black"><span>Status Pengumpulan</span> <span class="color--red">: Belum mengumpulkan</span></p>
                                                    <p class="color--black"><span>File</span><span>: -</span></p>
                                                    <p class="color--black"><span>Nilai</span><span>: -</span></p>
                                                    <p class="color--black last-p"><span>Waktu Pemeriksaan</span><span>: -</span></p>
                                                    <div class="d-flex align-items-center">
                                                        <div class="col-md-6">
                                                            <div class="d-flex justify-content-end">
                                                                <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="d-flex justify-content-start">
                                                                <a class="btn btn-standard--primary "href="{{ url('/user_courses/' . $course->id . '/assignments/' . $assignment->id . '/student_assignments/create') }}">Submit Jawaban</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if(Auth::user()->level == 'Assistant')
                                    @forelse($willBeGradedAssignments as $willBeGradedAssignment)
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <p class="color--black"><span>Nama Pengumpul</span> <span>: {{ $willBeGradedAssignment->user_name }}</span></p>
                                                    <p class="color--black"><span>Status Pengumpulan</span>
                                                        @if($willBeGradedAssignment->file_status == "Not Submitted")
                                                            <span class="color--red">: Belum mengumpulkan</span>
                                                        @elseif($willBeGradedAssignment->file_status == "Submitted")
                                                            <span class="color--orange">: Telah mengumpulkan, belum dinilai</span>
                                                        @else
                                                            <span class="color--green">: Sudah dinilai</span>
                                                        @endif
                                                    </p>
                                                    <p class="color--black"><span>File</span>
                                                        <span>: 
                                                            <a title="Unduh berkas milik {{$willBeGradedAssignment->user_name}}" href="{{ url('/uploads/' . $fileShortGrader) }}" download>{{ $fileShortGrader }}</a>
                                                        </span>
                                                    </p>
                                                    <p class="color--black"><span>Nilai</span>
                                                        @if($willBeGradedAssignment->file_status == "Graded")
                                                            <span>: {{ $willBeGradedAssignment->grade }}</span>
                                                        @else
                                                            <span>: -</span>
                                                        @endif
                                                    </p>
                                                    <p class="color--black last-p"><span>Waktu Pemeriksaan</span>
                                                        @if($willBeGradedAssignment->file_status == "Graded")
                                                            <span>: {{ $willBeGradedAssignment->examine_time }}</span>
                                                        @else
                                                            <span>: -</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-1">
                                                    @if($willBeGradedAssignment->file_status == "Submitted")
                                                        <a class="color--black" href="{{ url('/user_courses/' . $course->id . '/assignments/' . $willBeGradedAssignment->assignment_student_id . '/student_assignments/' . $willBeGradedAssignment->user_assignments_id . '/grade/create') }}"><i class="fas fa-clipboard-list" title="Masukkan nilai"></i></i></a>
                                                    @elseif($willBeGradedAssignment->file_status == "Graded")
                                                        <a class="color--black" href="{{ url('/user_courses/' . $course->id . '/assignments/' . $willBeGradedAssignment->assignment_student_id . '/student_assignments/' . $willBeGradedAssignment->user_assignments_id . '/grade/edit') }}"><i class="fas fa-pencil-alt" title="Ubah nilai"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">Belum ada Mahasiswa yang mengumpulkan</p>
                                    @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection