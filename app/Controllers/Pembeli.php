<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Pembeli_model;
 
class Pembeli extends Controller
{
    private $pembeliM;

    public function __construct(){
        helper('form');
        $this->pembeliM = new Pembeli_model();
    }

    public function index()
    {
        $data['pembeli'] = $this->pembeliM->getPembeli();
        echo view('pembeli',$data);
    }

    public function aksi(){
        if($this->request->getPost('status')=="tambah"){
            $pw = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
            $data = array(
                'nama'  => $this->request->getPost('namapembeli'),
                'alamat'  => $this->request->getPost('alamat'),
                'nohp'  => $this->request->getPost('nohp'),
                'username'  => $this->request->getPost('username'),
                'password'  => $pw,
            );
            $status = $this->pembeliM->simpan($data);
            session()->setFlashdata('info', [1, 'Berhasil menyimpan data']);
        }elseif($this->request->getPost('status')=="ubah"){
            $id = $this->request->getPost('id');
            if(empty($this->request->getPost('password'))){
                $data = array(
                    'nama'  => $this->request->getPost('namapembeli'),
                    'alamat'  => $this->request->getPost('alamat'),
                    'nohp'  => $this->request->getPost('nohp'),
                    'username'  => $this->request->getPost('username'),
                );
                $status = $this->pembeliM->ubah($data,$id);
            }else{
                $pw = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
                $data = array(
                    'nama'  => $this->request->getPost('namapembeli'),
                    'alamat'  => $this->request->getPost('alamat'),
                    'nohp'  => $this->request->getPost('nohp'),
                    'username'  => $this->request->getPost('username'),
                    'password'  => $pw,
                );
                $status = $this->pembeliM->ubah($data,$id);
            }
            session()->setFlashdata('info', [1, 'Berhasil mengubah data']);
        }else{
            session()->setFlashdata('info', [2, 'Terjadi Kesalahan Data']);
            return redirect()->to('/pembeli');
            die();
        }

        if(!$status){
            session()->setFlashdata('info', [2, 'Gagal menyimpan data']);
        }
        
        return redirect()->to('/pembeli');
    }

    public function hapus($id)
    {
        $status = $this->pembeliM->hapus($id);
        if(!$status){
            session()->setFlashdata('info', [2, 'Gagal menyimpan data']);
        }else{
            session()->setFlashdata('info', [1, 'Berhasil menghapus data']);
        }
        return redirect()->to('/pembeli');
    }

}