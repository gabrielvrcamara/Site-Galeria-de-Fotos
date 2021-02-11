<?php

namespace DavidPeixoto\Http\Controllers;

use Illuminate\Http\Request;
use DavidPeixoto\Album;
use DavidPeixoto\imagem;
use Stichoza\GoogleTranslate\GoogleTranslate;


use Image;
use Redirect;


class AlbumsController extends Controller
{

     public function index()
    {
        $albuns = Album::get();
        return view('home',['albuns' => $albuns]);
    }
    //
    // https://github.com/Stichoza/google-translate-php
    // Lib usada para traducao
    //
    public function load(Request $request)
    {
        $album = Album::get()->where('status', true);

            foreach ($album as $key => $value) {
                if(\Session::get('idioma') == 'pt')
                {
                    $value['nome'] = GoogleTranslate::trans($value['nome'], 'pt', 'en');
                }else
                {
                    $value['nome'] = GoogleTranslate::trans($value['nome'], 'en', 'pt');
                }
            }
        
        foreach ($album as $key => $value) {
            $value['capa'] = asset($value['capa']);
        }
        return json_encode($album);
    }

    public function changeLang(Request $request, $id)
    {
        $idioma = $request->route('idioma');
        
        \Session::put('idioma',$idioma);
        \App::setLocale(\Session::get('idioma'));
        if(\Session::get('album'))
        {
            return Redirect::back();
        }else
        {
            return view('layout');
        }

    }

    public function loadAlbum(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        \App::setLocale(\Session::get('idioma'));
        if($album->status)
        {
            if(\Session::get('idioma') == 'pt')
            {
                $album['nome'] = GoogleTranslate::trans($album['nome'], 'pt', 'en');
                $album['sobre'] = GoogleTranslate::trans($album['sobre'], 'pt', 'en');
            }else
            {
                $album['nome'] = GoogleTranslate::trans($album['nome'], 'en', 'pt');
                $album['sobre'] = GoogleTranslate::trans($album['sobre'], 'en', 'pt');
            }
            return view('album', ['album' => $album]);
        }
        return view('album');
        

    }

    public function save(Request $request)
    {   
        // 
        // http://image.intervention.io/
        // lib usada para manipular imagens
        // 


        $imageName = $this->saveCapa($request);

        $Albums = Album::create([
            'nome'  => $request->nome, 
            'sobre' => $request->sobre, 
            'capa' => $imageName
        ]);

        $imagens = $this->saveImagens($request, $Albums);

        $output = array(
            'success'  => 'Images uploaded successfully',
            'image'   => $imagens,
           );
      
           return response()->json($output);
    }

    public function deleteAlbum($id)
    {
        $album = Album::findOrFail($id);
        unlink(public_path($album->capa));
        foreach ($album->imagems as $key => $value) {
            unlink(public_path($value['thumbnail']));
            unlink(public_path($value['imagem']));
        }
        $album->delete();
        $albuns = Album::get();
        // return view('home',['albuns' => $albuns]);    

        $output = array(
            'success'  => 'Images uploaded successfully',
           );
      
           return response()->json($output);    
    }

    public function editar($id)
    {
        $album = Album::findOrFail($id);
        return view('auth.Album',['album' => $album]);
    }

    public function atualizarAlbum(Request $request, $ip)
    {

        $album = Album::findOrFail($ip);
        $nomeCapa = $album->capa;
        $album->update($request->all());
        if($request->capa != null)
        {
            unlink(public_path($nomeCapa));
            $album->capa = $this->saveCapa($request);
        }else
        {
            $album->capa = $nomeCapa;
        }
        $album->save();


        if($request->imagens != null)
        {
            $imagens = $this->saveImagens($request, $album);
        }
        $output = array(
            'success'  => 'Images uploaded successfully',
            'image'   => $imagens,
           );
        
           return response()->json($output);
    }

    private function saveCapa(Request $request)
    {
        $image = Image::make($request->capa);

        $image->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $imageName = 'imagens/Capa/'.time().'.'.request()->capa->getClientOriginalExtension();
        $image->save($imageName);

        return $imageName;
        
    }
    private function saveImagens(Request $request, $album)
    {
        $imagens = array();
        foreach ($request->imagens as $key => $value) {
            $image = Image::make($value);
            $imageName = 'imagens/fotos/'.time().'-'. $key .'.'.$value->getClientOriginalExtension();
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save($imageName);
            array_push($imagens, $imageName);

            $imageNameTumb = 'imagens/thumbnails/'.time().'-'. $key .'.'.$value->getClientOriginalExtension();
            $image->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save($imageNameTumb);

            $album->imagems()->create([
                'imagem' => $imageName,
                'thumbnail' => $imageNameTumb
            ]);
        }
        return $imagens;
    }

    public function deleteImagem($id)
    {
        $imagem = imagem::findOrFail($id);
        $idAlbum = $imagem->id_album;
        unlink(public_path($imagem->thumbnail));
        unlink(public_path($imagem->imagem));  
        $imagem->delete();      
        return  Redirect::to($idAlbum.'/editarAlbuns');
        
    } 



    public function publicao($status, $id)
    {
        $album = Album::findOrFail($id);
        if($status)
        {
            $album->status = 1;
        }else
        {
            $album->status = 0;
        }
        $album->save();
        return  Redirect::to('/home');
    }
}
