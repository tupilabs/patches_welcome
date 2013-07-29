<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('JiraSearchParser');
		$this->load->helper('file');
		$this->jira = new JiraSearchParser();
	}
	
	public function index()	{
		$dir_handle = opendir('./json/jira/');
		
		$results = array();
		
		while(false !== ($fname = readdir($dir_handle))) {
			if (($fname != '.') && ($fname != '..') && ($fname != basename($_SERVER['PHP_SELF']))) {
				if (is_dir("./json/jira/$fname") && file_exists("./json/jira/$fname/search.json") && file_exists("./json/jira/$fname/url")) {
					$f = fopen("./json/jira/$fname/url", 'r');
					$base_url = fgets($f);
					$this->jira->setBaseUrl($base_url);
					@fclose($f);
					
					$contents = read_file("./json/jira/$fname/search.json");
					$search_results = $this->jira->parse($contents);
					$results[$fname] = $search_results;
				}
			}
		}
		
		closedir($dir_handle);
		
		$data = array('results' => $results);
		$this->load->view('welcome_message', $data);
	}
}

