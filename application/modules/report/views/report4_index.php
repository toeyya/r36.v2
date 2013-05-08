<div id="search">
<form action="report/index/4" method="get"  name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table width="90%"  class="tbform">
	  <tr>
			<th colspan="4"  class="headtable thhead">สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ</th>
	  </tr>
	  <tr>
			<th width="31%" >รูปแบบเขตความรับผิดชอบ</th>
			<td width="40%" >
				<select name="area" id="area" class="textbox widthselect" onchange="ClearHospital();ClearDistrict();ClearAmphur();ClearProvince();ListGroupByArea();">
					<option value="-">กรุณาเลือกเขต</option>
					<option value="1">รูปแบบเดิม (12 เขต)</option>
					<option value="2">รูปแบบใหม่ (19 เขต)</option>
				</select>
			 </td>
			 <th width="31%"  >ข้อมูลรายเขต</th>
			<td width="40%" ><span id="grouplist"><select name="group" class="textbox widthselect" id="group"><option value="">ทั้งหมด</option></select></span></td>
			<th >ข้อมูลรายจังหวัด</th>
			<td><span id="provincelist"><select name="province" class="textbox widthselect"><option value="">ทั้งหมด</option></select></span></td>	  
	  </tr>
	  <tr>

			<th >ข้อมูลรายอำเภอ</th>
			<td><span id="amphurlist"><select name="amphur" class="textbox widthselect"><option value="">ทั้งหมด</option></select></span></td>
			<th >ข้อมูลรายตำบล</th>
			<td><span id="districtlist"><select name="district" class="textbox widthselect"><option value="">ทั้งหมด</option></select></span></td>
			<th >ข้อมูลรายโรงพยาบาล</th>
			<td><span id="hospitallist"><select name="hospital" class="textbox widthselect"><option value="">ทั้งหมด</option></select></span></td>
	  </tr>
	  <tr>
	
	  </tr>
	  <tr>
	    <th >จำแนกรายปีของวันที่สัมผัสโรค</th>
	    <td>
			<select name="year" class="textbox widthselect">
			<option value="">ทั้งหมด</option>
			<?
			$syear = (date('Y')+543)-10;
			for($i=$syear;$i<=(date('Y')+543);$i++){
			?>
				<option value="<?php echo $i;?>"><?php echo $i;?></option>
			<?
			}
			?>
			</select>					</td>
			<th >จำแนกรายเดือนของวันที่สัมผัสโรค</th>
	    	<td>
			<select name="month" class="textbox">
			<option value="">ทั้งหมด</option>
			<?
			for($i=1;$i<=12;$i++){
			?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
			<?
			}
			?>
			</select>
		</td>
      </tr>
	  <tr>
	    <th >จำแนกรายปีของวันที่บันทึกรายการ</th>
	    <td>
			<select name="year_report" class="textbox widthselect">
			<option value="">ทั้งหมด</option>
			<?
			$syear = (date('Y')+543)-10;
			for($i=$syear;$i<=(date('Y')+543);$i++){
			?>
				<option value="<?php echo $i;?>"><?php echo $i;?></option>
			<?
			}
			?>
			</select>					</td>
			<th  >จำแนกรายเดือนของวันที่บันทึกรายการ</th>
	    	<td bgcolor="#FFFFFF">
			<select name="month_report" class="textbox">
			<option value="">ทั้งหมด</option>
			<?
			for($i=1;$i<=12;$i++){
			?>
				<option value="<?php echo sprintf("%02d",$i);?>"><?php echo convert_month($i,"longthai");?></option>
			<?
			}
			?>
			</select>
		</td>
      </tr>
	  <tr >
	  	<th >จำแนกตามสถานะ</th>
		<td  colspan="4">
 			<select name="type" class="textbox widthselect">
				<option value="">ทั้งหมด</option>
				<option value="1">ในเขต</option>
				<option value="2">นอกเขต</option>
			</select>					</td>
	  </tr>
	  <tr>
	    <th class="thhead">&nbsp;</td>
	    <td  colspan="4" align="center">	    
	    			<input type="submit" name="view" value="ดูรายงาน" class="Submit">&nbsp;&nbsp;
	    			<input type="reset" name="reset" value="ยกเลิก"  class="Submit"></td>	
      </tr>
  </table>
