<form  method="post" name="login" id="login">
<table width="98%" class="tbform">
			<tr>
				  <th colspan="8" class="headtable thhead">ยินดีต้อนรับ&nbsp;&nbsp;คุณ&nbsp;
						<span><?php echo $this->session->userdata('R36_FNAME');?></span>			
						<span><?php echo $this->session->userdata('R36_SURNAME');?></span>
						<p>ตารางนัดหมายคนไข้  ประจำวันที่<?php echo date("d")?>-<?php echo date("m")?>-<?php echo date('Y')+543;?></p>				
					</th>
				</tr>
				<tr>
				  <th width="17%" class="headtable">HN</th>
				  <th width="12%" class="headtable">ชื่อ</th>
				  <th width="13%" class="headtable">นามสกุล</th>
				  <th width="10%" class="headtable" >สถานะ</th>
				  <th width="10%" class="headtable">ฉีดโดยวิธี</th>
				  <th width="8%" 	class="headtable">จำนวนครั้ง</th> 
				  <th width="15%" class="headtable">ครั้งที่แล้ววันที่</th>
				  <th width="15%" class="headtable">ครั้งต่อไปวันที่</th>
			</tr>
			<? 
				$means_name[1]='เข้ากล้ามเนื้อ';
				$means_name[2]='เข้าในผิวหนัง';
				
				if($result){
					foreach($result as $key =>$item){
						if($item['in_out']=='1'){
							$inout_name='คนไข้ในเขตอำเภอ';
						}else if($item['in_out']=='2'){
							$inout_name='คนไข้นอกเขตอำเภอ';
						}
					//$information_id=$item['id'];
					
					//$recvaccine=$this->db->GetArray("SELECT vaccine_date FROM n_vaccine WHERE information_id='".$information_id."' AND vaccine_cc!='' and vaccine_date >='".$current_date."' limit 1");															
					$vaccine_date=$this->db->GetOne("select vaccine_date FROm n_vaccine WHERE vaccine_cc <>'' and information_id= ? and vaccine_date >= ? ",array($item['id'],$current_date));
					
					if($vaccine_date){
						$arrdate = explode("-",$vaccine_date);
						$endyear = ($arrdate[0]-543);
						
						/*if($item['total_vaccine']=='1'){
							$resultdate = date ("Y-m-d", mktime (0,0,0,date($arrdate[1]),date($arrdate[2])+3,date($endyear)));
						}elseif($item['total_vaccine']=='2'){
							$resultdate = date ("Y-m-d", mktime (0,0,0,date($arrdate[1]),date($arrdate[2])+7,date($endyear)));
						}else{
							if($item['means']=='1'){
								if($item['total_vaccine']=='3'){
									$resultdate = date ("Y-m-d", mktime (0,0,0,date($arrdate[1]),date($arrdate[2])+14,date($endyear)));
								}elseif($item['total_vaccine']=='4'){
									$resultdate = date ("Y-m-d", mktime (0,0,0,date($arrdate[1]),date($arrdate[2])+30,date($endyear)));
								}
							}elseif($item['means']=='2'){
								if($item['total_vaccine']=='3'){
									$resultdate = date ("Y-m-d", mktime (0,0,0,date($arrdate[1]),date($arrdate[2])+30,date($endyear)));
								}elseif($item['total_vaccine']=='4'){
									$resultdate = date ("Y-m-d", mktime (0,0,0,date($arrdate[1]),date($arrdate[2])+90,date($endyear)));
								}
							}
						}*/
						$resultdate=$endyear."-".$arrdate[1]."-".$arrdate[2];
						$nextdate = explode("-",$resultdate);
						$nextdateint = $nextdate[0].$nextdate[1].$nextdate[2];
						//$afterdate = date ("Ymd", mktime (0,0,0,date('m'),date('d')+3,date('Y')));
						//$beforedate = date ("Ymd", mktime (0,0,0,date('m'),date('d')-3,date('Y')));
						
						$beforedate='20110601';
						$afterdate="20110608";
					
						//echo $nextdateint."<br>";
						//echo $afterdate."<br>";
						//echo $beforedate;
						if($afterdate>=$nextdateint && $beforedate<=$nextdateint){					
								$prevDate=$this->db->GetOne("SELECT max(vaccine_date)FROM n_vaccine WHERE vaccine_cc!='' and information_id= ? and vaccine_cc!='' and vaccine_date<= ? ",array($item['id'],$current_date));
					

			?>
						<tr>
						  <td align="left" nowrap="nowrap">
						  		<a href="inform/form/<?php echo $item['id']?>/<?php echo $item['historyid']?>/<?php echo $item['in_out'] ?>/view" target="_blank"> <?php echo $item['hn'].'-'.$item['hn_no'];?></a>
						  </td>
						  <td align="left"><?php echo $item['firstname']?></td>
						  <td align="left"><?php echo $item['surname']?></td>
						  <td><?php echo $inout_name?></td>
						  <td><?php echo $means_name[$item['means']]?></td>
						  <td><?php echo $item['total_vaccine']?></td>
						  <td><?php echo cld_my2date($prevDate);?></td>
						  <td><? if($resultdate!=''){ echo $nextdate[2]."/".$nextdate[1]."/".($nextdate[0]+543);}?></td>
						</tr>
			<? 	} // afterdate
				} // recvaccine ?>
				
			<?php } //foreach?>
		
			<?php }else{?>
			<tr >
				  <td align="center" colspan="8"class="alertred">ไม่พบข้อมูล</td>
			</tr>
			<? }?>     
    </table>
    
    <div id="boxAdd">
	  <input type="button" name="printreport" value="พิมพ์รายงาน"  onclick="window.print();" class="Submit" id="printreport">
      <input type="button" name="closereport" value="ปิดหน้าต่างนี้" onclick="window.close();"  class="Submit" id="closereport">
	</div>
	</form>