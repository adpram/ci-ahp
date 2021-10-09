<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Alternatif_model");
	}

	public function data()
	{
		$fetch_data = $this->Alternatif_model->make_datatables();
		$data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $row->kode_alternatif;  
                $sub_array[] = $row->nama_alternatif;  
				$sub_array[] = '<a href="javascript:void(0)" onclick="editAlternatif('.$row->id_alternatif.')" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="javascript:void(0)" onclick="hapusAlternatif('.$row->id_alternatif.')" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw" => intval($_POST["draw"]),  
                "recordsTotal" => $this->Alternatif_model->get_all_data(),  
                "recordsFiltered" => $this->Alternatif_model->get_filtered_data(),  
                "data" => $data  
           );  
           echo json_encode($output);  

	}

	public function simpan()
	{
		$kode_alternatif = $this->input->post('kode_alternatif');
		$nama_alternatif = $this->input->post('nama_alternatif');

		$data = array(
			'kode_alternatif' => $kode_alternatif,
			'nama_alternatif' => $nama_alternatif
        );

        $this->Alternatif_model->simpan($data,'alternatif');

        $response_array['status'] = 'success';
		echo json_encode($response_array);
    }

	public function edit($id)
	{
		$where = array('id_alternatif' => $id);
		$alternatif = $this->Alternatif_model->edit($where,'alternatif')->result();
		foreach ( $alternatif as $row ) {
			$id_alternatif = $row->id_alternatif;
			$kode_alternatif = $row->kode_alternatif;
			$nama_alternatif = $row->nama_alternatif;
		}
		header('Content-Type: application/json');
		$result = array("id_alternatif" => $id_alternatif, "kode_alternatif" => $kode_alternatif, "nama_alternatif" => $nama_alternatif);
		echo json_encode($result);
	}

	public function perbarui()
	{
		$id = $this->input->post('edit_id_alternatif');
		$kode_alternatif = $this->input->post('edit_kode_alternatif');
		$nama_alternatif = $this->input->post('edit_nama_alternatif');

		$data = array(
			'kode_alternatif' => $kode_alternatif,
			'nama_alternatif' => $nama_alternatif,
		);
		

		$where = array(
			'id_alternatif' => $id
		);
		
		$this->Alternatif_model->perbarui($where,$data,'alternatif');
		$response_array['status'] = 'success';
		header('Content-Type: application/json');
		echo json_encode($response_array);
	}

	public function hapus($id)
	{	
		$where = array('id_alternatif' => $id);
		$this->Alternatif_model->hapus($where,'alternatif');
		$response_array['status'] = 'success';
		echo json_encode($response_array);
	}

}
