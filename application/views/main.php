<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AHP Saham</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/select2/dist/css/select2.min.css') ?>">
	<style>
		.tbl-info-nilai-kriteria, .tbl-normalisasi, .tbl-matrix-consistency, .tbl-nilai-kriteria, .tbl-konsistensi, .tbl-hasil-akhir {
			font-size: 12px !important
		}
		.tbl-alternatif {
			font-size: 10px !important
		}
		.ahp-note {
			font-size: 12px
		}
		ul.note-list {
			border: solid 2px #10ac84;
			border-radius: 5px;
			padding: 0.5em 1em 0.5em 2.3em;
			position: relative;
		}
		ul.note-list li {
			line-height: 1.5;
			padding: 0.5em 0;
			list-style-type: none!important;
		}
		ul.note-list li:before {
			font-family: FontAwesome;
			content: "\f138";
			position: absolute;
			left : 1em;
			color: #10ac84;
		}

		.div-range {
			padding-top: 36px
		}

		.div-hasil-akhir {
			border-left: 6px solid #f7b731;
			border-top: 1px solid #ffda79;
			border-right: 1px solid #ffda79;
			border-bottom: 1px solid #ffda79;
			background-color: #f7f1e3;
		}
	</style>
</head>

<body>
	<div class="row m-2">
		<div class="col-5 pt-4">
			<button class="btn btn-outline-success btn-sm mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSaham">
				<i class="fa fa-angle-double-right"></i> Saham
			</button><br>
			<div class="collapse table-responsive mb-3" id="collapseSaham">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
					data-bs-target="#tambahSahamModal">
					tambah saham
				</button>
	
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

			<button class="btn btn-outline-success btn-sm mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKriteria">
				<i class="fa fa-angle-double-right"></i> Kriteria
			</button><br>
			<div class="collapse table-responsive mb-3" id="collapseKriteria">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
					data-bs-target="#tambahKriteriaModal">
					tambah kriteria
				</button>
	
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

			<button class="btn btn-outline-success btn-sm mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubkriteria">
				<i class="fa fa-angle-double-right"></i> Sub Kriteria
			</button><br>
			<div class="collapse table-responsive mb-3" id="collapseSubkriteria">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
					data-bs-target="#tambahSubKriteriaModal">
					tambah sub kriteria
				</button>
	
				<table class="table table-striped table-bordered nowrap" id="tbl-sub-kriteria" style="width:100%">
					<thead>
						<th>Kriteria</th>
						<th>Kode</th>
						<th>Keterangan</th>
						<th>Nilai</th>
						<th>Aksi</th>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
		<div class="col-7">
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
		</div>
	</div>
	<div class="row m-2">
		<!-- ranking final -->
		<div class="row mt-2 justify-content-center" id="div-nilai-semua-kriteria"></div>
		<div class="row mt-2 mb-3" id="div-ranking">
			
		</div>
		<!-- subkriteria -->
		<div class="row mt-2" id="div-proses-subkriteria"></div>
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
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-success btn-sm">Perbarui</button>
					</div>
				</form>
			</div>
		</div>
	</div>

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
									<label for="">Nominal 1</label>
									<select class="form-control" name="simbol" id="simbol">
										<option value=""></option>
										<option value=">">></option>
										<option value="<"><</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="" style="color:white">S</label>
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
									<label for="">Nominal 1</label>
									<select class="form-control" name="edit_simbol" id="edit_simbol">
										<option value=""></option>
										<option value=">">></option>
										<option value="<"><</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="" style="color:white">S</label>
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

	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/select2/dist/js/select2.min.js') ?>"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		var div_subkriteria = ""
		var div_ranking = ""
		var tblPerhitungan = []
		var tblKriteriaPertama = []
		var hasilRanking = []
        format_nominal_uang();
		var tabel_saham = $('#tbl-saham').DataTable({
			"responsive": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?= site_url('saham/data') ?>",
				type: "POST"
			},
		});

		var tabel_kriteria = $('#tbl-kriteria').DataTable({
			"responsive": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?= site_url('kriteria/data') ?>",
				type: "POST"
			},
		});

        var tabel_sub_kriteria = $('#tbl-sub-kriteria').DataTable({
			"responsive": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?= site_url('subkriteria/data') ?>",
				type: "POST"
			},
		});

		function formatAngka(angka){
			if ( angka.indexOf("-") !== -1 ) { return angka};
			var number_string = angka.replace(/[^-.\d]/g, '').toString(),
                split   		= number_string.split('.'),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
            if(ribuan){
                separator = sisa ? ',' : '';
                rupiah += separator + ribuan.join(',');
            }
            return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

		function format_nominal_uang(){
			var nilai_volume = document.getElementById('nilai_volume');
			nilai_volume.addEventListener('keyup', function(e){
				nilai_volume.value = formatAngka(this.value);
			});
			var nilai_market_cap = document.getElementById('nilai_market_cap');
			nilai_market_cap.addEventListener('keyup', function(e){
				nilai_market_cap.value = formatAngka(this.value);
			});

			var edit_nilai_volume = document.getElementById('edit_nilai_volume');
			edit_nilai_volume.addEventListener('keyup', function(e){
				edit_nilai_volume.value = formatAngka(this.value);
			});
			var edit_nilai_market_cap = document.getElementById('edit_nilai_market_cap');
			edit_nilai_market_cap.addEventListener('keyup', function(e){
				edit_nilai_market_cap.value = formatAngka(this.value);
			});

			var sub_kriteria_satu = document.getElementById('sub_kriteria_satu');
			sub_kriteria_satu.addEventListener('keyup', function(e){
				sub_kriteria_satu.value = formatAngka(this.value);
			});
			var sub_kriteria_dua = document.getElementById('sub_kriteria_dua');
			sub_kriteria_dua.addEventListener('keyup', function(e){
				sub_kriteria_dua.value = formatAngka(this.value);
			});

			var edit_sub_kriteria_satu = document.getElementById('edit_sub_kriteria_satu');
			edit_sub_kriteria_satu.addEventListener('keyup', function(e){
				edit_sub_kriteria_satu.value = formatAngka(this.value);
			});
			var edit_sub_kriteria_dua = document.getElementById('edit_sub_kriteria_dua');
			edit_sub_kriteria_dua.addEventListener('keyup', function(e){
				edit_sub_kriteria_dua.value = formatAngka(this.value);
			});
		}

		function singkat_angka(n) {
			var format_angka = 0
			var simbol = ''
			if (n < 900) {
				format_angka = (Number(n, 2)).toString();
				simbol = '';
			} else if (n < 900000) {
				format_angka = (Number(n / 1000, 2)).toString();
				simbol = 'rb';
			} else if (n < 900000000) {
				format_angka = (Number(n / 1000000, 2)).toString();
				simbol = 'jt';
			} else if (n < 900000000000) {
				format_angka = (Number(n / 1000000000, 2)).toString();
				simbol = 'M';
			} else {
				format_angka = (Number(n / 1000000000000, 2)).toString();
				simbol = 'T';
			}
			
			var str = "0"
			var pisah = '.' + str.repeat(2);
			result = format_angka.replace(pisah, format_angka)
			return result + simbol;
		}

		// SAHAM
		$('#simpanSaham').on('submit', function (e) {
			if (!e.isDefaultPrevented()) {

				$.ajax({
					url: "<?= site_url('saham/simpan') ?>",
					type: "POST",
					beforeSend: function () {
						swal({
							title: 'Tunggu',
							text: 'Memproses data...',
							buttons: false
						})
					},
					data: $('#simpanSaham').serialize(),
					dataType: "json",
					success: function (data) {
						swal({
							title: 'Berhasil!',
							text: 'Saham berhasil ditambahkan!',
							icon: 'success'
						}).then(function () {
							$('#tambahSahamModal').modal('hide');
							$('#tambahSahamModal form')[0].reset();
							//datatable refresh
							$('#tbl-saham').DataTable().ajax.reload();
						});
					},
					error: function (e) {
						console.log(e)
						alert("Gagal, silahkan menghubungi IT");
					}
				});
				return false;

			}
		});

		function editSaham(id) {
			$.ajax({
				url: "saham/edit/" + id,
				type: "GET",
				dataType: "JSON",
				success: function (data) {
					$('#ubahSahamModal').modal('show');
					$("#edit_id_saham").val(data.id_saham);
					$("#kode_saham").val(data.kode_saham);
					$("#edit_saham").val(data.saham);
					$("#edit_tanggal_saham").val(data.tanggal);
					$("#edit_open").val(data.open);
					$("#edit_high").val(data.high);
					$("#edit_low").val(data.low);
					$("#edit_close").val(data.close);
					$("#edit_nilai_volume").val(data.volume);
					$("#edit_nilai_market_cap").val(data.market_cap);
				},
				error: function () {
					alert("Gagal, silahkan menghubungi IT");
				}
			})
		}

		$('#perbaruiSaham').on('submit', function (e) {
			if (!e.isDefaultPrevented()) {

				$.ajax({
					url: "<?= site_url('saham/perbarui') ?>",
					type: "POST",
					beforeSend: function () {
						swal({
							title: 'Tunggu',
							text: 'Memproses data...',
							buttons: false
						})
					},
					data: $('#perbaruiSaham').serialize(),
					dataType: "json",
					success: function (data) {
						swal({
							title: 'Berhasil!',
							text: 'Saham berhasil diperbarui!',
							icon: 'success'
						}).then(function () {
							$('#ubahSahamModal').modal('hide');
							$('#ubahSahamModal form')[0].reset();
							$('#tbl-saham').DataTable().ajax.reload();
						});
					},
					error: function (e) {
						console.log(e)
						alert("Gagal, silahkan menghubungi IT");
					}
				});
				return false;

			}
		});

		function hapusSaham(id) {
			swal({
				title: "Apakah anda yakin ?",
				text: "Saham akan dihapus",
				icon: "warning",
				buttons: {
					canceled: {
						text: 'Cancel',
						value: 'cancel',
						className: 'swal-button btn-default'
					},
					deleted: {
						text: 'Delete',
						value: 'delete',
						className: 'swal-button btn-danger'
					}
				},
				dangerMode: true,
			}).then((willDelete) => {
				switch (willDelete) {
					default:
						swal("Saham aman");
						break;
					case 'delete':
						$.ajax({
							url: "saham/hapus/" + id,
							dataType: "json",
							type: "POST",
							success: function (data) {
								swal("Saham berhasil dihapus", {
									icon: "success",
								}).then(function () {
									$('#tbl-saham').DataTable().ajax.reload();
								});
							},
							error: function () {
								swal({
									text: 'Saham gagal dihapus!',
									icon: 'error'
								})
							}
						});
						break;
				}
			});
		}

		// KRITERIA
		$('#simpanKriteria').on('submit', function (e) {
			if (!e.isDefaultPrevented()) {

				$.ajax({
					url: "<?= site_url('kriteria/simpan') ?>",
					type: "POST",
					beforeSend: function () {
						swal({
							title: 'Tunggu',
							text: 'Memproses data...',
							buttons: false
						})
					},
					data: $('#simpanKriteria').serialize(),
					dataType: "json",
					success: function (data) {
						swal({
							title: 'Berhasil!',
							text: 'Kriteria berhasil ditambahkan!',
							icon: 'success'
						}).then(function () {
							$('#tambahKriteriaModal').modal('hide');
							$('#tambahKriteriaModal form')[0].reset();
							//datatable refresh
							$('#tbl-kriteria').DataTable().ajax.reload();
						});
					},
					error: function (e) {
						console.log(e)
						alert("Gagal, silahkan menghubungi IT");
					}
				});
				return false;

			}
		});

		function editKriteria(id) {
			$.ajax({
				url: "kriteria/edit/" + id,
				type: "GET",
				dataType: "JSON",
				success: function (data) {
					$('#ubahKriteriaModal').modal('show');
					$("#id_kriteria").val(data.id_kriteria);
					$("#kode_kriteria").val(data.kode_kriteria);
					$("#nama_kriteria").val(data.nama_kriteria);
					$("#nilai_kriteria").val(data.nilai_kriteria);
				},
				error: function () {
					alert("Gagal, silahkan menghubungi IT");
				}
			})
		}

		$('#perbaruiKriteria').on('submit', function (e) {
			if (!e.isDefaultPrevented()) {

				$.ajax({
					url: "<?= site_url('kriteria/perbarui') ?>",
					type: "POST",
					beforeSend: function () {
						swal({
							title: 'Tunggu',
							text: 'Memproses data...',
							buttons: false
						})
					},
					data: $('#perbaruiKriteria').serialize(),
					dataType: "json",
					success: function (data) {
						swal({
							title: 'Berhasil!',
							text: 'Kriteria berhasil diperbarui!',
							icon: 'success'
						}).then(function () {
							$('#ubahKriteriaModal').modal('hide');
							$('#ubahKriteriaModal form')[0].reset();
							$('#tbl-kriteria').DataTable().ajax.reload();
							$('#tbl-sub-kriteria').DataTable().ajax.reload();
						});
					},
					error: function (e) {
						console.log(e)
						alert("Gagal, silahkan menghubungi IT");
					}
				});
				return false;

			}
		});

		function hapusKriteria(id) {
			swal({
				title: "Apakah anda yakin ?",
				text: "Kriteria akan dihapus",
				icon: "warning",
				buttons: {
					canceled: {
						text: 'Cancel',
						value: 'cancel',
						className: 'swal-button btn-default'
					},
					deleted: {
						text: 'Delete',
						value: 'delete',
						className: 'swal-button btn-danger'
					}
				},
				dangerMode: true,
			}).then((willDelete) => {
				switch (willDelete) {
					default:
						swal("Kriteria aman");
						break;
					case 'delete':
						$.ajax({
							url: "kriteria/hapus/" + id,
							dataType: "json",
							type: "POST",
							success: function (data) {
								if (data.status == "error") {
									swal({
										title: 'Gagal menghapus data!',
										text: 'Kriteria memiliki subkriteria, silahkan hapus subkriteria terlebih dahulu',
										icon: 'error'
									})
								} else {
									swal("Kriteria berhasil dihapus", {
										icon: "success",
									}).then(function () {
										$('#tbl-kriteria').DataTable().ajax.reload();
									});
								}
							},
							error: function () {
								swal({
									text: 'Kriteria gagal dihapus!',
									icon: 'error'
								})
							}
						});
						break;
				}
			});
		}

		// SUB KRITERIA
		$("#pilihKriteria").select2({
			dropdownParent: $("#tambahSubKriteriaModal"),
			ajax: {
				url: "<?= site_url('subkriteria/data_kriteria') ?>",
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});

		$('#simpanSubKriteria').on('submit', function (e) {
			if (!e.isDefaultPrevented()) {

				$.ajax({
					url: "<?= site_url('subkriteria/simpan') ?>",
					type: "POST",
					beforeSend: function () {
						swal({
							title: 'Tunggu',
							text: 'Memproses data...',
							buttons: false
						})
					},
					data: $('#simpanSubKriteria').serialize(),
					dataType: "json",
					success: function (data) {
						swal({
							title: 'Berhasil!',
							text: 'Sub Kriteria berhasil ditambahkan!',
							icon: 'success'
						}).then(function () {
							$('#tambahSubKriteriaModal').modal('hide');
							$('#tambahSubKriteriaModal form')[0].reset();
							//datatable refresh
							$('#tbl-sub-kriteria').DataTable().ajax.reload();
						});
					},
					error: function (e) {
						console.log(e)
						alert("Gagal, silahkan menghubungi IT");
					}
				});
				return false;

			}
		});

		function editSubKriteria(id) {
			$.ajax({
				url: "subkriteria/edit/" + id,
				type: "GET",
				dataType: "JSON",
				success: function (data) {
					$('#ubahSubKriteriaModal').modal('show');
					$("#ubahKriteria").select2({
						dropdownParent: $("#ubahSubKriteriaModal"),
						ajax: {
							url: "<?= site_url('subkriteria/data_kriteria') ?>",
							type: "post",
							dataType: 'json',
							delay: 250,
							data: function (params) {
								return {
									searchTerm: params.term // search term
								};
							},
							processResults: function (response) {
								return {
									results: response
								};
							},
							cache: true
						}
					});
					$("#ubahKriteria").html('<option value = "'+data.kriteria_id+'" selected >('+data.kode_kriteria+') '+data.nama_kriteria+'</option>');
					$("#edit_id_sub_kriteria").val(data.id_sub_kriteria);
					$("#edit_kode_sub_kriteria").val(data.kode_sub_kriteria);
					$("#edit_simbol").val(data.simbol).trigger('change');
					$("#edit_sub_kriteria_satu").val(data.sub_kriteria_satu);
					$("#edit_sub_kriteria_dua").val(data.sub_kriteria_dua);
					if(data.persen == 1){
						$('#edit_persen').prop('checked', true);
					}else{
						$('#edit_persen').prop('checked', false);
					}
					$("#edit_nilai_sub_kriteria").val(data.nilai_sub_kriteria);
				},
				error: function () {
					alert("Gagal, silahkan menghubungi IT");
				}
			})
		}

		$('#perbaruiSubKriteria').on('submit', function (e) {
			if (!e.isDefaultPrevented()) {

				$.ajax({
					url: "<?= site_url('subkriteria/perbarui') ?>",
					type: "POST",
					beforeSend: function () {
						swal({
							title: 'Tunggu',
							text: 'Memproses data...',
							buttons: false
						})
					},
					data: $('#perbaruiSubKriteria').serialize(),
					dataType: "json",
					success: function (data) {
						swal({
							title: 'Berhasil!',
							text: 'Sub Kriteria berhasil diperbarui!',
							icon: 'success'
						}).then(function () {
							$('#ubahSubKriteriaModal').modal('hide');
							$('#ubahSubKriteriaModal form')[0].reset();
							$('#tbl-sub-kriteria').DataTable().ajax.reload();
						});
					},
					error: function (e) {
						console.log(e)
						alert("Gagal, silahkan menghubungi IT");
					}
				});
				return false;

			}
		});

		function hapusSubKriteria(id) {
			swal({
				title: "Apakah anda yakin ?",
				text: "Sub Kriteria akan dihapus",
				icon: "warning",
				buttons: {
					canceled: {
						text: 'Cancel',
						value: 'cancel',
						className: 'swal-button btn-default'
					},
					deleted: {
						text: 'Delete',
						value: 'delete',
						className: 'swal-button btn-danger'
					}
				},
				dangerMode: true,
			}).then((willDelete) => {
				switch (willDelete) {
					default:
						swal("Sub Kriteria aman");
						break;
					case 'delete':
						$.ajax({
							url: "subkriteria/hapus/" + id,
							dataType: "json",
							type: "POST",
							success: function (data) {
								swal("Sub Kriteria berhasil dihapus", {
									icon: "success",
								}).then(function () {
									$('#tbl-sub-kriteria').DataTable().ajax.reload();
								});
							},
							error: function () {
								swal({
									text: 'Sub Kriteria gagal dihapus!',
									icon: 'error'
								})
							}
						});
						break;
				}
			});
		}

		// PROSES KRITERIA
		function prosesKriteria() {
			$.ajax({
				url: "kriteria/proses",
				type: "GET",
				beforeSend: function () {
					swal({
						title: 'Tunggu',
						text: 'Memproses data...',
						buttons: false
					})
				},
				dataType: "JSON",
				success: function (data) {
					swal.close()
					matriksPerbandinganKriteria(data)
					prosesNormalisasi(data).then(dataPerhitungan => {
						tblKriteriaPertama = dataPerhitungan 
						matriksNormalisasiKriteria(data)
					})
					prosesSubkriteria(data).then(dataPerhitungan => {
						tblPerhitungan = dataPerhitungan // tk gwe global si tblPerhitungan ben ra kakean parameter nk function turunane
						prosesRankingAwal(data).then(dataRanking => {
							hasilRanking = dataRanking
							prosesRanking(data)
						})
					})					
				},
				error: function () {
					alert("Gagal, silahkan menghubungi IT");
				}
			})
		}

		function matriksPerbandinganKriteria(data) {

			var th = ""
			for (i = 0; i < data.length; i++) {
				th += "<th>" + data[i].kode_kriteria + "</th>"
			}

			var tr_td = ""

			let totals = (new Array(data.length)).fill(0)
			for (let x of data) {
				tr_td += '<tr>'
				tr_td += '<td>' + x.kode_kriteria + '</td>'
				for (let i in data) {
					let y = data[i]
					let val = x.nilai_kriteria / y.nilai_kriteria
					tr_td += '<td>' + val + '</td>'

					totals[i] += parseFloat(val)
				}
				tr_td += '</tr>'
			}

			let tfoot = ''
			for (let x of totals) {
				tfoot += '<th>' + x + '</th>'
			}

			$('#div-proses-kriteria').html("<div class='col-md-12 table-responsive'>"+
                "<p>Matriks Perbandingan Antar Kriteria</p>" +
                "<table class='table table-bordered border-success' style='width:100%'>" +
                    "<thead>" +
                        "<tr>" +
                            "<th>Kode</th>" +
                            th +
                        "</tr>" +
                    "</thead>" +
                    "<tbody>" +
                        tr_td +
                        "<tr>" +
                            "<th>Total</th>" +
                            tfoot +
                        "</tr>" +
                    "</tbody>" +
                "</table>"+
            "</div>");
		}

		function prosesNormalisasi(data){// untuk ambil nilai kriteria
			return new Promise(async (resolve, reject) => {
				resolve(matriksNormalisasiKriteria(data))
			})
		}

		function matriksNormalisasiKriteria(data) {
			var returned = []

			var th = ""
			for (i = 0; i < data.length; i++) {
				th += "<th>" + data[i].kode_kriteria + "</th>"
			}

			// matriks perbandingan
			var tr_td = ""

			let totals = (new Array(data.length)).fill(0)
			for (let x of data) {
				tr_td += '<tr>'
				tr_td += '<td>' + x.kode_kriteria + '</td>'
				for (let i in data) {
					let y = data[i]
					let val = x.nilai_kriteria / y.nilai_kriteria
					tr_td += '<td>' + val + '</td>'

					totals[i] += parseFloat(val)
				}
				tr_td += '</tr>'
			}

			let tfoot = ''
			for (let x of totals) {
				tfoot += '<th>' + x + '</th>'
			}

			// normalisasi
			var tr_td_normalisasi = ""
			let tr_td_nilai_kriteria = ""

			let totals_normalisasi = (new Array(data.length)).fill(0)
			let total_jumlah_normalisasi = 0
			let total_prioritas_normalisasi = 0
			let total_eigen_value_normalisasi = 0
			let banyak_data = 0
			for (let [index_x, x] of data.entries()) {
				banyak_data = data.length
				tr_td_normalisasi += '<tr>'
				tr_td_normalisasi += '<td>' + x.kode_kriteria + '</td>'

				tr_td_nilai_kriteria += '<tr>'
				tr_td_nilai_kriteria += '<td>' + x.nama_kriteria + '</td>'

				let jumlah_normalisasi = 0
				for (let i in data) {
					let y = data[i]

					let val = (x.nilai_kriteria / y.nilai_kriteria) / totals[i]
					tr_td_normalisasi += '<td>' + val + '</td>'

					totals_normalisasi[i] += parseFloat(val)
					jumlah_normalisasi += val
				}

				total_jumlah_normalisasi += jumlah_normalisasi
				prioritas_normalisasi = jumlah_normalisasi / data.length
				total_prioritas_normalisasi += prioritas_normalisasi
				eigen_value = prioritas_normalisasi * totals[index_x]
				total_eigen_value_normalisasi += eigen_value

				tr_td_normalisasi += '<td>' + jumlah_normalisasi + '</td>'
				tr_td_normalisasi += '<td>' + prioritas_normalisasi + '</td>'
				tr_td_normalisasi += '<td>' + eigen_value + '</td>'
				tr_td_normalisasi += '</tr>'

				tr_td_nilai_kriteria += '<td>' + prioritas_normalisasi + '</td>'
				tr_td_nilai_kriteria += '</tr>'

				returned.push({ nama_kriteria:  x.nama_kriteria, nilai: prioritas_normalisasi })

			}
			let tfoot_normalisasi = ''
			for (let x of totals_normalisasi) {
				tfoot_normalisasi += '<th>' + x + '</th>'
			}
			tfoot_normalisasi += '<th>' + total_jumlah_normalisasi + '</th>'
			tfoot_normalisasi += '<th>' + total_prioritas_normalisasi + '</th>'
			tfoot_normalisasi += '<th>' + total_eigen_value_normalisasi + '</th>'
			matriksKonsistensiKriteria(banyak_data, total_eigen_value_normalisasi)

			$('#div-proses-matriks-normalisasi').html("<div class='col-md-12 table-responsive'>"+
                "<p>Normalisasi</p>" +
				"<table class='table table-bordered border-success tbl-normalisasi' style='width:100%'>" +
                    "<thead>" +
                        "<tr>" +
                            "<th>Kode</th>" +
                            th +
                            "<th>Jumlah</th>" +
                            "<th>Prioritas</th>" +
                            "<th>Eigen Value</th>" +
                        "</tr>" +
                    "</thead>" +
                    "<tbody>" +
                        tr_td_normalisasi +
                        "<tr>" +
                            "<th>Total</th>" +
                            tfoot_normalisasi +
                        "</tr>" +
                    "</tbody>" +
				"</table>"+
            "</div>");
			$('#div-nilai-kriteria').html("<table class='table table-bordered border-success tbl-nilai-kriteria' style='width:100%'>" +
				"<tr>" +
					"<th colspan='2' style='text-align:center'>Nilai Kriteria</th>" +
				"</tr>" +
				tr_td_nilai_kriteria+				
			"</table>");	
			return returned
		}

		function matriksKonsistensiKriteria(banyak_data, total_eigen_value_normalisasi) {
			var ci = (total_eigen_value_normalisasi - banyak_data) / banyak_data - 1
			var ri = 0
			if (banyak_data == 1 || banyak_data == 2) {
				ri = 0.00
			} else if (banyak_data == 3) {
				ri = 0.58
			} else if (banyak_data == 4) {
				ri = 0.90
			} else if (banyak_data == 5) {
				ri = 1.12
			} else if (banyak_data == 6) {
				ri = 1.24
			} else if (banyak_data == 7) {
				ri = 1.32
			} else if (banyak_data == 8) {
				ri = 1.41
			} else if (banyak_data == 9) {
				ri = 1.45
			} else if (banyak_data == 10) {
				ri = 1.49
			} else {
				ri = 0
			}
			var cr = ci / ri
			var is_consistent = ""
			if (cr <= 0,1) {
				is_consistent = "KONSISTEN"
			} else {
				is_consistent = "Tidak Konsisten"
			}
			$('#div-proses-matriks-konsistensi').html("<div class='row table-responsive'>" +
				"<p>Konsistensi</p>" +
				"<div class='col-4'>" +
                    "<table class='table table-bordered border-success tbl-konsistensi' style='width:100%'>" +
                        "<tr>" +
                            "<th>CI</th>" +
                            "<td>" + ci + "</td>" +
                            "<td rowspan='2'></td>" +
                        "</tr>" +
                        "<tr>" +
                            "<th>RI</th>" +
                            "<td>" + ri + "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<th>CR</th>" +
                            "<td>" + cr + "</td>" +
                            "<th>" + is_consistent + "</th>" +
                        "</tr>" +
                    "</table>" +
                    "<p style='font-size:12px'>Jika nilai CR <= 0,1 maka matriks tersebut dikatakan konsisten<br>Apabila nilai CR > 0,1 maka matriks tersebut dikatakan tidak konsisten<br>Konsisten adalah kesetaraan nilai bobot yang diberikan antar kriteria-kriteria</p>" +
                "</div>" +
				"<div class='col-5 table-responsive' id='div-nilai-kriteria'></div>"+
                "<div class='col-3'>" +
                    "<table class='table table-bordered border-success tbl-matrix-consistency' style='width:100%'>" +
                        "<thead>" +
                            "<tr>" +
                                "<th>Matrix Size</th>" +
                                "<th>Random Consistency</th>" +
                            "</tr>" +
                        "</thead>" +
                        "<tbody>" +
                            "<tr>" +
                                "<td>1</td>" +
                                "<td>0.00</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>2</td>" +
                                "<td>0.00</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>3</td>" +
                                "<td>0.58</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>4</td>" +
                                "<td>0.90</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>5</td>" +
                                "<td>1.12</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>6</td>" +
                                "<td>1.24</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>7</td>" +
                                "<td>1.32</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>8</td>" +
                                "<td>1.41</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>9</td>" +
                                "<td>1.45</td>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>10</td>" +
                                "<td>1.49</td>" +
                            "</tr>" +
                        "</tbody>" +
                    "</table>" +
				"</div>" +
            "</div>");
		}

		// PROSES SUBKRITERIA
		function prosesSubkriteria(data){
			return new Promise(async (resolve, reject) => {
				let result = []
				for (let val of data) {
					let res = await prosesSubkriteriaAjax(val)
					for (let el of res) {
						result.push(el)
					}
				}

				resolve(result)
			})
		}

		function prosesSubkriteriaAjax(val) {
			return new Promise((resolve, reject) => {
				$.ajax({
					url: "subkriteria/data_subkriteria/"+val.id_kriteria,
					type: "GET",
					dataType: "JSON",
					success: function (response) {
						resolve(dataSubKriteria(response))
					},
					error: function () {
						reject("Gagal, silahkan menghubungi IT");
					}
				})
			})
			
		}

		function dataSubKriteria(data){
			var returned = []
			var kode_kriteria = ""
			var th_subkriteria = ""
			var th_ranking_kriteria = ""
			for (let x of data) {
				kode_kriteria = x.kode_kriteria
				th_ranking_kriteria = x.nama_kriteria
				th_subkriteria += "<th>" + x.kode_sub_kriteria + "</th>"
			}

			var tr_td_subkriteria = ""

			let totals_subkriteria = (new Array(data.length)).fill(0)
			for (let x of data) {
				tr_td_subkriteria += '<tr>'
				tr_td_subkriteria += '<td>' + x.kode_sub_kriteria + '</td>'
				for (let i in data) {
					let y = data[i]
					let val = x.nilai_sub_kriteria / y.nilai_sub_kriteria
					tr_td_subkriteria += '<td>' + val + '</td>'

					totals_subkriteria[i] += parseFloat(val)
				}
				tr_td_subkriteria += '</tr>'
			}

			let tfoot_subkriteria = ''
			for (let x of totals_subkriteria) {
				tfoot_subkriteria += '<th>' + x + '</th>'
			}

			// normalisasi
			var tr_td_subkriteria_normalisasi = ""
			let totals_subkriteria_normalisasi = (new Array(data.length)).fill(0)
			let total_jumlah_subkriteria_normalisasi = 0
			let total_prioritas_subkriteria_normalisasi = 0
			let total_eigen_value_subkriteria_normalisasi = 0
			let banyak_data_subkriteria = 0
			let tr_td_ranking_kriteria = ""

			for (let [index_x, x] of data.entries()) {
				banyak_data_subkriteria = data.length
				tr_td_subkriteria_normalisasi += '<tr>'
				tr_td_subkriteria_normalisasi += '<td>' + x.kode_sub_kriteria + '</td>'

				let jumlah_subkriteria_normalisasi = 0

				tr_td_ranking_kriteria += '<tr>'
				tr_td_ranking_kriteria += '<td>' + x.kode_sub_kriteria + '</td>'
				if ( x.persen == 1 ) {
					if ( x.sub_kriteria_dua != 0 ) {
						tr_td_ranking_kriteria += '<td>' + x.sub_kriteria_satu + ' - ' + x.sub_kriteria_dua + ' %</td>'
					} else {
						tr_td_ranking_kriteria += '<td>' + x.simbol + x.sub_kriteria_satu + ' %</td>'
					}
				} else {
					if ( x.sub_kriteria_dua != 0 ) {
						tr_td_ranking_kriteria += '<td>' + singkat_angka(x.sub_kriteria_satu) + ' - ' + singkat_angka(x.sub_kriteria_dua) + '</td>'
					} else {
						tr_td_ranking_kriteria += '<td>' + x.simbol + singkat_angka(x.sub_kriteria_satu) + '</td>'
					}
				}

				for (let i in data) {
					let y = data[i]

					let val = (x.nilai_sub_kriteria / y.nilai_sub_kriteria) / totals_subkriteria[i]
					tr_td_subkriteria_normalisasi += '<td>' + val + '</td>'

					totals_subkriteria_normalisasi[i] += parseFloat(val)
					jumlah_subkriteria_normalisasi += val
				}

				total_jumlah_subkriteria_normalisasi += jumlah_subkriteria_normalisasi
				prioritas_subkriteria_normalisasi = jumlah_subkriteria_normalisasi / data.length
				total_prioritas_subkriteria_normalisasi += prioritas_subkriteria_normalisasi
				eigen_value_subkriteria = prioritas_subkriteria_normalisasi * totals_subkriteria[index_x]
				total_eigen_value_subkriteria_normalisasi += eigen_value_subkriteria

				tr_td_subkriteria_normalisasi += '<td>' + jumlah_subkriteria_normalisasi + '</td>'
				tr_td_subkriteria_normalisasi += '<td>' + prioritas_subkriteria_normalisasi + '</td>'
				tr_td_subkriteria_normalisasi += '<td>' + eigen_value_subkriteria + '</td>'
				tr_td_subkriteria_normalisasi += '</tr>'

				tr_td_ranking_kriteria += '<td>' + prioritas_subkriteria_normalisasi + '</td>'
				tr_td_ranking_kriteria += '</tr>'

				returned.push({ kode_sub_kriteria:  x.kode_sub_kriteria, nilai: prioritas_subkriteria_normalisasi })
			}
			let tfoot_subkriteria_normalisasi = ''
			for (let x of totals_subkriteria_normalisasi) {
				tfoot_subkriteria_normalisasi += '<th>' + x + '</th>'
			}
			tfoot_subkriteria_normalisasi += '<th>' + total_jumlah_subkriteria_normalisasi + '</th>'
			tfoot_subkriteria_normalisasi += '<th>' + total_prioritas_subkriteria_normalisasi + '</th>'
			tfoot_subkriteria_normalisasi += '<th>' + total_eigen_value_subkriteria_normalisasi + '</th>'

			// konsistensi
			var ci_subkriteria = (total_eigen_value_subkriteria_normalisasi - banyak_data_subkriteria) / banyak_data_subkriteria - 1
			var ri_subkriteria = 0
			if (banyak_data_subkriteria == 1 || banyak_data_subkriteria == 2) {
				ri_subkriteria = 0.00
			} else if (banyak_data_subkriteria == 3) {
				ri_subkriteria = 0.58
			} else if (banyak_data_subkriteria == 4) {
				ri_subkriteria = 0.90
			} else if (banyak_data_subkriteria == 5) {
				ri_subkriteria = 1.12
			} else if (banyak_data_subkriteria == 6) {
				ri_subkriteria = 1.24
			} else if (banyak_data_subkriteria == 7) {
				ri_subkriteria = 1.32
			} else if (banyak_data_subkriteria == 8) {
				ri_subkriteria = 1.41
			} else if (banyak_data_subkriteria == 9) {
				ri_subkriteria = 1.45
			} else if (banyak_data_subkriteria == 10) {
				ri_subkriteria = 1.49
			} else {
				ri_subkriteria = 0
			}
			var cr_subkriteria = ci_subkriteria / ri_subkriteria
			var is_consistent_subkriteria = ""
			if (cr_subkriteria <= 0,1) {
				is_consistent_subkriteria = "KONSISTEN"				
			} else {
				is_consistent_subkriteria = "Tidak Konsisten"
			}
			div_subkriteria += "<div class='col-md-5 mb-2 table-responsive'>" +
				"<h4>Sub Kriteria "+kode_kriteria+"</h4>"+
				"<p>Matriks Perbandingan Antar Kriteria</p>" +
				"<table class='table table-bordered border-success' style='width:100%'>" +
					"<thead>" +
						"<tr>" +
							"<th>Kode</th>" +
							th_subkriteria+
						"</tr>" +
					"</thead>" +
					"<tbody>" +
						tr_td_subkriteria+
						"<tr>" +
							"<th>Total</th>" +
							tfoot_subkriteria+
						"</tr>" +
					"</tbody>" +
				"</table>"+
				"<p>Konsistensi</p>" +
				"<table class='table table-bordered border-success tbl-konsistensi' style='width:100%'>" +
					"<tr>" +
						"<th>CI</th>" +
						"<td>" + ci_subkriteria + "</td>" +
						"<td rowspan='2'></td>" +
					"</tr>" +
					"<tr>" +
						"<th>RI</th>" +
						"<td>" + ri_subkriteria + "</td>" +
					"</tr>" +
					"<tr>" +
						"<th>CR</th>" +
						"<td>" + cr_subkriteria + "</td>" +
						"<th>" + is_consistent_subkriteria + "</th>" +
					"</tr>" +
				"</table>" +
			"</div>"+
			"<div class='col-md-7 mb-2 table-responsive div-range'>"+
				"<p>Normalisasi</p>" +
				"<table class='table table-bordered border-success tbl-normalisasi' style='width:100%'>" +
                    "<thead>" +
                        "<tr>" +
                            "<th>Kode</th>" +
                            th_subkriteria +
                            "<th>Jumlah</th>" +
                            "<th>Prioritas</th>" +
                            "<th>Eigen Value</th>" +
                        "</tr>" +
                    "</thead>" +
                    "<tbody>" +
                        tr_td_subkriteria_normalisasi +
                        "<tr>" +
                            "<th>Total</th>" +
                            tfoot_subkriteria_normalisasi +
                        "</tr>" +
                    "</tbody>" +
				"</table>"+
			"</div><hr>"
			$('#div-proses-subkriteria').html(div_subkriteria);

			// nilai kriteria
			div_ranking += "<div class='col-md-3 mt-4'>"+
				"<table class='table table-bordered border-success tbl-nilai-kriteria' style='width:100%'>" +
					"<tr>" +
						"<th colspan='3' style='text-align:center'>"+th_ranking_kriteria+"</th>" +
					"</tr>" +
					tr_td_ranking_kriteria+				
				"</table>"+
			"</div>"
			$('#div-nilai-semua-kriteria').html(div_ranking);

			return returned
		}

		// PROSES RANKING
		function prosesRankingAwal(data){
			return new Promise((resolve, reject) => {
				resolve(prosesRanking(data))
			})
		}

		function prosesRanking(data){
			var returned = []
			$.ajax({
				url: "saham/dataSaham/",
				type: "GET",
				dataType: "JSON",
				success: function (response) {
					
					var th_alternatif = ""
					var th_hasil_akhir = ""
					for (i = 0; i < data.length; i++) {
						th_alternatif += "<th class='align-middle'>" + data[i].nama_kriteria + "</th>"
					}
					th_hasil_akhir = th_alternatif
					th_hasil_akhir += "<th class='align-middle'>Total</th>"
					th_hasil_akhir += "<th class='align-middle'>Ranking</th>"

					var tr_td_alternatif = ""
					var tr_td_hasil_akhir = ""
					var open_ke_high_final = 0
					mergeWithHasilAkhir(response).then(data => {
						for ( let [index, x] of data.entries() ) {
							tr_td_alternatif += "<tr>"
							tr_td_alternatif += "<td>"+ x.saham +"</td>"
							tr_td_alternatif += "<td>"+ x.open_ke_high +" %</td>"
							tr_td_alternatif += "<td>"+ x.open_ke_low +" %</td>"
							tr_td_alternatif += "<td>"+ x.open_ke_close +" %</td>"
							tr_td_alternatif += "<td>"+ singkat_angka(x.volume) +"</td>"
							tr_td_alternatif += "<td>"+ singkat_angka(x.market_cap) +"</td>"
							tr_td_alternatif += "</tr>"
							
							if ( ranking(hasilRanking)[index] == 1 ) {
								tr_td_hasil_akhir += "<tr class='table-success'>"
							} else {
								tr_td_hasil_akhir += "<tr>"
							}
							tr_td_hasil_akhir += "<td>"+ x.saham +"</td>"
							tr_td_hasil_akhir += "<td>"+ x.kriteria_1 +"</td>" 
							tr_td_hasil_akhir += "<td>"+ x.kriteria_2 +"</td>"
							tr_td_hasil_akhir += "<td>"+ x.kriteria_3 +"</td>"
							tr_td_hasil_akhir += "<td>"+ x.kriteria_4 +"</td>"
							tr_td_hasil_akhir += "<td>"+ x.kriteria_5 +"</td>"
							let total_kriteria = x.kriteria_1 + x.kriteria_2 + x.kriteria_3 + x.kriteria_4 + x.kriteria_5
							tr_td_hasil_akhir += "<td>"+ total_kriteria +"</td>"
							returned.push({ hasil_ranking:  total_kriteria })						
							tr_td_hasil_akhir += "<td>"+ranking(hasilRanking)[index]+"</td>"
							tr_td_hasil_akhir += "</tr>"
						}
						$('#div-ranking').html("<div class='col-md-4 table-responsive pt-3'>"+
							"<h4>Alternatif</h4>"+
							"<table class='table table-bordered border-success tbl-alternatif' style='width:100%'>" +
								"<thead>"+
									"<tr>"+
										"<th></th>"+
										th_alternatif+
									"</tr>"+
								"</thead>"+
								"<tbody>"+
									tr_td_alternatif+
								"</tbody>"+
							"</table>"+
						"</div>"+
						"<div class='col-md-8 div-hasil-akhir pt-3 table-responsive'>"+
							"<h4>Hasil Akhir</h4>"+	
							"<table class='table table-bordered border-success tbl-hasil-akhir' style='width:100%'>" +
								"<thead>"+
									"<tr>"+
										"<th></th>"+
										th_hasil_akhir+
									"</tr>"+
								"</thead>"+
								"<tbody>"+
									tr_td_hasil_akhir+
								"</tbody>"+
							"</table>"+	
						"</div>");
					})
					
				},
				error: function () {
					alert("Gagal, silahkan menghubungi IT");
				}
			})
			return returned
		}

		function mergeWithHasilAkhir(response) {
			let requests = []

			let criterias = [
				['kriteria_1', 1],
				['kriteria_2', 2],
				['kriteria_3', 3],
				['kriteria_4', 4],
				['kriteria_5', 5],
			]

			for (let obj of response) {
				let res = [obj.open_ke_high, obj.open_ke_low, obj.open_ke_close, obj.volume, obj.market_cap]
				requests.push(mergeColumn(obj, criterias, res))
			}

			return Promise.all(requests)
		} 

		async function mergeColumn(obj, criterias, res) {
			for (let [index,c] of criterias.entries()) {
				let columnName = c[0]
				let kriteria_id = c[1]

				obj[columnName] = await dataHasilAkhir(res[index], kriteria_id)	
			}

			return obj
		}

		function dataHasilAkhir(nilai, kriteria_id){
			// x = kui object asli teko database dataSaham
			return new Promise((resolve, reject) => {
				$.ajax({
					url: "subkriteria/data_subkriteria/"+kriteria_id,
					type: "GET",
					dataType: "JSON",
					success: function (response) {
						for (let row of response) {
							if ( !row.simbol && parseInt(nilai) >= parseInt(row.sub_kriteria_satu) && parseInt(nilai) <= parseInt(row.sub_kriteria_dua) ) { // diantara
								return resolve(hitungNilai(row.nama_kriteria, row.kode_sub_kriteria))
							} else if ( row.simbol == '>' && parseInt(nilai) > parseInt(row.sub_kriteria_satu) ) { // lebih dari
								return resolve(hitungNilai(row.nama_kriteria, row.kode_sub_kriteria))
							} else if ( row.simbol == '<' && parseInt(nilai) < parseInt(row.sub_kriteria_satu) ) { // kurang dari
								return resolve(hitungNilai(row.nama_kriteria, row.kode_sub_kriteria))
							}							
						}
						resolve(response[0].kode_sub_kriteria) 
					},
					error: function () {
						reject("Gagal, silahkan menghubungi IT")
					}
				})
			})
		}

		function hitungNilai(kriteria, kode) {
			let pengali = ambilNilai(tblPerhitungan, kode)
			let kriteria_awal = ambilKriteria(tblKriteriaPertama, kriteria)
			return kriteria_awal * pengali
		}

		function ambilNilai(sumberData, kode) {
			let found = sumberData.find(r => r.kode_sub_kriteria == kode)

			if ( ! found) {
				return 0 // ganti default value e (tpi kyo e gamungkin nek sampek not found)
			}

			return found.nilai
		}

		function ambilKriteria(sumberData, nama) {
			let found = sumberData.find(r => r.nama_kriteria == nama)

			if ( ! found) {
				return 0 // ganti default value e (tpi kyo e gamungkin nek sampek not found)
			}

			return found.nilai
		}

		function ranking(data) {
			let result = []
			for ( let x of data ) {
				result.push(x.hasil_ranking)
			}
			var sorted = result.slice().sort(function(a,b){return b-a})
			var ranks = result.map(function(v){ return sorted.indexOf(v)+1 });
			return ranks
		}
	</script>
</body>

</html>