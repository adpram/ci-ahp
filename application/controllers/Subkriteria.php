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

	public function data()
	{
		$fetch_data = $this->Subkriteria_model->make_datatables();
		$data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $row->kode_kriteria;  
                $sub_array[] = $row->kode_sub_kriteria;  
                $sub_array[] = $row->nama_sub_kriteria;  
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
		$nama_sub_kriteria = $this->input->post('nama_sub_kriteria');
		$nilai_sub_kriteria = $this->input->post('nilai_sub_kriteria');

		$data = array(
			'kriteria_id' => $kriteria_id,
			'kode_sub_kriteria' => $kode_sub_kriteria,
			'nama_sub_kriteria' => $nama_sub_kriteria,
			'nilai_sub_kriteria' => $nilai_sub_kriteria
        );

        $this->Subkriteria_model->simpan($data,'subkriteria');

        $response_array['status'] = 'success';
		echo json_encode($response_array);
    }

	

	public function hapus($id)
	{	
		$where = array('id_sub_kriteria' => $id);
		$this->Subkriteria_model->hapus($where,'subkriteria');
		$response_array['status'] = 'success';
		echo json_encode($response_array);
	}

}
