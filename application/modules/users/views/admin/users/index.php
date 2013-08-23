<script type="text/javascript" src="media/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" type="text/css" href="media/js/jquery-ui-1.10.3.custom/css/cupertino/jquery-ui-1.10.3.custom.css">
<script type="text/javascript">
$(document).ready(function(){
$( "#check" ).button();
$( ".format" ).buttonset();
var ref1,ref2,ref3,ref4,ref5,ref6;
	$("#h_province").change(function(){	
		 ref1=$("#h_province option:selected").val();
		
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',data:'name=h_amphur&ref1='+ref1,
			success:function(data)
			{
				$("#input_Hamphur").html(data);
				$("#hosptal option[value='']").attr('selected','selected');
			}
		});
	});
	$("#h_amphur").live('change',function(){	
	 ref2=$("#h_amphur option:selected").val();
			$.ajax({
				url:'<?php echo base_url(); ?>district/getDistrict',data:'name=h_district&ref1='+ref1+'&ref2='+ref2,
				success:function(data)
				{
					$("#input_District").html(data);
				}
			});	
	});			
	$('#h_district').live('change',function(){
		ref3=$("#h_district option:selected").val();
			$.ajax({
				url:'<?php echo base_url(); ?>hospital/getHospital',data:'ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,
				success:function(data)
				{
					$("#input_Hospital").html(data);
				}
			});	
	})
	
	$("select[name=userprovince]").change(function(){		  
	  ref4=$("select[name=userprovince] option:selected").val();
		$("#td_amphur").html('<img src="media/images/loader.gif" width="16px" height="11px">');
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',data:'name=useramphur&ref1='+ref4,
			success:function(data)
			{
				$("#td_amphur").html(data);

			}
		});
	});
	$("select[name=useramphur]").live('change',function(){	
	 ref5=$("select[name=useramphur] option:selected").val();
	 $("#td_district").html('<img src="media/images/loader.gif" width="16px" height="11px">');
			$.ajax({
				url:'<?php echo base_url(); ?>district/getDistrict',data:'name=userdistrict&ref1='+ref4+'&ref2='+ref5,
				success:function(data)
				{
					$("#td_district").html(data);
					$("select[name=userdistrict] option[value='']").attr('selected','selected');
					$("select[name=userhospital] option[value='']").attr('selected','selected');
				}
			});	
	});			
	$('select[name=userdistrict]').live('change',function(){
		$("#td_hospital").html('<img src="media/images/loader.gif" width="16px" height="11px">');
		ref6=$("select[name=userdistrict] option:selected").val();
			$.ajax({
				url:'<?php echo base_url(); ?>hospital/getHospital',data:'name=userhospital&ref1='+ref4+'&ref2='+ref5+'&ref3='+ref6,
				success:function(data)
				{
					$("#td_hospital").html(data);									
				}
			});	
	})

	
   $('input[name=del]').click(function(){
	   	if($('.chk_del').is(':checked')){
		   	  if(confirm('คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลนี้')){ 	  			   	  		
		   	  	    var id = [];
			        $('input[name=chk_del[]]:checked').each(function(i){
			          	id[i] = $(this).val();
		        	});
		        	
		        	$.ajax({
		        		url:'<?php echo base_url() ?>user/delete',
		        		data:'id='+id,
		        		success:function(data){
		        			   $('input[name=chk_del[]]:checked').closest('tr').hide();    
		        			   $('input[name=chk_del[]]').removeAttr('checked');     			  		 
		        		}
		        	})
		   	  }
	   }else{
	   	 	alert('คุณยังไม่ได้เลือกรายการที่ต้องการลบค่ะ');
	   }
   });

   	$(".format input:checkbox").click(function(){	
		var value = this.checked ? 1 : 0;
		var title=$(this).next().find('span').html();
		if(title=="ระดับจังหวัด")
		{
   			$.post("<?php echo base_url() ?>users/admin/users/save",{uid:this.value ,'confirm_province':value}
   			,function(){
   				$.notifyBar({
				  		cls:"success",
				    	html: "บันทึกข้อมูลเรียบร้อยแล้วค่ะ",
				    	delay: 500,
				    	animationSpeed: "normal"
					});  
   				});
   		}else{
   			$.post("<?php echo base_url(); ?>users/admin/users/save",{uid:this.value ,'confirm_admin':value}
   			,function(){
   				$.notifyBar({
				  		cls:"success",
				    	html: "บันทึกข้อมูลเรียบร้อยแล้วค่ะ",
				    	delay: 500,
				    	animationSpeed: "normal"
					});  
   				});
   		}
		
	}); 
   
});// document
</script>
<h1>ผู้ใช้ระบบ</h1>
<div class="search">
<form name="form1"  action="users/admin/users" >
<table class="form">
	<tr>
	<th style="width:10%">ชื่อ/นามสกุล</th>
	<td ><input type="text" name="name" value="<?php echo @$_GET['name'] ?>"></td>
	<?php if($this->session->userdata('R36_LEVEL')=="00"){  ?>
	<th style="width:10%">สิทธิ์การใช้งาน</th>
	<td><?php echo form_dropdown('userposition',get_option('level_code','level_name','n_level_user'),@$_GET['userposition'],'','เลือกสิทธิ์การใช้งาน') ?></td>
	<?php } ?>
	</tr>
	<tr>
		<th>จังหวัด</th>
		<td><?php 
		if($this->session->userdata('R36_LEVEL')!="00"){
			$_GET['userprovince']= $this->session->userdata('R36_PROVINCE');
		}
		echo form_dropdown('userprovince',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['userprovince'],'class="styled-select"','-ทั้งหมด-')?>	</td>
		<th>อำเภอ</th>
		<td id="td_amphur">
			<?php if(!empty($_GET['useramphur']) && !empty($_GET['userprovince'])){ 
			 	$wh =" province_id ='".$_GET['userprovince']."' and amphur_id='".$_GET['useramphur']."'"; 
				echo form_dropdown('useramphur',get_option('amphur_id','amphur_name',"n_amphur where $wh order by amphur_name asc"),$_GET['useramphur'],'','-ทั้งหมด-');
			}else{
				$wh=""; ?>
				<select name="useramphur"><option value="">-ทั้งหมด-</option></select>
			<?php } ?>													
		</td>
		<th>ตำบล</th>
		<td id="td_district">
			<?php if(!empty($_GET['userdistrict'])){ 
			 	$wh =" province_id ='".$_GET['userprovince']."' and amphur_id='".$_GET['useramphur']."' and district_id ='".$_GET['userdistrict']."'"; 
				echo form_dropdown('useramphur',get_option('district_id','district_name',"n_district where $wh order by district_name asc"),$_GET['userdistrict'],'','-ทั้งหมด-');
			}else{
				$wh=""; ?>
				<select name="userdistrict"><option value="">-ทั้งหมด-</option></select>
			<?php } ?>							
		</td>
		<th style="width:10%">สถานบริการ</th>
		<td id="td_hospital">
			<?php 
			if(!empty($_GET['userhospital'])){							
				echo form_dropdown('userhospital',get_option('hospital_code','hospital_name','n_hospital order by hospital_name asc'),$_GET['userhospital'],'','-ทั้งหมด-');
			}else{ ?>
				<select name="userhospital"><option value="">-ทั้งหมด-</option></select>
			<?php }  ?>
			
			
		</td>		
	</tr>	
