<script type="text/javascript">
$(document).ready(function(){
		$( "#formm" ).validate({
  			rules: {
    		name:{required:true,remote:{url:'<?php echo base_url()?>identify/admin/identify/checkIdentify',data:{id:function(){return $('#id').val()}}}}
    				},
    		messages:{
			name:{required:"กรุณาระบุประเภท",remote: "มีประเภทนี้ในระบบเเล้ว"},
			
					}
  		});
});

</script>
<h1>สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</h1>
<form action="identify/admin/identify/save" method="post" id="formm">
	<input name="id" id="id" type="hidden" value="<?php echo @$rs['id']?>" />	
<table  class="form">
	<th>ประเภท</th>
	<td><input type="text" name="name" value="<? echo $rs['name'] ?>"><label class="alertred">*</label></td>
</tr>
<tr>
	<th></th>
	<td><input class="btn" type="submit" value="ตกลง">
		<?php echo form_back('btn_back'); ?>
	</td>
</tr>
</table>

<?php echo ($rs['id']) ? form_hidden('updated',date('Y-m-d H:i:s')) : form_hidden('created',date('Y-m-d H:i:s'));
		echo form_hidden('id',$rs['id']);
		echo form_hidden('user_id',@$rs['user_id']);	
?>
</form>


