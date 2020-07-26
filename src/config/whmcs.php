<?php
return [
	// API URL
	'url'		=>	env('WHMCS_API_URL', 'http://url.com/whmcs/includes/api.php'),
	
	// API USERNAME
	'username'	=>	env('WHMCS_API_USERNAME', 'admin_user'),

	// API PASSWORD
	'password'	=>	env('WHMCS_API_PASSWORD', 'password123'),

	// API ACCESS KEY
	'api_access_key' => env('WMHCS_API_ACCESS_KEY', ''),
	
	// API RESPONSE TYPE
	'response_type'	=> env('WHMCS_API_RESPONSE_TYPE', 'json'), // json or xml
];