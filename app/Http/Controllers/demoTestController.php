<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class demoTestController extends Controller
{
    protected $url = "https://www.anapioficeandfire.com/api/books";
        

    protected function externalEndPoint($url)
    {
        $client = new Client();

        $headers = [
            'api-key' => 'k3Hy5qr73QhXrmHLXhpEh6CQ'
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());

        $output = [];

        if(count($output) < 1){
            return response($output);
        }

        foreach($responseBody as $d => $a){
            $output[] = [
                        'name' => $a->name,
                        'isbn' => $a->isbn,
                        'authors' => $a->authors,
                        'numberOfPages' => $a->numberOfPages,
                        'publisher' => $a->publisher,
                        'country' => $a->country,
                        'mediaType' => $a->mediaType,
                        'released' => $a->released
                    ];
        };
        
        return response($output);
    }

    public function searchBookWithParam(Request $request){
        $url = $this.url();

        $output = $this->externalEndPoint($url);

        return response([
            "status" => 201,
            "message" => "External books searched",
            "data" => $output
        ]);

        return response([
            "status" => 404,
            "message" => "Invalid request",
        ]);
    }

    public function postBook(Request $request){
        $url = "https://www.anapioficeandfire.com/api/";
        return response([
            "status" => 201,
            "message" => "External books searched",
            "data" => []
        ]);

        return response([
            "status" => 201,
            "message" => "Invalid request",
        ]);
    }

    public function getBook(Request $request){
        $url = $this->url;

        $res = $this->externalEndPoint($url)->original;

        return response([
            "status" => 201,
            "message" => "External books searched",
            "data" => $res
        ]);
    }

    public function updateBook(Request $request, $id){
        $url = "https://www.anapioficeandfire.com/api/";
        return response([
            "status" => 201,
            "message" => "External books searched",
            "data" => []
        ]);
    }

    public function deleteBook(Request $request, $id){
        $url = "https://www.anapioficeandfire.com/api/";
        return response([
            "status" => 201,
            "message" => "Books deleted",
        ]);
    }

    public function showBook(Request $request, $id){
        $url = $this->url . '/' . $id;

        $res = $this->externalEndPoint($url)->original;

        return response([
            "status" => 201,
            "message" => "External books searched",
            "data" => $res
        ]);
    }
}
