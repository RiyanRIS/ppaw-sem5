<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Admin_model;
 
class Admin extends Controller
{
    private $adminM;

    public function __construct(){
        helper('form');
        $this->adminM = new Admin_model();
    }

    public function index()
    {
        $data['admin'] = $this->adminM->getAdmin();
        echo view('admin',$data);
    }

    public function aksi(){
        if($this->request->getPost('status')=="tambah"){
            $pw = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
            $data = array(
                'nama'  => $this->request->getPost('nama'),
                'username'  => $this->request->getPost('username'),
                'password'  => $pw,
            );
            $status = $this->adminM->simpan($data);
            session()->setFlashdata('info', 'Berhasil menyimpan data');
        }elseif($this->request->getPost('status')=="ubah"){
            $id = $this->request->getPost('id');
            if(empty($this->request->getPost('password'))){
                $data = array(
                    'nama'  => $this->request->getPost('nama'),
                    'username'  => $this->request->getPost('username'),
                );
                $status = $this->adminM->ubah($data,$id);
            }else{
                $pw = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
                $data = array(
                    'nama'  => $this->request->getPost('nama'),
                    'username'  => $this->request->getPost('username'),
                    'password'  => $pw,
                );
                $status = $this->adminM->ubah($data,$id);
            }
            session()->setFlashdata('info', 'Berhasil mengubah data');
        }else{
            session()->setFlashdata('info', 'Terjadi Kesalahan Data');
            return redirect()->to('/admin');
            die();
        }

        if(!$status){
            session()->setFlashdata('info', 'Gagal menyimpan data');
        }
        
        return redirect()->to('/admin');
    }

    public function hapus($id)
    {
        $status = $this->adminM->hapus($id);
        if(!$status){
            session()->setFlashdata('info', 'Gagal menyimpan data');
        }else{
            session()->setFlashdata('info', 'Berhasil menghapus data');
        }
        return redirect()->to('/admin');
    }

}