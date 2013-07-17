<script type="text/javascript">
$(document).ready(function(){
   
	$('#multiAccordion').multiAccordion({
	    heightStyle: "content",
	    active:0
	});

	function graph(title,render,t_graph,arr,arr_val)
	{		        	       	
        	var r=0,a="center";yy=10;       	
        	if(render=="container7"){r=90;a="left";yy=20;}        	
        	$('#'+render).highcharts({
            chart: {                
                type: t_graph,width:620,height:302
            },
            title: { marginBottom:15,text: 'ร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตาม'+title,style: {color: '#000000',fontSize: '14px'}},
            yAxis: {
            	title:{
            		text: '', style: {color: '#000000'}         		          		
            	}            	
            },			
            tooltip: {valueSuffix: ' %'},
            credits: {enabled: false},
            legend: {enabled: false},
            plotOptions: {            	
            	bar: { dataLabels: {enabled: true}},            	
            	column: { dataLabels: {enabled: true}},
            	pie:{ dataLabels: {enabled: true, format: '<b>{point.name}</b>: {point.percentage:.2f} %'}}
               
            },           
            xAxis: {categories: arr, 
           		         	
	            	labels: {
	                	rotation: r,
	                	align:a,
	                	x: 0,
	                	y: yy
	            	}             		            	         	          
            },
            series: [{data:arr_val}]
			/*series:[{
			 data: [
                ['ชาย', 45.0],
                ['หญิง', 26.8],
                 ['ไม่ระบุ', 26.8]]
               }]*/
		});	
			
	}					
	$('.tr-graph').hide();
	$('td[colspan]').addClass('hasRowSpan');
	$('[name=close]').click(function(){$(this).closest('tr').fadeOut('slow');})
	
	$('.img').click(function(){
		var title 	= $(this).closest('tr').find('td:eq(0)').children('strong:eq(0)').html();
		var t_graph = $(this).attr('name');		
		var render 	= $(this).closest('td').find('input[name=render]').val();									
		var arr=[],arr_val=[],arr_val_all=[],pre=[];	
		var padd_left,title_padd,j=0,k=0;
		var obj={};
				if(title=="ลักษณะการสัมผัส"){
					arr=['ถูกกัด<br/>มีเลือดออก','ถูกกัด<br/>ไม่มีเลือดออก','ถูกข่วน<br/>มีเลือดออก','ถูกข่วน<br/>ไม่มีเลือดออก','ถูกเลีย<br/>มีแผล','ถูกเลีย<br/>ไม่มีแผล','กินอาหารดิบ<br/>หรือดื่มน้ำ<br/>ที่สัมผัสเชื้อโรคพิษสุนัขบ้า']	
				}else if(title=="การกักขัง / ติดตามดูอาการสัตว์"){
					arr=['ตายภาย<br/>ใน 10 วัน','ไม่ตายภาย<br/>ใน 10 วัน','กักขังไม่ได้','ถูกฆ่าตาย','หนีหาย / จำไม่ได้','ไม่ระบุ']
				}else if(title=="สถานที่สัมผัสโรค"){
					arr=['เขต กทม.','เขตเมืองพัทยา','เขตเทศบาล','เขตอบต.','ไม่ระบุ'];
				}					
				if(arr.length>1){	
					$(this).closest('tr').nextUntil('.tr-graph').each(function(i,value){																		
						if(title=="สถานที่สัมผัสโรค"){
							padd_left = $(this).find('.pad-left').next().next().html()
							arr_val[j]= parseFloat(padd_left);
							arr_val_all[j] = [arr[j],arr_val[j]];
							//console.log(arr[j]);
							
						}else{													
							if($(this).find('td').hasClass('pad-left2')){
								padd_left = $(this).find('.pad-left2').next().next().html();
								arr_val[j]= parseFloat(padd_left);	
								arr_val_all[j] = [arr[j],arr_val[j]];																												
							}else{
								padd_left = $(this).find('.pad-left').next().next().html()
								arr_val[j]= parseFloat(padd_left);	
								arr_val_all[j] = [arr[j],arr_val[j]];
							}
						}
						if(padd_left != null){j++;}																		
				   });
				}else{

					$(this).closest('tr').nextUntil('.tr-graph').each(function(i,value){
						if($(this).find('td').hasClass('pad-left2')){			
							padd_left = $(this).find('.pad-left2').next().next().html()
							arr[j]=$(this).find('.pad-left2').html();
							arr_val[j]=parseFloat(padd_left);
							arr_val_all[j] = [arr[j],arr_val[j]];				
						}else{
							if($(this).children('td').length>1){
								padd_left = $(this).find('.pad-left').next().next().html();							
								arr[j]=$(this).find('.pad-left').html();
								arr_val[j]=parseFloat(padd_left);
								arr_val_all[j] = [arr[j],arr_val[j]];																																																
							}										
																																								
						}
												
						if(padd_left != null){j++;}					
					});					
				}
						
		if(t_graph=="pie"){
			graph(title,render,t_graph,arr,arr_val_all);			
		}else{
			graph(title,render,t_graph,arr,arr_val);
		}			
		$(this).closest('tr').nextAll('.tr-graph:eq(0)').fadeIn('slow');		
		
	});	
	 $('#button').click(function() {
        var chart = $('#container').highcharts();
        chart.print();
    });	
	$('.excel').click(function(){
		
		$(this).closest('h6').next().show().css('background-color','blue');
	})

});	
</script>
<div id="title">ข้อมูลการสัมผัสโรค - ภาพรวม</div>
<div id="search">
<form action="report/index/1" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
<table class="tb_patient1">
<?php require 'include/conditionreport.php'; ?>
	<tr>
	    <th>ปีที่สัมผัสโรค</th>	    
		<td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>	
		<th>เดือนที่สัมผัสโรค</th>
	    <td><?php echo form_dropdown('month_start',get_month(),@$_GET['month_start'],'class="styled-select"','ทั้งหมด'); ?></td>					
      </tr>   	
  </table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li></ul></div>	
