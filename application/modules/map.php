<?php
class Map extends Map_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->load->model('log_model','log');
		$this->load->model('province_model','prov');
		$this->load->model('history_model','hist');
		$this->load->model('information_model','informa');
		
		$this->load->database();
		
	}
	function index()
	{	
		$data['title'] = "ระบบสารสนเทศภูมิศาสตร์ของโปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า";
		$data['heading'] = "ความเสี่ยงของการถูกกัด  คือ ประวัติฉีดวัคซีน 1 เข็ม";
			
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


		
		//*********************  4 ภาค
		

				
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
		
		
		$this->template->build('gis_map',$data);
		
	}
	
	
	
	function map_section($id = null){
	
	
		$data['title'] = "ระบบสารสนเทศภูมิศาสตร์ของโปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า";
		$data['heading'] = "ความเสี่ยงของการถูกกัด  คือ ประวัติฉีดวัคซีน 1 เข็ม";
			
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


		
		//*********************  4 ภาค
		

				
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
       /* $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');*/
		$this->template->build('gis_map_section', $data);
	}
	
	
	
	function show_list_table()
	{
			
			
		$data['title'] = "ระบบสารสนเทศภูมิศาสตร์ของโปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า";
		$data['heading'] = "รายการจำนวนประชากรประจำจังหวัด";
			
		$dateStart = date("Y")."-01-01";
		$dateEnd = date("Y")."-12-31";	
				
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
		
	

		$this->template->build('list_table',$data);
	}
	
	
	function show_province()
	{
		$data['title'] = "ระบบสารสนเทศภูมิศาสตร์ของโปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า";
		$data['heading'] = "รายการจำนวนประชากรประจำจังหวัด";
		
		$data['query'] = $this->db->query("SELECT * FROM n_province where province_id in(50,51,52,53,54,55,56,57,58) ");
		
		
		$this->template->build('list_province',$data);
	}
	
	function combine2(){
		
			$this->template->build('index-dataapi-combine2');
	}
	
	
	function test_db()
	{
			
			//$data['result'] = $this->db->query("select * from n_province order by province_id asc");
			$data['query'] = $this->db->get('n_province');
			


/*			foreach ($query->result_array() as $row)
			{
			   echo $row['title'];
			   echo $row['name'];
			   echo $row['body'];
			}*/
			
		$data['todo_list'] = array('GIS Map1', 'GIS Map2', 'GIS Map3');

		$data['title'] = "ระบบสารสนเทศภูมิศาสตร์ของโปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า";
		$data['heading'] = "รายการจำนวนประชากรประจำจังหวัด";

		$this->load->view('test_db', $data);
	}
	
	function demo_1()
	{
		$this->template->build('ex_1');	
	}
	
	function demo_2()
	{
		$this->template->build('ex_2');
	}
	
	function demo_3()
	{
		$this->template->build('ex_3');
	}
	
	function show_amp()
	{
		$data['pid']=10;
		$this->template->build('show_amphur',$data);
	}
	
	function show_dis()
	{
		$data['pid']=10;
		$data['aid']=01;
		$this->template->build('show_dis',$data);
	}
	
	function show_section()
	{
		$this->template->build('gis_section');
	}

}
?>
