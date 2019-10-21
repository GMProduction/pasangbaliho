<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class BalihoController extends Controller
{

    public function dataListAllBaliho()
    {

        try {
            $baliho = BalihoModel::all();

            return response()->json([
                'respon' => 'success',
                'message' => 'login sukses',
                'baliho' => $baliho
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 401);
        }
    }


}