</form>
</div>

<?php if($cond): ?>
<div id="report">
<div id="title">				  
	<p>รายงานผู้สัมผัสโรคในภาพรวม</p>
	<p>เขตความรับผิดชอบ  <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
	<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
	<p>สถานบริการ <?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></p>				
</div>

<div id="multiAccordion" style="width:80%;margin-left:10%;margin-right:10%">
    <h3><a href="javascript:void(0);">ส่วนที่ 1 : ข้อมูลทั่วไป </a></h3>
    <div id="section1">
		<h6>ตารางที่ 1 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามข้อมูลทั่วไป <button  name="btn_excel" class="excel"></button></h6>
		<table class="tbreport">
		<tr>
			<th>ข้อมูลทั่วไป</th>
			<th>จำนวน (N=<?php echo number_format($total_n); ?>)</th>
			<th>ร้อยละ</th>
		</tr>
		<tr><td colspan="3"><strong>เพศ</strong>			
			<input type="hidden" name="render" value="container1">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    		<button class="pie-chart img" name="pie"></button>
    		
		</td></tr>
		<tr class="para1">
			<td class="pad-left">ชาย</td>
			<td><? echo number_format($total_gender1); ?></td>
			<td><? echo compute_percent($total_gender1,$total_n)?></td>

		</tr>
		<tr class="para1">
			<td class="pad-left">หญิง</td>
			<td><? echo number_format($total_gender2); ?></td>
			<td><? echo compute_percent($total_gender2,$total_n)?></td>
		</tr>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td><? echo number_format($total_gender0); ?></td>
			<td><? echo compute_percent($total_gender0,$total_n)?></td>
		</tr>
<tr class="tr-graph">
  	<td colspan="3">  		 		
  		<div>
  			<button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container1" class="container"></div>
  		</div>  		  		
  	</td>
</tr>
		
		<tr ><td colspan="3"><strong>กลุ่มอายุ</strong>
		<?php $age=array(1=>'ต่ำกว่า 1 ปี',2=>'1-5 ปี',3=>'6-10 ปี',4=>'11-15 ปี',5=>'16-25 ปี'
						,6=>'26-35 ปี',7=>'36-45 ปี',8=>'46-55 ปี',9=>'56-65 ปี',10=>'66 ปีขึ้นไป'); ?>							
			<input type="hidden" name="render" value="container2">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    		<button class="pie-chart img" name="pie"></button>
		</td></tr>
		<?php  for($i=1;$i<11;$i++):?>
		<tr class="para1">
			<td class="pad-left"><? echo $age[$i];?></td>
			<td><?php echo number_format(${'total_age'.$i}); ?></td>
			<td><?php echo compute_percent(${'total_age'.$i},$total_n); ?></td>
		</tr>
		<?php endfor; ?>
		<tr class="para1">
			<td class="pad-left">ไม่ระบุ</td>
			<td><?php echo number_format($total_age0); ?></td>
			<td><?php echo compute_percent($total_age0,$total_n); ?></td>		
		</tr>
		<tr><td colspan="3" class="pad-left" style="padding-left:52px;">
			(<strong>X</strong>=<? echo number_format($avg_age) ?>, 
			<strong>SD</strong>= <? echo number_format($stddev_age) ?>,
			<strong>Min</strong>= <? echo number_format($min_age); ?>, 
			<strong>Max</strong>= <? echo number_format($max_age); ?>)</td></tr>
<tr class="tr-graph">
  	<td colspan="3">   		
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container2" class="container"></div> 			
  		</div>
  	</td>
</tr>		
		
		<tr><td colspan="3"><strong>อาชีพขณะสัมผัสโรค</strong>		
			<input type="hidden" name="render" value="container3">
			<button class="bar-chart img"  name="bar"></button>
			<button class="column-chart img" name="column"></button>
    		<button class="pie-chart img" name="pie"></button>				
		</td></tr>
