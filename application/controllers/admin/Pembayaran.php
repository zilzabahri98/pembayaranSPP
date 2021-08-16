<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

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
		$data['title']		= 'Data Pembayaran';
		$data['head']		= 'admin/layout/head.php';
        $data['menu']       = 'admin/layout/menu.php';
		$data['content']	= 'admin/body/pembayaran.php';
		$data['foot']		= 'admin/layout/foot.php';

        $data['data_bayar'] = $this->M_admin->data_pembayaran();
        $data['data_belum_bayar'] = $this->M_admin->data_belum_bayar();

		$this->load->view('admin/template.php', $data);
	}

    public function approve($id)
    {
        $data['status'] = 1;

        $this->db->trans_start();
        $this->db->where('id_pembayaran', $id);
		$this->db->update('tb_pembayaran', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Pembayaran $id Gagal Approve!</div>");
			redirect(base_url('admin/dashboard')); 
		}
		else {
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Pembayaran $id Approved!</div>");
			redirect(base_url('admin/dashboard'));
		}
    }

    public function dibatalkan()
    {
        $data['status'] = 2;
        $data['keterangan'] = $this->input->post('keterangan');
        $id = $this->input->post('id_pembayaran');

        $this->db->trans_start();
        $this->db->where('id_pembayaran', $id);
		$this->db->update('tb_pembayaran', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata("msg", "<div class='alert alert-warning col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Pembayaran $id Gagal Dibatalkan!</div>");
			redirect(base_url('admin/dashboard')); 
		}
		else {
			$this->session->set_flashdata("msg", "<div class='alert alert-success col-md-6'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Data Pembayaran $id Dibatalkan!</div>");
			redirect(base_url('admin/dashboard'));
		}
    }

    public function blast()
    {
        $tagihan = $this->M_admin->data_belum_bayar();

        foreach ($tagihan as $d) {
            $curl2 = curl_init();
			$token2 = "rtIHwOUhRDK3kOg4BV4rlNIBtyBfpqiSF5GMeL10PKUwv1YTK66yigCvu99yukr5";
			$data2 = [
				'phone' => '0'.$d->no_telp,
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
        }
		redirect(base_url('admin/pembayaran')); 
    }

}
?>