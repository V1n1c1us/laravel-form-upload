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
//use Intervention\Image\ImageManagerStatic as Image;
use Image;

class HomeController extends Controller
{
    private $produto;

    public function __construct(Produto $produto, Image $imga)
    {
        $this->produto = $produto;
        $this->imga = $imga;
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

        $fileName = str_random(30) . '.' . $request->file('image')->getClientOriginalExtension();

        $user_folder = 'foto_produto'.$request->id;
        $user_folder_thumb = 'foto_produto_thumb'.$request->id;

        $filenameextension = $request->file('image')->getClientOriginalName();

        $namefile = pathinfo($filenameextension, PATHINFO_FILENAME);

        $extension = $request->file('image')->getClientOriginalExtension();

        $filenamestore = $namefile.'_'.time().'.'.$extension;

        $request->file('image')->StoreAs('public/storage/foto_produto', $filenamestore);
        $request->file('image')->StoreAs('public/storage/foto_produto_thumb', $filenamestore);

        $thumbnailpath = public_path('storage/foto_produto_thumb'.$filenamestore);
        $img = Image::make($thumbnailpath)->resize(250,250)->save($thumbnailpath, 50);

       // if(Storage::allFiles($user_folder) == []){
            //$imga= Image::make($img);
            //$imga->save(public_path().$fullPath, 50);
            //$thumbnailpath = ""
             //= Image::make($img)->save(public_path().$fullPath, 50);
            //$request->file('image')->move($destination, $fileName);
            //$request->file('image')->move($destination_thumb, $fileName);

        //     //DB::table('produtos')->where('id', $request->id)->update(['image' => $fullPath]);
       // }
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
