<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\AdvertiserModel;


class profileController extends Controller
{
    //

    public function validasiEdit(Request $r){
        $rule = [
            'nama' => 'required|max:191',
            'telp' => 'required|numeric|digits_between:1,15',
            'alamat' => 'required',
            'instansi' => 'required'
        ];
        return Validator::make($r->all(), $rule);
    }

    public function editProfile(Request $r){
        if($this->validasiEdit($r)->fails()){
            $errors = $this->validasiEdit($r)->errors();
            $massege = [
                'status' => 'Gagal merubah data',
                'text' => $errors,
                'icon' => 'error'
            ];
            // echo $errors;
            return redirect()->with($massege)->withInput();
        }else{
            try {
                //code...
                $massege = [
                    'status' => 'Berhasil',
                    'text' => 'Data Berhasil Dirubah',
                    'icon' => 'success'
                ];
                $id = $r->id;
                $data = [
                    'nama' => $r->nama,
                    'telp' => $r->telp,
                    'alamat' => $r->alamat,
                    'nama_instansi' => $r->instansi
                ];
                AdvertiserModel::query()
                    ->where('id','=',$id)
                    ->update($data);
               return redirect('/dashboard/profile/'.$id)->with($massege);
            //    echo $data;
            } catch (\Throwable $e) {
                $exData = explode('(', $e->getMessage());
                //throw $th;
                $massege = [
                    'status' => 'Gagal merubah data',
                    'text' => $exData[0],
                    'icon' => 'error'
                ];
                // echo $exData[0];
                return redirect()->back()->withErrors($massege)->withInput();
            }
        }
    }
}
