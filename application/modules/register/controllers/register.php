<?php
class Register extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	
	function index(){
		
		
		if($_POST){
			
			if($_POST['email']=='' && $_POST['password']==''){
				$data['error'] = "<div class='error'>Error: you did not fill in all required fields!</div>";
			}
			else
			{
			
			
					
					$this->db->where('username', $_POST['email']);
					$q2=$this->db->get('users');
					
				
					
					
					if($q2->num_rows()==0){
						
						
						$udata['username'] = $_POST['email'];
						$udata['password'] = $_POST['password'];
						$udata['email'] = $_POST['email'];
						$udata['blog'] = 'default';
						$udata['level'] = 2;
						$udata['created'] = date('Y');
						$this->db->insert('users', $udata);
						
						
						$this->session->set_userdata('logged_in', 1);
						$this->session->set_userdata('username', $udata['username']);
						$this->session->set_userdata('blog', 'default');
						$this->session->set_userdata('level', 5);
						
						
						header("Location: ".base_url());
					
					}
					else
					{
						$data['error'] = "<div class='error'>Error: this name already exists, please try another</div>";
					}
			}
			
		}
	
	

		
		$this->load->view('register', $data);
		
		
	}
	
	
	
}
?>