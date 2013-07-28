<script type="text/javascript">
$(document).ready(function(){
	$('.tr-graph').hide();
	$('td[colspan]').addClass('hasRowSpan');
	$('[name=close]').click(function(){$(this).closest('tr').fadeOut('slow');});
	function graph(title,render,t_graph,arr,arr_val){		
        	var rr =290;
        	var x=2;
        	var y =-18;
        	if(t_graph=="column"){
        		var a="center";      		
        	}else if(t_graph=="bar"){
        		var a="right";
        	}
        	$('#'+render).highcharts({
            chart: {                
                type: t_graph,width:790,height:402,marginBottom: 60
            },
            title: { marginBottom:15,text: title,style: {color: '#000000',fontSize: '14px'}},
            yAxis: {
            	title:{
            		text: null, style: {color: '#000000'}         		          		
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
            	bar: { dataLabels: {enabled: true}},            	
            	column: { 
            		dataLabels: {enabled: true,
								 rotation: rr,
								 x: x,
								 y: y            					
            					}
            		},
            	pie:{ dataLabels: {enabled: true}}
               
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
		var arr_para=[],arr_val1=[],arr_val2=[],arr_val_all=[];	
		var para;
		var j=0;
		var obj={};				
				$(this).closest('tr').next().nextUntil('.tr-graph').prev().each(function(i,value){																			
						arr_para[j] = $(this).find('.para1').html();
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
		
			graph(title,render,t_graph,arr_para,arr_val_all);			
					
		$(this).closest('tr').nextAll('.tr-graph:eq(0)').fadeIn('slow');
		
		
	});	
		
});
</script>
<div id="title">ข้อมูลผู้รับวัคซีนจำแนกตามสิทธิการรักษาของสถานบริการ</div>
<div id="search">

<form action="report/index/4" method="get" name="formreport">
	<table  class="tb_patient1">
	<?php require 'include/conditionreport.php'; ?>
		<tr>
	    	<th>ปีที่สัมผัสโรค</th>
	    	<td><?php echo form_dropdown('year_start',get_year_option(),@$_GET['year_start'],'class="styled-select"','ทั้งหมด') ?></td>
			<th>เดือนที่สัมผัสโรค</th>
	    	<td><?php echo form_dropdown('month_start',get_month(),@$_GET['month_start'],'class="styled-select"','ทั้งหมด'); ?></td>					      	  					
      </tr>   	  
  </table>
  <div class="btn_inline"><ul><li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li> </ul>
</div>	
</form>

</div>

<?php if(!empty($cond)): ?>
<div id="report">
	<div id="title">				  
	<p>รายงานผู้สัมผัสโรคจำแนกตามสิทธิการรักษาของสถานบริการ <?php echo $texttype;?></p>
    <p>เขตความรับผิดชอบ <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
	<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
	<p>สถานบริการ<?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></p>				
</div>
	<div class="right">
		<a href="report/index/4<?php echo '?'.$_SERVER['QUERY_STRING'].'&excel=excel' ?>" class="excel" name="btn_excel"></a></div> 
<table class="tbreport">         
  <tr>
    <th style="text-align: center" rowspan="2"><strong>รายการ</strong></th>
    <th colspan="2" style="text-align:center"><strong>สิทธิการรักษา</strong></th>
  </tr>
  <tr>          	
    <th align="center"><strong>สถานบริการนี้</strong></th>
    <th align="center"><strong>สถานบริการอื่น</strong></th>
  </tr> 
  <tr>
    <td><strong> จำนวนผู้สัมผัสโรค ( N = <?php echo number_format($in_out1+$in_out2); ?> )</strong></td>
    <td align="center"><strong><?php echo number_format($in_out1); ?></strong></td>
    <td align="center"><strong><?php echo number_format($in_out2); ?></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong> สัญชาติ (คน) </strong>
		<input type="hidden" name="render" value="container1">
		<button class="bar-chart img" name="bar" ></button>
		<button class="column-chart img" name="column"></button>
			    	
    </td>  
  </tr>
  <tr >
    <td><span class="para1">ไทย</span></td>
    <td align="center"><span class="none"><?php echo $in_out3; ?></span><?php echo number_format($in_out3); ?></td>
    <td align="center"><span class="none"><?php echo $in_out14; ?></span><?php echo number_format($in_out14); ?></td>
  </tr>
  <tr>
    <td><span class="para1">จีน/ฮ่องกง/ใต้หวัน</span></td>
    <td align="center"><span class="none"><?php echo $in_out4; ?></span><?php echo number_format($in_out4); ?></td>
    <td align="center"><span class="none"><?php echo $in_out15; ?></span><?php echo number_format($in_out15); ?></td>
  </tr>
  <tr>
    <td><span class="para1">พม่า</span></td>
    <td align="center"><span class="none"><?php echo  $in_out5; ?></span><?php echo number_format($in_out5); ?></td>
    <td align="center"><span class="none"><?php echo  $in_out16; ?></span><?php echo number_format($in_out16); ?></td>
  </tr>
  <tr>
    <td><span class="para1">มาเลเซีย</span></td>
    <td align="center"><span class="none"><?php echo  $in_out6; ?></span><?php echo number_format($in_out6); ?></td>
    <td align="center"><span class="none"><?php echo  $in_out17; ?></span><?php echo number_format($in_out17); ?></td>
  </tr>
  <tr>
    <td><span class="para1">กัมพูชา</span></td>
    <td align="center"><span class="none"><?php echo  $in_out7; ?></span><?php echo number_format($in_out7); ?></td>
    <td align="center"><span class="none"><?php echo  $in_out18; ?></span><?php echo number_format($in_out18); ?></td>
  </tr>
  <tr>
    <td ><span class="para1">ลาว</span></td>
    <td align="center"><span class="none"><?php echo  $in_out8; ?></span><?php echo number_format($in_out8); ?></td>
    <td align="center"><span class="none"><?php echo  $in_out19; ?></span><?php echo number_format($in_out19); ?></td>
  </tr>
  <tr>
    <td><span class="para1">เวียดนาม</span></td>
    <td align="center"><span class="none"><?php echo  $in_out9; ?></span><?php echo number_format($in_out9); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out20; ?></span><?php echo number_format($in_out20); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ยุโรป</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out10; ?></span><?php echo number_format($in_out10); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out21; ?></span><?php echo number_format($in_out21); ?></td>
  </tr>
  <tr>
    <td><span class="para1">อเมริกา</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out11; ?></span><?php echo number_format($in_out11); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out22; ?></span><?php echo number_format($in_out22); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ไม่ทราบสัญชาติ</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out12; ?></span><?php echo number_format($in_out12); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out23; ?></span><?php echo number_format($in_out23); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ไม่ระบุ</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out13; ?></span><?php echo number_format($in_out13); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out24; ?></span><?php echo number_format($in_out24); ?></td>
  </tr>
		
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center"><strong><?php echo number_format($total3); ?></strong></td>
    <td align="center"><strong><?php echo number_format($total4); ?></strong></td>
  </tr>
  <tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container1" class="container" style="height: 405px;"></div>		
  		</div>
  	</td>
 </tr>	  
  <tr>
    <td colspan="3"><strong> ชนิดของอิมมูโนโกลบุลิน (RIG)
		<input type="hidden" name="render" value="container2">
		<button class="bar-chart img" name="bar" ></button>
		<button class="column-chart img" name="column"></button>
			</td>  
  </tr>
  <tr>
    <td><span class="para1">ERIG</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out25; ?></span><?php echo number_format($in_out25); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out26; ?></span><?php echo number_format($in_out26); ?></td>
  </tr>
  <tr>
    <td><span class="para1">HRIG</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out27; ?></span><?php echo number_format($in_out27); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out28; ?></span><?php echo number_format($in_out28); ?></td>
  </tr>			
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center"><strong><?php echo number_format($total3); ?></strong></td>
    <td align="center"><strong><?php echo number_format($total4); ?></strong></td>
  </tr>
  <tr class="tr-graph">
  	<td colspan="3">
   		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container2" class="container" style="height: 405px;"></div>		
  		</div>

  	</td>
 </tr>              
  <tr>
    <td colspan="3"><strong> ชนิดของวัคซีน </strong>		
    	<input type="hidden" name="render" value="container3">
		<button class="bar-chart img" name="bar" ></button>
		<button class="column-chart img" name="column"></button>
		</td>

  </tr>
  <tr>
    <td><span class="para1">PVRV</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out29; ?></span><?php echo number_format($in_out29); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out30; ?></span><?php echo number_format($in_out30); ?></td>
  </tr>
  <tr>
    <td><span class="para1">PCEC</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out31; ?></span><?php echo number_format($in_out31); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out32; ?></span><?php echo number_format($in_out32); ?></td>
  </tr>
  <tr>
    <td><span class="para1">HDCV</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out33; ?></span><?php echo number_format($in_out33); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out34; ?></span><?php echo number_format($in_out34); ?></td>
  </tr>
  <tr>
    <td><span class="para1">PDEV</span></td>
    <td align="center" ><span class="none"><?php echo  $in_out35; ?></span><?php echo number_format($in_out35); ?></td>
    <td align="center" ><span class="none"><?php echo  $in_out36; ?></span><?php echo number_format($in_out36); ?></td>
  </tr>			
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center" ><strong><?php echo number_format($total5); ?></strong></td>
    <td align="center" ><strong><?php echo number_format($total6); ?></strong></td>
  </tr>
  <tr class="tr-graph">
  	<td colspan="3">
  		<div><button name="close" title="close" value="close" class="btn btn_close">X</button>
  			<div id="container3" class="container" style="height: 405px;"></div>		
  		</div>  		
  	</td>
</tr>  
</table>
<hr class="hr1">
<div id="reference">แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข</div>			
<div id="btn_printout"><a href="report/index/4<?php echo '?'.$_SERVER['QUERY_STRING'].'&p=preview' ?>"><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
<div id="area_btn_print">
	<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
	<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
</div>
</div>
<?php endif;?>



