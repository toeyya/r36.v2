<?php
class Home extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);
	}
	function index()
	{		
		$this->template->set_layout('home');
		$this->template->build('index');				
	}
		
}


?>