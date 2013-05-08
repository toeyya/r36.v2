<?php
class Webboard_quiz_model extends MY_Model{

	public $table = 'webboard_quizs';
	
	//var $has_one = array('user','webboard_category');
	
	//var $has_many = array('webboard_answer','webboard_relate_del','webboard_polldetail','webboard_pollresult');

	function __construct()
	{
		parent::__construct();
	}
}
?>