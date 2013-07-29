<script type="text/javascript">
$(document).ready(function(){
	$('.tr-graph').hide();
	$('td[colspan]').addClass('hasRowSpan');
	$('[name=close]').click(function(){$(this).closest('tr').fadeOut('slow');})		
	
	function graph(title,render,t_graph,arr,arr_val)
	{		       	       	
        	     	
        	if(t_graph=="column"){
        		a="center"      		
        	}else if(t_graph=="bar"){
        		a="right";
        	}	
       		
        	//$('#'+render).highcharts({
            chart = new Highcharts.Chart({
            chart: {  
            	renderTo :render,              
                type: t_graph,width:680,height:302
            },
            title: { marginBottom:15,text: title,style: {color: '#000000',fontSize: '14px'}},
            yAxis: {
            	title:{
            		text: '', style: {color: '#000000'}         		          		
            	}            	
            },			
            tooltip: {valueSuffix: ''},
            credits: {enabled: false},
            legend: {enabled: false},
            plotOptions: {            	
            	bar: { dataLabels: {enabled: true}},            	
            	column: { dataLabels: {enabled: true}},
            	pie:{ dataLabels: {enabled: true}}
               
            },           
            xAxis: {categories: arr,            		         	
	            	labels: {	                	
	                	align:a,
	                	x: 0,
	                	y: 10
	            	}             		            	         	          
            },          
            series: [{data:arr_val}]			
		});	
				
	}// graph
	$('.img').click(function(){
			var title 	= $(this).closest('td').find('span').html();			
			var t_graph = $(this).attr('name');		
			var render 	= $(this).closest('td').find('input[name=render]').val();									
			var arr=[],arr_val=[],arr_val_all=[],pre=[];	
			var para,title_padd,j=0,k=0;
			var obj={};
			$(this).closest('tr').next().nextUntil('.tr-graph').prev().each(function(i,value){								 
				arr[j] = $(this).find('.para1 label').html();
				para = $(this).find('td:eq(1) span').html();				
				arr_val[j]	= parseFloat(para);
				arr_val_all[j] = [arr[j],arr_val[j]];
				j++;	
			});// tr-graph			
		if(t_graph=="pie"){
			graph(title,render,t_graph,arr,arr_val_all);			
		}else{
			graph(title,render,t_graph,arr,arr_val);
		}				
		$(this).closest('tr').nextAll('.tr-graph:eq(0)').fadeIn('slow');
	});	
})

</script>
<div id="title">ข้อมูลการฉีดวัคซีน</div>
<div id="search">
<form action="report/index/5" method="get" name="formreport">
	<table  class="tb_patient1">
	<?php require 'include/conditionreport.php'; ?>	
	  <tr>
	    <th>ปีสัมผัสโรค</th>
	    <td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>
		<th>เดือนที่สัมผัสโรค</th>
	    <td><?php echo form_dropdown('month_start',get_month(),@$_GET['month_start'],'class="styled-select"','ทั้งหมด'); ?> - 
	    	<?php echo form_dropdown('month_end',get_month(),@$_GET['month_end'],'class="styled-select"','ทั้งหมด'); ?>		
		</td>
	 </tr>
	 <tr>
	  <th>ปีที่บันทึกรายการ</th>
	    <td><?php echo form_dropdown('year_report_start',get_year_option(),@$_GET['year_report_start'],'class="styled-select"','ทั้งหมด') ?></td>		
		<th>เดือนที่บันทึกรายการ</th>
    	<td>
		<?php echo form_dropdown('month_report_start',get_month(),@$_GET['month_report_start'],'class="styled-select"','ทั้งหมด'); ?>	 - 
		<?php echo form_dropdown('month_report_end',get_month(),@$_GET['month_report_end'],'class="styled-select"','ทั้งหมด'); ?>	</td>
	  </tr>
</table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul></div>	
</form>

