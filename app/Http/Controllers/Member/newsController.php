<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\models\NewsModel;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class newsController extends Controller
{
    //
    public function showNews(){
        $berita = NewsModel::query()
        ->paginate(10);

        $dom = new Dom;
        $dom->loadStr($berita[0]->isi,[]);
        // $isi1 = $dom->find('p')[0];
        // $isi = $isi1->text;
        // $dom->load('<div class="all"><p>Hey bro, <a href="google.com">click here</a><br /> :)</p></div>');
        $isi = $dom->outerHtml; 
        
        return view('main/news', compact(['berita','isi']));
    }
   
}
