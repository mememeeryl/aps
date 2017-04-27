<?php

class Login_Org extends CI_Controller{

	
	public function index()
	{
		$this->home();
	}

	public function home(){
		$this->load->view('include/LogHeader');
		$this->load->view('Login');

	}


	

	
}
?>