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
				success:function(data){$("#input_District").html(data);}
			});	
	});			
	$('#h_district').live('change',function(){
		ref3=$("#h_district option:selected").val();
			$.ajax({
				url:'<?php echo base_url(); ?>hospital/getHospital',data:'ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,
				success:function(data){$("#input_Hospital").html(data);}
			});	
	});
	if ($("input[name=userposition]").is(":checked")){ChkShow();	}	
	$("#form1").validate({
		rules:{
				userfirstname:"required",
				usersurname:"required",
				usersurname:"required",
				userprovince:"required",
				h_province:"required",
				h_amphur:"required",
				hospital:"required",
				usermail:{
					required:true,
					email:true
					remote{
						
					}
					
				}
				userpassword:"required",
				repassword:{
					required:true,
					 equalTo: "#userpassword"
				},
				username:{
					required:true,
					remote:{
						url :"js/getlist.php",
						type:"get",
						data:{
							mode:function(){
								return $("#mode").val();
							},
							uid:function(){
								return $("#uid").val();
							}
						}// data
					}// remote
				}// username				
		},
		messages:{
				userfirstname:"กรุณาระบุด้วยค่ะ",
				usersurname:"กรุณาระบุด้วยค่ะ",
				usersurname:"กรุณาระบุด้วยค่ะ",
				userprovince:"กรุณาระบุด้วยค่ะ",
				h_province:"กรุณาระบุด้วยค่ะ",
				h_amphur:"กรุณาระบุด้วยค่ะ",
				hospital:"กรุณาระบุด้วยค่ะ",
				userpassword:"กรุณาระบุด้วยค่ะ",
				repassword:{
					required:"กรุณาระบุด้วยค่ะ",
					 equalTo: "ระบุ password ไม่ถูกต้องค่ะ"
				},
				username:{
					required:"กรุณาระบุด้วยค่ะ",
					remote:"ชื่อ Username ซ้ำ กรุณาตรวจสอบ"
				}
		},
		errorPlacement: function(error, element){
				error.appendTo(element.parent());						
		}						
	});

	
});// document
</script>
<div id="title"> ข้อมูลผู้ใช้ระบบ (แก้ไข/เพิ่ม)</div>
<form name="form1" id="form1" action="user/save" enctype="multipart/form-data" method="post" >
<input name="uid" id="uid" type="hidden" value="<?php echo @$rs['uid']?>" />			
<table  class="tbform">
  <tr>
    <th width="96" height="20"class="topic">ชื่อ :</th>
    <td width="339" height="20"><input name="userfirstname" type="text" value="<?php echo @$rs['userfirstname'];?>" class="input_box_patient " />
    	<span class="alertred" >*</span></td>
  </tr>
  <tr>
    <th height="20" >นามสกุล :</th>
    <td height="20"><input name="usersurname" type="text" value="<?php echo @$rs['usersurname'];?>" class="input_box_patient " />
        <span class="alertred">*</span></td>
  </tr>
  <tr>
  	<th>เลขที่บัตรประชาชน</th>
  	<td><span style="margin-left:15px;">
  			<input type="text" name="cardW0" value=""  size="1" maxlength="1">-
  			<input type="text"  name="cardW1" value=""  size="4" maxlength="4">-
  			<input type="text"  name="cardW2" value=""  size="5" maxlength="5">-
   			<input type="text"  name="cardW3" value=""  size="2" maxlength="2">-
  			<input type="text"  name="cardW4" value="" size="1" maxlength="1"> 	
  			</span>
  			 <span class="alertred">*</span>		
  	</td>
  </tr>
  <tr>
    <th >E-mail :</th>
    <td><input name="usermail" type="text" class="input_box_patient " id="usermail" value="<?php echo @$rs['usermail'];?>" size="30">
    	<span class="alertred">*</span></td>
  </tr>
  <tr>
    <th valign="top">ตำแหน่ง :</th>
    <td>
    	 <ul class="sublist">
	           <li>
		           	<input name="userposition" type="radio"  value="00" onClick="return ChkShow(this.value);" <? if(@$rs['userposition']=='00'){echo"checked= 'checked'";}?> />
		          	<span>ผู้ดูแลระบบระดับกรม(สำนักโรคติดต่อทั่วไป)</span>
	          	</li>
	          	<li>
	           		<input name="userposition" type="radio" value="01"  onclick="return ChkShow(this.value);" <? if(@$rs['userposition']=='01'){echo 'checked';}?> />
					<span>ผู้ดูแลระบบระดับเขต</span>
				</li>
				<li>
	              <input name="userposition" type="radio" value="02" onClick="return ChkShow(this.value);" <? if(@$rs['userposition']=='02'){echo 'checked';}?> />
				 <span>ผู้ดูแลระบบระดับจังหวัด</span>
			 	</li>      
        	<li id="pv_level02" style="display:<? if(@$rs['level_code']!='02'){?>none<? }?>">          
	            <?php echo form_dropdown('userprovince',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['userprovince'],' class="styled-select" id="userprovince"','-โปรดเลือก-'); ?>
	              <span class="alertred">*</span>
        	</li>
        	<li>
              <input name="userposition" type="radio" value="03" onClick="return ChkShow(this.value);" <? if(@$rs['userposition']=='03'){echo 'checked';}?> />
         	  <span>ผู้ดูแลระบบระดับอำเภอ</span>
         	</li>
  			<li  id="Chk_level03" style="display:<? if(@$rs['level_code']!='03' ){?>none<? }?>">
		        <ul  class="sublist">
		        		<li><input type="checkbox" name="form_add"  id="form_add03" value="Y" <? if(@$rs['form_add']=='Y'){echo 'checked';}?> /><span> กรอกแบบฟอร์ม ร.36</span></li>
						<li><input type="checkbox" name="form_edit"  id="form_edit03" value="Y" <? if(@$rs['form_edit']=='Y'){echo 'checked';}?>  /><span>แก้ไขแบบฟอร์ม ร.36 </span></li>
			           <li><input type="checkbox" name="form_del"  id="form_del03" value="Y"  <? if(@$rs['form_del']=='Y'){echo 'checked';}?> /><span>ลบแบบฟอร์ม ร.36 </span></li>
		         </ul>
         	</li>
        <li>
              <input name="userposition" type="radio" value="04" onClick="return ChkShow(this.value);" <? if(@$rs['userposition']=='04'){echo 'checked';}?> />         
          	<span>ผู้ดูแลระบบระดับตำบล</span>
        </li>
		<li>
              <input name="userposition" type="radio" value="05" onClick="return ChkShow(this.value);" <? if(@$rs['userposition']=='05'){echo 'checked';}?> />
          		<span>Staff</span>
        </li>
        <li id="Chk_level05" style="display:<? if(@$rs['level_code']!='05' ){echo 'none'; }?>">
	        <ul  class="sublist">
	        		<li><input type="checkbox" name="form_add" id="form_add05" value="Y" <? if(@$rs['form_add']=='Y'){echo 'checked';}?> /><span>กรอกแบบฟอร์ม ร.36 </span></li>           
	            	<li><input type="checkbox" name="form_edit"  id="form_edit05"value="Y" <? if(@$rs['form_edit']=='Y'){echo 'checked';}?>  /><span>แก้ไขแบบฟอร์ม ร.36 </span></li>
					<li><input type="checkbox" name="form_del" id="form_del05" value="Y"  <? if(@$rs['form_del']=='Y'){echo 'checked';}?> /><span>ลบแบบฟอร์ม ร.36 </span></li>
	          </ul>
          </li>
          <li>
              <input name="userposition" type="radio" value="06" <? if(empty($rs['userposition'])){echo 'checked';}?>  onclick="return ChkShow(this.value);"  <? if(@$rs['userposition']=='06'){echo 'checked';}?> />
          		<span>ผู้ใช้ระบบทั่วไป</span>
          </li>
          </td> 
       </tr>        
  		<tr  id="hospital_level05" style="display:<? if(@@$rs['userposition']!='05' && @@$rs['userposition']!='03' ){echo 'none';}?>">
    <th valign="top"  >สถานพยาบาล :</th>
    <td>
		<ul class="sublist">
			<li><label>จังหวัด</label>
				<?php
					echo form_dropdown('h_province',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id2'],'class="styled-select" id="h_province"','-โปรดเลือก-')
				?>       
              <span class="alertred">*</span> 
			</li>
			<li><label>อำเภอ</label>
					<span id="input_Hamphur">
	              <?php
		              	$wh=(@$rs['province_id2'])? " and province_id='".$rs['province_id2']."'":'';
						if($wh)
						{
							echo form_dropdown('h_amphur',get_option('amphur_id','amphur_name',"n_amphur where  amphur_id<>'' $wh  order by amphur_name asc"),@$rs['amphur_id'],'class="styled-select"  id="h_amphur"','-โปรดเลือก-');
						}else{				
					?>
						<select name="h_amphur" id="h_amphur" class="styled-select "><option value="">-โปรดเลือก-</option></select>
           			<?php }?>
          			</span> <span class="alertred">*</span> 
			</li>
			<li><label>ตำบล</label>
				<span id="input_District">
  					<?php
		              	$wh=(@$rs['province_id2'])? " and province_id='".$rs['province_id2']."'":'';
						if($wh)
						{
							echo form_dropdown('h_district',get_option('district_id','district_name',"n_district where  district_id<>'' $wh  order by district_name asc"),@$rs['district_id'],'class="styled-select"  id="h_district"','-โปรดเลือก-');
						}else{				
					?>
						<select name="h_district" id="h_district" class="styled-select "><option value="">-โปรดเลือก-</option></select>
           			<?php }?>
          			</span> <span class="alertred">*</span> 				
				</span>
			</li>
			<li><label>สถานพยาบาล</label>
					<span id="input_Hospital">
		              <?php 
		              	$class='class="styled-select" id="userhospital"';
						$wh=(@$rs['amphur_id']!="")?"where hospital_province_id='".$rs['province_id2']."' and hospital_amphur_id='".$rs['amphur_id']."'":'';									
						if($wh){
							echo form_dropdown('hospital',get_option('hospital_code','hospital_name',"n_hospital $wh order by hospital_name asc"),@$rs['userhospital'],$class,'-โปรดเลือก-');
						}else{
					?>
						<select name="hospital" id="hospital" class="styled-select"><option value="">-โปรดเลือก-</option></select>
           			<?php } ?>
          		  </span> <span class="alertred">*</span> 
			</li>
		</ul>
     </td>
  </tr>
  <tr>
    <th  >Username :</th>
    <td><input type="text" name="username" class="input_box_patient " value="<?php echo @$rs['username'];?>" />
        <span class="alertred">*</span></td>
  </tr>
  <tr>
    <th >Password :</th>
    <td><input type="password" id="userpassword" name="userpassword" class="input_box_patient " value="<?php echo @$rs['userpassword'];?>">
        <span class="alertred">*</span></td>
  </tr>
  <tr>
    <th>Re-password :</th>
    <td><input type="password" name="repassword" class="input_box_patient " value="<?php echo @$rs['userpassword'];?>">
        <span class="alertred">*</span>
        <input  id="userposition" name="userposition" value="<?php echo @$rs['userposition']?>" type="hidden" />
        </td>
  </tr>
</table>
 <div class="btn_inline">
      <ul><li><button class="btn_save">&nbsp;&nbsp;&nbsp;</button></li><li><button class="btn_cancel">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>   
</form>
