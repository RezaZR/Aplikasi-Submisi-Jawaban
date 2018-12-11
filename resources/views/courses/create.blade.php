@extends('base')
@section('title', ' - Buat Mata Kuliah Baru')
@section('content')
    
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
                        @if(Auth::user()->level == 'Admin')
                            <div class="crud__wrapper__form">
                                <form action="{{ route('courses.store') }}" method="post">
                                    @csrf
                                    <div class="field form-group">
                                        <label class="active" for="name">Nama Mata Kuliah</label>
                                        <input class="form-control" id="name" name="name" type="text"/>
                                    </div>
                                    <div class="field form-group">
                                        <label class="active" for="code">Kode Mata Kuliah</label>
                                        <input class="form-control" id="code" name="code" type="text"/>
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
                                                    <button class="btn btn-standard--primary" type="submit">Daftarkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>

@endsection