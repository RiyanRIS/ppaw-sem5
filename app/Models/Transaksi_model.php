<?php namespace App\Models;
use CodeIgniter\Model;
 
class Transaksi_model extends Model
{
    protected $table = 'transaksi';

    public function getSql($sql){
        return $this->db->query($sql)->getResultArray();
    }
     
    public function getTransaksi($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }
    }

    public function simpan($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function ubah($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function hapus($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    } 
 
}