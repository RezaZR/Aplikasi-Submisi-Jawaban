@extends('base')
@section('title', ' - Ubah Detail Mata Kuliah')
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
                        <div class="crud__wrapper__form">
                            <form action="{{ route('courses.update', $course->id) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="field form-group">
                                    <label for="name" class="active">Nama Mata Kuliah</label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{ $course->name }}" />
                                </div>
                                <div class="field form-group">
                                    <label for="code" class="active">Kode Mata Kuliah</label>
                                    <input class="form-control" id="code" name="code" type="text" value="{{ $course->code }}" />
                                </div>
                                <div class="field form-group">                 
                                    <div class="d-flex align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-standard--primary "href="/">Kembali</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-start">
                                                <button class="btn btn-standard--primary" type="submit">Ubah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>

@endsection