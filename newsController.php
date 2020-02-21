<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Master\productModel;
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
        ->where('id_news','>', $beritaCorusel[3]->id_news)
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
        $product = productModel::query()
        ->select(
            'balihos.id_baliho as id_baliho',
            'balihos.nama_baliho as nama_baliho',
            'balihos.alamat as alamat',
            'kotas.nama_kota as kota',
            'kategoris.kategori as kategori',
            'provinsis.nama_provinsi as provinsi',
            'balihos.harga_client as harga_client',
            'balihos.lebar as lebar',
            'balihos.tinggi as tinggi',
            'balihos.orientasi as orientasi',
            'balihos.harga_market as harga_market',
            'balihos.harga_max as harga_max',
            'balihos.tampil_harga as tampil_harga',
            'balihos.deskripsi as deskripsi',
            'foto_baliho.url_foto as url_foto'
        )
        ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
        ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
        ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
        ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
        ->where('balihos.status','=','publish')
        ->groupBy('balihos.id_baliho')
        ->orderBy('balihos.created_at','DESC')
        ->inRandomOrder()
        ->limit(4)
        ->get();
        
        $berita = NewsModel::query()
        ->where('id_news','=',$id)
        ->get();

        $beritaSamping = NewsModel::query()
        ->inRandomOrder()
        ->limit(4)
        ->get();

        $data = [
            'berita' => $berita,
            'produk' => $product,
            'beritaSamping' => $beritaSamping
        ];

        return view('item.detailNews')->with($data);
    }

    public function detailNews($id){
        $berita = NewsModel::query()
        ->where('id_news','=',$id)
        ->get();

        return view('item.detailsNews')->with('berita',$berita);
    }
   
}