<?php $occupationname = array(1=>'นักเรียน นักศึกษา',2=>'ในปกครอง',3=>'เกษตรกรทำนา ทำสวน ',4=>'ข้าราชการ',5=>'กรรมกร'
							 ,6=>'รับจ้าง( เช่น พนักงานบริษัท,ดารานักแสดง )',7=>'ค้าขาย',8=>'งานบ้าน',9=>'ทหาร ตำรวจ',10=>'ประมง'
							 ,11=>'ครู',12=>'เลี้ยงสัตว์ / จับสุนัข ',13=>'นักบวช / ภิกษุสามเณร ',14=>'ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ '
							 ,15=>'สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์ หรือผู้ช่วย ผู้ที่ทำงานในห้องปฎิบัติการโรคพิษสุนัขบ้า',16=>'อาสาสมัครฉีดวัคซีนสุนัข'
							 ,17=>'เจ้าหน้าที่สวนสัตว์',18=>'ไปรษณีย์',19=>'ป่าไม้',20=>'พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า ',21=>'อื่นๆ'); ?>
		<?php  for($i=1;$i<11;$i++):?>			
		<tr class="para1">
			<td class="pad-left"><? echo $occupationname[$i];?></td>
			<td><?php echo number_format(${'total_occupationname'.$i}); ?></td>
			<td><?php echo compute_percent(${'total_occupationname'.$i},$total_n); ?></td>
		</tr>
		<?php endfor; ?>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container3" class="container"></div> 			
  		</div>
  	</td>
</tr>
		</table>		
		<hr class="hr1">		
		<div id="btn_printout"><a href="report/index/1<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		</div> <!-- section1-->
		<p class="page-break"></p>
		 <h3><a href="javascript:void(0);">ส่วนที่ 2 : ตำแหน่งและลักษณะการสัมผัส</a></h3>
		<div id="section2">
			<h6>ตารางที่ 2 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามสถานที่สัมผัสโรค ลักษณะการสัมผัสโรค และตำแหน่งที่สัมผัส <a href="" class="excel"></a></h6>
			<table class="tbreport">
				<tr>
					<th>การสัมผัส</th>
					<th>จำนวน (N=<?php echo $total_n; ?>)</th>
					<th>ร้อยละ</th>
				</tr>
				<tr><td colspan="3"><strong>สถานที่สัมผัสโรค</strong>
				<input type="hidden" name="render" value="container4">
				<button class="bar-chart img"  name="bar"></button>
				<button class="column-chart img" name="column"></button>
    			<button class="pie-chart img" name="pie"></button>						
				</td></tr>
				<tr class="para1">
					<td class="pad-left">เขต กทม.</td>
					<td><?php echo number_format($total_placetouch10); ?></td>
					<td><?php echo compute_percent($total_placetouch10,$total_n); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เขตเมืองพัทยา</td>
					<td><?php echo number_format($total_placetouch20); ?></td>
					<td><?php echo compute_percent($total_placetouch20,$total_n); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เขตเทศบาล</td><? $total1 = $total_placetouch31+$total_placetouch32+$total_placetouch33 ?>
					<td><?php echo number_format($total1); ?></td>
					<td><?php  echo compute_percent($total1,$total_n); ?></td>
						
				</tr>	
				<tr class="para1">
					<td class="pad-left2">นคร</td>
					<td><?php echo number_format($total_placetouch31); ?></td>
					<td><?php echo compute_percent($total_placetouch31,$total_n); ?></td>			
				</tr>	
				<tr class="para1">
					<td class="pad-left2">เมือง</td>
					<td><?php echo number_format($total_placetouch32); ?></td>
					<td><?php echo compute_percent($total_placetouch32,$total_n); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left2">ตำบล</td>
					<td><?php echo number_format($total_placetouch33); ?></td>
					<td><?php echo compute_percent($total_placetouch33,$total_n); ?></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left2">ไม่ระบุ</td>
					<td><?php echo number_format($total_placetouch30); ?></td>
					<td><?php echo compute_percent($total_placetouch30,$total_n); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">เขตอบต.</td><? $total2 = $total_placetouch41+$total_placetouch42+$total_placetouch40 ?>
					<td><?php echo number_format($total2); ?></td>
					<td><?php echo compute_percent($total2,$total_n);?></td>					
				</tr>	
				<tr class="para1">
					<td class="pad-left2">ในชุมชน / ตลาด</td>
					<td><?php echo number_format($total_placetouch41); ?></td>
					<td><?php echo compute_percent($total_placetouch41,$total_n); ?></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left2">ชนบท</td>
					<td><?php echo number_format($total_placetouch42); ?></td>
					<td><?php echo compute_percent($total_placetouch42,$total_n); ?></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left2">ไม่ระบุ</td>
					<td><?php echo number_format($total_placetouch40); ?></td>
					<td><?php echo compute_percent($total_placetouch40,$total_n); ?></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_placetouch00); ?></td>
					<td><?php echo compute_percent($total_placetouch00,$total_n); ?></td>	
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
   		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container4" class="container"></div> 			
  		</div> 		
  	</td>
