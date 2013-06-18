
<div id="title">แบบฟอร์มประวัติคนไข้</div>
<form id="form1" name="form1" method="post"  action="inform/patient/save" > 
<? echo (!empty($rs['historyid']))? form_hidden('updated',date("Y-m-d H:i:s")):form_hidden('created',date('Y-m-d H:i:s')); 
     echo form_hidden('historyid',$rs['historyid']);?>
		<table class="tbdead">
		<tr>
				<th rowspan="3">1.</th>
				<td>	<span class="topic">คำนำหน้า</span> <select name="prefix_name" class="styled-select ">
							 	<option value="">- โปรดเลือก -</option>
								<option value="นาย" <?php  echo (@$rs['prefix_name']=='นาย')? "selected='selected'":"" ?>>นาย</option>
								<option value="นาง" <?php  echo (@$rs['prefix_name']=='นาง')? "selected='selected'":"" ?>>นาง</option>
								<option value="นางสาว" <?php  echo (@$rs['prefix_name']=='นางสาว')? "selected='selected'":"" ?>>นางสาว</option>
								<option value="ด.ช." <?php  echo (@$rs['prefix_name']=='ด.ช.')? "selected='selected'":"" ?>>ด.ช.</option>
								<option value="ด.ญ." <?php  echo (@$rs['prefix_name']=='ด.ญ.')? "selected='selected'":"" ?>>ด.ญ.</option>							
							 </select></td>
				<td><span class="topic radio">เพศ </span>
						<input name="gender" type="radio"  value="1" <? if(@$rs['gender']=='1'){ echo "checked";}?>> ชาย
						<input name="gender" type="radio" value="2" <? if(@$rs['gender']=='2'){ echo "checked";}?>> หญิง</td>			
			</tr>
			<tr>
				
					<td><span class="topic">ชื่อ<span class="alertred">*</span></span>
							<input name="firstname" type="text" class="input_box_patient" id="firstname" value="<?php echo $rs['firstname'];?>" size="20" />
					</td>
					<td><span class="topic">นามสกุล <span class="alertred">*</span></span>
							  <input name="surname" type="text" value="<?php echo $rs['surname'];?>" size="20"  class="input_box_patient ">
					</td>	
				<td><span class="topic">อายุ<span class="alertred">*</span></span>
                            <input name="age" id="age"  type="text" size="2" maxlength="2" value="<?php echo @$rs['age'];?>" class="input_box_patient auto"  onKeyUp="chk_than15(this.value);"></td>					
			</tr>
			<tr>
			<td colspan="2">
				<select name="statusid"  class="styled-select " onChange="return selectType_id(this.value);">
						<option value="1" <? if(@$rs['statusid']=='1'){ echo 'selected="selected"';}?>>เลขประจำตัวประชาชน</option>
						<option value="2" <? if(@$rs['statusid']=='2'){ echo 'selected="selected"';}?>>เลขที่ passport</option>						
					</select>	<span class="alertred">*</span>					
					<span id="Show_idpassport" <? if(@$rs['statusid']=='2'){print "style='display:'";}else{print "style='display:none'";}?>>
						<input name="idpassport" type="text" class="input_box_patient " value="<?php echo @$rs['idcard'];?>" size="20" maxlength="50">
					</span>						
						<span id="Show_idcard" > 
						<input name="cardW0" id="cardW0" type="text" class="input_box_patient nowidth" size="1" maxlength="1"  value="<?php echo @$cardW0?>" />
						  -
						  <input name="cardW1"  id="cardW1" type="text" class="input_box_patient nowidth" size="4" maxlength="4" value="<?php echo @$cardW1?>" />
						  -
						  <input name="cardW2"  id="cardW2" type="text" class="input_box_patient nowidth" size="5" maxlength="5"  value="<?php echo @$cardW2?>"/>
						  -
						  <input name="cardW3" id="cardW3" type="text" class="input_box_patient nowidth" size="2" maxlength="2"  value="<?php echo @$cardW3?>" />
						  -
						<input name="cardW4" id="cardW4" type="text" class="input_box_patient nowidth" size="1" maxlength="1"  value="<?php echo @$cardW4?>"  />				
					</span>
					
					</td>																	    			
			</tr>
			<tr>
				<th>2. </th>
				<td><span class="topic radio">เชื้อชาติ</span>
											<input name="nationality" type="radio" value="1" <? if(@$rs['nationalityname']=='1'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);"> ไทย&nbsp;&nbsp;
						<input name="nationality" type="radio" value="2" <? if(@$rs['nationalityname']=='2'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);"> อื่นๆ 
						<span id="nationality_tr1" <? if(@$rs['nationalityname']!='2'){ print 'style = "display:none"';}?>>
						สัญชาติ :&nbsp; 
							<select name="nationalityname"  class="styled-select " onChange="show_hide_clear_nationality_text(this)">
								<option value="0" <? if(@$rs['nationalityname']=='0'){echo "selected";}?>>เลือกสัญชาติ</option>
								<option value="2" <? if(@$rs['nationalityname']=='2'){echo "selected";}?>>จีน/ฮ่องกง/ใต้หวัน</option>
								<option value="3" <? if(@$rs['nationalityname']=='3'){echo "selected";}?>>พม่า</option>
								<option value="4" <? if(@$rs['nationalityname']=='4'){echo "selected";}?>>มาเลเซีย</option>
								<option value="5" <? if(@$rs['nationalityname']=='5'){echo "selected";}?>>กัมพูชา</option>
								<option value="6" <? if(@$rs['nationalityname']=='6'){echo "selected";}?>>ลาว</option>
								<option value="7" <? if(@$rs['nationalityname']=='7'){echo "selected";}?>>เวียดนาม</option>
								<option value="8" <? if(@$rs['nationalityname']=='8'){echo "selected";}?>>ยุโรป</option>
								<option value="9" <? if(@$rs['nationalityname']=='9'){echo "selected";}?>>อเมริกา</option>
								<option value="10" <? if(@$rs['nationalityname']=='10'){echo "selected";}?>>ไม่ทราบสัญชาติ</option>
								<option value="11" <? if(@$rs['nationalityname']=='11'){echo "selected";}?>>อื่นๆ</option>
                          </select>&nbsp;
							<span id="nationality_div" <? if(@$rs['nationalityname']!='11'){ print 'style = "display:none"';}?>>
								  <span class="alertred">(โปรดระบุ)</span>&nbsp;
								  <input name="othernationalityname" id="othernationalityname" type="text" value="<?php echo @$rs['othernationalityname'];?>" class="input_box_patient " size="20">
						  </span>
						</span>
				</td>
				<td><span class="topic">อาชีพ</span>
							<?php echo form_dropdown('occupationname',get_option('id','name','n_occupations'),@$rs['occupationname'],'class="styled-select " onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_than15"','- กรุณาเลือกอาชีพ-'); ?>
							<?php 
							$class='class="styled-select" onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_less15"';
							echo form_dropdown('occupationname_b',get_option('id','name','n_occupations where id in(1,2,3)'),@$rs['occupationname'],$class,'- กรุณาเลือกอาชีพ-'); ?>
						<? if(@$rs['age']>15){ 
										echo	"<script>document.getElementById ('occupation_less15').style.display='none'</script>";
								}else{ 
										echo	"<script>document.getElementById ('occupation_than15').style.display='none'</script>";
								}
						?>
							<span  id="otheroccupationname_tr" <? if(@$rs['occupationname']!='20'){ print 'style = "display:none"'; }?>>
							<span class="alertred">(โปรดระบุ)&nbsp;
						<input name="otheroccupationname" id="otheroccupationname"  type="text" class="input_box_patient " size="10" value="<?php echo @$rs['otheroccupationname'];?>" /></span>
						</span>
				</td>
			</tr>	
			<tr>
				<th rowspan="3">3. </th>
				<td><span class="topic">ที่อยู่ เลขที่</span><input type="text"  class="input_box_patient "name="nohome" value="<?php echo $rs['nohome'] ?>">					</td>
				<td><span class="topic">หมู่ที่</span><input type="text" class="input_box_patient " name="moo" value="<?php echo $rs['moo'] ?>"></td>
				<td><span class="topic">หมู่บ้าน</span><input type="text"  class="input_box_patient "name="villege" value="<?php echo $rs['villege'] ?>"></td>
			</tr>
			<tr>				
				<td><span class="topic">ซอย</span><input type="text" class="input_box_patient " name="soi"  size="20" value="<?php echo $rs['soi'];?>" /></td>
                <td><span class="topic">ถนน</span><input type="text" class="input_box_patient " name="road"  id="road" value="<?php echo $rs['road'];?>" size="20" /></td>			
			</tr>
			<tr>
               <td><span class="topic">จังหวัด<span class="alertred">*</span></span>	
                	<?php $class='class="input_box_patient " id="provinceid"';
                		echo form_dropdown('provinceid',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$rs['provinceid'],$class,'-โปรดเลือก-');?>
				</td>
                 <td><span class="topic">อำเภอ/เขต<span class="alertred">*</span></span>
						<span id="Input_amphur">						
							<?								
							if($rs['provinceid']!=''){
									if($rs['amphurid']!=''){
										$whamp="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
									}else{
										$whamp="AND province_id='".$rs['provinceid']."'";
									}																				 
								echo form_dropdown('amphurid',get_option('amphur_id','amphur_name',"n_amphur WHERE amphur_id!=''".$whamp."  ORDER BY amphur_name ASC"),@$rs['amphurid'],'class="input_box_patient " id="amphurid"','-โปรดเลือก-');
							}else{									
							?>
								<select name="amphurid" id="amphurid" class="input_box_patient ">
									<option value="">-โปรดเลือก-</option>
								</select>
							<?php } ?>
						</span></td>						
                  <td><span class="topic">ตำบล/แขวง <span class="alertred">*</span></span>
						<span id="Input_district">
							<?
							if($rs['amphurid']!=''){
									if($rs['districtid']!=''){
										$whdis="AND district_id ='".$rs['districtid']."' AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
									}else{
										$whdis="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
									}	
																	
									echo  form_dropdown('district_id',get_option('district_id','district_name'," n_district WHERE district_id!='' ". $whdis." ORDER BY district_name ASC"),@$rs['districtid'],'class="input_box_patient " id="districtid"','-โปรดเลือก-');
								}else{
							?>     
								<select name="districtid" id="districtid" class="input_box_patient ">
									<option value="">-โปรดเลือก-</option>
								</select>
							<?php } ?></span>
				</td>
		</tr>
		
</table>	
 <div class="btn_inline">
      <ul>
      	<li><button class="btn_save" type="submit"></button></li>
    </ul>
</div> 
</form>