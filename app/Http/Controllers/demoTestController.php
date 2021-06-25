<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Book;

class demoTestController extends Controller
{
    protected $url = "https://www.anapioficeandfire.com/api/books";

        
    protected function externalEndPoint($url)
    {
        $client = new Client();

        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());

        $output = [];
        foreach($responseBody as $d => $a){
            $output[] = [
                            'name' => $a->name,
                            'isbn' => $a->isbn,
                            'authors' => $a->authors,
                            'number_of_pages' => $a->numberOfPages,
                            'publisher' => $a->publisher,
                            'country' => $a->country,
                            'released_date' => $a->released
                        ];
        };

        return response($output);
    }

    public function searchBookWithParam(Request $request){
        $queryParam = $request->query('name');

        $url = $this->url;

        $res = $this->externalEndPoint($url)->original;
        
        $key = array_search($queryParam, array_column($res, 'name'));

        $data = $res[$key];

        if($key){
            return response([
                "status" => 201,
                "message" => "External books searched",
                "data" => $data
            ]);
        }
        
        return response([
            "status" => 204,
            "message" => "Invalid request",
        ]);
    }

    public function createBook(Request $request){
        $book = new Book;

        $book->name = $request->input('name');
        $book->isbn = $request->input('isbn'); 
        $book->authors = $request->input('authors');
        $book->country = $request->input('country');
        $book->number_of_pages = $request->input('number_of_pages');
        $book->publisher = $request->input('publisher');
        $book->release_date = $request->input('release_date');  
        

        if ($book->save()) {
            $book->message = "Books added";
            $book->status_code = 201;
            return new BookResource($book);
        } 
    }

    public function getBook(Request $request){
        $get_books = Book::get();
        
        $output = [];
        foreach($get_books as $d => $a){
            $output[] = [
                            'id' => $a->id,
                            'name' => $a->name,
                            'isbn' => $a->isbn,
                            'authors' => $a->authors,
                            'number_of_pages' => $a->numberOfPages,
                            'publisher' => $a->publisher,
                            'country' => $a->country,
                            'released_date' => $a->released
                        ];
        };

        return response([
            "status" => 201,
            "message" => "Book retrieved",
            "data" => $output
        ]);
    }

    public function updateBook(Request $request, $id){
        $book = Book::findOrFail($id);
        
        $book->name = $request->input('name');
        $book->isbn = $request->input('isbn'); 
        $book->authors = $request->input('authors');
        $book->country = $request->input('country');
        $book->number_of_pages = $request->input('number_of_pages');
        $book->publisher = $request->input('publisher');
        $book->release_date = $request->input('release_date');  
        

        if ($book->save()) {
            $book->message = "Books updated";
            $book->status_code = 201;
            return new BookResource($book);
        } 
    }

    public function deleteBook(Request $request, $id){
        $delete_books = Book::where('id',$id)->delete();

        return response([
            "status" => 201,
            "message" => "Book deleted",
        ]);
    }

    public function showBook(Request $request, $id){
        $book_show = Book::where('id',$id)->get();

        $output = [];
        foreach($book_show as $d => $a){
            $output[] = [
                            'id' => $a->id,
                            'name' => $a->name,
                            'isbn' => $a->isbn,
                            'authors' => $a->authors,
                            'number_of_pages' => $a->numberOfPages,
                            'publisher' => $a->publisher,
                            'country' => $a->country,
                            'released_date' => $a->released
                        ];
        };

        return response([
            "status" => 201,
            "message" => "Book retrieved",
            "data" => $output
        ]);
    }
}