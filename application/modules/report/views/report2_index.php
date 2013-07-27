<script type="text/javascript">
$(document).ready(function(){
	function graph(title,render,t_graph,arr_val_all,w=900,h=302){	
        
        $('#'+render).highcharts({
            // 700,560
            chart: {                
                type: t_graph,width:600,height:302,marginBottom: 60
            },
            title: { marginBottom:15,text: 'ร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตาม'+title,style: {color: '#000000',fontSize: '14px'}},
            yAxis: {
            	title:{
            		text: null          		          		
            	}            	
            },			
            tooltip: {valueSuffix: ' %'},
            credits: {enabled: false},
            legend: {
                layout: 'horizontal',
                align: 'bottom',
                verticalAlign: 'bottom',
                align :'center',
                rotation:90,
                x: 40,
                y: 10,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            plotOptions: {            	
            	bar: { dataLabels: {enabled: true}},            	
            	column: { dataLabels: {enabled: true}},
            	pie:{ dataLabels: {enabled: true}}
               
            },           
            xAxis:{ categories: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย', 'พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
                title: {
                    text: null
                }
             },
			 series:arr_val_all			
		});	
			
	}					
	$('.tr-graph2').hide();
	$('td[colspan]').addClass('hasRowSpan');
	$('[name=close]').click(function(){$(this).closest('tr').fadeOut('slow');})
	
	$('.img').click(function(){
		var title 	= $(this).closest('tr').find('td:eq(0)').children('strong:eq(0)').html();
		var t_graph = $(this).attr('name');		
		var render 	= $(this).closest('td').find('input[name=render]').val();									
		var arr ={};
		var arr_val=[],arr_val_all=[];	
		var padd_left,j=0;
		if(title=="เพศ" || title=="สถานที่สัมผัสโรค"){var w=700;var h=560;}			
			$(this).closest('tr').nextUntil('.tr-graph2').each(function(i,value){	
								
				if($(this).find('.pad-left').html()!=null){
					
					pad_left=$(this).find('.pad-left').html();
					$(this).children().not('.pad-left').slice(0,12).each(function(index,vals){											
						arr_val[index]=	parseFloat($(this).find('p').html());								
					})
				 	arr['name'] = pad_left;
				 	arr['data'] = arr_val;					 		
					arr_val_all[j] = jQuery.parseJSON(JSON.stringify(arr));
					j=j+1;
				}															  																
			});			
		//console.log(arr_val_all);
		graph(title,render,t_graph,arr_val_all,w,h)				
		$(this).closest('tr').nextAll('.tr-graph2:eq(0)').fadeIn('slow');				
	});	

	 $('#button').click(function() {
        var chart = $('#container1').highcharts();
        chart.print();
    });	
})
</script>
<div id="title">ข้อมูลการสัมผัสโรค - รายเดือน</div>
<div id="search">
<form action="report/index/2" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
<table class="tb_patient1">
<?php require 'include/conditionreport.php'; ?>
	<tr>
	    <th>ปีที่สัมผัสโรค</th>
	    <td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>						
      </tr>  
</table>
<div class="btn_inline"><ul><li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li></ul></div>	
</form>
</div>
<?php if($cond): ?>
<div id="report">
		<div id="title">				  
		<p>รายงานผู้สัมผัสโรครายเดือน</p>
	    <p>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?></p>				
		</div>
		<div class="right">
		<a href="report/index/2<?php echo '?'.$_SERVER['QUERY_STRING'].'&excel=excel' ?>" class="excel" name="btn_excel"></a></div> 	
	<table class="tbreport">
		<thead>
			<tr><td colspan="14" style="text-align:right;">หน่วย:คน</td></tr>
			<tr>
				<th rowspan="2">ข้อมูล</th><th colspan="14">เดือน (N = <? echo number_format($total_n) ?>)</th>
			</tr>		
			<tr><th>ม.ค.</th><th>ก.พ.</th><th>มี.ค.</th><th>เม.ย.</th><th>พ.ค.</th><th>มิ.ย.</th><th>ก.ค.</th><th>ส.ค.</th><th>ก.ย.</th><th>ต.ค.</th><th>พ.ย.</th><th>ธ.ค.</th><th >รวม</th></tr>
		</thead>
		<tbody>
		<tr class="para1">
			<td align="left"><strong>ผู้สัมผัสโรคพิษสุนัขบ้า</strong></td>
			<?php for($i=1;$i<13;$i++): ?>
				<td><? echo number_format(${'total_m'.$i}) ?></td>
			<?php endfor; ?>
			<td><? echo number_format($total_n); ?></td>	
		</tr>
		<tr><td colspan="14"><strong>เพศ</strong>
			<input type="hidden" name="render" value="container1">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    				
		</td></tr>
		<tr class="para1">
			<td class="pad-left">ชาย</td>			
			<td><?php echo number_format($total_gender11) ?> <p class="percentage"><?php echo compute_percent($total_gender11,$total_m1); ?></p></td>
			<td><?php echo number_format($total_gender12) ?> <p class="percentage"><?php echo compute_percent($total_gender12,$total_m2); ?></p></td>
			<td><?php echo number_format($total_gender13) ?> <p class="percentage"><?php echo compute_percent($total_gender13,$total_m3); ?></p></td>
			<td><?php echo number_format($total_gender14) ?> <p class="percentage"><?php echo compute_percent($total_gender14,$total_m4); ?></p></td>
			<td><?php echo number_format($total_gender15) ?> <p class="percentage"><?php echo compute_percent($total_gender15,$total_m5); ?></p></td>
			<td><?php echo number_format($total_gender16) ?> <p class="percentage"><?php echo compute_percent($total_gender16,$total_m6); ?></p></td>
			<td><?php echo number_format($total_gender17) ?> <p class="percentage"><?php echo compute_percent($total_gender17,$total_m7); ?></p></td>
			<td><?php echo number_format($total_gender18) ?> <p class="percentage"><?php echo compute_percent($total_gender18,$total_m8); ?></p></td>
			<td><?php echo number_format($total_gender19) ?> <p class="percentage"><?php echo compute_percent($total_gender19,$total_m9); ?></p></td>
			<td><?php echo number_format($total_gender110) ?> <p class="percentage"><?php echo compute_percent($total_gender110,$total_m10); ?></p></td>
			<td><?php echo number_format($total_gender111) ?> <p class="percentage"><?php echo compute_percent($total_gender111,$total_m11); ?></p></td>
			<td><?php echo number_format($total_gender112) ?> <p class="percentage"><?php echo compute_percent($total_gender112,$total_m12); ?></p></td>
			<td><?php echo number_format($total_gender_all1) ?> <p class="percentage"><?php echo compute_percent($total_gender_all1,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left">หญิง</td>
			<td><?php echo  number_format($total_gender21) ?> <p class="percentage"><?php echo compute_percent($total_gender21,$total_m1); ?></p></td>
			<td><?php echo  number_format($total_gender22) ?> <p class="percentage"><?php echo compute_percent($total_gender22,$total_m2); ?></p></td>
			<td><?php echo  number_format($total_gender23) ?> <p class="percentage"><?php echo compute_percent($total_gender23,$total_m3); ?></p></td>
			<td><?php echo  number_format($total_gender24) ?> <p class="percentage"><?php echo compute_percent($total_gender24,$total_m4); ?></p></td>
			<td><?php echo  number_format($total_gender25) ?> <p class="percentage"><?php echo compute_percent($total_gender25,$total_m5); ?></p></td>
			<td><?php echo  number_format($total_gender26) ?> <p class="percentage"><?php echo compute_percent($total_gender26,$total_m6); ?></p></td>
			<td><?php echo  number_format($total_gender27) ?> <p class="percentage"><?php echo compute_percent($total_gender27,$total_m7); ?></p></td>
			<td><?php echo  number_format($total_gender28) ?> <p class="percentage"><?php echo compute_percent($total_gender28,$total_m8); ?></p></td>
			<td><?php echo  number_format($total_gender29) ?> <p class="percentage"><?php echo compute_percent($total_gender29,$total_m9); ?></p></td>
			<td><?php echo  number_format($total_gender210) ?> <p class="percentage"><?php echo compute_percent($total_gender210,$total_m10); ?></p></td>
			<td><?php echo  number_format($total_gender211) ?> <p class="percentage"><?php echo compute_percent($total_gender211,$total_m11); ?></p></td>
			<td><?php echo  number_format($total_gender212) ?> <p class="percentage"><?php echo compute_percent($total_gender212,$total_m12); ?></p></td>
			<td><?php echo  number_format($total_gender_all2) ?> <p class="percentage"><?php echo compute_percent($total_gender_all2,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td><?php echo  number_format($total_gender01) ?> <p class="percentage"><?php echo compute_percent($total_gender01,$total_m1); ?></p></td>
			<td><?php echo  number_format($total_gender02) ?> <p class="percentage"><?php echo compute_percent($total_gender02,$total_m2); ?></p></td>
			<td><?php echo  number_format($total_gender03) ?> <p class="percentage"><?php echo compute_percent($total_gender03,$total_m3); ?></p></td>
			<td><?php echo  number_format($total_gender04) ?> <p class="percentage"><?php echo compute_percent($total_gender04,$total_m4); ?></p></td>
			<td><?php echo  number_format($total_gender05) ?> <p class="percentage"><?php echo compute_percent($total_gender05,$total_m5); ?></p></td>
			<td><?php echo  number_format($total_gender06) ?> <p class="percentage"><?php echo compute_percent($total_gender06,$total_m6); ?></p></td>
			<td><?php echo  number_format($total_gender07) ?> <p class="percentage"><?php echo compute_percent($total_gender07,$total_m7); ?></p></td>
			<td><?php echo  number_format($total_gender08) ?> <p class="percentage"><?php echo compute_percent($total_gender08,$total_m8); ?></p></td>
			<td><?php echo  number_format($total_gender09) ?> <p class="percentage"><?php echo compute_percent($total_gender09,$total_m9); ?></p></td>
			<td><?php echo  number_format($total_gender010) ?> <p class="percentage"><?php echo compute_percent($total_gender010,$total_m10); ?></p></td>
			<td><?php echo  number_format($total_gender011) ?> <p class="percentage"><?php echo compute_percent($total_gender011,$total_m11); ?></p></td>
			<td><?php echo  number_format($total_gender012) ?> <p class="percentage"><?php echo compute_percent($total_gender012,$total_m12); ?></p></td>
			<td><?php echo  number_format($total_gender_all0) ?> <p class="percentage"><?php echo compute_percent($total_gender_all0,$total_n); ?></p></td>
		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">  		
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container1" class="container1"></div> 			
  		</div>
  	</td>
</tr>
		<tr ><td colspan="14"><strong>กลุ่มอายุ</strong>
			<!--<input type="hidden" name="render" value="container2">	
			<button class="bar-chart img"  name="bar"></button>		
			<button class="column-chart img" name="column"></button>-->
    					
		</td></tr>
		<?php $age=array(1=>'ต่ำกว่า 1 ปี',2=>'1-5 ปี',3=>'6-10 ปี',4=>'11-15 ปี',5=>'16-25 ปี'
						,6=>'26-35 ปี',7=>'36-45 ปี',8=>'46-55 ปี',9=>'56-65 ปี',10=>'66 ปีขึ้นไป'); ?>
		<?php  for($i=1;$i<11;$i++):?>			
		<tr class="para1">
			<td class="pad-left"><? echo $age[$i];?></td>
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_age'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_age'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_age_all'.$i});?><p class="percentage"><?php echo compute_percent(${'total_age_all'.$i},$total_n); ?></p></td>
		</tr>
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_age11'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_age11'.$j},$total_m11); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_age_all11); ?><p class="percentage"><?php echo compute_percent($total_age_all11,$total_n); ?></p></td>
			
		</tr>
 <tr class="tr-graph2" >
  	<td colspan="14">
    	<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close" >X</button>
  			<div id="container2" class="container1" style="width:720px;height:575px;"></div> 			
  		</div>
 		
  	</td>
