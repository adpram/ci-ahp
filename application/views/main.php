<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AHP Saham</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<style>

	</style>
</head>

<body>
	<div class="container mt-2">
		<div class="row">
			<div class="col-4">
				<h4>Kriteria</h4>
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-success btn-sm" id="tambahKriteria">
					tambah kriteria
				</button>

				<table class="table mt-2 table-bordered">
					<thead>
						<th style="width:15%">Kode</th>
						<th>Nama</th>
						<th style="width:15%">Nilai</th>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
    <!-- Modal -->
    <div class="modal fade" id="modalKriteria" tabindex="-1" aria-labelledby="modalKriteriaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKriteriaLabel">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Kode</p>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="kode_kriteria" id="kode_kriteria" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Nama</p>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" name="nama_kriteria" id="nama_kriteria" cols="10" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Nilai</p>
                        </div>
                        <div class="col-md-8">
                            <input type="number" min="1" max="9" class="form-control" name="nilai_kriteria" id="nilai_kriteria" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </div>
    </div>
	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script>
    $('#tambahKriteria').on('click', function() {
        $('#openModal').show();
    });
	</script>
</body>

</html>