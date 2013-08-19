<script type="text/javascript">
$(document).ready(function(){
	$( "#formm" ).validate({
  			rules: {
    		
    		name:{required:true,remote:{url:'<?php echo base_url()?>research/admin/research/checkRea'}}
    				},
    	
    		messages:{
			name:{required:"กรุณาระบุประเภท",remote: "มีประเภทนี้ในระบบเเล้ว"},
			
					}
  		});
});
</script>
<h1>งานศึกษาวิจัย</h1>
<form action="research/admin/research/save" method="post" id="formm">
<table  class="form">
	<th>ประเภท</th>
	<td><input type="text" name="name" value="<? echo $rs['name'] ?>"></td>
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


