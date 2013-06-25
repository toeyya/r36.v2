<script language="javascript">
$(document).ready(function(){

	$("div#show").css('display','none');
	$('[name=submit]').click(function(e){
		$('#Show_idcard').next().html('');
		var idcard,fmt_idcard;		
		if($('#statusid option:selected').val()=="1"){
			idcard=$('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val();
			fmt_idcard=$('#cardW0').val()+'-'+$('#cardW1').val()+'-'+$('#cardW2').val()+'-'+$('#cardW3').val()+'-'+$('#cardW4').val();
		}else{
			idcard=$('input[name=idpassport]').val();
			fmt_idcard=idcard;
			if(idcard==''){
				$('#Show_idcard').next().html('ระบุไม่ถูกต้อง');
				return true;
			}
		}
		
		$.ajax({
			dataType:'json',
			data:'idcard='+idcard+'&historyid='+$('input[name=historyid]').val()+'&statusid='+$('#statusid option:selected').val(),
			url:'<?php echo base_url() ?>inform/chk_idcard_edit_process',
			success:function(data){
				if(data.format=="no"){
					$('#Show_idcard').next().html('ระบุไม่ถูกต้อง');
				}else if(data.show=="duplicate"){
					alert(" เลขประจำตัวประชาชน/เลขที่ passport มีอยู่ในฐานข้อมูลแล้ว");
					$('#cardW0,#cardW1,#cardW2,#cardW3,#cardW4').val('');				
				}else{					
					$('#show').find('label').text(fmt_idcard).end().find('button').html('กดยืนยันเพื่อใช้ ID '+fmt_idcard);
					$('#show').css('display','');
					$('#show').next().hide();					
				}
			}
		})
		e.preventDefault();
	});
	
	$('[name=submit1]').click(function(){
		if($('#statusid option:selected').val()=="1"){
			parent.$('#cardW0').val($('#cardW0').val());
			parent.$('#cardW1').val($('#cardW1').val());
			parent.$('#cardW2').val($('#cardW2').val());
			parent.$('#cardW3').val($('#cardW3').val());
			parent.$('#cardW4').val($('#cardW4').val());
		}else{
			parent.$("#statusid option").filter(function(){return $(this).val() == $('#statusid option:selected').val()}).prop('selected', 'selected');
			parent.$('input[name=idpasspost]').val($('input[name=idpassport]').val());
		}
		//parent.$.colorbox.close();
	});
});
</script>
<h5>ตรวจสอบบัตรประชาชนหรือ passport</h5>
<hr class="class1">
<div align="center" id="show">
	<p style="font-weight: 700;margin-bottom: 10px">รหัส <label></label> ยังไม่มีอยู่ในฐานข้อมูล</p>
	<button type="button" name="submit1" class="btn btn-primary"></button>
	
</div>
<form name="form1"  method="get" id="form1">
	<input type="hidden" name="process" value="chk" />
	<input type="hidden" name="historyid" value="<?php echo $historyid ?>" />
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td height="50">&nbsp;เลขประจำตัวประชาชน/passport : 
			<select name="statusid"  class="input_box_patient auto" onChange="return selectType_id(this.value);" id="statusid">
				<option value="1" selected="selected">เลขประจำตัวประชาชน</option>
				<option value="2">เลขที่ passport</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center" height="25">
			<span id="Show_idpassport" style="display:none">
				<input name="idpassport" type="text" class="auto" value="" size="20" maxlength="50" >
			</span>
			<span id="Show_idcard"> 
				<input name="cardW0" id="cardW0" type="text" class="input_box_patient auto" size="1" maxlength="1"  value="" />  -
				<input name="cardW1" id="cardW1" type="text" class="input_box_patient auto" size="4" maxlength="4" value="" />  -
				<input name="cardW2" id="cardW2" type="text" class="input_box_patient auto" size="5" maxlength="5" value="" />  -
				<input name="cardW3" id="cardW3" type="text" class="input_box_patient auto" size="2" maxlength="2" value="" />  -
				<input name="cardW4" id="cardW4" type="text" class="input_box_patient auto" size="1" maxlength="1" value="" />				
			</span>
			<label class="alertred"></label>
		</td>
	 </tr>
	 <tr>
		<td align="center"><button name="submit" type="button" class="btn btn-small btn-primary">ตรวจสอบ</butto</td>
	 </tr>
</table>
</form>

<div class="alert alert-info" style="margin-top:50px;">ระบบจะค้นหาข้อมูล เลขประจำตัวประชาชน/passport ในฐานข้อมูลทั้งหมด และสามารถใช้งานได้ในกรณีที่ข้อมูลที่ค้นหาไม่พบในฐานข้อมูล</div>

