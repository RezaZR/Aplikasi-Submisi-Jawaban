@extends('base')
@section('title', ' - Buat Mata Kuliah Baru')
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
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="crud__wrapper shadow--outset">
                        <div class="crud__wrapper__title">
                            <p>Mata Kuliah Baru</p>
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
                            <form action="{{ route('courses.store') }}" method="post">
                                @csrf
                                <div class="field form-group">
                                    <label for="name">Nama Mata Kuliah</label>
                                    <input class="form-control" id="name" name="name" type="text"/>
                                </div>
                                <div class="field form-group">
                                    <label for="code">Kode Mata Kuliah</label>
                                    <input class="form-control" id="code" name="code" type="text"/>
                                </div>
                                <div class="field form-group">                 
                                    <div class="d-flex align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-standard--primary "href="{{ URL::previous() }}">Kembali</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-start">
                                                <button class="btn btn-standard--primary" type="submit">Daftarkan</button>
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