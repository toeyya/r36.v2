<script type="text/javascript">
$(document).ready(function(){
	$( "#formm" ).validate({
  			rules: {
    		identify_id:{required:true},
    		telephone:{required:true},
    		fax:{required:true},
    		email:{required:true},
    		address:{required:true},
    		name:{required:true,//remote:{url:'<?php //echo base_url()?>a/rea/checkArea',data:{id:function(){return $('#id').val()}}}}
    				}},
    	
    		messages:{
			identify_id:{required:"กรุณาระบุประเภท"},
			telephone:{required:"กรุณาระบุโทรศัพท์"},
			fax:{required:"กรุณาระบุโทรสาร"},
			email:{required:"กรุณาระบุอิเมล์"},
			address:{required:"กรุณาระบุที่อยู่"},
			name:{required:"กรุณาระบุส่วนราชการ"}
					}
  		});
});
</script>

<h1>สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</h1>
<form action="identify/admin/identify_detail/save" method="post" id="formm">
<table  class="form">
<tr>
	<th>ประเภท</th>
	<td><?php echo form_dropdown('identify_id',get_option('id','name',"n_identify where active='1'"),$identify_id,'','--โปรดเลือก--') ?>
		<label class="alertred">*</label>
	</td>
</tr>
<tr>
	<th>ส่วนราชการ</th>
<td><input type="text" name="name" value="<?php echo $rs['name'] ?>">
	<label class="alertred">*</label>
</td>
</tr>
<tr>
	<th>โทรศัพท์</th>
	<td><textarea  name="telephone"  cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['telephone'] ?></textarea>
		<label class="alertred">*</label>
	</td>
</tr>
<tr>
	<th>โทรสาร</th>
	<td><textarea name="fax" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['fax'] ?></textarea>
		<label class="alertred">*</label>
	</td>
</tr>
<tr>
	<th>อีเมล์</th>
	<td><textarea name="email" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['email'] ?></textarea><label class="alertred">*</label></td>
</tr>
<tr>
	<th>ที่อยู่</th>
	<td><textarea name="address" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['address'] ?></textarea><label class="alertred">*</label></td>
</tr>

<tr>
	<th></th>
	<td><input class="btn" type="submit" value="ตกลง">
		<?php echo form_back('btn_back'); ?>
	</td>
</tr>
</table>

<?php echo ($rs['id']) ? form_hidden('updated',date('Y-m-d H:i:s')) : form_hidden('created',date('Y-m-d H:i:s'));
			echo form_hidden('user_id',@$rs['user_id']);
			echo form_hidden('id',@$rs['id']);
?>
</form>


