<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/dataTable/css/jquery.dataTables.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?= base_url('assets/admin/vendors/feather/feather.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/vendors/mdi/css/materialdesignicons.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/vendors/ti-icons/css/themify-icons.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/vendors/typicons/typicons.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/vendors/simple-line-icons/css/simple-line-icons.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/vendors/css/vendor.bundle.base.css') ?>">
	<!-- endinject -->
	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/admin/vendors/select2/select2.min.css') ?>">
	<link rel="stylesheet"
		href="<?= base_url('assets/admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') ?>">
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url('assets/admin/css/vertical-layout-light/style.css') ?>">
	<!-- endinject -->
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
	<div class="container-scroller">
		<!-- partial:../../partials/_navbar.html -->
		<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
				<div class="me-3">
					<button class="navbar-toggler navbar-toggler align-self-center" type="button"
						data-bs-toggle="minimize">
						<span class="icon-menu"></span>
					</button>
				</div>
				<div>
					<a class="navbar-brand brand-logo" href="<?= base_url('main') ?>">
						<img src="<?= base_url('assets/admin/images/admin-logo.png') ?>" alt="SPK Saham AHP" />
					</a>
					<a class="navbar-brand brand-logo-mini" href="<?= base_url('main') ?>">
						<img src="<?= base_url('assets/admin/images/admin-logo.png') ?>" alt="SPK Saham AHP" />
					</a>
				</div>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-top">
				<ul class="navbar-nav">
					<li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
						<h1 class="welcome-text">Halo, <span class="text-black fw-bold"><?= $user ?></span></h1>
					</li>
				</ul>
				<ul class="navbar-nav ms-auto">
					<li class="nav-item dropdown d-none d-lg-block user-dropdown">
						<a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
							<img class="img-xs rounded-circle" src="<?= base_url('assets/admin/images/user.jpg') ?>"
								alt="Profile image">
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
							<a class="dropdown-item" href="<?= base_url('login/logout') ?>"><i
									class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
						</div>
					</li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
					data-bs-toggle="offcanvas">
					<span class="mdi mdi-menu"></span>
				</button>
			</div>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
							aria-controls="form-elements">
							<i class="menu-icon  mdi mdi-archive"></i>
							<span class="menu-title">Data</span>
						</a>
						<div class="collapse" id="form-elements">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"><a class="nav-link" href="<?= base_url('admin/saham') ?>">Saham</a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('admin/kriteria') ?>">Kriteria</a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('admin/subkriteria') ?>">Sub Kriteria</a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('admin/proses') ?>">
							<i class="mdi mdi-sync menu-icon"></i>
							<span class="menu-title">Proses</span>
						</a>
					</li>
				</ul>
			</nav>