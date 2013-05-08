									<table  id="meanstr"  class="tbvaccine"<? if(@$rs['means']=='3' || @$rs['means']==''){ print "style='display:none'";}?>>
										  	<tr>
												<th>ครั้งที่ </th>
												<th>วันที่ฉีด</th>
												<th>ชื่อวัคซีน</th>
												<th>เลขที่วัคซีน</th>
												<th>ขนาด(c.c)</th>
												<th>จำนวนจุดที่ฉีด</th>
												<th>ชื่อผู้ฉีด</th>
												<th>สถานที่</th>
												
										  </tr>
										  <? 		$this->db->debug=TRUE;								
										 $result=$this->db->Execute("select * from n_vaccine where information_id='".@$rs['id']."' ORDER BY vaccine_id ASC");																	
										$key=4;
										$vaccine_id=array('','','','','');
										$vaccine_date=array('','','','','');
										$vaccine_name=array('','','','','');
										$vaccine_no=array('','','','','');
										$vaccine_cc=array('','','','','');
										$vaccine_point=array('','','','','');
										$byname=array('','','','','');
										$byplace=array('','','','','');
										if($process=='vaccine'){
											if(!empty($rs['hospitalcode'])){
												$hospital_name=$this->db->GetOne("select hospital_name from n_hospital_1 where hospital_code='".$rs['hospitalcode']."' ");
											}									
										}else if($process=='addnew' || $process=='' ||$process="view"){
											$hospital_name=$this->session->userdata('R36_HOSPITAL_NAME');										
										}
										
										if($result){
											foreach($result as $key=>$rec_vaccine){
														$vaccine_id[$key] = $rec_vaccine['vaccine_id'];
														$vaccine_date[$key] = cld_my2date($rec_vaccine['vaccine_date']);
														$vaccine_name[$key] = $rec_vaccine['vaccine_name'];
														$vaccine_no[$key] = $rec_vaccine['vaccine_no'];
														$vaccine_cc [$key]= $rec_vaccine['vaccine_cc'];
														$vaccine_point[$key] = $rec_vaccine['vaccine_point'];
														$byname[$key] = $rec_vaccine['byname'];
														$byplace[$key] = ($rec_vaccine['byplace']=='')?$hospital_name:'';
											}
											$max_rec=$result->Recordcount();
										}	
																				
										
										$max=(@$rs['means']=="2")? 4:5;
										  for($i=0;$i<$max;$i++){
												if($byplace[$i]==''){ $byplace[$i]=$hospital_name;$hospital_name='';}
												echo form_hidden('vaccine_id',$vaccine_id[$i]);
										  ?>
										  <tr>
												<td><?php echo $i+1;?></td>
												<td>
													<input name="vaccine_date[<?php echo $i?>]" type="text" size="10" class="input_box_patient auto datepicker" id="vaccine_date[<?php echo $i?>]" readonly="" value="<?php echo $vaccine_date[$i];?>"
													<? if($vaccine_date[$i]!="" && $process=='vaccine'){echo 'disabled';} ?> />
												</td>
												<td>
													<select name="vaccine_name[<?php echo $i?>]" class="styled-select" id="vaccine_name[<?php echo $i?>]" <?php  if($vaccine_name[$i]!="" && $process=='vaccine'){echo 'disabled';} ?>>
														<option value="0" <? if($vaccine_name[$i]=='0'){ echo 'selected';}?>>เลือกชนิด</option>
														<option value="1" <? if($vaccine_name[$i]=='1'){ echo 'selected';}?>>PVRV</option>
														<option value="2" <? if($vaccine_name[$i]=='2'){ echo 'selected';}?>>PCEC</option>
														<option value="3" <? if($vaccine_name[$i]=='3'){ echo 'selected';}?>>HDCV</option>
														<option value="4" <? if($vaccine_name[$i]=='4'){ echo 'selected';}?>>PDEV</option>
												  </select> 
												</td>
												<td>
													<input name="vaccine_no[<?php echo $i?>]" type="text" id="vaccine_no[<?php echo $i?>]" size="10" value="<?php echo $vaccine_no[$i]?>" <? if($vaccine_no[$i]!="" && $process=="vaccine"){echo 'disabled';} ?> >											
												</td>													
												<td>
													<input name="vaccine_cc[<?php echo $i?>]" type="text" id="vaccine_cc[<?php echo $i?>]"  value="<?php echo $vaccine_cc[$i]?>" size="3" maxlength="10" <? if($vaccine_cc[$i]!="" && $process=='vaccine'){echo 'disabled';} ?>>												
												</td>
												<td>											
													<input type="text" name="vaccine_point[<?php echo $i?>]" size="2" id="vaccine_point[<?php echo $i?>]"  maxlength="1" value="<?php echo $vaccine_point[$i];?>" 
													<? if($vaccine_point[$i]!="" && $process=="vaccine"){echo 'disabled';} ?> />
												</td>
												<td>
													<input name="byname[<?php echo $i?>]" type="text" id="byname[<?php echo $i?>]" value="<?php echo $byname[$i]?>" size="10"  <? if($byname[$i]!='' && $process=='vaccine'){echo 'disabled';} ?>>
												</td>
												<td >
													<input name="byplace[<?php echo $i?>]" type="text" id="byplace[<?php echo $i?>]" value="<?php echo $byplace[$i];?>" size="20" <? if($byplace[$i]!="" && $process=='vaccine'){echo 'disabled';} ?>></td>
										  </tr>
										  <?  
										  }
										  ?>
									</table>