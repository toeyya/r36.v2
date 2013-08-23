<script type="text/javascript">
$(document).ready(function(){
	var ref1;
	$('select[name=province_id]').change(function(){
		ref1=$('select[name=province_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphur_id&ref1='+ref1,
			success:function(data){$("#input_amphur").html(data);}
		});
	});	//select name=province
	$("select[name=amphur_id]").live('change',function(){
		var ref2=$('select[name=amphur_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=district_id&ref1='+ref1+'&ref2='+ref2,
			success:function(data){$("#input_district").html(data);}
		})
	});
		$('#formm').validate({
			rules:{
				province_id:"required",
				amphur_id:"required",
				district_id:"required",
				hospital_type:"required",
				hospital_code_healthoffice:{
					required:true,
					number:true
				},
				hospital_name:{
					required:true,	
					remote:{
						url :"<?php echo base_url() ?>hospital/hospitalExists",
						type:"get",
						data: {							
							province_id: function () {return $('#province_id').val();	},
							amphur_id: function () {return $('#amphur_id').val();},
							district_id: function () {return $('#district_id').val();},
							hospital_id: function () {return $('#hospital_id').val();}				
					   }//close data			
					}//remote  
				}//hospital_name		
						
			},
			messages:{
				province_id:"กรุณาเลือกจังหวัด",
				amphur_id:"กรุณาเลือกอำเภอ",
				district_id:"กรุณาเลือกตำบล",
			   hospital_type:"กรุณาเลือกสังกัด",
				hospital_code_healthoffice:{
					required:"กรุณาระบุโค้ด",
					number:"ระบุค่าด้วยตัวเลขเท่านั้น"
				},
			    hospital_name:{
					required:"กรุณากรอกชื่อสถานพยาบาล",
					remote:"ชื่อสถานพยาบาลซ้ำ"
				}	
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parent());		
				if(element.attr('name')=="hospital_amphur_id")
				{
					error.appendTo(element.parent().parent());
				}					
			}					
		});
});
</script>
<h1>สถานพยาบาล(เพิ่ม/แก้ไข)</h1>
<form name="form1" action="hospital/admin/hospital/save"  method="post" id="formm" >
		<table class="form">
                <tr><th>โค้ดสถานพยาบาล</th>
                	<td><input type="text" readonly="readonly" value="<?php echo $rs['hospital_code']; ?>"><small> ระบบคำนวณอัตโนมัติ </small></td>
                </tr>
                <tr> 
                  <th width="110" height="20">จังหวัด :</th>
                  <td width="242" height="20">
					<?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$rs['hospital_province_id'],'" id="province_id"','-โปรดเลือก-') ?>				
					
				  </td>
                </tr>
                <tr> 
                  <th height="20">อำเภอ :</th>
                  <td height="20">
				  <span id="input_amphur">
						<?php 
						$class='" id="amphur_id"';
						echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur WHERE province_id='".@$rs['hospital_province_id']."' ORDER BY amphur_name ASC"),@$rs['hospital_amphur_id'],$class,'-โปรดเลือก-'); ?>
					</span>
				  </td>
                </tr>
                <tr> 
                  <th height="20">ตำบล :</th>
                  <td height="20">
				  <span id="input_district">
						<?php 
						$class=' id="district_id"';
						$wh=(@$rs['hospital_province_id'] && @$rs['hospital_amphur_id'])? "WHERE province_id='".@$rs['hospital_province_id']."' and amphur_id='".@$rs['hospital_amphur_id']."'":"";
						echo form_dropdown('district_id',get_option('district_id','district_name',"n_district  $wh  ORDER BY district_name ASC"),@$rs['hospital_district_id'],$class,'-โปรดเลือก-'); ?>						
					</span> 
				  </td>
                </tr>
                <tr> 
                  <th>สถานพยาบาล:</th>
                  <td> <input name="hospital_name" type="text" id="hospital_name" size="30" maxlength="300"  class="input_box_patient " value="<?php echo $rs['hospital_name']?>"> <span class="alertred">*</span></td>
                </tr>
                <tr>
                	<th>โค้ดสถานพยาบาล   7 หลัก :</th>
                  	<td><input name="hospital_code_healthoffice" type="text" id="hospital_code_healthoffice" size="30" maxlength="300"  class="input_box_patient " value="<?php echo $rs['hospital_code_healthoffice'] ?>"> 
                  	</td>
                </tr>
                <tr> 
                  <th height="33">สังกัด :</th>
                  <td>
				  <select name="hospital_type"  class="input_box_patient " id="hospital_type">
                      <option value="" >เลือกสังกัด</option>
                      <option value="1" <? if(@$rs['hospital_type']=='1'){echo 'selected';}?>>รัฐบาล</option>
                      <option value="2" <? if(@$rs['hospital_type']=='2'){echo 'selected';}?>>เอกชน</option>
                    </select> <span class="alertred">*</span>
	                   <input type="hidden" name="hospital_id"  id="hospital_id" value="<?php echo $rs['hospital_id'] ?>">
	                  <input type="hidden" name="hospital_code" value="<?php echo $rs['hospital_code'] ?>">
	                  <?php echo ($rs['hospital_id']) ? form_hidden('updated',time()) : form_hidden('created',time())?>
					</td>
                </tr>
                <tr>
                	<th></th>
                	<td>  <input type="submit" class="btn" value="ตกลง" name="btn_submit"></td>
                </tr>
      </table>
</form>