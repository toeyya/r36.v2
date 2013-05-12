<script type="text/javascript">
$(document).ready(function(){
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
});// document
</script>
<h1>ผู้ใช้ระบบ</h1>
<div class="search">
<form name="form1"  action="users/admin/users"  method="get" >

ชื่อ/นามสกุล/username<input type="text" name="name" value="<?php echo @$_GET['name'] ?>">		
<input type="submit" name="search" value="ค้นหา">		
</form>
</div>

<table  class="list" >
	  <tr>		
		<th>แสดง</th>
		<th>Username</th>
		<th>ชื่อ - นามสกุล</th>
		<th>สิทธิืการใช้งาน</th>
		<th><a href="users/admin/users/form" name="btn_add" class="btn">เพิ่มรายการ</a></th>
	  </tr>	  
		<?php foreach($result as $item): ?>
		<tr>
				<!--<<td  align="center"><nput name="chk_del[]" type="checkbox" value="<?php echo $item['uid']?>"  class="chk_del"/></td>-->
				<td><input type="checkbox"  class="list_check" name="status" value="<?php echo $item['uid'] ?>" <?php echo ($item['status']=="approve")?'checked="checked"':'' ?>  /></td>
				<td><?php echo $item['username'];?></a></td>
				<td><?php echo $item['userfirstname'];?> <?php echo $item['usersurname'];?></td>
				<td><?php echo  $item['level_name'];?></td>
				<td><a href="users/admin/users/form/<?php echo $item['uid'] ?>" alt="แก้ไขข้อมูลผู้ใช้" name="editForm"  class="btn">แก้ไข</a>
						<a href="users/admin/users/delete/<?php echo $item['uid'] ?>" alt="ลบข้อมูลผู้ใช้"   class="btn">ลบ</a>
				</td>
		</tr>
		<?php endforeach; ?>
  </table>
<?php echo $pagination ?>	