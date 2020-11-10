<?php namespace App\Controllers;
 
use App\Models\Admin_model;
 
class Admin extends BaseController
{
    private $adminM;

    public function __construct(){
        helper('form');
        $this->adminM = new Admin_model();
    }

    public function index(){
        if(!isLogin() || !session()->has('admin')){
            session()->setFlashdata('info', [2,"Silahkan Login Terlebih Dahulu"]);
            return redirect()->to(site_url('login'));
            die();
        }
        $data['admin'] = $this->adminM->getAdmin();
        echo view('admin',$data);
    }

    public function aksi(){
        if(!isLogin() || !session()->has('admin')){
            session()->setFlashdata('info', [2,"Silahkan Login Terlebih Dahulu"]);
            return redirect()->to(site_url('login'));
            die();
        }
        if($this->request->getPost('status')=="tambah"){
            $pw = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
            $data = array(
                'nama'  => $this->request->getPost('nama'),
                'username'  => $this->request->getPost('username'),
                'password'  => $pw,
            );
            $status = $this->adminM->simpan($data);
            session()->setFlashdata('info', [1, 'Berhasil menyimpan data']);
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
            session()->setFlashdata('info', [1, 'Berhasil mengubah data']);
        }else{
            session()->setFlashdata('info', [2, 'Terjadi Kesalahan Data']);
            return redirect()->to(site_url('/admin'));
            die();
        }

        if(!$status){
            session()->setFlashdata('info', [2, 'Gagal menyimpan data']);
        }
        
        return redirect()->to(site_url('/admin'));
    }

    public function hapus($id){
        if(!isLogin() || !session()->has('admin')){
            session()->setFlashdata('info', [2,"Silahkan Login Terlebih Dahulu"]);
            return redirect()->to(site_url('login'));
            die();
        }
        $status = $this->adminM->hapus($id);
        if(!$status){
            session()->setFlashdata('info', [2, 'Gagal menyimpan data']);
        }else{
            session()->setFlashdata('info', [1, 'Berhasil menghapus data']);
        }
        return redirect()->to(site_url('/admin'));
    }
    

}