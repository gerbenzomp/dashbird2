<?php

class Default_controller extends MX_Controller {

 
	
	function index($controller='pages', $method='show', $var1='home', $extra='')
	{
		
	$blog='default';
		

	if(!logged_in()){
	
	$this->session->set_userdata('blog', $blog);
	}

	$this->db->where('url', $blog);
	$q=$this->db->get('blogs');
	if($q->num_rows()>0){
	
	$myblog = $q->row();
	
	if($controller=='pages'){
	
	// check if page exists	
	$this->db->where('url', $var1);
	$this->db->where('blog', $blog);
	$q=$this->db->get('pages');
	
	if($q->num_rows()==0){
		
		
		include(APPPATH."views/dashbird/notfound.php");
		exit;
		
	}
	
	$this->session->set_userdata('curpage', $var1);
	}
	elseif($controller=='posts'){
	$this->db->where('id', $var1);
	$q=$this->db->get('posts');
		if($q->num_rows()>0){
			$post = $q->row();
			
			$this->session->set_userdata('blog', $post->blog);
		}
	
	}
	
	
	}else{
		
		include(APPPATH."views/dashbird/notfound.php");
		exit;
		
		
	}
	

	echo modules::run($controller."/".$method, $var1);
	
	
	
	}
	
	
	
	
	
	

}
?>