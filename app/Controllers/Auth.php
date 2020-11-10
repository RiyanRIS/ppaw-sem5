<?php namespace App\Controllers;
 
use App\Models\Pembeli_model;
 
class Auth extends BaseController
{
    private $pembeli;

    public function __construct(){
        $this->pembeli = new Pembeli_model();
	}

	public function login($var = null)
	{
		if(isLogin()){
            session()->setFlashdata('info', [0,"Selamat Datang"]);
            return redirect()->to(site_url());
            die();
        }
		$data = array(
			"title" => "Log in Page",
			"nav" => "login",
		);
		return view('login',$data);
	}

	public function loginAdmin($var = null)
	{
		if(isLogin()){
            session()->setFlashdata('info', [0,"Selamat Datang"]);
            return redirect()->to(site_url());
            die();
        }
		$data = array(
			"title" => "Log in Page",
			"nav" => "login",
		);
		return view('loginAdmin',$data);
	}
	
	function loginA(){
		$us = $this->request->getPost('username');
		$cek = $this->pembeli->getSql("SELECT * FROM `pemesan` WHERE `username` = '$us'");
		if(count($cek)>=1){
			if(password_verify($this->request->getPost('password'),$cek[0]['password'])){
				$session = [
					"nama" => $cek[0]['nama'],
					"id" => $cek[0]['id'],
					"alamat" => $cek[0]['alamat'],
					"nohp" => $cek[0]['nohp'],
					"isLoggin" => true
				];
				session()->set($session);
				session()->setFlashdata('info', [1, "Selamat Datang."]);
                return redirect()->to(site_url());
				die();
			}else{
				session()->setFlashdata('info', [2, "Kombinasi email dan password belum tepat."]);
				return redirect()->to(site_url('login'));
				die();
			}
		}else{
			session()->setFlashdata('info', [2, "Kombinasi email dan password belum tepat."]);
			return redirect()->to(site_url('login'));
			die();
		}
	}

	function loginAdminA(){
		$us = $this->request->getPost('username');
		$cek = $this->pembeli->getSql("SELECT * FROM `admin` WHERE `username` = '$us'");
		if(count($cek)>=1){
			if(password_verify($this->request->getPost('password'),$cek[0]['password'])){
				$session = [
					"nama" => $cek[0]['nama'],
					"id" => $cek[0]['id'],
					"admin" => TRUE,
					"isLoggin" => true
				];
				session()->set($session);
				session()->setFlashdata('info', [1, "Selamat Datang."]);
                return redirect()->to(site_url());
				die();
			}else{
				session()->setFlashdata('info', [2, "Kombinasi email dan password belum tepat."]);
				return redirect()->to(site_url('login'));
				die();
			}
		}else{
			session()->setFlashdata('info', [2, "Kombinasi email dan password belum tepat."]);
			return redirect()->to(site_url('login'));
			die();
		}
	}
    
	public function signup()
	{
		$data = array(
			"title" => "Sign up Page",
			"nav" => "login",
		);
		return view('signup',$data);
    }
	
	public function signupA(){
    	$pw = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
		$data = array(
			'nama'  => $this->request->getPost('namapembeli'),
			'alamat'  => $this->request->getPost('alamat'),
			'nohp'  => $this->request->getPost('nohp'),
			'username'  => $this->request->getPost('username'),
			'password'  => $pw,
		);
		$status = $this->pembeli->simpan($data);
		session()->setFlashdata('info', [1, 'Berhasil mendaftar, silahkan login']);
		return redirect()->to(site_url('login'));
	}

	public function logout(){
		setcookie("cookie_blog_login", "", time() - 3600, "/");
		session()->destroy();
		return redirect()->to(site_url());
	}
}