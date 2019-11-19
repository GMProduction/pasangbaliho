<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\models\SliderModel;

class SliderController extends Controller
{

    public function getSlider()
    {

        try {
            $slider = SliderModel::where("terlihat","1")
            ->get();

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data Slider',
                'slider' => $slider
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }
}
