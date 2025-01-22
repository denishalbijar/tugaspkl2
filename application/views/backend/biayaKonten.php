<div class="container mt-5">
    <h2>Data Master</h2>

    <!-- Navtabs untuk memisahkan bagian -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="dataBiayaTab" data-toggle="tab" href="#dataBiaya" role="tab" aria-controls="dataBiaya" aria-selected="true">Jenis Biaya</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tableHargaBiayaTab" data-toggle="tab" href="#tableHargaBiaya" role="tab" aria-controls="tableHargaBiaya" aria-selected="false">Harga Biaya</a>
        </li>
    </ul>

    <!-- Konten Tab -->
    <div class="tab-content" id="myTabContent">
        <!-- Tab Data Jenis Biaya -->
        <div class="tab-pane fade show active" id="dataBiaya" role="tabpanel" aria-labelledby="dataBiayaTab">
            <button class="btn btn-primary mb-3 mt-3 addBtn" data-target="jenisBiaya">Tambah Jenis Biaya</button>
            <table class="table" id="table_jenisBiaya" data-target="jenisBiaya">
                <thead>
                    <tr>
                        <th data-key="id">No</th>
                        <th data-key="jenis_biaya">Jenis Biaya</th>
                        <th data-key="btn_aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan dimuat menggunakan fungsi dari crud.js -->
                </tbody>
            </table>
        </div>

        <!-- Tab Data Harga Biaya -->
        <div class="tab-pane fade" id="tableHargaBiaya" role="tabpanel" aria-labelledby="tableHargaBiayaTab">
            <button class="btn btn-primary mb-3 mt-3 addBtn" data-target="hargaBiaya">Tambah Harga Biaya</button>
            <table class="table" id="table_hargaBiaya" data-target="hargaBiaya">
                <thead>
                    <tr>
                        <th data-key="id">No</th>
                        <th data-key="id_tahun_pelajaran">Tahun Pelajaran</th>
                        <th data-key="id_jenis_biaya">Jenis Biaya</th>
                        <th data-key="harga">Harga Biaya</th>
                        <th data-key="btn_aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan dimuat menggunakan fungsi dari crud.js -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Jenis Biaya -->
<div class="modal fade" id="modal_jenisBiaya" tabindex="-1" role="dialog" aria-labelledby="modalJenisBiayaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form_jenisBiaya">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalJenisBiayaLabel">Tambah/Edit Jenis Biaya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="jenis_biaya">Jenis Biaya</label>
                        <input type="text" class="form-control" name="jenis_biaya" id="jenis_biaya" placeholder="Masukkan Jenis Biaya">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary saveBtn" data-target="jenisBiaya">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Harga Biaya -->
<div class="modal fade" id="modal_hargaBiaya" tabindex="-1" role="dialog" aria-labelledby="modalHargaBiayaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form_hargaBiaya">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHargaBiayaLabel">Tambah/Edit Harga Biaya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="tahun_pelajaran_id">Tahun Pelajaran</label>
                        <select class="form-control loadSelect" name="id_tahun_pelajaran" id="tahun_pelajaran_id" data-target="tahunPelajaran">
                            <option value="">Pilih Tahun Pelajaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_biaya_id">Jenis Biaya</label>
                        <select class="form-control loadSelect" name="id_jenis_biaya" id="jenis_biaya_id" data-target="jenisBiaya">
                            <option value="">Pilih Jenis Biaya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_biaya">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga_biaya" placeholder="Masukkan Harga">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary saveBtn" data-target="hargaBiaya">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="./public/lib/crud.js"></script>
