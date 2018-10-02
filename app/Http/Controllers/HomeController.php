<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
//MODEL's
use App\Produto;

class HomeController extends Controller
{
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function home ()
    {
        $produtos = $this->produto->paginate(3);

        return view('home', compact('produtos'));
    }

    public function add (Request $request)
    {
        //get all data form
        $nome = $request->input('nome');
        $descricao = $request->input('descricao');
        $img = $request->file('image');
        $fileName = str_random(30) . '.' . '' . $request->file('image')->getClientOriginalExtension();
        $user_folder = 'foto_produto'.$request->id;
        $destination = public_path() . DIRECTORY_SEPARATOR .'storage'. DIRECTORY_SEPARATOR . $user_folder;
        $fullPath = DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . $user_folder . DIRECTORY_SEPARATOR .$fileName;

        if(Storage::allFiles($user_folder) == []){
             $request->file('image')->move($destination, $fileName);
        //     //DB::table('produtos')->where('id', $request->id)->update(['image' => $fullPath]);
        }
        //make store
        $insert = $this->produto->create([
            'nome' => $nome,
            'descricao' =>$descricao,
            'image' => $fileName
        ]);
        $response = [
            'msg' => 'Criado com sucesso',
            'data' => $insert
        ];

        if($insert){
            return response()->json($response, 201);
        } else {
            return redirect('/');
        }

    }

    public function info ($id)
    {
        $produto = $this->produto->find($id);

        return view ('info', compact('produto'));
    }
    public function update($id)
    {
        $prod = $this->produto->find($id);
        $update = $prod->update([

        ]);
        if($update) {
            return 'ok';
        } else {
            return 'erro';
        }
    }

    public function delete ($id)
    {
        $prod = $this->produto->find($id);
        $file = unlink(public_path(). DIRECTORY_SEPARATOR .'storage'. DIRECTORY_SEPARATOR .'foto_produto'. DIRECTORY_SEPARATOR . $prod->image);
        $delete = $prod->delete();
        if($delete){
             return redirect('/');
        } else {
             return 'erro';
        }
    }
}
