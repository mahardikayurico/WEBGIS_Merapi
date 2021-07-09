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
}
