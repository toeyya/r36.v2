<?php
class Users extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('inform/vaccine_model','vaccine');
		$this->user->primary_key("uid");
		$this->template->append_metadata(js_idcard());	
	}	

    function inc_login()
    {   
		 $this->load->view('inc_login');      
    }

  function login()
   {
        if($_POST)
        {
            if(login($_POST['username'], $_POST['password']))
            {
                set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบค่ะ');
				if($this->session->userdata('confirm_email')=="1" && $this->session->userdata('confirm_province')=="1" && $this->session->userdata('confirm_admin')=="1"){
						redirect($_SERVER['HTTP_REFERER']);
				}else{
					 redirect('users/r36/users/index/'.$this->session->userdata('R36_UID'));
				}
              
               
            }
            else
            {
                set_notify('error', 'ชื่อผู้ใช้หรือรหัสผ่านผิดพลาดค่ะ');
               redirect($_SERVER['HTTP_REFERER']);
            }   
        }
        else
        {
            set_notify('error', 'กรุณาทำการล็อคอินค่ะ');
          redirect($_SERVER['HTTP_REFERER']);
        }       
    }
	function logout()
	{
		logout();
		redirect('home');
	}
	function register(){
			
		$this->template->build('register');
	}
	function chkHospitalcode(){
		$rs=$this->hospital->get_one("hospital_name","hospital_code_healthoffice",$_GET['userhospital']);		
		if($rs){
			$data['status']="true";
			$data['texts']=$rs;
		}else{
			$data['status']="false";
		}
		echo json_encode($data);
	}
	function forgetPassword(){
		$this->template->build('forgetpassword');
	}
	function confirm_email($id,$c)
	{	
		$id=clean_url($id);
		$result=$this->db->GetOne("SELECT uid FROM n_user WHERE uid= ? and gen_id = ? ",array($id,$c));
		if($result){
			$this->user->save(array('uid'=>$id,'confirm_email'=>'1'));
			$this->template->build('confirm_email');
		}		
	}
	function sendmail()
	{
		$rs=$this->user->get_row("usermail",$_POST['usermail']);
		if($rs){
			$subject="ลืมรหัสผ่าน (ระบบรายงานผู้สัมผัสโรคพิษสุนัขบ้า ร.36)";
			$message='<div><img src="'.base_url().'themes/default/media/images/email_head.png" width="711px" height="108px"></di>';
			$message.='<hr>';
			$message.='<p>เรียนคุณ'.$rs['userfirstname'].' '.$rs['usersurname'].', </p>';
			$message.='<p>รหัสผ่านของคุณคือ '.$rs['userpassword'].'</p>';
			$address=$_POST['usermail'];
			$redirect="users/forgetPassword";
			set_notify('success','ข้อมูลถูกส่งไปที่อีเมล์แล้ว');	
			phpmail($subject,$address,$message,$redirect);
					
		}else{
			set_notify('error','คุณระบุอีเมล์ไม่ถูกต้อง');
			redirect('users/forgetPassword');		
		}
	}
	function signup()
	{

	   $_POST['telephone'] =$_POST['tel0'].$_POST['tel1'].$_POST['tel2'];
	   $_POST['mobile'] = $_POST['mobile0'].$_POST['mobile1'].$_POST['mobile2'];
	   $_POST['fax'] =$_POST['fax0'].$_POST['fax1'].$_POST['fax2'];
	   $_POST['idcard']=$_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];
	   $_POST['gen_id']=generate_password(20);
	   $_POST['userposition']="05";//staff
	   $id=$this->user->save($_POST);
	   $subject = "ยืนยันการลงทะเบียน(ระบบรายงานผู้สัมผัสโรคพิษสุนัขบ้า ร.36)";
	    $message='<div><img src="'.base_url().'themes/default/media/images/email_head.png" width="711px" height="108px"></di>';
		$message.='<hr>';
		$message.='<p>เรียนคุณ'.$_POST['userfirstname'].' '.$_POST['usersurname'].', </p>';
		$message.='<p>username :'.$_POST['usermail'].'</p>';
		$message.='<p>password :'.$_POST['userpassword'].'</p>';
		$message.='<p>ขอบคุณสำหรับการลงทะเบียนค่ะ  ข้อมูลบัญชีของคุณจะใช้ได้เมื่อคุณยืนยันการลงทะเบียน และผ่านกระบวนการตรวจสอบค่ะ</p>';
		$message.='<p>กรุณาคลิกลิงค์ด้านล่างเพื่อยืนยันการลงทะเบียน</p>';
		$message.='<a href="'.base_url().'users/confirm_email/'.$id.'/'.$_POST['gen_id'].'">'.base_url().'users/confirm_email/'.$id.'/'.$_POST['gen_id'].'</a>';
		$redirect="users/notice_email";
		$address=$_POST['usermail'];		
		phpmail($subject,$address,$message,$redirect);
	}
	public function chkidcard()
	{	//$this->db->debug=true;		
		for($i=0;$i<13;$i++){
			$idcard_arr[]=substr($_GET['idcard'],$i,1);
		}		
		$chk=chk_idcard($idcard_arr,$_GET['digit_last']);
		$dup1=($chk=="no")? TRUE:FALSE;

		if(!empty($_GET['uid'])){
			$dup = $this->db->GetOne("select uid from n_user where idcard= ? and uid<> ? ",array($_GET['idcard'],$_GET['uid']));
		}else{
			$dup = $this->user->get_one("uid",'idcard',$_GET['idcard']);
		}
		echo ($dup1 || $dup)? "false":"true";
		
	}
	public function checkEmail(){
		if(!empty($_GET['uid'])){
			$rs=$this->db->GetOne("select uid from n_user where usermail = ?  and uid <> ? ",array($_GET['usermail'],$_GET['uid']));			
		}else{
			$rs = $this->user->get_one("uid","usermail",$_GET['usermail']);
		}		
		echo ($rs) ? "false" :"true";
	}
	function notice_email(){
		$this->template->build('notice_email');
	}

	function check_captcha()
    {
        if($this->session->userdata('captcha')==$_GET['captcha'])
        {
            echo "true";
        }
        else
        {
            echo "false";
        }
    }

	

}  
?>