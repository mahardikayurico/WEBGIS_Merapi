<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_mitigasi');
    }
	public function index()
	{
        $data= array(
            'judul' =>'WebGIS SPIG 2018',
            'mitigasi'=> $this->model_mitigasi->get_all_data(),
            'dataview' => 'viewhome'
        );
		$this->load->view('layout/viewgabungan',$data,false);
    }
    public function peta()
	{
        $data=array(
            'judul'=>'WebGIS SPIG 2018',
            'dataview'=>'viewpeta'
        );
        $this->load->view('layout/viewgabungan',$data,false);
    }
    public function card()
	{
        $data=array(
            'judul'=>'WebGIS SPIG 2018',
            'dataview'=>'viewcard'
        );
        $this->load->view('layout/viewgabungan',$data,false);
    }
    public function data()
	{
        $data= array(
            'judul' =>'Database',
            'mitigasi'=> $this->model_mitigasi->get_all_data(),
            'dataview' => 'viewdata'
        );
		$this->load->view('layout/viewgabungan',$data,false);
    }
    public function bio()
	{
        $data= array(
            'judul' =>'Database',
            'mitigasi'=> $this->model_mitigasi->get_all_data(),
            'dataview' => 'viewbio'
        );
		$this->load->view('layout/viewgabungan',$data,false);
    }
    public function add()
    {
        $this->form_validation->set_rules('nama_daerah','Nama Daerah','required',array(
            'required'=>'%s harus diisi'
        ));
        $this->form_validation->set_rules('ancaman_mitigasi','Ancaman Mitigasi','required',array(
            'required'=>'%s harus diisi'
        ));
        $this->form_validation->set_rules('kapasitas_mitigasi','Kapasitas Mitigasi','required',array(
            'required'=>'%s harus diisi'
        ));
        $this->form_validation->set_rules('kerentanan_mitigasi','Kerentanan Mitigasi','required',array(
            'required'=>'%s harus diisi'
        ));
        $this->form_validation->set_rules('resiko_mitigasi','Resiko Mitigasi','required',array(
            'required'=>'%s harus diisi'
        ));
        $this->form_validation->set_rules('geojson','Geojson','required',array(
            'required'=>'%s harus diisi'
        ));
        $this->form_validation->set_rules('warna','Warna','required',array(
            'required'=>'%s harus diisi'
        ));
        $this->form_validation->set_rules('waktu','Waktu','required',array(
            'required'=>'%s harus diisi'
        ));
        if($this->form_validation->run() == false ){
            $data =array(
            'judul' => 'Add Data',
            'dataview'=> 'viewadd'
            );
            $this->load->view('layout/viewgabungan',$data,false);
        } else {
            $data =array(
                'nama_daerah' => $this->input->post('nama_daerah'),
                'ancaman_mitigasi' => $this->input->post('ancaman_mitigasi'),
                'kapasitas_mitigasi' => $this->input->post('kapasitas_mitigasi'),
                'kerentanan_mitigasi' => $this->input->post('kerentanan_mitigasi'),
                'resiko_mitigasi' => $this->input->post('resiko_mitigasi'),
                'geojson' => $this->input->post('geojson'),
                'warna' => $this->input->post('warna'),
                'waktu' => $this->input->post('waktu'),    
            );
            $this->model_mitigasi->add($data);
            $this->session->set_flashdata('pesan','Data Berhasil Disimpan');
            redirect('home/data');
        }
        $data =array(
            'judul' => 'Add Data',
            'dataview'=> 'viewadd'
            );
            $this->load->view('layout/viewgabungan',$data,false);
			}
			 public function edit($id_mitigasi = null)
            {
                $this->user_login->protek_halaman();
                $this->form_validation->set_rules('nama_daerah','Nama Daerah','required',array(
                    'required'=>'%s harus diisi'
                ));
                $this->form_validation->set_rules('ancaman_mitigasi','Ancaman Mitigasi','required',array(
                    'required'=>'%s harus diisi'
                ));
                $this->form_validation->set_rules('kapasitas_mitigasi','Kapasitas Mitigasi','required',array(
                    'required'=>'%s harus diisi'
                ));
                $this->form_validation->set_rules('kerentanan_mitigasi','Kerentanan Mitigasi','required',array(
                    'required'=>'%s harus diisi'
                ));
                $this->form_validation->set_rules('resiko_mitigasi','Resiko Mitigasi','required',array(
                    'required'=>'%s harus diisi'
                ));
                $this->form_validation->set_rules('geojson','Geojson','required',array(
                    'required'=>'%s harus diisi'
                ));
                $this->form_validation->set_rules('warna','Warna','required',array(
                    'required'=>'%s harus diisi'
                ));
                $this->form_validation->set_rules('waktu','Waktu','required',array(
                    'required'=>'%s harus diisi'
                ));
                if($this->form_validation->run() == false ){
                    $data =array(
                    'judul' => 'Edit Data',
                    'mitigasi' => $this->model_mitigasi->detail($id_mitigasi), //fungsi database manggil this model
                    'dataview'=> 'viewedit'
                    );
                    $this->load->view('layout/viewgabungan',$data,false);
                } else {
                    $data =array(
                        'id_mitigasi' => $id_mitigasi,
                        'nama_daerah' => $this->input->post('nama_daerah'),
                        'ancaman_mitigasi' => $this->input->post('ancaman_mitigasi'),
                        'kapasitas_mitigasi' => $this->input->post('kapasitas_mitigasi'),
                        'kerentanan_mitigasi' => $this->input->post('kerentanan_mitigasi'),
                        'resiko_mitigasi' => $this->input->post('resiko_mitigasi'),
                        'geojson' => $this->input->post('geojson'),
                        'warna' => $this->input->post('warna'),
                        'waktu' => $this->input->post('waktu'),    
                    );
                    $this->model_mitigasi->edit($data);
                    $this->session->set_flashdata('pesan','Data Berhasil Diedit');
                    redirect('home/data');
                }
					}
					public function delete($id_mitigasi)
            	{
                $data = array('id_mitigasi'=> $id_mitigasi);
                    
                $this->model_mitigasi->delete($data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!');
                redirect('home/data');  
        
            	}
}
