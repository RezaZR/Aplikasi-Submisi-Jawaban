@extends('base')
@section('title', ' - Detail Mata Kuliah: ' . $course->name)
@section('content')

    <section class="crud">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="crud__wrapper shadow--outset">
                        <div class="crud__wrapper__title">
                            <p>Detail {{ $course->name }}</p>
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
                                <p>{{ $course->name }}</p>
                            </div>
                            <div class="field form-group">
                                <label for="code" class="active">Kode Mata Kuliah</label>
                                <p>{{ $course->code }}</p>
                            </div>
                            <div class="field form-group">                 
                                <div class="d-flex align-items-center">
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-end">
                                            <a class="btn btn-standard--primary "href="/">Kembali</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-standard--primary"href="{{ route('courses.edit', $course->id) }}">Ubah</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-start">
                                            <button class="btn btn-standard--delete" type="submit">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>

@endsection