<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saham extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Saham_model");
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
		$fetch_data = $this->Saham_model->make_datatables();
		$data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $row->kode_saham;  
                $sub_array[] = $row->saham;  
                $sub_array[] = date("d-m-Y", strtotime($row->tanggal));  
                $sub_array[] = $row->open;  
                $sub_array[] = $row->high;
                $sub_array[] = $row->low;
                $sub_array[] = $row->close;
                $sub_array[] = $row->open_ke_high." %";
                $sub_array[] = $row->open_ke_low." %";
                $sub_array[] = $row->open_ke_close." %";
                $sub_array[] = $this->singkat_angka($row->volume);
                $sub_array[] = $this->singkat_angka($row->market_cap);
				$sub_array[] = '<a href="javascript:void(0)" onclick="editSaham('.$row->id_saham.')" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="javascript:void(0)" onclick="hapusSaham('.$row->id_saham.')" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw" => intval($_POST["draw"]),  
                "recordsTotal" => $this->Saham_model->get_all_data(),  
                "recordsFiltered" => $this->Saham_model->get_filtered_data(),  
                "data" => $data  
           );  
           echo json_encode($output);  

	}

	public function simpan()
	{
		$saham = $this->input->post('saham');
		$kode_saham = $this->input->post('kode_saham');
		$tanggal_saham = $this->input->post('tanggal_saham');
		$open = $this->input->post('open');
		$high = $this->input->post('high');
		$low = $this->input->post('low');
		$close = $this->input->post('close');
		$volume = str_replace(",", "", $this->input->post('volume'));
		$market_cap = str_replace(",", "", $this->input->post('market_cap'));
        $open_ke_high = ($high-$open)/$high*100;
        $open_ke_low = ($low-$open)/$low*100;
        $open_ke_close = ($close-$open)/$close*100;

		$data = array(
			'saham' => $saham,
			'kode_saham' => $kode_saham,
			'tanggal' => $tanggal_saham,
			'open' => $open,
			'high' => $high,
			'low' => $low,
			'close' => $close,
			'volume' => $volume,
			'market_cap' => $market_cap,
			'open_ke_high' => $open_ke_high,
			'open_ke_low' => $open_ke_low,
			'open_ke_close' => $open_ke_close
        );

        $this->Saham_model->simpan($data,'saham');

        $response_array['status'] = 'success';
		echo json_encode($response_array);
    }

    public function edit($id)
	{
		$where = array('id_saham' => $id);
		$saham = $this->Saham_model->edit($where,'saham')->result();
		foreach ( $saham as $row ) {
			$id_saham = $row->id_saham;
			$kode_saham = $row->kode_saham;
			$saham = $row->saham;
			$tanggal = $row->tanggal;
			$open = $row->open;
			$high = $row->high;
			$low = $row->low;
			$close = $row->close;
			$volume = $row->volume;
			$market_cap = $row->market_cap;
		}
		header('Content-Type: application/json');
		$result = array("id_saham" => $id_saham, "kode_saham" => $kode_saham, "saham" => $saham, "tanggal" => $tanggal, "open" => $open, "high" => $high, "low" => $low, "close" => $close, "volume" => $volume, "market_cap" => $market_cap);
		echo json_encode($result);
	}

    public function perbarui()
	{
		$id = $this->input->post('edit_id_saham');
		$kode_saham = $this->input->post('edit_kode_saham');
		$saham = $this->input->post('edit_saham');
		$tanggal = $this->input->post('edit_tanggal_saham');
		$open = $this->input->post('edit_open');
		$high = $this->input->post('edit_high');
		$low = $this->input->post('edit_low');
		$close = $this->input->post('edit_close');
		$volume = str_replace(",", "", $this->input->post('edit_volume'));
		$market_cap = str_replace(",", "", $this->input->post('edit_market_cap'));
        $open_ke_high = ($high-$open)/$high*100;
        $open_ke_low = ($low-$open)/$low*100;
        $open_ke_close = ($close-$open)/$close*100;

		$data = array(
			'kode_saham' => $kode_saham,
			'saham' => $saham,
			'tanggal' => $tanggal,
			'open' => $open,
			'high' => $high,
			'low' => $low,
			'close' => $close,
			'volume' => $volume,
			'market_cap' => $market_cap,
			'open_ke_high' => $open_ke_high,
			'open_ke_low' => $open_ke_low,
			'open_ke_close' => $open_ke_close
		);
		

		$where = array(
			'id_saham' => $id
		);
		
		$this->Saham_model->perbarui($where,$data,'saham');
		$response_array['status'] = 'success';
		header('Content-Type: application/json');
		echo json_encode($response_array);
	}

    public function hapus($id)
	{	
        $where = array('id_saham' => $id);
        $this->Saham_model->hapus($where,'saham');
        $response_array['status'] = 'success';
		echo json_encode($response_array);
	}
    
}
