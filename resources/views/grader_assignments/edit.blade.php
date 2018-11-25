@extends('base')
@section('title', ' - Nilai')
@section('content')
    
    <section class="crud">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="crud__wrapper shadow--outset">
                        <div class="crud__wrapper__title">
                            <p>{{ $assignment->title }}</p>
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
                        <div class="crud__wrapper__form">
                            <form action="{{ url('/user_courses/' . $course->id . '/assignments/' . $assignment->id . '/student_assignments/' . $willBeGradedStudent->user_assignments_id . '/grade') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control" id="student_id" name="student_id" type="hidden" value="{{ Auth::user()->id }}"/>
                                <input class="form-control" id="course_id" name="course_id" type="hidden" value="{{ $course->id }}"/>
                                <input class="form-control" id="assignment_id" name="assignment_id" type="hidden" value="{{ $assignment->id }}"/>
                                <div class="field form-group">
                                    <label class="active" for="course_name">Nama Mata Kuliah</label>
                                    <input class="form-control" id="course_name" name="course_name" type="text" disabled value="{{ $course->name }}"/>
                                </div>
                                <div class="field form-group">
                                    <label class="active" for="user_name">Nama Pengumpul</label>
                                    <input class="form-control" id="user_name" name="user_name" type="text" disabled value="{{ $willBeGradedStudent->user_name }}"/>
                                </div>
                                <div class="field form-group">
                                    <label class="active" for="file">File</label>
                                    <a href="{{ url('/uploads/' . $fileShort) }}" download>{{ $fileShort }}</a>
                                </div>
                                <div class="field form-group">
                                    <label class="active" for="grade">Nilai</label>
                                    <input class="form-control" id="grade" name="grade" type="text" value="{{ $willBeGradedStudent->grade }}"/>
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
                                                <button class="btn btn-standard--primary" type="submit">Masukkan Nilai</button>
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
    </section>

@endsection