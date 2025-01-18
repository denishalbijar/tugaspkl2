<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_biaya extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masterdata_model', 'md');
    }

    // Menampilkan halaman utama
    public function index()
    {
        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/biayaKonten',
            'title' => 'Admin'
        );
        $this->load->view('template', $data);
    }

    // Mengambil semua jenis biaya
    public function getAllJenisBiaya()
    {
        $data = $this->md->getAllJenisBiaya();
        echo json_encode($data);
    }

    // Menyimpan jenis biaya baru dengan validasi duplikasi
    public function saveJenisBiaya()
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

    public function editJenisBiaya()
    {
        $id = $this->input->post('id');
        $jenis_biaya = $this->input->post('jenis_biaya');

        if (!$id || !$jenis_biaya) {
            echo json_encode(['status' => false, 'message' => 'Data tidak lengkap!']);
            return;
        }

        $result = $this->md->updateJenisBiaya($id, $jenis_biaya);
        echo json_encode($result);
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

    public function table_harga_biaya()
    {
        $q = $this->md->getAllHargaBiaya();
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

    public function save_harga_biaya()
    {
        $id = $this->input->post('id');
        $id_jenis_biaya = $this->input->post('id_jenis_biaya');
        $id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran');
        $harga = $this->input->post('harga_biaya');

        // Validasi jika input kosong
        if (empty($id_jenis_biaya) || empty($id_tahun_pelajaran) || empty($harga)) {
            echo json_encode([
                'status' => false,
                'message' => 'Semua field wajib diisi!',
            ]);
            return;
        }

        // Siapkan data untuk disimpan
        $data = array(
            'id_jenis_biaya' => $id_jenis_biaya,
            'id_tahun_pelajaran' => $id_tahun_pelajaran,
            'harga_biaya' => $harga,
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

    public function edit_harga_biaya()
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

    public function delete_harga_biaya()
    {
        $id = $this->input->post('id');
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

    public function getOptionJenisBiayaAktif()
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

    public function getOptionTahunPelajaran()
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
