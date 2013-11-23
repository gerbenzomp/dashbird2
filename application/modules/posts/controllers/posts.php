<?php

class Posts extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
		
	
		
    }
	
	function uploadcare(){
	
	pr($_POST);	
	
	
	}
	
	function edit($id=''){
		
		if($id==''){
			
			// first delete old unused entries
			$this->db->where('blog', $this->session->userdata('blog'));
			$this->db->where('visible', 0);
			$this->db->delete('posts');
			
			$data=array('type'=>'article', 'blog'=>$this->session->userdata('blog'), 'created'=>mysql_date());
			$this->db->insert('posts', $data);
			
			$id = mysql_insert_id();
			
		}
	
	if($_POST){
		
		// extract youtube id
		if(preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $_POST['embed'], $matches)){
			$_POST['embed'] = $matches[1];
		}
	
	}
		save($id, 'posts');
		
	
		
		
		$data['id'] = $id;
		$data['maincontent'] = 'edit';
		$this->load->view('sparrow/index', $data);
		
	}
	
	
	
	

	
	function show_all($col){
		
		
	
	$data['col'] = $col;

	
		$this->load->view("show_all", $data);
		
	}
	
	
	function show_tag($tag){
		
		$data['tag'] = $tag;
		$data['col'] = 'main';

	
	$this->load->view("show_all", $data);
		
		
	}
	
	
	function tag($tag){
		
		//echo $this->uri->rsegment(1);
		

	
		define("PAGE", '');
		
		
		$data['menu'] = modules::run("pages/nav");
		
		$data['page'] = '';
		
		$data['title'] = humanize($tag);
		$data['description'] = "";
		
		
		
		
		// show the posts page
		$data['maincontent'] = modules::run("posts/show_tag", $tag);
	
		
		/*
		$data['sidebar'] = modules::run("posts/show_all", "sidebar");
		
		
		$data['sidebar2'] = modules::run("posts/show_all", "sidebar2");
		
		$data['sidebar3'] = modules::run("posts/show_all", "sidebar3");
		*/
		
		$data['sidebar'] = '';
	

	
	$this->db->where('url', $this->session->userdata('blog'));
	$q = $this->db->get('blogs');
	$blog = $q->row();
	
	
	
	$data['maincontent'] = 	modules::run("posts/show_all", $data);
		
		$this->load->view("themes/".$blog->theme."/index.php", $data);
	}
	
	
	function show($id){
		
		
		$this->session->set_userdata('blog', subdomain());
		
	
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$data['post'] = $q->row_array();
		
		
		
		define("PAGE", $data['post']['page']);
		$data['page'] = $data['post']['page'];
		
		$data['title'] = $data['post']['title'];
			
		
		
		$data['description'] = '';
		
		$data['menu'] = modules::run('pages/nav');
	
		$data['maincontent'] = modules::run('posts/post', $data);
		
		$data['sidebar'] = modules::run("posts/show_all", "sidebar");
		
		
		$data['sidebar2'] = modules::run("posts/show_all", "sidebar2");
		
		$data['sidebar3'] = modules::run("posts/show_all", "sidebar3");
		
		
		
		
		$this->db->where('url', $this->session->userdata('blog'));
		$q = $this->db->get('blogs');
		$blog = $q->row();
		
		$data['site_title'] = $blog->title;
		
		extract($data);
		

		
		include(APPPATH."../sites/".$this->session->userdata('blog')."/index.php");
		
		
		
	}
	
	
	function photo($id){
		
		$this->db->where('id', $id);
		$q=$this->db->get('files');
		if($q->num_rows()>0){
		$file = $q->row();
		
		$this->db->where('id', $file->post_id);
		$q2 = $this->db->get('posts');
		$post = $q2->row();
		
		$this->db->where('url', $post->page);
		$q3 = $this->db->get('pages');
		$pagedata = $q3->row();
		
	
		
		
		
		
		include(APPPATH."../sites/".$this->session->userdata('blog')."/index.php");
		}
		
	}
	
	
	
	
	
	function post($data){
		$this->db->where('id', $data['post']['id']);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
		extract($post);
		
		$edit_buttons = modules::run('posts/edit_buttons', $data['post']['id']);
		
			?>
        <div class="item" id="item-<?=$data['post']['id'];?>">
        
        <?php
		
		$inc = lookForFile('front', $post['type']);
		include($inc);
		
		?>
        </div>
        
        <?php
		
	}
	
	function post_front($id){
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
		$edit_buttons = modules::run('posts/edit_buttons', $id);
		
		$inc = lookForFile('front', $post['type']);
		include($inc);
	}
	
	
	
	/*
	// configures the extra function you can add to posttypes
	function configure($id){
		
		auth();
		
		$id = str_replace('edit-', '', $id);
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
			extract($post);
			
		
		if(file_exists(APPPATH."posttypes/".$post['type']."/config.php")){
			
			
			include(APPPATH."posttypes/".$post['type']."/config.php");
		}
		else
		{
			
			$part = array();
		}
		
		
		?>
        <?php if(!isset($part['noform'])){ ?>
        <form name="editForm" id="editForm">
        <?php } ?>
        
        <?php include(APPPATH."posttypes/".$post['type']."/back.php"); ?>
        
          <?php if(!isset($part['noform'])){ ?>
        <br /><br />
        <a href="javascript:void(0);" onclick="saveConfig();"><img src="<?=base_url();?>application/sources/img/save.png" /></a>
        
</form>
<script type="text/javascript">
function saveConfig(){
	

		var mydata = $("#editForm").serialize();
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>posts/configure_save/<?=$id;?>",
			data: { formdata: mydata }

		  
		}).done(function() { 
		
	$('#function-<?=$id;?>').load('<?=base_url();?>posts/show_function/<?=$id;?>');	
	$('#redactor_modal_inner').html(''); $('#redactor_modal').hide();
 
		});
	}
</script>
  <?php } ?>      
        
        <?php
		
	}
	
	
	function configure_save($id){
		
		auth();
		
		$id = str_replace('edit-', '', $id);
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
		if($_POST){
			
			$params = array();
			parse_str($_POST['formdata'], $params);
			
			foreach($params as $key=>$value){
				
				$data = array($key=>$value);
				$this->db->where('id', $id);
				$this->db->update('posts', $data);
				
				
			}
			
		
		}
		
	}
	
	
	
	
	
	
	function fs_init($page='home'){ // create a placeholder for the article, so we have an id
		
	
			auth();
			
			// first cleanup unused posts
			$this->db->where('visible', 0);
			$this->db->where('publish', 0);
			$this->db->delete('posts');
			
			//find out what type of posts this page contains
			$this->db->where('blog', $this->session->userdata('blog'));
			$this->db->where('url', $page);
			$q=$this->db->get('pages');
			
			$mypage = $q->row();
			
			if($mypage->type=='standard'){
				$type = "article";
			}
			else
			{
				$type = $mypage->type;
			}
				
			
			$data=array('blog'=>$this->session->userdata('blog'), 'page'=>$page, 'type'=>$type, 'created'=>date("Y-m-d H:i:s"));
			$this->db->insert('posts', $data);
			
			$id = mysql_insert_id();
			
			header("Location: ".base_url()."posts/fs_edit/".$id."/".$type);
			
	
		
	}
	*/
	
	
	
	function modal_fetch($id, $field){
		
		auth();
		
		
		if($field=='title' || $field=='body'){
			$tab = 'tab-title';
			
		}
		elseif($field=='extended'){
			$tab = 'tab-extended';
			
		}
		else{
			$tab = 'tab-options';
			
		}
		
		
		$id = str_replace('anchor-', '', $id);
		
		
		// part of a post that already exists
		if(is_numeric($id)){
			header("Location: ".base_url()."posts/modal_edit/".$id."/article/".$tab);
			
			
		}
		else{
			
			$this->db->where('anchor', $id);
			$q=$this->db->get('posts');
			if($q->num_rows()>0){
				$post = $q->row();
				
				$myid=$post->id;
				
			}
			else
			{
				
				$data=array('anchor'=>$id, 'type'=>'fragment', 'blog'=>$this->session->userdata('blog'));
				$this->db->insert('posts', $data);
				
				$myid = mysql_insert_id();
				
				
			}
			
			header("Location: ".base_url()."posts/modal_edit/".$myid."/article/".$tab);	
			
			
		}
		
	
	}
	
	function modal_add($page='home', $col='main'){
		
			// first delete old unused entries
			$this->db->where('blog', $this->session->userdata('blog'));
			$this->db->where('visible', 0);
			$this->db->delete('posts');
			
			$data=array('type'=>'article', 'blog'=>$this->session->userdata('blog'), 'page'=>$page, 'col'=>$col, 'created'=>mysql_date());
			$this->db->insert('posts', $data);
			
			$id = mysql_insert_id();
			
			header("Location: ".base_url()."posts/modal_edit/".$id."/article/title");	
		
	}
	
	
	function modal_edit($id, $type, $tab){
		
		auth();
		
	
		save($id, 'posts');
		
		
		$data['id'] = $id;
		$data = populate($id, 'posts');
		$data['maincontent'] = 'edit';
		$this->load->view('sparrow/modal', $data);
		
		
	}
	
	
	
	
	
	function show_function($id){
		
		
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post=$q->row_array();
		
		
	// allows you to override in themes folder
	$inc = lookForFile('function', $post['type']);
	include($inc);
	
		
		
	}
	
	
	function postlist($page='',  $max=10, $col=''){
		
		$data['max'] = $max;
		$data['col'] = $col;
		$data['page'] = $page;
		
		$this->load->view('postlist', $data);
	}
	
	
	
	
	function callback(){
		
		
		// quickMail('Upload Callback', $_POST['filename']);
	

		// include('/var/www/vhosts/uploadcdn.com/httpdocs/test.php');


		
	}
	
	
	
}