</tr>		
						
		<tr ><td colspan="14"><strong>สถานที่สัมผัสโรค</strong>
			<!--<input type="hidden" name="render" value="container3">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>-->
    						
		</td></tr>
		<?php $place= array(1=>'เขต กทม.',2=>'เขตเมืองพัทยา',3=>'เขตเทศบาล',4=>'เขต อบต.',5=>'ไม่ระบุ'); ?>	
		<?php for($i=1;$i<6;$i++): ?>
		<tr class="para1">			
			<td class="pad-left"><?php echo $place[$i]; //if($i==5)$i=0;?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_place'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_place'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_place_all'.$i});?><p class="percentage"><?php echo compute_percent(${'total_place_all'.$i},$total_n); ?></p></td>
		<?php endfor; ?>
		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container3" class="container1"></div> 			
  		</div>  		
  	</td>
</tr>			
		<tr class="page-break"></tr>			
		<tr><td colspan="14"><strong>ชนิดสัตว์นำโรค</strong>
			<!--<input type="hidden" name="render" value="container4">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    		<button class="pie-chart img" name="pie"></button>-->			
		</td></tr>
	<?php $animal = array(1=>'สุนัข',2=>'แมว',3=>'ลิง',4=>'ชะนี',5=>'หนู',6=>'อื่นๆ',7=>'ไม่ระบุ'); ?>	
		<?php for($i=1;$i<8;$i++): ?>
		<tr class="para1">			
			<td class="pad-left"><?php echo $animal[$i]; //if($i==7)$i=0;?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_animal'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_animal'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_animal_all'.$i});?><p class="percentage"><?php echo compute_percent(${'total_animal_all'.$i},$total_n); ?></p></td>
		<?php endfor; ?>
		</tr>

 <tr class="tr-graph2">
  	<td colspan="14">
   		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container4" class="container1"></div> 			
  		</div> 		
  	</td>
