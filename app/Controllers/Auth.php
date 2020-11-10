<?php namespace App\Controllers;
 
use App\Models\Pembeli_model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
class Auth extends BaseController
{
    private $pembeli;

    public function __construct(){
        $this->pembeli = new Pembeli_model();
	}

	public function login($var = null)
	{
		$data = array(
			"title" => "Log in Page",
			"nav" => "login",
		);
		return view('login',$data);
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
				session()->setFlashdata('info', "Selamat Datang.");
                return redirect()->to(site_url());
				die();
			}else{
				session()->setFlashdata('info', "Kombinasi email dan password belum tepat.");
				return redirect()->to(site_url('login'));
				die();
			}
		}else{
			session()->setFlashdata('info', "Kombinasi email dan password belum tepat.");
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
		return view('auth/signup',$data);
    }
    
    function signupA(){
        $email = $this->request->getPost('email');
		$cekEmail = $this->users->getSql("SELECT `id` FROM `users` WHERE `email` = '$email'");
		if(count($cekEmail)>=1){
			session()->setFlashdata('info', [2,"Email sudah terdaftar."]);
			return redirect()->to(base_url('/index.php/daftar'));
			die();
		}
        $kirim = $this->sendVerif($email);
        $data = [
            "email" => $email,
            "password" => password_hash($this->request->getPost("password"),PASSWORD_DEFAULT),
            "name" => $this->request->getPost("name"),
			"hp" => $this->request->getPost("hp"),
			"role" => 2
        ];
		$simpan = $this->users->simpan($data);
		$db = \Config\Database::connect();
		$id = $db->insertID();
		if($simpan){
			$session = [
				"name" => $this->request->getPost("name"),
				"role" => 2,
				"id" => $id,
				"email" => $email,
				"isLoggin" => true
			];
			session()->set($session);
			session()->setFlashdata('info', [1,'Registration successfully']);
			return redirect()->to(base_url('index.php/reseller/profile'));
		}else{
			session()->setFlashdata('info', [2,'Registration failed']);
			return redirect()->to(base_url('index.php/auth/signup'));
		}
    }

    function sendVerif($email = null){
		$email = "xkunthil15@gmail.com";
        $subject = "Permintaan Aktivasi Email";
		$url = base_url("index.php/verif")."/".base64url_encode(strtotime(date("Y-m-d H:i:s")))."/".base64url_encode($email);
		$message = "Pada tanggal ".date("d F Y")." pada pukul ".date("H:i:s")." sistem kami menerima permintaan Aktivasi Email untuk akun anda pada website <a href='#'>jajangame.com</a>. Untuk aktivasi silahkan klik tautan berkut ini:<br><br>";
		$message .= "<a href='".$url."'>".$url."</a><br><br><br>Aktivasi ini hanya berlaku selama 1x24 jam setelah email ini kami kirim.<br>Jika anda tidak merasa melakukan permintaan ini maka abaikan email ini. <br><br><br> Hormat kami, <br> JajanGame.Com";
		
        $mail = new PHPMailer(true);
 
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.co.id';   
            $mail->SMTPAuth   = true;
            $mail->Username   = 'noreply@jajangame.com'; 
            $mail->Password   = 'WIlUvicZ5h@R'; 
            $mail->SMTPSecure = 'tsl';
            $mail->Port       = 587;
 
            $mail->setFrom('noreply@jajangame.com', '[NOREPLY] Email Activation'); 
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
 
            $mail->send();
            return true;
        } catch (Exception $e) {
			return false;
        }
    }

	public function loginEmail(){
		$email = $this->request->getPost('email');
		$cek = $this->users->getSql("SELECT id FROM users WHERE email = '$email'");
		if(count($cek)>=1){
			session()->set(["email"=>$email]);
			return redirect()->to(base_url('/index.php/auth/signin/password'));
			die();
		}else{
			session()->setFlashdata('info', [2,"Email tidak terdaftar di sistem kami."]);
			return redirect()->to(base_url('/index.php/auth/signin'));
			die();
		}
	}

	public function loginPassword(){
		$email = session()->get("email");
		$cek = $this->users->getSql("SELECT * FROM users WHERE email = '$email'");
		if(count($cek)>=1){
			if(password_verify($this->request->getPost('password'),$cek[0]['password'])){
				$session = [
					"name" => $cek[0]['name'],
					"id" => $cek[0]['id'],
					"image" => $cek[0]['image'],
					"email" => $cek[0]['email'],
					"isLoggin" => true
				];
				session()->set($session);
				session()->setFlashdata('info', [1,"Selamat Datang."]);
				return redirect()->to(base_url('/index.php/story'));
				die();
			}else{
				session()->setFlashdata('info', [2,"Password belum tepat."]);
				return redirect()->to(base_url('/index.php/auth/signin/password'));
				die();
			}
		}else{
			session()->setFlashdata('info', [2,"Email tidak terdaftar di sistem kami."]);
			return redirect()->to(base_url('/index.php/auth/signin'));
			die();
		}
	}


	function tes(){
		$db = \Config\Database::connect();
		echo $db->getVersion();
	}

	public function signupEmail(){
		$to      = $this->request->getPost('to');
		$tes = $this->users->getSql("SELECT id FROM users WHERE email = '$to'");
		if(count($tes)>=1){
			session()->setFlashdata('info', [2,"Email sudah terdaftar."]);
			return redirect()->to(base_url('/index.php/auth/signup'));
			die();
		}
		session()->setFlashdata('to',$to);
		$subject = "Permintaan Aktivasi Email";
		$url = base_url("index.php/verif")."/".base64url_encode(strtotime(date("Y-m-d H:i:s")))."/".base64url_encode($to);
		$message = "Pada tanggal ".date("d F Y")." pada pukul ".date("H:i:s")." sistem kami menerima permintaan Aktivasi Email untuk akun anda pada website <a href='#'>riyanris.my.id</a>. Untuk aktivasi silahkan klik tautan berkut ini:<br><br>";
		$message .= "<a href='".$url."'>".$url."</a><br><br><br>Aktivasi ini hanya berlaku selama 1x24 jam setelah email ini kami kirim.<br>Jika anda tidak merasa melakukan permintaan ini maka abaikan email ini. <br><br><br> Hormat kami, <br> RiyanRis";
		
        $mail = new PHPMailer(true);
 
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.googlemail.com';   
            $mail->SMTPAuth   = true;
            $mail->Username   = 'xkunthil15@gmail.com'; // silahkan ganti dengan alamat email Anda
            $mail->Password   = '7NM%ZL*R^bsjGNy5k63'; // silahkan ganti dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
 
            $mail->setFrom('xkunthil15@gmail.com', '[DO NOT REPLY]'); // silahkan ganti dengan alamat email Anda
            $mail->addAddress($to);
            $mail->addReplyTo('xkunthil15@gmail.com', 'RIYANRIS'); // silahkan ganti dengan alamat email Anda
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
 
			$mail->send();
			session()->setFlashdata('info', [1,"Please check your email and login disana!"]);
			return redirect()->to(base_url('/index.php/auth/signup'));
        } catch (Exception $e) {
			session()->setFlashdata('info', [2,"We are unable to reach your email"]);
			return redirect()->to(base_url('/index.php/auth/signup'));
        }
	}
	
	public function verifikasi($time,$email){
		$time1 = date("Y-m-d H:i:s", base64url_decode($time));
		$now = date("Y-m-d H:i:s");
		$diff = abs(strtotime($now) - strtotime($time1));

		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		$email1 = base64url_decode($email);
		session()->setFlashdata('to',$email1);

		$data = array(
			"title" => "Sign up Page",
			"nav" => "login",
			"time" => $time,
			"email" => $email
		);

		if($days >= 1){
			return view('auth/kadaluarsa',$data);
		}else{
			
			return view('auth/verif', $data);
		}
	}

	public function signupSave(){
		$email = $this->request->getPost('email');
		$name = $this->request->getPost('name');
		$password = $this->request->getPost('password');
		$pass_confirm = $this->request->getPost('pass_confirm');
		$tes = [
			'email' => $email,
			'name' => $name,
			'password' => $password,
			'pass_confirm' => $pass_confirm,
		];
		if($this->form_validation->run($tes, 'signup') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $this->form_validation->getErrors());
			return redirect()->to(base_url('index.php/verif/'.$this->request->getPost('satu')."/".$this->request->getPost('dua')));
			die();
        } else {
			$data = [
				'email' => $email,
				'name' => $name,
				'password' => password_hash($password,PASSWORD_DEFAULT),
				'role' => 'Author'
			];
			$result = $this->users->simpan($data);
			$db = \Config\Database::connect();
			$id = $db->insertID();
			if($result){
				$session = [
					"name" => $name,
					"image" => "",
					"id" => $id,
					"email" => $email,
					"isLoggin" => true
				];
				session()->set($session);
				session()->setFlashdata('info', [1,'Registration successfully']);
				return redirect()->to(base_url('index.php/setting/profile'));
			}else{
				session()->setFlashdata('info', [2,'Registration failed']);
				return redirect()->to(base_url('index.php/auth/signup'));
			}
		}
	}

	public function isForgot(){
		$to = session()->get('email');
		$tes = $this->users->getSql("SELECT id FROM users WHERE email = '$to'");
		if(count($tes)==0){
			session()->setFlashdata('info', [2,"Email tidak terdaftar."]);
			return redirect()->to(base_url('/index.php/auth/signup'));
			die();
		}
		$subject = "Permintaan Perubahan Password";
		$url = base_url("index.php/auth/change-password")."/".base64url_encode(strtotime(date("Y-m-d H:i:s")))."/".base64url_encode($to);
		$message = "Pada tanggal ".date("d F Y")." pada pukul ".date("H:i:s")." sistem kami menerima permintaan Perubahan Password untuk akun anda pada website <a href='#'>riyanris.my.id</a>. Untuk melakukan perubahan password silahkan klik tautan berkut ini:<br><br>";
		$message .= "<a href='".$url."'>".$url."</a><br><br><br>Link ini hanya berlaku selama 1x24 jam setelah email ini kami kirim.<br>Jika anda tidak merasa melakukan permintaan ini maka abaikan email ini. <br><br><br> Hormat kami, <br> RiyanRis";
		
        $mail = new PHPMailer(true);
 
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.googlemail.com';   
            $mail->SMTPAuth   = true;
            $mail->Username   = 'xkunthil15@gmail.com'; // silahkan ganti dengan alamat email Anda
            $mail->Password   = '7NM%ZL*R^bsjGNy5k63'; // silahkan ganti dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
 
            $mail->setFrom('xkunthil15@gmail.com', '[DO NOT REPLY]'); // silahkan ganti dengan alamat email Anda
            $mail->addAddress($to);
            $mail->addReplyTo('xkunthil15@gmail.com', 'RIYANRIS'); // silahkan ganti dengan alamat email Anda
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
 
			$mail->send();
			session()->setFlashdata('info', [1,"Please check your email and ubah password disana!"]);
			return redirect()->to(base_url('/index.php/auth/signup'));
        } catch (Exception $e) {
			session()->setFlashdata('info', [2,"We are unable to reach your email"]);
			return redirect()->to(base_url('/index.php/auth/signup'));
        }
	}

	public function changePassword($time,$email){
		$time1 = date("Y-m-d H:i:s", base64url_decode($time));
		$now = date("Y-m-d H:i:s");
		$diff = abs(strtotime($now) - strtotime($time1));

		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		$email1 = base64url_decode($email);
		session()->setFlashdata('to',$email1);

		$data = array(
			"title" => "Sign up Page",
			"nav" => "login",
			"time" => $time,
			"email" => $email
		);

		if($days >= 1){
			return view('auth/kadaluarsa',$data);
		}else{
			session()->set(["email "=> $email1]);
			return view('auth/password', $data);
		}
	}

	public function aksiChangePassword(){
		$pw1 = $this->request->getPost('password1');
		$pw2 = $this->request->getPost('password2');
		$tes = [
			'pas1' => $pw1,
			'pas2' => $pw2,
		];
		if($this->form_validation->run($tes, 'resetpw') == FALSE){
            session()->setFlashdata('errors', $this->form_validation->getErrors());
			return redirect()->to(base_url('index.php/change-password/'.$this->request->getPost('satu')."/".$this->request->getPost('dua')));
			die();
        } else {
			$email = session()->get('email');
			$cek = $this->users->getSql("SELECT id FROM users WHERE email = '$email'");
			$data = array(
				'password' => password_hash($pw1,PASSWORD_DEFAULT),
			);
			$status = $this->users->ubah($data,$cek[0]['id']);
			if($status){
				session()->setFlashdata('info', [1,'Berhasil mengubah data']);
				return redirect()->to(base_url('/index.php/auth/signin'));
			}else{
				session()->setFlashdata('info', [2,'Gagal mengubah data']);
				return redirect()->to(base_url('index.php/change-password/'.$this->request->getPost('satu')."/".$this->request->getPost('dua')));
			}
		}
	}

	public function logout(){
		setcookie("cookie_blog_login", "", time() - 3600, "/");
		session()->destroy();
		return redirect()->to(site_url());
	}
}