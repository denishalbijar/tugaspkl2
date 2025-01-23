<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
			'content' => 'backend/kelasKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function getoption_tahun_pelajaran()
	{
		$q = $this->md->getAllTahunPelajaranNotDeleted();
		$ret = '<option value="">Pilih Tahun Pelajaran</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
			}
		}
		echo $ret;
	}

	public function getOption_jurusan()
	{
		$id = $this->input->post('id');
		log_message('info', 'ID yang diterima: ' . $id); // Log untuk debugging
		$q = $this->md->getJurusanByTahunPelajaranID($id);
		$ret = '<option value="">Pilih Jurusan</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_jurusan . '</option>';
			}
		}
		echo $ret;
	}

	public function table_kelas()
	{
		$q = $this->md->getAllKelasNotDeleted();
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

	public function save_kelas()
	{
		// Set validation rules
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim');
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required|numeric');
		$this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			// Return validation errors
			$ret['status'] = false;
			$ret['message'] = validation_errors();
			echo json_encode($ret);
			return;
		}

		$id = $this->input->post('id');
		$data['nama_kelas'] = $this->input->post('nama_kelas');
		$data['id_jurusan'] = $this->input->post('id_jurusan');
		$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		$cek = $this->md->cekKelasDuplicate($data['nama_kelas'], $data['id_jurusan'], $id);
		if ($cek->num_rows() > 0) {
			$ret['status'] = false;
			$ret['message'] = 'Kelas sudah ada';
		} else {
			if ($id) {
				$this->md->updateKelas($id, $data);
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil diupdate';
			} else {
				$this->md->saveKelas($data);
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil disimpan';
			}
		}
		echo json_encode($ret);
	}

	public function edit_kelas()
	{
		$id = $this->input->post('id');
		if (!$id) {
			$ret = array(
				'status' => false,
				'message' => 'ID tidak boleh kosong'
			);
			echo json_encode($ret);
			return;
		}

		$q = $this->md->getKelasByID($id);
		if ($q->num_rows() > 0) {
			$ret['status'] = true;
			$ret['data'] = $q->row();
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}
		echo json_encode($ret);
	}

	public function delete_kelas()
	{
		$id = $this->input->post('id');
		if (!$id) {
			$ret = array(
				'status' => false,
				'message' => 'ID tidak boleh kosong'
			);
			echo json_encode($ret);
			return;
		}

		$data['deleted_at'] = time();
		$q = $this->md->updateKelas($id, $data);
		$ret['status'] = $q ? true : false;
		$ret['message'] = $q ? 'Data berhasil dihapus' : 'Data gagal dihapus';
		echo json_encode($ret);
	}
}

/* End of file: Kelas.php */
