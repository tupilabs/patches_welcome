<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->config('patches_welcome');
		$this->load->library('curl');
	}
	
	public function index()	{
		$urls = $this->config->item('search_urls');
		
		foreach ($urls as $project => $url) {
			if (!file_exists("./json/jira/$project")) {
				@mkdir("./json/jira/$project", 0777, true);
			}
			
			// download search JSON
			$this->curl->proxy('http://localhost', 3128);
			$search_response = $this->curl->simple_get($url);
			
			$fh = fopen("./json/jira/$project/search.json", 'w');
			@fputs($fh, $search_response);
			@fclose($fh);
		}
		
		echo "OK!";
		exit();
	}
}
