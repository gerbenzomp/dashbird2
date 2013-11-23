<?php
function auth(){
	$CI =& get_instance();
	if(logged_in()==0){
		// header("Location: ".base_url());
		
		?>
        <script type="text/javascript">
        window.location = '<?=base_url();?>login';
        </script>
        <?php
		exit;
	
	}
	
	if($CI->session->userdata('logged_in_to')!=$CI->session->userdata('blog')){
		
		?>
        <script type="text/javascript">
        window.location = '<?=base_url();?>';
        </script>
        <?php
		exit;
		
	}
	
}

function iframe_auth(){
	$CI =& get_instance();
	if(logged_in()==0){
		// header("Location: ".base_url());
		
		?>
        <script type="text/javascript">
        if ( window.self != window.top ){
				 window.parent.location = 'http://www.blogbird.nl/login';
         
			}
			else
			{
			  window.location = 'http://www.blogbird.nl/login';		
			}
        </script>
        <?php
		exit;
	
	}
	
	if($CI->session->userdata('logged_in_to')!=$CI->session->userdata('blog')){
		
		?>
          <script type="text/javascript">
        if ( window.self != window.top ){
				 window.parent.location = 'http://www.blogbird.nl/login';
         
			}
			else
			{
			  window.location = 'http://www.blogbird.nl/login';		
			}
        </script>
        <?php
		exit;
		
	}
	
}




function logged_in(){
	$CI =& get_instance();
	
	$logged_in = 0;
	
	if($CI->session->userdata('logged_in')==1){
		$logged_in = 1;
	
	}
	
	if($CI->session->userdata('logged_in_to')!=$CI->session->userdata('blog')){
		$logged_in = 0;
		
	}

	
	
	return $logged_in;
	
}


function site_url(){
	
	
	return base_url();
}

function my_url(){
		$CI =& get_instance();
		
	
	
	if(isset($_SERVER['HTTP_X_FORWARDED_HOST'])){
	return "http://".$_SERVER['HTTP_X_FORWARDED_HOST'].'/';
	}
	else
	{
	return base_url(); 	
	}

		
	
	}
	
	
	function subdomain(){
		
		$subdomain = array_shift(explode(".",$_SERVER['HTTP_HOST']));
		
		return $subdomain;
		
	}
	

function niceUrl($string){
	
	//$string = str_replace(" ", "-", $string);
	$string = preg_replace("![^a-z0-9]+!i", "-", $string);
	$string = strtolower($string);
	return $string;
}

function decodeUrl($string){
	$string = str_replace("-", " ", $string);

	return $string;
}

function getPostId($url){
	return str_replace("http://cineblah.tumblr.com/post/", "", $url);
}

function EmptyDir($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }

    closedir($dh);
    if ($DeleteMe){
        @rmdir($dir);
    }
}

function listFiles($dir){

		$exclude = array('.', '.DS_Store', '..', 'index.html', '.htaccess', 'default');
		
		$handle = opendir(APPPATH.$dir.'/');
		
		while ( false !== ($file = readdir($handle)))
		{
			if(!in_array($file, $exclude))
			{
			$files[] = $file;
			}
		}
		
		closedir($handle);
		
		return $files;

}

function hook($name, $data=''){
	

	
	include(APPPATH.'config/plugins.php');
	
	
	
	foreach($plugins as $item){
		if(file_exists(APPPATH."plugins/".$item."/hooks/".$name.".php")){
			
		
			
			include(APPPATH."plugins/".$item."/hooks/".$name.".php");
			
		}
	}
	
	
}

function pr($var){
	echo "<pre>";
	print_r($var);
	echo "</pre>";	
}

function debug(){
	if($_SERVER['REMOTE_ADDR']=="83.80.201.65"){ // your ip here
		return true;
	}
	else
	{
		return false;
	}
}




function getSet($key, $blog=''){
	$CI =& get_instance();
	$CI->db->where('name', $key);
	if($blog==''){
	$CI->db->where('blog', $CI->session->userdata('blog'));
	}
	else{
	$CI->db->where('blog', $blog);	
	}
	$q=$CI->db->get('settings');
	if($q->num_rows() > 0){
	$set = $q->row();
	
	return $set->value;
	}
	
}


