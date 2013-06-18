<script type="text/javascript" src="media/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" type="text/css" href="media/js/jquery-ui-1.10.3.custom/css/cupertino/jquery-ui-1.10.3.custom.css">
<script type="text/javascript">
$(document).ready(function(){
$( "#check" ).button();
$( ".format" ).buttonset();
var ref1,ref2,ref3;
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
   			$.post("<?php echo base_url() ?>users/admin/users/save",{uid:this.value ,'confirm_province':value});
   		}else{
   			$.post("<?php echo base_url(); ?>users/admin/users/save",{uid:this.value ,'confirm_admin':value});
   		}
		
	}); 
   
});// document
</script>
<h1>ผู้ใช้ระบบ</h1>
<div class="search">
<form name="form1"  action="users/admin/users"  method="get" >
ชื่อ/นามสกุล/สถานบริการ <input type="text" name="name" value="<?php echo @$_GET['name'] ?>">		
<?php echo form_dropdown('userposition',get_option('level_code','level_name','n_level_user'),@$_GET['userposition'],'','เลือกสิทธิ์การใช้งาน') ?>
<button type="submit" name="search"  class="btn">ค้นหา</button>	
</form>
</div>

<table  class="list" >
	  <tr>		
		<th>แสดง</th>
		<th>ชื่อ - นามสกุล</th>
		<th>สิทธิ์การใช้งาน</th>
		<th>สถานบริการ</th>
		<th>การอนุมัติ</th>

		<th width="90"><a href="users/admin/users/form" name="btn_add" class="btn">เพิ่มรายการ</a></th>
	  </tr>	  
		<?php foreach($result as $key => $item): ?>
		<tr>
				<!--<<td  align="center"><nput name="chk_del[]" type="checkbox" value="<?php echo $item['uid']?>"  class="chk_del"/></td>-->
				<td><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['uid'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>				
				<td><?php echo $item['userfirstname'];?> <?php echo $item['usersurname'];?></td>
				<td><?php echo $item['level_name'];?></td>
				<td><?php echo  $item['hospital_name']?></td>
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
				<td><a href="users/admin/users/form/<?php echo  $item['uid'] ?>" alt="แก้ไขข้อมูลผู้ใช้" name="editForm"  class="btn">แก้ไข</a>
						<a href="users/admin/users/delete/<?php echo $item['uid'] ?>" alt="ลบข้อมูลผู้ใช้"   class="btn">ลบ</a>
				</td>
		</tr>
		<?php endforeach; ?>
  </table>
<?php echo $pagination ?>	