<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Transaksi_model;
use App\Models\Ikan_model;
use App\Models\Pembeli_model;
 
class Transaksi extends Controller
{
    private $transaksiM;
    private $ikanM;
    private $pembeliM;

    public function __construct(){
        helper('form');
        $this->transaksiM = new Transaksi_model();
        $this->ikanM = new Ikan_model();
        $this->pembeliM = new Pembeli_model();
    }

    public function index()
    {
        $data = array(
            "pemesanan" => $this->transaksiM->getSql("SELECT a.*, b.nama as namaikan, c.nama as namapemesan FROM transaksi a INNER JOIN ikan b ON a.ikan = b.id INNER JOIN pemesan c on a.pemesan = c.id WHERE a.deleteat IS NULL"),
            "ikan" => $this->ikanM->getIkan(),
            "pembeli" => $this->pembeliM->getPembeli(),
        );
        echo view('pemesanan',$data);
    }

    public function aksi(){
        if($this->request->getPost('status')=="tambah"){
            $data = array(
                'pemesan'  => $this->request->getPost('namapembeli'),
                'ikan'  => $this->request->getPost('namaikan'),
                'jumlah'  => $this->request->getPost('jumlah'),
                'total'  => $this->request->getPost('total'),
            );
            $status = $this->transaksiM->simpan($data);
            session()->setFlashdata('info', 'Berhasil menyimpan data');
        }elseif($this->request->getPost('status')=="ubah"){
            $id = $this->request->getPost('id');
            $data = array(
                'pemesan'  => $this->request->getPost('namapembeli'),
                'ikan'  => $this->request->getPost('namaikan'),
                'jumlah'  => $this->request->getPost('jumlah'),
                'total'  => $this->request->getPost('total'),
            );
            $status = $this->transaksiM->ubah($data,$id);
            session()->setFlashdata('info', 'Berhasil mengubah data');
        }else{
            session()->setFlashdata('info', 'Terjadi Kesalahan Data');
            return redirect()->to('/pemesanan');
            die();
        }

        if(!$status){
            session()->setFlashdata('info', 'Gagal menyimpan data');
        }
        
        return redirect()->to('/pemesanan');
    }

    public function hapus($id)
    {
        $data = array(
            'deleteat'  => date("Y-m-d H:i:s"),
        );
        $status = $this->transaksiM->ubah($data,$id);
        if(!$status){
            session()->setFlashdata('info', 'Gagal menyimpan data');
        }else{
            session()->setFlashdata('info', 'Berhasil menghapus data');
        }
        return redirect()->to('/pemesanan');
    }

}