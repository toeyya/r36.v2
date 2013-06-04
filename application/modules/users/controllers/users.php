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
			}	

    function inc_login()
    {   $this->db->debug=TRUE;
		 $this->load->view('inc_login');      
    }

  function login()
   {
        if($_POST)
        {
            if(login($_POST['username'], $_POST['password']))
            {
                set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบค่ะ');
              redirect('inform/index');
               
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
		echo ($rs) ? $rs:"false";
	}
	function forgetPassword(){
		$this->template->build('forgetpassword');
	}
	function test()
	{
			$connectionInfo = array('Database'=>'R36', 'UID'=>'sa','PWD'=>'1234');
			$connection = sqlsrv_connect('DT-ARMORY',$connectionInfo); 

			echo "connection =". $connection;

			$result = sqlsrv_query( $connection,  'select * from dbo.n_user where uid = (?) ' , array( 5 ));
			$retErrors = sqlsrv_errors(SQLSRV_ERR_ALL);
			if($retErrors != null) {
				$_errorMsg=false;
				foreach($retErrors as $arrError) {
				$_errorMsg .= "SQLState: ".$arrError[ 'SQLSTATE']."\n";
				$_errorMsg .= "Error Code: ".$arrError[ 'code']."\n";
				$_errorMsg .= "Message: ".$arrError[ 'message']."\n";
				}
			}	
			echo $_errorMsg;	
			while($row = sqlsrv_fetch_array($result))			
			{		
			    echo($row['ID'] . ', '.$row['Title'] . ', '.$row['Name']);		
			}
			echo php_info();
	}
}  
?>