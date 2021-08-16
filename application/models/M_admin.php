<?php

class M_admin extends CI_Model{

    function __construct() {
        parent::__construct();
    }

    //  ================= AUTOMATIC CODE ==================
    public function getidadmin()
    {
        $query = $this->db->query("SELECT max(id_admin) AS max_code FROM tb_admin");
        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 2);

        $max_new = $max_fix + 1;

        $id = "A".sprintf("%02s", $max_new);
        return $id;
    }

    public function data_siswa()
    {
        $query = $this->db->query("SELECT * FROM tb_siswa");
        return $query->result();
    }

    public function data_siswa_angkatan($angkatan)
    {
        $query = $this->db->query("SELECT * FROM tb_siswa WHERE angkatan='$angkatan'");
        return $query->result();
    }

    public function data_tagihan()
    {
        $query = $this->db->query("SELECT * FROM tb_tagihan");
        return $query->result();
    }

    public function data_pembayaran()
    {
        $query = $this->db->query("SELECT * FROM tb_pembayaran A JOIN tb_siswa B ON A.nis=B.nis WHERE A.status!=0 ORDER BY id_pembayaran DESC");
        return $query->result();
    }

    public function data_pembayaran_baru()
    {
        $query = $this->db->query("SELECT * FROM tb_pembayaran A JOIN tb_siswa B ON A.nis=B.nis WHERE A.status=0 ORDER BY id_pembayaran DESC");
        return $query->result();
    }

    public function data_belum_bayar()
    {
        $query = $this->db->query("SELECT * FROM tb_tagihan A JOIN tb_tagihan_siswa B ON A.id=B.id_tagihan JOIN tb_siswa C ON B.nis=C.nis");
        return $query->result();
    }

    public function jml_belum_bayar()
    {
        $query = $this->db->query("SELECT count(id) AS jml FROM tb_tagihan_siswa");
        $row = $query->row_array();

        return $row['jml'];
    }

    public function data_admin()
    {
        $query = $this->db->query("SELECT * FROM tb_admin");
        return $query->result();
    }

    public function dropdown_jk()
    {
        $value[''] = '--PILIH--';            
        $value['1'] = 'Laki-Laki';
        $value['2'] = 'Perempuan';    
            
        return $value;
    }

    public function dropdown_ket()
    {         
        $value['1'] = 'SPP';
        $value['2'] = 'Lainnya';    
            
        return $value;
    }

}
?>