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
                <button class="btn btn-primary mb-1 addBtn" data-target="siswa">
                    <i class="fas fa-plus"></i> Tambah Siswa
                </button>
                <div class="card">
                    <table id="table_siswa" class="table table-striped table-bordered mt-2" data-target="siswa">
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
                <button class="btn btn-primary mb-1 addBtn" data-target="orangtua">
                    <i class="fas fa-plus"></i> Tambah Orang Tua
                </button>
                <div class="card">
                    <table id="table_orangtua" class="table table-striped table-bordered mt-2" data-target="orangtua">
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
                <button class="btn btn-primary mb-1 addBtn" data-target="kelas">
                    <i class="fas fa-plus"></i> Tambah Kelas
                </button>
                <div class="card">
                    <table id="table_kelas" class="table table-striped table-bordered mt-2" data-target="kelas">
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
                <form id="form_siswa">
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
                    <button type="button" class="btn btn-primary saveBtn" data-target="siswa">Simpan</button>
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
                <form id="form_orangtua">
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
                    <button type="button" class="btn btn-primary saveBtn" data-target="orangtua">Simpan</button>
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
                <form id="form_kelas">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan_kelas">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan_kelas" name="jurusan_kelas" required>
                    </div>
                    <button type="button" class="btn btn-primary saveBtn" data-target="kelas">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="./public/lib/crud.js"></script>

<script>
$(document).ready(function () {

    // DataTables initialization
    const tableSiswa = $('#table_siswa').DataTable({
        ajax: {
            url: '/pendaftaran_awal/table_siswa',
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            { data: 'id' },
            { data: 'nama_siswa' },
            { data: 'nik' },
            { data: 'jenis_kelamin' },
            {
                data: null,
                render: function (data, type, row) {
                    return `<button class="btn btn-warning btn-sm editBtn" data-id="${row.id}" data-target="siswa">Edit</button>`;
                }
            }
        ]
    });

    const tableOrangtua = $('#table_orangtua').DataTable({
        ajax: {
            url: '/pendaftaran_awal/table_orangtua',
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            { data: 'id' },
            { data: 'nama_ayah' },
            { data: 'nama_ibu' },
            { data: 'no_telepon_ayah' },
            {
                data: null,
                render: function (data, type, row) {
                    return `<button class="btn btn-warning btn-sm editBtn" data-id="${row.id}" data-target="orangtua">Edit</button>`;
                }
            }
        ]
    });

    const tableKelas = $('#table_kelas').DataTable({
        ajax: {
            url: '/pendaftaran_awal/table_kelas',
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            { data: 'id' },
            { data: 'nama_kelas' },
            { data: 'id_jurusan' },
            {
                data: null,
                render: function (data, type, row) {
                    return `<button class="btn btn-warning btn-sm editBtn" data-id="${row.id}" data-target="kelas">Edit</button>`;
                }
            }
        ]
    });

    // Event handler for Add button
    $('.addBtn').on('click', function () {
        const target = $(this).data('target');
        openModal(target);
    });

    // Event handler for Edit button
    $(document).on('click', '.editBtn', function () {
        const id = $(this).data('id');
        const target = $(this).data('target');
        getEditData(id, target);
        openModal(target);
    });

    // Open modal for add/edit
    function openModal(target) {
        switch (target) {
            case 'siswa':
                $('#modal_siswa').modal('show');
                break;
            case 'orangtua':
                $('#modal_orangtua').modal('show');
                break;
            case 'kelas':
                $('#modal_kelas').modal('show');
                break;
        }
    }

    // Fetch data for editing (AJAX)
    function getEditData(id, target) {
        $.ajax({
            url: `/pendaftaran_awal/get_${target}_by_id/${id}`,
            type: 'GET',
            success: function (response) {
                const data = response.data;
                switch (target) {
                    case 'siswa':
                        $('#nama_siswa').val(data.nama_siswa);
                        $('#nik_siswa').val(data.nik);
                        $('#jenis_kelamin_siswa').val(data.jenis_kelamin);
                        break;
                    case 'orangtua':
                        $('#nama_ayah').val(data.nama_ayah);
                        $('#nama_ibu').val(data.nama_ibu);
                        $('#no_telepon_ayah').val(data.no_telepon_ayah);
                        break;
                    case 'kelas':
                        $('#nama_kelas').val(data.nama_kelas);
                        $('#jurusan_kelas').val(data.jurusan);
                        break;
                }
            }
        });
    }

    // Save Data (AJAX)
    $('.saveBtn').on('click', function () {
        const target = $(this).data('target');
        const form = $(`#form_${target}`);
        const formData = form.serialize(); // Serialize the form data
        
        $.ajax({
            url: `/pendaftaran_awal/save_${target}`,
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.status) {
                    alert(response.message);
                    $('#modal_' + target).modal('hide');
                    reloadTable(target); // Reload table after saving
                } else {
                    alert('Error saving data');
                }
            }
        });
    });

    // Reload DataTable based on target (siswa, orangtua, kelas)
    function reloadTable(target) {
        switch (target) {
            case 'siswa':
                tableSiswa.ajax.reload();
                break;
            case 'orangtua':
                tableOrangtua.ajax.reload();
                break;
            case 'kelas':
                tableKelas.ajax.reload();
                break;
        }
    }

});
</script>
