<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 		
        	<?php 
				
				set_time_limit(0);
				// สูตร	=	จำนวนผู้สัมผัสโรคของอำเภอนั้นๆ แสดงเป็นจุด
			
				$cdate=date("Y-m-d H:i:s");
				
				//province
				$sql0 = "select * from n_province order by province_id asc Limit 0,2";
		
				$query0 = $this->db->query($sql0);
		
				foreach ($query0->result_array() as $row0)
				{	
					
					echo $row0['province_name'];
					
					$province_name = $row0['province_name'];
					$province_id = $row0['province_id'];
					
					echo "<br>";
					
					// amphur
					$sql = "SELECT amp.*,pro.province_name
					FROM
					n_amphur as amp
					INNER JOIN n_province as pro
					 ON pro.province_id = amp.province_id
					WHERE
					amp.province_id = ".$row0['province_id']." order by amp_pro_id asc Limit 0,10";
		
				$query1 = $this->db->query($sql);
		
				foreach ($query1->result_array() as $row)
				{
					echo ">".$row['amphur_name'];
					echo "<br>";
					
					$amp_id = $row['amphur_id'];
										// district
					$sq2 = "SELECT *
					FROM
					n_district
					WHERE
					amphur_id = ".$row['amphur_id']." order by tam_amp_id asc Limit 0,10";
		
					$query2 = $this->db->query($sq2);
			
					foreach ($query2->result_array() as $row1)
					{
					
					
						
						$query3 = $this->db->query("SELECT * FROM n_information where provinceidplace='".$row1['province_id']."' AND amphuridplace='".$row1['amphur_id']."' AND districtidplace='".$row1['district_id']."'");
						
						$amp_info_count = $query3->num_rows();
						
						
						if(number_format($amp_info_count,0) > 80 )
						{
							$color = "#F00";
						}
						elseif(number_format($amp_info_count,0) > 60 )
						{
							$color = "#F60";
						}
						elseif(number_format($amp_info_count,0) > 40 )
						{
							$color = "#0F0";
						}
						elseif(number_format($amp_info_count,0) > 20 )
						{
							$color = "#FF0";
						}
						else
						{
							$color = "#FF0";
						}
						
						$dis_name = $row1['district_name'];
						$dis_id = $row1['district_id'];
						$dis_value = $row1['province_id'].$row1['amphur_id'].$row1['district_id'];
					
						echo "-";
						echo "{name: '".$dis_name."',y: ".$amp_info_count.",color :'".$color."'},";
						echo "<br>";
						
						$data = array(
						   'name' => $dis_name ,
						   'no_ppe' => $dis_info_count ,
						   's_value' => $dis_value,
						   'up_date' => $cdate,
						   'id_province' => $province_id,
						   'id_amphur' => $amp_id,
						   'id_district' => $dis_id,
						   'risk_color' => $color
						);
						
						$this->db->insert('summary_district', $data); 
						
/*						$data = array(
						   'title' => $title,
						   'name' => $name,
						   'date' => $date
						);
			
						$this->db->where('id', $id);
						$this->db->update('mytable', $data); */
												
						
						// end save 

					}
					
				}
				
				}
				
				echo "<br>";
				echo "<br>";
				
				echo "save success!!";
				
			?>