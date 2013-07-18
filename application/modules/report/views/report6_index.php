<script type="text/javascript">
$(document).ready(function(){
	$('.btn_submit').click(function(){			
		if($('#area').val()==''){
			alert('กรุณาเลือกรูปแบบเขตความรับผิดชอบในการออกรายงาน');
			return false;
		}
		if($('#group option:selected').val()==''){
			alert('กรุณาเลือกข้อมูลรายเขต');
			return false;
		}
		if($('#province option:selected').val()==''){
			alert('กรุณาเลือกจังหวัดในการออกรายงาน');
			return false;
		}
	});
	function graph(title,render,t_graph,arr,arr_val){		
        	var r=0,a="center";yy=10;
        	if(render=="container7"){
        		r=90;a="left";yy=20;
        	}
        	$('#'+render).highcharts({
            chart: {                
                type: t_graph,width:680,height:302,marginLeft:15
            },
            title: { marginBottom:15,text: 'ร้อยละของผู้สัมผัสโรคพิษสุนัขบ้าแจกแจง ตามสิทธิการรักษาของจังหวัด'+title,style: {color: '#000000',fontSize: '14px'}},
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
            	pie:{ dataLabels: {enabled: true, format: '<b>{point.name}</b>: {point.percentage:.1f} %'}}
               
            },           
            xAxis: {categories:['สิทธิการรักษาสถานบริการนี้','สิทธิการรักษาสถานบริการอื่น'],             		         	
	            	labels: {
	                	rotation: r,
	                	align:a,
	                	x: 0,
	                	y: yy
	            	}             		            	         	          
            },
            /*series: [{data:arr_val}]*/
			series:arr_val	
		});	
			
	}					
	$('.tr-graph').hide();
	$('td[colspan]').addClass('hasRowSpan');
	$('[name=close]').click(function(){$(this).closest('tr').fadeOut('slow');})
	
	$('.img').click(function(){
		
		var title 	=$('#province option:selected').text();
		var t_graph = $(this).attr('name');		
		var render 	= "container1"								
		var arr={},arr_val=[],arr_val_all=[],pre=[];	
		var padd_left,title_padd,j=0,k=0;
		var obj={};
									
					$(this).closest('div').next('table').find('tr:eq(2)').nextUntil('.total').each(function(i,value){																				
																					
							arr_val[0]=parseFloat( $(this).find('.pad-left').next().next().html());	
							arr_val[1]=parseFloat($(this).find('.pad-left').next().html());																																																														
				 			arr['name'] = $(this).find('.pad-left').html();
				 			arr['data'] = arr_val;					 		
							arr_val_all[i] = jQuery.parseJSON(JSON.stringify(arr));
																								
					});									   
		console.log(arr_val_all);
		$(this).closest('div').next('table').find('.tr-graph').fadeIn('slow');
		graph(title,render,t_graph,arr,arr_val_all);
		
	});	
	 $('#button').click(function() {
        var chart = $('#container').highcharts();
        chart.print();
    });
   
})
</script>
<div id="title">ข้อมูลรายจังหวัด</div>
<div id="search">
<form action="report/index/6" method="get" name="formreport">
<table  class="tb_patient1">
<?php require 'include/conditionreport.php'; ?>
	<tr>
	   <th>ปีสัมผัสโรค</th>
	   <td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>
	   <th>เดือนที่สัมผัสโรค</th>
	   <td><?php echo form_dropdown('month_start',get_month(),@$_GET['month_start'],'class="styled-select"','ทั้งหมด'); ?>	</td>
	</tr>
	<tr>
	   <th>ปีที่บันทึกรายการ</th>
	   <td><?php echo form_dropdown('year_report_start',get_year_option(),@$_GET['year_report_start'],'class="styled-select"','ทั้งหมด') ?></td>		
	   <th>เดือนที่บันทึกรายการ</th>
       <td><?php echo form_dropdown('month_report_start',get_month(),@$_GET['month_report_start'],'class="styled-select"','ทั้งหมด'); ?></td>
	</tr>
</table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit"></button></li></ul></div>
</form>

</div>
<?php if(!empty($cond)): ?>
<div id="report">	
<div id="title">
	<p>รายงานจังหวัด<?php echo $textprovince ?>  เดือน  <?php echo $textmonth_start ?> ปี  <? echo $textyear_start ?></p>
</div>
	<div style="float:right;margin-top:-40px;clear: both;width:20%;text-align:right;"><button class="column-chart img" name="column"></button>
		<a href="report/index/6<?php echo '?'.$_SERVER['QUERY_STRING'].'&excel=excel' ?>" class="excel" name="btn_excel"></a></div> 
<table class="tbreport">
	<tr><td colspan="4" style="text-align: right;">หน่วย: คน</td></tr>
	<tr>
		<th rowspan="2">อำเภอ</th>		
		<th colspan="2">สิทธิการรักษา</th>		
		<th rowspan="2">ยอดรวม</th>
	</tr>
	<tr>
		<th>สถานบริการนี้</th>
		<th>สถานบริการอื่น</th>
	</tr>
	<?php 
	$total1=0;$total2=0;$total_all=0;
	foreach($result as $item): ?>
	<tr class="para1">
		<td class="pad-left"><?php echo $item['amphur_name'] ?></td>		
		<td><?php echo $in =number_format($item['cnt1']); $total1 =$total1 + $in;?></td>
		<td><?php echo $out=number_format($item['cnt2']); $total2 =$total2 + $out;?></td>
		<td><?php echo $all= $in+$out; number_format($all); $total_all =$total_all + $all ?></td>
	</tr>
	<?php endforeach; ?>
	<tr class="total para1">
		<td class="pad-left">รวม</td>
		<td><?php echo number_format($total1); ?></td>
		<td><?php echo number_format($total2); ?></td>
		<td><?php echo number_format($total_all); ?></td>
	</tr>
<tr class="tr-graph" height="700">
  	<td colspan="4">  		 		
  		<div>
  			<button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container1" class="container" style="width:700px;height:305px;"></div>
  		</div>  		  		
  	</td>
</tr>
</table>
	<hr class="hr1">
	<div id="reference"><?php echo $reference?></div>	
	<div id="btn_printout"><a href="report/index/6<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
	<div id="area_btn_print">
		<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
		<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
	</div>
</div>	
<?php endif; ?>