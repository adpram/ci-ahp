<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subkriteria extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Subkriteria_model");
	}

	public function data_kriteria(){
		// Search term
		$searchTerm = $this->input->post('searchTerm');
		// ambil kriteria
		$response = $this->Subkriteria_model->dataKriteria($searchTerm);
		echo json_encode($response);
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

	public function data()
	{
		$fetch_data = $this->Subkriteria_model->make_datatables();
		$data = array();  
           foreach($fetch_data as $row)  
           {  
			   	if ( $row->persen == 1 ) {
					if ( $row->sub_kriteria_dua ) {
						$keterangan = $row->sub_kriteria_satu . " - " . $row->sub_kriteria_dua . " %";
					} else {
						$keterangan = $row->simbol . $row->sub_kriteria_satu . " %";
					}
				} else {
					if ( $row->sub_kriteria_dua ) {
						$keterangan = $this->singkat_angka($row->sub_kriteria_satu) . " - " . $this->singkat_angka($row->sub_kriteria_dua);
					} else {
						$keterangan = $row->simbol . $this->singkat_angka($row->sub_kriteria_satu);
					}
				}
                $sub_array = array();  
                $sub_array[] = $row->kode_kriteria;  
                $sub_array[] = $row->kode_sub_kriteria;  
                $sub_array[] = $keterangan;  
                $sub_array[] = $row->nilai_sub_kriteria;
				$sub_array[] = '<a href="javascript:void(0)" onclick="editSubKriteria('.$row->id_sub_kriteria.')" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="javascript:void(0)" onclick="hapusSubKriteria('.$row->id_sub_kriteria.')" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw" => intval($_POST["draw"]),  
                "recordsTotal" => $this->Subkriteria_model->get_all_data(),  
                "recordsFiltered" => $this->Subkriteria_model->get_filtered_data(),  
                "data" => $data  
           );  
           echo json_encode($output);  

	}

	public function simpan()
	{
		$kriteria_id = $this->input->post('kriteria_id');
		$kode_sub_kriteria = $this->input->post('kode_sub_kriteria');
		$simbol = $this->input->post('simbol');
		$sub_kriteria_satu = str_replace(",", "", $this->input->post('sub_kriteria_satu'));
		$sub_kriteria_dua = str_replace(",", "", $this->input->post('sub_kriteria_dua'));
		$persen = $this->input->post('persen');
		$nilai_sub_kriteria = $this->input->post('nilai_sub_kriteria');

		$data = array(
			'kriteria_id' => $kriteria_id,
			'kode_sub_kriteria' => $kode_sub_kriteria,
			'simbol' => $simbol,
			'sub_kriteria_satu' => $sub_kriteria_satu,
			'sub_kriteria_dua' => $sub_kriteria_dua,
			'persen' => $persen,
			'nilai_sub_kriteria' => $nilai_sub_kriteria
        );

        $this->Subkriteria_model->simpan($data,'subkriteria');

        $response_array['status'] = 'success';
		echo json_encode($response_array);
    }

	public function edit($id)
	{
		$where = array('id_sub_kriteria' => $id);
		$subkriteria = $this->Subkriteria_model->edit($where,'subkriteria')->result();
		foreach ( $subkriteria as $row ) {
			$id_sub_kriteria = $row->id_sub_kriteria;
			$kriteria_id = $row->kriteria_id;
			$nama_kriteria = $row->nama_kriteria;
			$kode_kriteria = $row->kode_kriteria;
			$kode_sub_kriteria = $row->kode_sub_kriteria;
			$simbol = $row->simbol;
			$sub_kriteria_satu = $row->sub_kriteria_satu;
			$sub_kriteria_dua = $row->sub_kriteria_dua;
			$persen = $row->persen;
			$nilai_sub_kriteria = $row->nilai_sub_kriteria;
		}
		header('Content-Type: application/json');
		$result = array("id_sub_kriteria" => $id_sub_kriteria, "kriteria_id" => $kriteria_id, "nama_kriteria" => $nama_kriteria, "kode_kriteria" => $kode_kriteria, "kode_sub_kriteria" => $kode_sub_kriteria, "simbol" => $simbol, "sub_kriteria_satu" => $sub_kriteria_satu, "sub_kriteria_dua" => $sub_kriteria_dua, "persen" => $persen, "nilai_sub_kriteria" => $nilai_sub_kriteria);
		echo json_encode($result);
	}

	public function perbarui()
	{
		$id = $this->input->post('edit_id_sub_kriteria');
		$kriteria_id = $this->input->post('edit_kriteria_id');
		$kode_sub_kriteria = $this->input->post('edit_kode_sub_kriteria');
		$simbol = $this->input->post('edit_simbol');
		$sub_kriteria_satu = str_replace(",", "", $this->input->post('edit_sub_kriteria_satu'));
		$sub_kriteria_dua = str_replace(",", "", $this->input->post('edit_sub_kriteria_dua'));
		$persen = $this->input->post('edit_persen');
		$nilai_sub_kriteria = $this->input->post('edit_nilai_sub_kriteria');

		$data = array(
			'kriteria_id' => $kriteria_id,
			'kode_sub_kriteria' => $kode_sub_kriteria,
			'simbol' => $simbol,
			'sub_kriteria_satu' => $sub_kriteria_satu,
			'sub_kriteria_dua' => $sub_kriteria_dua,
			'persen' => $persen,
			'nilai_sub_kriteria' => $nilai_sub_kriteria
		);
		

		$where = array(
			'id_sub_kriteria' => $id
		);
		
		$this->Subkriteria_model->perbarui($where,$data,'subkriteria');
		$response_array['status'] = 'success';
		header('Content-Type: application/json');
		echo json_encode($response_array);
	}
	

	public function hapus($id)
	{	
		$where = array('id_sub_kriteria' => $id);
		$this->Subkriteria_model->hapus($where,'subkriteria');
		$response_array['status'] = 'success';
		echo json_encode($response_array);
	}

	public function data_subkriteria($id)
	{
		// $result = $this->Subkriteria_model->data()->result();
		$where = array('kriteria_id' => $id);
		$result = $this->Subkriteria_model->edit($where,'subkriteria')->result();
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
