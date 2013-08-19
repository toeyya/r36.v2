<script language="javascript">

				$('#district').change(function() {
					
					
			    var pid = $("#province").val();
				var aid = $("#amphur").val();
				var did = $("#district").val();
				
						
				$("#show_place").load("gis_map/show_place/"+pid+"/"+aid+"/"+did);
						

				});
				

</script>

<?php

		//$aid = $_GET['aid'];

		//$this->load->database();

		$this->db->from("n_district");
		$this->db->where('province_id', $pid); 
		$this->db->where('amphur_id', $aid); 
		$this->db->order_by("tam_amp_id", "asc");
		
		$tbAmp = $this->db->get(); 

?>

                    <select name="district" id="district" class="textbox widthselect" style=" width:130px;">
                        <option value="0">ทั้งหมด</option>					
                        <?php
                            
                            
                            foreach ($tbAmp->result() as $row)
                            {
								
								if($_GET['district']==$row->district_id){ $s = 'selected'; }else{ $s = ''; }
								
                                echo "<option value='".$row->district_id."' ".$s.">".$row->district_name."</option>";
                            }
                
                        
                        ?>
                    </select>
                    
                    