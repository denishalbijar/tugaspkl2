<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Seragam extends CI_Controller
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
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}
	public function table_jenis_seragam()
	{
		$q = $this->md->getAllJenisSeragamNotDeleted();
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

	public function save_jenis_seragam()
{
    $id = $this->input->post('id');
    $nama_jenis_seragam = $this->input->post('nama_jenis_seragam');

    // Cek duplikasi nama jenis seragam
    if ($this->md->cekJenisSeragamDuplicate($nama_jenis_seragam, $id)->num_rows() > 0) {
        $ret['status'] = false;
        $ret['message'] = 'Nama jenis seragam sudah ada';
        echo json_encode($ret);
        return;
    }

    $data = array(
        'nama_jenis_seragam' => $nama_jenis_seragam,
        'created_at' => date('Y-m-d H:i:s'),
        'deleted_at' => 0
    );

    if ($id) {
        // Jika ada ID, lakukan update
        $data['updated_at'] = date('Y-m-d H:i:s');
        $q = $this->md->updateJenisSeragam($id, $data);
        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data berhasil diupdate';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data gagal diupdate';
        }
    } else {
        // Jika tidak ada ID, lakukan insert
        $q = $this->md->saveJenisSeragam($data);
        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data berhasil disimpan';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data gagal disimpan';
        }
    }
    echo json_encode($ret);
}
	public function edit_jenis_seragam($id)
	{
		$q = $this->md->getJenisSeragamByID($id);
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
	public function delete_jenis_seragam($id)
	{
		$data['deleted_at'] = time();
		$q = $this->md->updateJenisSeragam($id, $data);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}
	public function table_stok_seragam()
	{
		$q = $this->md->getAllDataStokSeragamNotDeleted();
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
	
	public function save_stok_seragam()
{
    $id = $this->input->post('id');
    $jenis_seragam_id = $this->input->post('jenis_seragam_id');
    $ukuran_seragam = $this->input->post('ukuran_seragam');
    $stok_seragam = $this->input->post('stok_seragam');

    // Cek duplikasi kombinasi jenis seragam dan ukuran seragam
    if ($this->md->cekStokSeragamDuplicate($jenis_seragam_id, $ukuran_seragam, $id)->num_rows() > 0) {
        $ret['status'] = false;
        $ret['message'] = 'Kombinasi jenis seragam dan ukuran seragam sudah ada';
        echo json_encode($ret);
        return;
    }

    $data = array(
        'jenis_seragam_id' => $jenis_seragam_id,
        'ukuran_seragam' => $ukuran_seragam,
        'stok_seragam' => $stok_seragam,
        'created_at' => date('Y-m-d H:i:s'),
        'deleted_at' => 0
    );

    if ($id) {
        // Jika ada ID, lakukan update
        $data['updated_at'] = date('Y-m-d H:i:s');
        $q = $this->md->updateDataStokSeragam($id, $data);
        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data berhasil diupdate';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data gagal diupdate';
        }
    } else {
        // Jika tidak ada ID, lakukan insert
        $q = $this->md->saveDataStokSeragam($data);
        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data berhasil disimpan';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data gagal disimpan';
        }
    }
    echo json_encode($ret);
}

	public function edit_stok_seragam($id)
	{
		$q = $this->md->getDataStokSeragamByID($id);
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
	public function delete_stok_seragam($id)
	{
		$data['deleted_at'] = time();
		$q = $this->md->updateDataStokSeragam($id, $data);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}
	public function getOption_Jenis_Seragam()
	{
		$q = $this->md->getAllJenisSeragamNotDeleted();
		$opt = '<option value="">-- Pilih Jenis Seragam --</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$opt .= '<option value="' . $row->id . '">' . $row->nama_jenis_seragam . '</option>';
			}
		}
		echo $opt;
	}
}