</form>
</div>


<?php if(!empty($_GET['view'])): ?>
<div id="report">
	<div id="title">
		<table width="500" border="0" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000">
				  <tr> 
					<td align="center"><b>สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ<?php echo $texttype;?></b></td>
				  </tr>
				  <tr>
					<td><div align="center">รูปแบบเขตความรับผิดชอบ&nbsp;<?php echo $textarea;?>&nbsp;&nbsp;ข้อมูลรายเขต&nbsp;<?php echo $textgroup;?></div></td>
				  </tr>
				  <tr>
					<td><div align="center">จังหวัด&nbsp;<?php echo $textprovince;?>&nbsp;&nbsp;อำเภอ&nbsp;<?php echo $textamphur;?></div></td>
				  </tr>
				  <tr>
					<td><div align="center">โรงพยาบาล&nbsp;<?php echo $texthospital;?>&nbsp;&nbsp;ปี&nbsp;<?php echo $textyear;?>&nbsp;&nbsp;เดือน&nbsp;<?php echo $textmonth;?></div></td>
				  </tr>
		</table>
	</div>

	<table width="90%" border="0" cellspacing="0" cellpadding="0"  align="center">
          <tr>
            <td colspan="3"><hr align="center" width="100%" size="1" /></td>
          </tr>
          <tr>
            <td width="60%" rowspan="2" align="center" valign="top"><strong>รายการ</strong></td>
            <td colspan="2" align="center" height="20"><strong>จำนวน</strong></td>
          </tr>
          <tr>
            <td width="20%" align="center" height="20"><strong>ในเขต</strong></td>
            <td width="20%" align="center" height="20"><strong>นอกเขต</strong></td>
          </tr>
          <tr>
            <td colspan="3"><hr align="center" width="100%" size="1" /></td>
          </tr>
              <?
			  //$queryinout = $DB->QUERY("select in_out,count(id_card) as spin from temp".$current." group by in_out order by in_out asc");
			  $queryinout = $this->db->GetArray("select in_out,count(id_card) as spin from temp".$current." group by in_out order by in_out asc");
			  $totalinout = 0;
			 // while($recinout = $DB->FETCHARRAY($queryinout)){
			  foreach($queryinout as $recinout){
					$inoutarr[$recinout[in_out]][] = $recinout[spin];
					$totalinout = $totalinout + $recinout[spin];
			  }
			  $typeinout1 = ($inoutarr[1][0]) ? $inoutarr[1][0] : "0";
			  $typeinout2 = ($inoutarr[2][0]) ? $inoutarr[2][0] : "0";
			  ?>
              <tr onmouseover="setPointer(this, 1, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 1, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 1, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                <td height="20"><strong>1. รายงานประวัติการฉีดวัคซีนคนไข้ (คน) ( N = <?php echo number_format($totalinout)?> )</strong></td>
                <td align="center"><?php echo number_format($typeinout1);?></td>
                <td align="center"><?php echo number_format($typeinout2);?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
                  <?
						  $querynation = $DB->QUERY("select nationalityname,count(id_card) as spin from temp".$current." where nationalityname!='0' AND in_out='1' group by nationalityname order by nationalityname asc");
						  $totalnation = 0;
						  while($recnation = $DB->FETCHARRAY($querynation)){
								$nationarr[$recnation[nationalityname]][] = $recnation[spin];
								$totalnation = $totalnation + $recnation[spin];
						  }
						  $typenation1 = ($nationarr[1][0]) ? $nationarr[1][0] : "0";
						  $typenation2 = ($nationarr[2][0]) ? $nationarr[2][0] : "0";
						  $typenation3 = ($nationarr[3][0]) ? $nationarr[3][0] : "0";
						  $typenation4 = ($nationarr[4][0]) ? $nationarr[4][0] : "0";
						  $typenation5 = ($nationarr[5][0]) ? $nationarr[5][0] : "0";
						  $typenation6 = ($nationarr[6][0]) ? $nationarr[6][0] : "0";
						  $typenation7 = ($nationarr[7][0]) ? $nationarr[7][0] : "0";
						  $typenation8 = ($nationarr[8][0]) ? $nationarr[8][0] : "0";
						  $typenation9 = ($nationarr[9][0]) ? $nationarr[9][0] : "0";
						  $typenation10 = ($nationarr[10][0]) ? $nationarr[10][0] : "0";
						  $typenationno=$typeinout1-$typenation1-$typenation2-$typenation3-$typenation4-$typenation5-$typenation6-$typenation7-$typenation8-$typenation9-$typenation10;
						  
						  $querynationout = $DB->QUERY("select nationalityname,count(id_card) as spin from temp".$current." where nationalityname!='0' AND in_out='2' group by nationalityname order by nationalityname asc");
						  $totalnationout  = 0;
						  while($recnationout = $DB->FETCHARRAY($querynationout)){
								$nationoutarr[$recnationout[nationalityname]][] = $recnationout[spin];
								$totalnationout = $totalnationout + $recnationout[spin];
						  }
						  $typenationout1 = ($nationoutarr[1][0]) ? $nationoutarr[1][0] : "0";
						  $typenationout2 = ($nationoutarr[2][0]) ? $nationoutarr[2][0] : "0";
						  $typenationout3 = ($nationoutarr[3][0]) ? $nationoutarr[3][0] : "0";
						  $typenationout4 = ($nationoutarr[4][0]) ? $nationoutarr[4][0] : "0";
						  $typenationout5 = ($nationoutarr[5][0]) ? $nationoutarr[5][0] : "0";
						  $typenationout6 = ($nationoutarr[6][0]) ? $nationoutarr[6][0] : "0";
						  $typenationout7 = ($nationoutarr[7][0]) ? $nationoutarr[7][0] : "0";
						  $typenationout8 = ($nationoutarr[8][0]) ? $nationoutarr[8][0] : "0";
						  $typenationout9 = ($nationoutarr[9][0]) ? $nationoutarr[9][0] : "0";
						  $typenationout10 = ($nationoutarr[10][0]) ? $nationoutarr[10][0] : "0";
						  $typenationoutno=$typeinout2-$typenationout1-$typenationout2-$typenationout3-$typenationout4-$typenationout5-$typenationout6-$typenationout7-$typenationout8-$typenationout9-$typenationout10;
				  ?>
                  <tr onmouseover="setPointer(this, 2, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 2, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 2, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20"><strong>2. สัญชาติ (คน)</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr onmouseover="setPointer(this, 3, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 3, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 3, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไทย</td>
                    <td align="center"><?php echo number_format($typenation1);?></td>
                    <td align="center"><?php echo number_format($typenationout1);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 4, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 4, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 4, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จีน/ฮ่องกง/ใต้หวัน</td>
                    <td align="center"><?php echo number_format($typenation2);?></td>
                    <td align="center"><?php echo number_format($typenationout2);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 5, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 5, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 5, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พม่า</td>
                    <td align="center"><?php echo number_format($typenation3);?></td>
                    <td align="center"><?php echo number_format($typenationout3);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 6, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 6, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 6, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;มาเลเซีย</td>
                    <td align="center"><?php echo number_format($typenation4);?></td>
                    <td align="center"><?php echo number_format($typenationout4);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 7, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 7, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 7, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กัมพูชา</td>
                    <td align="center"><?php echo number_format($typenation5);?></td>
                    <td align="center"><?php echo number_format($typenationout5);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 8, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 8, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 8, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลาว</td>
                    <td align="center"><?php echo number_format($typenation6);?></td>
                    <td align="center"><?php echo number_format($typenationout6);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 9, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 9, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 9, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เวียดนาม</td>
                    <td align="center"><?php echo number_format($typenation7);?></td>
                    <td align="center"><?php echo number_format($typenationout7);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 10, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 10, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 10, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยุโรป</td>
                    <td align="center"><?php echo number_format($typenation8);?></td>
                    <td align="center"><?php echo number_format($typenationout8);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 11, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 11, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 11, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อเมริกา</td>
                    <td align="center"><?php echo number_format($typenation9);?></td>
                    <td align="center"><?php echo number_format($typenationout9);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 12, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 12, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 12, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่ทราบสัญชาติ</td>
                    <td align="center"><?php echo number_format($typenation10);?></td>
                    <td align="center"><?php echo number_format($typenationout10);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 120, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 120, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 120, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่ระบุ</td>
                    <td align="center"><?php echo number_format($typenationno);?></td>
                    <td align="center"><?php echo number_format($typenationoutno);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 13, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 13, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 13, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td align="right" height="20"><strong>รวม</strong></td>
                    <td align="center"><strong><?php echo number_format($typeinout1);?></strong></td>
                    <td align="center"><strong><?php echo number_format($typeinout2);?></strong></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <?
					  $queryrig = $DB->QUERY("select erig_hrig,count(id_card) as spin from temp".$current." where erig_hrig!='0'  AND in_out='1' group by erig_hrig order by erig_hrig asc");
					  $totalrig = 0;
					  while($recrig = $DB->FETCHARRAY($queryrig)){
							$rigarr[$recrig[erig_hrig]][] = $recrig[spin];
							$totalrig = $totalrig + $recrig[spin];
					  }
					  $typerig1 = ($rigarr[1][0]) ? $rigarr[1][0] : "0";
					  $typerig2 = ($rigarr[2][0]) ? $rigarr[2][0] : "0";
					  
					  $queryrigout = $DB->QUERY("select erig_hrig,count(id_card) as spin from temp".$current." where erig_hrig!='0'  AND in_out='2' group by erig_hrig order by erig_hrig asc");
					  $totalrigout = 0;
					  while($recrigout = $DB->FETCHARRAY($queryrigout)){
							$rigoutarr[$recrigout[erig_hrig]][] = $recrigout[spin];
							$totalrigout = $totalrigout + $recrigout[spin];
					  }
					  $typerigout1 = ($rigoutarr[1][0]) ? $rigoutarr[1][0] : "0";
					  $typerigout2 = ($rigoutarr[2][0]) ? $rigoutarr[2][0] : "0";
				  ?>
                  <tr onmouseover="setPointer(this, 14, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 14, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 14, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20"><strong>3. ชนิดของอิมมูโนโกลบุลิน (RIG) (โด๊ส)</strong></td>
                    <td align="center"></td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr onmouseover="setPointer(this, 15, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 15, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 15, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ERIG</td>
                    <td align="center"><?php echo number_format($typerig1);?></td>
                    <td align="center"><?php echo number_format($typerigout1);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 16, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 16, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 16, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HRIG</td>
                    <td align="center"><?php echo number_format($typerig2);?></td>
                    <td align="center"><?php echo number_format($typerigout2);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 17, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 17, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 17, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20" align="right"><strong>รวม</strong></td>
                    <td align="center"><strong><?php echo number_format($totalrig);?></strong></td>
                    <td align="center"><strong><?php echo number_format($totalrigout);?></strong></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <?
						$sqlvaccinename = "select vaccine_name, count(id_card) as spin from temp2".$current." where (vaccine_name !='0') AND in_out='1' group by vaccine_name order by vaccine_name asc";
						$queryvaccinename = $DB->QUERY($sqlvaccinename);
						$totalvaccinename = 0;
						while($recvaccinename = $DB->FETCHARRAY($queryvaccinename)){
							$typevaccinenamearr[$recvaccinename[vaccine_name]][] = $recvaccinename[spin];
							$totalvaccinename = $totalvaccinename + $recvaccinename[spin];
						}
						$typevaccinename1 = ($typevaccinenamearr[1][0]) ? $typevaccinenamearr[1][0] : "0";
						$typevaccinename2 = ($typevaccinenamearr[2][0]) ? $typevaccinenamearr[2][0] : "0";
						$typevaccinename3 = ($typevaccinenamearr[3][0]) ? $typevaccinenamearr[3][0] : "0";
						$typevaccinename4 = ($typevaccinenamearr[4][0]) ? $typevaccinenamearr[4][0] : "0";


						$sqlvaccinename2 = "select vaccine_name, count(id_card) as spin from temp2".$current." where (vaccine_name !='0') AND in_out='2' group by vaccine_name order by vaccine_name asc";
						$queryvaccinename2 = $DB->QUERY($sqlvaccinename2);
						$totalvaccinename2 = 0;
						while($recvaccinename2 = $DB->FETCHARRAY($queryvaccinename2)){
							$typevaccinename2arr[$recvaccinename2[vaccine_name]][] = $recvaccinename2[spin];
							$totalvaccinename2 = $totalvaccinename2 + $recvaccinename2[spin];
						}
						$typevaccinename21 = ($typevaccinename2arr[1][0]) ? $typevaccinename2arr[1][0] : "0";
						$typevaccinename22 = ($typevaccinename2arr[2][0]) ? $typevaccinename2arr[2][0] : "0";
						$typevaccinename23 = ($typevaccinename2arr[3][0]) ? $typevaccinename2arr[3][0] : "0";
						$typevaccinename24 = ($typevaccinename2arr[4][0]) ? $typevaccinename2arr[4][0] : "0";
				?>
                  <tr onmouseover="setPointer(this, 18, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 18, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 18, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20"><strong>4. ชนิดของวัคซีน (โด๊ส)</strong></td>
                    <td align="center"></td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr onmouseover="setPointer(this, 19, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 19, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 19, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PVRV</td>
                    <td align="center"><?php echo number_format($typevaccinename1);?></td>
                    <td align="center"><?php echo number_format($typevaccinename21);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 20, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 20, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 20, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PCEC</td>
                    <td align="center"><?php echo number_format($typevaccinename2);?></td>
                    <td align="center"><?php echo number_format($typevaccinename22);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 21, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 21, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 21, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HDCV</td>
                    <td align="center"><?php echo number_format($typevaccinename3);?></td>
                    <td align="center"><?php echo number_format($typevaccinename23);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 22, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 22, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 22, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PDEV</td>
                    <td align="center"><?php echo number_format($typevaccinename4);?></td>
                    <td align="center"><?php echo number_format($typevaccinename24);?></td>
                  </tr>
                  <tr onmouseover="setPointer(this, 23, 'over', '#FFFFFF', '#AED7FF', '#FFCC99');" onmouseout="setPointer(this, 23, 'out', '#FFFFFF', '#AED7FF', '#FFCC99');" onmousedown="setPointer(this, 23, 'click', '#FFFFFF', '#AED7FF', '#FFCC99');">
                    <td height="20" align="right"><strong>รวม</strong></td>
                    <td align="center"><?php echo number_format($totalvaccinename);?></td>
                    <td align="center"><?php echo number_format($totalvaccinename2);?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3"><hr align="center" width="100%" size="1" /></td>
                  </tr>
                  <tr>
                    <td height="20" align="center" colspan="3"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;
                    	<a href="#" onclick="document.formshow.action = 'printview8.php';document.formshow.target='_blank';document.formshow.submit();">พิมพ์รายงาน</a>
                    </td>
                  </tr>
                </table>
</div><!-- report -->
<?php endif; ?>