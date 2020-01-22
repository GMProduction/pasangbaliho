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

        $beritaCorusel = NewsModel::query()
        ->orderBy('created_at', 'desc')
        ->limit(4)
        ->get();

        $berita = NewsModel::query()
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $dom = new Dom;
        // $dom->loadStr($berita[0]->isi,[]);
        // $isi1 = $dom->find('p')[0];
        // $isi = $isi1->text;
        // $dom->load('<div class="all"><p>Hey bro, <a href="google.com">click here</a><br /> :)</p></div>');
        // $isi = $dom->outerHtml; 
        
        return view('main/news', compact(['berita','beritaCorusel']));
    }

    public function showdetailNews($judul,$id){
        $berita = NewsModel::query()
        ->where('id_news','=',$id)
        ->get();

        return view('item.detailNews')->with('berita',$berita);
    }

    public function detailNews($id){
        $berita = NewsModel::query()
        ->where('id_news','=',$id)
        ->get();

        return view('item.detailsNews')->with('berita',$berita);
    }
   
}
