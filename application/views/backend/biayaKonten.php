<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Biaya</h3>
    </div>
    <div class="card-body">
        <!-- Navtabs -->
        <ul class="nav nav-tabs" id="nav-tabs-data" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="jenis-biaya-tab" data-toggle="tab" href="#jenis-biaya" role="tab" aria-controls="jenis-biaya" aria-selected="true">Jenis Biaya</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="harga-biaya-tab" data-toggle="tab" href="#harga-biaya" role="tab" aria-controls="harga-biaya" aria-selected="false">Harga Biaya</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="nav-tabs-content">
            <!-- Jenis Biaya -->
            <div class="tab-pane fade show active" id="jenis-biaya" role="tabpanel" aria-labelledby="jenis-biaya-tab">
                <div class="btn btn-primary btnTambahJenisBiaya mb-2"> <i class="fas fa-plus"></i> Tambah Jenis Biaya</div>
                <table class="table table-bordered" id="tableJenisBiaya">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Jenis Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari server -->
                    </tbody>
                </table>
            </div>

            <!-- Harga Biaya -->
            <div class="tab-pane fade" id="harga-biaya" role="tabpanel" aria-labelledby="harga-biaya-tab">
                <div class="btn btn-primary btnTambahHargaBiaya mb-2"> <i class="fas fa-plus"></i> Tambah Harga Biaya</div>
                <table class="table table-bordered" id="tableHargaBiaya">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Tahun Pelajaran</th>
                            <th>Jenis Biaya</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari server -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Jenis Biaya -->
<div class="modal" id="modalJenisBiaya" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah/Edit Jenis Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formJenisBiaya" action="#" method="post">
                    <input type="hidden" id="jenis_biaya_id">
                    <div class="mb-1">
                        <label for="jenis_biaya" class="form-label">Jenis Biaya</label>
                        <input type="text" class="form-control" id="jenis_biaya" name="jenis_biaya">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveJenisBiayaBtn">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Harga Biaya -->