</tr>

		<tr ><td colspan="14"><strong>อายุสัตว์</strong>
			<!--<input type="hidden" name="render" value="container5">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>-->
    				
		</td></tr>	
		<?php $ageanimal = array(1=>'น้อยกว่า 3 เดือน',2=>'3-6 เดือน',3=>'6-12 เดือน',4=>'มากกว่า 1 ปี',5=>'ไม่ทราบ',6=>'ไม่ระบุ');  ?>
		<?php for($i=1;$i<7;$i++):?>
		<tr class="para1">			
			<td class="pad-left"><?php echo $ageanimal[$i];  //if($i==6)$i=0;?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_ageanimal'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_ageanimal'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_ageanimal_all'.$i})?><p class="percentage"><?php echo compute_percent(${'total_ageanimal_all'.$i},$total_n); ?></p></td>
		<?php endfor; ?>
		</tr>		
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container5" class="container1"></div> 			
  		</div>  		
  	</td>
</tr>		
	<tr><td colspan="14"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong>
			<input type="hidden" name="render" value="container6">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    			
	</td></tr>	
		<?php 
		//$array[0][0] = "ไม่ระบุ";	$array[1][1] = "ตายเองภายใน 10 วัน";$array[1][2] = "ไม่ตายภายใน 10 วัน";$array[2][0] = "กักขังไม่ได้";$array[3][0] = "ถูกฆ่าตาย";$array[4][0] = "หนีหาย / จำไม่ได้";
		?>
		<tr class="para1">
			<td class="pad-left">กักขังได้ / ติดตามได้</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all10); ?> <p class="percentage"><?php echo compute_percent($total_detain_all10,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left2">ตายภายใน 10 วัน</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain11'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain11'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all11); ?> <p class="percentage"><?php echo compute_percent($total_detain_all11,$total_n); ?></p></td>
		</tr>
		<tr class="para1">
			<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain12'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain12'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all12); ?> <p class="percentage"><?php echo compute_percent($total_detain_all12,$total_n); ?></p></td>
		</tr>	
		<tr class="para1">
			<td class="pad-left">กักขังไม่ได้</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all20); ?> <p class="percentage"><?php echo compute_percent($total_detain_all20,$total_n); ?></p></td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ถูกฆ่าตาย</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain30'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain30'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all30); ?> <p class="percentage"><?php echo compute_percent($total_detain_all30,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">หนีหาย / จำไม่ได้</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain40'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain40'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all40); ?> <p class="percentage"><?php echo compute_percent($total_detain_all40,$total_n); ?></p></td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_detain00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_detain00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_detain_all00); ?> <p class="percentage"><?php echo compute_percent($total_detain_all00,$total_n); ?></p></td>
		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">
   		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container6" class="container1"></div> 			
  		</div> 		
  	</td>
</tr>	
	<tr><td colspan="14"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า</strong>
			<input type="hidden" name="render" value="container7">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    				
	</td></tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ทราบ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all10); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all10,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่เคยฉีด</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all20); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all20,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">เคยฉีด 1 ครั้ง</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog30'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog30'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all30); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all30,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left" colspan="14">เคยฉีด 1 ครั้งสุดท้าย</td>		
		</tr>
		<tr class="para1">
			<td class="pad-left2">ภายใน 1 ปี</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog41'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog41'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all41); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all41,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left2">เกิน 1 ปี</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog42'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog42'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all42); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all42,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog40'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog40'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all40); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all40,$total_n); ?></p></td>

		</tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccinedog00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccinedog00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_vaccinedog_all00); ?> <p class="percentage"><?php echo compute_percent($total_vaccinedog_all00,$total_n); ?></p></td>

		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container7" class="container1"></div> 			
  		</div>  		
  	</td>
