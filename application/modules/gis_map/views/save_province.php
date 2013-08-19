			<?php 
			
				$cdate=date("Y-m-d H:i:s");
			
				foreach ($query->result_array() as $row)
				{
					
						$province_count = 0;
						$province_percent = 0;
						
						$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace=".$row['province_id']);
						
						$province_count = $query->num_rows();
						
						$province_percent = ($province_count / $row['provincepeople']) * 100000;
						
						if(number_format($province_percent,0) > 80 )
						{
							$color = "#F70707";
						}
						elseif(number_format($province_percent,0) > 60 )
						{
							$color = "#FA6000";
						}
						elseif(number_format($province_percent,0) > 40 )
						{
							$color = "#00FF00";
						}
						elseif(number_format($province_percent,0) > 20 )
						{
							$color = "#FAC802";
						}
						
						$province_name = $row['province_name'];
					
	
						echo "{name: '".$province_name."',y: ".number_format($province_percent,2).",color :'".$color."'},";
						echo "<br>";
						
						$data = array(
						   'name' => $province_name ,
						   'no_ppe' => $province_count ,
						   'rate_ppe' => $province_percent,
						   'pop' => $row['provincepeople'],
						   's_value' => '0',
						   'up_date' => $cdate
						);
						
						$this->db->insert('summary_province', $data); 
						
/*						$data = array(
						   'title' => $title,
						   'name' => $name,
						   'date' => $date
						);
			
						$this->db->where('id', $id);
						$this->db->update('mytable', $data); */
												
						
						// end save 

				}
				
				echo "save success!!";
				
			?>