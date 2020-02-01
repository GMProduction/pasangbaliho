<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\NewsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Validator;

class NewsControll extends Controller
{
    //
    public function getNews(Request $r){
        $news = NewsModel::query()
            ->select('id_news', 'judul', 'isi', 'gambar', 'link', 'status')
            ->where('judul', 'LIKE', '%'.$r->index.'%')
            ->where('status', 'LIKE', '%'.$r->status.'%')
            ->get();
        return response()->json($news, 200);
    }
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
                $now = Carbon::now()->format('YmdHisu');
                $name = $now.'.'.$image->getClientOriginalExtension();
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

    public function patchNews(Request $r){
        $validator = Validator::make($r->all(),[
            'judul' => 'required',
            'isi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 202); 
        }

        try {
            $data = [
                'judul' => $r->judul,
                'isi' => $r->isi,
            ];

            $name = '';
            if ($r->hasFile('gambar')) {
                $image = $r->file('gambar');
                $now = Carbon::now()->format('YmdHisu');
                $name = $now.'.'.$image->getClientOriginalExtension();
                $data = Arr::add($data, 'gambar', $name);
                $image_resize = Image::make($image);
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('assets/img/news/' . $name));
            }

            
            NewsModel::query()
            ->where('id', '=', $r->id)
            ->update($data);
            
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }
}
