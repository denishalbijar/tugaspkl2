// Pastikan script hanya berjalan setelah DOM siap
$(document).ready(function () {
    // Muat semua dropdown dengan class `.loadSelect`
    $('.loadSelect').each(function () {
        let target = $(this).data('target');
        let url = baseClass + '/getOption_' + target;
        $(this).load(url);
    });

    // Muat semua tabel dengan class `.table`
    $('.table').each(function () {
        let target = $(this).data('target');
        loadTabel(target);
    });
});

// Tambahkan event handler untuk tombol tambah
$('.addBtn').on('click', function () {
    let target = $(this).data('target');
    let form = '#form_' + target;
    $(form + ' input[type="hidden"]').val('');
    $(form)[0].reset();

    $('#modal_' + target).modal('show');
});

// Tambahkan event handler untuk tombol simpan
$('.saveBtn').on('click', function () {
    let target = $(this).data('target');
    let url = baseClass + '/save_' + target;
    let formData = new FormData($('#form_' + target)[0]);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                alert(response.message);
                $('#modal_' + target).modal('hide');
                loadTabel(target);
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert("Gagal menyimpan data.");
        }
    });
});

// Fungsi untuk memuat tabel
function loadTabel(target) {
    let table = $('#table_' + target);
    let url = baseClass + '/table_' + target;
    let tr = '';
    let th = '';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                generateTable(response.data, target);
            } else {
                tr = $('<tr>');
                table.find('tbody').html('');
                th = table.find('thead th').length;
                tr.append('<td colspan="' + th + '"> <h4>' + response.message + '</h4></td>');
                table.find('tbody').append(tr);
            }
        },
        error: function () {
            alert("Gagal memuat data tabel.");
        }
    });
}

// Fungsi untuk membuat tabel dinamis
function generateTable(data, target) {
    const $table = $(`#table_${target}`);
    const $thead = $table.find('thead th');
    const $tbody = $table.find('tbody');

    let rows = "";

    data.forEach((item, index) => {
        let row = "<tr>";

        $thead.each(function () {
            const key = $(this).data('key');

            if (key === "no") {
                row += `<td style="${$(this).attr('style')}">${index + 1}</td>`;
            } else if (key === "btn_aksi") {
                row += `
                    <td style="${$(this).attr('style')}">
                        <button class="btn btn-primary btn-sm editBtn" data-value="${item.id}" data-target="${target}" >Edit</button>
                        <button class="btn btn-danger btn-sm deleteBtn" data-value="${item.id}" data-target="${target}" >Delete</button>
                    </td>`;
            } else {
                row += `<td style="${$(this).attr('style')}">${item[key] || '-'}</td>`;
            }
        });

        row += "</tr>";
        rows += row;
    });

    $tbody.html(rows);
}

// Event untuk tombol edit
$(document).on('click', '.editBtn', function () {
    let target = $(this).data('target');
    let id = $(this).data('value');
    let url = baseClass + '/edit_' + target + '/' + id;
    let form = '#form_' + target;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                $.each(response.data, function (i, item) {
                    $(form + ' [name="' + i + '"]').val(item);
                });
                $('#modal_' + target).modal('show');
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert("Gagal mengambil data.");
        }
    });
});

// Event untuk tombol hapus
$(document).on('click', '.deleteBtn', function () {
    let target = $(this).data('target');
    let id = $(this).data('value');
    let url = baseClass + '/delete_' + target + '/' + id;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                alert(response.message);
                loadTabel(target);
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert("Gagal menghapus data.");
        }
    });
});
