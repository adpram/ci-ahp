<?php 

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('Login_model');
	}

	function index(){
		if($this->session->userdata('nama')){
			redirect(base_url('admin/saham'));
		}else{
			$this->load->view('login');
		}
	}

	function proses(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->Login_model->cek_login("pengguna",$where)->num_rows();
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'logged_in' => TRUE
			);

			$this->session->set_userdata($data_session);

			redirect(base_url("admin/saham"));

		}else{
			$data['message'] = "You have entered an invalid username or password";
			$this->load->view('login',$data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('main'));
	}
}