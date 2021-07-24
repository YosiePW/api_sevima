<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Vaksin;
use JWTAuth;
use DB;
use Auth;


class VaksinController extends Controller
{
    public $response;
    public $user;
    public function __construct(){
        $this->response = new ResponseHelper();

        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function getAllVaksin($limit = NULL, $offset = NULL)
    {
        if($this->user->level == 'masyarakat'){
            $data["count"] = Vaksin::where('id_user', '=', $this->user->id)->count();

            if($limit == NULL && $offset == NULL){
                $data["vaksin"] = Vaksin::where('id_user', '=', $this->user->id)->orderBy('id_vaksin', 'desc')->with('user' ,'tanggapan')->get();
            } else {
                $data["vaksin"] = Vaksin::where('id_user', '=', $this->user->id)->orderBy('id_vaksin', 'desc')->with('user','tanggapan')->take($limit)->skip($offset)->get();
            }
        } else {
            $data["count"] = Vaksin::count();

            if($limit == NULL && $offset == NULL){
                $data["vaksin"] = Vaksin::orderBy('id_vaksin', 'desc')->with('user','tanggapan')->get();
            } else {
                $data["vaksin"] = Vaksin::orderBy('id_vaksin', 'desc')->with('user','tanggapan')->take($limit)->skip($offset)->get();
            }
        }

        return $this->response->successData($data);
    }

    public function getById($id)
    {   
        $data["vaksin"] = Vaksin::where('id_vaksin', $id)->with(['user','tanggapan'])->get();

        return $this->response->successData($data);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nik' => 'required|string',
			'no_telp'   => 'required|string',
			'tgl_lahir' => 'required',
			'alamat'    => 'required',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}


		$vaksin = new Vaksin();
		$vaksin->id_user         = $this->user->id;
		$vaksin->nik     = $request->nik;
        $vaksin->no_telp   = $request->no_telp;
		$vaksin->tgl_lahir   = $request->tgl_lahir;
		$vaksin->alamat     = $request->alamat;
        $vaksin->status          = 'proses';
		$vaksin->save();

        $data = Vaksin::where('id_vaksin','=', $vaksin->id)->first();
        return $this->response->successResponseData('Data vaksin berhasil terkirim', $data);
    }

    public function changeStatus(Request $request, $id_vaksin)
    {
        $validator = Validator::make($request->all(), [
			'status'        => 'required|string',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$vaksin          = Vaksin::where('id_vaksin', $id_vaksin)->first();
		$vaksin->status  = $request->status;
		$vaksin->save();

        return $this->response->successResponse('Status berhasil diubah');
    }
}
