<script type="text/javascript">
$(document).ready(function(){	
	$('#form1').validate({	
		groups:{
			groupname:'userfirstname usersurname',
			groupidcard:'cardW0 cardW1 cardW2 cardW3 cardW4',
			grouptel:'tel0 tel1 tel2',
			groupmobile:'mobile0 mobile1 mobile2'
		},
		rules:{
			userfirstname:"required",usersurname:"required",
			tel0:{required:true,number:true},tel1:{required:true,number:true},tel2:{required:true,number:true},
			mobile0:{required:true,number:true},mobile1:{required:true,number:true},mobile2:{required:true,number:true},
			cardW0:{required:true,number:true},cardW1:{required:true,number:true},
			 cardW2:{required:true,number:true},cardW3:{required:true,number:true},
		 	 cardW4:{
		 			required:true,number:true,	 		
		 			remote:{
		 				url:'<?php echo base_url(); ?>users/chkidcard',
		 				type:'get',
				        data: {
				          idcard: function() { return $('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val(); },
				          digit_last:function(){return $('#cardW4').val(); }
				        }
		 			}		 		
		 	},   
			userhospital:{
				required:true,
				remote:{
					url:'<?php echo base_url(); ?>users/chkHospitalcode',
					type:'get',
					dataType:'json',					
					dataFilter:function(data){
						var json=JSON.parse(data);
						if(json.status=="true"){
							  $('#userhospital').closest('div').find('.shw-name').html(json.texts); 
							   return "true";
						}else{
							 $('#userhospital').closest('div').find('.shw-name').html(''); 
							return "false";
						}								
					}	
				}
			},
			usermail:{
				required:true,email:true,
				remote:{url:'<?php echo base_url()?>users/checkEmail'}
			},
			userpassword:"required",
			repassword:{equalTo: "#userpassword"}
		},
		messages:{
			mobile0:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},mobile1:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},mobile2:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},
			tel0:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},tel1:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},tel2:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},
			userfirstname:"กรุณาระบุ",usersurname:"กรุณาระบุ",			
			cardW0:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},cardW1:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},	
			cardW2:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},cardW3:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},
			cardW4:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",remote:"กรุณาระบุให้ถูกต้อง"},
			userhospital:{required:'กรุณาระบุ',remote:'กรุณาระบุให้ถูกต้อง'},
			usermail:{required:"กรุณาระบุ",email:"กรุณาระบุให้ถูกต้อง",remote:'อีเมล์ซ้ำ'},
			userpassword:"กรุณาระบุ",
			repassword:"กรุณาระบุให้ตรงกัน"
		},
	 	errorPlacement: function(error, element) {
			if (element.attr("name") == "userfirstname" || element.attr("name") == "usersurname" ) {
				error.insertAfter("#usersurname");
			}else if(element.attr("name")=="cardW0" || element.attr("name")=="cardW1" || element.attr("name")=="cardW2" || element.attr("name")=="cardW3" || element.attr("name")=="cardW4"){
					error.insertAfter("#cardW4");
			}else if(element.attr('name')=="tel0" || element.attr('name')=="tel1" || element.attr('name')=="tel2"){
				error.insertAfter("#tel2");
			}else if(element.attr('name')=="mobile0" || element.attr('name')=="mobile1" || element.attr('name')=="mobile2"){
				error.insertAfter("#mobile2");
			}			
			else {
				error.insertAfter(element);
			}
		}
	});

 	$('#mobile').children().bind('keydown',function(e){											
		if(e.keyCode != 46 && e.keyCode!=8){														
			var txtBox=$('#mobile').children();
			var key=$(this).index();
				if(key==0 || key==1)l=3;
				if(key==2)l=4;														
				if(txtBox.eq(key).val().length==l){			
					txtBox.eq(key+1).val('');
					txtBox.eq(key+1).focus();			
				}																					
			}							
	});
 	$('#tel').children().bind('keydown',function(e){											
		if(e.keyCode != 46 && e.keyCode!=8){														
			var txtBox=$('#tel').children();
			var key=$(this).index();
				if(key==0)l=1;
				if(key==1)l=4;
				if(key==2)l=4;															
				if(txtBox.eq(key).val().length==l){			
					txtBox.eq(key+1).val('');
					txtBox.eq(key+1).focus();			
				}																					
			}							
	});
});
</script>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>ลงทะเบียน</li>
</ul>	
<div id="register">
<div id="span9">
<div class="row">
		<form action="users/signup" method="post" class="form-horizontal" id="form1">
 			<div class="control-group">
 				<label class="control-label" for="inputEmail">รหัสหน่วยงาน 9 หลัก<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="รหัสหน่วยงาน 9 หลัก" name="userhospital"  maxlength="9" id="userhospital">	
					<label class="shw-name" style="display:inline"></label>												
				</div>						
 				<label class="control-label" for="inputEmail">อีเมล์<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text"  placeholder="อีเมล์" name="usermail" class="input-large"> 
				</div>
 				<label class="control-label" for="inputEmail">รหัสผ่าน<label class="alertred">*</label></label>
				<div class="controls">
					<input type="password"  placeholder="รหัสผ่าน" class="input-large"  name="userpassword" id="userpassword" class="input-large">
				</div>
 				<label class="control-label" for="inputEmail">ยืนยันรหัสผ่าน<label class="alertred">*</label></label> 
				<div class="controls">
					<input type="password"  placeholder="ยืนยันรหัสผ่าน" class="input-large"  name="repassword" class="input-large">
				</div>		
 			</div>
 			<hr class="hr1">
 			<div class="control-group">
				<label class="control-label" for="idcard">เลขประจำตัวประชาชน<label class="alertred">*</label></label>
				<div class="controls" id="Show_idcard">
					<input type="text" id="cardW0"  name="cardW0" style="width:10px;" size="1" maxlength="1">
					<input type="text" id="cardW1"  name="cardW1" style="width:30px;" size="4" maxlength="4">
					<input type="text" id="cardW2"  name="cardW2" style="width:40px;" size="5" maxlength="5">
					<input type="text" id="cardW3"  name="cardW3" style="width:20px;" size="2" maxlength="2">
					<input type="text" id="cardW4"  name="cardW4" style="width:10px;" size="1" maxlength="1">					
				
				</div>			
				<label class="control-label" for="inputFirstame">ชื่อ -นามสกุล<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text" id="userfirstname" class="input-medium" placeholder="ชื่อ" name="userfirstname">
					<input type="text" id="usersurname" class="input-medium" placeholder="นามสกุล" name="usersurname"> 
				</div>				
				<br/>
				<label class="control-label" for="inputPostion">ตำแหน่ง</label>
				<div class="controls">					
					<?php echo form_dropdown('position',get_option('id','name','n_position'),'','','--กรุณาระบุ--') ?>
				</div>

				<label class="control-label" for="inputEmail">โทรศัพท์มือถือ<label class="alertred">*</label></label>
				<div class="controls">
					<span id="mobile">
					<input type="text" name="mobile0"  maxlength="3"  style="width:40px;" placeholder="08x" > -<input type="text" name="mobile1"  maxlength="3"  style="width:50px;"> -<input type="text" name="mobile2"  id="mobile2"  maxlength="4"  style="width:60px;">										
					</span>
				</div>
				<label class="control-label" for="inputEmail">โทรศัพท์สำนักงาน<label class="alertred">*</label></label>
				<div class="controls">
					<span id="tel">
					<input type="text" name="tel0" maxlength="1"  style="width:15px;"> -<input type="text" name="tel1" maxlength="4" style="width:60px;"> -<input type="text" name="tel2" id="tel2" maxlength="4" style="width:60px;"> 				
					</span>
					 ต่อ <input type="text" name="telephone_extend" style="width:30px;"> 
				</div>
				<label class="control-label" for="inputEmail">โทรสาร</label>
				<div class="controls">
					<input type="text" name="fax0" maxlength="1"  style="width:15px;"> -<input type="text" name="fax1" maxlength="4" style="width:60px;"> -<input type="text" name="fax2" id="fax2" maxlength="4" style="width:60px;"> 					
				</div>
				<div id="boxAdd"><button class="btn btn-primary" type="submit">ลงทะเบียน</button></div>
			</div>	
			<hr class="hr1">
			<small><label class="alertred">*</label>รายการที่ต้องกรอก</small>
		</form>
</div>
</div>
</div><!-- register -->

