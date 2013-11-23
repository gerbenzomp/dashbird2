<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "default_controller";
$route['404_override'] = '';

// login
$route['login'] = 'users/login';


// temporarily reroute older routes (remove later)
$route['post/show/([a-z0-9-.]+)'] = 'default_controller/index/default/posts/show/$1';
$route['post/show/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/default/posts/show/$1/$2';
$route['page/show/([a-z0-9-.]+)'] = 'default_controller/index/default/pages/show/$1';

// route pages
$route['page/([a-z0-9-.]+)'] = 'default_controller/index/pages/show/$1';
$route['page/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/pages/show/$1/$2'; // page numbers
$route['([a-z0-9-.]+)/page/([a-z0-9-.]+)'] = 'default_controller/index/pages/show/$2';
$route['([a-z0-9-.]+)/page/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/pages/show/$2/$3'; // page numbers


// route posts
$route['post/([a-z0-9-.]+)'] = 'default_controller/index/posts/show/$1';
$route['post/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/posts/show/$1/$2';
$route['([a-z0-9-.]+)/post/([a-z0-9-.]+)'] = 'default_controller/index/posts/show/$2';
$route['([a-z0-9-.]+)/post/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/posts/show/$2/$3';








// check for installed modules automatically

$exclude = array('.', '..', 'index.html');

$handle = opendir(APPPATH.'modules/');

while ( false !== ($file = readdir($handle)))
{
	if(!in_array($file, $exclude))
	{
	$installed_modules[] = $file;
	}
}

closedir($handle);

foreach($installed_modules as $module){

		$route[$module] = $module; 
		$route[$module."/(.*)"] = $module."/$1"; 
		$route[$module."/(.*)/(.*)"] = $module."/$1/$2";
		$route[$module."/(.*)/(.*)/(.*)"] = $module."/$1/$2/$3";
		$route[$module."/(.*)/(.*)/(.*)/(.*)"] = $module."/$1/$2/$3/$4";  
		$route[$module."/(.*)/(.*)/(.*)/(.*)/(.*)"] = $module."/$1/$2/$3/$4/$5";
}



// add as last rules
$route['([a-z0-9-_.]+)'] = 'default_controller/index/$1'; 
$route['([a-z0-9-_.]+)/([a-z0-9-.]+)'] = 'default_controller/index/$1/$2';
$route['([a-z0-9-_.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/$1/$2/$3';
$route['([a-z0-9-_.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/$1/$2/$3/$4';
$route['([a-z0-9-_.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/$1/$2/$3/$4/$5';
$route['([a-z0-9-_.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)/([a-z0-9-.]+)'] = 'default_controller/index/$1/$2/$3/$4/$5/$6';


/* End of file routes.php */
/* Location: ./application/config/routes.php */