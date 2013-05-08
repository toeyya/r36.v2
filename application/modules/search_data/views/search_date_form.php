<script type="text/javascript">
$(document).ready(function(){
	$('select[name=province]').change(function(){
		var ref1=$('select[name=province] option:selected').val();
		$.ajax({
			type:'get',
			url:'js/getlist.php',
			data:'mode=s_amphur&ref1='+ref1,
			success:function(data)
			{
				$("#input_amphur").html(data);
			}
		});
	});	//select name=province

		$('#formm').validate({
			rules:{
				province:"required",
				amphur:"required",
				hospital_type:"required",
				hospital_name:{
					required:true,	
					remote:{
						url :"js/getlist.php",
						type:"get",
						data: {
							mode:function(){return $('#mode').val();},
							province: function () {return $('#province').val();	},
							amphur: function () {return $('#amphur').val();},
							hospital_type:function(){return $('#hospital_type').val();}						
					   }//close data			
					}//remote  
				}//hospital_name		
						
			},
			messages:{
				province:"กรุณาเลือกจังหวัด",
				amphur:"กรุณาเลือกอำเภอ",
			   hospital_type:"กรุณาเลือกสังกัด",
			    hospital_name:{
					required:"กรุณากรอกชื่อสถานพยาบาล",
					remote:"ชื่อสถานพยาบาลซ้ำ"
				}	
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parent());						
			}					
		});
});
</script>
<form name="form1" action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post" id="formm">
		<table width="50%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#6394bd" style="empty-cells: show">		
			  	<input name="process" type="hidden" value="save" />
				<input name="mode" id="mode" type="hidden" value="chkdup_hospital_name" />
                <tr align="center" bgcolor="#6E94B7"> 
                  <td height="20" colspan="2" bgcolor="#6E94B7" class="headtable">เพิ่มข้อมูลสถานพยาบาล</td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td width="110" height="20" bgcolor="#98B9D3"  class="topic">จังหวัด :</td>
                  <td width="242" height="20">
					<?php echo form_dropdown('province',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$rs['province_id'],'class="textbox" id="province"','-โปรดเลือก-') ?>
					
					<span class="alertred">*</span>
				  </td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td height="20" bgcolor="#98B9D3" class="topic">อำเภอ :</td>
                  <td height="20">
				  <span id="input_amphur">
						<?php echo form_dropdown('amphur',get_option('amphur_id','amphur_name',"n_amphur WHERE province_id='".@$rs['province_id']."' ORDER BY amphur_name ASC"),@$rs['amphur_id'],'class="textbox" id="amphur"','-โปรดเลือก-'); ?>
					</span> <span class="alertred">*</span>
				  </td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td bgcolor="#98B9D3" class="topic">สถานพยาบาล:</td>
                  <td> <input name="hospital_name" type="text" id="hospital_name" size="30" maxlength="300"  class="textbox" value="<? //=$hospital_name?>"> <span class="alertred">*</span></td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td height="33" bgcolor="#98B9D3"  class="topic">สังกัด :</td>
                  <td>
				  <select name="hospital_type"  class="textbox" id="hospital_type">
                      <option value="" >เลือกสังกัด</option>
                      <option value="1" <? //if($hospital_type=='1'){echo 'selected';}?>>รัฐบาล</option>
                      <option value="2" <? // if($hospital_type=='2'){echo 'selected';}?>>เอกชน</option>
                    </select> <span class="alertred">*</span>
					</td>
                </tr>
                <tr align="center" bgcolor="#FFFFFF"> 
                  <td height="20" colspan="2">
				  <input type="submit" name="ok" value="ตกลง" class="Submit">  &nbsp; <input type="reset" name="reset" value="ยกเลิก"  class="Submit"></td>
                </tr>		  
      </table>
	  </form>