</tr>		
	<tr><td colspan="14"><strong>สาเหตุที่ถูกกัด</strong>
			<input type="hidden" name="render" value="container8">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    		
	</td></tr>	
		<tr class="para1">
			<td class="pad-left">ถูกกัดโดยไม่มีสาเหตุโน้มนำ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_reason10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_reason_all10); ?> <p class="percentage"><?php echo compute_percent($total_reason_all10,$total_n); ?></p></td>

		</tr>
		<tr class="para1">
			<td class="pad-left" colspan="14">ถูกกัดโดยมีสาเหตุโน้มนำ</td>
			<?php $reason = array(1=>'ทำให้สัตว์เจ็บปวด โมโห หรือตกใจ',2=>'พยายามแยกสัตว์ที่กำลังต่อสู้กัน',3=>'เข้าใกล้สัตว์แม่ลูกอ่อน',4=>'รบกวนสัตว์ขณะกินอาหาร',5=>'เข้าไปในบริเวณที่สัตว์คิดว่าเป็นเจ้าของ',6=>'อื่นๆ'); ?>				
		</tr>		
		<?php for($i=1;$i<7;$i++): ?>
		<tr class="para1">
			<td class="pad-left2"><?php echo $reason[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_reason2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason2'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_reason_all2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason_all2'.$i},$total_n); ?></p></td>
		</tr>
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_reason20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_reason_all20); ?> <p class="percentage"><?php echo compute_percent($total_reason_all20,$total_n); ?></p></td>
		</tr>		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_reason00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_reason_all00); ?> <p class="percentage"><?php echo compute_percent($total_reason_all00,$total_n); ?></p></td>
		</tr>	

 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container8" class="container1"></div> 			
  		</div>  		
  	</td>
