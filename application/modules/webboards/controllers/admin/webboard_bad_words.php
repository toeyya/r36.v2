<?php
	
Class Webboard_bad_words extends Admin_Controller{
		
	function __construct(){
		parent::__construct();
		$this->load->model("webboard_bad_word_model",'webboard_bad_word');
	}
	
	function index()
	{
		//bad words
		$id_badword = 1;		
		$data['webboard_bad_words'] = $this->webboard_bad_word->get_row($id_badword);
		//bad link
		$id_badlink = 2;
		$data['webboard_bad_links'] = $this->webboard_bad_word->get_row($id_badlink);
		
		$this->template->build('admin/webboard_bad_word_index',$data);
	}
	
	function save($id=FALSE)
	{
		if($_POST)
		{			
			$_POST['user_id'] = $this->session->userdata('id');
			$this->webboard_bad_word->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('webboards/admin/webboard_bad_words');
	}
	
}