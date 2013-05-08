<script type="text/javascript">
$(document).ready(function(){
var province_id,amphur_id,district_id;	
	$("select[name=hospital_province_id]").change(function(){
		 province_id=$("select[name=hospital_province_id] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=hospital_amphur_id&ref1='+province_id,
			success:function(data){
				$('#input_amphur').html(data);
				$('#input_hospital').html('<select name="hospitalcode" class="input_box_patient" id="hospital"><option value="">-โปรดเลือก-</option></select>');
			}
		});
	});

	$("select[name=hospital_amphur_id]").live('change',function(){
		amphur_id=$("select[name=hospital_amphur_id] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=hospital_district_id&ref1='+province_id+'&ref2='+amphur_id,
			success:function(data){
				$("#input_district").html(data);
			}
		});
	});
	$('select[name=hospital_district_id]').live('change',function(){
		district_id =$('select[name=hospital_district_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url()?>hospital/getHospital',
			data:'name=hospitalcode&ref1='+province_id+'&ref2='+amphur_id+'&ref3='+district_id,
			success:function(data){
					$('#input_hospital').html(data);
			}
		});
	});


// START ####  กรณีเพิ่มรายการ  ####
		$('.btn_submit').click(function(){
			$("#hospitalprovince").rules("remove");$('#hospital_amphur_id').rules('remove');$('#hospital_district_id').rules('remove');
			$('#hospitalcode').rules('remove');	$('#hn').rules('remove');		
			$('#cardW0').rules('remove','required');	$('#cardW1').rules('remove','required');
			$('#cardW2').rules('remove','required');$('#cardW3').rules('remove','required');$('#cardW4').rules('remove','required remote');	
			$('#idcard').rules('remove','required');
			$
			$('input[name=in_out]').eq(0).css('display','').next('span').css('display','').end().prop('checked',true);		
			$('input[name=in_out]').eq(1).prop('checked',false);	
		});
		$('.btn_add').click(function(){
			$('#form1').attr('action','inform/addNew');
			$('input[name=in_out]').eq(0).css('display','none').next('span').css('display','none').prop('checked',false);
			$('input[name=in_out]').eq(1).prop('checked',true);
			if($('input[name=level]').val()=="05"){
				// กรณี สิทธิ์การใช้เป็น staff จะเลือกโรงพยาบาลอื่นๆไม่ได้
					$("#hospitalprovince option").filter(function() {return $(this).val() == $('input[name=h_province_id]').val();}).prop('selected', true);
					$("#hospital_amphur_id option").filter(function() {return $(this).val() == $('input[name=h_amphur_id]').val();}).prop('selected', true);	
					$("#hospital_district_id option").filter(function() {return $(this).val() == $('input[name=h_district_id]').val();}).prop('selected', true);	
					$("#hospitalcode option").filter(function() {return $(this).val() == $('input[name=h_code]').val();}).prop('selected', true);							
			}			
			//return false;	
		})
		
		 $.validator.setDefaults({submitHandler: function() {document.form1.submit(); }});
		 $('#form1').validate({
		 	 debug:false,
		 	 onkeyup: false,onfocusout: false,
		 	  groups: {
    				groupidcard:"cardW0 cardW1 cardW2 cardW3 cardW4"
  			},
		 	rules:{
		 		hospital_province_id:"required",hospital_amphur_id:"required",hospital_district_id:"required",hospitalcode:"required",hn:"required",
				idcard:  { required: {depends: function(element) {	return $('#statusid option:selected').val() == '2' }}, number:true},   
		 		cardW0:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW1:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW2:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW3:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW4:{
		 			required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true,	 		
		 			remote:{
		 				url:'<?php echo base_url(); ?>inform/chk_idcard',
				        data: {
				          idcard: function() { return $('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val(); },
				          digit_last:function(){return $('#cardW4').val(); }
				        }
		 			}		 		
		 		}       			 		
		 	},
		 	messages:{
		 		hospital_province_id:" กรุณาระบุจังหวัดค่ะ",hospital_amphur_id:" กรุณาระบุอำเภอค่ะ",hospital_district_id:" กรุณาระบุตำบลค่ะ",hospitalcode:" กรุณาระบุสถานพยาบาลค่ะ",
		 		hn:" กรุณาระบุ hn ค่ะ",idcard:"กรุณาระบุ passport ด้วยค่ะ",
		 		cardW0:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ"},
		 		cardW1:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ"},
		 		cardW2:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ"},
		 		cardW3:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ"},
		 		cardW4:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ",remote :" ระบุไม่ถูกต้องค่ะ"}		 		
		 	},
		 	errorPlacement: function(error, element) {
		     if (element.attr("name") == "cardW0"  || element.attr("name") == "cardW1" 	|| element.attr('name') == "cardW2" || element.attr('name')=="cardW3" || element.attr('name')=="cardW4")
		       error.insertAfter("#cardW4");
		     else
		       error.insertAfter(element);
		   }
		 }) ;
// END ####  กรณีเพิ่มรายการ  ####

		 $('#Show_passport').css('display','none');
		 $('#statusid').change(function(){
		 	if($('#statusid option:selected').val()=="1"){
		 		 $('#Show_passport').css('display','none');
		 		 $('#Show_idcard').css('display','');
		 	}else{
		 		$('#Show_passport').css('display','');
		 		 $('#Show_idcard').css('display','none');
		 	}
		 })
		 $('#Show_idcard').children().bind('keydown',function(e){											
				if(e.keyCode != 46 && e.keyCode!=8){														
					var txtBox=$('#Show_idcard').children();
					var key=$(this).index();
						if(key==0 || key==4)l=1;
						if(key==1)l=4;
						if(key==2)l=5;
						if(key==3)l=2;															
						if(txtBox.eq(key).val().length==l){			
							txtBox.eq(key+1).val('');
							txtBox.eq(key+1).focus();			
						}																					
					}							
		});
		 
		
		 
});
</script>
<div id="title">ค้นหาข้อมูลผู้สัมผัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า</div>
<div id="search">
<form name="form1"  method="get" id="form1" action="inform/index">		
<input name="level" type="hidden" value="<?php echo $this->session->userdata('R36_LEVEL') ?>" />
<input name="h_province_id" type="hidden" value="<?php echo !empty($_GET['hospital_province_id']) ?>"/>
<input name="h_amphur_id" type="hidden" value="<?php echo !empty($_GET['hospital_amphur_id']) ?>"/>
<input name="h_district_id" type="hidden" value="<?php echo !empty($_GET['hospital_district_id']) ?>"/>
<input name="h_code" type="hidden" value="<?php echo !empty($_GET['hospitalcode']) ?>"/> 
	<table class="tb_patient1">				
			<tr> 
				  <th><span class="alertred">*</span>จังหวัด :</th>
				  <td>
						<?php echo form_dropdown('hospital_province_id',get_option('province_id','province_name',"n_province where province_id <>'' order by province_name asc"),@$_GET['hospital_province_id'],'class="input_box_patient" id="hospitalprovince"','-โปรดเลือก-') ?>
				  </td>
				  <th height="20"  ><span class="alertred">*</span>อำเภอ :</th>
				  <td>
						<span id="input_amphur">
							<?php 
							$whamphur="";
							 if(@$_GET['hospital_province_id']){
									$whamphur="AND province_id ='".@$_GET['hospital_province_id']."'";
								 	$amphur_id="amphur_id <>'' ";									 										
							 }else{
							 	 	$amphur_id="amphur_id ='' ";
							 }
							 echo form_dropdown('hospital_amphur_id',get_option('amphur_id','amphur_name',"n_amphur where $amphur_id $whamphur  order by amphur_name asc"),@$_GET['hospital_amphur_id'],'class="input_box_patient" id="hospital_amphur_id"','-โปรดเลือก-');
							?>
					</span> 				
				  </td>
			</tr>

			<tr> 
				  <th><span class="alertred">*</span>ตำบล :</th>
				  <td >
						<span id="input_district">
							<?php
							$wh="";
							 if(@$_GET['hospital_province_id']){
									$wh="AND province_id ='".@$_GET['hospital_province_id']."' AND amphur_id='".$_GET['hospital_amphur_id']."'";	
								 	$whdistrict="  district_id<>''";							 										
							 }else{
							 		$whdistrict="  district_id=''";
							 }	
							 echo form_dropdown('hospital_district_id',get_option('district_id','district_name',"n_district where $whdistrict $wh  order by district_name asc"),@$_GET['hospital_district_id'],'class="input_box_patient" id="hospital_district_id"','-โปรดเลือก-');
							?>
					</span> 				
				  </td>
				   <th ><span class="alertred">*</span>สถานพยาบาล :</th>
				  <td> 
						<span id="input_hospital">											
								<?php				
								$whhospital="";
								 if(!empty($_GET['hospital_amphur_id'])){
										$whhospital=" hospital_id<>'' AND hospital_province_id='".@$_GET['hospital_province_id']."' AND   hospital_amphur_id ='".@$_GET['hospital_amphur_id']."' AND hospital_district_id ='".@$_GET['hospital_district_id']."' ";										
								 }else{								 										 
									  $whhospital=" hospital_id=''";
								 }
										echo form_dropdown('hospitalcode',get_option('hospital_code','hospital_name',"n_hospital_1 where $whhospital ORDER BY hospital_name ASC"),@$_GET['hospitalcode'],'class="input_box_patient" id="hospitalcode"','-โปรดเลือก-');
					  			 ?>
						</span> 
				  </td>
			</tr>
			<tr> 
				  <th ><span class="alertred">*</span> รหัส HN :</th>
				  <td><input name="hn" type="text" id="hn" size="30" maxlength="300"  class="input_box_patient" value="<?php echo @$_GET['hn'] ?>"></td>				  		
				<th ><span class="alertred">*</span> ประเภทบัตร : </th>
				<td><select name="statusid"  id="statusid"  class="input_box_patient">			
						<option value="1" <?php if(@$_GET['statusid']=='1'){ echo "selected='selected'";}?> selected="selected">เลขประจำตัวประชาชน</option>
						<option value="2" <?php if(@$_GET['statusid']=='2'){ echo "selected='selected'";}?>>เลขที่ passport</option>
					</select>					
					<span id="Show_passport"> 
						<input name="idcard" type="text" id="idcard" size="30" maxlength="300"  class="input_box_patient" value="<?php echo @$_GET['idcard']?>">
					</span>
					<span id="Show_idcard"> 
							<input name="cardW0" id="cardW0" type="text" class="textbox" size="1" maxlength="1" value="<?php echo @$_GET['cardW0']?>">
							  -
							  <input name="cardW1"  id="cardW1" type="text" class="textbox" size="4" maxlength="4"  value="<?php echo @$_GET['cardW1']?>">
							  -
							  <input name="cardW2"  id="cardW2" type="text" class="textbox" size="5" maxlength="5"   value="<?php echo @$_GET['cardW2']?>">
							  -
							  <input name="cardW3" id="cardW3" type="text" class="textbox" size="2" maxlength="2"  value="<?php echo @$_GET['cardW3']?>">
							  -
							<input name="cardW4" id="cardW4" type="text" class="textbox" size="1" maxlength="1"  value="<?php echo @$_GET['cardW4'] ?>" >				
					</span>
								
				</td>
			</tr>
			<tr> 
				  <th >ชื่อ :</th>
				  <td><input name="name" type="text" id="name" size="30" maxlength="300"  class="input_box_patient" value="<?php echo @$_GET['name'] ?>"></td>
				  <th  >นามสกุล :</th>
				  <td><input name="surname" type="text" id="surname" size="30" maxlength="300"  class="input_box_patient" value="<?php echo @$_GET['surname'] ?>"></td>
			</tr>
			<tr>
				<th >ประเภทผู้สัมผัสโรค</th>
				<td colspan="4">
					<span style="margin-left:12px;">
						<input type="radio" name="in_out" value="" checked="checked"><span> ทั้งหมด</span>
						<input type="radio" name="in_out" value="1"> ในเขต
						<input type="radio" name="in_out" value="2" <?php echo (@$_GET['in_out']=="2")?'checked="checked"':''; ?>> นอกเขต</td>
					</span>
			</tr>
			<tr> 
				  <th>วันเริ่มต้น(วันที่สัมผัสโรค) :</th>
				  <td><input type="text" name="startdate" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$_GET['startdate'] ?>" /></td>
				  <th>วันสิ้นสุด(วันที่สัมผัสโรค) : </th>
				  <td><input type="text" name="enddate" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$_GET['enddate']; ?>" /> </td>				  
			</tr>
			<tr> 
				  <th>วันเริ่มต้น(วันที่บันทึกรายการ) :</th>
				  <td><input type="text" name="report_startdate" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$_GET['report_startdate'] ?>" /></td>
				  <th>วันสิ้นสุด(วันที่บันทึกรายการ) : </th>
				  <td><input type="text" name="report_enddate" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo @$_GET['report_enddate']; ?>" /> </td>				  
			</tr>

			<tr>
				  <th>ปิดเคส(จำนวนวัคซีน)  :</th>
				  <td colspan="3">					
						<ul class="list" >
							<li><input type="checkbox" name="total_vaccine[]" value="0" <?php if(@$_GET['total_vaccine']){if(in_array('0',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								 	<span class="syringe syringe" title="0 เข็ม" class="vtip"></span> ปิดเคสไม่สมบูรณ์</li>
							<li><input type="checkbox" name="total_vaccine[]" value="1"<?php if(@$_GET['total_vaccine']){if(in_array('1',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								 	<span class="syringe1 syringe" title="1 เข็ม"> </span> ฉีด 1 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="2"<?php if(@$_GET['total_vaccine']){if(in_array('2',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
							 		<span class="syringe2 syringe" title="2 เข็ม"> </span> ฉีด 2 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="3"<?php if(@$_GET['total_vaccine']){if(in_array('3',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
									 <span class="syringe3  syringe" title="3 เข็ม"></span> ฉีด 3 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="4"<?php if(@$_GET['total_vaccine']){if(in_array('4',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
									 <span class="syringe4 syringe" title="4 เข็ม"></span> ฉีด 4 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="5"<?php if(@$_GET['total_vaccine']){if(in_array('5',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								 	<span class="syringe5  syringe" title="5 เข็ม"> </span> ฉีด 5 เข็ม</li>
						</ul>							
				</td>						
			</tr>				
	  </table>
<div class="btn_inline">
      <ul>
      	<li><button class="btn_submit" name="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
        <li><button class="btn_cancel" name="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>
</div>
<div id="boxAdd">
	<button class="btn_add" type="submit" name="btn_add"></button>
</div>
</form>

 <table class="tb_search_Rabies1" >			  			
          <tr> 
            <th>ลำดับ</th>
            <th>โค้ดโรงพยาบาล/HN</th>
            <th>บัตรประชาชน/  บัตร passport</th>
            <th>ชื่อ-นามสกุล</th>
            <th>โรงพยาบาล</th>
            <th>ปิดเคส(จำนวนวัคซีน)</th>
            <th>การกระทำ</th>
          </tr>                     	
			<?php
			if(!empty($result)):
			$i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 10)-10)+1:1;
			 foreach($result as $key =>$rec): ?>
              <tr> 
                <td align="center"><?php //echo $i++?></td>
                <td><?php echo $rec['hospitalcode'].'/'.$rec['hn'].'-'.$rec['hn_no'];?></td>
                <td><?php echo $rec['idcard'] ?></td>
				<td><?php echo $rec['firstname'].' '.$rec['surname'];?></td>
				<td><?php echo $rec['hospital_name']?></td>
                <td align="center"><p class="syringe<?php echo $rec['total_vaccine'] ?> syringe" title="<?php echo $rec['total_vaccine'] ?> เข็ม"></p></td>
            <td>	
            		<a title="ดู" href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'] ?>/<?php echo $rec['in_out'] ?>/view" target="_blank" class="btn_view"></a> 			
				<?php if($this->session->userdata('R36_LEVEL')=='00' || ($this->session->userdata('R36_LEVEL')=='02' && ($this->session->userdata('R36_PROVINCE')==$rec['hospitalprovince']))){?>
					<a title="แก้ไข" href="inform/form/<?php echo $rec['id']?>/<?php echo $rec['historyid'] ?>/<?php echo $rec['in_out']; ?>" target="top" class="btn_edit" ></a>
					<a title="ลบ" href="inform/delete/<?php echo $rec['id']?>" class="btn_delete"  onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')" ></a>	
				<?php }else if(($this->session->userdata('R36_LEVEL')=='05' || $this->session->userdata('R36_LEVEL')=='03') && ($this->session->userdata('R36_HOSPITAL')==$rec['hospitalcode'])){
											if($this->session->userdata('R36_FROMEDIT')=='Y'){ ?>
													<a  title="แก้ไข"  href="inform/form/<?php echo $rec['id']?>/<?php echo $rec['historyid'] ?>/<?php echo $in_out; ?>" target="_top" class="btn_edit">แก้ไข</a>
							<?php	}
						}  ?>
				</td>
              </tr>            
			  <?php endforeach; ?>
			 <?php endif; ?>			    
</table>	
<?php echo !empty($pagination) ?>

