<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body table-responsive">
						<h4 class="card-title">Proses</h4>
						<div class="row mt-5">
							<div class="col-12 d-flex justify-content-center">
								<h3>Perhitungan AHP <i>(Analytic Hierarchy Process)</i></h3>
							</div>
							<div class="col-12 d-flex justify-content-center">
								<a href="javascript:void(0)" onclick="prosesKriteria()" class="btn btn-sm btn-outline-success"><i
										class="fa fa-refresh" aria-hidden="true"></i> proses</a>
							</div>
							<div class="ahp-note">
								<span>Note :</sp>
								<ul class="note-list">
									<li>Consistency Index : untuk menghitung indeks konsistensi dengan rumus CI = (l max - n)/n-1</li>
									<li>Index Random : value sudah sesuai dengan matriks/kategori</li>
									<li>Consistency Ratio : Nilai Konsisten Rasio (CI/RI)</li>
									<li>Prioritas : menghitung jumlah normalisasi tiap baris/jumlah kriteria</li>
									<li>Eigin Value : mengalikan matriks perbandingan berpasangan dengan bobot prioritas (A)(Wt)</li>
								</ul>
							</div>
							<!-- kriteria -->
							<div class="row mt-2" id="div-proses-kriteria"></div>
							<div class="row mt-2" id="div-proses-matriks-normalisasi"></div>
							<div class="mt-2" id="div-proses-matriks-konsistensi"></div>
						</div>
						<div class="row m-2" id="final-parent-div">
							<!-- ranking final -->
							<div class="row mt-2 justify-content-center" id="div-nilai-semua-kriteria"></div>
							<div class="row mt-2 mb-3" id="div-ranking">
								
							</div>
							<!-- subkriteria -->
							<div class="row mt-2" id="div-proses-subkriteria"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<!-- SUBKRITERIA -->
	<!-- simpan subkriteria -->
	<div class="modal fade" id="tambahSubKriteriaModal" tabindex="-1" aria-labelledby="tambahSubKriteriaModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tambahSubKriteriaModalLabel">Tambah Sub Kriteria</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-horizontal" id="simpanSubKriteria">
					<div class="modal-body">
						<div class="row mb-1">
							<div class="row mb-2">
								<div class="col-md-5 form-group">
									<label for="">Kriteria</label>
									<select class="form-control" style="width:100%" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." id="pilihKriteria" name="kriteria_id" required>
										<option value='0'>-- Pilih Kriteria --</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="">Kode</label>
									<input type="text" class="form-control" name="kode_sub_kriteria" required>
								</div>
								<div class="col-md-3">
									<label for="">Nilai</label>
									<input type="number" min="1" max="9" class="form-control" name="nilai_sub_kriteria" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2 form-group">
									<label for="">Simbol</label>
									<select class="form-control" name="simbol" id="simbol">
										<option value=""></option>
										<option value=">">></option>
										<option value="<"><</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="">Nominal 1</label>
									<input type="text" class="form-control" name="sub_kriteria_satu" id="sub_kriteria_satu" required>
								</div>
								<div class="col-md-4">
									<label for="">Nominal 2</label>
									<input type="text" class="form-control" name="sub_kriteria_dua" id="sub_kriteria_dua" data-bs-toggle="tooltip" data-bs-placement="top" title="Nominal 2 harus lebih besar nilainya dari Nominal 1">
								</div>
								<div class="col-md-2 pt-4">
									<input type="checkbox" name="persen" id="persen" value=1>
									<label for="">%</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="row">
								<button type="button" class="btn btn-sm btn-secondary">Keterangan Nilai</button>
							</div>
							<div class="row">
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
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-success btn-sm">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- ubah subkriteria -->
	<div class="modal fade" id="ubahSubKriteriaModal" tabindex="-1" aria-labelledby="ubahSubKriteriaModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ubahSubKriteriaModalLabel">Ubah Sub Kriteria</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-horizontal" id="perbaruiSubKriteria">
					<div class="modal-body">
						<input type="hidden" name="edit_id_sub_kriteria" id="edit_id_sub_kriteria">
						<div class="row mb-1">
							<div class="row mb-2">
								<div class="col-md-5 form-group">
									<label for="">Kriteria</label>
									<select class="form-control" style="width:100%" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." id="ubahKriteria" name="edit_kriteria_id" required>
										<option value='0'>-- Pilih Kriteria --</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="">Kode</label>
									<input type="text" class="form-control" name="edit_kode_sub_kriteria" id="edit_kode_sub_kriteria" required>
								</div>
								<div class="col-md-3">
									<label for="">Nilai</label>
									<input type="number" min="1" max="9" class="form-control" name="edit_nilai_sub_kriteria" id="edit_nilai_sub_kriteria" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-2 form-group">
									<label for="">Simbol</label>
									<select class="form-control" name="edit_simbol" id="edit_simbol">
										<option value=""></option>
										<option value=">">></option>
										<option value="<"><</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="">Nominal 1</label>
									<input type="text" class="form-control" name="edit_sub_kriteria_satu" id="edit_sub_kriteria_satu" required>
								</div>
								<div class="col-md-4">
									<label for="">Nominal 2</label>
									<input type="text" class="form-control" name="edit_sub_kriteria_dua" id="edit_sub_kriteria_dua" data-bs-toggle="tooltip" data-bs-placement="top" title="Nominal 2 harus lebih besar nilainya dari Nominal 1">
								</div>
								<div class="col-md-2 pt-4">
									<input type="checkbox" name="edit_persen" id="edit_persen" value=1>
									<label for="">%</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="row">
								<button type="button" class="btn btn-sm btn-secondary">Keterangan Nilai</button>
							</div>
							<div class="row">
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
