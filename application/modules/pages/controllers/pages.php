<?php

class Pages extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	
	
	function show($page='home', $col='main'){
		
		//echo $this->uri->rsegment(1);
	
/*
// cache
$cache_filename = cache_filename($_SERVER['PHP_SELF']);
if(cache_get($cache_filename)){
include($cache_filename);
}
else
{
ob_start();  
*/

	
	
	
	$this->db->where('url', $page);
	$this->db->where('blog', $this->session->userdata('blog'));
	$q=$this->db->get('pages');
	
	if($q->num_rows()==1){
	
		$pagedata = $q->row();
	
		define("PAGE", $page);
		
		
		$data['menu'] = $this->nav();
		
		$data['page'] = $page;
		
		$data['title'] = $pagedata->title;
		$data['description'] = $pagedata->description;
		
		
	
	}
	else
	{
		include(APPPATH."views/dashbird/notfound.php");
		exit;
		
	}
	
	$this->db->where('url', $this->session->userdata('blog'));
	$q = $this->db->get('blogs');
	$blog = $q->row();
	
	$data['site_title'] = $blog->title;
	
	extract($data);
	
	
	include(APPPATH."../themes/".$blog->theme."/index.php");
	

/*	
	// cache 
$storedData = ob_get_contents();
ob_end_flush();
cache_save($cache_filename, $storedData);
}
*/



		
		//$this->load->view("themes/".$blog->theme."/index.php", $data);
	}
	
	
	
	
	function static_page($file){
		
		include(APPPATH."views/themes/cineblah/static/".$file);
	}
	
	
	
	
	
	
	function nav(){
		
		
		$this->db->where('blog', $this->session->userdata('blog'));
		$this->db->order_by('order_id');
		$q = $this->db->get('pages');
		$menu = "<div id='nav'><ul class='pages'>";
		foreach($q->result() as $p){
			$menu .= "<li><a href='".site_url()."page/".$p->url."'>".$p->title."</a></li>";
		}
		$menu .= "<ul></div>";
		
		return $menu;
	}

	
	
	function edit($id=''){
		
		if($_POST){
		
		if($id==''){	
		$this->db->where('blog', $this->session->userdata('blog'));
		$q=$this->db->get('pages');
		$total = $q->num_rows();
		$_POST['order_id'] = $total + 2;
			
		}
			
		if($_POST['title']==''){
					
					echo "Error: Title is empty"; // title is empty
					exit;
					
		}	
			
		$_POST['url'] = niceUrl($_POST['title']);
		}
		
		save($id, 'pages');
		
		
		$data['id'] = $id;
		$data = populate($id, 'pages');
		
		$data['maincontent'] = 'edit';
		$this->load->view('sparrow/index', $data);
		
	}
	
	
	
}