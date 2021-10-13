<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AHP Saham</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css"/>
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
    <style>
        .tbl-info-nilai-kriteria{
            font-size: 12px !important
        }

        .tbl-normalisasi{
            font-size: 14px !important
        }

        .tbl-matrix-consistency{
            font-size: 12px !important
        }
    </style>
</head>

<body>
    <div class="row m-2">
        <div class="col-6">
            <h4>Kriteria</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#tambahKriteriaModal">
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
        <div class="col-6">
            <h4>Alternatif</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#tambahAlternatifModal">
                tambah alternatif
            </button>

            <table class="table table-striped table-bordered nowrap" id="tbl-alternatif" style="width:100%">
                <thead>
                    <th style="width:15%">Kode</th>
                    <th>Nama</th>
                    <th style="width:15%">Aksi</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center">
            <h3>Matriks Perbandingan Antar Kriteria</h3>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <a href="javascript:void(0)" onclick="prosesKriteria()" class="btn btn-sm btn-outline-success"><i class="fa fa-refresh" aria-hidden="true"></i> proses</a>
        </div>
        <div class="col-12 d-flex justify-content-center mt-2" id="div-proses-kriteria"></div>
        <div class="col-12 d-flex justify-content-center mt-2" id="div-proses-matriks-normalisasi"></div>
        <div class="col-12 d-flex justify-content-center mt-2" id="div-proses-matriks-konsistensi"></div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                                        <textarea class="form-control" name="nama_kriteria" cols="10" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Nilai</p>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="number" min="1" max="9" class="form-control" name="nilai_kriteria" required>
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
                                                <td>Jika elemen i memiliki salah satu angka di atas dibandingkan elemen j, maka j memiliki nilai kebaikannya ketika dibanding dengan i</td>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                                        <input type="text" class="form-control" name="edit_kode_kriteria" id="kode_kriteria" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Nama</p>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="edit_nama_kriteria" id="nama_kriteria" cols="10" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>Nilai</p>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="number" min="1" max="9" class="form-control" name="edit_nilai_kriteria" id="nilai_kriteria" required>
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
                                                <td>Jika elemen i memiliki salah satu angka di atas dibandingkan elemen j, maka j memiliki nilai kebaikannya ketika dibanding dengan i</td>
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

    <!-- ALTERNATIF -->
    <!-- simpan alternatif -->
    <div class="modal fade" id="tambahAlternatifModal" tabindex="-1" aria-labelledby="tambahAlternatifModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAlternatifModalLabel">Tambah Alternatif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form class="form-horizontal" id="simpanAlternatif">
                    <div class="modal-body">
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <p>Kode</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kode_alternatif" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <p>Nama</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama_alternatif" required>
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
    <!-- ubah alternatif -->
    <div class="modal fade" id="ubahAlternatifModal" tabindex="-1" aria-labelledby="ubahAlternatifModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahAlternatifModalLabel">Ubah Alternatif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form class="form-horizontal" id="perbaruiAlternatif">
                    <div class="modal-body">
					    <input type="hidden" name="edit_id_alternatif" id="id_alternatif">
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <p>Kode</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="edit_kode_alternatif" id="kode_alternatif" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <p>Nama</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="edit_nama_alternatif" id="nama_alternatif" required>
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
        var table_kriteria = $('#tbl-kriteria').DataTable({
            "responsive" : true,
            "serverSide": true,  
            "order":[],  
            "ajax":{  
                url : "<?= site_url('kriteria/data') ?>",
                type:"POST"  
            },  
        });

        var table_alternatif = $('#tbl-alternatif').DataTable({
            "responsive" : true,
            "serverSide": true,  
            "order":[],  
            "ajax":{  
                url : "<?= site_url('alternatif/data') ?>",
                type:"POST"  
            },  
        });

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
                                console.log(data.status)
                                swal("Kriteria berhasil dihapus", {
                                    icon: "success",
                                }).then(function () {
                                    $('#tbl-kriteria').DataTable().ajax.reload();
                                });
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

        // ALTERNATIF
        $('#simpanAlternatif').on('submit', function (e) {
			if (!e.isDefaultPrevented()) {

				$.ajax({
					url: "<?= site_url('alternatif/simpan') ?>",
					type: "POST",
					beforeSend: function () {
						swal({
							title: 'Tunggu',
							text: 'Memproses data...',
                            buttons: false
						})
					},
					data: $('#simpanAlternatif').serialize(),
					dataType: "json",
					success: function (data) {
						swal({
							title: 'Berhasil!',
							text: 'Alternatif berhasil ditambahkan!',
							icon: 'success'
						}).then(function () {
							$('#tambahAlternatifModal').modal('hide');
                            $('#tambahAlternatifModal form')[0].reset();
                            //datatable refresh
                            $('#tbl-alternatif').DataTable().ajax.reload();
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

        function editAlternatif(id) {
            $.ajax({
                url: "alternatif/edit/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#ubahAlternatifModal').modal('show');
				    $("#id_alternatif").val(data.id_alternatif);
                    $("#kode_alternatif").val(data.kode_alternatif);
                    $("#nama_alternatif").val(data.nama_alternatif);
                    $("#nilai_alternatif").val(data.nilai_alternatif);
                },
                error: function () {
                    alert("Gagal, silahkan menghubungi IT");
                }
            })
        }

        $('#perbaruiAlternatif').on('submit', function (e) {
			if (!e.isDefaultPrevented()) {

				$.ajax({
					url: "<?= site_url('alternatif/perbarui') ?>",
					type: "POST",
					beforeSend: function () {
						swal({
							title: 'Tunggu',
							text: 'Memproses data...',
                            buttons: false
						})
					},
					data: $('#perbaruiAlternatif').serialize(),
                    dataType: "json",
					success: function (data) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Alternatif berhasil diperbarui!',
                            icon: 'success'
                        }).then(function () {
                            $('#ubahAlternatifModal').modal('hide');
                            $('#ubahAlternatifModal form')[0].reset();
                            $('#tbl-alternatif').DataTable().ajax.reload();
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

        function hapusAlternatif(id) {
            swal({
                title: "Apakah anda yakin ?",
                text: "Alternatif akan dihapus",
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
                        swal("Alternatif aman");
                        break;
                    case 'delete':
                        $.ajax({
                            url: "alternatif/hapus/" + id,
                            dataType: "json",
                            type: "POST",
                            success: function (data) {
                                console.log(data.status)
                                swal("Alternatif berhasil dihapus", {
                                    icon: "success",
                                }).then(function () {
                                    $('#tbl-alternatif').DataTable().ajax.reload();
                                });
                            },
                            error: function () {
                                swal({
                                    text: 'Alternatif gagal dihapus!',
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
                    matriksNormalisasiKriteria(data)
                },
                error: function () {
                    alert("Gagal, silahkan menghubungi IT");
                }
            })
        }

        function matriksPerbandinganKriteria(data){

            var th = ""
            for(i=0;i<data.length;i++){
                th += "<th>"+data[i].kode_kriteria+"</th>"
            }

            var tr_td = ""
            
            let totals = (new Array(data.length)).fill(0)
            for (let x of data) {
                tr_td += '<tr>'
                tr_td += '<td>'+x.kode_kriteria+'</td>'
                for (let i in data) {
                    let y = data[i]
                    let val = x.nilai_kriteria / y.nilai_kriteria
                    tr_td += '<td>'+val+'</td>'

                    totals[i] += parseFloat(val)
                }
                tr_td += '</tr>'
            }

            let tfoot = ''
            for (let x of totals) {
                tfoot += '<th>'+x+'</th>'
            }

            $('#div-proses-kriteria').html("<div>"+
                "<table class='table table-bordered border-success' style='width:100%'>"+
                    "<thead>"+
                        "<tr>"+
                            "<th>Kode</th>"+
                            th+
                        "</tr>"+
                    "</thead>"+
                    "<tbody>"+
                        tr_td+
                        "<tr>"+
                            "<th>Total</th>"+
                            tfoot+
                        "</tr>"+
                    "</tbody>"+
                "</table>"+
            "</div>");
        }

        function matriksNormalisasiKriteria(data){

            var th = ""
            for(i=0;i<data.length;i++){
                th += "<th>"+data[i].kode_kriteria+"</th>"
            }

            // matriks perbandingan
            var tr_td = ""
            
            let totals = (new Array(data.length)).fill(0)
            for (let x of data) {
                tr_td += '<tr>'
                tr_td += '<td>'+x.kode_kriteria+'</td>'
                for (let i in data) {
                    let y = data[i]
                    let val = x.nilai_kriteria / y.nilai_kriteria
                    tr_td += '<td>'+val+'</td>'

                    totals[i] += parseFloat(val)
                }
                tr_td += '</tr>'
            }

            let tfoot = ''
            for (let x of totals) {
                tfoot += '<th>'+x+'</th>'
            }

            // normalisasi
            var tr_td_normalisasi = ""

            let totals_normalisasi = (new Array(data.length)).fill(0)
            let total_jumlah_normalisasi = 0
            let total_prioritas_normalisasi = 0
            let total_eigen_value_normalisasi = 0
            let banyak_data = 0
            for (let [index_x, x] of data.entries()) {
                banyak_data = data.length
                tr_td_normalisasi += '<tr>'
                tr_td_normalisasi += '<td>'+x.kode_kriteria+'</td>'
                let jumlah_normalisasi = 0
                for (let i in data) {
                    let y = data[i]

                    let val = (x.nilai_kriteria / y.nilai_kriteria)/totals[i]
                    tr_td_normalisasi += '<td>'+val+'</td>'

                    totals_normalisasi[i] += parseFloat(val)
                    jumlah_normalisasi += val
                }
                
                total_jumlah_normalisasi += jumlah_normalisasi
                prioritas_normalisasi = jumlah_normalisasi/data.length
                total_prioritas_normalisasi += prioritas_normalisasi
                eigen_value = prioritas_normalisasi*totals[index_x]
                total_eigen_value_normalisasi += eigen_value

                tr_td_normalisasi += '<td>'+jumlah_normalisasi+'</td>'
                tr_td_normalisasi += '<td>'+prioritas_normalisasi+'</td>'
                tr_td_normalisasi += '<td>'+eigen_value+'</td>'
                tr_td_normalisasi += '</tr>'
            }
            let tfoot_normalisasi = ''
            for (let x of totals_normalisasi) {
                tfoot_normalisasi += '<th>'+x+'</th>'
            }
            tfoot_normalisasi += '<th>'+total_jumlah_normalisasi+'</th>'
            tfoot_normalisasi += '<th>'+total_prioritas_normalisasi+'</th>'
            tfoot_normalisasi += '<th>'+total_eigen_value_normalisasi+'</th>'
            matriksKonsistensiKriteria(banyak_data, total_eigen_value_normalisasi)

            $('#div-proses-matriks-normalisasi').html("<div>"+
                "<p>Normalisasi</p>"+
                "<table class='table table-bordered border-success tbl-normalisasi' style='width:100%'>"+
                    "<thead>"+
                        "<tr>"+
                            "<th>Kode</th>"+
                            th+
                            "<th>Jumlah</th>"+
                            "<th>Prioritas</th>"+
                            "<th>Eigen Value</th>"+
                        "</tr>"+
                    "</thead>"+
                    "<tbody>"+
                        tr_td_normalisasi+
                        "<tr>"+
                            "<th>Total</th>"+
                            tfoot_normalisasi+
                        "</tr>"+
                    "</tbody>"+
                "</table>"+
            "</div>");
        }

        function matriksKonsistensiKriteria(banyak_data, total_eigen_value_normalisasi){
            console.log(banyak_data, total_eigen_value_normalisasi)
            var ci = (total_eigen_value_normalisasi-banyak_data)/banyak_data-1
            var ri = 0
            if (banyak_data == 1 || banyak_data == 2){
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
            var cr = ci/ri
            var is_consistent = ""
            if (cr <= 0,1) {
                is_consistent = "KONSISTEN"
            } else {
                is_consistent = "Tidak Konsisten"
            }
            $('#div-proses-matriks-konsistensi').html("<div class='row'>"+
                "<p>Konsistensi</p>"+
                "<div class='col-6'>"+
                    "<table class='table table-bordered border-success' style='width:100%'>"+
                        "<tr>"+
                            "<th>CI</th>"+
                            "<td>"+ci+"</td>"+
                            "<td rowspan='2'></td>"+
                        "</tr>"+
                        "<tr>"+
                            "<th>RI</th>"+
                            "<td>"+ri+"</td>"+
                        "</tr>"+
                        "<tr>"+
                            "<th>CR</th>"+
                            "<td>"+cr+"</td>"+                            
                            "<th>"+is_consistent+"</th>"+
                        "</tr>"+
                    "</table>"+
                    "<p style='font-size:12px'>Jika nilai CR <= 0,1 maka matriks tersebut dikatakan konsisten<br>Apabila nilai CR > 0,1 maka matriks tersebut dikatakan tidak konsisten<br>Konsisten adalah kesetaraan nilai bobot yang diberikan antar kriteria-kriteria</p>"+
                "</div>"+
                "<div class='col-6'>"+
                    "<table class='table table-bordered border-success tbl-matrix-consistency' style='width:100%'>"+
                        "<thead>"+
                            "<tr>"+
                                "<th>Matrix Size</th>"+
                                "<th>Random Consistency</th>"+
                            "</tr>"+
                        "</thead>"+
                        "<tbody>"+
                            "<tr>"+
                                "<td>1</td>"+
                                "<td>0.00</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>2</td>"+
                                "<td>0.00</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>3</td>"+
                                "<td>0.58</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>4</td>"+
                                "<td>0.90</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>5</td>"+
                                "<td>1.12</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>6</td>"+
                                "<td>1.24</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>7</td>"+
                                "<td>1.32</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>8</td>"+
                                "<td>1.41</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>9</td>"+
                                "<td>1.45</td>"+
                            "</tr>"+
                            "<tr>"+
                                "<td>10</td>"+
                                "<td>1.49</td>"+
                            "</tr>"+
                        "</tbody>"+
                    "</table>"+
                "</div>"+
            "</div>");
        }
	</script>
</body>
</html>