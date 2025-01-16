<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_biaya extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masterdata_model', 'md');
    }

    public function index()
    {
        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/biayaKonten',
            'title' => 'Admin'
        );
        $this->load->view('template', $data);
    }

    public function getAllJenisBiaya()
    {
        $data = $this->md->getAllJenisBiaya();
        echo json_encode($data);
    }

    public function getAllHargaBiaya()
    {
        $data = $this->md->getAllHargaBiaya();
        echo json_encode($data);
    }

    public function getAllTahunPelajaran()
    {
        $data = $this->md->getAllTahunPelajaran(); // Ambil data tahun pelajaran
        echo json_encode($data);
    }


    public function saveHargaBiaya()
    {
        $id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran');
        $jenis_biaya = $this->input->post('jenis_biaya');
        $harga = $this->input->post('harga');
        $this->md->saveHargaBiaya($id_tahun_pelajaran, $jenis_biaya, $harga);
        echo json_encode(['status' => true, 'message' => 'Harga Biaya berhasil disimpan!']);
    }


    public function saveJenisBiaya()
    {
        $jenis_biaya = $this->input->post('jenis_biaya', true); // Menggunakan XSS filter
        if (!empty($jenis_biaya)) {
            $this->md->saveJenisBiaya($jenis_biaya);
            $response = ['status' => true, 'message' => 'Jenis Biaya berhasil disimpan!'];
        } else {
            $response = ['status' => false, 'message' => 'Jenis Biaya tidak boleh kosong.'];
        }
        echo json_encode($response);
    }

    public function editJenisBiaya()
    {
        $id = $this->input->post('id', true);
        $jenis_biaya = $this->input->post('jenis_biaya', true);

        if (!empty($id) && !empty($jenis_biaya)) {
            $this->md->editJenisBiaya($id, $jenis_biaya);
            $response = ['status' => true, 'message' => 'Jenis Biaya berhasil diperbarui!'];
        } else {
            $response = ['status' => false, 'message' => 'Data tidak valid.'];
        }
        echo json_encode($response);
    }

    public function deleteJenisBiaya()
    {
        $id = $this->input->post('id', true);
        if (!empty($id)) {
            $this->md->deleteJenisBiaya($id);
            $response = ['status' => true, 'message' => 'Jenis Biaya berhasil dihapus!'];
        } else {
            $response = ['status' => false, 'message' => 'ID tidak valid.'];
        }
        echo json_encode($response);
    }

    public function deleteHargaBiaya()
    {
        $id = $this->input->post('id');
        $this->md->deleteHargaBiaya($id);
        echo json_encode(['status' => true, 'message' => 'Harga Biaya berhasil dihapus!']);
    }

    public function getHargaBiayaById()
    {
        $id = $this->input->get('id');
        $data = $this->md->getHargaBiayaById($id);
        echo json_encode($data);
    }
}
