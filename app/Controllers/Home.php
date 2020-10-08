<?php namespace App\Controllers;

use App\Models\Ikan_model;
use App\Models\Pembeli_model;
use App\Models\Admin_model;

class Home extends BaseController
{
	public function index()
	{
		return view('index');
	}

	public function getJson($a){
		$id = $this->request->getPost('id');
		if($a == "ikan"){
			$ikan = new Ikan_model();
			$data = $ikan->getIkan($id)->getResult();
			$data = $data[0];
		}elseif($a == "pembeli"){
			$pembeli = new Pembeli_model();
			$data = $pembeli->getPembeli($id)->getResult();
			$data = $data[0];
		}elseif($a == "admin"){
			$admin = new Admin_model();
			$data = $admin->getAdmin($id)->getResult();
			$data = $data[0];
		}
		return json_encode($data);
	}

	//--------------------------------------------------------------------

}
