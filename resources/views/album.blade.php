@extends('layouts.header')

@section('album')
{{Session::put('album', 1)}}
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <h2 class="text-center titulo">{{$album->nome}}</h2>
        <div class="sobre text-center">
            {{$album->sobre}}
        </div>
    </div>
    <div class="col-2"></div>
</div>
    <div id="gallery" class="imagens">
        @foreach ($album->imagems as $item)
            <img alt="" src="{{URL::asset($item['thumbnail'])}}"
            data-image="{{URL::asset($item['imagem'])}}"
    data-description="{{$album->nome}}">
    <br>
    <br>
        @endforeach
    
    </div>

@endsection