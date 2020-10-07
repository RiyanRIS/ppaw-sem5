<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Ikan_model;
 
class Ikan extends Controller
{
    private $ikanM;

    public function __construct(){
        helper('form');
        $this->ikanM = new Ikan_model();
    }

    public function index()
    {
        $data['ikan'] = $this->ikanM->getIkan();
        echo view('ikan',$data);
    }

    public function aksi(){
        if($this->request->getPost('status')=="tambah"){
            $data = array(
                'nama'  => $this->request->getPost('namaikan'),
                'deskripsi'  => $this->request->getPost('deskripsi'),
                'harga'  => $this->request->getPost('harga'),
                'gambar'  => "",
                'status'  => "1",
            );
            $status = $this->ikanM->simpan($data);
            session()->setFlashdata('info', 'Berhasil menyimpan data');
        }elseif($this->request->getPost('status')=="ubah"){
            $id = $this->request->getPost('id');
            $data = array(
                'nama'  => $this->request->getPost('namaikan'),
                'deskripsi'  => $this->request->getPost('deskripsi'),
                'harga'  => $this->request->getPost('harga'),
            );
            $status = $this->ikanM->ubah($data,$id);
            session()->setFlashdata('info', 'Berhasil mengubah data');
        }else{
            session()->setFlashdata('info', 'Terjadi Kesalahan Data');
            return redirect()->to('/ikan');
            die();
        }

        if(!$status){
            session()->setFlashdata('info', 'Gagal menyimpan data');
        }
        
        return redirect()->to('/ikan');
    }

    public function hapus($id)
    {
        $status = $this->ikanM->hapus($id);
        if(!$status){
            session()->setFlashdata('info', 'Gagal menyimpan data');
        }else{
            session()->setFlashdata('info', 'Berhasil menghapus data');
        }
        return redirect()->to('/ikan');
    }

    function tes(){
        print_r($this->ikanM->getIkan("2")->getResult('array'));
    }
}