<?php
class Permissions extends Admin_Controller
{
	
	public $module = array(
		'permissions' => array('label' => 'สิทธิ์การใช้งาน', 'permission' => array('act_read','act_create','act_update','act_delete')),	
		'users' => array('label' => 'ผู้ใช้งาน', 'permission' => array('act_read','act_create','act_update','act_delete')),
		'settings' => array('label' => 'ตั้งค่าระบบโปรแกรมร.36', 'permission' => array('act_read','act_create','act_update','act_delete')),		
		'abouts' => array('label' => 'เกี่ยวกับโรคพิษสุนัขบ้า', 'permission' => array('act_read','act_create','act_update','act_delete')),			
		'identify_places' => array('label' => 'สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า', 'permission' => array('act_read','act_create','act_update','act_delete')),	
		'researchs' => array('label' => 'งานศึกษาวิจัย', 'permission' => array('act_read','act_create','act_update','act_delete')),
		'documents' => array('label' => 'เอกสารเผยแพร่', 'permission' => array('act_read','act_create','act_update','act_delete')),
		'informations' => array('label' => 'ข่าวประชาสัมพันธ์', 'permission' =>array('act_read','act_create','act_update','act_delete')),	
		'knowledge' => array('label' => 'สาระน่ารู้', 'permission' => array('act_read','act_create','act_update','act_delete')),
		'marquee' => array('label' => 'ตัววิ่ง', 'permission' => array('act_read','act_create','act_update','act_delete')),
		'webboards' => array('label' => 'เว็บบอร์ด', 'permission' => array('act_read','act_create','act_update','act_delete')),				
		'questions' => array('label' => 'คำถามที่พบบ่อย', 'permission' => array('act_read','act_create','act_update','act_delete')),
		'contact' => array('label' => 'ติดต่อเรา', 'permission' => array('act_read','act_create','act_update','act_delete')),		
		'dashboards' => array('label' => 'จำนวนคนเข้าเว็บไซต์', 'permission' => array('act_read')),
		'logs'=>array('label' => 'ประวัติเข้าใช้ระบบ', 'permission' => array('act_read')),
		'program'=>array('label' => 'โปรแกรม ร.36', 'permission' => array('act_read','act_create','act_update','act_delete')),
		'email' =>array('label' => 'อีเมล์แจ้งข่าวสาร', 'permission' => array('act_read','act_create'))
	);
	
	public $crud = array(
		'act_read' => 'ดู',
		'act_create' => 'เพิ่ม',
		'act_update' => 'แก้ไข',
		'act_delete' => 'ลบ',
		'act_download' => 'ดาวน์โหลด'
	);
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users/user_model','user');
		$this->load->model('users/user_level_model','level');
		$this->load->model('permission_model','permission');
		$this->level->primary_key="lid";
	}
	
	public function index()
	{
		$data['level'] = $this->level->sort("")->order("level_code asc")->get();
		$data['pagination'] = $this->level->pagination();
		$chk_delete = $this->user->select("userposition")->groupby("userposition")->sort("")->order("userposition asc")->get();
		foreach($chk_delete as $key=>$item){
			$level[]=$item['userposition'];
		}
			
		$data['chk_delete'] = $level;
		$this->template->build('admin/permission_index',$data);
	}
	
	
	public function form($id=FALSE){
	
		
		$data['level'] = $this->level->get_row($id);
		$data['rs_perm'] = $this->permission_row($id);
		$data['module'] = $this->module;
		$data['crud'] = $this->crud;
		$this->template->build('admin/permission_form',$data);
	}
	
	public function permission_row($user_type_id)
	{
		if($user_type_id)
		{
			//$perms = new Permission();
			$perms = $this->permission->where("level_id = ".$user_type_id)->get();
			foreach($perms as $item)
			{
				$perm[$item['module']] = array(
					'act_read' => $item['act_read'],
					'act_create' => $item['act_create'],
					'act_update' => $item['act_update'],
					'act_delete' => $item['act_delete'],
					'act_download' => $item['act_download']
				);
			}
			return @$perm;
		}
		else return NULL;
	}
	
	public function save($id=FALSE)
	{
	  //$this->db->debug=true;
		if($_POST){
			$this->level->primary_key('lid');
			$max_id=$this->db->getOne("select max(lid) from n_level_user");
			$_POST['level_code']=(empty($_POST['level_code'])) ? "0".$max_id :$_POST['level_code'];
			$id=$this->level->save($_POST);
			$this->permission->delete("level_id",$id);				
			if(isset($_POST['checkbox'])){
				foreach($_POST['checkbox'] as $module => $item)
				{
					$data['level_id'] = $id;
					$data['module'] = $module;
					foreach($item as $perm => $val) $data[$perm] =  $val;							
						$this->permission->save($data);
						$data = array();					
				}	
			}
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect("permissions/admin/permissions/index");
	}
	
	public function delete($id){
		if($id){
			$this->permission->delete("level_id",$id);
			$this->level->delete("lid",$id);
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function chkPermission(){
		//$this->db->debug=true;
		if(!empty($_GET['lid'])){
			$rs = $this->db->GetOne("select lid from n_level_user where level_name = ?  and lid <> ? ",array($_GET['level_name'],$_GET['lid']));			
		}else{
			$rs = $this->level->get_one("lid","level_name",$_GET['level_name']);
			
		}		
		echo (!empty($rs)) ? "false" :"true";
		
	}

}
?>