<?php

namespace App\Http\Controllers\Authors;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AuthorController extends Controller
{
    public static function getAuthors(){

        try {
            $model = new Authors();
            $data = $model->select(
                'id_penulis',
                'nama_penulis'
            )->get()->toArray();

            return $data;
        } catch(Exception $e){
            return $e;
        }
    }

    public function index () {
        $model = new Authors();
        $data = $model->select(
            'id_penulis',
            'nama_penulis',
        )->get()->toArray();

        $dataAuthor = AuthorController::getAuthors();

        return view('authors/index', compact('data'));
    }

    public function saveAuthors(Request $request){
        $post = $request->post();
        $body['id_penulis'] = Uuid::uuid4();
        $body['nama_penulis'] = $post['nama_penulis'];

        try{
            $model = new Authors();
            $model->create($body);
            return redirect('authors/index')->with('status', 'Sukses');
        }catch(Exception $e){
            return redirect('authors/index')->with('status', 'Gagal');
        }
    }
}
