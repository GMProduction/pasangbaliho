<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\NewsModel;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Validator;

class NewsControll extends Controller
{
    //
    public function addNews(Request $r){
        $validator = Validator::make($r->all(),[
            'judul' => 'required',
            'isi' => 'required',
            'gambar' =>'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 202); 
        }

        try {
            $name = '';
            if ($r->hasFile('gambar')) {
                $image = $r->file('gambar');
                $name = $image->getClientOriginalName();
                $image_resize = Image::make($image);
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('assets/img/news/' . $name));
            }
            $news = new NewsModel;
            $news->judul = $r->judul;
            $news->isi = $r->isi;
            $news->gambar = $name;
            $news->link = $r->link;
            $news->status = $r->status;
            $news->save();
            return response()->json(['Succes' => 'News Created!'], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['errorType' => 'exception', 'error' =>  $exData[0]], 500);
        }
    }
}
