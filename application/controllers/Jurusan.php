<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
			'content' => 'backend/jurusanKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_jurusan()
	{
		$q = $this->md->getAllJurusanNotDeleted();
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

	public function getoption_tahun_pelajaran()
	{
		$q = $this->md->getAllTahunPelajaranNotDeleted();
		$ret = '';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
			}
		}
		echo $ret;
	}

	public function save_jurusan()
	{
		// Set validation rules
		$this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|trim');
		$this->form_validation->set_rules('id_tahun_pelajaran', 'ID Tahun Pelajaran', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			// Return validation errors
			$ret['status'] = false;
			$ret['message'] = validation_errors();
			echo json_encode($ret);
			return;
		}

		$id = $this->input->post('id');
		$data['nama_jurusan'] = $this->input->post('nama_jurusan');
		$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		$cek = $this->md->cekJurusanDuplicate($data['nama_jurusan'], $data['id_tahun_pelajaran'], $id);
		if ($cek->num_rows() > 0) {
			$ret['status'] = false;
			$ret['message'] = 'Jurusan sudah ada';
		} else {
			if ($id) {
				$q = $this->md->updateJurusan($id, $data);
				$ret['status'] = $q ? true : false;
				$ret['message'] = $q ? 'Data berhasil diupdate' : 'Data gagal diupdate';
			} else {
				$q = $this->md->saveJurusan($data);
				$ret['status'] = $q ? true : false;
				$ret['message'] = $q ? 'Data berhasil disimpan' : 'Data gagal disimpan';
			}
		}

		echo json_encode($ret);
	}

	public function delete_jurusan($id)
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
		$q = $this->md->updateJurusan($id, $data);
		$ret['status'] = $q ? true : false;
		$ret['message'] = $q ? 'Data berhasil dihapus' : 'Data gagal dihapus';
		echo json_encode($ret);
	}
	
	public function edit_jurusan($id)
	{
		if (!$id) {
			$ret = array(
				'status' => false,
				'message' => 'ID tidak boleh kosong'
			);
			echo json_encode($ret);
			return;
		}

		$q = $this->md->getJurusanByID($id);
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
}

/* End of file: Jurusan.php */
