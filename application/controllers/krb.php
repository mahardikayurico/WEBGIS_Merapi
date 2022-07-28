<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class krb extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('krb_model');
        $this->load->library('form_validation');
		$this->load->helper('form');
    }

    public function index()
    {
        $data['data_krb'] = $this->krb_model->getAllkrb();
        // $config = [
        //     [
        //         'field' => 'nama_murid',
		// 		'label' => 'Nama Murid',
		// 		'rules' => 'required'
        //     ]
        // ];
        $this->load->view('viewdatakrb', $data);
        
        // $this->form_validation->set_rules($config);
        // if ($this->form_validation->run() == FALSE)
        // {
        // } else {
        // 	$this->Murid_model->saveDataMurid();
        //     $this->session->set_flashdata('tambahMurid', 'ditambahkan');
        //     redirect(base_url('admin/murid'));
        // }
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
    public function tambahkrb()
    {
        $data['data_krb'] = $this->krb_model->getAllkrb();
        
        $config = [
            [
                'field' => 'nama_murid',
				'label' => 'Nama Murid',
				'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE)
		{
            $this->load->view('tambah_krb', $data);
		} else {
			$this->krb_model->saveDatakrb();
            $this->session->set_flashdata('tambahkrb', 'ditambahkan');
            redirect(base_url('admin/murid/tambahMurid'));
		}
    }

    public function daftarkrb($kelas)
    {
        $data['data_krb'] = $this->krb_model->getkrbByKelas($kelas);
        $this->load->view('object/daftar_krb', $data);
    }
}