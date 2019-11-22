<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\models\NewsModel;

class NewsController extends Controller
{

    public function getDataNews()
    {

        try {
            $news = NewsModel::orderBy('created_at', 'DESC')
            ->paginate(20);

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data News',
                'data' => $news
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }
}
