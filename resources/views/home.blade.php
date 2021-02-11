@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div id="CabMenuAdm"class="col-2">Menu</div>
                        <div class="col-6"></div>
                        <div class="col-3"><button id="GooAnali" class="btn btn-secondary">Google Analytics</button></div>
                        <div class="col-1"><a href="/novoAlbum" class="btn btn-secondary">+</a></div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Atualizado em</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Deletar</th>
                            <th scope="col">Publicar</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($albuns as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->nome}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td><a class="btn btn-warning" href="{{$item->id.'/editarAlbuns'}}">Editar</a></td>
                                <td>
                                    {{-- {!!Form::open(['method' => 'DELETE' , 'url' => '/album/delete/'.$item->id])!!} --}}
                                    <button id="delete" type="submit" class="delete btn btn-danger">Deletar{{$item->id}}</button>
                                    {{-- {!! Form::close() !!} --}}
                                    {!!Form::hidden('id', $item->id, ['id' => 'valorDelete'])!!} 
                                </td>
                                @if ($item->status)
                                <td><a class="btn btn-secondary" href="{{'/status/0/'.$item->id}}">Despublicar</a></td>
                                <td><div class="online"></div></td>
                                    @else
                                    <td><a class="btn btn-success" href="{{'/status/1/'.$item->id}}">Publicar</a></td>
                                    <td><div class="offline"></div></td>
                                    @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
