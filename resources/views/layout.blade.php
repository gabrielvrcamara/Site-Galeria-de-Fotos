@extends('layouts.header')

@section('slide')
    <div class="container-fluid">
        <div class="row">
            <div class='col-0 col-xl-1'></div>
            <div class='col-12 col-xl-10 '>
                <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="10000">
                            <img id="img-slide" src="{{asset('imgs/1.jpg')}}" class="d-block w-100 img-fluid slide" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="2000">
                            <img id="img-slide" src="{{asset('imgs/2.jpg')}}" class="d-block w-100 img-fluid slide" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img id="img-slide" src="{{asset('imgs/3.jpg')}}" class="d-block w-100 img-fluid slide" alt="...">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class='col-0 col-xl-1'></div>
            </div>
        </div>
    </div>
@endsection

@section('sobre')
    <div class="sobre container-fluid text-center">
        <div class="sobre-titulo">
            <h2>@lang('conteudo.sobre')</h2>
        </div>
        <div class="img-sobre">
            <img src="{{asset('imgs/defaultImage.png')}}">
        </div>
        <div class="conteudo-sobre row">
            <div class="col-xs-1 col-2"></div>
            <div class="col-xs-10 col-8">
                @lang('conteudo.mensagem')
            </div>
            <div class="col-xs-1 col-2"></div>

        </div>
    </div>
@endsection

@section('albuns')
    {{Session::put('album', 0)}}
    <div class="container-fluid text-center" style="color: black; margin-top: 100px ">
        <h2 style="color: white;"> @lang('conteudo.portifolio') </h2>
        <div class="row">
            <div class="col-md-1 col-1"></div>
            <div class="col-md-10 col-10">
                <div class="albuns"></div>
            </div>
            <div class="col-md-1 col-1"></div>
        </div>
    </div>
@endsection

@section('contato')

    <div class="container-fluid" style="color: black; margin-top: 100px ">
        <h2 class="text-center" style="color: white; margin-top: 20px"> @lang('conteudo.contato') </h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        {!!Form::open(['url' => 'contato','id' => 'formContato', 'class' => 'form', 'method' => 'POST'])!!}
        <div class="row">
            <div class="col-md-1 col-1"></div>
            <div class="col-md-10 col-10 contato">
                @csrf
                <div class="formulario">
                    {!!Form::label('nome', trans('conteudo.nome').':')!!}
                    {!!Form::input('text', 'nome', '',['class' => 'form-control', 'autofocus', 'placeholder' => 'Maria(o)'])!!}
                </div>
                <div class="formulario">
                    {!!Form::label('email', 'E-mail:')!!}
                    {!!Form::input('text', 'email', '',['class' => 'form-control', '', 'placeholder' => 'email@gmail.com'])!!}
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="formulario">
                    {!!Form::label('mensagem', trans('conteudo.mensagem-email').':')!!}
                    {!!Form::textarea('mensagem', '',['class' => 'form-control', '', 'placeholder' => trans('conteudo.mensagem-email')])!!}
                </div>
                <div class="row formulario">
                    <div class="col-12 col-xl-9">
                    {!!Form::submit(trans('conteudo.button-enviar'), ['class' => 'btn btn-danger'])!!}
                    </div>
                    <div class="col-12 col-xl-3">
                        <div class="enviado"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-1"></div>
        </div>
        {!!Form::close()!!}
    </div>
@endsection

@section('footer')
<div id="footer" class="container-fluid footer text-center">
    Produced By Gabriel Camara| © Copyright
</div>
@endsection