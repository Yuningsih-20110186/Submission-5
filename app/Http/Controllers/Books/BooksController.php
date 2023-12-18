<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Authors\AuthorController;
use App\Http\Controllers\Controller;
use App\Models\Books;
use Exception;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(){

        $model = new Books();
        $data = $model->select(
            'books.id',
            'nama_buku',
            'authors.id_penulis',
            'authors.nama_penulis',
            'nama_penerbit',
            'tahun_terbit',
            'published_at',
        )
        ->leftJoin('authors', 'books.id_penulis', '=', 'authors.id_penulis')
        ->get()->toArray();

        $dataAuthor = AuthorController::getAuthors();

        return view('books/index', compact('data', 'dataAuthor'));
    }

    public function saveBook(Request $request){
        $post = $request->post();

        $body['id'] = $post['id'];
        $body['nama_buku'] = $post['nama_buku'];
        $body['id_penulis'] = $post['id_penulis'];
        $body['nama_penerbit'] = $post['nama_penerbit'];
        $body['tahun_terbit'] = $post['tahun_terbit'];

        $sukses = 'Data Sukses Disimpan!';
        $gagal = 'Data Gagal Disimpan!';

        if (isset($body['id'])) {
            $result = self::updateBook($body);
        } else {
            $result = self::createBook($body);
        }

        if ($result == true) {
            return redirect('books/index')->with('status', $sukses);
        } else {
            return redirect('books/index')->with('status', $gagal);
        }
    }

    private function createBook($body){

        $model = new Books();
        try{
            $sukses = 'Data Sukses Disimpan!';
            $gagal = 'Data Gagal Disimpan!';
            if(isset($body['nama_buku'])){
                $model->create($body);
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }

    private function updateBook($body){
        $model = new Books();
        try{
            $sukses = 'Data Sukses Disimpan!';
            $gagal = 'Data Gagal Disimpan!';

            if(isset($body['nama_buku'])){
                $model->where('id', $body['id'])->update($body);
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteBook(Request $request){
        $id = $request->get('id');
        try{
            $model = new Books();
            $model->find($id)->delete();
            return redirect('books/index')->with('alert', 'Data Sukses Dihapus!');
        } catch(Exception $e){
            return redirect('books/index')->with('alert', 'Data Gagal Dihapus!');
        }
    }
}