</tr>
				<tr><td colspan="3"><strong>ลักษณะการสัมผัส</strong><strong>(n=<?php echo number_format($totaltouch); ?>)</strong>
					<input type="hidden" name="render" value="container5">
					<button class="bar-chart img"  name="bar"></button>
					<button class="column-chart img" name="column"></button>
		    		<button class="pie-chart img" name="pie"></button>						
				</td></tr>
				<tr class="para1">
					<td class="pad-left" colspan="3">ถูกกัด</td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">มีเลือดออก</td>
					<td><?php echo number_format($bite_blood); ?></td>
					<td><?php echo compute_percent($bite_blood,$totaltouch); ?></td>	
			    </tr>
				<tr class="para1">
					<td class="pad-left2">ไม่มีเลือดออก</td>
					<td><?php echo number_format($bite_noblood); ?></td>
					<td><?php echo compute_percent($bite_noblood,$totaltouch); ?></td>	
			    </tr>			
				<tr class="para1">
					<td class="pad-left" colspan="3">ถูกข่วน</td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">มีเลือดออก</td>
					<td><?php echo number_format($lick_blood); ?></td>
					<td><?php echo compute_percent($lick_blood,$totaltouch); ?></td>	
			    </tr>
				<tr class="para1">
					<td class="pad-left2">ไม่มีเลือดออก</td>
					<td><?php echo number_format($lick_noblood); ?></td>
					<td><?php echo compute_percent($lick_noblood,$totaltouch); ?></td>	
			    </tr>
				<tr class="para1">
					<td class="pad-left" colspan="3">ถูกเลีย / ถูกข่วน</td>
			    </tr>
				<tr class="para1">
					<td class="pad-left2">ที่มีแผล</td>
					<td><?php echo number_format($claw_blood); ?></td>
					<td><?php echo compute_percent($claw_blood,$totaltouch); ?></td>	
			    </tr>
				<tr class="para1">
					<td class="pad-left2">ที่ไม่มีแผล</td>
					<td><?php echo number_format($claw_noblood); ?></td>
					<td><?php echo compute_percent($claw_noblood,$totaltouch); ?></td>	
			    </tr>			    
				<tr class="para1">
					<td class="pad-left">กินอาหารดิบหรือดื่มน้ำที่สัมผัสเชื้อโรคพิษสุนัขบ้า</td>
					<td><?php echo number_format($total_food); ?></td>
					<td><?php echo compute_percent($total_food,$total_n); ?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
   		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container5" class="container"></div> 			
  		</div> 	  		
  	</td>
</tr>				
				<tr><td colspan="4"><strong>ตำแหน่งที่สัมผัส</strong><strong>(n=<?php echo number_format($total_position); ?>)</strong>
					<input type="hidden" name="render" value="container6">
					<button class="bar-chart img"  name="bar"></button>
					<button class="column-chart img" name="column"></button>
		    		<button class="pie-chart img" name="pie"></button>	
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ศีรษะ</td>
					<td><?php echo number_format($rs['head']); ?></td>
					<td><?php echo compute_percent($rs['head'],$total_position); ?></td>
			    </tr>			    			    
				<tr class="para1">
					<td class="pad-left">หน้า</td>
					<td><?php echo number_format($rs['face']); ?></td>
					<td><?php echo compute_percent($rs['face'],$total_position); ?></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left">ลำคอ</td>
					<td><?php echo number_format($rs['neck']); ?></td>
					<td><?php echo compute_percent($rs['neck'],$total_position); ?></td>
			    </tr>			    			    
				<tr class="para1">
					<td class="pad-left">มือ</td>
					<td><?php echo number_format($rs['hand']); ?></td>
					<td><?php echo compute_percent($rs['hand'],$total_position); ?></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left">แขน</td>
					<td><?php echo number_format($rs['arm']); ?></td>
					<td><?php echo compute_percent($rs['arm'],$total_position); ?></td>
			    </tr>			    			    
				<tr class="para1">
					<td class="pad-left">ลำตัว</td>
					<td><?php echo number_format($rs['body']); ?></td>
					<td><?php echo compute_percent($rs['body'],$total_position); ?></td>
			    </tr>
				<tr class="para1">
					<td class="pad-left">ขา</td>
					<td><?php echo number_format($rs['leg']); ?></td>
					<td><?php echo compute_percent($rs['leg'],$total_position); ?></td>
			    </tr>			    			    
				<tr class="para1">
					<td class="pad-left">เท้า</td>
					<td><?php echo number_format($rs['feet']); ?></td>
					<td><?php echo compute_percent($rs['feet'],$total_position); ?></td>
			    </tr>
<tr class="tr-graph">
  	<td colspan="3">
   		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container6" class="container"></div> 			
  		</div>
  	</td>
