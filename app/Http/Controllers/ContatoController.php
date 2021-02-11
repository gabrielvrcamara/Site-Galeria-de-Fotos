<?php

namespace DavidPeixoto\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContatoController extends Controller
{



    public function index(Request $request){

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required', 
            'mensagem' => 'required', 
        ]);
        $nome = $request->nome;
        $email = $request->email;
        $mensagem = $request->mensagem;

        $a = Mail::send('mail.sendMail',['nome' => $nome, 'email' => $email, 'mensagem' => $mensagem], function($m) {
            $m->subject('Contato Site nome:');
            $m->from('sitedpeixotofotografo@gmail.com', 'Site David');
            $m->to('gabrielvrcamara@gmail.com');
            // $m->to('dpeixotofotografo@gmail.com);

        });

        $output = array(
            'success'  => 'true'
           );
      
           return response()->json($output);
    }
}
