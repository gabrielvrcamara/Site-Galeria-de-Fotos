@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-2">
                            <a href="/home" class="btn btn-secondary btn-sm bttIcon">< </a>
                        </div>
                        <div class="col-7"></div>
                        <div class="col-3">
                            @if (Request::is('*/editarAlbuns'))
                                <h4 id="novoAlbum">Editar Album
                            @else
                                <h4 id="novoAlbum">Novo Album
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (Request::is('*/editarAlbuns'))
                        {!!Form::model($album, ['id' => 'formAlbumEdit', 'method' => 'PATCH', 'files' => true])!!}
                        <?php $img = $album->capa ?>
                    @else
                        {!!Form::open(['id' => 'formAlbum','class' => 'form', 'method' => 'POST','files' => true])!!}
                        <?php $img = "imgs/defaultImage.png" ?>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="formulario">
                                {!!Form::label('nome', 'Nome:')!!}
                                {!!Form::input('text', 'nome', null ,['class' => 'form-control', 'autofocus', 'placeholder' => 'Nome do Album'])!!}
                            </div>

                            <div class="formulario">
                                {!!Form::label('sobre', 'Sobre:')!!}
                                {!!Form::textarea('sobre', null ,['class' => 'form-control', '', 'placeholder' => 'Sobre o Album'])!!}
                            </div>
                            <div class="formulario">
                                {!! Form::submit('Salvar') !!}
                            </div>

                        </div>
                        <div class="col-6">
                            <div><img id="view-img" src="{{asset($img)}}" alt=""></div>
                            <div class="formulario">
                                {!!Form::label('capa', 'Capa:')!!}
                                {!! Form::file('capa',['class' => 'form-control capa']) !!}
                            </div>

                            <div class="formulario">
                                {!!Form::label('imagens', 'Imagens:')!!}
                                {!!Form::file('imagens[]', ['multiple'=>true, 'class' => 'form-control'])!!}
                            </div>
                            <div class="progress">
                                <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                %0
                                </div>
                            </div>
                            <div id="success" class="row"></div>
                            <br />
                        </div>
                        {!!Form::close()!!}
                        @if (Request::is('*/editarAlbuns'))
                            @foreach ($album->imagems as $item)
                                <div>
                                    {!!Form::open(['id' => 'deleteImagem','method' => 'DELETE', 'url' => '/imagem/delete/'.$item->id])!!}
                                    <button class="btn btn-sm btn-danger deleteEdit">X</button>
                                    {!!Form::close()!!}
                                    <img class="imageSucess" src="{{asset($item->thumbnail)}}">
                                </div>
                            @endforeach
                            <div class="imageSucessEdit" class="row"></div>

                            </div>
                         @else
                            <div class="imageSucess" class="row"></div>
                         @endif                    
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
