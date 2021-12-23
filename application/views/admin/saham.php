<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body table-responsive">
						<h4 class="card-title">Saham</h4>
						<p class="card-description">
							<button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
								data-bs-target="#tambahSahamModal">
								tambah saham
							</button>
						</p>
						<table class="table table-striped table-bordered nowrap" id="tbl-saham" style="width:100%">
							<thead>
								<th class="align-middle">Kode</th>
								<th class="align-middle">Saham</th>
								<th class="align-middle">Tanggal</th>
								<th class="align-middle">Open</th>
								<th class="align-middle">High</th>
								<th class="align-middle">Low</th>
								<th class="align-middle">Close</th>
								<th class="align-middle">Open ke High</th>
								<th class="align-middle">Open ke Low</th>
								<th class="align-middle">Open ke Close</th>
								<th class="align-middle">Volume</th>
								<th class="align-middle">Market Cap</th>
								<th class="align-middle">Aksi</th>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Modal -->
	<!-- SAHAM -->
	<!-- simpan saham -->
	<div class="modal fade" id="tambahSahamModal" tabindex="-1" aria-labelledby="tambahSahamModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tambahSahamModalLabel">Tambah Saham</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-horizontal" id="simpanSaham">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-3">
								<label for="">Kode</label>
								<input type="text" class="form-control" name="kode_saham" placeholder="SO1" required>
							</div>
							<div class="col-md-3">
								<label for="">Saham</label>
								<input type="text" class="form-control" name="saham" placeholder="ANTM" required>
							</div>
							<div class="col-md-6">
								<label for="">Tanggal</label>
								<input type="date" class="form-control" name="tanggal_saham" value="2021-09-01">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="">Open</label>
								<input type="number" min="1" class="form-control" name="open" required>
							</div>
							<div class="col-md-6">
								<label for="">High</label>
								<input type="number" min="1" class="form-control" name="high" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="">Low</label>
								<input type="number" min="1" class="form-control" name="low" required>
							</div>
							<div class="col-md-6">
								<label for="">Close</label>
								<input type="number" min="1" class="form-control" name="close" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="">Volume</label>
								<input type="text" class="form-control" id="nilai_volume" name="volume">
							</div>
							<div class="col-md-6">
								<label for="">Market Cap</label>
								<input type="text" class="form-control" id="nilai_market_cap" name="market_cap">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-success btn-sm">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- ubah saham -->
	<div class="modal fade" id="ubahSahamModal" tabindex="-1" aria-labelledby="ubahSahamModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ubahSahamModalLabel">Ubah Saham</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-horizontal" id="perbaruiSaham">
					<div class="modal-body">
						<input type="hidden" name="edit_id_saham" id="edit_id_saham">
						<div class="row">
							<div class="col-md-3">
								<label for="">Kode</label>
								<input type="text" class="form-control" name="edit_kode_saham" id="kode_saham" required>
							</div>
							<div class="col-md-3">
								<label for="">Saham</label>
								<input type="text" class="form-control" name="edit_saham" id="edit_saham" placeholder="ANTM" required>
							</div>
							<div class="col-md-6">
								<label for="">Tanggal</label>
								<input type="date" class="form-control" name="edit_tanggal_saham" id="edit_tanggal_saham">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="">Open</label>
								<input type="number" min="1" class="form-control" name="edit_open" id="edit_open" required>
							</div>
							<div class="col-md-6">
								<label for="">High</label>
								<input type="number" min="1" class="form-control" name="edit_high" id="edit_high" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="">Low</label>
								<input type="number" min="1" class="form-control" name="edit_low" id="edit_low" required>
							</div>
							<div class="col-md-6">
								<label for="">Close</label>
								<input type="number" min="1" class="form-control" name="edit_close" id="edit_close" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="">Volume</label>
								<input type="text" class="form-control" id="edit_nilai_volume" name="edit_volume">
							</div>
							<div class="col-md-6">
								<label for="">Market Cap</label>
								<input type="text" class="form-control" id="edit_nilai_market_cap" name="edit_market_cap">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-success btn-sm">Perbarui</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<input type="hidden" class="form-control" name="sub_kriteria_satu" id="sub_kriteria_satu">
	<input type="hidden" class="form-control" name="sub_kriteria_dua" id="sub_kriteria_dua">
	<input type="hidden" class="form-control" name="edit_sub_kriteria_satu" id="edit_sub_kriteria_satu">
	<input type="hidden" class="form-control" name="edit_sub_kriteria_dua" id="edit_sub_kriteria_dua">