<div class="container">
    <h3>Data Seragam</h3>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#jenis">Jenis Seragam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#stok">Stok Seragam</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Tab Jenis Seragam -->
        <div class="tab-pane fade show active" id="jenis">
    <h4>Jenis Seragam</h4>
    <!-- Form Tambah Jenis Seragam -->
    <form action="<?= base_url('data_seragam/tambahJenisSeragam') ?>" method="post" class="mb-4">
        <input type="text" name="nama_jenis_seragam" placeholder="Nama Jenis Seragam" class="form-control d-inline w-50" required>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Tabel Jenis Seragam -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jenis Seragam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jenis_seragam as $index => $seragam): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $seragam['nama_jenis_seragam'] ?></td>
                <td>
                    <!-- Tombol Edit -->
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editJenisSeragamModal<?= $seragam['id'] ?>">Edit</button>
                    <!-- Tombol Hapus -->
                    <a href="<?= base_url('data_seragam/hapusJenisSeragam/' . $seragam['id']) ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>

            <!-- Modal Edit Jenis Seragam -->
            <div class="modal fade" id="editJenisSeragamModal<?= $seragam['id'] ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url('data_seragam/editJenisSeragam/' . $seragam['id']) ?>" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Jenis Seragam</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <!-- Input Edit Nama Jenis Seragam -->
                                <input type="text" name="nama_jenis_seragam" class="form-control" value="<?= $seragam['nama_jenis_seragam'] ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


        <!-- Tab Stok Seragam -->
        <div class="tab-pane fade" id="stok">
    <h4>Stok Seragam</h4>
    <!-- Form Tambah Stok Seragam -->
    <form action="<?= base_url('data_seragam/tambahStokSeragam') ?>" method="post" class="mb-4">
        <select name="jenis_seragam_id" class="form-control w-50 d-inline" required>
            <option value="">Pilih Jenis Seragam</option>
            <?php foreach ($jenis_seragam as $seragam): ?>
            <option value="<?= $seragam['id'] ?>"><?= $seragam['nama_jenis_seragam'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="ukuran_seragam" placeholder="Ukuran Seragam" class="form-control d-inline w-25" required>
        <input type="number" name="stok_seragam" placeholder="Stok Seragam" class="form-control d-inline w-25" required>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Tabel Stok Seragam -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Seragam</th>
                <th>Ukuran</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stok_seragam as $index => $stok): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $stok['nama_jenis_seragam'] ?></td>
                <td><?= $stok['ukuran_seragam'] ?></td>
                <td><?= $stok['stok_seragam'] ?></td>
                <td>
                    <!-- Tombol Edit -->
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editStokSeragamModal<?= $stok['id'] ?>">Edit</button>
                    <!-- Tombol Hapus -->
                    <a href="<?= base_url('data_seragam/hapusStokSeragam/' . $stok['id']) ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>

            <!-- Modal Edit Stok Seragam -->
            <div class="modal fade" id="editStokSeragamModal<?= $stok['id'] ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url('data_seragam/editStokSeragam/' . $stok['id']) ?>" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Stok Seragam</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <!-- Select Jenis Seragam -->
                                <select name="jenis_seragam_id" class="form-control" required>
                                    <?php foreach ($jenis_seragam as $seragam): ?>
                                    <option value="<?= $seragam['id'] ?>" <?= $seragam['id'] == $stok['jenis_seragam_id'] ? 'selected' : '' ?>>
                                        <?= $seragam['nama_jenis_seragam'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- Input Ukuran Seragam -->
                                <input type="text" name="ukuran_seragam" class="form-control mt-2" value="<?= $stok['ukuran_seragam'] ?>" required>
                                <!-- Input Stok Seragam -->
                                <input type="number" name="stok_seragam" class="form-control mt-2" value="<?= $stok['stok_seragam'] ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