</tr>
			</table>
			<hr class="hr1">					
			<div id="btn_printout"><a href="report/index/1<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>

		</div><!-- section2 -->
		<p class="page-break"></p>
		 <h3><a href="javascript:void(0);">ส่วนที่ 3 : สัตว์นำโรค </a></h3>
		<div id="section3">
			<h6>ตารางที่ 3 จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้าแจกแจงตามชนิดและประวัติของสัตว์นำโรค <a href="" class="excel"></a> </h6>
			<table class="tbreport">
				<tr>
					<th>ชนิดและประวัติของสัตว์</th>
					<th>จำนวน (N=<?php echo $total_n; ?>)</th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="3"><strong>ชนิดสัตว์</strong>
					<input type="hidden" name="render" value="container7">
					<button class="bar-chart img"  name="bar"></button>
					<button class="column-chart img" name="column"></button>
		    		<button class="pie-chart img" name="pie"></button>					
				</td></tr>
				<?php $animal = array(1=>'สุนัข',2=>'แมว',3=>'ลิง',4=>'ชะนี',5=>'หนู'); $j=0;?>	
				<?php for($i=1;$i<6;$i++): ?>
				<tr class="para1">
					<td class="pad-left"><?php echo $animal[$i]; ?></td>
					<td><?php echo number_format(${'total_animal'.$i.$j}); ?></td>
					<td><?php echo compute_percent(${'total_animal'.$i.$j},$total_n); ?></td>		
				</tr>
				<? endfor; ?>
				<tr class="para1">
					<td class="pad-left" colspan="3">อื่นๆ</td>
				</tr>
				<? $typeother = array(1=>'คน',2=>'วัว',3=>'กระบือ',4=>'สุกร',5=>'แพะ',6=>'แกะ',7=>'ม้า',8=>'กระรอก'
									 ,9=>'กระแต',10=>'พังพอน',11=>'กระต่าย',12=>'สัตว์ป่า (เช่น ค้างคาว ฯลฯ)',13=>'ไม่ทราบ'); ?>	
				<?php for($i=1;$i<14;$i++): ?>
				<tr class="para1">
					<td class="pad-left2"><? echo $typeother[$i] ?></td>
					<td><?php echo number_format(${'total_animal6'.$i}); ?></td>
					<td><?php echo compute_percent(${'total_animal6'.$i},$total_n); ?></td>		
				</tr>
				<?php endfor; ?>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container7" class="container"></div> 			
  		</div>

  	</td>
</tr>
				<tr><td colspan="14"><strong>อายุสัตว์</strong>
					<input type="hidden" name="render" value="container8">
					<button class="bar-chart img" name="bar"></button>
					<button class="column-chart img" name="column"></button>
					<button class="pie-chart img" name="pie"></button>					
				</td></tr>
				<?php $ageanimal = array(1=>'น้อยกว่า 3 เดือน',2=>'3-6 เดือน',3=>'6-12 เดือน',4=>'มากกว่า 1 ปี',5=>'ไม่ทราบ',6=>'ไม่ระบุ');  ?>
				<?php for($i=1;$i<7;$i++):?>
				<tr class="para1">			
					<td class="pad-left"><?php echo $ageanimal[$i];  //if($i==6)$i=0;?></td>						
					<td><?php echo number_format(${'total_ageanimal'.$i}); ?> </td>					
					<td><?php echo compute_percent(${'total_ageanimal'.$i},$total_n)?></td>
				<?php endfor; ?>
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container8" class="container"></div> 			
  		</div>
  	</td>
</tr>
				<tr><td colspan="14"><strong>สถานภาพสัตว์</strong>
					<input type="hidden" name="render" value="container9">
					<button class="bar-chart img" name="bar"></button>
					<button class="column-chart img" name="column"></button>
		    		<button class="pie-chart img" name="pie"></button>					
				</td></tr>	
				<?php $statusanimal = array(1=>'มีเจ้าของ',2=>'ไม่มีเจ้าของ',3=>'ไม่ทราบ'); ?>
				<? for($i=1;$i<4;$i++): ?>
				<tr class="para1">
					<td class="pad-left"><? echo $statusanimal[$i] ?></td>
					<td><?php echo number_format(${'total_statusanimal'.$i}); ?></td>
					<td><?php echo compute_percent(${'total_statusanimal'.$i},$total_n); ?></td>		
				</tr>
				<? endfor; ?>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_statusanimal0); ?></td>
					<td><?php echo compute_percent($total_statusanimal0,$total_n); ?></td>				
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container9" class="container"></div> 			
  		</div>
  	</td>
</tr>				
				<tr class="page-break"><td colspan="14"><strong>การกักขัง / ติดตามดูอาการสัตว์</strong>
					<input type="hidden" name="render" value="container10">
					<button class="bar-chart img" name="bar"></button>
					<button class="column-chart img" name="column"></button>
		    		<button class="pie-chart img" name="pie"></button>					
				</td></tr>	
				<tr class="para1">
					<td class="pad-left" colspan="3">กักขังได้ / ติดตามได้</td>	
				</tr>
				<tr class="para1">
					<td class="pad-left2">ตายภายใน 10 วัน</td>	
					<td><?php echo number_format($total_detain11); ?></td>
					<td><?php echo compute_percent($total_detain11,$total_n); ?></td>
				</tr>
				<tr class="para1">
					<td class="pad-left2">ไม่ตายภายใน 10 วัน</td>	
					<td><?php echo number_format($total_detain12); ?></td>
					<td><?php echo compute_percent($total_detain12,$total_n); ?></td>
				</tr>	
				<tr class="para1">
					<td class="pad-left">กักขังไม่ได้</td>	
					<td><?php echo number_format($total_detain20); ?></td>
					<td><?php echo compute_percent($total_detain20,$total_n); ?></td>
		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ถูกฆ่าตาย</td>	
					<td><?php echo number_format($total_detain30); ?></td>
					<td><?php echo compute_percent($total_detain30,$total_n); ?></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left">หนีหาย / จำไม่ได้</td>	
					<td><?php echo number_format($total_detain40); ?></td>
					<td><?php echo compute_percent($total_detain40,$total_n); ?></td>
		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>	
					<td><?php echo number_format($total_detain00); ?></td>
					<td><?php echo compute_percent($total_detain00,$total_n); ?></td>
				</tr>	
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container10" class="container"></div> 			
  		</div>
  	</td>
