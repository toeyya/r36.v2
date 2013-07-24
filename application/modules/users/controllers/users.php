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
		$this->load->model('district/district_model','district');
		$this->load->model("province/province_model",'province');
		$this->load->model("amphur/amphur_model",'amphur');	
		$this->load->model('hospital/hospital_model','hospital');
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
		$data['result']=$this->db->GetRow("SELECT uid,confirm_admin,confirm_province FROM n_user WHERE uid= ? and gen_id = ? ",array($id,$c));
		if($data['result']['uid']){
			$this->user->save(array('uid'=>$id,'confirm_email'=>'1'));
			$this->template->build('confirm_email',$data);
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
	   $_POST['hospital_id']=$this->hospital->get_one("hospital_id","hospital_code_healthoffice",$_POST['userhospital']);
	   $_POST['userposition']="05";
	   $id=$this->user->save($_POST);
	   
	   $subject = "ยืนยันการลงทะเบียน(ระบบรายงานผู้สัมผัสโรคพิษสุนัขบ้า ร.36)";
	    $message='<div><img src="'.base_url().'themes/default/media/images/email_head.png" width="711px" height="108px"></di>';
		$message.='<hr>';
		$message.='<p>เรียนคุณ'.$_POST['userfirstname'].' '.$_POST['usersurname'].', </p>';
		$message.='<p>ขอบคุณสำหรับการลงทะเบียนค่ะ  ข้อมูลบัญชีของคุณจะใช้ได้เมื่อ</p>';
		$message.="<p>1. ยืนยันการลงทะเบียน </p>";
		$message.="<p>2. ผ่านการตรวจสอบและอนุมัติจากผู้ดูแลระบบ </p>";
		$message.='<p>กรุณาคลิกลิงค์ด้านล่างเพื่อยืนยันการลงทะเบียน</p>';
		$message.='<a href="'.base_url().'users/confirm_email/'.$id.'/'.$_POST['gen_id'].'">'.base_url().'users/confirm_email/'.$id.'/'.$_POST['gen_id'].'</a>';
		$redirect="users/notice_email";
		$address=$_POST['usermail'];		
		phpmail($subject,$address,$message,$redirect);
	}
	public function chkidcard($register=FALSE)
	{	// ผู้สัมผัสโรคไม่เช็คการซ้ำกัน
		//ผู้ลงทะเบียนห้ามกรอกเลขบัตรซ้ำ;
		for($i=0;$i<13;$i++){
			$idcard_arr[]=substr($_GET['idcard'],$i,1);
		}		
		$chk=chk_idcard($idcard_arr,$_GET['digit_last']);
		$dup1=($chk=="no")? true:false;
		
		if($register=="register"){
			$dup = $this->user->get_one('idcard','idcard',$_GET['idcard']);			
			echo ($dup1 || $dup)? "false":"true";
			return true;
		}

		if(empty($_GET['uid'])){
			echo ($chk=="no")? "false":"true";
			
		}else{
			$dup = $this->db->GetOne("select idcard from n_user where idcard = ? and uid <> ? ",array($_GET['idcard'],$_GET['uid']));					
			echo ($dup1 || $dup)? "false":"true";
		}
	
	
	}
	public function checkEmail(){
		//$this->db->debug=true;
		if(!empty($_GET['uid'])){
			$rs = $this->db->GetOne("select uid from n_user where usermail = ?  and uid <> ? ",array($_GET['usermail'],$_GET['uid']));			
		}else{
			$rs = $this->user->get_one("uid","usermail",$_GET['usermail']);
		}		
		echo (!empty($rs)) ? "false" :"true";
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
	function getProvince(){
		$name=(isset($_GET['name']))?$_GET['name']:'province_id';
		if($_GET['ref1']){
			$wh=($name=="provinceidplace")?" WHERE province_id='".$_GET['ref1']."'":"";	
		}else{$wh="";}
			
		echo form_dropdown($name,get_option('province_id','province_name','n_province '.$wh.' ORDER BY province_name ASC'),@$_GET['ref1'],' class="styled-select" id="'.$name.'"','-โปรดเลือก-');
	}
	function getAmphur(){		
		$name=(isset($_GET['name']))? $_GET['name']:"amphur_id";
		$mode=(isset($_GET['mode']))?$_GET['mode']:'';		
		$class=(isset($_GET['class']))?" styled-select ".$_GET['class']:"styled-select";
		
		$default=(isset($_GET['default']))?"ทั้งหมด":'-โปรดเลือก-';
		if($_GET['ref1']){
			if($mode=="place_amppattaya")
			{
				echo '<select class="styled-select" name="amphuridplace"  id="amphuridplace">';
				echo '<option value="" selected="selected">เมืองพัทยา</option>';
				echo  '</select>';				
			}else{											
				echo form_dropdown($name,get_option('amphur_id','amphur_name'," n_amphur where province_id='".$_GET['ref1']."' ORDER BY amphur_name ASC"),'',' class="'.$class.'" id="'.$name.'"',$default);		
			}
		}else{
				echo '<select class="'.$class.'" name="'.$name.'"  id="'.$name.'">';
				echo '<option value="" selected="selected">'.$default.'</option>';
				echo  '</select>';				
		}// $_GET['ref1']				
	}
	function getDistrict()
	{
		$name=(isset($_GET['name']))? $_GET['name']:"district_id";	
		$class=(isset($_GET['class']))?" styled-select ".$_GET['class']:"styled-select";			
		$special=' class="'.$class.'" id="'.$name.'"';	

		$default=(isset($_GET['default']))?"ทั้งหมด":'-โปรดเลือก-';
		if($_GET['ref1'] && $_GET['ref2']){
			echo form_dropdown($name,get_option('district_id','district_name'," n_district WHERE province_id='".$_GET['ref1']."' AND amphur_id ='".$_GET['ref2']."' ORDER BY district_name ASC"),'',$special,$default);
		}else{
				echo '<select class="'.$class.'" name="'.$name.'"  id="'.$name.'">';
				echo '<option value="" selected="selected">'.$default.'</option>';
				echo  '</select>';	
		}		
	}
	function getHospital()
	{
		$name=(isset($_GET['name']))?$_GET['name']:'hospital';
		$class=(isset($_GET['class']))?" styled-select ".$_GET['class']:"styled-select";			
		$special=' class="'.$class.'" id="'.$name.'"';		
		$default=(isset($_GET['default']))?"ทั้งหมด":'-โปรดเลือก-';
		if($_GET['ref1'] || $_GET['ref2'])
		{
			$wh="WHERE hospital_province_id='".$_GET['ref1']."' and hospital_amphur_id='".$_GET['ref2']."' and hospital_district_id='".$_GET['ref3']."' ORDER BY hospital_name ASC";				
			echo form_dropdown($name,get_option('hospital_code','hospital_name',"n_hospital_1 $wh"),'',$special,$default);
		}else{
			$output = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'">';
	   		$output.= '<option value="" selected="selected">'.$default.'</option>';
	   		$output.='</select>';
	   		echo $output;			
		}
	}
	function getHospitalId()
	{
		$name=(isset($_GET['name']))?$_GET['name']:'hospital';
		$class=(isset($_GET['class']))?" styled-select ".$_GET['class']:"styled-select";			
		$special=' class="'.$class.'" id="'.$name.'"';		
		$default=(isset($_GET['default']))?"ทั้งหมด":'-โปรดเลือก-';
		if($_GET['ref1'] || $_GET['ref2'])
		{
			$wh="WHERE hospital_province_id='".$_GET['ref1']."' and hospital_amphur_id='".$_GET['ref2']."' and hospital_district_id='".$_GET['ref3']."' ORDER BY hospital_name ASC";				
			echo form_dropdown($name,get_option('hospital_id','hospital_name',"n_hospital_1 $wh"),'',$special,$default);
		}else{
			$output = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'">';
	   		$output.= '<option value="" selected="selected">'.$default.'</option>';
	   		$output.='</select>';
	   		echo $output;			
		}
	}	

}  
?>