</table>
<button type="submit" name="search"  class="btn">ค้นหา</button>	
</form>
</div>

<table  class="list" >
	  <tr>	  
		<th>แสดง</th>		
		<th>ชื่อ - นามสกุล</th>
		<th>สิทธิ์การใช้งาน</th>
		<th>สถานบริการ/หน่วยงาน</th>
		<th>จังหวัด</th>
		<th style="width:20%;text-align:center;">การอนุมัติ</th>
		
		<th width="90">
			<?php if(permission('users', 'act_create')):?>
			<a href="users/admin/users/form" name="btn_add" class="btn">เพิ่มรายการ</a>
			<?php endif; ?>
		</th>
	  </tr>	  
		<?php foreach($result as $key => $item): ?>
		<tr>				
				<td><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['uid'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>								
				<td><?php echo $item['userfirstname'];?> <?php echo $item['usersurname'];?></td>
				<td><?php echo $item['level_name']; echo (!empty($item['userlevel'])) ? "(เขตที่  ".$item['userlevel'].")" :'';?></td>
				<td><?php echo (!empty($item['hospital_name'])) ? $item['hospital_name']: $item['agency'] ?></td>
				<td><?php $province_name = $this->db->GetOne("SELECT province_name FROM n_province 
															  LEFT JOIN n_hospital_1 ON province_id = hospital_province_id 
															  WHERE hospital_code='".$item['userhospital']."'"); 
						echo ($item['userposition']=="02") ? $item['province_name'] : ThaitoUtf8($province_name);
					?>				
				</td>
				<td>
					<div class="format">
						<?php if($this->session->userdata('R36_LEVEL')=='00' || $this->session->userdata('R36_LEVEL')=="02"): ?>
						<input type="checkbox"   id="check1<?php echo $key;?>"  value="<?php echo $item['uid'] ?>" <?php echo ($item['confirm_province']=="1") ? 'checked="checked"':'' ; ?> />
						<label for="check1<?php echo  $key;?>">ระดับจังหวัด</label>
							<? if($this->session->userdata('R36_LEVEL')=="00"): ?>
						<input type="checkbox"   id="check2<?php echo $key; ?>"   value="<? echo $item['uid'] ?>" <?php echo ($item['confirm_admin']=="1") ? 'checked="checked"':'' ; ?>/>
						<label for="check2<?php echo $key; ?>">ระดับกรม</label>
							<? endif; ?>
						<? endif; ?>
					</div>
				</td>
				
				<td><?php if(permission('users', 'act_update')):?>
					<a href="users/admin/users/form/<?php echo  $item['uid'] ?>" alt="แก้ไขข้อมูลผู้ใช้" name="editForm"  class="btn">แก้ไข</a>
				    <?php endif; ?>
				    <?php if(permission('users', 'act_delete')):?>
				    <a href="users/admin/users/delete/<?php echo $item['uid'] ?>" alt="ลบข้อมูลผู้ใช้" onclick="confirm('ยืนบันการลยข้อมูล')"  class="btn">ลบ</a>
					<?php endif; ?>
				</td>
		</tr>
		<?php endforeach; ?>
  </table>
<?php echo $pagination ?>	