</tr>	
				<tr><td colspan="14"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า</strong>
					<input type="hidden" name="render" value="container11">
					<button class="bar-chart img" name="bar" ></button>
					<button class="column-chart img" name="column"></button>
		    		<button class="pie-chart img" name="pie"></button>					
				</td></tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ทราบ</td>						
					<td><?php echo number_format($total_vaccinedog10); ?></td>					
					<td><?php echo compute_percent($total_vaccinedog10,$total_n); ?></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่เคยฉีด</td>	
					<td><?php echo number_format($total_vaccinedog20); ?></td>
					<td><?php echo compute_percent($total_vaccinedog20,$total_n); ?></td>
		
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 1 ครั้ง</td>	
					<td><?php echo number_format($total_vaccinedog30); ?></td>
					<td><?php echo compute_percent($total_vaccinedog30,$total_n); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 1 ครั้งสุดท้าย</td>
					<td><?php echo number_format($total_vaccinedog41+$total_vaccinedog42); ?></td>
					<td><?php echo compute_percent($total_vaccinedog41+$total_vaccinedog42,$total_n); ?></td>			
				</tr>								
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>	
					<td><?php echo number_format($total_vaccinedog00); ?></td>
					<td><?php echo compute_percent($total_vaccinedog00,$total_n); ?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container11" class="container"></div> 			
  		</div>  		
  	</td>
</tr>													
			</table>
		<hr class="hr1">				
		<div id="btn_printout"><a href="report/index/1<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		</div><!--section3 -->
		<p class="page-break"></p>
		 <h3><a href="javascript:void(0);">ส่วนที่ 4 : ประวัติการได้รับวัคซีน และการปฏิบัติตนของผู้สัมผัสโรค</a></h3>
		<div id="section4">
			<h6>ตารางที่ 4  จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามการดูแลบาดแผลและประวัติการได้รับวัคซีน <a href="" class="excel"></a> </h6>
			<table class="tbreport">
				<tr>
					<th>การดูแลบาดแผลและประวัติการได้รับวัคซีน</th>
					<th>จำนวน (N=<?php echo $total_n; ?>)</th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="3"><strong>การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</strong>
					<input type="hidden" name="render" value="container12">
					<button class="bar-chart img" name="bar"></button>
					<button class="column-chart img" name="column"></button>
					<button class="pie-chart img" name="pie" ></button>					
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ได้ล้าง</td>
					<td><?php echo number_format($total_wash1); ?></td>
					<td><?php echo compute_percent($total_wash1,$total_n); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">ล้าง</td>
					<td><?php echo number_format($total_wash2); ?></td>
					<td><?php echo compute_percent($total_wash2,$total_n); ?></td>			
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_wash0); ?></td>
					<td><?php echo compute_percent($total_wash0,$total_n); ?></td>			
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container12" class="container"></div> 			
  		</div>
  	</td>
</tr>
				<tr ><td colspan="3"><strong>วิธีการล้างแผล </strong><strong>(n=<?php echo number_format($total_washdetail_all); ?>)</strong>
					<input type="hidden" name="render" value="container13">
					<button class="bar-chart img" name="bar" ></button>
					<button class="column-chart img" name="column"></button>
					<button class="pie-chart img" name="pie" ></button>					
				</td></tr>
				<tr class="para1">
					<td class="pad-left">น้ำ</td>
					<td><?php echo number_format($total_washdetail1); ?></td>
					<td><?php echo compute_percent($total_washdetail1,$total_washdetail_all); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">น้ำและสบู่ / ผงซักฟอก</td>
					<td><?php echo number_format($total_washdetail2); ?></td>
					<td><?php echo compute_percent($total_washdetail2,$total_washdetail_all); ?></td>	
				</tr>	
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td><?php echo number_format($total_washdetail3); ?></td>
					<td><?php echo compute_percent($total_washdetail3,$total_washdetail_all); ?></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_washdetail0); ?></td>
					<td><?php echo compute_percent($total_washdetail0,$total_washdetail_all); ?></td>	
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container13" class="container"></div> 			
  		</div>  		
  	</td>
</tr>
				<tr ><td colspan="3"><strong>การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</strong>
					<input type="hidden" name="render" value="container14">
					<button class="bar-chart img" name="bar"></button>
					<button class="column-chart img" name="column"></button>
					<button class="pie-chart img" name="pie"></button>					
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ได้ใส่ยา</td>
					<td><?php echo number_format($total_drug1); ?></td>
					<td><?php echo compute_percent($total_drug1,$total_n); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">ใส่ยา</td>
					<td><?php echo number_format($total_drug2); ?></td>
					<td><?php echo compute_percent($total_drug2,$total_n); ?></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_drug0); ?></td>
					<td><?php echo compute_percent($total_drug0,$total_n); ?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container14" class="container"></div> 			
  		</div>  		
  	</td>
