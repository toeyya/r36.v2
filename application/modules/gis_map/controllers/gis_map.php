<?php
class Gis_map extends Map_Controller
{
	function __construct()
	{
		parent::__construct();

		//$this->load->model('history_model','hist');
		//$this->load->model('information_model','informa');*/
		
		$this->load->database();
		
	}
	function index()
	{	

		
			
			
		$dateStart = date("Y")."-01-01";
		$dateEnd = date("Y")."-12-31";	
	
		$this->db->from("n_province");
		$this->db->order_by("province_id", "asc");
		$data['tbProvince'] = $this->db->get(); 
		
		$this->db->from("n_amphur");
		$this->db->order_by("amp_pro_id", "asc");
		$data['tbAmp'] = $this->db->get(); 
		
		$this->db->from("n_district");
		$this->db->order_by("tam_amp_id", "asc");
		$data['tbDis'] = $this->db->get(); 

		$this->db->from("n_hospital");
		$this->db->order_by("hospital_id", "asc");
		$data['tbHos'] = $this->db->get(); 
		

		//150756 get table summary 
		$this->db->from("summary_sector");
		$this->db->order_by("id", "asc");
		$data['tbSumS_pie'] = $this->db->get(); 
		
		$this->db->from("summary_sector");
		$this->db->order_by("id", "asc");
		$data['tbSumS'] = $this->db->get(); 
		
		$this->template->build('gis_map',$data);
		
	}
	
	
	
