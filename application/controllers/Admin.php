<?php 

class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('logged_in') == FALSE){
			redirect(base_url("login"));
		}
	}

	function saham(){
		$data['content'] = 'admin/saham';
		$data['title'] = 'Admin | SPK Saham AHP';
		$data['user'] = $this->session->userdata('nama');
		$this->load->view('admin/template/content',$data);
	}

	function kriteria(){
		$data['content'] = 'admin/kriteria';
		$data['title'] = 'Admin | SPK Saham AHP';
		$data['user'] = $this->session->userdata('nama');
		$this->load->view('admin/template/content',$data);
	}

	function subkriteria(){
		$data['content'] = 'admin/subkriteria';
		$data['title'] = 'Admin | SPK Saham AHP';
		$data['user'] = $this->session->userdata('nama');
		$this->load->view('admin/template/content',$data);
	}

	function proses(){
		$data['content'] = 'admin/proses';
		$data['title'] = 'Admin | SPK Saham AHP';
		$data['user'] = $this->session->userdata('nama');
		$this->load->view('admin/template/content',$data);
	}
}