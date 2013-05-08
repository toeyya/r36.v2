<?php
class Map extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->load->model('log_model','log');
		
	}
	function index()
	{	//$this->db->debug=TRUE;
		//$this->template->set_layout('_map');
		$this->template->build('map_index');
	}

}
?>
