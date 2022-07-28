<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krb extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('krb_model');
        $this->load->library('form_validation');
		$this->load->helper('form');
    }

    public function index()
    {
        $this->load->view('krb/index');
    }

    public function detailkrb($id)
    {
        $data['detail_krb'] = $this->krb_model->getMuridById($id);

        $this->load->view('object/detail_murid', $data);
    }

    public function deletekrb($id)
    {
        $this->krb_model->deletekrb($id);
        $this->session->set_flashdata('hapuskrb', 'dihapus');
		redirect(base_url('admin/krb'));
    }

    public function editkrb($id)
    {
        $data['detail_krb'] = $this->krb_model->getkrbdById($id);
       

        
        $config = [
            [
                'field' => 'nama_murid',
                'label' => 'Nama Guru',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('form/editkrb', $data);
		} else {
			$this->Murid_model->editDataMurid();
			$this->session->set_flashdata('editkrb', 'diedit');
			redirect('admin/krb');
		}
    }
    public function insert_krb()
    {
        $data = [
            "nama" => $this->input->post('nama'),
            // "nama_murid" => $this->input->post('nama_murid', true),
            // "tempat_lahir" => $this->input->post('tempat_lahir', true),
            // "tanggal_lahir" => $this->input->post('tanggal_lahir', true),
            // "alamat" => $this->input->post('alamat', true),
            // "nomor_hp" => $this->input->post('nomor_hp'),
            // "sosmed" => $this->input->post('sosmed', true),
            // "motto" => $this->input->post('motto', true),
            // "foto_murid" => $this->uploadFotoMurid()
        ];
        $this->db->insert('tbl_krb', $data);
    }

    public function daftarkrb($kelas)
    {
        $data['data_krb'] = $this->krb_model->getkrbByKelas($kelas);
        $this->load->view('object/daftar_krb', $data);
    }
}