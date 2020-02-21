<?php

namespace App\Http\Controllers\Member\client;

use App\Http\Controllers\Controller;
use App\models\ClientModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class profileController extends Controller
{
    //
    public function getDataProfile($id){
       
        $query = ClientModel::query()
            ->where('id_client','=',$id)
            ->get();

        $data = [
            'profile' => $query
        ];

        return view('client.data.profile')->with($data);
        // echo $query;

    }

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
                ClientModel::query()
                    ->where('id_client','=',$id)
                    ->update($data);
               return redirect('/dashboardClient/profile/'.$id)->with($massege);
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
                return redirect()->back()->with($massege);
            }
        }
    }

    public function validasiEditKhusus(Request $r){
        $rule = [
            'ktp' => 'required',
            'nib' => 'required',
            'npwp' => 'required',
        ];
        return Validator::make($r->all(), $rule);
    }

    public function editProfilKhusus(Request $r){
        if($this->validasiEditKhusus($r)->fails()){
            $errors = $this->validasiEdit($r)->errors();
            $massege = [
                'status' => 'Gagal validasi data',
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
                    'no_ktp' => $r->ktp,
                    'nib' => $r->nib,
                    'npwp' => $r->npwp
                ];
                ClientModel::query()
                    ->where('id_client','=',$id)
                    ->update($data);
               return redirect('/dashboardClient/profile/'.$id)->with($massege);
            //    echo $data;
            } catch (\Throwable $e) {
                $exData = explode('(', $e->getMessage());
                //throw $th;
                $massege = [
                    'status' => 'Gagal merubah data',
                    'text' => $e,
                    'icon' => 'error'
                ];
                // echo $exData[0];
                return redirect()->back()->with($massege);
            }
        }
    }
}
