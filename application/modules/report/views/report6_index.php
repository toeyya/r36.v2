<script type="text/javascript">
$(document).ready(function(){
	$('.btn_submit').click(function(){			
		if($('#area option:selected').val()==''){
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
        	r=290,x=2,y=-18;
        	if(t_graph=="column"){
        		a="center"      		
        	}
        	$('#'+render).highcharts({
            chart: {                
                type: t_graph,width:790,height:402,marginBottom: 80
            },
            title: { marginBottom:15,text: title,style: {color: '#000000',fontSize: '14px'}},
            yAxis: {
            	title:{
            		text: 'จำนวนเคส'         		          		
            	}            	
            },         			
            tooltip: {enabled:true},
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
            	column: { 
            		dataLabels: {enabled: true,
								 rotation: r,
								 x: x,
								 y: y
								             					
            					}
            		}            	              
            },           
            xAxis:{categories: arr, 
                title: {
                    text: 'อำเภอ'
                },           		         	
	            	labels: {	                	
	                	align:a,
	                	x: 0,
	                	y: 10
	            	}
	              },    
			 series:arr_val	
		});	
			
	}// function graph			
	$('.tr-graph').hide();
	$('td[colspan]').addClass('hasRowSpan');
	$('[name=close]').click(function(){$(this).closest('tr').fadeOut('slow');})
	
	$('.img').click(function(){
		var title 	=$('#province option:selected').text();
		var t_graph = $(this).attr('name');		
		var render 	= "container1"									
		var arr ={};
		var arr_title=[],arr_val1=[],arr_val2=[],arr_val_all=[];	
		var para;
		var j=0;
		var obj={};				
				$(this).closest('div').next('table').find('tr:eq(2)').nextUntil('.total').each(function(i,value){																																
						arr_title[j] = $(this).find('.pad-left').html();
						arr_val1[j] = parseFloat($(this).find('td:eq(1)').find('span').html());
						arr_val2[j] = parseFloat($(this).find('td:eq(2)').find('span').html());
						++j;
																		
				});	
					arr['name'] = 'สถานบริกานี้';
				 	arr['data'] = arr_val1;		 		
					arr_val_all[0] = jQuery.parseJSON(JSON.stringify(arr));	
				 	//console.log(arr_val_all);
				 	arr['name']	= 'สถานบริการอื่น'	
				 	arr['data'] = arr_val2;	
				    arr_val_all[1] = jQuery.parseJSON(JSON.stringify(arr));	
				    //console.log(arr_val_all)								
		
		graph(title,render,t_graph,arr_title,arr_val_all);								
		$(this).closest('div').next('table').find('.tr-graph').fadeIn('slow');
		
		
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
	<tr><td colspan="4" style="text-align: right;">หน่วย: เคส</td></tr>
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
	$totalallin=0;$totalallout=0;$totalallamphur=0;$in=0;$out=0;	
	foreach($amphur as $key =>$item):
			$eachamphur=0;
			$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid
				  WHERE $cond in_out=1 and hospitalamphur<>'0' and hospitalamphur ='".$item['amphur_id']."'";
			$in = $this->db->GetOne($sql);
			$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid
				  WHERE $cond in_out=2 and hospitalamphur<>'0' and hospitalamphur ='".$item['amphur_id']."'";	
			$out = $this->db->GetOne($sql);
			$eachamphur		= $in + $out;
			$totalallin		= $totalallin + $in;
			$totalallout 	= $totalallout + $out;
			$totalallamphur = $totalallamphur + $eachamphur;		
				
	 ?>	
	<tr class="para1">
		<td class="pad-left"><?php echo $item['amphur_name'] ?></td>		
		<td><span class="none"><?php echo $in;?></span><?php echo number_format($in);?></td>
		<td><span class="none"><?php echo $out;?></span><?php echo number_format($out);?></td>
		<td><?php echo number_format($eachamphur);  ?></td>
	</tr>
	<?php endforeach; ?>
	<tr class="total para1">
		<td class="pad-left">รวม</td>
		<td><?php echo number_format($totalallin); ?></td>
		<td><?php echo number_format($totalallout); ?></td>
		<td><?php echo number_format($totalallamphur); ?></td>
	</tr>
	<tr class="tr-graph">
	  	<td colspan="4">  		 		
	  		<div>
	  			<button name="close" title="close" value="close" class="btn btn_close">X</button>
	  			<div id="container1" class="container" style="height: 405px;"></div>
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