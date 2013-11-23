<?php

class Manage extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	
	
	function all($module, $post_id=0){
		
		auth();
		
		$data['module']=$module;
		$data['post_id']=$post_id;
	
		
			
		$data['maincontent'] = 'manage';
		$this->load->view('sparrow/index', $data);
	}
	
	
	
	function settings(){
		
		auth();
		
		
		$data['maincontent'] = 'settings/general';
		$this->load->view('sparrow/index', $data);
	}
	
	
	
	
	
	function reorder($table){
		
		auth();
		
		$order = $_POST['orderdata'];
		
		$params = array();
		parse_str($_POST['orderdata'], $params);

// pr($params);
$i=0;
		foreach($params['page'] as $id){
			
			
			$data=array('order_id'=>$i);
			$this->db->where('id', $id);
			$this->db->update($table, $data);
			
			$i++;
		}
	}
	
	
	function order_by($field){
		
		$this->session->set_userdata('order_by', $field);
		
		header("Location: ".$_SERVER['HTTP_REFERER']."#!/posts");
	}
	
	
	
	function toggle_subpage($id, $subpage=1){
		
		$data = array('subpage'=>$subpage);
		
		
			$this->db->where('id', $id);
			$this->db->update('pages', $data);
		
		
	}
	
	
	function test($post_id){
	$this->db->where('blog', $this->session->userdata('blog'));
$this->db->where('post_id', $post_id);
$this->db->order_by('order_id');
$q2=$this->db->get('files');
echo $q2->num_rows();	
	}
	
}