</div>
<? if(!empty($cond)): ?>
<div id="report">
	<div id="title"><p>รายงานการฉีดวัคซีน</p>
	<p>เขตความรับผิดชอบ <?php echo $textarea; ?>  : เขต <?php echo $textgroup ?> จังหวัด <?php echo $textprovince ?>  อำเภอ <?php echo $textamphur ?>  ตำบล <?php echo $textdistrict ?></p>
	<p>สถานบริการ <?php echo $texthospital ?> <span>ปี <?php echo $textyear_start ?></span> เดือน  <?php echo $textmonth_start ?> ถึง <?php echo $textmonth_end ?></p>
 </div>
	<table class="tbreport" style="width:70%;margin-left:15%;margin-right:15%;">
		<tr><td colspan="2" style="text-align:right;"><a href="report/index/5<?php echo '?'.$_SERVER['QUERY_STRING'].'&excel=excel' ?>" class="excel" name="btn_excel"></a></td></tr>
		<tr><td colspan="2" style="text-align:right;">หน่วย:คน</td></tr>
		<tr>
			<th style="text-align:center">เงื่อนไข</th><th style="text-align:left">จำนวน (N=<?php echo number_format($total_n); ?>)</th>
		</tr>
		<tr>
			<td>1. ผู้สัมผัสโรคพิษสุนัขบ้าที่<strong>ไม่เคยฉีดวัคซีน หรือเคยฉีดน้อยกว่า 3 เข็ม</strong></td>
			<td  class="aligncenter"><strong><?php echo $total; ?></strong></td>			
		</tr>	
		<tr>
			<td colspan="2">2.<span> ผู้สัมผัสโรค <strong>มีประวัติเคยฉีดวัคซีน</strong>ป้องกันโรคพิษสุนัขบ้า<strong>ภายใน 6 เดือน</strong>ได้รับการฉีดวัคซีน </span>
				<input type="hidden" name="render" value="container1">
				<button class="bar-chart img"  name="bar"></button>
				<button class="column-chart img" name="column"></button>
	    		<button class="pie-chart img" name="pie"></button>			
			</td>
			
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label>1 เข็ม</label></span></td>
			<td class="aligncenter"><span class="none"><?php echo $v6 ?></span><?php echo number_format($v6) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน <label>2 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v7 ?></span><?php echo number_format($v7) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label>3 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v8 ?></span><?php echo number_format($v8) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label>4 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v9 ?></span><?php echo number_format($v9) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 5 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v10 ?></span><?php echo number_format($v10) ?></td>
		</tr>
		<tr>
			<td  class="aligncenter"><strong>รวม</strong></td>
			<td  class="aligncenter"><strong><?php echo number_format($total2) ?></strong></td>
		</tr>
		<tr class="tr-graph">
		  	<td colspan="2">
		  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
		  			<div id="container1" class="container"></div> 			
		  		</div>
		  	</td>
		</tr>		
		<tr>
			<td colspan="2"><strong>3.ผู้สัมผัสโรค<strong>มีประวัติเคยฉีดวัคซีน</strong>ป้องกันโรคพิษสุนัขบ้า<strong>เกิน 6 เดือน</strong> ได้รับการฉีดวัคซีน</strong>
				<input type="hidden" name="render" value="container2">
				<button class="bar-chart img"  name="bar"></button>
				<button class="column-chart img" name="column"></button>
	    		<button class="pie-chart img" name="pie"></button>				
			</td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 1 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v11; ?></span><?php echo number_format($v11) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 2 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v12; ?></span><?php echo number_format($v12) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 3 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v13; ?></span><?php echo number_format($v13) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 4 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v14; ?></span><?php echo number_format($v14) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 5 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v15; ?></span><?php echo number_format($v15) ?></td>
		</tr>
		<tr>
			<td  class="aligncenter"><strong>รวม</strong></td>
			<td  class="aligncenter"><strong><?php echo number_format($total3) ?></strong></td>
		</tr>
		<tr class="tr-graph">
		  	<td colspan="2">
		  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
		  			<div id="container2" class="container"></div> 			
		  		</div>
		  	</td>
		</tr>		
		<tr>
			<td colspan="2"><strong>4. ผู้สัมผัสที่ถูกสุนัขหรือแมวกัดแล้วสัตว์<strong>ไม่ตายภายใน 10 วัน</strong> โดยผู้สงสัยว่าสัมผัสโรค ได้รับการฉีดวัคซีนครั้งนี้</strong>
				<input type="hidden" name="render" value="container3">
				<button class="bar-chart img"  name="bar"></button>
				<button class="column-chart img" name="column"></button>
	    		<button class="pie-chart img" name="pie"></button>				
			</td>
			
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 1 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v16; ?></span><?php echo number_format($v16) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 2 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v17; ?></span><?php echo number_format($v17) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน <label>3 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v18; ?></span><?php echo number_format($v18) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน <label>4 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v19; ?></span><?php echo number_format($v19) ?></td>
		</tr>
		<tr>
			<td><span class="para1">- จำนวน<label> 5 เข็ม</label></span></td>
			<td  class="aligncenter"><span class="none"><?php echo $v20; ?></span><?php echo number_format($v20) ?></td>
		</tr>
		<tr>
			<td  class="aligncenter"><strong>รวม</strong></td>
			<td  class="aligncenter"><strong><?php echo number_format($total4) ?></strong></td>
		</tr>
		<tr class="tr-graph">
		  	<td colspan="3">
		  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
		  			<div id="container3" class="container"></div> 			
		  		</div>
		  	</td>
		</tr>		
		<tr>
			<td>5. ผู้สัมผัสโรคพิษสุนัขบ้า<strong>ฉีดวัคซีนไม่ครบเนื่องจากไม่สามารถติดตามได้หรือไม่ประสงค์จะฉีดต่อ</strong></td>
			<td><strong><?php echo number_format($total5) ?></strong></td>
		</tr>
		<tr>
			<td colspan="2"><strong>6. ชนิดของวัคซีน (โด๊ส)</strong>
				<input type="hidden" name="render" value="container4">
				<button class="bar-chart img"  name="bar"></button>
				<button class="column-chart img" name="column"></button>
	    		<button class="pie-chart img" name="pie"></button>				
			</td>			
		</tr>
			<tr>
			<td><span class="para1">- <label>PVRV</label></span></td>
			<td  class="aligncenter"><span class="none"><? echo $v21; ?></span><? echo number_format($v21); ?></td>
		</tr>
				<tr>
			<td><span class="para1">- <label>PCEC</label></span></td>
			<td  class="aligncenter"><span class="none"><? echo $v22; ?></span><? echo number_format($v22); ?></td>
		</tr>
				<tr>
			<td><span class="para1">- <label>HDCV</label></span></td>
			<td class="aligncenter"><span class="none"><? echo $v23; ?></span><? echo number_format($v23); ?></td>
		</tr>
				<tr>
			<td><span class="para1">- <label>PDEV</label></span></td>
			<td  class="aligncenter"><span class="none"><? echo $v24; ?></span><? echo number_format($v24); ?></td>
		</tr>		
		<tr>
			<td class="aligncenter"><strong>รวม</strong></td>
			<td class="aligncenter"><strong><? echo number_format($total6); ?></strong></td>
		</tr>
		<tr class="tr-graph">
		  	<td colspan="3">
		  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
		  			<div id="container4" class="container"></div> 			
		  		</div>
		  	</td>
		</tr>
	</table>
	<hr class="hr1">
	<div id="description">
		<p class="heading">หลักเกณฑ์การให้บริการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าที่ถูกต้อง</p>
		<ul>
			<li><strong>ผู้สัมผัสโรคพิษสุนัขบ้าที่ไม่เคยได้รับการฉีดวัคซีนฯ มาก่อน</strong> เมื่อได้รับเชื้อ (สัตว์ที่สัมผัสเป็นโรคพิษสุนัขบ้าและลักษณะที่สัมผัสเสี่ยงต่อการได้รับเชื้อ) 
				ต้องได้รับการฉีดวัคซีนครบชุด (ID 4 เข็ม, IM 5 เข็ม) กรณีที่สัตว์ที่สัมผัสเป็นสุนัขหรือแมวที่ไม่แน่ใจว่าเป็นโรคพิษสุนัขบ้าหรือไม่และสามารถติดตามดูอาการได้ 
				ถ้าสุนัขหรือแมวมีอาการปกติไม่ตายภายหลังการสัมผัส 10 วัน 
				ให้หยุดฉีดวัคซีนฯ ได้</li>
		  <li>
		  	<strong>ผู้สัมผัสที่เคยได้รับการฉีดวัคซีนที่มีคุณภาพมาแล้ว</strong>ตั้งแต่ 3 เข็มขึ้นไป ถ้าได้รับวัคซีนเข็มสุดท้ายไม่เกิน 6 เดือนต้องได้รับการฉีดวัคซีนฯ 
			กระตุ้น อีก 1 เข็ม แต่ถ้าได้รับวัคซีนเข็มสุดท้ายเกิน 6 เดือนต้องได้รับการฉีดวัคซีนกระตุ้นอีก 2 เข็ม
		  </li>
		  <li>
		  	 กรณีที่สัตว์สัมผัสเป็นสุนัขหรือแมวหลังจากเฝ้าดูอาการแล้ว 10 วัน หลังจากถูกกัด ยังมีอาการปกติให้ถือว่าสุนัขหรือแมวนั้นไม่มีเชื้อในขณะที่ถูกกัด จึงให้หยุดฉีดวัคซีนได้
		  </li>		  		  	
		</ul>
		<div><strong>(ผู้สัมผัสที่ได้รับวัคซีนที่มีคุณภาพมาแล้วน้อยกว่า 3 เข็ม หรือได้รับวัคซีนป้องกันโรคพิษสุนัขบ้าชนิดที่ผลิตจากสมองสัตว์  ให้ปฎิบัติเหมือนผู้ที่ไม่เคยได้รับการฉีดวัคซีนมาก่อน)</strong></div>
	</div>

	<div id="reference"><?php echo $reference?></div>	
		<div id="btn_printout"><a href="report/index/5<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>
<?php endif; ?>