<?php
class Webboard_answer_model extends MY_Model {

	//var $table = 'webboard_answers';
	public $table= "webboard_answers";
	
	//var $has_one = array('user','webboard_quiz','webboard_category','webboard_relate_del');

	function __construct()
	{
		parent::__construct();
	}
}
?>