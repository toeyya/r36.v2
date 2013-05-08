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
				success:function(data)
				{
					$("#input_District").html(data);
				}
			});	
	});			
	$('#h_district').live('change',function(){
		ref3=$("#h_district option:selected").val();
			$.ajax({
				url:'<?php echo base_url(); ?>hospital/getHospital',data:'ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,
				success:function(data)
				{
					$("#input_Hospital").html(data);
				}
			});	
	})
	if ($("input[name=userposition]").is(":checked")){ChkShow();	}
	$('input[name=userposition]').click(ChkShow);
	
   $('input[name=del]').click(function(){
	   	if($('.chk_del').is(':checked')){
		   	  if(confirm('คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลนี้')){ 	  			   	  		
		   	  	    var id = [];
			        $('input[name=chk_del[]]:checked').each(function(i){
			          	id[i] = $(this).val();
		        	});
		        	
		        	$.ajax({
		        		url:'<?php echo base_url() ?>user/delete',
		        		data:'id='+id,
		        		success:function(data){
		        			   $('input[name=chk_del[]]:checked').closest('tr').hide();    
		        			   $('input[name=chk_del[]]').removeAttr('checked');     			  		 
		        		}
		        	})
		   	  }
	   }else{
	   	 	alert('คุณยังไม่ได้เลือกรายการที่ต้องการลบค่ะ');
	   }
   });
});// document
</script>
<div id="title">ค้นหาข้อมูลผู้ใช้ระบบ</div>
<div id="search">
<form name="form1"  action="users/r36/users"  method="get" >
<table width="70%"class="tb_patient1">
  <tr>
    <th width="96" height="20"  >ชื่อ/นามสกุล/อีเมล์/username :</th>
    <td width="339" height="20"><input name="name" type="text" value="<?php echo @$_GET['name'];?>" class="input_box_patient" /></td>
  </tr>
  <tr>
  <th valign="top">สิทธิ์การใช้งาน :</th>
    <td>
    	 <ul class="sublist">
	           <li>
		           	<input name="userposition" type="radio"  value="00" onClick="return ChkShow(this.value);" <? if(@$_GET['userposition']=='00'){echo"checked= 'checked'";}?> />
		          	<span>ผู้ดูแลระบบระดับกรม(สำนักโรคติดต่อทั่วไป)</span>
	          	</li>
	          	<li>
	           		<input name="userposition" type="radio" value="01"  onclick="return ChkShow(this.value);" <? if(@$_GET['userposition']=='01'){echo 'checked';}?> />
					<span>ผู้ดูแลระบบระดับเขต</span>
				</li>
				<li>
	              <input name="userposition" type="radio" value="02" onClick="return ChkShow(this.value);" <? if(@$_GET['userposition']=='02'){echo 'checked';}?> />
				 <span>ผู้ดูแลระบบระดับจังหวัด</span>
			 	</li>      
        	<li id="pv_level02" style="display:<? if(@$_GET['level_code']!='02'){?>none<? }?>">          
	            <?php echo form_dropdown('userprovince',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['userprovince'],' class="input_box_patient " id="userprovince"','-โปรดเลือก-'); ?>
        	</li>
        	<li>
              <input name="userposition" type="radio" value="03" onClick="return ChkShow(this.value);" <? if(@$_GET['userposition']=='03'){echo 'checked';}?> />
         	  <span>ผู้ดูแลระบบระดับอำเภอ</span>
         	</li>
  			<li  id="Chk_level03" style="display:<? if(@$_GET['level_code']!='03' ){?>none<? }?>">
		        <ul  class="sublist">
		        		<li><input type="checkbox" name="form_add"  id="form_add03"  value="Y" <? if(@$_GET['form_add']=='Y'){echo 'checked';}?>/><span> กรอกแบบฟอร์ม ร.36</span></li>
						<li><input type="checkbox" name="form_edit"  id="form_edit03"  value="Y" <? if(@$_GET['form_edit']=='Y'){echo 'checked';}?>/><span>แก้ไขแบบฟอร์ม ร.36 </span></li>
			           <li><input type="checkbox"  name="form_del"   id="form_del03"   value="Y"  <? if(@$_GET['form_del']=='Y'){echo 'checked';}?>/><span>ลบแบบฟอร์ม ร.36 </span></li>
		         </ul>
         	</li>
        <li>
              <input name="userposition" type="radio" value="04" onClick="return ChkShow(this.value);" <? if(@$_GET['userposition']=='04'){echo 'checked';}?> />         
          	<span>ผู้ดูแลระบบระดับตำบล</span>
        </li>
		<li>
              <input name="userposition" type="radio" value="05" onClick="return ChkShow(this.value);" <? if(@$_GET['userposition']=='05'){echo 'checked';}?> />
          		<span>Staff</span>
        </li>
        <li id="Chk_level05" style="display:<? if(@$_GET['level_code']!='05' ){echo 'none'; }?>">
	        <ul  class="sublist">
	        		<li><input type="checkbox" name="form_add"  id="form_add05" value="Y" <? if(@$_GET['form_add']=='Y'){echo 'checked';}?>/><span>กรอกแบบฟอร์ม ร.36 </span></li>           
	            	<li><input type="checkbox" name="form_edit"  id="form_edit05" value="Y" <? if(@$_GET['form_edit']=='Y'){echo 'checked';}?>/><span>แก้ไขแบบฟอร์ม ร.36 </span></li>
					<li><input type="checkbox" name="form_del"   id="form_del05"  value="Y"  <? if(@$_GET['form_del']=='Y'){echo 'checked';}?>/><span>ลบแบบฟอร์ม ร.36 </span></li>
	          </ul>
          </li>
          <li>
              <input name="userposition" type="radio" value="06"onclick="return ChkShow(this.value);"  <? if(@$_GET['userposition']=='06'){echo 'checked';}?> />
          		<span>ผู้ใช้ระบบทั่วไป</span>
          </li>
          </td> 
  </tr>
  <tr>
    <th valign="top">สถานพยาบาล :</th>
    <td>
			<ul class="sublist">
				<li><label>จังหวัด</label>
						<?php
							echo form_dropdown('h_province',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['h_province'],'class="styled-select" id="h_province"','-โปรดเลือก-')
						?>
				</li>
				<li><label>อำเภอ</label>
						<span id="input_Hamphur">
				              <?php 		              	
								$wh=(@$_GET['h_province'])? " and province_id='".@$_GET['h_province']."'":'';
								$class='id="h_amphur" class="styled-select"';
								if($wh){												
								echo form_dropdown('h_amphur',get_option('amphur_id','amphur_name',"n_amphur where amphur_id<>'' $wh  order by amphur_name asc"),@$_GET['h_amphur'],$class,'-โปรดเลือก-');
								}else{
							  ?>
						<select name="h_amphur" id="h_amphur" class="styled-select"><option value="">-โปรดเลือก-</option></select>
						<?php } ?>
						</span>
				</li>
				<li><label>ตำบล</label>
						<span id="input_District">   	
				        	<?php  
				        	$sql=" and province_id='".@$_GET['h_province']."' and amphur_id ='".@$_GET['h_amphur']."'";
				        	$wh=(@$_GET['h_district']) ?$sql:"";
							$class='id ="h_district" class="styled-select"';
							if($wh){										
				        			echo form_dropdown('h_district',get_option('district_id','district_name',"n_district where district_id <>'' $wh order by district_name asc"),@$_GET['h_district'],$class,'-โปรดเลือก-');
							}else{					
							 ?>
							 <select name="h_district" id="h_district" class="styled-select"><option value="">-โปรดเลือก-</option></select>
				    		<?php } ?>
			        	</span>	     
				</li>
				<li><label>สถานพยาบาล</label>
						<span id="input_Hospital">
				              <?php 
				              $sql=" and hospital_province_id='".@$_GET['h_province']."' and hospital_amphur_id ='".@$_GET['h_amphur']."' and hospital_district_id='".@$_GET['h_district']."'";
				              $wh =(@$_GET['h_amphur'])? $sql:"";
							  $class='class="styled-select" id="hospital"';
							  if($wh){
							 		 echo form_dropdown('hospital',get_option('hospital_code','hospital_name','n_hospital_1 where hospital_id<>"" '.$wh.' order by hospital_name asc'),@$_GET['hospital'],$class,'-โปรดเลือก-');
							  }else{	
							?>
								<select name="hospital" id="hospital" class="styled-select"><option value="">-โปรดเลือก-</option></select>
							<?php } ?>
						</span>
				</li>
			</ul>
    </td>
  </tr>
