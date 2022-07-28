<?php

class krb_model extends CI_Model {

    public function getAllkrb()
    {
        return $this->db->get('students')->result();
    }

    public function getkrbById($id)
    {
        return $this->db->get_where('students', ['id_student' => $id])->row();
    }

    public function getMuridByKelas($kelas)
    {
        return $this->db->get_where('students', ['kelas' => $kelas])->result();
    }

    public function saveDataMurid()
    {
        $data = [
            "kelas" => $this->input->post('kelas'),
            "nama_murid" => $this->input->post('nama_murid', true),
            "tempat_lahir" => $this->input->post('tempat_lahir', true),
            "tanggal_lahir" => $this->input->post('tanggal_lahir', true),
            "alamat" => $this->input->post('alamat', true),
            "nomor_hp" => $this->input->post('nomor_hp'),
            "sosmed" => $this->input->post('sosmed', true),
            "motto" => $this->input->post('motto', true),
            "foto_murid" => $this->uploadFotoMurid()
        ];
        $this->db->insert('students', $data);
    }

    public function deleteMurid($id)
    {
        $this->db->where('id_student', $id);
        $this->db->delete('students');
    }

    public function editDataMurid()
    {
        
        $data = [
            "id_student" => $this->input->post('id_student'),
            "kelas" => $this->input->post('kelas'),
            "nama_murid" => $this->input->post('nama_murid', true),
            "tempat_lahir" => $this->input->post('tempat_lahir', true),
            "tanggal_lahir" => $this->input->post('tanggal_lahir', true),
            "alamat" => $this->input->post('alamat', true),
            "nomor_hp" => $this->input->post('nomor_hp'),
            "sosmed" => $this->input->post('sosmed', true),
            "motto" => $this->input->post('motto', true),
            "foto_murid" => $this->updateFotoMurid()
        ];

        $this->db->where('id_student', $this->input->post('id_student'));
        $this->db->update('students', $data);
    }

    private function uploadFotoMurid()
    {
        $config['upload_path']          = './assets/img/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_murid')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }

    private function updateFotoMurid()
    {
        $config['upload_path']          = './assets/img/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_murid')) {
            return $this->upload->data("file_name");
        }
        
        return $this->input->post('old_murid');
    }
}
Footer
© 2022 GitHub, Inc.
Footer navigation
Terms
Privacy
Security