function lookForFile($name, $posttype){
	
	// allows you to override front in themes folder
	if(file_exists(APPPATH."views/themes/posttypes/".$posttype."/".$name.".php")){
		return(APPPATH."views/themes/posttypes/".$posttype."/".$name.".php");
	}
	// or in posttypes folder
	elseif(file_exists(APPPATH."posttypes/".$posttype."/".$name.".php")){
		return(APPPATH."posttypes/".$posttype."/".$name.".php");
	}
	elseif(file_exists(APPPATH."posttypes/default/".$name.".php")){
		return(APPPATH."posttypes/default/".$name.".php");
	}
	else
	{
	return FALSE;	
	}
	
}

function FetchPage($path)
			{
				$file = fopen($path, "r"); 
				
				if (!$file)
				{
				exit("The was a connection error!");
				} 
				
				$data = '';
				
				while (!feof($file))
				{
				// Extract the data from the file / url
				
				$data .= fgets($file, 1024);
				}
				return $data;
}

	function imageFromUrl($url){
		
			
			// Fetch page
			$string = FetchPage($url);
			
			// Regex that extracts the images (full tag)
			$image_regex_src_url = '/<img[^>]*'.
			
			'src=[\"|\'](.*)[\"|\']/Ui';
			
			preg_match_all($image_regex_src_url, $string, $out, PREG_PATTERN_ORDER);
			
			$img_tag_array = $out[0];
			
			// echo "<pre>"; print_r($img_tag_array); echo "</pre>";
			
			// Regex for SRC Value
			$image_regex_src_url = '/<img[^>]*'.
			
			'src=[\"|\'](.*)[\"|\']/Ui';
			
			preg_match_all($image_regex_src_url, $string, $out, PREG_PATTERN_ORDER);
			
			$images_url_array = $out[1];
			
			if(strpos('rss', $images_url_array[2])){
			return $images_url_array[3];
			}
			else
			{
				return $images_url_array[2];	
			}
			
			

		
	}
	
	function mysql_date(){
	return date("Y-m-d H:i:s");
	}
	
	
	function checkEmail($email){
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
	}



	function humanize($var){
	
	$var = str_replace('-', ' ', $var);
	$var = ucwords($var);
	return $var;
		
	}
	
	
	function populate($id, $table){
		$CI =& get_instance();
		
	if($id==''){
			
			$fields = $CI->db->list_fields($table);
			
			foreach($fields as $key){
			
			$data[$key] = '';
			}
			
			$data['edit'] = "Add";
			
		}
		else
		{	
			$CI->db->where('id', $id);
			$q = $CI->db->get($table);
			
			$data = $q->row_array();
			
			$data['edit'] = "Edit";
		}
		
		return $data;
	}
		
		
	function save($id='', $table){
		
		$CI =& get_instance();
		
	
		
		if($_POST){
			
			$_POST['blog'] = $CI->session->userdata('blog');	
			
			if($id==''){
				
				$data = $_POST;
				$CI->db->insert($table, $data);
				
			}
			else
			{
				$data = $_POST;
				$CI->db->where('id', $id);
				$CI->db->update($table, $data);
				
			}
			
		}
		
		
	}
	
	function theme_url(){
		$CI =& get_instance();
		
		$CI->db->where('url', $CI->session->userdata('blog'));
		$q=$CI->db->get('blogs');
		$blog=$q->row();
		
		if($blog->theme!='dashbird'){
		return base_url()."themes/".$blog->theme."/";
		}else{
		return base_url()."themes/".$CI->session->userdata('blog')."/";
		}
	}
	
	
	function img_url(){
		$CI =& get_instance();
		
		return base_url()."uploads/".$CI->session->userdata('blog')."/";
	}
	
	function make_editable($id){
	$CI =& get_instance();
	if($CI->session->userdata('logged_in')){ ?>
  
	 <span id="anchor-<?=$id;?>" class="anchor edit">
     
     <?php } 
	
}

function end_editable($clear=0){
	$CI =& get_instance();
	if($CI->session->userdata('logged_in')){
		if($clear==1){
		echo '<div style="clear: both;"></div>';	
		}
		
		
	echo "</span>";
	}
}



function themePrefs($blog=''){
	$CI =& get_instance();
	
	if($blog==''){
	$blog = $CI->session->userdata('blog');
	}
	
	$CI->db->where('url', $blog);
		$q=$CI->db->get('blogs');
		$myblog=$q->row();
		
		
	
	if(file_exists(APPPATH.'../themes/'.$myblog->theme.'/config.php')){
	include(APPPATH.'../themes/'.$myblog->theme.'/config.php');
	return $thm;
	}
	elseif(file_exists(APPPATH.'../themes/'.$blog.'/config.php')){
	include(APPPATH.'../themes/'.$blog.'/config.php');
	return $thm;
	}
	else{
	return array();	
	}
	
	
	
}






function resize_image($filename, $new_filename, $width = 200, $height = 150, $crop = true)
{
	
	$quality = 100;
	
	
	  	$CI=&get_instance();
		
		$source_image = APPPATH."../uploads/".$CI->session->userdata('blog')."/large/".$filename;
		$destination_filename= APPPATH."../uploads/".$CI->session->userdata('blog')."/square/".$new_filename;
	
	

        if( ! $image_data = getimagesize( $source_image ) )
        {
                return false;
        }

        switch( $image_data['mime'] )
        {
                case 'image/gif':
                        $get_func = 'imagecreatefromgif';
                        $suffix = ".gif";
                break;
                case 'image/jpeg';
                        $get_func = 'imagecreatefromjpeg';
                        $suffix = ".jpg";
                break;
                case 'image/png':
                        $get_func = 'imagecreatefrompng';
                        $suffix = ".png";
                break;
        }

        $img_original = call_user_func( $get_func, $source_image );
        $old_width = $image_data[0];
        $old_height = $image_data[1];
        $new_width = $width;
        $new_height = $height;
        $src_x = 0;
        $src_y = 0;
        $current_ratio = round( $old_width / $old_height, 2 );
        $desired_ratio_after = round( $width / $height, 2 );
        $desired_ratio_before = round( $height / $width, 2 );

        if( $old_width < $width || $old_height < $height )
        {
                /**
                 * The desired image size is bigger than the original image. 
                 * Best not to do anything at all really.
                 */
                return false;
        }


        /**
         * If the crop option is left on, it will take an image and best fit it
         * so it will always come out the exact specified size.
         */
        if( $crop )
        {
                /**
                 * create empty image of the specified size
                 */
                $new_image = imagecreatetruecolor( $width, $height );

                /**
                 * Landscape Image
                 */
                if( $current_ratio > $desired_ratio_after )
                {
                        $new_width = $old_width * $height / $old_height;
                }

                /**
                 * Nearly square ratio image.
                 */
                if( $current_ratio > $desired_ratio_before && $current_ratio < $desired_ratio_after )
                {
                        if( $old_width > $old_height )
                        {
                                $new_height = max( $width, $height );
                                $new_width = $old_width * $new_height / $old_height;
                        }
                        else
                        {
                                $new_height = $old_height * $width / $old_width;
                        }
                }

                /**
                 * Portrait sized image
                 */
                if( $current_ratio < $desired_ratio_before  )
                {
                        $new_height = $old_height * $width / $old_width;
                }

                /**
                 * Find out the ratio of the original photo to it's new, thumbnail-based size
                 * for both the width and the height. It's used to find out where to crop.
                 */
                $width_ratio = $old_width / $new_width;
                $height_ratio = $old_height / $new_height;

                /**
                 * Calculate where to crop based on the center of the image
                 */
                $src_x = floor( ( ( $new_width - $width ) / 2 ) * $width_ratio );
                $src_y = round( ( ( $new_height - $height ) / 2 ) * $height_ratio );
        }
        /**
         * Don't crop the image, just resize it proportionally
         */
        else
        {
                if( $old_width > $old_height )
                {
                        $ratio = max( $old_width, $old_height ) / max( $width, $height );
                }else{
                        $ratio = max( $old_width, $old_height ) / min( $width, $height );
                }

                $new_width = $old_width / $ratio;
                $new_height = $old_height / $ratio;

                $new_image = imagecreatetruecolor( $new_width, $new_height );
        }

        /**
         * Where all the real magic happens
         */
        imagecopyresampled( $new_image, $img_original, 0, 0, $src_x, $src_y, $new_width, $new_height, $old_width, $old_height );

        /**
         * Save it as a JPG File with our $destination_filename param.
         */
        imagejpeg( $new_image, $destination_filename, $quality  );

        /**
         * Destroy the evidence!
         */
        imagedestroy( $new_image );
        imagedestroy( $img_original );

        /**
         * Return true because it worked and we're happy. Let the dancing commence!
         */
        return true;
}


// same as above, just differents paths
function resize_image2($filename, $new_filename, $width = 100, $height = 100, $crop = true)
{
	
	$quality = 100;
	
	
	  	$CI=&get_instance();
		
		$source_image = APPPATH."../uploads/".$CI->session->userdata('blog')."/".$filename;
		$destination_filename= APPPATH."../uploads/".$CI->session->userdata('blog')."/square/".$new_filename;
	
	

        if( ! $image_data = getimagesize( $source_image ) )
        {
                return false;
        }

        switch( $image_data['mime'] )
        {
                case 'image/gif':
                        $get_func = 'imagecreatefromgif';
                        $suffix = ".gif";
                break;
                case 'image/jpeg';
                        $get_func = 'imagecreatefromjpeg';
                        $suffix = ".jpg";
                break;
                case 'image/png':
                        $get_func = 'imagecreatefrompng';
                        $suffix = ".png";
                break;
        }

        $img_original = call_user_func( $get_func, $source_image );
        $old_width = $image_data[0];
        $old_height = $image_data[1];
        $new_width = $width;
        $new_height = $height;
        $src_x = 0;
        $src_y = 0;
        $current_ratio = round( $old_width / $old_height, 2 );
        $desired_ratio_after = round( $width / $height, 2 );
        $desired_ratio_before = round( $height / $width, 2 );

        if( $old_width < $width || $old_height < $height )
        {
                /**
                 * The desired image size is bigger than the original image. 
                 * Best not to do anything at all really.
                 */
                return false;
        }


        /**
         * If the crop option is left on, it will take an image and best fit it
         * so it will always come out the exact specified size.
         */
        if( $crop )
        {
                /**
                 * create empty image of the specified size
                 */
                $new_image = imagecreatetruecolor( $width, $height );

                /**
                 * Landscape Image
                 */
                if( $current_ratio > $desired_ratio_after )
                {
                        $new_width = $old_width * $height / $old_height;
                }

                /**
                 * Nearly square ratio image.
                 */
                if( $current_ratio > $desired_ratio_before && $current_ratio < $desired_ratio_after )
                {
                        if( $old_width > $old_height )
                        {
                                $new_height = max( $width, $height );
                                $new_width = $old_width * $new_height / $old_height;
                        }
                        else
                        {
                                $new_height = $old_height * $width / $old_width;
                        }
                }

                /**
                 * Portrait sized image
                 */
                if( $current_ratio < $desired_ratio_before  )
                {
                        $new_height = $old_height * $width / $old_width;
                }

                /**
                 * Find out the ratio of the original photo to it's new, thumbnail-based size
                 * for both the width and the height. It's used to find out where to crop.
                 */
                $width_ratio = $old_width / $new_width;
                $height_ratio = $old_height / $new_height;

                /**
                 * Calculate where to crop based on the center of the image
                 */
                $src_x = floor( ( ( $new_width - $width ) / 2 ) * $width_ratio );
                $src_y = round( ( ( $new_height - $height ) / 2 ) * $height_ratio );
        }
        /**
         * Don't crop the image, just resize it proportionally
         */
        else
        {
                if( $old_width > $old_height )
                {
                        $ratio = max( $old_width, $old_height ) / max( $width, $height );
                }else{
                        $ratio = max( $old_width, $old_height ) / min( $width, $height );
                }

                $new_width = $old_width / $ratio;
                $new_height = $old_height / $ratio;

                $new_image = imagecreatetruecolor( $new_width, $new_height );
        }

        /**
         * Where all the real magic happens
         */
        imagecopyresampled( $new_image, $img_original, 0, 0, $src_x, $src_y, $new_width, $new_height, $old_width, $old_height );

        /**
         * Save it as a JPG File with our $destination_filename param.
         */
        imagejpeg( $new_image, $destination_filename, $quality  );

        /**
         * Destroy the evidence!
         */
        imagedestroy( $new_image );
        imagedestroy( $img_original );

        /**
         * Return true because it worked and we're happy. Let the dancing commence!
         */
        return true;
}




function img($filename, $width, $height='', $retina=0, $reveal=0){
	
	$CI=&get_instance();
	
	$orig_width = $width;
	
	$folder = 'large';

	
	if($retina!=0){
		
	$retina_width = $width*$retina;
	$verhouding = $height/$width;
	$retina_height = $retina_width * $verhouding;
	
	$width=$retina_width;
	$height = round($retina_height);
	
	
	
	
	if($width> 900){
		$folder = 'mega';
	}
	
	}
	
		
		
			if($reveal==0){
			
				if($height==''){
				return '<img src="'.base_url().'uploads/thumb.php?src='.$CI->session->userdata('blog').'/'.$folder.'/'.$filename.'&w='.$width.'" width="'.$orig_width.'" border="0" />';
				}
				else
				{
						return '<img src="'.base_url().'uploads/thumb.php?src='.$CI->session->userdata('blog').'/'.$folder.'/'.$filename.'&w='.$width.'&h='.$height.'&zc=1" width="'.$orig_width.'" border="0" />';
				
				}
			}
			else
			{
				
				if($height==''){
				return '<img class="hidden" data-src="'.base_url().'uploads/thumb.php?src='.$CI->session->userdata('blog').'/'.$folder.'/'.$filename.'&w='.$width.'" width="'.$orig_width.'" border="0" />';
				}
				else
				{
						return '<img class="hidden" data-src="'.base_url().'uploads/thumb.php?src='.$CI->session->userdata('blog').'/'.$folder.'/'.$filename.'&w='.$width.'&h='.$height.'&zc=1" width="'.$orig_width.'" border="0" />';
				
				}
		
				
			}
			
}





function split_half($string, $center = 0.5) {
        $length2 = strlen($string) * $center;
        $tmp = explode(' ', $string);
        $index = 0; 
        $result = Array(0 => '', 1 => '');
        foreach($tmp as $word) {
            if(!$index && strlen($result[0]) > $length2) $index++;
            $result[$index] .= $word.' ';
        }
        return $result;
}


function quickMail($title, $message){
	
	$CI=&get_instance();
	
	$CI->load->library('email');

	$CI->email->from('support@blogbird.nl', 'BlogBird Support');
	$CI->email->to('gerben@zomp.nl');
	
	
	$CI->email->subject($title);
	$CI->email->message($message);
	
	$CI->email->send();
	
	// echo $CI->email->print_debugger();
		
}


function readmore($str, $id, $label){
	
	$str = explode('<hr>', $str);
	
	echo $str[0];
	
	if(isset($str[1])){
		
		?>
        <a href="<?=my_url();?>posts/show/<?=$id;?>"><?=$label;?></a>
        
        <?php
		
	}
	
}

function possiblyS3($filename, $s3, $w=110){
	
	$CI=&get_instance();
	?>
	<?php if($s3!=''){ ?>
<img src="http://www.uploadcdn.com/thumb.php?src=blogbird/<?=$CI->session->userdata('blog');?>/<?=$s3;?>&w=<?=$w;?>&h=<?=$w;?>&zc=1" style="display: block;" />
<?php }else{ ?>
    <img src="<?=base_url();?>uploads/thumb.php?src=<?=$CI->session->userdata('blog');?>/large/<?=$filename;?>&w=<?=$w;?>&h=<?=$w;?>&zc=1" style="display: block;" />
    <?php } ?>
	
	<?php
	
}
		
		function cloudcopy($file, $bucket, $subfolder){
			
			if (!class_exists('S3')) require_once APPPATH.'modules/cloudupload/libraries/S3.php';


			$cfg['accessKey'] = 'AKIAI6K47QVZGY6HT7XQ';
			$cfg['secretKey'] = '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';

			// AWS access info
			if (!defined('awsAccessKey')) define('awsAccessKey', $cfg['accessKey']);
			if (!defined('awsSecretKey')) define('awsSecretKey', $cfg['secretKey']);
			
			$uploadFile = $file; // File to upload, we'll use the S3 class since it exists
			$bucketName = $bucket; // Temporary bucket
			$subfolder = $subfolder;
			
			// If you want to use PECL Fileinfo for MIME types:
			//if (!extension_loaded('fileinfo') && @dl('fileinfo.so')) $_ENV['MAGIC'] = '/usr/share/file/magic';
			
			
			// Check if our upload file exists
			if (!file_exists($uploadFile) || !is_file($uploadFile))
				return "error: original file does not exist";
				
				
			
			// Instantiate the class
			$s3 = new S3(awsAccessKey, awsSecretKey);
			
			// List your buckets:
			//echo "S3::listBuckets(): <pre>".print_r($s3->listBuckets(), 1)."</pre>\n";
			
			
			// Create a bucket with public read access
			// if ($s3->putBucket($bucketName, S3::ACL_PUBLIC_READ)) {
				//echo "Created bucket {$bucketName}".PHP_EOL;

		// Put our file (also with public read access)
		if ($s3->putObjectFile($uploadFile, $bucketName, $subfolder."/".baseName($uploadFile), S3::ACL_PUBLIC_READ)) {
			//echo "S3::putObjectFile(): File copied to {$bucketName}/".baseName($uploadFile).PHP_EOL;
	
	
			// Get the contents of our bucket
			$contents = $s3->getBucket($bucketName);
			//echo "S3::getBucket(): Files in bucket {$bucketName}: <pre>".print_r($contents, 1)."</pre>";
	
	
			// Get object info
			$info = $s3->getObjectInfo($bucketName, baseName($uploadFile));
			//echo "S3::getObjectInfo(): Info for {$bucketName}/".baseName($uploadFile).': '.print_r($info, 1);
	
	
	return "File uploaded to cloud!";
	
			// Delete our file
			/*
			if ($s3->deleteObject($bucketName, baseName($uploadFile))) {
				echo "S3::deleteObject(): Deleted file\n";
	
				// Delete the bucket we created (a bucket has to be empty to be deleted)
				if ($s3->deleteBucket($bucketName)) {
					echo "S3::deleteBucket(): Deleted bucket {$bucketName}\n";
				} else {
					echo "S3::deleteBucket(): Failed to delete bucket (it probably isn't empty)\n";
				}
	
			} else {
				echo "S3::deleteObject(): Failed to delete file\n";
			}
			*/
			
			
			
		} else {
			 return "error: failed to upload to cloud";
	}
	
	

			
			
		}
		
	
		
		function addons($id){
			
			$CI =& get_instance();
			
			
			$CI->db->where('id', $id);
			$q=$CI->db->get('posts');
			if($q->num_rows()>0){
				
				$post = $q->row();
				
				if($post->email!=''){
					echo "<br />";
					echo modules::run('forms/contact', $id);
					
				}
				
				
				if($post->price!=0.00){
					
					echo "<br /><br />";
					include(APPPATH."add-ons/shop/addon_front.php");
					
				}
				
				
				if($post->twitter_username!=''){
					
					echo "<br /><br />";
					include(APPPATH."add-ons/twitter/addon_front.php");
					
				}
				
				
				
				if($post->facebook_username!=''){
					
					echo "<br />";
					include(APPPATH."add-ons/facebook/addon_front.php");
					
				}
				
				
			}
			
			
		}
		
		
function help_arrow($text, $margin='58', $flip=0){
			
		if($flip==0){
		?>
        <table width="100%" border="0">
          <tr>
            <td width="85" valign="top"><img src="<?=base_url();?>application/views/sparrow/img/drawn-arrow.png" style="max-width: 74px; min-width: 74px;" /></td>
         
            <td style="color: #999;" valign="top">
            
        <div style="margin-top: <?=$margin;?>px; width: 210px;">
        <?=$text;?></div></td>
          </tr>
        </table>
        
        <?php	
		}
		else{
			
		
		?>
        <table width="270" border="0">
         <tr>
        <td style="color: #999;" valign="top">
            
        <div style="margin-top: <?=$margin;?>px; width: 180px; text-align: right;">
        <?=$text;?></div></td>
         
        
         
            <td width="85" valign="top"><img src="<?=base_url();?>application/views/sparrow/img/drawn-arrow-down.png" style="max-width: 74px; min-width: 74px;" /></td>
         
             </tr>
        </table>
        
        <?php	
		}
		
}

function cache_filename($unique){
	$CI=&get_instance();
	
	  $cache_folder = '/cache/'; // Folder to store cached files (no trailing slash)  
	
	  // Think outside the box the original said to use the URI instead use something else.
	  $cache_filename = getenv("DOCUMENT_ROOT") . $cache_folder. $CI->session->userdata('blog')."-".md5($unique).".txt"; // Location to lookup or store cached file  
	  
	  return $cache_filename;
}

function cache_get($cache_filename){
	
	 $cache_time = 360; // Time in seconds to keep a page cached  
	
	  

	  if (file_exists($cache_filename) && (time() - filemtime($cache_filename)) < $cache_time) {  
		//$storedData = readCacheFile($cache_filename);
		
		
		return true;
		
	  }
	  else
	  {
		return false;  
	  }
	
}

function cache_save($cache_filename, $storedData){
	$fileLocation = $cache_filename;
  $file = fopen($fileLocation,"w");
  $content = $storedData;
  fwrite($file,$content);
  fclose($file);	
}

/*
function add_button($col='', $num=0, $top=0, $width=80, $title='Add post', $class="add-button"){
	$CI =& get_instance();
	
	if($CI->session->userdata('logged_in')==1){
		
	//if($num>0){
   ?>
    <div class="action" style="position: absolute; width: 0; height: 0; margin-top: <?=$top;?>px;">

           <a style="display: block; width: <?=$width;?>px; padding: 5px; border: 1px solid #CCC; border-radius: 4px; text-align: center; cursor: pointer !important; background-color: #F0F0F0; color: #333; font-size: 12px;font-family: helvetica;line-height: 20px; letter-spacing: 0px; background-image: url(http://blogbird.nl/application/sources/img/icons/add.png); background-repeat: no-repeat; background-position: 10px 6px;" class="<?=$class;?>" id="col-<?=$col;?>"><span style="padding-left: 16px;"><?=$title;?></span></a>
       
	</div>
    
    <?php if($num==0){ ?>
    
    <div style="padding: 25px;"></div>
    
    <?php } ?>
    
  	<?php
	/*
	}
	else{
		
		?>
		<a style="display: block; border: 3px dashed #CCC; padding: 10px; text-align: center; cursor: pointer !important;font-family: helvetica;line-height: 20px; letter-spacing: 0px; color: black;" class="<?=$class;?>">Add Post</a>
		
	<?php	
	}
	*/
	
	/*
	}
	
	
}
*/

function add_button($page='', $col='', $num=0, $top=0, $title='post', $class='add-button'){
	$CI =& get_instance();
	
	if($page==''){
		$page = $CI->session->userdata('curpage');
	}
	else{
		$page = $page;
	}
	
	if($col==''){
		$col = 'main';
	}
	else{
		$col = $col;
	}
	
	
	if($CI->session->userdata('logged_in')==1){
	?>
     <div class="action" style="position: absolute; width: 0; height: 0; margin-top: <?=$top;?>px;">
       <div class="btn-group">
         <a title="add <?=$title;?>" class="<?=$class;?>" id="col-<?=$col;?>" style="cursor: pointer;" data-page="<?=$page;?>"><img class="add" src="<?=base_url();?>application/plugins/icon-toolbar/buttons/add.png" /></a>
         </div>
         </div>
         
          
    <?php if($num==0){ ?>
    
    <div style="padding: 25px;"></div>
    
    <?php } 
	
	}
}


function edit_buttons($id, $top=0){
		
		
		?>
        
    <div class="edit-buttons" style="margin-top: <?=$top;?>px;">    
        <div class="btn-group">
        <a title="edit"><img src="<?=base_url();?>application/plugins/icon-toolbar/buttons/edit.png" /></a>
     
        <a title="delete"><img src="<?=base_url();?>application/plugins/icon-toolbar/buttons/delete.png" /></a>
       
        </div>
    
    </div>
        
        <?php
		
		
		
	}
	