<script type="text/javascript">
$(document).ready(function(){
	$( "#formm" ).validate({
  			rules: {
    		total:{required:true,number:true},
    		name:{required:true,remote:{url:'<?php echo base_url()?>area/checkArea',data:{id:function(){return $('#id').val()}}}}
    				},
    	
    		messages:{
			name:{required:"กรุณาระบุเขตตรวจราชการ",remote: "มีเขตนี้ในระบบเเล้ว"},
			total:{required:"กรุณาระบุจำนวนเขต",number:"กรุณาระบุด้วยตัวเลข"}
					}
  		});
});
</script>
<h1>เขตตรวจราชการ(เพิ่ม/แก้ไข)</h1>
<form action="area/save" method="post" id="formm">
<input name="id" id="id" type="hidden" value="<?php echo @$rs['id']?>" />	
<table  class="form">
<tr>
	<th>ชื่อ<label class="alertred">*</label></th>
	<td><input type="text" name="name" value="<?php echo @$rs['name'] ?>"></td>
</tr>
<tr>
	<th>จำนวนเขต<label class="alertred">*</label></th>
	<td><input type="text" name="total" value="<?php echo @$rs['total'] ?>"></td>
</tr>
<tr>
	<th></th>
	<td><input class="btn" type="submit" value="ตกลง">
		<?php echo form_back('btn_back'); ?>
	</td>
</tr>
</table>

<?php echo ($rs['id']) ? form_hidden('updated',date('Y-m-d H:i:s')) : form_hidden('created',date('Y-m-d H:i:s'));
	  echo form_hidden('year',date('Y'));
	  echo form_hidden('id',$rs['id']);
?>
</form>