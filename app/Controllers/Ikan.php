<?php namespace App\Controllers;
 
use App\Models\Ikan_model;
 
class Ikan extends BaseController
{
    private $ikanM;

    public function __construct(){
        $this->ikanM = new Ikan_model();
    }

    public function index()
    {
        if(!isLogin() || !session()->has('admin')){
            session()->setFlashdata('info', [2,"Silahkan Login Terlebih Dahulu"]);
            return redirect()->to(site_url('login'));
            die();
        }
        $data['ikan'] = $this->ikanM->getIkan();
        echo view('ikan',$data);
    }

    public function aksi(){
        if(!isLogin() || !session()->has('admin')){
            session()->setFlashdata('info', [2,"Silahkan Login Terlebih Dahulu"]);
            return redirect()->to(site_url('login'));
            die();
        }
        if($this->request->getPost('status')=="tambah"){
            $avatar = $this->request->getFile('image');
            if(empty($avatar->getName())){
                $data = array(
                    'nama'  => $this->request->getPost('namaikan'),
                    'deskripsi'  => $this->request->getPost('deskripsi'),
                    'harga'  => $this->request->getPost('harga'),
                    'gambar'  => "",
                    'status'  => "1",
                );
            }else{
				$validated = $this->validate([
					'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,3032]'
				]);
				if ($validated == FALSE) {
					session()->setFlashdata('info', [2,'Photo belum memenuhi syarat.']);
					return redirect()->to(base_url('/index.php/setting/profile'));
					die();
				}
		
				$newName = $avatar->getRandomName();
				$avatar->move(ROOTPATH . 'public/assets/img/', $newName);
				$image = $avatar->getName();
                $data = array(
                    'nama'  => $this->request->getPost('namaikan'),
                    'deskripsi'  => $this->request->getPost('deskripsi'),
                    'harga'  => $this->request->getPost('harga'),
                    'gambar'  => $image,
                    'status'  => "1",
                );
			}
            $status = $this->ikanM->simpan($data);
            session()->setFlashdata('info', [1, 'Berhasil menyimpan data']);
        }elseif($this->request->getPost('status')=="ubah"){
            $id = $this->request->getPost('id');
            $avatar = $this->request->getFile('image');
            if(empty($avatar->getName())){
                $data = array(
                    'nama'  => $this->request->getPost('namaikan'),
                    'deskripsi'  => $this->request->getPost('deskripsi'),
                    'harga'  => $this->request->getPost('harga'),
                    'gambar'  => "",
                    'status'  => "1",
                );
            }else{
				$validated = $this->validate([
					'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,3032]'
				]);
				if ($validated == FALSE) {
					session()->setFlashdata('info', [2,'Photo belum memenuhi syarat.']);
					return redirect()->to(base_url('/index.php/setting/profile'));
					die();
				}
		
				$newName = $avatar->getRandomName();
				$avatar->move(ROOTPATH . 'public/assets/img/', $newName);
				$image = $avatar->getName();
                $data = array(
                    'nama'  => $this->request->getPost('namaikan'),
                    'deskripsi'  => $this->request->getPost('deskripsi'),
                    'harga'  => $this->request->getPost('harga'),
                    'gambar'  => $image,
                    'status'  => "1",
                );
			}
            $status = $this->ikanM->ubah($data,$id);
            session()->setFlashdata('info', [1, 'Berhasil mengubah data']);
        }else{
            session()->setFlashdata('info', [2, 'Terjadi Kesalahan Data']);
            return redirect()->to(site_url('/ikan'));
            die();
        }

        if(!$status){
            session()->setFlashdata('info', [2, 'Gagal menyimpan data']);
        }
        
        return redirect()->to(site_url('/ikan'));
    }

    public function hapus($id)
    {
        if(!isLogin() || !session()->has('admin')){
            session()->setFlashdata('info', [2,"Silahkan Login Terlebih Dahulu"]);
            return redirect()->to(site_url('login'));
            die();
        }
        $status = $this->ikanM->hapus($id);
        if(!$status){
            session()->setFlashdata('info', [2, 'Gagal menyimpan data']);
        }else{
            session()->setFlashdata('info', [1, 'Berhasil menghapus data']);
        }
        return redirect()->to(site_url('/ikan'));
    }
}