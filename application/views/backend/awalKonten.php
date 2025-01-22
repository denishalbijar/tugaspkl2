<!-- Main Tab Container -->
<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-siswa-tab" data-toggle="pill" href="#custom-tabs-one-siswa" role="tab" aria-controls="custom-tabs-one-siswa" aria-selected="true">Data Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-orangtua-tab" data-toggle="pill" href="#custom-tabs-one-orangtua" role="tab" aria-controls="custom-tabs-one-orangtua" aria-selected="false">Data Orang Tua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-kelas-tab" data-toggle="pill" href="#custom-tabs-one-kelas" role="tab" aria-controls="custom-tabs-one-kelas" aria-selected="false">Data Kelas</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <!-- Data Siswa Tab -->
            <div class="tab-pane fade show active" id="custom-tabs-one-siswa" role="tabpanel" aria-labelledby="custom-tabs-one-siswa-tab">
                <button class="btn btn-primary mb-1" data-toggle="modal" data-target="#modal_siswa">
                    <i class="fas fa-plus"></i> Tambah Siswa
                </button>
                <div class="card">
                    <table id="table_siswa" class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data rows will be added dynamically later -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Data Orang Tua Tab -->
            <div class="tab-pane fade" id="custom-tabs-one-orangtua" role="tabpanel" aria-labelledby="custom-tabs-one-orangtua-tab">
                <button class="btn btn-primary mb-1" data-toggle="modal" data-target="#modal_orangtua">
                    <i class="fas fa-plus"></i> Tambah Orang Tua
                </button>
                <div class="card">
                    <table id="table_orangtua" class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>No Telepon Ayah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data rows will be added dynamically later -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Data Kelas Tab -->
            <div class="tab-pane fade" id="custom-tabs-one-kelas" role="tabpanel" aria-labelledby="custom-tabs-one-kelas-tab">
                <button class="btn btn-primary mb-1" data-toggle="modal" data-target="#modal_kelas">
                    <i class="fas fa-plus"></i> Tambah Kelas
                </button>
                <div class="card">
                    <table id="table_kelas" class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data rows will be added dynamically later -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Data Siswa -->
<div class="modal fade" id="modal_siswa" tabindex="-1" role="dialog" aria-labelledby="modal_siswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_siswaLabel">Tambah/Edit Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpan_siswa.php" method="POST">
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="nik_siswa">NIK</label>
                        <input type="text" class="form-control" id="nik_siswa" name="nik_siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin_siswa">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin_siswa" id="jenis_kelamin_siswa">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Data Orang Tua -->
<div class="modal fade" id="modal_orangtua" tabindex="-1" role="dialog" aria-labelledby="modal_orangtuaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_orangtuaLabel">Tambah/Edit Data Orang Tua</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpan_orangtua.php" method="POST">
                    <div class="form-group">
                        <label for="nama_ayah">Nama Ayah</label>
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu</label>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon_ayah">No Telepon Ayah</label>
                        <input type="text" class="form-control" id="no_telepon_ayah" name="no_telepon_ayah" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Data Kelas -->
<div class="modal fade" id="modal_kelas" tabindex="-1" role="dialog" aria-labelledby="modal_kelasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_kelasLabel">Tambah/Edit Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpan_kelas.php" method="POST">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan_kelas">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan_kelas" name="jurusan_kelas" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>
