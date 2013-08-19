<?php

		//$aid = $_GET['aid'];

		//$this->load->database();

		$this->db->from("n_hospital_1");
		$this->db->where('hospital_province_id', $pid); 
		$this->db->where('hospital_amphur_id', $aid); 
		$this->db->where('hospital_district_id', $did); 
		$this->db->order_by("hospital_id", "asc");
		
		$tbH = $this->db->get(); 

?>

                    <select name="hospital" id="hospital" class="textbox widthselect" style=" width:130px;">
                        <option value="0">ทั้งหมด</option>					
                        <?php
                            
                            
                            foreach ($tbH->result() as $row)
                            {
                                echo "<option value='".$row->hospital_code."'>".$row->hospital_name."</option>";
                            }
                
                        
                        ?>
                    </select>
                    
                    