</table>
<div class="btn_inline">
      <ul><li>
      	<input class="btn_submit" type="submit" value=""/></li>
      	<li><input class="btn_cancel" type="reset" value=""/></li></ul>
      	
</div>
</form>
</div>
<div id="boxAdd"><a href="users/r36/users/form" name="btn_add" class="btn_add"></a></div>
<table  class="tb_search_Rabies1" >
	  <tr>		
		<th width="5%">แสดง</th>
		<th width="9%">Username</th>
		<th width="12%">ชื่อ</th>
		<th width="12%">นามสกุล</th>
		<th width="17%">สิทธิืการใช้งาน</th>
		<th width="16%">สถานพยาบาล</th>
		<th width="12%">อำเภอ</th>
		<th width="11%">จังหวัด</th>
		<th width="10%">การกระทำ</th>
	  </tr>	  
		<?php foreach($result as $item): ?>
		<tr class="tr_rule_Rabies1">
				<!--<<td  align="center"><nput name="chk_del[]" type="checkbox" value="<?php echo $item['uid']?>"  class="chk_del"/></td>-->
				<td><input type="checkbox"  class="list_check" name="status" value="<?php echo $item['uid'] ?>" <?php echo ($item['status']=="approve")?'checked="checked"':'' ?>  /></td>
				<td><?php echo $item['username'];?></a></td>
				<td><?php echo $item['userfirstname'];?></td>
				<td><?php echo $item['usersurname'];?></td>
				<td><?php echo  $item['level_name'];?></td>
				<td><?php echo  $item['hospital_name']?></td>
				<td><?php //echo $item['amphur_name']?></td>
				<td><?php //echo  ($item['userposition']=="02") ? $item['province_name1'] :$item['province_name2']?></td>
				<td><a href="users/r36/users/form/<?php echo $item['uid'] ?>" alt="แก้ไขข้อมูลผู้ใช้" name="editForm"  class="btn_edit"></a>
						 <a href="users/r36/users/delete/<?php echo $item['uid'] ?>" alt="ลบข้อมูลผู้ใช้"   class="btn_delete"></a>
				</td>
		</tr>
		<?php endforeach; ?>
  </table>
<?php echo $pagination ?>	