<div class="modal" id="modalHargaBiaya" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah/Edit Harga Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formHargaBiaya" action="#" method="post">
                    <input type="hidden" id="harga_biaya_id">
                    <div class="mb-1">
                        <label for="tahun_pelajaran" class="form-label">Tahun Pelajaran</label>
                        <select class="form-control" name="id_tahun_pelajaran" id="id_tahun_pelajaran">
                            <option value="">- Pilih Tahun Pelajaran -</option>
                            <!-- Data tahun pelajaran -->
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="jenis_biaya" class="form-label">Jenis Biaya</label>
                        <select class="form-control" name="jenis_biaya" id="jenis_biaya">
                            <option value="">- Pilih Jenis Biaya -</option>
                            <!-- Data jenis biaya -->
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveHargaBiayaBtn">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    loadJenisBiaya();
    loadHargaBiaya();
    loadTahunPelajaran();

    // Load data for Tahun Pelajaran
    function loadTahunPelajaran() {
        $.ajax({
            url: 'data_biaya/getAllTahunPelajaran',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let tahunPelajaranSelect = $('#id_tahun_pelajaran');
                tahunPelajaranSelect.html('<option value="">- Pilih Tahun Pelajaran -</option>');
                $.each(response, function(i, item) {
                    tahunPelajaranSelect.append('<option value="' + item.id + '">' + item.tahun_pelajaran + '</option>');
                });
            }
        });
    }

    // Load data for Jenis Biaya
    function loadJenisBiaya() {
        $.ajax({
            url: 'data_biaya/getAllJenisBiaya',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let table = $('#tableJenisBiaya');
                table.find('tbody').html('');
                let no = 1;
                $.each(response, function(i, item) {
                    let tr = $('<tr>');
                    tr.append('<td>' + no++ + '</td>');
                    tr.append('<td>' + item.jenis_biaya + '</td>');
                    tr.append('<td><button class="btn btn-primary" onclick="editJenisBiaya(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteJenisBiaya(' + item.id + ')">Delete</button></td>');
                    table.find('tbody').append(tr);
                });
            }
        });
    }

    // Load data for Harga Biaya
    function loadHargaBiaya() {
        $.ajax({
            url: 'data_biaya/getAllHargaBiaya',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let table = $('#tableHargaBiaya');
                table.find('tbody').html('');
                let no = 1;
                $.each(response, function(i, item) {
                    let tr = $('<tr>');
                    tr.append('<td>' + no++ + '</td>');
                    tr.append('<td>' + item.tahun_pelajaran + '</td>');
                    tr.append('<td>' + item.jenis_biaya + '</td>');
                    tr.append('<td>' + item.harga + '</td>');
                    tr.append('<td><button class="btn btn-primary" onclick="editHargaBiaya(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteHargaBiaya(' + item.id + ')">Delete</button></td>');
                    table.find('tbody').append(tr);
                });
            }
        });
    }

    // Add new Jenis Biaya
    $('.btnTambahJenisBiaya').click(function() {
        $('#formJenisBiaya').trigger('reset');
        $('#jenis_biaya_id').val('');  // Reset ID field for new entry
        $('#modalJenisBiaya').modal('show');
    });

    // Add new Harga Biaya
    $('.btnTambahHargaBiaya').click(function() {
        $('#formHargaBiaya').trigger('reset');
        $('#harga_biaya_id').val('');  // Reset ID field for new entry
        $('#modalHargaBiaya').modal('show');
    });

    // Save Jenis Biaya with validation (Add/Edit)
    $('.saveJenisBiayaBtn').click(function() {
        var jenisBiaya = $('#jenis_biaya').val();
        var jenisBiayaId = $('#jenis_biaya_id').val();  // Check if ID exists for edit
        if (jenisBiaya == "") {
            alert("Jenis Biaya tidak boleh kosong!");
            return;
        }

        var url = (jenisBiayaId) ? 'data_biaya/updateJenisBiaya' : 'data_biaya/saveJenisBiaya';  // Use correct URL for Add/Edit
        var data = { jenis_biaya: jenisBiaya };

        if (jenisBiayaId) {
            data.id = jenisBiayaId;  // Include ID for update
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                $('#modalJenisBiaya').modal('hide');
                loadJenisBiaya();
            }
        });
    });

    // Save Harga Biaya with validation (Add/Edit)
    $('.saveHargaBiayaBtn').click(function() {
        var tahunPelajaran = $('#id_tahun_pelajaran').val();
        var jenisBiaya = $('#jenis_biaya').val();
        var harga = $('#harga').val();
        var hargaBiayaId = $('#harga_biaya_id').val();  // Check if ID exists for edit
        if (tahunPelajaran == "" || jenisBiaya == "" || harga == "") {
            alert("Semua field harus diisi!");
            return;
        }

        var url = (hargaBiayaId) ? 'data_biaya/updateHargaBiaya' : 'data_biaya/saveHargaBiaya';  // Use correct URL for Add/Edit
        var data = {
            id_tahun_pelajaran: tahunPelajaran,
            jenis_biaya: jenisBiaya,
            harga: harga
        };

        if (hargaBiayaId) {
            data.id = hargaBiayaId;  // Include ID for update
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                $('#modalHargaBiaya').modal('hide');
                loadHargaBiaya();
            }
        });
    });

    // Edit Jenis Biaya
    window.editJenisBiaya = function(id) {
        $.ajax({
            url: 'data_biaya/getJenisBiayaById',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                $('#jenis_biaya_id').val(response.id);
                $('#jenis_biaya').val(response.jenis_biaya);
                $('#modalJenisBiaya').modal('show');
            }
        });
    };

    // Delete Jenis Biaya
    window.deleteJenisBiaya = function(id) {
        if (confirm("Apakah Anda yakin ingin menghapus jenis biaya ini?")) {
            $.ajax({
                url: 'data_biaya/deleteJenisBiaya',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    alert(response.message);
                    loadJenisBiaya();
                }
            });
        }
    };

    // Edit Harga Biaya
    window.editHargaBiaya = function(id) {
        $.ajax({
            url: 'data_biaya/getHargaBiayaById',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                $('#harga_biaya_id').val(response.id);
                $('#id_tahun_pelajaran').val(response.id_tahun_pelajaran);
                $('#jenis_biaya').val(response.jenis_biaya);
                $('#harga').val(response.harga);
                $('#modalHargaBiaya').modal('show');
            }
        });
    };

    // Delete Harga Biaya
    window.deleteHargaBiaya = function(id) {
        if (confirm("Apakah Anda yakin ingin menghapus harga biaya ini?")) {
            $.ajax({
                url: 'data_biaya/deleteHargaBiaya',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    alert(response.message);
                    loadHargaBiaya();
                }
            });
        }
    };
});

</script>
