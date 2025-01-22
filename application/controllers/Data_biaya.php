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

    public function table_jenisbiaya()
    {
        $q = $this->md->getAllJenisBiaya();
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

    public function save_JenisBiaya()
    {
        $jenis_biaya = $this->input->post('jenis_biaya');

        if (empty($jenis_biaya)) {
            echo json_encode(['status' => false, 'message' => 'Jenis Biaya tidak boleh kosong!']);
            return;
        }

        $isExist = $this->md->checkJenisBiayaExist($jenis_biaya);

        if ($isExist) {
            echo json_encode(['status' => false, 'message' => 'Data sudah ada di database, silahkan buat data yang baru!']);
            return;
        }

        $this->md->saveJenisBiaya($jenis_biaya);
        echo json_encode(['status' => true, 'message' => 'Jenis Biaya berhasil disimpan!']);
    }

    public function edit_jenisbiaya($id)
	{
		$q = $this->md->getJenisBiayaById($id);
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

    public function delete_jenisbiaya($id)
	{
		// $id = $this->input->post('id');
		$q = $this->md->deleteJenisBiaya($id);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}

    public function table_hargabiaya()
{
    $q = $this->md->getAllHargaBiaya();
    $dt = [];
    if ($q->num_rows() > 0) {
        foreach ($q->result() as $row) {
            $dt[] = array(
                'id' => $row->id,
                'id_tahun_pelajaran' => $row->nama_tahun_pelajaran,  // Menampilkan nama tahun pelajaran
                'id_jenis_biaya' => $row->jenis_biaya,  // Menampilkan nama jenis biaya
                'harga' => number_format($row->harga, 2),  // Format harga
            );
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

    
    public function save_hargabiaya()
    {
        $id = $this->input->post('id');
        $id_jenis_biaya = $this->input->post('id_jenis_biaya');
        $id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran');
        $harga = $this->input->post('harga');

        if (empty($id_jenis_biaya) || empty($id_tahun_pelajaran) || empty($harga)) {
            echo json_encode([
                'status' => false,
                'message' => 'Semua field wajib diisi!',
            ]);
            return;
        }

        $data = array(
            'id_jenis_biaya' => $id_jenis_biaya,
            'id_tahun_pelajaran' => $id_tahun_pelajaran,
            'harga' => $harga,
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => 0,
        );

        if ($id) {
            $q = $this->md->updateHargaBiaya($id, $data);
            if ($q) {
                $ret['status'] = true;
                $ret['message'] = 'Data berhasil diupdate';
            } else {
                $error = $this->db->error();
                $ret['status'] = false;
                $ret['message'] = 'Data gagal diupdate. ' . $error['message'];
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $q = $this->md->saveHargaBiaya($data);

            if ($q) {
                $ret['status'] = true;
                $ret['message'] = 'Data berhasil disimpan';
            } else {
                $error = $this->db->error();
                $ret['status'] = false;
                $ret['message'] = 'Data gagal disimpan. ' . $error['message'];
            }
        }
                                                                               
        echo json_encode($ret);
    }

    public function edit_hargabiaya()
    {
        $id = $this->input->post('id');
        $q = $this->md->getHargaBiayaByID($id);
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

    public function delete_hargabiaya($id)
	{
		$data['deleted_at'] = time();
		$q = $this->md->updateHargaBiaya($id, $data);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}

    // Pastikan ID ada di dalam database


    public function getOption_JenisBiaya()
    {
        $q = $this->md->getJenisBiayaAktif();
        $opt = '<option value="">-- Pilih Jenis Biaya --</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $opt .= '<option value="' . $row->id . '">' . $row->jenis_biaya . '</option>';
            }
        }
        echo $opt;
    }

    public function getOption_TahunPelajaran()
    {
        $q = $this->md->getAllTahunPelajaranNotDeleted();
        $opt = '<option value="">-- Pilih Tahun Pelajaran --</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $opt .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
            }
        }
        echo $opt;
    }
}
?>
