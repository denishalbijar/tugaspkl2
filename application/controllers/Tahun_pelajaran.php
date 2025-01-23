<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_pelajaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Masterdata_model', 'md');
		$this->load->library('form_validation'); // Load library form_validation
	}

	public function index()
	{
		$data = array(
			'menu' => 'backend/menu',
			'content' => 'backend/tahunPelajaranKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_tahun_pelajaran()
	{
		$q = $this->md->getAllTahunPelajaranNotDeleted();
		$dt = [];
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$dt[] = $row;
			}

			$ret['status'] = true;
			$ret['data'] = $dt;
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}

		echo json_encode($ret);
	}

	public function save_tahun_pelajaran()
	{
		// Set validation rules
		$this->form_validation->set_rules('nama_tahun_pelajaran', 'Nama Tahun Pelajaran', 'required|trim');
		$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|valid_date[Y-m-d]');
		$this->form_validation->set_rules('tanggal_akhir', 'Tanggal Akhir', 'required|valid_date[Y-m-d]');
		$this->form_validation->set_rules('status_tahun_pelajaran', 'Status Tahun Pelajaran', 'required|in_list[aktif,nonaktif]');

		if ($this->form_validation->run() == FALSE) {
			// Return validation errors
			$ret['status'] = false;
			$ret['message'] = validation_errors();
			echo json_encode($ret);
			return;
		}

		$id = $this->input->post('id');
		$data['nama_tahun_pelajaran'] = $this->input->post('nama_tahun_pelajaran');
		$data['tanggal_mulai'] = $this->input->post('tanggal_mulai');
		$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
		$data['status_tahun_pelajaran'] = $this->input->post('status_tahun_pelajaran');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		$cek = $this->md->cekTahunPelajaranDuplicate($data['nama_tahun_pelajaran'], $id);
		if ($cek->num_rows() > 0) {
			$ret['status'] = false;
			$ret['message'] = 'Tahun Pelajaran sudah ada';
		} else {
			if ($id) {
				$q = $this->md->updateTahunPelajaran($id, $data);
				$ret['status'] = $q ? true : false;
				$ret['message'] = $q ? 'Data berhasil diupdate' : 'Data gagal diupdate';
			} else {
				$q = $this->md->saveTahunPelajaran($data);
				$ret['status'] = $q ? true : false;
				$ret['message'] = $q ? 'Data berhasil disimpan' : 'Data gagal disimpan';
			}
		}

		echo json_encode($ret);
	}

	public function edit_tahun_pelajaran()
	{
		$id = $this->input->post('id');
		if (!$id) {
			$ret = array(
				'status' => false,
				'data' => [],
				'message' => 'ID tidak boleh kosong'
			);
			echo json_encode($ret);
			return;
		}

		$q = $this->md->getAllTahunPelajaranNotDeleted($id);
		if ($q->num_rows() > 0) {
			$ret = array(
				'status' => true,
				'data' => $q->row(),
				'message' => ''
			);
		} else {
			$ret = array(
				'status' => false,
				'data' => [],
				'message' => 'Data tidak ditemukan'
			);
		}

		echo json_encode($ret);
	}

	public function delete_tahun_pelajaran($id)
	{
		if (!$id) {
			$ret = array(
				'status' => false,
				'message' => 'ID tidak boleh kosong'
			);
			echo json_encode($ret);
			return;
		}

		$data['deleted_at'] = time();
		$q = $this->md->deleteTahunPelajaran($id, $data);
		$ret['status'] = $q ? true : false;
		$ret['message'] = $q ? 'Data berhasil dihapus' : 'Data gagal dihapus';
		echo json_encode($ret);
	}
}

/* End of file: Tahun_pelajaran.php */
