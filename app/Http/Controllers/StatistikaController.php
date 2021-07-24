<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Statistika;


class StatistikaController extends Controller
{
    public $response;
    public function __construct(){
        $this->response = new ResponseHelper();
    }
    
    public function getAll($limit = NULL, $offset = NULL)
    {
        $data["count"] = Statistika::count();
        
        if($limit == NULL && $offset == NULL){
            $data["statistika"] = Statistika::get();
        } else {
            $data["statistika"] = Statistika::take($limit)->skip($offset)->get();
        }

        return $this->response->successData($data);
    }

    public function getById($id)
    {   
        $data["statistika"] = Statistika::where('id_statistik', $id)->get();

        return $this->response->successData($data);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'provinsi'  => 'required|string',
            'kota'      => 'required|string',
            'positif'   => 'required|string',
            'sembuh'    => 'required|string',
            'meninggal' => 'required|string',

		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$statistika = new Statistika();
		$statistika->provinsi = $request->provinsi;
        $statistika->kota = $request->kota;
        $statistika->positif = $request->positif;
        $statistika->sembuh = $request->sembuh;
        $statistika->meninggal = $request->meninggal;
		$statistika->save();

        $data = Statistika::where('id_statistik','=', $statistika->id_statistik)->first();
        return $this->response->successResponseData('Data statistika berhasil ditambahkan', $data);
    }

    public function update(Request $request, $id_statistik)
    {
        $validator = Validator::make($request->all(), [
			'positif'        => 'required|string',
            'sembuh'        => 'required|string',
            'meninggal'        => 'required|string',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$statistika          = Statistika::where('id_statistik', $id_statistik)->first();
		$statistika->positif  = $request->positif;
        $statistika->sembuh  = $request->sembuh;
        $statistika->meninggal  = $request->meninggal;
		$statistika->save();

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
