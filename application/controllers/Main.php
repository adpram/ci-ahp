<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Saham_model');
		$this->load->model('Kriteria_model');
		$this->load->model('Subkriteria_model');
	}

	function singkat_angka($n, $presisi=2) {
        if ($n < 900) {
            $format_angka = number_format($n, $presisi);
            $simbol = '';
        } else if ($n < 900000) {
            $format_angka = number_format($n / 1000, $presisi);
            $simbol = 'rb';
        } else if ($n < 900000000) {
            $format_angka = number_format($n / 1000000, $presisi);
            $simbol = 'jt';
        } else if ($n < 900000000000) {
            $format_angka = number_format($n / 1000000000, $presisi);
            $simbol = 'M';
        } else {
            $format_angka = number_format($n / 1000000000000, $presisi);
            $simbol = 'T';
        }
    
        if ( $presisi > 0 ) {
            $pisah = '.' . str_repeat( '0', $presisi );
            $format_angka = str_replace( $pisah, '', $format_angka );
        }
        
        return $format_angka . $simbol;
    }

	public function index()
	{
		// saham
		$data['saham'] = $this->Saham_model->dataMain();

		// kriteria
		$data['kriteria'] = $this->Kriteria_model->dataMain();

		// sub kriteria
		$data['subkriteria'] = $this->Subkriteria_model->dataMain();
		$data['function'] = $this;
		$this->load->view('main', $data);
	}
}
