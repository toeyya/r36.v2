<?php
class Profiles extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
	}
	
	function index()
	{	
		$data['rs'] = $this->user->get_row("uid",$this->session->userdata('R36_UID'));	
		$this->template->build('admin/profiles/index',$data);
	}	

	function save()
	{
		if($_POST)
		{
			$id = $this->user->save($_POST);
			if($_FILES['image']['name'])
			{
				$this->user->delete_file($id,'uploads/user/','image');
				$this->user->delete_file($id,'uploads/user/thumbnail/','image');
				
				$this->user->save(array('id' => $id, 'image' => $this->user->upload($_FILES['image'],'uploads/user/')));
				$this->user->thumb('uploads/user/thumb/',USER_IMG_WIDTH,USER_IMG_HEIGHT);
			} 
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('users/admin/profiles/');
	}
	
	
	function remove_image($id)
	{
		$this->user->delete_file($id,'uploads/user/','image');
		$this->user->delete_file($id,'uploads/user/thumb/','image');
		
		$this->user->save(array('id' => $id, 'image' => NULL));
		set_notify('success', REMOVE_IMAGE_COMPLETE);
		redirect('user/admin/user/form/'.$id);	
	}
	
}
?>