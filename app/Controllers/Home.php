<?php namespace App\Controllers;

use App\Models\Transaksi_model;
use App\Models\Ikan_model;
use App\Models\Pembeli_model;
use App\Models\Admin_model;

class Home extends BaseController
{
	public function index()
	{
		$ikan = new Ikan_model();
		$data = [
			'ikan' =>  $ikan->getIkan()
		];
		return view('index',$data);
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
		}elseif($a == "pemesanan"){
			$transaksi = new Transaksi_model();
			$data = $transaksi->getSql("SELECT a.*, b.nama as namaikan, c.nama as namapemesan FROM transaksi a INNER JOIN ikan b ON a.ikan = b.id INNER JOIN pemesan c on a.pemesan = c.id WHERE a.id = '$id'");
			$data = $data[0];
		}
		return json_encode($data);
	}

	//--------------------------------------------------------------------

}
