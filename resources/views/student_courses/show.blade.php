@extends('base')
@section('title', ' - Mata Kuliah: ' . $studentCourse->name)
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
                                        <a class="btn btn-standard--primary "href="/">Kembali</a>
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
                        @forelse($assignments as $assignment)
                            <a href="{{ url('/user_courses/' . $course->id . '/assignments/' . $assignment->id) }}">
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
                                        <p class="color--black"><span>Deskripsi</span> <span>: {{ $assignment->description }}</span></p>
                                        <p class="color--black"><span>Tanggal dan Waktu Mulai</span> <span>: {{ $assignment->start_time }}</span></p>
                                        <p class="color--black"><span>Tanggal dan Waktu Selesai</span> <span>: {{ $assignment->end_time }}</span></p>
                                        <p class="color--black"><span>Mode</span> 
                                            @if($assignment->mode === "Assignment")
                                                <span>: Tugas</span>
                                            @elseif($assignment->mode === "Quiz")
                                                <span>: Kuis</span>
                                            @else
                                                <span>: Ujian</span>
                                            @endif
                                        </p>
                                        <p class="color--black"><span>Status Telat</span> 
                                            @if($assignment->is_on_time)
                                                <span>: Diperbolehkan</span>
                                            @else
                                                <span>: Tidak diperbolehkan</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="crud__wrapper__form--md__body">
                                <h6 class="text-center">Tempat pengumpulan masih kosong</h6>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection