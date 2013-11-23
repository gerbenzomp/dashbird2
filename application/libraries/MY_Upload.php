<?php 
/**
* CodeIgniter My Upload 
*
* @package		CodeIgniter
* @subpackage	Libraries
* @author	    Robin Willmott @ Coffee Bean Design
*/

class MY_Upload extends CI_Upload
{
	// --------------------------------------------------------------------
	
	/**
	 * Verify that the filetype is allowed
	 *
	 * @access	public
	 * @return	bool
	 */	
	function is_allowed_filetype()
	{
		if (count($this->allowed_types) == 0 OR ! is_array($this->allowed_types))
		{
			$this->set_error('upload_no_file_types');
			return FALSE;
		}
		
		// Is it really though??
		if ( $this->file_type == 'application/octet-stream' ) 
		{
			if ( function_exists('finfo_file') ) 
			{
				
				$finfo = finfo_open(FILEINFO_MIME_TYPE);
				$php_mime = finfo_file($finfo, $this->file_temp);	
				
			}
			
			elseif ( function_exists('mime_content_type') ) 
			{
				
     			 $php_mime = mime_content_type( $this->file_temp );
   			
			}
			
			if ( $php_mime ) 
			{
				$this->file_type = $php_mime;
			}
		}
		
		$image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe');

		foreach ($this->allowed_types as $val)
		{
			$mime = $this->mimes_types(strtolower($val));

			// Images get some additional checks
			if (in_array($val, $image_types))
			{
				if (getimagesize($this->file_temp) === FALSE)
				{
					return FALSE;
				}
			}

			if (is_array($mime))
			{
				if (in_array($this->file_type, $mime, TRUE))
				{
					return TRUE;
				}
			}
			else
			{
				if ($mime == $this->file_type)
				{
					return TRUE;
				}	
			}		
		}
		
		return FALSE;
	}
}