	function map_section($id = null){
	

			
		$dateStart = date("Y")."-01-01";
		$dateEnd = date("Y")."-12-31";
		
		$where = "";
		
		if($id==0)
		{
			$where .= "81,86,92,80,96,94,82,93,83,95,85,90,91,84";
		}
		elseif($id==1)
		{
			$where .= "50,51,52,53,54,55,56,57,58";
		}
		elseif($id==2)
		{
			$where .= "37,31,36,46,40,42,44,48,49,30,39,43,45,47,32,33,34,35,41";
			
		}
		elseif($id==3)
		{
			$where .= "10,62,18,26,73,60,12,13,14,66,65,67,16,11,75,74,17,19,72,64,15,61";
			
		}
		
		$dateStart = date("Y")."-01-01";
		$dateEnd = date("Y")."-12-31";	
	

		$data['tbProvince'] = $this->db->query("SELECT * FROM n_province 
 where province_id in(".$where.") ");
		
		$data['tbAmp'] = $this->db->query("SELECT * FROM n_amphur 
 where province_id in(".$where.") "); 
		
		//$this->db->from("n_district");
		//$this->db->order_by("tam_amp_id", "asc");
		$data['tbDis'] = $this->db->query("SELECT * FROM n_district 
 where province_id in(".$where.") "); 

		$data['tbHos'] = $this->db->query("SELECT * FROM n_hospital 
 where hospital_province_id in(".$where.") ");
		
		
		$data['S_province_all'] = $this->db->query("SELECT * FROM summary_province order by id asc");


		$data['S_province_js'] = $this->db->query("SELECT * FROM summary_province order by id asc");
 
		$data['S_province_pie'] = $this->db->query("SELECT * FROM summary_province 
 where s_value in(".$where.") ");
		
		$data['S_province'] = $this->db->query("SELECT * FROM summary_province 
 where s_value in(".$where.") ");
 		

 
 		$data['S_province_list'] = $this->db->query("SELECT * FROM summary_province 
 where s_value in(".$where.") ");
	

		

        $data['map_id'] = $id;
       /* $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');*/
		$this->template->build('gis_map_section', $data);
	}
	
	//140756 province
	
	function map_province($id = null,$pid = null)
	{	

		$dateStart = date("Y")."-01-01";
		$dateEnd = date("Y")."-12-31";	
	

			//data for dropdownlist
		$data['tbProvince'] = $this->db->query("SELECT * FROM n_province 
 where province_id=".$pid);
		
		$data['tbAmp'] = $this->db->query("SELECT * FROM n_amphur 
 where province_id=".$pid); 
		
		$data['tbDis'] = $this->db->query("SELECT * FROM n_district 
 where province_id=".$pid); 

		$data['tbHos'] = $this->db->query("SELECT * FROM n_hospital 
 where hospital_province_id=".$pid);
		//---------
		
  		$data['S_amphur_js'] = $this->db->query("SELECT * FROM summary_amphur 
 where id_province=".$pid);
 
 		$data['S_amphur_pie'] = $this->db->query("SELECT * FROM summary_amphur 
 where id_province=".$pid);
 
 		$data['S_amphur_list'] = $this->db->query("SELECT * FROM summary_amphur 
 where id_province=".$pid);
 
  		$data['S_amphur_data'] = $this->db->query("SELECT * FROM summary_amphur 
 where id_province=".$pid);
 
 		//get li,lo
 
  		$GI_province = $this->db->query("SELECT * FROM summary_province where s_value=".$pid);
 		
		
		if ($GI_province->num_rows() > 0)
		{
		   $row = $GI_province->row_array(); 
		
		   $data['li'] = $row['li'];
		   $data['lo'] = $row['lo'];

		}
		
		$data['map_id'] = $id;
		$data['pro_id'] = $pid;
		
		$this->template->build('gis_province', $data);
		
	}
	
	//190756 amphur
	
	function map_amphur($id = null,$pid = null,$aid = null)
	{	

		$dateStart = date("Y")."-01-01";
		$dateEnd = date("Y")."-12-31";	
	

			//data for dropdownlist
		$data['tbProvince'] = $this->db->query("SELECT * FROM n_province 
 where province_id=".$pid);
		
		$data['tbAmp'] = $this->db->query("SELECT * FROM n_amphur 
 where province_id=".$pid); 
		
		$data['tbDis'] = $this->db->query("SELECT * FROM n_district 
 where province_id=".$pid); 

		$data['tbHos'] = $this->db->query("SELECT * FROM n_hospital 
 where hospital_province_id=".$pid);
		//---------
		

 		$data['S_district_js'] = $this->db->query("SELECT * FROM summary_district 
 where id_province=".$pid." AND id_amphur=".$aid);
 
 		$data['S_district_pie'] = $this->db->query("SELECT * FROM summary_district 
 where id_province=".$pid." AND id_amphur=".$aid);
 
 		$data['S_district_list'] = $this->db->query("SELECT * FROM summary_district 
 where id_province=".$pid." AND id_amphur=".$aid);
 
  		$data['S_district_data'] = $this->db->query("SELECT * FROM summary_district 
 where id_province=".$pid." AND id_amphur=".$aid);
 
		
		$data['map_id'] = $id;
		$data['pro_id'] = $pid;
		$data['amp_id'] = $aid;
		
	    $GI_province = $this->db->query("SELECT * FROM summary_province where s_value=".$pid);
 		
		
		if ($GI_province->num_rows() > 0)
		{
		   $row = $GI_province->row_array(); 
		
		   $data['li'] = $row['li'];
		   $data['lo'] = $row['lo'];

		}
		
		$this->template->build('gis_tumbon', $data);
		
	}
	
	
	# create update summary data ****************************************************************************************************************************
		
	function save_sector()
	{
		     	$this->db->from("n_information");
		$this->db->where("datetouch BETWEEN '2556-01-01' AND '2556-12-31'");
		$this->db->order_by("id", "asc");
		$this->db->limit(10);
		
		
		$data['tbInfor'] = $this->db->get();
		
		 
		//จำนวนผู้เข้ารับการรักษา 
		 // ภาคเหนือ ปี 2556
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace in(50,51,52,53,54,55,56,57,58) ");

		$data['tbInfor_count_n'] = $query->num_rows();
		$tbInfor_count_n = $query->num_rows();
				 // ภาคอีสาน ปี 2556
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace in(37,31,36,46,40,42,44,48,49,30,39,43,45,47,32,33,34,35,41) ");

		$data['tbInfor_count_en'] = $query->num_rows();
		
		$tbInfor_count_en = $query->num_rows();
		
				 // ภาคเกลาง ปี 2556
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace in(10,62,18,26,73,60,12,13,14,66,65,67,16,11,75,74,17,19,72,64,15,61) ");

		$data['tbInfor_count_m'] = $query->num_rows();
		
		$tbInfor_count_m = $query->num_rows();
				 // ภาคใต้ ปี 2556
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace in(50,51,52,53,54,55,56,57,58) ");

		$data['tbInfor_count_s'] = $query->num_rows();
		
		$tbInfor_count_s = $query->num_rows();
		
			
		
		//จำนวนประชากรแต่ละภาค	
		
		$query = $this->db->query("SELECT sum(provincepeople) as psum FROM n_province where province_id in(50,51,52,53,54,55,56,57,58) ");

		//$noth1 = $query->num_rows();
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $noth1 = $row->psum;
		   $data['noth1'] = $row->psum;
		}
		
		
		
		$query = $this->db->query("SELECT sum(provincepeople) as psum  FROM n_province where province_id in(37,31,36,46,40,42,44,48,49,30,39,43,45,47,32,33,34,35,41) ");

		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $noth_eath1 = $row->psum;
		   $data['noth_eath1'] = $row->psum;
		}
		
		
		$query = $this->db->query("SELECT sum(provincepeople) as psum  FROM n_province where province_id in(10,62,18,26,73,60,12,13,14,66,65,67,16,11,75,74,17,19,72,64,15,61) ");

		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $middle = $row->psum;
		   $data['middle'] = $row->psum;
		}
		
		$query = $this->db->query("SELECT sum(provincepeople) as psum  FROM n_province where province_id in(81,86,80,96,94,82,93,83,85,91,84,90,92) ");
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $south = $row->psum;
		   $data['south'] = $row->psum;
		}	
			
			
		$data['section1'] = ($tbInfor_count_n / $noth1) * 100000;
		$data['section2'] = ($tbInfor_count_en / $noth_eath1) * 100000;
		$data['section3'] = ($tbInfor_count_m / $middle) * 100000;
		$data['section4'] = ($tbInfor_count_s / $south) * 100000;
		
		//************************* จบ 4 ภาค
		
		if($id==1){
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(50,51,52,53,54,55,56,57,58) ");
		}elseif($id==3){
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(37,31,36,46,40,42,44,48,49,30,39,43,45,47,32,33,34,35,41) ");
		}elseif($id==2){
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(10,62,18,26,73,60,12,13,14,66,65,67,16,11,75,74,17,19,72,64,15,61) ");
		}elseif($id==0){
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(81,86,80,96,94,82,93,83,85,91,84,90,92) ");
		}
		//************************* จบ 4 ภาค
		

		

        $data['map_id'] = $id;
		$this->template->build('admin/sector', $data);		
	}
	
	
	
	function save_province($id = null)
	{
					
     	$this->db->from("n_information");
		$this->db->where("datetouch BETWEEN '2556-01-01' AND '2556-12-31'");
		$this->db->order_by("id", "asc");
		$this->db->limit(10);
		
		
		$data['tbInfor'] = $this->db->get();
		
		 
		//จำนวนผู้เข้ารับการรักษา 
		 // ภาคเหนือ ปี 2556
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace in(50,51,52,53,54,55,56,57,58) ");

		$data['tbInfor_count_n'] = $query->num_rows();
		$tbInfor_count_n = $query->num_rows();
				 // ภาคอีสาน ปี 2556
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace in(37,31,36,46,40,42,44,48,49,30,39,43,45,47,32,33,34,35,41) ");

		$data['tbInfor_count_en'] = $query->num_rows();
		
		$tbInfor_count_en = $query->num_rows();
		
				 // ภาคเกลาง ปี 2556
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace in(10,62,18,26,73,60,12,13,14,66,65,67,16,11,75,74,17,19,72,64,15,61) ");

		$data['tbInfor_count_m'] = $query->num_rows();
		
		$tbInfor_count_m = $query->num_rows();
				 // ภาคใต้ ปี 2556
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace in(50,51,52,53,54,55,56,57,58) ");

		$data['tbInfor_count_s'] = $query->num_rows();
		
		$tbInfor_count_s = $query->num_rows();
		
			
		
		//จำนวนประชากรแต่ละภาค	
		
		$query = $this->db->query("SELECT sum(provincepeople) as psum FROM n_province where province_id in(50,51,52,53,54,55,56,57,58) ");

		//$noth1 = $query->num_rows();
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $noth1 = $row->psum;
		   $data['noth1'] = $row->psum;
		}
		
		
		
		$query = $this->db->query("SELECT sum(provincepeople) as psum  FROM n_province where province_id in(37,31,36,46,40,42,44,48,49,30,39,43,45,47,32,33,34,35,41) ");

		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $noth_eath1 = $row->psum;
		   $data['noth_eath1'] = $row->psum;
		}
		
		
		$query = $this->db->query("SELECT sum(provincepeople) as psum  FROM n_province where province_id in(10,62,18,26,73,60,12,13,14,66,65,67,16,11,75,74,17,19,72,64,15,61) ");

		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $middle = $row->psum;
		   $data['middle'] = $row->psum;
		}
		
		$query = $this->db->query("SELECT sum(provincepeople) as psum  FROM n_province where province_id in(81,86,80,96,94,82,93,83,85,91,84,90,92) ");
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $south = $row->psum;
		   $data['south'] = $row->psum;
		}	
			
			
		$data['section1'] = ($tbInfor_count_n / $noth1) * 100000;
		$data['section2'] = ($tbInfor_count_en / $noth_eath1) * 100000;
		$data['section3'] = ($tbInfor_count_m / $middle) * 100000;
		$data['section4'] = ($tbInfor_count_s / $south) * 100000;
		
		//************************* จบ 4 ภาค
		
		if($id==1){
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(50,51,52,53,54,55,56,57,58) ");
		}elseif($id==3){
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(37,31,36,46,40,42,44,48,49,30,39,43,45,47,32,33,34,35,41) ");
		}elseif($id==2){
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(10,62,18,26,73,60,12,13,14,66,65,67,16,11,75,74,17,19,72,64,15,61) ");
		}elseif($id==0){
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(81,86,80,96,94,82,93,83,85,91,84,90,92) ");
		}
		//************************* จบ 4 ภาค
		

		

        $data['map_id'] = $id;
		$this->template->build('admin/save_province', $data);	
	}
	
	function save_amphur($pid = null,$aid = null)
	{
					
		
		 
		//จำนวนผู้เข้ารับการรักษา จังหวัด
	
	

        $data['p_id'] = $pid;
		$data['a_id'] = $aid;
		
		$this->template->build('admin/save_amphur', $data);	
	}
	
	function save_district($pid = null,$aid = null,$did = null)
	{
					
		//สูตร	=	จำนวนผู้สัมผัสโรคของอำเภอนั้นๆ แสดงเป็นจุด
		
						
        $data['p_id'] = $pid;
		$data['a_id'] = $aid;
		$data['d_id'] = $did;
		
		$this->template->build('admin/save_district', $data);	
	}
	
	
		# create update summary data ****************************************************************************************************************************
	
	
	
	function test_db()
	{
		$data['title'] = "ระบบสารสนเทศภูมิศาสตร์ของโปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า";
		$data['heading'] = "ความเสี่ยงของการถูกกัด  คือ ประวัติฉีดวัคซีน 1 เข็ม";
		
		$where = "";
		
		$data['query'] = $this->db->query("SELECT * FROM n_province order by province_id asc");
		$this->template->build('test_db', $data);
	}
	
	function test_section()
	{
		$this->load->view("gis_section");	
	}
	
	function map_place($id = null,$pid = null,$aid = null,$did = null)
	{
		
		
		$data['tbProvince'] = $this->db->query("SELECT * FROM n_province 
 where province_id=".$pid);
		
		$data['tbAmp'] = $this->db->query("SELECT * FROM n_amphur 
 where province_id=".$pid." AND amphur_id=".$aid); 
		
		$data['tbDis'] = $this->db->query("SELECT * FROM n_district 
 where province_id=".$pid." AND amphur_id=".$aid." AND district_id=".$did); 

		$data['tbHos_map'] = $this->db->query("SELECT * FROM n_hospital_1 
 where hospital_province_id=".$pid." AND hospital_amphur_id=".$aid." AND hospital_district_id=".$did);
 
 		$data['tbHos'] = $this->db->query("SELECT * FROM n_hospital_1 
 where hospital_province_id=".$pid." AND hospital_amphur_id=".$aid." AND hospital_district_id=".$did);
		//---------
		

 		$data['S_district_js'] = $this->db->query("SELECT * FROM summary_district 
 where id_province=".$pid." AND id_amphur=".$aid." AND id_district=".$did);
 
 		$data['S_district_pie'] = $this->db->query("SELECT * FROM summary_district 
 where id_province=".$pid." AND id_amphur=".$aid." AND id_district=".$did);
 
 		$data['S_district_list'] = $this->db->query("SELECT * FROM summary_district 
 where id_province=".$pid." AND id_amphur=".$aid);
 
  		$data['S_district_data'] = $this->db->query("SELECT * FROM summary_district 
 where id_province=".$pid." AND id_amphur=".$aid." AND id_district=".$did);
 
		
		$data['map_id'] = $id;
		$data['pro_id'] = $pid;
		$data['amp_id'] = $aid;
		$data['dis_id'] = $did;
		
		$GI_province = $this->db->query("SELECT * FROM summary_province where s_value=".$pid);
 		
		
		if ($GI_province->num_rows() > 0)
		{
		   $row = $GI_province->row_array(); 
		
		   $data['li'] = $row['li'];
		   $data['lo'] = $row['lo'];

		}
		
		$GI_dis = $this->db->query("SELECT * FROM summary_district where id_province=".$pid." AND id_amphur=".$aid." AND id_district=".$did);
 		
		
		if ($GI_dis->num_rows() > 0)
		{
		   $rowd = $GI_dis->row_array(); 
		
		   $risk_color0 = $rowd['risk_color'];
		   $risk_color = str_replace('#',' ',$risk_color0);
		   				
				
				if($risk_color == 'F00')
				{
					 $data['risk_color'] = 'FF0000'; 
				}
				elseif($risk_color == 'F60')
				{
					$data['risk_color'] = 'FA6000'; 
				}
				elseif($risk_color == '0F0')
				{
					$data['risk_color'] = 'A7FA00'; 
				}
				elseif($risk_color == 'FF0')
				{
					$data['risk_color'] = 'FCFF91'; 
				}
				else
				{
					$data['risk_color'] = 'FCFF91'; 	
				}
		   
		  
		   $data['s_value'] = $rowd['s_value'];

		}
		
		$this->template->build('map_place', $data);
		
		//$this->load->view("map_place");
			
	}

	//*************** SEARCH DATA 280756
	function gis_search()
	{
		
		// list search *****************************************
		
		
		$where = '';
		$where2 = '';
		$pid = '';
		$aid = '';
		$did = '';
		
		    $id = $_GET['section'];
			
			if(!empty($_GET['province']))
			{
				$pid = $_GET['province']; 
			}
			
			if(!empty($_GET['amphur']))
			{			
				$aid = $_GET['amphur'];
			}
			
			if(!empty($_GET['district']))
			{			
				$did = $_GET['district']; 
			}
			
			if(!empty($_GET['sdate']))
			{			
				$sdate = $_GET['sdate']; 
			}

			if(!empty($_GET['edate']))
			{			
				$edate = $_GET['edate']; 
			}

			
			
			
        if(!empty($_GET))
        {

			
			
			if(!empty($_GET['section'])) {$where .= ' AND hospitalprovince = '.$_GET['section'];  }	
			
			if(!empty($_GET['sdate'])) {$where .= " AND datetouch between '".$sdate."' and '".$edate."' ";  }			
			
			
			
			if(!empty($_GET['province'])) {$where .= ' AND hospitalprovince = '.$_GET['province']; }
			if(!empty($_GET['amphur'])) {$where .= ' AND hospitalamphur = '.$_GET['amphur'];  }
			if(!empty($_GET['district'])) {$where .= ' AND hospitaldistrict = '.$_GET['district']; }
			
			//hospitalcode
			if(!empty($_GET['hospital'])) $where .= " AND hospitalcode = '".$_GET['hospital']."' ";

			// type age
			if(!empty($_GET['age'])) $where .= ' AND age = '.$_GET['age'];
			
			// type gender
			//if(!empty($_GET['sex'])) $where .= ' AND gender = '.$_GET['sex'];
			
			// type animal
			if(!empty($_GET['ani'])) $where .= ' AND typeanimal = '.$_GET['ani'];
			
			//use_rig
			if(!empty($_GET['rig'])) $where .= ' AND use_rig = '.$_GET['rig'];
			
			//total_vaccine
			if(!empty($_GET['qty'])) $where .= ' AND total_vaccine = '.$_GET['qty'];
			  
        }
       // $sql = 'SELECT * FROM n_information INNER JOIN n_history ON n_history.historyid = n_information.information_historyid WHERE 1=1 '.$where.' ORDER BY n_information.id ASC';
		
		// end search parameter
		
		// data for province 
		
		
/*		$id = $_GET['section']; 
		$pid = $_GET['province'];
		$aid = $_GET['amphur'];
		$did = $_GET['district'];*/
		
		//ภาค 0,1,2,3 ใต้ , เหนือ , อีสาน , กลาง

		//ตำบล
		if($did != 0)
		{
			
		} //อำเภอ
		elseif($aid != 0)
		{
				$did = '01';	
		} // จังหวัด
		elseif($pid != 0)
		{
			
				$aid = '01';
				$did = '01';
		}
		else
		{
						
				$id = '3';
				$pid = '12';
				$aid = '01';
				$did = '02';
				
		}
		
		$table = 'summary_district';
		$where2 .= " AND id_province='".$pid."' AND id_amphur='".$aid."' AND id_district='".$did."' ";
		
		
		//---------
		
 		$data['S_district_js'] = $this->db->query("SELECT * FROM ".$table." where 1=1 ".$where2);
 
 		$data['S_district_pie'] = $this->db->query("SELECT * FROM ".$table." where 1=1 ".$where2);
 
 		$data['S_district_list'] = $this->db->query("SELECT * FROM ".$table." where 1=1 ".$where2);
 
  		$data['S_district_data'] = $this->db->query("SELECT * FROM ".$table." where 1=1 ".$where2);
 
		
		$data['map_id'] = $id;
		$data['pro_id'] = $pid;
		$data['amp_id'] = $aid;
		$data['dis_id'] = $did;
		
	    $GI_province = $this->db->query("SELECT * FROM summary_province where s_value=".$pid);
 		
		
		if ($GI_province->num_rows() > 0)
		{
		   $row = $GI_province->row_array(); 
		
		   $data['li'] = $row['li'];
		   $data['lo'] = $row['lo'];

		}
		
		//----end data
		
		
		
       // $data['search_data'] = $this->db->query($sql);
		
		
		//echo $where2;
		$this->template->build('gis_search', $data);		
	}
	
	
	function show_province($id = null,$mode = null)
	{
		$data['mode'] = $mode;
		$data['id'] = $id;
		$this->template->build('show_province',$data);
	}
	
	function show_aumphur($id = null)
	{
		$data['pid'] = $id;
		$this->template->build('show_amphur',$data);
	}

	function show_district($pid = null,$aid = null)
	{
		$data['pid'] = $pid;
		$data['aid'] = $aid;
		$this->template->build('show_dis',$data);
	}
	
	function show_place($pid = null,$aid = null,$did = null)
	{
		$data['pid'] = $pid;
		$data['aid'] = $aid;
		$data['did'] = $did;
		$this->template->build('show_place',$data);
	}
	
	function show_map1()
	{
		$this->load->view("search_map");
	}
	
	function admins()
	{
		$this->load-view("admin/index");	
	}
	
	function show_ex1()
	{
		$this->template->build('ex_1');  //show div image
	}
	
	function show_ex2()
	{
		$this->template->build('ex_2');   //show market
	}
	
	function show_ex3()
	{
		$this->template->build('ex_3');   //draw line 
	}
	
	function show_search()
	{
		$this->template->build('search_map');   //draw line 
	}
	
	
}
?>