</tr>
	<tr><td colspan="14"><strong>การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</strong>
			<input type="hidden" name="render" value="container9">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    			
	</td></tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ได้ล้าง</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_wash10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_wash_all10); ?> <p class="percentage"><?php echo compute_percent($total_wash_all10,$total_n); ?></p></td>

		</tr>				
		<tr class="para1">
			<td class="pad-left" colspan="14">ล้าง</td>	
			<?php $wash = array(1=>'น้ำ',2=>'น้ำและสบู่ / ผงซักฟอก',3=>'อื่นๆ'); ?>							
		</tr>
		<?php for($i=1;$i<4;$i++): ?>
		<tr class="para1">
			<td class="pad-left2"><?php echo $wash[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_wash2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash2'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_wash_all2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash_all2'.$i},$total_n); ?></p></td>
		</tr>	
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_wash20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_wash_all20); ?> <p class="percentage"><?php echo compute_percent($total_wash_all20,$total_n); ?></p></td>

		</tr>		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_wash00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_wash_all00); ?> <p class="percentage"><?php echo compute_percent($total_wash_all00,$total_n); ?></p></td>

		</tr>		

 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container9" class="container1"></div> 			
  		</div>  		
  	</td>
</tr>	
	<tr><td colspan="14"><strong>การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</strong>
			<input type="hidden" name="render" value="container10">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    			
	</td></tr>	
		<tr class="para1">
			<td class="pad-left">ไม่ได้ใส่ยา</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_drug10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_drug_all10); ?> <p class="percentage"><?php echo compute_percent($total_drug_all10,$total_n); ?></p></td>

		</tr>	
		<tr class="para1"><td class="pad-left" colspan="14">ใส่ยา</td>	</tr>
		<?php $drug = array(1=>'สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์ฯ',2=>'ทิงเจอร์ไอโอดีนแอลกอฮอล์ฯ',3=>'อื่นๆ'); ?>
		<?php for($i=1;$i<4;$i++): ?>
		<tr class="para1">
			<td class="pad-left2"><?php echo $drug[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_drug2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug2'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_drug_all2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug_all2'.$i},$total_n); ?></p></td>
		</tr>	
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_drug20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_drug_all20); ?> <p class="percentage"><?php echo compute_percent($total_drug_all20,$total_n); ?></p></td>

		</tr>		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_drug00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_drug_all00); ?> <p class="percentage"><?php echo compute_percent($total_drug_all00,$total_n); ?></p></td>

		</tr>	
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container10" class="container1"></div> 			
  		</div>  		
  	</td>
