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
    <!-- Modal -->
    
    <!-- KRITERIA -->
    <!-- simpan kriteria -->
    <div class="modal fade" id="tambahKriteriaModal" tabindex="-1" aria-labelledby="tambahKriteriaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKriteriaModalLabel">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form class="form-horizontal" id="simpanKriteria">
                    <div class="modal-body">
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <p>Kode</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kode_kriteria" required>
                            </div>
                        </div>
                        <div class="row mb-1">
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
        <div class="modal-dialog">
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
                            <div class="col-md-3">
                                <p>Kode</p>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="edit_kode_kriteria" id="kode_kriteria" required>
                            </div>
                        </div>
                        <div class="row mb-1">
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
	</script>
</body>

</html>