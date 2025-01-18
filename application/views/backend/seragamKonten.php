<div class="card card-primary card-tabs">
	<div class="card-header p-0 pt-1">
		<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Jenis Seragam</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Stok Seragam</a>
			</li>

		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content" id="custom-tabs-one-tabContent">
			<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
				<div class="btn btn-primary addBtn mb-1" data-target="jenis_seragam">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">

					<table id="table_jenis_seragam" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th style="text-align: center;">No</th>
								<th style="text-align: center;">Jenis Seragam</th>

								<th style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>

					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
				<div class="btn btn-primary addBtn mb-1" data-target="stok_seragam">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">

					<table id="table_stok_seragam" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th style="text-align: center;">No</th>
								<th style="text-align: center;">Jenis Seragam</th>
								<th style="text-align: center;">Ukuran</th>
								<th style="text-align: center;">Stok</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>

					</table>
				</div>
			</div>

		</div>
	</div>
	<!-- /.card -->
</div>

<div class="modal" id="modal_jenis_seragam" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Jenis Seragam</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="form_jenis_seragam" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">

						<div class="mb-1">
							<label for="nama_jenis_seragam" class="form-label">Nama Jenis seragam</label>
							<input type="text" class="form-control" id="nama_jenis_seragam" name="nama_jenis_seragam" value="">
							<div class="error-block"></div>
						</div>
					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="jenis_seragam">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="modal_stok_seragam" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Stok Jenis Seragam</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="form_stok_seragam" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="jenis_seragam_id" class="form-label">Jenis Seragam</label>
							<select class="form-control" name="jenis_seragam_id" id="jenis_seragam_id">
								<option value="">- Pilih Jenis Seragam -</option>

							</select>
							<div class="error-block"></div>
						</div>


						<div class="mb-1">
							<label for="ukuran_seragam" class="form-label">Ukuran</label>
							<select class="form-control" id="ukuran_seragam" name="ukuran_seragam">
								<option value="">- Pilih Ukuran -</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="stok_seragam" class="form-label">Stok Seragam</label>
							<input type="text" class="form-control" name="stok_seragam" id="stok_seragam">

							<div class="error-block"></div>
						</div>


					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="stok_seragam">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('public/lib/crud.js'); ?>"></script>

<script>
	$(document).ready(function() {



		$('#jenis_seragam_id').load('<?php echo base_url('seragam/getOptionJenisSeragam'); ?>');

		loadTabel('jenis_seragam');
		loadTabel('stok_seragam');

	});

	$('.addBtn').on('click', function() {
		let target = $(this).data('target');
		let form = '#form_' + target;
		$(form + ' input[type = "hidden"]').val('');
		$(form)[0].reset();

		$('#modal_' + target).modal('show');
	});

	$('.saveBtn').on('click', function() {
		let target = $(this).data('target'); // ambil target yang akan dituju (sebagai acuan)
		let url = '<?php echo base_url('Seragam/save_'); ?>' + target; // buat url sesuai dengan target / acuan
		let formData = new FormData($('#form_' + target)[0]); // ambil semua value yang ada di form yang namanya sesuai dengan form target
		$.ajax({
			url: url,
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					$('#modal_' + target).modal('hide');
					loadTabel(target);
				} else {
					alert(response.message);
				}
			}
		});
	});


	function loadTabel(target) {
		let table = $('#table_' + target);
		let url = '<?php echo base_url('Seragam/table_'); ?>' + target;

		let tr = '';
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					table.find('tbody').html('');
					let no = 1;
					if (target == 'jenis_seragam') {
						$.each(response.data, function(i, item) {
							tr = $('<tr>');
							tr.append('<td>' + no++ + '</td>');
							tr.append('<td>' + item.nama_jenis_seragam + '</td>');
							tr.append('<td>	<button class="btn btn-primary editBtn" data-target="jenis_seragam" data-value="' + item.id + '">Edit</button> <button class="btn btn-danger deleteBtn" data-target="jenis_seragam" data-value="' + item.id + '">Delete</button></td>');
							table.find('tbody').append(tr);
						});
					} else if (target == 'stok_seragam') {
						$.each(response.data, function(i, item) {
							tr = $('<tr>');
							tr.append('<td>' + no++ + '</td>');
							tr.append('<td>' + item.nama_jenis_seragam + '</td>');
							tr.append('<td>' + item.ukuran_seragam + '</td>');
							tr.append('<td>' + item.stok_seragam + '</td>');
							tr.append('<td>	<button class="btn btn-primary editBtn" data-target="stok_seragam" data-value="' + item.id + '">Edit</button> <button class="btn btn-danger deleteBtn" data-target="stok_seragam" data-value="' + item.id + '">Delete</button></td>');
							table.find('tbody').append(tr);
						});
					}

				} else {
					tr = $('<tr>');
					table.find('tbody').html('');
					tr.append('<td colspan="4">' + response.message + '</td>');
				}
			}
		});
	}

	$(document).on('click', '.editBtn', function() {
		let target = $(this).data('target');
		let id = $(this).data('value');
		console.log(target);
		let url = '<?php echo base_url('Seragam/edit_'); ?>' + target + '/' + id;
		let form = '#form_' + target;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					$.each(response.data, function(i, item) {
						$(form + ' [name="' + i + '"]').val(item);
					});


					$('#modal_' + target).modal('show');
				} else {
					alert(response.message);
				}
			}
		});
	});

	$(document).on('click', '.deleteBtn', function() {
		let target = $(this).data('target');
		let id = $(this).data('value');
		let url = '<?php echo base_url('Seragam/delete_'); ?>' + target + '/' + id;
		let form = '#form_' + target;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					loadTabel(target);
				} else {
					alert(response.message);
				}
			}
		});
	})
</script>