</tr>			
	<tr><td colspan="14"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัส</strong>
			<input type="hidden" name="render" value="container11">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    			
	</td></tr>	
		<tr class="para1">
			<td class="pad-left">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_historyprotect10'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect10'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_historyprotect_all10); ?><p class="percentage"><?php echo compute_percent($total_historyprotect_all10,$total_n); ?></p></td>

		</tr>
		
		<tr class="para1"><td class="pad-left" colspan="14">เคยฉีด 3 เข็มหรือมากกว่า</td>	</tr>
		<?php $historyprotect = array(1=>'ภายใน 6 เดือน',2=>'เกิน 6 เดือน',3=>'อื่นๆ'); ?>
		<?php for($i=1;$i<4;$i++): ?>
		<tr class="para1">
			<td class="pad-left2"><?php echo $historyprotect[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_historyprotect2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect2'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_historyprotect_all2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect_all2'.$i},$total_n); ?></p></td>
		</tr>	
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left2">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_historyprotect20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect20'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_historyprotect_all20); ?> <p class="percentage"><?php echo compute_percent($total_historyprotect_all20,$total_n); ?></p></td>

		</tr>		
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_historyprotect00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_historyprotect00'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_drug_all00); ?> <p class="percentage"><?php echo compute_percent($total_drug_all00,$total_n); ?></p></td>
		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container11" class="container1"></div> 			
  		</div>   		
  	</td>
