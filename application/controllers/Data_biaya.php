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

    public function saveJenisBiaya()
    {
        $jenis_biaya = $this->input->post('jenis_biaya');
        $this->md->saveJenisBiaya($jenis_biaya);
        echo json_encode(['status' => true, 'message' => 'Jenis Biaya berhasil disimpan!']);
    }

    public function saveHargaBiaya()
    {
        $id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran');
        $jenis_biaya = $this->input->post('jenis_biaya');
        $harga = $this->input->post('harga');
        $this->md->saveHargaBiaya($id_tahun_pelajaran, $jenis_biaya, $harga);
        echo json_encode(['status' => true, 'message' => 'Harga Biaya berhasil disimpan!']);
    }

    public function editJenisBiaya()
    {
        $id = $this->input->post('id');
        $jenis_biaya = $this->input->post('jenis_biaya');
        $this->md->editJenisBiaya($id, $jenis_biaya);
        echo json_encode(['status' => true, 'message' => 'Jenis Biaya berhasil diperbarui!']);
    }

    public function deleteJenisBiaya()
    {
        $id = $this->input->post('id');
        $this->md->deleteJenisBiaya($id);
        echo json_encode(['status' => true, 'message' => 'Jenis Biaya berhasil dihapus!']);
    }

    public function getJenisBiayaById()
    {
        $id = $this->input->get('id');
        $data = $this->md->getJenisBiayaById($id);
        echo json_encode($data);
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
