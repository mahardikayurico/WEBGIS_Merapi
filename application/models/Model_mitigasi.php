<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_mitigasi extends CI_Model //nama model
{
	public function add($data)
	{
		$this->db->insert('tbl_mitigasi', $data); //nama tabel db
	}
	public function edit($data)
	{
		$this->db->where('id_mitigasi', $data['id_mitigasi']);
		$this->db->update('tbl_mitigasi', $data);
	}
	public function delete($data)
    {
        $this->db->where('id_mitigasi', $data['id_mitigasi']);
        $this->db->delete('tbl_mitigasi', $data);  
             
    }
	public function get_all_data() //function = untuk memanggil data dan membuat dan menghapus
	{
		$this->db->select('*');
		$this->db->from('tbl_mitigasi');
		$this->db->order_by('id_mitigasi', 'desc');
		return $this->db->get()->result();
	}
	public function detail($id_mitigasi)
	{
		$this->db->select('*');
		$this->db->from('tbl_mitigasi');
		$this->db->order_by('id_mitigasi', $id_mitigasi);
		return $this->db->get()->result();
	}
	public function get_all_krb()
	{
		return $this->db->get('tbl_krb')->result();
	}

	public function insert_krb()
	{
		$data = [
            "nama" => $this->input->post('nama'),
            "file" => $this->uploadFile()
        ];
        $this->db->insert('tbl_krb', $data);
	}

	private function uploadFile()
    {
        $config['upload_path']          = 'assets/file';
        $config['allowed_types']        = 'pdf|doc|docx|csv|xls|xlsx|ppt|geojson|json';

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
			return $this->upload->data("file_name");
        }
		return $this->upload->display_errors();
        // return "default.jpg";
    }

	public function delete_krb($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_krb');  
             
    }
}
