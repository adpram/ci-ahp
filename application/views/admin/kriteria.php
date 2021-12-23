<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body table-responsive">
						<h4 class="card-title">Kriteria</h4>
						<p class="card-description">
							<button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
								data-bs-target="#tambahKriteriaModal">
								tambah kriteria
							</button>
						</p>
						<table class="table table-striped table-bordered nowrap" id="tbl-kriteria" style="width:100%">
							<thead>
								<th>Kode</th>
								<th>Nama</th>
								<th>Nilai</th>
								<th>Aksi</th>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<!-- KRITERIA -->
	<!-- simpan kriteria -->
	<div class="modal fade" id="tambahKriteriaModal" tabindex="-1" aria-labelledby="tambahKriteriaModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tambahKriteriaModalLabel">Tambah Kriteria</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-horizontal" id="simpanKriteria">
					<div class="modal-body">
						<div class="row mb-1">
							<div class="col-6">
								<div class="row">
									<div class="col-md-3">
										<p>Kode</p>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="kode_kriteria" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<p>Nama</p>
									</div>
									<div class="col-md-9">
										<textarea class="form-control" name="nama_kriteria" cols="10" rows="5"
											required></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<p>Nilai</p>
									</div>
									<div class="col-md-9">
										<input type="number" min="1" max="9" class="form-control" name="nilai_kriteria"
											required>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<button type="button" class="btn btn-sm btn-secondary">Keterangan Nilai</button>
								</div>
								<div class="row table-responsive">
									<table class="table table-bordered tbl-info-nilai-kriteria" style="width:100%">
										<thead>
											<th>Intensitas Kepentingan</th>
											<th>Definisi</th>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Sama pentingnya dibanding dengan yang lain</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Sedikit lebih penting dibanding yang lain</td>
											</tr>
											<tr>
												<td>5</td>
												<td>Cukup penting dibanding dengan yang lain</td>
											</tr>
											<tr>
												<td>7</td>
												<td>Sangat penting dibanding dengan yang lain</td>
											</tr>
											<tr>
												<td>9</td>
												<td>Ekstrim pentingnya dibanding yang lain</td>
											</tr>
											<tr>
												<td>2,4,6,8</td>
												<td>Nilai diantara dua penilaian yang berdekatan</td>
											</tr>
											<tr>
												<td>Resiprokal</td>
												<td>Jika elemen i memiliki salah satu angka di atas dibandingkan elemen
													j, maka j memiliki nilai kebaikannya ketika dibanding dengan i</td>
											</tr>
										</tbody>
									</table>
								</div>
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
	<!-- ubah kriteria -->
	<div class="modal fade" id="ubahKriteriaModal" tabindex="-1" aria-labelledby="ubahKriteriaModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ubahKriteriaModalLabel">Ubah Kriteria</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-horizontal" id="perbaruiKriteria">
					<div class="modal-body">
						<input type="hidden" name="edit_id_kriteria" id="id_kriteria">
						<div class="row mb-1">
							<div class="col-6">
								<div class="row">
									<div class="col-md-3">
										<p>Kode</p>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="edit_kode_kriteria"
											id="kode_kriteria" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<p>Nama</p>
									</div>
									<div class="col-md-9">
										<textarea class="form-control" name="edit_nama_kriteria" id="nama_kriteria"
											cols="10" rows="5" required></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<p>Nilai</p>
									</div>
									<div class="col-md-9">
										<input type="number" min="1" max="9" class="form-control"
											name="edit_nilai_kriteria" id="nilai_kriteria" required>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<button type="button" class="btn btn-sm btn-secondary">Keterangan Nilai</button>
								</div>
								<div class="row table-responsive">
									<table class="table table-bordered tbl-info-nilai-kriteria" style="width:100%">
										<thead>
											<th>Intensitas Kepentingan</th>
											<th>Definisi</th>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Sama pentingnya dibanding dengan yang lain</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Sedikit lebih penting dibanding yang lain</td>
											</tr>
											<tr>
												<td>5</td>
												<td>Cukup penting dibanding dengan yang lain</td>
											</tr>
											<tr>
												<td>7</td>
												<td>Sangat penting dibanding dengan yang lain</td>
											</tr>
											<tr>
												<td>9</td>
												<td>Ekstrim pentingnya dibanding yang lain</td>
											</tr>
											<tr>
												<td>2,4,6,8</td>
												<td>Nilai diantara dua penilaian yang berdekatan</td>
											</tr>
											<tr>
												<td>Resiprokal</td>
												<td>Jika elemen i memiliki salah satu angka di atas dibandingkan elemen
													j, maka j memiliki nilai kebaikannya ketika dibanding dengan i</td>
											</tr>
										</tbody>
									</table>
								</div>
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

	<input type="hidden" class="form-control" name="nilai_volume" id="nilai_volume">
	<input type="hidden" class="form-control" name="nilai_market_cap" id="nilai_market_cap">
	<input type="hidden" class="form-control" name="edit_nilai_volume" id="edit_nilai_volume">
	<input type="hidden" class="form-control" name="edit_nilai_market_cap" id="edit_nilai_market_cap">
	<input type="hidden" class="form-control" name="sub_kriteria_satu" id="sub_kriteria_satu">
	<input type="hidden" class="form-control" name="sub_kriteria_dua" id="sub_kriteria_dua">
	<input type="hidden" class="form-control" name="edit_sub_kriteria_satu" id="edit_sub_kriteria_satu">
	<input type="hidden" class="form-control" name="edit_sub_kriteria_dua" id="edit_sub_kriteria_dua">
