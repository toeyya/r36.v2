<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 		
        	<?php 
			
				//สูตร	=	จำนวนผู้รับวัคซีนของอำเภอนั้นๆ 
			
				$cdate=date("Y-m-d H:i:s");
				
				//province
				$sql0 = "select * from n_province order by province_id asc";
		
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
					amp.province_id = ".$row0['province_id'];
		
				$query1 = $this->db->query($sql);
		
				foreach ($query1->result_array() as $row)
				{
					
						
						$query2 = $this->db->query("SELECT * FROM n_information where provinceidplace='".$row['province_id']."' AND amphuridplace='".$row['amphur_id']."'");
						
						$amp_info_count = $query2->num_rows();
						
						//$amp_percent = ($amp_info_count / $row['provincepeople']) * 100000;
						//$amp_info_count = 0;
						$amp_percent = 0;
						
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
						
						$amp_name = $row['amphur_name'];
						$amp_id = $row['amphur_id'];
						$amp_value = $row['province_id'].$row['amphur_id'];
					
						echo "-";
						echo "{name: '".$amp_name."',y: ".$amp_info_count.",color :'".$color."'},";
						echo "<br>";
						
						$data = array(
						   'name' => $amp_name ,
						   'no_ppe' => $amp_info_count ,
						   's_value' => $amp_value,
						   'up_date' => $cdate,
						   'id_province' => $province_id,
						   'id_amphur' => $amp_id,
						   'risk_color' => $color
						);
						
						$this->db->insert('summary_amphur', $data); 
						
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
				
				echo "<br>";
				echo "<br>";
				
				echo "save success!!";
				
			?>