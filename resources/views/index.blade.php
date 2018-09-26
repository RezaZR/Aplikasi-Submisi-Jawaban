@extends('base')
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
    <section class="home">
        <div class="row">
            <div class="col-md-12">
                <div class="home__wrapper">
                    <p class="title">Mata Kuliah yang Diikuti Sebagai Mahasiswa</p>
                    <div class="col-md-3">
                        <a href="">
                            <div class="home__wrapper__box">
                                <img class="w-100" src="http://via.placeholder.com/346x148"/>
                                <div class="home__wrapper__box__info shadow--outset">
                                    <p>{{Session::get('name')}}</p>
                                    <p>AIF181101-03</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection