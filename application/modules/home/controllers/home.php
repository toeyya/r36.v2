<?php
class Home extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
	}
	function index()
	{		
		$this->template->set_layout('home');
		$this->template->build('index');				
	}
	function test(){
			$serverName = "(local)\R36, 1433"; //serverName\instanceName, portNumber (default is 1433)
			$connectionInfo = array( "Database"=>"r36test", "UID"=>"sa", "PWD"=>"1234");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
			if( $conn ) {
				 echo "Connection established.<br />";
			}else{
				 echo "Connection could not be established.<br />";
				 die( print_r( sqlsrv_errors(), true));
			}
	}			
}


?>