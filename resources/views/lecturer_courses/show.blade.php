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
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-start">
                                        <p>{{ $lecturerCourse->code }} - {{ $lecturerCourse->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-standard--primary" href="{{ url('/lecturer_courses/' . $lecturerCourse->id . '/assignments/create') }}">Buat Tempat Pengumpulan</a>
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
                        <div class="crud__wrapper__form">
                            <div class="field form-group">
                                <label for="name" class="active">Nama Mata Kuliah</label>
                                <p>{{ $lecturerCourse->name }}</p>
                            </div>
                            <div class="field form-group">
                                <label for="code" class="active">Kode Mata Kuliah</label>
                                <p>{{ $lecturerCourse->code }}</p>
                            </div>
                            <div class="field form-group">                 
                                <div class="d-flex align-items-center">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection