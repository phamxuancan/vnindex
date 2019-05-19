<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
class HomeController extends Controller
{
    public function index() {
        return view('app');
    }
    public function pivot_add(){
        $article = Article::with('tags')->find(1)->toArray();
        dd($article);
        $article->tags()->sync([123, 456, 789]);
    }
    public function collection_put(){
        $req = collect();
        $req->put('1',2);
        $req->put('2',2);
        $data = $req->all();
        dd($data);
    }
    public function test_data(){
        $article = Data::find(3)->toArray();
        dd(json_decode($article['data']));
        $flight = new Data;
        $data = array(
            'name'=>'ers',
            'test'=>'ers',
            'value'=>123
        );
        $flight->data = json_encode($data);

        $flight->save();
    }
    
}
