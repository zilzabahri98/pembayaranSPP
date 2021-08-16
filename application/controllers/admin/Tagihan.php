<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');

		if (!$this->session->userdata('id_admin')) {
			redirect(base_url('admin/login'));
		}
	}

	public function index()
	{
		$data['foto_admin']	= $this->session->userdata('foto_admin');
		$data['id_admin']	= $this->session->userdata('id_admin');
		$data['title']		= 'Data Tagihan';
		$data['head']		= 'admin/layout/head.php';
        $data['menu']       = 'admin/layout/menu.php';
		$data['content']	= 'admin/body/tagihan.php';
		$data['foot']		= 'admin/layout/foot.php';

        $data['data_tagihan'] = $this->M_admin->data_tagihan();

		$this->load->view('admin/template.php', $data);
	}

    public function tambah()
	{
		$data['foto_admin']	= $this->session->userdata('foto_admin');
		$data['id_admin']	= $this->session->userdata('id_admin');
		$data['title']		= 'Tambah Data Tagihan';
		$data['head']		= 'admin/layout/head.php';
        $data['menu']       = 'admin/layout/menu.php';
		$data['content']	= 'admin/body/tagihan_form.php';
		$data['foot']		= 'admin/layout/foot.php';

        $data['url']		= 'admin/tagihan/add';
		$data['id'] = '';
		$data['angkatan'] = '';
		$data['biaya'] = '';
		$data['keterangan'] = '';

		$data['dd_ket'] = $this->M_admin->dropdown_ket();
		$data['id_ket'] = '';

		$this->load->view('admin/template.php', $data);
	}

	public function add()
	{
		$data['angkatan'] = $this->input->post('angkatan');
		$data['biaya'] = $this->input->post('biaya');;
		$data['keterangan'] = $this->input->post('keterangan');

		$this->db->trans_start();
		$this->db->insert('tb_tagihan', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal Disimpan!</div>");
			redirect(base_url('admin/tagihan')); 
		}
		else {
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Berhasil Disimpan!</div>");
			redirect(base_url('admin/tagihan'));
		}
	}

	public function edit($id)
	{
		$data['foto_admin']	= $this->session->userdata('foto_admin');
		$data['id_admin']	= $this->session->userdata('id_admin');
		$data['title']		= 'Edit Data Tagihan';
		$data['head']		= 'admin/layout/head.php';
        $data['menu']       = 'admin/layout/menu.php';
		$data['content']	= 'admin/body/tagihan_form.php';
		$data['foot']		= 'admin/layout/foot.php';

        $data['url']		= 'admin/tagihan/update';

		$query = $this->db->query("SELECT * FROM tb_tagihan WHERE id='$id'");
		$d = $query->row();
		
		$data['angkatan'] = $d->angkatan;
		$data['biaya'] = $d->biaya;
		$data['keterangan'] = $d->keterangan;
		$data['id'] = $id;

		$this->load->view('admin/template.php', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data['angkatan'] = $this->input->post('angkatan');
		$data['biaya'] = $this->input->post('biaya');;
		$data['keterangan'] = $this->input->post('keterangan');;
		
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('tb_tagihan', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal Diedit!</div>");
			redirect(base_url('admin/tagihan')); 
		}
		else {
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Berhasil Diedit!</div>");
			redirect(base_url('admin/tagihan'));
		}
	}

	public function hapus($id)
	{
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete('tb_tagihan');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal Dihapus!</div>");
			redirect(base_url('admin/tagihan')); 
		}
		else {
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Berhasil Dihapus!</div>");
			redirect(base_url('admin/tagihan'));
		}
	}

	public function blast()
	{
		$id = $this->input->post('id');
		$batas_waktu = $this->input->post('batas_waktu');
		$ket_tambahan = $date('F Y');

		$query = $this->db->query("SELECT * FROM tb_tagihan WHERE id='$id'");
		$d = $query->row();
		$angkatan = $d->angkatan;

		$data_siswa_angkatan = $this->M_admin->data_siswa_angkatan($angkatan);

		$data = array();
		$i=0;
		foreach($data_siswa_angkatan as $s) {
			$curl2 = curl_init();
			$token2 = "rtIHwOUhRDK3kOg4BV4rlNIBtyBfpqiSF5GMeL10PKUwv1YTK66yigCvu99yukr5";
			$data2 = [
				'phone' => '0'.$s->no_telp,
				'message' => 'Tagihan Anda Rp '.number_format($d->biaya,0,",",".").' segera cek.',
			];

			curl_setopt($curl2, CURLOPT_HTTPHEADER,
				array(
					"Authorization: $token2",
				)
			);
			curl_setopt($curl2, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl2, CURLOPT_POSTFIELDS, http_build_query($data2));
			curl_setopt($curl2, CURLOPT_URL, "https://tx.wablas.com/api/send-message");
			curl_setopt($curl2, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, 0);
			$result2 = curl_exec($curl2);
			curl_close($curl2);

			$data[$i] = array(
				'nis' => $s->nis,
				'id_tagihan' => $d->id,
				'ket_tambahan' => 'Bulan '.$ket_tambahan,
				'batas_waktu' => $batas_waktu,
			);
			$i++;
		}

		$this->db->insert_batch('tb_tagihan_siswa', $data);

		redirect(base_url('admin/tagihan'));
	}

}
?>