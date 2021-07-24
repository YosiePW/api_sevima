<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\RSakit;

class RSakitController extends Controller
{
    public $response;
    public function __construct(){
        $this->response = new ResponseHelper();
    }
    
    public function getAll($limit = NULL, $offset = NULL)
    {
        $data["count"] = RSakit::count();
        
        if($limit == NULL && $offset == NULL){
            $data["rsakit"] = RSakit::get();
        } else {
            $data["rsakit"] = RSakit::take($limit)->skip($offset)->get();
        }

        return $this->response->successData($data);
    }

    public function getById($id)
    {   
        $data["rsakit"] = RSakit::where('id_rumahsakit', $id)->get();

        return $this->response->successData($data);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'provinsi'  => 'required|string',
            'kota'      => 'required|string',
            'nama_rs'   => 'required|string',
            'alamat'    => 'required|string',
            'jumlah_kamar' => 'required|string',

		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$rsakit = new RSakit();
		$rsakit->provinsi = $request->provinsi;
        $rsakit->kota = $request->kota;
        $rsakit->nama_rs = $request->nama_rs;
        $rsakit->alamat = $request->alamat;
        $rsakit->jumlah_kamar = $request->jumlah_kamar;
		$rsakit->save();

        $data = RSakit::where('id_rumahsakit','=', $rsakit->id_rumahsakit)->first();
        return $this->response->successResponseData('Data rumah sakit berhasil ditambahkan', $data);
    }

    public function update(Request $request, $id_rumahsakit)
    {
        $validator = Validator::make($request->all(), [
			'jumlah_kamar'        => 'required|string',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$rsakit          = rsakit::where('id_rumahsakit', $id_rumahsakit)->first();
		$rsakit->jumlah_kamar  = $request->jumlah_kamar;
		$rsakit->save();

        return $this->response->successResponse('Update berhasil');
    }

    public function delete($id)
    {
        $delete = Statistika::where('id_statistik', $id)->delete();

        if($delete){
            return $this->response->successResponse('Data statistika berhasil dihapus');
        } else {
            return $this->response->errorResponse('Data statistika gagal dihapus');
        }
    }
}
