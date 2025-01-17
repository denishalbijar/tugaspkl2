<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_seragam extends CI_Controller
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
            'content' => 'backend/seragamKonten',
            'title' => 'Data Seragam',
            'jenis_seragam' => $this->md->getAllJenisSeragam(),
            'stok_seragam' => $this->md->getAllStokSeragam()
        );
        $this->load->view('template', $data);
    }

    public function tambahJenisSeragam()
    {
        $nama_jenis_seragam = $this->input->post('nama_jenis_seragam');
        $this->md->saveJenisSeragam(['nama_jenis_seragam' => $nama_jenis_seragam]);
        redirect('data_seragam');
    }

    public function tambahStokSeragam()
    {
        $data = [
            'jenis_seragam_id' => $this->input->post('jenis_seragam_id'),
            'ukuran_seragam' => $this->input->post('ukuran_seragam'),
            'stok_seragam' => $this->input->post('stok_seragam')
        ];
        $this->md->saveStokSeragam($data);
        redirect('data_seragam');
    }

    public function hapusJenisSeragam($id)
    {
        $this->md->deleteJenisSeragam($id);
        redirect('data_seragam');
    }

    public function hapusStokSeragam($id)
    {
        $this->md->deleteStokSeragam($id);
        redirect('data_seragam');
    }

	public function editJenisSeragam($id)
{
    $data = ['nama_jenis_seragam' => $this->input->post('nama_jenis_seragam')];
    $this->md->updateJenisSeragam($id, $data);
    redirect('data_seragam');
}

public function editStokSeragam($id)
{
    $data = [
        'jenis_seragam_id' => $this->input->post('jenis_seragam_id'),
        'ukuran_seragam' => $this->input->post('ukuran_seragam'),
        'stok_seragam' => $this->input->post('stok_seragam')
    ];
    $this->md->updateStokSeragam($id, $data);
    redirect('data_seragam');
}

}
