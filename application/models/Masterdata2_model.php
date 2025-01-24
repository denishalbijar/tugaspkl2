<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata2_model extends CI_Model {
    protected $tablePendaftarAwal = 'pendaftaran_awal';

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk mendapatkan data siswa
    public function table_siswa() {
        $query = $this->db->select('id, nama_siswa, nik, jenis_kelamin')
                          ->from($this->tablePendaftarAwal)
                          ->get();
        return $query->result(); // Mengembalikan hasil query
    }

    // Fungsi untuk mendapatkan data orang tua
    public function table_orangtua() {
        $query = $this->db->select('id, nama_ayah, nama_ibu, no_telepon_ayah')
                          ->from($this->tablePendaftarAwal)
                          ->get();
        return $query->result(); // Mengembalikan hasil query
    }

    // Fungsi untuk mendapatkan data kelas
    public function table_kelas() {
        $query = $this->db->select('id, nama_kelas, id_jurusan')
                          ->from($this->tablePendaftarAwal)
                          ->get();
        return $query->result(); // Mengembalikan hasil query
    }

    // Fungsi untuk menyimpan data siswa
    public function insert_siswa($data) {
        $this->db->insert($this->tablePendaftarAwal, $data);
    }

    // Fungsi untuk menyimpan data orang tua
    public function insert_orangtua($data) {
        $this->db->insert($this->tablePendaftarAwal, $data);
    }

    // Fungsi untuk menyimpan data kelas
    public function insert_kelas($data) {
        $this->db->insert($this->tablePendaftarAwal, $data);
    }
}
