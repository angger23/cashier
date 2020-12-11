<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forbidden extends CI_Controller {
function __construct(){
		parent::__construct();
		$this->load->model('m_data');
        $this->load->helper('url');
        $this->load->model('ion_auth_model');
    if(!$this->ion_auth->logged_in()){
			redirect("auth/login");
		}
	}

	public function index(){
		$this->load->view('user/forbidden');
	}
}
