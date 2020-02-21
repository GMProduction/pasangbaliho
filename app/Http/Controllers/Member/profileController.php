<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Master\advertiserModel as MasterAdvertiserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\AdvertiserModel;
use Image;

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

    public function editFoto(Request $r){
        if ($r->hasFile('foto')) {
            $image = $r->file('foto');
            $namaFoto = $r->id . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize16 = Image::make($image->getRealPath());
            $image_resize->resize(200, 200);
            $image_resize16->resize(20, 20);
            $image_resize->save(public_path('assets/account/' . $namaFoto));
            $image_resize16->save(public_path('assets/account/avatar/' . $namaFoto));
        } else {
            $namaFoto = '';
        }
        try {
            $id = $r->id;
            $data = [
                'avatar' => $namaFoto,
                
            ];
            MasterAdvertiserModel::query()
                ->where('id', '=', $id)
                ->update($data);
                return redirect('/member');
        } catch (\Throwable $e) {
            $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                // return redirect()->back()->withInput();
                echo 'asd';
            //throw $th;
        }
  
    }

}
