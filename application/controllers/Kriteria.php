<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Kriteria_model");
	}

	public function data()
	{
		$fetch_data = $this->Kriteria_model->make_datatables();
		$data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $row->kode_kriteria;  
                $sub_array[] = $row->nama_kriteria;  
                $sub_array[] = $row->nilai_kriteria;
				$sub_array[] = '<a href="javascript:void(0)" onclick="editKriteria('.$row->id_kriteria.')" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="javascript:void(0)" onclick="hapusKriteria('.$row->id_kriteria.')" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw" => intval($_POST["draw"]),  
                "recordsTotal" => $this->Kriteria_model->get_all_data(),  
                "recordsFiltered" => $this->Kriteria_model->get_filtered_data(),  
                "data" => $data  
           );  
           echo json_encode($output);  

	}

	public function simpan()
	{
		$kode_kriteria = $this->input->post('kode_kriteria');
		$nama_kriteria = $this->input->post('nama_kriteria');
		$nilai_kriteria = $this->input->post('nilai_kriteria');

		$data = array(
			'kode_kriteria' => $kode_kriteria,
			'nama_kriteria' => $nama_kriteria,
			'nilai_kriteria' => $nilai_kriteria
        );

        $this->Kriteria_model->simpan($data,'kriteria');

        $response_array['status'] = 'success';
		echo json_encode($response_array);
    }

	public function edit($id)
	{
		$where = array('id_kriteria' => $id);
		$kriteria = $this->Kriteria_model->edit($where,'kriteria')->result();
		foreach ( $kriteria as $row ) {
			$id_kriteria = $row->id_kriteria;
			$kode_kriteria = $row->kode_kriteria;
			$nama_kriteria = $row->nama_kriteria;
			$nilai_kriteria = $row->nilai_kriteria;
		}
		header('Content-Type: application/json');
		$result = array("id_kriteria" => $id_kriteria, "kode_kriteria" => $kode_kriteria, "nama_kriteria" => $nama_kriteria, "nilai_kriteria" => $nilai_kriteria);
		echo json_encode($result);
	}

	public function perbarui()
	{
		$id = $this->input->post('edit_id_kriteria');
		$kode_kriteria = $this->input->post('edit_kode_kriteria');
		$nama_kriteria = $this->input->post('edit_nama_kriteria');
		$nilai_kriteria = $this->input->post('edit_nilai_kriteria');

		$data = array(
			'kode_kriteria' => $kode_kriteria,
			'nama_kriteria' => $nama_kriteria,
			'nilai_kriteria' => $nilai_kriteria
		);
		

		$where = array(
			'id_kriteria' => $id
		);
		
		$this->Kriteria_model->perbarui($where,$data,'kriteria');
		$response_array['status'] = 'success';
		header('Content-Type: application/json');
		echo json_encode($response_array);
	}

	public function hapus($id)
	{	
		$check = $this->Kriteria_model->cekSubkriteria($id)->result();
		if ( count($check) > 0 ) {
			// ada subtotal, gabisa dihapus slur
			$response_array['status'] = 'error';
		} else {
			$where = array('id_kriteria' => $id);
			$this->Kriteria_model->hapus($where,'kriteria');
			$response_array['status'] = 'success';
		}
		echo json_encode($response_array);
	}

	public function proses()
	{
		$data_kriteria = $this->Kriteria_model->data()->result();
		echo json_encode($data_kriteria);
	}

}
