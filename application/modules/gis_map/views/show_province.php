<script language="javascript">
$(document).ready(function(){
	
				
			    $('#province').change(function() {
					
					
			    var txt = $("#province").val();
				
				//alert(txt);
						
						$("#show_amphur").load("gis_map/show_aumphur/"+txt);
						

				});
				
	});			
</script>

<?php

		$where = "";
		
		if($mode == 'm_sec')
		{
				
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
				
				$tbProvince = $this->db->query("SELECT * FROM n_province where province_id in(".$where.") ");
		
		}
		elseif($mode = 'm_area')
		{
				
				$tbProvince = $this->db->query("SELECT * FROM n_province where province_level_old =".$id);
		}
		
	   
		
		

?>

                    <select name="province" id="province" class="textbox widthselect" style=" width:130px;">
                        <option value="0">ทั้งหมด</option>					
                        <?php
                            
                            
							foreach ($tbProvince->result_array() as $row)
							{
								if($_GET['province']==$row['province_id']){ $s = 'selected'; }else{ $s = ''; }
								
                                echo "<option value='".$row['province_id']."' ".$s.">".$row['province_name']."</option>";
                            }
                
                        
                        ?>
                    </select>
                    