<?php

class Settings extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	
	
	
	
	function edit($type='general'){
		
		
		if($_POST){
			
			foreach($_POST as $key=>$value){
			
			
			if($key=='title' || $key=='theme'){
				
				$mydata[$key]=$value;
				$this->db->where('url', $this->session->userdata('blog'));
				$this->db->update('blogs', $mydata);
				
			}
			else
			{
			
			
					$this->db->where('name',$key);
					$this->db->where('blog', $this->session->userdata('blog'));
					$q=$this->db->get('settings');
					if($q->num_rows()>0){
						$data=array('value'=>$value);
						$this->db->where('name', $key);
						$this->db->where('blog', $this->session->userdata('blog'));
						$this->db->update('settings', $data);
					}
					else
					{
						$data=array('name'=>$key, 'value'=>$value, 'blog'=>$this->session->userdata('blog'));
						$this->db->insert('settings', $data);
					}
			}
		
		}
			
		}
		
		
		
		$this->db->where('url', $this->session->userdata('blog'));
		$q=$this->db->get('blogs');
		$data['blog'] = $q->row();
		
		
		
		$this->load->view($type, $data);
		
	}
	
	
	
}