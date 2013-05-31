<div id="title">ข้อมูลการสัมผัสโรค - รายเดือน</div>
<div id="search">
<form action="report/index/3" method="post" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
		<table class="tb_patient1">
			  <tr>
				<th>เขตความรับผิดชอบ</th>
				<td>
					<select name="area" class="styled-select widthselect"  id="area" onchange="ListGroupByArea();">
						<option value="-">กรุณาเลือกเขต</option>
						<option value="1">รูปแบบเดิม (12 เขต)</option>
						<option value="2">รูปแบบใหม่ (19 เขต)</option>
					</select>
				</td>
				<th>เขตที่</th>
				<td>
				<span id="grouplist">
					<select name="group" class="styled-select widthselect" id="group">
						<option value="">ทั้งหมด</option>
					</select>
				</span></td>

				<th>จังหวัด</th>
				<td>
				<span id="provincelist">
					<select name="province" class="styled-select widthselect">
						<option value="">ทั้งหมด</option>
					</select>
				</span></td>
			  </tr>
		  <tr>
			<th>อำเภอ</th>
			<td>
				<span id="amphurlist">
					<select name="amphur" class="styled-select widthselect">
						<option value="">ทั้งหมด</option>
					</select>
				</span>
			</td>
			<th>สถานบริการ</th>
			<td>
				<span id="hospitallist">
				<select name="hospital" class="styled-select widthselect">
					<option value="">ทั้งหมด</option>
				</select>
				</span>
			</td>

		    <th>ปี</th>
		    <td>
				<select name="year" class="styled-select">
				<option value="">ทั้งหมด</option>
				<?
				$syear = (date('Y')+543)-10;
				for($i=$syear;$i<=(date('Y')+543);$i++){
				?>
					<option value="<?=$i;?>"><?=$i;?></option>
				<?
				}
				?>
				</select>
			</td>
	      </tr>
	  </table>
  <div class="btn_inline">
      <ul>
      	<li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li>
      </ul>
</div>	
</form>
</div>
<div id="report">
		<div id="title">				  
		<p>รายงานผู้สัมผัสโรครายเดือน</p>
	    <p>เขตความรับผิดชอบ (<?php echo $textarea;?>) :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>โรงพยาบาล <?php echo $texthospital;?>  ปี  <?php echo $textyear;?>  เดือน  <?php echo $textmonth;?></p>				
		</div>
	<div class="right">หน่วย:คน</div>
	<table class="tbreport">
		<thead>
			<tr>
				<th rowspan="2">ข้อมูล</th>
				<th colspan="13">เดือน (N=362)</th>
			</tr>		
			<tr>
				<th>ม.ค.</th>
				<th>ก.พ.</th>
				<th>มี.ค.</th>
				<th>เม.ย.</th>
				<th>พ.ค.</th>
				<th>มิ.ย.</th>
				<th>ก.ค.</th>
				<th>ส.ค.</th>
				<th>ก.ย.</th>
				<th>ต.ค.</th>
				<th>พ.ย.</th>
				<th>ธ.ค.</th>
				<th >รวม</th>
			</tr>
		</thead>
		<tbody>
		<tr class="para1">
			<td align="left"><strong>ผู้สัมผัสโรคพิษสุนัขบ้า</strong></td>
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>48</td>
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
	
		</tr>
		<tr ><td colspan="6"><strong>เพศ</strong></td></tr>
		<tr class="para1">
			<td class="pad-left">ชาย</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">หญิง</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr ><td colspan="6"><strong>กลุ่มอายุ</strong></td></tr>
		<tr class="para1">
			<td class="pad-left">ต่ำกว่า 1 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>												
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">1-5 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">6-10 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">11-15 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">16-25 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">26-35 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">36-45 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">46-55 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">56-65 ปี</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">66 ปีขึ้นไป</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr ><td colspan="6"><strong>สถานที่สัมผัสโรค</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">เขต กทม.</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">เขตเมืองพัทยา</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">เขตเทศบาล</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">เขต อบต.</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>

		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr ><td colspan="6"><strong>ชนิดสัตว์นำโรค</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">สุนัข</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">แมว</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ลิง</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">ชะนี</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">หนู</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">อื่นๆ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr ><td colspan="6"><strong>อายุสัตว์</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">น้อยกว่า 3 เดือน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">3-6 เดือน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">6-12 เดือน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">มากกว่า 1 ปี</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ทราบ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
	<tr class="page-break"><td colspan="6"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong></td></tr>	
		<tr class="para1">
			<td class="pad-left">กักขังได้ / ติดตามได้</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left2">ตายภายใน 10 วัน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">กักขังไม่ได้</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">ถูกฆ่าตาย</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>
		<tr class="para1">
			<td class="pad-left">หนีหาย / จำไม่ได้</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>		
			<td>34</td>
			<td>54</td>
			<td>23</td>
			<td>62</td>
			<td>0</td>
			<td>3</td>
			<td>5</td>
			<td>362</td>
		</tr>

		</tbody>																							
	</table>
		<hr class="hr1">
		<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>			
		<div id="btn_printout"><a href="report/index/2/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>
