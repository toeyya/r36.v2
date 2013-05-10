<?php
class Permission_model extends MY_Model
{
	public $table = "n_permissions";
	
	//public $has_one = array("user_type");
	
	public function __construct()
	{
		parent::__construct();
	}

}
?>