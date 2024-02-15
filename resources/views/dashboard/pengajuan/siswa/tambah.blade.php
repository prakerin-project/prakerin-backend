@extends('layouts.index')
@section('title', 'Tambah pengajuan')
@section('content')

    <div class="row justify-content-center">
        <div class="col">
            <div class="card bg-white">
                <div class="card-header py-3">
                    <h2 class="m-0 fw-semibold text-center text-uppercase">Form Pengajuan Prakerin
                        </h1>
                </div>
                <div class="row card-body">
                    <div class="col">
                        <form id="form-pengajuan">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_industri" class="form-label">Nama perusahaan:</label>
                                <input type="text" class="form-control bg-white" id="nama_industri" name="nama_industri"
                                    autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="kontak_industri" class="form-label">Kontak perusahaan:</label>
                                <input type="text" class="form-control bg-white" id="kontak_industri"
                                    name="kontak_industri" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat perusahaan :</label>
                                <textarea name="alamat" class="form-control bg-white" id="alamat" cols="30" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="siswa" class="form-label">Pilih Siswa:</label>
                            <div class="d-flex gap-2 align-items-center">
                                <select name="siswa" id="siswa" class="form-select bg-white">
                                    @foreach ($siswa as $s)
                                        <option value="{{ $s->nis }}"
                                            data-kelas="{{ $s->kelas->tingkat . ' ' . $s->kelas->jurusan->akronim . ' ' . $s->kelas->kelompok }}"
                                            data-telepon="{{ $s->no_telp }}">
                                            {{ $s->nama }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" onclick="addRow()">Tambah</button>
                            </div>
                            <!-- Error message for duplicate data -->
                            <small id="duplicateMessage" class="text-danger d-none">Data siswa sudah ada dalam
                                tabel!</small>
                            <!-- Error message for maximum rows -->
                            <small id="maxRowMessage" class="text-danger d-none">Maksimal 4 siswa di tabel!</small>
                        </div>
                        <table id="dataTable" class="table table-bordered rounded overflow-hidden">
                            <thead class="table-secondary">
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>No Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <tr id="defaultRow">
                                    <td colspan="5" class="text-center">Silahkan pilih siswa terlebih dahulu!</td>
                                </tr>
                                <!-- Table body will be populated dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" form="form-pengajuan" class="btn btn-primary">Ajukan <i class="iconsax"
                            type="linear" stroke-width="1.5" icon="send-1"></i></button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        function addRow() {
            var siswa = document.getElementById("siswa");
            var selectedSiswa = siswa.options[siswa.selectedIndex];
            var rowData = {
                nis: selectedSiswa.value,
                nama: selectedSiswa.text,
                kelas: selectedSiswa.getAttribute('data-kelas'),
                telepon: selectedSiswa.getAttribute('data-telepon')
            };

            // Check if selected data already exists in the table
            var table = document.getElementById("dataTable");
            var rows = table.getElementsByTagName("tr");
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                if (cells.length > 0 && cells[0].innerHTML === rowData.nis) {
                    document.getElementById("duplicateMessage").classList.remove("d-none");
                    setTimeout(function() {
                        document.getElementById("duplicateMessage").classList.add("d-none");
                    }, 3000); // Hide the message after 3 seconds
                    return;
                }
            }

            // Check if maximum rows reached
            if (table.rows.length - 1 >= 4) {
                document.getElementById("maxRowMessage").classList.remove("d-none");
                setTimeout(function() {
                    document.getElementById("maxRowMessage").classList.add("d-none");
                }, 3000); // Hide the message after 3 seconds
                return;
            }

            var tableBody = document.getElementById("tableBody");
            var newRow = tableBody.insertRow();

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);

            cell1.innerHTML = rowData.nis;
            cell2.innerHTML = rowData.nama;
            cell3.innerHTML = rowData.kelas;
            cell4.innerHTML = rowData.telepon;
            cell5.innerHTML =
                '<button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">Hapus</button>';

            // Remove default row if it exists
            var defaultRow = document.getElementById("defaultRow");
            if (defaultRow) {
                defaultRow.parentNode.removeChild(defaultRow);
            }
        }

        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);

            // Show default row if table is empty
            var table = document.getElementById("dataTable");
            if (table.getElementsByTagName("tbody")[0].childElementCount === 0) {
                var defaultRow = document.getElementById("defaultRow");
                if (!defaultRow) {
                    var tableBody = document.getElementById("tableBody");
                    var newRow = tableBody.insertRow();
                    newRow.id = "defaultRow";
                    var cell = newRow.insertCell();
                    cell.colSpan = 5;
                    cell.classList.add("text-center");
                    cell.textContent = "Silahkan pilih siswa terlebih dahulu!";
                }
            }
        }
    </script>
    <script type="module">
        $('#form-pengajuan').on('submit', (function(e) {
            e.preventDefault();

            let data = new FormData(e.target)
            let nisSiswa = $('#tableBody td:first-child').map(function() {
                let nis = $(this).text();
                if (nis !== 'Silahkan pilih siswa terlebih dahulu!') {
                    return nis;
                }
            }).get()

            // Remove any existing alert
            $('#alertMessage').remove();

            // Check if the table contains only the default row
            if ($('#tableBody tr').length === 1 && $('#tableBody tr#defaultRow').length === 1) {
                let alertMessage = `
            <div id="alertMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                Tabel siswa kosong. Silakan tambah siswa terlebih dahulu.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
                $('#dataTable').after(alertMessage);
                return; // Stop form submission
            }

            data.append('nis_siswa[]', nisSiswa)
            console.log(Object.fromEntries(data));

            axios.post('<?= config('app.url') ?>/api/pengajuan', data)
                .then((res) => {
                    swal.fire('Berhasil tambah data!', '', 'success').then(function() {})
                })
                .catch(() => {
                    // show alert with error message
                    swal.fire('Gagal tambah data!', '', 'error').then(function() {})
                })
        }))
    </script>
@endsection
