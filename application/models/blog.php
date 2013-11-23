<?php
class Blog extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_pages()
    {
		$this->db->where('blog', $this->session->userdata('blog'));
		$this->db->order_by('order_id');
        $q = $this->db->get('pages');
        return $q->result();
    }
	
	 function get_users()
    {
		$this->db->where('blog', $this->session->userdata('blog'));
		$this->db->order_by('username');
        $q = $this->db->get('users');
        return $q->result();
    }
	
	
	function get_posts($page='', $col='', $limit=0)
    {
		if($page==''){
			$page = $this->session->userdata('curpage');
		}
		
		
		$this->db->where('blog', $this->session->userdata('blog'));
		if($page!='all'){
		$this->db->where('page', $page);
		}
		if($col!=''){
		$this->db->where('col', $col);	
		}
		
		$this->db->where('visible', 1);
		$this->db->order_by('order_id asc, created desc');
		if($limit!=0){
		$this->db->limit($limit);	
		}
        $q = $this->db->get('posts');
		
		return $q->result();
    }
	
	function get_images($id, $limit=0)
    {
		$this->db->where('blog', $this->session->userdata('blog'));
		$this->db->where('post_id', $id);
	
		$this->db->order_by('order_id asc');
		if($limit>0){
			$this->db->limit($limit);
		}
        $q = $this->db->get('files');
		
		if($limit>0){
		return $q->row();	
		}else{
		return $q->result();
		}
    }
	
	
	function get_posts_images($page)
    {
		$this->db->where('posts.blog', $this->session->userdata('blog'));
		$this->db->where('posts.page', $page);
		$this->db->where('posts.visible', 1);
		$this->db->order_by('posts.order_id desc');
		
		$this->db->join('files', 'files.post_id = posts.id');
       $q = $this->db->get('posts');
		
		return $q->result();
    }

	

    
}
?>