</tr>
				<tr ><td colspan="3"><strong>ชนิดยาที่ใช้ใส่ฆ่าเชื้อ </strong><strong>(n = <? echo number_format($total_drugdetail_all) ?>)</strong>
					<input type="hidden" name="render" value="container15">
					<button class="bar-chart img" name="bar" ></button>
					<button class="column-chart img" name="column"></button>
					<button class="pie-chart img" name="pie"></button>					
				</td></tr>
				<tr class="para1">
					<td class="pad-left">สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์ เช่น โพวิดีน เบตาดีน ฯลฯ</td>
					<td><?php echo number_format($total_drugdetail1); ?></td>
					<td><?php echo compute_percent($total_drugdetail1,$total_n); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">ทิงเจอร์ไอโอดีน แอลกอฮอล์</td>
					<td><?php echo number_format($total_drugdetail2); ?></td>
					<td><?php echo compute_percent($total_drugdetail2,$total_n); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td><?php echo number_format($total_drugdetail3); ?></td>
					<td><?php echo compute_percent($total_drugdetail3,$total_n); ?></td>		
				</tr>		
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_drugdetail0); ?></td>
					<td><?php echo compute_percent($total_drugdetail0,$total_n); ?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container15" class="container"></div> 			
  		</div>  		
  	</td>
</tr>
		
				<tr ><td colspan="3"><strong>ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัสหรือสงสัยว่าสัมผัส</strong>
					<input type='hidden' name="render" value="container16">
					<button class="bar-chart img" name="bar"></button>
					<button class="column-chart img" name="column"></button>
					<button class="pie-chart img" name="pie"></button>				
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม</td>
					<td><?php echo number_format($total_protect10); ?></td>
					<td><?php echo compute_percent($total_protect10,$total_n); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">เคยฉีด 3 เข็มหรือมากกว่า</td>
					<td><?php echo number_format($total_protect20); ?></td>
					<td><?php echo compute_percent($total_protect20,$total_n); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_protect00); ?></td>
					<td><?php echo compute_percent($total_protect00,$total_n); ?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container16" class="container"></div> 			
  		</div>  		
  	</td>
</tr>
							
				<tr ><td colspan="3"><strong>ระยะเวลาที่ฉีดวัคซีน </strong><strong>(n= <? echo number_format($total_protect_all); ?>)</strong>
						<input type='hidden' name="render" value="container17">
						<button class="bar-chart img" name="bar"></button>
						<button class="column-chart img" name="column"></button>
    					<button class="pie-chart img" name="pie"></button>				
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ภายใน 6 เดือน</td>
					<td><?php echo number_format($total_protect21); ?></td>
					<td><?php echo compute_percent($total_protect21,$total_protect_all); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">เกิน 6 เดือน</td>
					<td><?php echo number_format($total_protect22); ?></td>
					<td><?php echo compute_percent($total_protect22,$total_protect_all); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_protect20); ?></td>
					<td><?php echo compute_percent($total_protect20,$total_protect_all); ?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container17" class="container"></div> 			
  		</div>  		
  	</td>
</tr>				
			</table>	
			<hr class="hr1">		
			<div id="btn_printout"><a href="report/index/1<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>

		</div><!--section4-->
		 <p class="page-break"></p>
		 <h3><a href="javascript:void(0);">ส่วนที่ 5 : การฉีดอิมมูโนโกลบุลินและวัคซีนในครั้งนี้</a></h3>
		<div id="section5">
			<h6>ตารางที่ 5  จำนวนและร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามการฉีดอิมมูโนโกลบุลินและวัคซีน  <a href="" class="excel"></a></h6>
			<table class="tbreport">
				<tr>
					<th>การฉีดอิมมูโนโกลบุลินและวัคซีน</th>
					<th>จำนวน (N=<?php echo $total_n;  ?>)</th>
					<th>ร้อยละ</th>
				</tr>
				<tr ><td colspan="5"><strong>อิมมูโนโกลบุลิน (RIG)</strong>
						<input type="hidden" name="render" value="container18">
						<button class="bar-chart img" name="bar"></button>
						<button class="column-chart img" name="column"></button>
    					<button class="pie-chart img" name="pie"></button>					
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่ฉีด</td>
					<td><?php echo number_format($total_rig10);?></td>
					<td><?php echo compute_percent($total_rig10,$total_n); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ฉีด</td>
					<td><?php echo number_format($total_rig_all);?></td>
					<td><?php echo compute_percent($total_rig_all,$total_n); ?></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_rig00);?></td>
					<td><?php echo number_format($total_rig00);?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container18" class="container"></div> 			
  		</div>  		
  	</td>
