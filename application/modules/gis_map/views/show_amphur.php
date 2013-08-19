<script language="javascript">
$(document).ready(function(){
	
				
				$('#amphur').change(function() {
					
					
			    var pid = $("#province").val();
				var aid = $("#amphur").val();
				
						
				$("#show_district").load("gis_map/show_district/"+pid+"/"+aid);
						

				});
				
	});			
</script>

<?php

		//$pid = $_GET['pid'];
		
		//$pid = 10;

		//$this->load->database();

		$this->db->from("n_amphur");
		$this->db->where('province_id', $pid); 
		$this->db->order_by("amp_pro_id", "asc");
		
		$tbAmp = $this->db->get(); 

?>

                    <select name="amphur" id="amphur" class="textbox widthselect" style=" width:130px;">
                        <option value="0">ทั้งหมด</option>					
                        <?php
                            
                            
                            foreach ($tbAmp->result() as $row)
                            {
								if($_GET['amphur']==$row->amphur_id){ $s = 'selected'; }else{ $s = ''; }
                                echo "<option value='".$row->amphur_id."'> ".$s."".$row->amphur_name."</option>";
                            }
                
                        
                        ?>
                    </select>
                    
                    