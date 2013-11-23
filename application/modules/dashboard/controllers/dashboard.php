<?php

class Dashboard extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	

	function index(){
		
		auth();
		
		$this->load->library('user_agent');
		
		$data['maincontent'] = 'dashboard';
		
		$data['toolbar'] = 'backend/toolbar';
		
		$this->load->view('sparrow/index', $data);
		
	}
	
	
	
}