</tr>					
				<tr ><td colspan="3"><strong>ชนิดของอิมมูโนโกลบูลิน (RIG) </strong><strong> (n=<? echo $total_rig_all; ?>)</strong>
						<input type="hidden" name="render" value="container19">
						<button class="bar-chart img" name="bar"></button>
						<button class="column-chart img" name="column"></button>
    					<button class="pie-chart img" name="pie" ></button>					
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ERIG</td>
					<td><?php echo number_format($total_rig21);?></td>
					<td><?php echo compute_percent($total_rig21,$total_rig_all); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">HRIG</td>
					<td><?php echo number_format($total_rig22);?></td>
					<td><?php echo compute_percent($total_rig22,$total_rig_all); ?></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_rig20);?></td>
					<td><?php echo compute_percent($total_rig20,$total_rig_all); ?></td>			
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container19" class="container"></div> 			
  		</div>  		
  	</td>
</tr>					
						
				<tr ><td colspan="3"><strong>อาการหลังฉีดอิมมูโกลบูลิน (RIG) </strong><strong>(n=<?php echo number_format($total_afterrig_all) ?>)</strong>
						<input type="hidden" name="render" value="container20">
						<button class="bar-chart img" name="bar"></button>
						<button class="column-chart img" name="column"></button>
    					<button class="pie-chart img" name="pie"></button>
    										
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ไม่แพ้</td>
					<td><?php echo number_format($total_afterrig1);?></td>
					<td><?php echo compute_percent($total_afterrig1,$total_afterrig_all); ?></td>	
				</tr>
				<tr class="para1">
					<td class="pad-left">แพ้</td>
					<td><?php echo number_format($total_afterrig2);?></td>
					<td><?php echo compute_percent($total_afterrig2,$total_afterrig_all); ?></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_afterrig0);?></td>
					<td><?php echo compute_percent($total_afterrig0,$total_afterrig_all); ?></td>	
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container20" class="container"></div> 			
  		</div>  		
  	</td>
</tr>					
		
				<tr><td colspan="3"><strong>อาการแพ้อิมมูโนโกลบูลิน </strong><strong>(n= <?php echo number_format($total_detail) ?>)</strong>
						<input type="hidden" name="render" value="container21">
						<button class="bar-chart img" name="bar" ></button>
						<button class="column-chart img" name="column"></button>
    					<button class="pie-chart img" name="pie"></button>					
				</td></tr>
				<tr class="para1">
					<td class="pad-left">บวมแดง</td>
					<td><?php echo number_format($total_detail1);?></td>
					<td><?php echo compute_percent($total_detail1,$total_detail); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">คันบริเวณที่ฉีด</td>
					<td><?php echo number_format($total_detail2);?></td>
					<td><?php echo compute_percent($total_detail2,$total_detail); ?></td>			
				</tr>	
				<tr class="para1">
					<td class="pad-left">เป็นไข้</td>
					<td><?php echo number_format($total_detail3);?></td>
					<td><?php echo compute_percent($total_detail3,$total_detail); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">ปวดศรีษะ</td>
					<td><?php echo number_format($total_detail4);?></td>
					<td><?php echo compute_percent($total_detail4,$total_detail); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">เป็นผื่นคันทั่วไป</td>
					<td><?php echo number_format($total_detail5);?></td>
					<td><?php echo compute_percent($total_detail5,$total_detail); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ช๊อก</td>
					<td><?php echo number_format($total_detail6);?></td>
					<td><?php echo compute_percent($total_detail6,$total_detail); ?></td>			
				</tr>
				<tr class="para1">
					<td class="pad-left">อื่นๆ</td>
					<td><?php echo number_format($total_detail7);?></td>
					<td><?php echo compute_percent($total_detail7,$total_detail); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_detailno);?></td>
					<td><?php echo compute_percent($total_detailno,$total_detail); ?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3"> 		
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container21" class="container"></div> 			
  		</div>
  	</td>
</tr>	
				<tr ><td colspan="3"><strong>ระยะเวลาที่มีอาการแพ้อิมมูโนโกลบุลิน </strong><strong>(n= <?php echo number_format($total_longfeel); ?>)</strong>
						<input type="hidden" name="render" value="container22">
						<button class="bar-chart img" name="bar"></button>
						<button class="column-chart img" name="column"></button>
    					<button class="pie-chart img" name="pie" ></button>
				</td></tr>
				<tr class="para1">
					<td class="pad-left">ภายใน 2 ชั่วโมง</td>
					<td><?php echo number_format($total_longfeel1);?></td>
					<td><?php echo compute_percent($total_longfeel1,$total_longfeel); ?></td>		
				</tr>
				<tr class="para1">
					<td class="pad-left">หลัง 2 ชั่วโมง</td>
					<td><?php echo number_format($total_longfeel2);?></td>
					<td><?php echo compute_percent($total_longfeel2,$total_longfeel); ?></td>		
				</tr>	
				<tr class="para1">
					<td class="pad-left">ไม่ระบุ</td>
					<td><?php echo number_format($total_longfeel0);?></td>
					<td><?php echo compute_percent($total_longfeel0,$total_longfeel); ?></td>		
				</tr>
<tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container22" class="container"></div> 			
  		</div>
  	</td>
</tr>
			</table>	
			<hr class="hr1">		
			<div id="reference"><?php echo $reference?></div>			
			<div id="btn_printout">
			<a href="report/index/1<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
			<div id="area_btn_print">
				<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
				<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
			</div>
		</div><!--section5-->
	</div><!-- multicordion -->
</div><!--report -->
<?php endif; ?>
