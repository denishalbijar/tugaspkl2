<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_awal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Masterdata2_model', 'mc'); // Load model dengan alias 'mc'
    }

    // Fungsi untuk menampilkan halaman utama
    public function index() {
        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/awalKonten',
            'title' => 'Admin'
        );
        $this->load->view('template', $data);
    }

    // Fungsi untuk mengambil data siswa
    public function table_siswa() {
        $data = $this->mc->table_siswa(); // Memanggil fungsi dari model
        echo json_encode(['data' => $data]); // Mengembalikan data sebagai JSON
    }

    // Fungsi untuk mengambil data orang tua
    public function table_orangtua() {
        $data = $this->mc->table_orangtua(); // Memanggil fungsi dari model
        echo json_encode(['data' => $data]); // Mengembalikan data sebagai JSON
    }

    // Fungsi untuk mengambil data kelas
    public function table_kelas() {
        $data = $this->mc->table_kelas(); // Memanggil fungsi dari model
        echo json_encode(['data' => $data]); // Mengembalikan data sebagai JSON
    }

    // Fungsi untuk menyimpan data siswa
    public function save_siswa() {
        $data = array(
            'nama_siswa' => $this->input->post('nama_siswa'),
            'nik' => $this->input->post('nik_siswa'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin_siswa')
        );
        $this->mc->insert_siswa($data);
        echo json_encode(['status' => true, 'message' => 'Data siswa berhasil disimpan']);
    }

    // Fungsi untuk menyimpan data orang tua
    public function save_orangtua() {
        $data = array(
            'nama_ayah' => $this->input->post('nama_ayah'),
            'nama_ibu' => $this->input->post('nama_ibu'),
            'no_telepon_ayah' => $this->input->post('no_telepon_ayah')
        );
        $this->mc->insert_orangtua($data);
        echo json_encode(['status' => true, 'message' => 'Data orang tua berhasil disimpan']);
    }

    // Fungsi untuk menyimpan data kelas
    public function save_kelas() {
        $data = array(
            'nama_kelas' => $this->input->post('nama_kelas'),
            'jurusan' => $this->input->post('jurusan_kelas')
        );
        $this->mc->insert_kelas($data);
        echo json_encode(['status' => true, 'message' => 'Data kelas berhasil disimpan']);
    }

    // Fungsi untuk update data siswa
    public function update_siswa($id) {
        $data = array(
            'nama_siswa' => $this->input->post('nama_siswa'),
            'nik' => $this->input->post('nik_siswa'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin_siswa')
        );
        $this->mc->update_siswa($id, $data); // Update data siswa berdasarkan ID
        echo json_encode(['status' => true, 'message' => 'Data siswa berhasil diperbarui']);
    }

    // Fungsi untuk update data orang tua
    public function update_orangtua($id) {
        $data = array(
            'nama_ayah' => $this->input->post('nama_ayah'),
            'nama_ibu' => $this->input->post('nama_ibu'),
            'no_telepon_ayah' => $this->input->post('no_telepon_ayah')
        );
        $this->mc->update_orangtua($id, $data); // Update data orang tua berdasarkan ID
        echo json_encode(['status' => true, 'message' => 'Data orang tua berhasil diperbarui']);
    }

    // Fungsi untuk update data kelas
    public function update_kelas($id) {
        $data = array(
            'nama_kelas' => $this->input->post('nama_kelas'),
            'jurusan' => $this->input->post('jurusan_kelas')
        );
        $this->mc->update_kelas($id, $data); // Update data kelas berdasarkan ID
        echo json_encode(['status' => true, 'message' => 'Data kelas berhasil diperbarui']);
    }

    // Fungsi untuk menghapus data siswa
    public function delete_siswa($id) {
        $this->mc->delete_siswa($id); // Menghapus data siswa berdasarkan ID
        echo json_encode(['status' => true, 'message' => 'Data siswa berhasil dihapus']);
    }

    // Fungsi untuk menghapus data orang tua
    public function delete_orangtua($id) {
        $this->mc->delete_orangtua($id); // Menghapus data orang tua berdasarkan ID
        echo json_encode(['status' => true, 'message' => 'Data orang tua berhasil dihapus']);
    }

    // Fungsi untuk menghapus data kelas
    public function delete_kelas($id) {
        $this->mc->delete_kelas($id); // Menghapus data kelas berdasarkan ID
        echo json_encode(['status' => true, 'message' => 'Data kelas berhasil dihapus']);
    }
}
