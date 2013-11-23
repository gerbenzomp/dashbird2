<?php
class Users extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	
	

	function login(){
		
		
		$data = array();
		
		if($_POST){
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$q=$this->db->get('users');
			
			if($q->num_rows()>0){
				$user = $q->row();
				
				$this->session->set_userdata('logged_in', 1);
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('blog', $user->blog);
				$this->session->set_userdata('logged_in_to', $user->blog);
				$this->session->set_userdata('level', $user->level);
				
				
				header("Location: ".base_url());
				

			}
			else
			{
				
				$data['error'] = "Your username or password is incorrect. Sorry 'bout that!";
				
			}
		}
		
		$data['maincontent'] = "login";
		
		$this->load->view('sparrow/login', $data);
		
		
	}
	
	function logout(){
		
		$blog = $this->session->userdata('blog');
		
	$this->session->unset_userdata('logged_in');
	$this->session->unset_userdata('logged_in_to');
	$this->session->unset_userdata('username');	
	$this->session->unset_userdata('level');	
	
	header("Location: ".base_url());
	}
	
	
	function edit($id=''){
		
		
		
		
		// auth();
		
		if($_POST){
			
			
				if($_POST['username']==''){
					
					echo "Error: Username is empty";
					exit;
				}
				if($_POST['password']==''){
					
					echo "Error: Password is empty";
					exit;
					
				}
			
			if($id==''){
			
				$this->db->where('username', $_POST['username']);
				$q1=$this->db->get('users');
				if($q1->num_rows()>0){
					
					echo "Error: Username already exists"; // username already exists
					exit;
					
				}
				
				
				
			}
			
			save($id, 'users');
		}
		
		
		
		
		
		$data['id'] = $id;
		$data = populate($id, 'users');
	
		
		
		$data['maincontent'] = 'edit';
		$this->load->view('sparrow/index', $data);
		
	}

	
	
	
	
	function delete($id){
		
		auth();
		
		$this->db->where('id', $id);
		$this->db->delete('users');
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
		
	}
	
	
	
}
?>