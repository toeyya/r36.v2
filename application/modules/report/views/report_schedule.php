<div id="title">ตารางนัดหมายคนไข้  ประจำวันที่<?php echo date("d")?>-<?php echo date("m")?>-<?php echo date('Y')+543;?></div>
<div id="search">
	
</div>
<div id="report">
<table class="tb_search_Rabies1">
<tr>
  <th width="17%">HN</th>
  <th width="12%">ชื่อ</th>
  <th width="13%">นามสกุล</th>
  <th width="10%">สถานะ</th>
  <th width="10%">ฉีดโดยวิธี</th>
  <th width="8%">จำนวนครั้ง</th> 
  <th width="15%">ครั้งที่แล้ววันที่</th>
  <th width="15%">ครั้งต่อไปวันที่</th>
</tr>
<? 					
	foreach($result as $item){
			if($item['in_out']=='1'){
				$inout_name='คนไข้ในเขตอำเภอ';
			}else if($item['in_out']=='2'){
				$inout_name='คนไข้นอกเขตอำเภอ';
			}
			
			$recinfo=$this->information->get_row($item['id']);
			$rec_vaccinedate_start=$this->vaccine->where("information_id=".$item['id']." and DATEDIFF('vaccine_date',CURDATE())=3")->sort("")->order("vaccine_id asc")->get();			
			foreach($rec_vaccinedate_start as $rec){
?>
		<tr>
		  <td><a href="inform_view.php?historyid=<?php echo $item['historyid']?>&information_id=<?php echo $item['id']?>" target="_blank"> <?php echo $item['hn'].'-'.$item['hn_no'];?></a></td>
		  <td><?php echo $item['firstname']?></td>
		  <td><?php echo $item['surname']?></td>
		  <td><?php echo $inout_name?></td>
		  <td><?php echo $means_name[$item['means']]?></td>
		  <td><?php echo $item['total_vaccine']?></td>
		  <td><?php echo cld_my2date($rec['vaccine_date']);?></td>
		  <td><? //if($recstart[vaccine_date]!='' && $resultdate!=''){ echo $nextdate[2]."/".$nextdate[1]."/".($nextdate[0]+543);}?></td>
		</tr>
<?  //} 
		} //end foreach $rec_vaccine
	} // end foreach result
?>
			
     
    </table>
		<div id="btn_printout"><a href="report/schedule/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>    
</div><!-- report -->