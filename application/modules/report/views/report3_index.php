<script type="text/javascript">
$(document).ready(function(){
	$('.tr-graph,.tr-graph2').hide();
	$('td[colspan]').addClass('hasRowSpan');
	$('[name=close]').click(function(){$(this).closest('tr').fadeOut('slow');})
	
	function graph(title,render,t_graph,arr,arr_val){		
        	//var r=0,x=0,y=-6;       	
        	var r=270;x=2;y=-18;
        	
        	if(t_graph=="column"){
        		a="center"      		
        	}else if(t_graph=="bar"){
        		a="right";
        	}
        	$('#'+render).highcharts({
            chart: {                
                type: t_graph,width:790,height:402,marginBottom:80
            },
            title: { marginBottom:20,text: title,style: {color: '#000000',fontSize: '14px'}},
            yAxis: {
            	title:{
            		text: null, style: {color: '#000000'}         		          		
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
                x:40,
                y:10,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            plotOptions: {            	
            	bar: { dataLabels: {
            				enabled: true,
            				align:a,
							x:40,
							y:0
            			}
            	},            	
            	column: { 
            		dataLabels: {enabled: true,
								 rotation: r,
								 x: x,
								 y: y            					
            					}
            		},
            	pie:{ dataLabels: {enabled: true, format: '<b>{point.name}</b>: {point.percentage:.2f} %'}}
               
            },           
            xAxis:{categories: arr,            		         	
	            	labels: {	                	
	                	align:a,
	                	x: 0,
	                	y: 10
	            	}
	              },    
			 series:arr_val	
		});	
			
	}// function graph
	$('.img').click(function(){
		var title 	= $(this).closest('tr').find('td:eq(0)').children('strong:eq(0)').html();
		var t_graph = $(this).attr('name');		
		var render 	= $(this).closest('td').find('input[name=render]').val();									
		var arr ={};
		var arr_title=[],arr_para=[],arr_val1=[],arr_val2=[],arr_val3=[],arr_val4=[],arr_val_all=[];	
		var para;
		var j=0;
		var obj={};	
				if(title=="สาเหตุที่ถูกกัด"){
					arr_title = ['ถูกกัดโดย<br/>ไม่มีสาเหตุโน้มนำ','ทำให้สัตว์<br/>เจ็บปวด โมโห <br/>หรือตกใจ','พยายามแยก<br/>สัตว์ที่กำลัง<br/>ต่อสู้กัน','เข้าใกล้สัตว์<br/>แม่ลูกอ่อน'
								,'รบกวนสัตว์<br/>ขณะกินอาหาร','เข้าไปในบริเวณ<br/>ที่สัตว์คิดว่า<br/>เป็นเจ้าของ','อื่นๆ','ไม่ระบุ','ไม่ระบุ'];	
					
				}else if(title=="การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข"){
					arr_title = ['ไม่ได้ล้าง','ล้าง','กักขังไม่ได้','ไม่ระบุ'];
					
				}else if(title=="การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข"){
					arr_title = ['ไม่ได้ใส่ยา','สารละลาย<br/>ไอโอดีนที่ไม่มี<br/>แอลกอฮอล์ฯ','ทิงเจอร์ไอโอดีน<br/>แอลกอฮอล์ฯ','อื่นๆ','ไม่ระบุ','ไม่ระบุ'];
					
				}else if(title=="ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัส"){
					arr_title = ['ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม','ภายใน 6 เดือน','เกิน 6 เดือน','ไม่ระบุ','ไม่ระบุ'];
					
				}else if(title=="การกักขัง / ติดตามดูอาการสัตว์"){
					arr_title = ['ตายภาย<br/>ใน 10 วัน','ไม่ตายภาย<br/>ใน 10 วัน','กักขังไม่ได้','ถูกฆ่าตาย','หนีหาย / จำไม่ได้','ไม่ระบุ'];
				}
				$(this).closest('tr').nextUntil('.tr-graph').each(function(i,value){
				if(arr_title.length>1){
														
					if($(this).find('td').hasClass('pad-left2')){	
											
						arr_val1[j] = parseFloat($(this).find('td:eq(1)').find('p').html());
						arr_val2[j] = parseFloat($(this).find('td:eq(2)').find('p').html());
						arr_val3[j] = parseFloat($(this).find('td:eq(3)').find('p').html());
						arr_val4[j] = parseFloat($(this).find('td:eq(4)').find('p').html());
						++j;																											
					}else{
						if($(this).children('td').length>1){																														
							arr_val1[j] = parseFloat($(this).find('td:eq(1)').find('p').html());
							arr_val2[j] = parseFloat($(this).find('td:eq(2)').find('p').html());
							arr_val3[j] = parseFloat($(this).find('td:eq(3)').find('p').html());
							arr_val4[j] = parseFloat($(this).find('td:eq(4)').find('p').html());
							++j;
						}																																													
					}
					
				}else{
						
						arr_para[j] = $(this).find('.pad-left').html();
						arr_val1[j] = parseFloat($(this).find('td:eq(1)').find('p').html());
						arr_val2[j] = parseFloat($(this).find('td:eq(2)').find('p').html());
						arr_val3[j] = parseFloat($(this).find('td:eq(3)').find('p').html());
						arr_val4[j] = parseFloat($(this).find('td:eq(4)').find('p').html());
						++j;						
				}
										
				});	
					arr['name'] = 'ไตรมาส 1';
				 	arr['data'] = arr_val1;		 		
					arr_val_all[0] = jQuery.parseJSON(JSON.stringify(arr));	
				 	
				 	arr['name']	= 'ไตรมาส 2'	
				 	arr['data'] = arr_val2;	
				    arr_val_all[1] = jQuery.parseJSON(JSON.stringify(arr));	
					
					arr['name'] = 'ไตรมาส 3';
				 	arr['data'] = arr_val3;		 		
					arr_val_all[2] = jQuery.parseJSON(JSON.stringify(arr));	
				 	
				 	arr['name']	= 'ไตรมาส 4'	
				 	arr['data'] = arr_val4;	
				    arr_val_all[3] = jQuery.parseJSON(JSON.stringify(arr));					    							
			if(arr_title.length>1){arr_para=arr_title;}
			graph(title,render,t_graph,arr_para,arr_val_all);			
					
		$(this).closest('tr').nextAll('.tr-graph:eq(0)').fadeIn('slow');
		
		
	});	
});
</script>
<div id="title">ข้อมูลการสัมผัสโรค - รายไตรมาส</div>
<div id="search">
<form action="report/index/3" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
<table class="tb_patient1">
<?php require 'include/conditionreport.php'; ?>
<tr><th>ปีที่สัมผัสโรค</th>
	 <td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>
</tr>
</table>
<div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul>
</div>	
</form>
</div>
<div id="loading"><img src="media/images/loading2.gif" width="98px" height="20px"></div>
<?php if(!empty($cond)): ?>
<div id="report">
	
		<div id="title">				  
		<p>รายงานผู้สัมผัสโรครายไตรมาส</p>
	    <p>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
		<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
		<p>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></p>				
	</div>
		<div class="right">
		<a href="report/index/3<?php echo '?'.$_SERVER['QUERY_STRING'].'&excel=excel' ?>" class="excel" name="btn_excel"></a></div> 

	<table class="tbreport">
		<thead>
		<tr><td colspan="6" style="text-align:right;">หน่วย : ราย</td></tr>
		<tr>
			<th rowspan="2">ข้อมูล</th>
			<th colspan="6">ไตรมาส (N=<?php echo number_format($total_n); ?>)</th>
		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>รวม</th>
		</tr>
		</thead>
		<tbody>
		<tr class="para1">
			<td align="left"><strong>ผู้สัมผัสโรคพิษสุนัขบ้า</strong></td>
			<td><? echo number_format($q1) ?><p class="percentage">100.0</p></td>
			<td><? echo number_format($q2) ?><p class="percentage">100.0</p></td>
			<td><? echo number_format($q3) ?><p class="percentage">100.0</p></td>
			<td><? echo number_format($q4) ?><p class="percentage">100.0</p></td>
			<td><? echo number_format($total_n); ?><p class="percentage">100.0</p></td>
		</tr>
		<?  $k=1;
			foreach($module as $field =>$name): ?>
			<tr ><td colspan="6"><strong><? echo $name; ?></strong>
				<input type="hidden" name="render" value="container<?php echo $k; ?>">
				<button class="bar-chart img" name="bar"></button>
				<button class="column-chart img" name="column"></button>
		    	
			</td></tr>
			<? foreach(${$field} as $key =>$i): ?>
			<tr class="para1">
				<td class="pad-left"><? echo $i ?></td>		
				<? for($j=1;$j<5;$j++): ?>
					<td><? echo number_format(${$field.$key.$j}) ?><p class="percentage"><?php echo compute_percent(${$field.$key.$j},${'q'.$j}); ?></p></td>
				<? endfor; ?>
				<td><? echo number_format(${$field.$key}); ?></td>
			</tr>
			<? endforeach; ?>
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container<?php echo $k; ?>" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>			
		<?  ++$k; endforeach; ?>		

				<tr><td colspan="6"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong>
					<input type="hidden" name="render" value="container10">
					<button class="bar-chart img" name="bar"></button>
					<button class="column-chart img" name="column"></button>
		    						
				</td></tr>	
				<tr class="para1">
					<td class="pad-left" colspan="3">กักขังได้ / ติดตามได้</td>

				</tr>
				<tr class="para1">
					<td class="pad-left2">ตายภายใน 10 วัน</td>
					<? for($j=1;$j<5;$j++): ?>	
					<td><?php echo number_format(${'total_detain11'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain11'.$j},${'q'.$j}); ?></p></td>					
					<? endfor; ?>
					<td><? echo number_format($total_detain_all11); ?></td>
				</tr>
				<tr class="para1">
					<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_detain12'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain12'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>
					<td><? echo number_format($total_detain_all12); ?></td>
				</tr>	
				<tr class="para1">
					<td class="pad-left">กักขังไม่ได้</td>
					<? for($j=1;$j<5;$j++): ?>	
					<td><?php echo number_format(${'total_detain20'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain20'.$j},${'q'.$j}); ?></p></td>					
					<? endfor; ?>
					<td><? echo number_format($total_detain_all20); ?></td>
				</tr>	
				<tr class="para1">
					<td class="pad-left">ถูกฆ่าตาย</td>	
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_detain30'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain30'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>
					<td><? echo number_format($total_detain_all30); ?></td>
				</tr>
				<tr class="para1">
					<td class="pad-left">หนีหาย / จำไม่ได้</td>
					<? for($j=1;$j<5;$j++): ?>	
					<td><?php echo number_format(${'total_detain40'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain40'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>
					<td><? echo number_format($total_detain_all40); ?></td>
				</tr>	
				<tr class="para1">					
					<td class="pad-left">ไม่ระบุ</td>
					<? for($j=1;$j<5;$j++): ?>	
					<td><?php echo number_format(${'total_detain00'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_detain00'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>
					<td><? echo number_format($total_detain_all00); ?></td>
				</tr>	
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container10" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>
				<tr><td colspan="6"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า</strong>
					<input type="hidden" name="render" value="container11">
					<button class="bar-chart img" name="bar" ></button>
					<button class="column-chart img" name="column"></button>
		    						
				</td></tr>			
				<tr class="para1">
					<td class="pad-left">ไม่ทราบ</td>	
					<? for($j=1;$j<5;$j++): ?>					
					<td><?php echo number_format(${'total_vaccinedog10'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_vaccinedog10'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all10); ?></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่เคยฉีด</td>	
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_vaccinedog20'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_vaccinedog20'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all20); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 1 ครั้ง</td>						
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_vaccinedog30'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_vaccinedog30'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all30); ?></td>								
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 1 ครั้งสุดท้าย</td>
					<? for($j=1;$j<5;$j++): ?>
					<td><?php 
					$total4 = ${'total_vaccinedog41'.$j}+${'total_vaccinedog42'.$j};
					echo number_format($total4); ?><p class="percentage"><?php echo compute_percent($total4,${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all41+$total_vaccinedog_all42); ?></td>			
				</tr>								
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>					
					<? for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_vaccinedog00'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_vaccinedog00'.$j},${'q'.$j}); ?></p></td>
					<? endfor; ?>					
					<td><? echo number_format($total_vaccinedog_all00); ?></td>								
				</tr>
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container11" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>				
			<tr><td colspan="6"><strong>สาเหตุที่ถูกกัด</strong>
					<input type="hidden" name="render" value="container12">
					<button class="bar-chart img"  name="bar"></button>
					<button class="column-chart img" name="column"></button>
		    		
			</td></tr>	
				<tr class="para1">
					<td class="pad-left">ถูกกัดโดยไม่มีสาเหตุโน้มนำ</td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_reason10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason10'.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format($total_reason_all10); ?></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left" colspan="6">ถูกกัดโดยมีสาเหตุโน้มนำ</td>
					<?php $reason = array(1=>'ทำให้สัตว์เจ็บปวด โมโห หรือตกใจ',2=>'พยายามแยกสัตว์ที่กำลังต่อสู้กัน',3=>'เข้าใกล้สัตว์แม่ลูกอ่อน',4=>'รบกวนสัตว์ขณะกินอาหาร',5=>'เข้าไปในบริเวณที่สัตว์คิดว่าเป็นเจ้าของ',6=>'อื่นๆ'); ?>				
				</tr>		
				<?php for($i=1;$i<7;$i++): ?>
				<tr class="para1">
					<td class="pad-left2"><?php echo $reason[$i]; ?></td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_reason2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason2'.$i.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format(${'total_reason_all2'.$i}); ?></td>
				</tr>
				<?php endfor; ?>
				<tr class="para1">
					<td class="pad-left2">ไม่ระบุ</td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_reason20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason20'.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format($total_reason_all20); ?> </td>
				</tr>		
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_reason00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_reason00'.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format($total_reason_all00); ?> </td>
				</tr>				
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container12" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>				
				<tr><td colspan="6"><strong>การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</strong>
						<input type="hidden" name="render" value="container13">
						<button class="bar-chart img"  name="bar"></button>
						<button class="column-chart img" name="column"></button>
			    			
				</td></tr>	
					<tr class="para1">
						<td class="pad-left">ไม่ได้ล้าง</td>	
						<?php  for($j=1;$j<5;$j++): ?>
						<td><?php echo number_format(${'total_wash10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash10'.$j},${'q'.$j}); ?></p></td>
						<?php endfor; ?>
						<td><?php echo number_format($total_wash_all10); ?></p></td>
			
					</tr>				
					<tr class="para1">
						<td class="pad-left" colspan="6">ล้าง</td>	
						<?php $wash = array(1=>'น้ำ',2=>'น้ำและสบู่ / ผงซักฟอก',3=>'อื่นๆ'); ?>							
					</tr>
					<?php for($i=1;$i<4;$i++): ?>
					<tr class="para1">
						<td class="pad-left2"><?php echo $wash[$i]; ?></td>	
						<?php  for($j=1;$j<5;$j++): ?>
						<td><?php echo number_format(${'total_wash2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash2'.$i.$j},${'q'.$j}); ?></p></td>
						<?php endfor; ?>
						<td><?php echo number_format(${'total_wash_all2'.$i}); ?></p></td>
					</tr>	
					<?php endfor; ?>
					<tr class="para1">
						<td class="pad-left2">ไม่ระบุ</td>	
						<?php  for($j=1;$j<5;$j++): ?>
						<td><?php echo number_format(${'total_wash20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash20'.$j},${'q'.$j}); ?></p></td>
						<?php endfor; ?>
						<td><?php echo number_format($total_wash_all20); ?></p></td>
			
					</tr>		
					<tr class="para1">
						<td class="pad-left">ไม่ระบุ</td>	
						<?php  for($j=1;$j<5;$j++): ?>
						<td><?php echo number_format(${'total_wash00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_wash00'.$j},${'q'.$j}); ?></p></td>
						<?php endfor; ?>
						<td><?php echo number_format($total_wash_all00); ?> </p></td>			
					</tr>
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container13" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>						
					<tr><td colspan="6"><strong>การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</strong>
							<input type="hidden" name="render" value="container14">
							<button class="bar-chart img"  name="bar"></button>
							<button class="column-chart img" name="column"></button>
				    			
					</td></tr>	
						<tr class="para1">
							<td class="pad-left">ไม่ได้ใส่ยา</td>	
							<?php  for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_drug10'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug10'.$j},${'q'.$j}); ?></p></td>
							<?php endfor; ?>
							<td><?php echo number_format($total_drug_all10); ?></td>
				
						</tr>	
						<tr class="para1"><td class="pad-left" colspan="6">ใส่ยา</td>	</tr>
						<?php $drug = array(1=>'สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์ฯ',2=>'ทิงเจอร์ไอโอดีนแอลกอฮอล์ฯ',3=>'อื่นๆ'); ?>
						<?php for($i=1;$i<4;$i++): ?>
						<tr class="para1">
							<td class="pad-left2"><?php echo $drug[$i]; ?></td>	
							<?php  for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_drug2'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug2'.$i.$j},${'q'.$j}); ?></p></td>
							<?php endfor; ?>
							<td><?php echo number_format(${'total_drug_all2'.$i}); ?></td>
						</tr>	
						<?php endfor; ?>
						<tr class="para1">
							<td class="pad-left2">ไม่ระบุ</td>	
							<?php  for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_drug20'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug20'.$j},${'q'.$j}); ?></p></td>
							<?php endfor; ?>
							<td><?php echo number_format($total_drug_all20); ?> </td>
				
						</tr>		
						<tr class="para1">
							<td class="pad-left">ไม่ระบุ</td>	
							<?php  for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_drug00'.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_drug00'.$j},${'q'.$j}); ?></p></td>
							<?php endfor; ?>
							<td><?php echo number_format($total_drug_all00); ?> </td>				
						</tr>
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container14" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>								
						<tr><td colspan="6"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัส</strong>
							<input type="hidden" name="render" value="container15">
							<button class="bar-chart img" name="bar" ></button>
							<button class="column-chart img" name="column"></button>				    						
						</td></tr>			
						<tr class="para1">
							<td class="pad-left">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม</td>	
							<? for($j=1;$j<5;$j++): ?>					
							<td><?php echo number_format(${'total_historyprotect10'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect10'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all10); ?></td>
				
						</tr>
						<tr class="para1">
							<td class="pad-left" colspan="6">เคยฉีด 3 เข็มหรือมากกว่า</td>	
						</tr>
						<tr class="para1">
							<td class="pad-left2">ภายใน 6 เดือน</td>						
							<? for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_historyprotect21'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect21'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all21); ?></td>								
						</tr>
						<tr class="para1">
							<td class="pad-left2">เกิน 6 เดือน</td>
							<? for($j=1;$j<5;$j++): ?>
							<td><?php 							
							echo number_format(${'total_historyprotect22'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect22'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all22); ?></td>			
						</tr>
						<tr class="para1">
							<td class="pad-left2">ไม่ระบุ</td>
							<? for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_historyprotect20'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect20'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all20); ?></td>			
						</tr>								
						<tr class="para1">
							<td class="pad-left">ไม่ระบุ</td>					
							<? for($j=1;$j<5;$j++): ?>
							<td><?php echo number_format(${'total_historyprotect00'.$j}); ?><p class="percentage"><?php echo compute_percent(${'total_historyprotect00'.$j},${'q'.$j}); ?></p></td>
							<? endfor; ?>					
							<td><? echo number_format($total_historyprotect_all00); ?></td>								
						</tr>	
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container15" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>
					<tr><td colspan="6"><strong>วิธีการฉีดวัคซีน</strong>
						<input type="hidden" name="render" value="container16">
						<button class="bar-chart img" name="bar" ></button>
						<button class="column-chart img" name="column"></button></td>
					</tr>
				<?php $vaccine = array(1=>'เข้ากล้ามเนื้อ',2=>'เข้าผิวหนัง',3=>'ไม่ฉีด');?>	
				<?php for($i=1;$i<4;$i++): ?>	
				<tr class="para1">
					<td class="pad-left"><?php echo $vaccine[$i]; ?></td>	
					<?php  for($j=1;$j<5;$j++): ?>
					<td><?php echo number_format(${'total_means'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_means'.$i.$j},${'q'.$j}); ?></p></td>
					<?php endfor; ?>
					<td><?php echo number_format(${'total_means_all'.$i}); ?> </td>		
				</tr>
				<?php endfor; ?>	
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container16" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>				
		<tr><td colspan="6"><strong>ชนิดวัคซีน</strong>
			<input type="hidden" name="render" value="container17">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
				
		</td></tr>
		<?php $vaccine = array(1=>'PVRV',2=>'PCEC',3=>'HDCV',4=>'PDEV');?>	
		<?php for($i=1;$i<5;$i++): ?>	
		<tr class="para1">
			<td class="pad-left"><?php echo $vaccine[$i]; ?></td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_vaccine'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_vaccine'.$i.$j},${'q'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_vaccine_all'.$i}); ?> </td>		
		</tr>
		<?php endfor; ?>	
			<tr class="tr-graph">
			  	<td colspan="6">
			  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
			  			<div id="container17" class="container" style="height:405px;padding-left:10%"></div> 			
			  		</div>
			  	</td>
			</tr>
		<tr><td colspan="6"><strong>การแพ้วัคซีน</strong>
			<input type="hidden" name="render" value="container18">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
					
		</td></tr>
		<?php $vaccine = array('1'=>'ไม่มี','2'=>'มี');
			for($i=1;$i<3;$i++): ?>
		<tr class="para1">			
			<td class="pad-left"><?php echo $vaccine[$i] ?></td>	
			<?php  for($j=1;$j<5;$j++): ?>
			<td><?php echo number_format(${'total_aftervaccine'.$i.$j}); ?> <p class="percentage"><?php echo compute_percent(${'total_aftervaccine'.$i.$j},${'q'.$j}); ?></p></td>
			<?php endfor; ?>
			<td><?php echo number_format(${'total_aftervaccine_all'.$i}); ?></td>		
		</tr>
		<?php endfor; ?>
		
 <tr class="tr-graph">
  	<td colspan="6">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container18"  class="container" style="height:405px;padding-left:10%"></div> 			
  		</div>   		
  	</td>
</tr>																												
		</tbody>				
	</table>
			<hr class="hr1">
		<div id="reference"><?php echo $reference?></div>			
		<div id="btn_printout"><a href="report/index/3<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
	
</div>
<?php endif; ?>