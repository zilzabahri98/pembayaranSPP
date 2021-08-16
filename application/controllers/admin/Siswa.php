<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

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
		$data['title']		= 'Data Siswa';
		$data['head']		= 'admin/layout/head.php';
        $data['menu']       = 'admin/layout/menu.php';
		$data['content']	= 'admin/body/siswa.php';
		$data['foot']		= 'admin/layout/foot.php';

        $data['data_siswa'] = $this->M_admin->data_siswa();

		$this->load->view('admin/template.php', $data);
	}

    public function tambah()
	{
		$data['foto_admin']	= $this->session->userdata('foto_admin');
		$data['id_admin']	= $this->session->userdata('id_admin');
		$data['title']		= 'Tambah Data Siswa';
		$data['head']		= 'admin/layout/head.php';
        $data['menu']       = 'admin/layout/menu.php';
		$data['content']	= 'admin/body/siswa_form.php';
		$data['foot']		= 'admin/layout/foot.php';

        $data['url']		= 'admin/siswa/add';
		$data['url_foto']	= 'uploads/siswa/default.png';
		$data['ket']		= '';
		$data['nis'] = '';
		$data['nisn'] = '';
		$data['angkatan'] = '';
		$data['nama_siswa'] = '';
		$data['tempat_lahir'] = '';
		$data['tgl_lahir'] = '';
		$data['kelas'] = '';
		$data['jurusan'] = '';
		$data['alamat'] = '';
		$data['no_telp'] = '';
		$data['foto'] = '';

		$data['dd_jk'] = $this->M_admin->dropdown_jk();
		$data['id_jk'] = "";

		$this->load->view('admin/template.php', $data);
	}

	public function add()
	{
		$nis = $this->input->post('nis');
		$data['nis']			= $nis;
		$data['nisn'] 			= $this->input->post('nisn');
		$data['angkatan'] 		= $this->input->post('angkatan');
		$data['nama_siswa'] 	= ucwords($this->input->post('nama_siswa'));
		$data['jk']		 		= $this->input->post('jk');
		$data['tempat_lahir'] 	= ucwords($this->input->post('tempat_lahir'));
		$data['tgl_lahir'] 		= $this->input->post('tgl_lahir');
		$data['kelas'] 			= $this->input->post('kelas');
		$data['jurusan'] 		= $this->input->post('jurusan');
		$data['alamat'] 		= $this->input->post('alamat');
		$data['no_telp'] 		= $this->input->post('no_telp');
		$data['foto'] 			= $this->_uploadImage($nis);
		$data['password']		= md5('smk'.$nis);

		$this->db->trans_start();
		$this->db->insert('tb_siswa', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal Disimpan!</div>");
			redirect(base_url('admin/siswa')); 
		}
		else {
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Berhasil Disimpan!</div>");
			redirect(base_url('admin/siswa'));
		}
	}

	public function edit($nis)
	{		
		$data['foto_admin']	= $this->session->userdata('foto_admin');
		$data['id_admin']	= $this->session->userdata('id_admin');
		$data['title']		= 'Edit Data Siswa';
		$data['head']		= 'admin/layout/head.php';
        $data['menu']       = 'admin/layout/menu.php';
		$data['content']	= 'admin/body/siswa_form.php';
		$data['foot']		= 'admin/layout/foot.php';

        $data['url']		= 'admin/siswa/update';
		$data['ket']		= 'edit';

		$query = $this->db->query("SELECT * FROM tb_siswa WHERE nis='$nis'");
		$d = $query->row();
				
		$data['url_foto']	= 'uploads/siswa/'.$d->foto;
		$data['nis'] = $d->nis;
		$data['nisn'] = $d->nisn;
		$data['angkatan'] = $d->angkatan;
		$data['nama_siswa'] = $d->nama_siswa;
		$data['tempat_lahir'] = $d->tempat_lahir;
		$data['tgl_lahir'] = $d->tgl_lahir;
		$data['kelas'] = $d->kelas;
		$data['jurusan'] = $d->jurusan;
		$data['alamat'] = $d->alamat;
		$data['no_telp'] = $d->no_telp;
		$data['foto'] = $d->foto;

		$data['dd_jk'] = $this->M_admin->dropdown_jk();
		$data['id_jk'] = $d->jk;


		$this->load->view('admin/template.php', $data);
	}

	public function update()
	{
		$nis = $this->input->post('nis');
		$foto = $this->input->post('foto');
		$data['nis']			= $nis;
		$data['nisn'] 			= $this->input->post('nisn');
		$data['angkatan'] 		= $this->input->post('angkatan');
		$data['nama_siswa'] 	= ucwords($this->input->post('nama_siswa'));
		$data['jk']		 		= $this->input->post('jk');
		$data['tempat_lahir'] 	= ucwords($this->input->post('tempat_lahir'));
		$data['tgl_lahir'] 		= $this->input->post('tgl_lahir');
		$data['kelas'] 			= $this->input->post('kelas');
		$data['jurusan'] 		= $this->input->post('jurusan');
		$data['alamat'] 		= $this->input->post('alamat');
		$data['no_telp'] 		= $this->input->post('no_telp');

		$data['dd_jk'] = $this->M_admin->dropdown_jk();
		$data['id_jk'] = $d->jk;
		
		if (!empty($_FILES["file"]["name"])) {
			if ($foto != 'default.png') {		
				unlink("./uploads/siswa/$foto"); }
			$data['foto'] = $this->_uploadImage($nis);
		} 

		$this->db->trans_start();
		$this->db->where('nis', $nis);
		$this->db->update('tb_siswa', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal Diedit!</div>");
			redirect(base_url('admin/siswa')); 
		}
		else {
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Berhasil Diedit!</div>");
			redirect(base_url('admin/siswa'));
		}
	}

	public function ganti_password()
	{
		$nis = $this->input->post('nis');
		$data['password'] = md5($this->input->post('pass_baru'));

		$this->db->trans_start();
		$this->db->where('nis', $nis);
		$this->db->update('tb_siswa', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password Gagal Diedit!</div>");
			redirect(base_url('admin/siswa')); 
		}
		else {
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password Berhasil Diedit!</div>");
			redirect(base_url('admin/siswa'));
		}
	}

	public function hapus($nis)
	{
		$query = $this->db->query("SELECT * FROM tb_siswa WHERE nis='$nis'");
		$d = $query->row();

		$this->db->trans_start();
		$this->db->where('nis', $nis);
		$this->db->delete('tb_siswa');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Gagal Dihapus!</div>");
			redirect(base_url('admin/siswa')); 
		}
		else {
			unlink("./uploads/siswa/$foto");
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Berhasil Dihapus!</div>");
			redirect(base_url('admin/siswa'));
		}
	}

	private function _uploadImage($nis)
	{
		$config['upload_path']   = './uploads/siswa/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['file_name']     = $nis;
		$config['overwrite']     = true;
		$config['max_size']	     = 5000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file')) {
			return $this->upload->data("file_name");
		}
		return "default.png";
	}

}