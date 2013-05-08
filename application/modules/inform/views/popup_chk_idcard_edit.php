<script language="javascript">
$(document).ready(function(){
	$("div#show").css('display','none');
	$('input[name=submit]').click(function(){
		var idcard;
		var fmt_idcard=$('#cardW0').val()+'-'+$('#cardW1').val()+'-'+$('#cardW2').val()+'-'+$('#cardW3').val()+'-'+$('#cardW4').val();
		if($('#statusid option:selected').val()=="1"){
			idcard=$('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val();
		}else{
			idcared=$('input[name=idpassport]').val();
		}
		
		$.ajax({
			dataType:'json',
			data:'idcard='+idcard+'&historyid='+$('input[name=historyid]').val()+'&statusid='+$('#statusid option:selected').val(),
			url:'<?php echo base_url() ?>inform/chk_idcard_edit_process',
			success:function(data){
				if(data.show=="duplicate"){
					alert(" เลขประจำตัวประชาชน/เลขที่ passport มีอยู่ในฐานข้อมูลแล้ว");
					$('#cardW0,#cardW1,#cardW2,#cardW3,#cardW4').val('');
				}else{					
					$('#show').find('label').text(fmt_idcard).end().find('input').val('กดยืนยันเพื่อใช้ ID '+fmt_idcard);
					$('#show').css('display','');
					$('#show').next().hide();					
				}
			}
		})
	});
	$('input[name=submit1]').click(function(){
		parent.$('#cardW0').val($('#cardW0').val());
		parent.$('#cardW1').val($('#cardW1').val());
		parent.$('#cardW2').val($('#cardW2').val());
		parent.$('#cardW3').val($('#cardW3').val());
		parent.$('#cardW4').val($('#cardW4').val());
		parent.$.colorbox.close();
	});
});
</script>
<table width="100%">
  <tr>
    <td>	
	<table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">		
				<div align="center" id="show"><br />
					<p style="font-weight: 700;margin-bottom: 10px;padding:10px;">รหัส <label></label> ยังไม่มีอยู่ในฐานข้อมูล</p>
					<input type="button"name="submit1" class="Submit" value="" style='width:241px;height: 22px;'/>
			  	</div>
			  	<div>
			  	<form name="form1"  method="get" id="form1">
			  			<input type="hidden" name="process" value="chk" />
			  			<input type="hidden" name="historyid" value="<?php echo $historyid ?>" />
					 	<table width="100%" cellpadding="0" cellspacing="0">
							  <tr>
									<td height="25">&nbsp;เลขประจำตัวประชาชน/เลขที่ passport : 
										<select name="statusid"  class="input_box_patient auto" onChange="return selectType_id(this.value);" id="statusid">
											<option value="1" selected="selected">เลขประจำตัวประชาชน</option>
											<option value="2">เลขที่ passport</option>
										</select></td>
							  </tr>
							  <tr>
									<td align="center" height="25">
											<span id="Show_idpassport" style="display:none">
												<input name="idpassport" type="text" class="input_box_patient auto" value="" size="20" maxlength="50" >
											</span>
											<span id="Show_idcard"> 
												<input name="cardW0" id="cardW0" type="text" class="input_box_patient auto" size="1" maxlength="1" value="" onKeyPress="return NumberOnly();" onKeyUp=" if(this.value.length==1) {this.form.cardW1.value='';this.form.cardW1.focus();}"  />
												  -
												  <input name="cardW1"  id="cardW1" type="text" class="input_box_patient auto" size="4" maxlength="4"  value="" onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==4){this.form.cardW2.value='';this.form.cardW2.focus();}"/>
												  -
												  <input name="cardW2"  id="cardW2" type="text" class="input_box_patient auto" size="5" maxlength="5"   value="" onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==5){this.form.cardW3.value='';this.form.cardW3.focus();}" />
												  -
												  <input name="cardW3" id="cardW3" type="text" class="input_box_patient auto" size="2" maxlength="2"  value="" onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==2){this.form.cardW4.value='';this.form.cardW4.focus();}" />
												  -
												<input name="cardW4" id="cardW4" type="text" class="input_box_patient auto" size="1" maxlength="1"  value=""  onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==1){FChkCardID(this.form);}"/>				
											</span>
									</td>
							  </tr>
							  <tr>
									<td align="center"><input type="button" name="submit" class="Submit" value="ตรวจสอบ" /></td>
							  </tr>
					 </table>
				<br />
				<table width="100%" border="0" align="center" cellpadding="2">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
								<div align="center">
									<font color="#FF0000">ระบบจะค้นหาข้อมูล เลขประจำตัวประชาชน/เลขที่ passport ในฐานข้อมูลทั้งหมดและสามารถใช้งานได้ในกรณีที่ข้อมูลที่ค้นหาไม่พบในฐานข้อมูล</font>
								</div>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
			  </form>
			  </div>
			</td><!-- <td align="left">-->
        </tr>
      </table>
	</td>
  </tr>
</table>