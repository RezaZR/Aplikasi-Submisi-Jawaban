@extends('base')
@section('content')

    <section class="register">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="register__wrapper shadow--outset">
                        <div class="register__wrapper__logo">
                            <img src="{{asset('assets/images/logo-main.jpg')}}" alt="Logo Informatika UNPAR"/>
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
                        <div class="register__wrapper__form">
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
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-standard--primary" type="submit">Daftarkan</button>
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