</tr>
		<tr><td colspan="14"><strong>สัญชาติ</strong>
			<input type="hidden" name="render" value="container12">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    					
		</td></tr>	
		<?php $name = array(1=>'ไทย',2=>'จีน/ฮ่องกง/ใต้หวัน',3=>'พม่า',4=>'มาเลเซีย',5=>'กัมพูชา',6=>'ลาว',7=>'เวียดนาม'
						   ,8=>'ยุโรป',9=>'อเมริกา',10=>'ไม่ทราบสัญชาติ',11=>'อื่นๆ'); ?>
		<?php for($i=1;$i<12;$i++){ ?>
		<tr class="para1">
			<td class="pad-left"><?php echo  $name[$i] ?></td>
			<?php  for($j=1;$j<13;$j++){ ?>
			<td><?php echo number_format(${'total_nationalityname'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_nationalityname'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php } ?>			
			<td><?php echo number_format(${'total_nationalityname_all'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_nationalityname_all'.$i},$total_n); ?></p></td>
		</tr>
		<?php } ?>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_nationalityname0'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_nationalityname0'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_nationalityname_all12); ?> <p class="percentage"><?php echo compute_percent($total_nationalityname_all12,$total_n); ?></p></td>
		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container12" class="container1"></div> 			
  		</div>   		
  	</td>
</tr>					
		</tbody>																							
		
<?php 	$name=array(1=>"นักเรียน นักศึกษา",2=>"ในปกครอง",3=>"เกษตร ทำนา ทำสวน",4=>"ข้าราชการ",5=>"กรรมกร"
			,6=>"รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)",7=>"ค้าขาย",8=>"งานบ้าน",9=>"ทหาร ตำรวจ",10=>"ประมง",11=>"ครู"
			,12=>"เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร",13=>"ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ"
			,14=>"สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า"
			,15=>"อาสาสมัครฉีดวัคซีนสุนัข",16=>"เจ้าหน้าที่สวนสัตว์",17=>"ไปรษณีย์",18=>"ป่าไม้"
			,19=>"พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า",20=>"อื่นๆ",21=>"ไม่ระบุ");?>	
		<tr><td colspan="14"><strong>อาชีพขณะสัมผัสโรค</strong>
    					
		</td></tr>		
		<?php for($i=1;$i<22;$i++){ ?>
		<tr class="para1">
			<td class="pad-left"><?php echo  $name[$i] ?></td>
			<?php  for($j=1;$j<13;$j++){ ?>
			<td><?php echo number_format(${'total_occupation'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_occupation'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php } ?>			
			<td><?php echo number_format(${'total_occupation_all'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_occupation_all'.$i},$total_n); ?></p></td>
		</tr>
		<?php } ?>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_occupation0'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_occupation0'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_occupation_all12); ?> <p class="percentage"><?php echo compute_percent($total_occupation_all12,$total_n); ?></p></td>
		</tr>
				
<?php $name=array(1=>"เกษตร ทำนา ทำสวน",2=>"ข้าราชการ",3=>"กรรมกร",4=>"รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)"
,5=>"ค้าขาย",6=>"งานบ้าน",7=>"ทหาร ตำรวจ",8=>"ประมง",9=>"ครู",10=>"เลี้ยงสัตว์ / จับสุนัข",11=>"นักบวช / ภิกษุสามเณร"
,12=>"ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ",13=>"สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า"
,14=>"อาสาสมัครฉีดวัคซีนสุนัข",15=>"เจ้าหน้าที่สวนสัตว์",16=>"ไปรษณีย์",17=>"ป่าไม้",18=>"พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า",19=>"อื่นๆ",20=>"ไม่ระบุ"); ?>	
		<tr><td colspan="14"><strong>อาชีพผู้ปกครอง</strong>

    					
		</td></tr>		
		<?php for($i=1;$i<21;$i++){ ?>
		<tr class="para1">
			<td class="pad-left"><?php echo  $name[$i] ?></td>
			<?php  for($j=1;$j<13;$j++){ ?>
			<td><?php echo number_format(${'total_occparentsname'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_occparentsname'.$i.$j},${'total_m'.$j}); ?></p></td>
			<?php } ?>			
			<td><?php echo number_format(${'total_occparentsname_all'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_occparentsname_all'.$i},$total_n); ?></p></td>
		</tr>
		<?php } ?>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_occparentsname0'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_occparentsname0'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_occparentsname_all12); ?> <p class="percentage"><?php echo compute_percent($total_occparentsname_all12,$total_n); ?></p></td>
		</tr>			

		<tr><td colspan="14"><strong>สถานภาพสัตว์</strong>
			<input type="hidden" name="render" value="container15">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    					
		</td></tr>	
		<?php $statusanimal = array(1=>'มีเจ้าของ',2=>'ไม่มีเจ้าของ',3=>'ไม่ทราบ'); ?>
		<? for($i=1;$i<4;$i++): ?>
		<tr class="para1">
			<td class="pad-left"><? echo $statusanimal[$i] ?></td>
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_statusanimal'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_occparentsname0'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_statusanimal_all'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_statusanimal_all'.$i},$total_n); ?></p></td>		
		</tr>
		<? endfor; ?>	
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_statusanimal0'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_statusanimal0'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_statusanimal_all0); ?> <p class="percentage"><?php echo compute_percent($total_statusanimal_all0,$total_n); ?></p></td>
		</tr>	
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container15" class="container1"></div> 			
  		</div>   		
  	</td>
</tr>		
		<tr><td><strong>การส่งหัวสัตว์ตรวจ</strong>			    						
		</td>			
			<?php  for($i=1;$i<13;$i++): ?>
			<td><?php echo number_format(${'total_head'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_head'.$i},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_head); ?> <p class="percentage"><?php echo compute_percent($total_head,$total_n); ?></p></td>		
		</tr>
		<tr><td><strong>หัวสัตว์ที่ส่งตรวจพบเชื้อ </strong></td>	
			<?php  for($i=1;$i<13;$i++): ?>
			<td><?php echo number_format(${'total_batteria'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_batteria'.$i},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_batteria_all); ?> <p class="percentage"><?php echo compute_percent($total_batteria_all,$total_n); ?></p></td>		
		</tr>
				
		<tr><td colspan="14"><strong>การฉีดอิมมูโนโกลบุลิน(RIG)</strong>
			<input type="hidden" name="render" value="container17">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    						
		</td></tr>
		<tr class="para1">
			<td class="pad-left">ERIG</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_rig1'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_rig1'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_rig_all1); ?> <p class="percentage"><?php echo compute_percent($total_rig_all1,$total_n); ?></p></td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">HRIG</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_rig2'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_rig2'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_rig_all2); ?> <p class="percentage"><?php echo compute_percent($total_rig_all2,$total_n); ?></p></td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_rig0'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_rig0'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_rig_all0); ?> <p class="percentage"><?php echo compute_percent($total_rig_all0,$total_n); ?></p></td>		
		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container17" class="container1"></div> 			
  		</div>   		
  	</td>
</tr>				
		<tr><td colspan="14"><strong>อาการหลังฉีดอิมมูโนโกลบุลิน (RIG)</strong>
			<input type="hidden" name="render" value="container18">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
					
		</td></tr>					
		<tr class="para1">
			<td class="pad-left">แพ้</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_afterrig1'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_afterrig1'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_afterrig_all1); ?> <p class="percentage"><?php echo compute_percent($total_afterrig_all1,$total_n); ?></p></td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่แพ้</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_afterrig2'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_afterrig2'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_afterrig_all2); ?> <p class="percentage"><?php echo compute_percent($total_afterrig_all2,$total_n); ?></p></td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_afterrig0'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_afterrig0'.$j},${'total_m'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_afterrig_all0); ?> <p class="percentage"><?php echo compute_percent($total_afterrig_all0,$total_n); ?></p></td>		
		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container18" class="container1"></div> 			
  		</div>   		
  	</td>
</tr>										
		<tr><td colspan="14"><strong>วิธีการฉีดวัคซีน</strong>
			<input type="hidden" name="render" value="container19">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
					
		</td></tr>
		<?php $vaccine = array(1=>'เข้ากล้ามเนื้อ',2=>'เข้าผิวหนัง',3=>'ไม่ฉีด');?>	
		<?php for($i=1;$i<4;$i++): ?>	
		<tr class="para1">
			<td class="pad-left"><?php echo $vaccine[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_means'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_means'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_means_all'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_means_all'.$i},$total_n); ?></p></td>		
		</tr>
		<?php endfor; ?>	
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container19" class="container1"></div> 			
  		</div>   		
  	</td>
</tr>			
		<tr><td colspan="14"><strong>ชนิดวัคซีน(จำนวนครั้งที่ใช้)</strong>
			<input type="hidden" name="render" value="container20">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
				
		</td></tr>
		<?php $vaccine = array(1=>'PVRV',2=>'PCEC',3=>'HDCV',4=>'PDEV');?>	
		<?php for($i=1;$i<5;$i++): ?>	
		<tr class="para1">
			<td class="pad-left"><?php echo $vaccine[$i]; ?></td>	
			<?php  for($j=1;$j<13;$j++): ?>
			<td><?php echo number_format(${'total_vaccine'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccine'.$i.$j},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_vaccine_all'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccine_all'.$i},$total_n); ?></p></td>		
		</tr>
		<?php endfor; ?>
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container20" class="container1"></div> 			
  		</div>   		
  	</td>
</tr>			
		<tr><td colspan="14"><strong>การแพ้วัคซีน</strong>
			<input type="hidden" name="render" value="container21">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
					
		</td></tr>
		<tr class="para1">
			<td class="pad-left">ไม่มี</td>	
			<?php  for($i=1;$i<13;$i++): ?>
			<td><?php echo number_format(${'total_aftervaccine1'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_aftervaccine1'.$i},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_aftervaccine_all1); ?> <p class="percentage"><?php echo compute_percent($total_aftervaccine_all1,$total_n); ?></p></td>		
		</tr>
		<tr class="para1">
			<td class="pad-left">มี</td>	
			<?php  for($i=1;$i<13;$i++): ?>
			<td><?php echo number_format(${'total_aftervaccine2'.$i}); ?> <p class="percentage"><?php echo compute_percent(${'total_aftervaccine2'.$i},${'total_m'.$i}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format($total_aftervaccine_all2); ?> <p class="percentage"><?php echo compute_percent($total_aftervaccine_all2,$total_n); ?></p></td>		
		</tr>
 <tr class="tr-graph2">
  	<td colspan="14">
  		<div class="div_graph"><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container21" class="container1"></div> 			
  		</div>   		
  	</td>
</tr>										
	</table>	
	<hr class="hr1">
	<div id="reference"><?php echo $reference?></div>			
	<div id="btn_printout">
		<?php  $p=(empty($_GET['preview'])) ? '&p=preview':'';?>
		<a href="report/index/2<?php echo '?'.$_SERVER['QUERY_STRING'].$p ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
	<div id="area_btn_print">
		<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
		<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
	</div>
</div>
<? endif; ?>
