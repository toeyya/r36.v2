<script src="media/js/Highcharts/js/highcharts.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
$(document).(function(){ 
	$('a[name=close]').click(function(){
		$('#container').fadeOut();
		$('#container').next("div").fadeOut('slow');
	})
	$('#container').hide(); 
	$('#container').next("div").hide();  
    $('.horizontal-chart').click(function() {
    	$('#container').fadeIn();   
    	$('#container').next("div").fadeIn();
    	var chart;
         chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'bar'
            },
            title: {
                text: 'ร้อยละของผู้สัมผัสโรคพิษสุนัขบ้า แจกแจงตามเพศ'
            },
            subtitle: {
                text: 'สัญชาติ(คน)'
            },
            xAxis: {
                categories: ['ไทย', 'จีน/ฮ่องกง/ไต้หวัน','พม่า' ,'มาเลเซีย', 'กัมพูชา', 'ลาว','เวียดนาม','ยุโรป','อเมริกา','ไม่ทราบสัญชาติ','ไม่ระบุสัญชาติ'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวน (คน)',
                  
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +' millions';
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -100,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'ในเขต',
                data: [179, 0, 5, 1, 2,1,1,10,1,0,0]
            }, {
                name: 'นอกเขต',
                data: [25, 0, 5, 0, 3,2,0,0,1,0,0]
            }]
        });
    });
    $('.pie-chart').click(function(){
		 $('#container').fadeIn();   
		 $('#container').next("div").fadeIn();
		 var chart;		 
       var colors = Highcharts.getOptions().colors,
            categories =  ['ไทย', 'จีน/ฮ่องกง/ไต้หวัน','พม่า' ,'มาเลเซีย', 'กัมพูชา', 'ลาว','เวียดนาม','ยุโรป','อเมริกา','ไม่ทราบสัญชาติ','ไม่ระบุสัญชาติ'],
            name = 'สัญชาติ (คน)',
            data = [{
                    y:204 ,
                    color: colors[0],
                    drilldown: {
                        name: 'ไทย',
                        categories: ['ในเขต', 'นอกเขต'],
                        data: [179, 25],
                        color: colors[0]
                    }
                }, {
                    y: 0,
                    color: colors[1],
                    drilldown: {
                        name: 'จีน/ฮ่องกง/ไต้หวัน',
                        categories: ['ในเขต', 'นอกเขต'],
                        data: [0, 0],
                        color: colors[1]
                    }
                }, {
                    y: 10,
                    color: colors[2],
                    drilldown: {
                        name: 'พม่า',
                       categories: ['ในเขต', 'นอกเขต'],
                        data: [5, 5],
                        color: colors[2]
                    }
                }, {
                    y: 1,
                    color: colors[3],
                    drilldown: {
                        name: 'มาเลเซีย',
						categories: ['ในเขต', 'นอกเขต'],
                        data: [1, 0],
                        color: colors[3]
                    }
                }, {
                    y: 5,
                    color: colors[4],
                    drilldown: {
                        name: 'กัมพูชา',
						categories: ['ในเขต', 'นอกเขต'],
                        data: [ 2, 3],
                        color: colors[4]
                    }
                },{
                    y: 3,
                    color: colors[5],
                    drilldown: {
                        name: 'ลาว',
						categories: ['ในเขต', 'นอกเขต'],
                        data: [ 1, 2],
                        color: colors[5]
                    }
                },{
                    y: 1,
                    color: colors[6],
                    drilldown: {
                        name: 'เวียดนาม',
						categories: ['ในเขต', 'นอกเขต'],
                        data: [ 1, 0],
                        color: colors[6]
                    }
                },{
                    y: 10,
                    color: colors[7],
                    drilldown: {
                        name: 'ยุโรป',
						categories: ['ในเขต', 'นอกเขต'],
                        data: [ 10, 0],
                        color: colors[7]
                    }
                },{
                    y: 2,
                    color: colors[8],
                    drilldown: {
                        name: 'อเมริกา',
						categories: ['ในเขต', 'นอกเขต'],
                        data: [ 1, 1],
                        color: colors[8]
                    }
                },{
                    y: 0,
                    color: colors[9],
                    drilldown: {
                        name: 'ไม่ทราบสัญชาติ',
						categories: ['ในเขต', 'นอกเขต'],
                        data: [ 0, 0],
                        color: colors[9]
                    }
                },{
                    y: 0,
                    color: colors[10],
                    drilldown: {
                        name: 'ไม่ระบุสัญชาติ',
						categories: ['ในเขต', 'นอกเขต'],
                        data: [ 0, 0],
                        color: colors[10]
                    }
                }];
    
    
        // Build the data arrays
        var browserData = [];
        var versionsData = [];
        for (var i = 0; i < data.length; i++) {
    
            // add browser data
            browserData.push({
                name: categories[i],
                y: data[i].y,
                color: data[i].color
            });
    
            // add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                versionsData.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                });
            }
        }
    
        // Create the chart
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'pie'
            },
            title: {
                text: 'สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอทั้งหมด'
            },
            subtitle: {
		                text: 'สัญชาติ(คน)'
		            },
            yAxis: {
                title: {
                    text: 'สัญชาติ (คน)'
                }
            },
            plotOptions: {
                pie: {
                    shadow: false
                }
            },
            tooltip: {
        	    valueSuffix: '%'
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Browsers',
                data: browserData,
                size: '60%',
                dataLabels: {
                    formatter: function() {
                        return this.y > 5 ? this.point.name : null;
                    },
                    color: 'white',
                    distance: -30
                }
            }, {
                name: 'Versions',
                data: versionsData,
                innerSize: '60%',
                dataLabels: {
                    formatter: function() {
                        // display only if larger than 1
                        return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ this.y +'คน'  : null;
                    }
                }
            }]
        });
		    });   	
		$('.bar-chart').click(function(){
		   $('#container').fadeIn(); 
		   $('#container').next("div").fadeIn();  
		     var chart;
		      chart = new Highcharts.Chart({
		            chart: {
		                renderTo: 'container',
		                type: 'column'
		            },
		            title: {
		                text: 'สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอทั้งหมด'
		            },
		            subtitle: {
		                text: 'สัญชาติ(คน)'
		            },
		            xAxis: {
	  categories: ['ไทย', 'จีน/ฮ่องกง/ไต้หวัน','พม่า' ,'มาเลเซีย', 'กัมพูชา', 'ลาว','เวียดนาม','ยุโรป','อเมริกา','ไม่ทราบสัญชาติ','ไม่ระบุสัญชาติ']
		            },
		            yAxis: {
		                min: 0,
		                title: {
		                    text: 'จำนวน(คน)'
		                }
		            },
		            legend: {
		                layout: 'vertical',
		                backgroundColor: '#FFFFFF',
		                align: 'right',
		                verticalAlign: 'top',
		                x: 0,
		                y: 30,
		                floating: true,
		                shadow: true
		            },
		            tooltip: {
		                formatter: function() {
		                    return ''+
		                        this.x +': '+ this.y +' คน';
		                }
		            },
		            plotOptions: {
		                column: {
		                    pointPadding: 0.2,
		                    borderWidth: 0
		                }
		            },
		             credits: {
                		enabled: false
            		},
		                series: [{
			                name: 'ในเขต',
			                data: [179, 0, 5, 1, 2,1,1,10,1,0,0]
			            }, {
			                name: 'นอกเขต',
			                data: [25, 0, 5, 0, 3,2,0,0,1,0,0]
			            }]
		        });
		
		});// bar-chart
});		

</script>
<div id="title">ข้อมูลผู้รับวัคซีนจำแนกตามสิทธิการรักษาของสถานบริการ</div>
<div id="search">
<?php if(empty($cond)): ?>
<form action="report/index/4" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
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
<?php endif; ?>
</div>
<div id="report">
<div id="title">				  
	<p>รายงานผู้สัมผัสโรคจำแนกตามสิทธิการรักษาของสถานบริการ <?php echo $texttype;?></p>
    <p>เขตความรับผิดชอบ <?php echo $textarea;?> :เขต <?php echo $textgroup;?></p>
	<p>จังหวัด <?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?>  ตำบล <?php echo $textdistrict ?></p>
	<p>สถานบริการ<?php echo $texthospital;?>  ปี  <?php echo $textyear_start;?>  เดือน  <?php echo $textmonth_start;?></p>				
</div>

<?php if(!empty($cond)): ?>
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
    <td><strong>1. จำนวนผู้สัมผัสโรค ( N = <?php echo number_format($total); ?> )</strong><img src="media/images/n_execl.gif" width="16px" height="16px"></td>
    <td align="center"><strong><?php echo number_format($in_out1); ?></strong></td>
    <td align="center"><strong><?php echo number_format($in_out2); ?></strong></td>
  </tr>
  <tr>
    <td><strong>2. สัญชาติ (คน) </strong>
    	<a href="javascript:void()" class="bar-chart img"></a>
    	<a href="javascript:void()" class="pie-chart img" ></a>
    	<a href="javascript:void()" class="horizontal-chart img" ></a>
    </td>
    <td></td><td></td>
  </tr>
  <tr >
    <td><span class="para1">ไทย</span></td>
    <td align="center"><?php echo number_format($in_out3); ?></td>
    <td align="center"><?php echo number_format($in_out14); ?></td>
  </tr>
  <tr>
    <td><span class="para1">จีน/ฮ่องกง/ใต้หวัน</span></td>
    <td align="center"><?php echo number_format($in_out4); ?></td>
    <td align="center"><?php echo number_format($in_out15); ?></td>
  </tr>
  <tr>
    <td><span class="para1">พม่า</span></td>
    <td align="center"><?php echo number_format($in_out5); ?></td>
    <td align="center"><?php echo number_format($in_out16); ?></td>
  </tr>
  <tr>
    <td><span class="para1">มาเลเซีย</span></td>
    <td align="center"><?php echo number_format($in_out6); ?></td>
    <td align="center"><?php echo number_format($in_out17); ?></td>
  </tr>
  <tr>
    <td><span class="para1">กัมพูชา</span></td>
    <td align="center"><?php echo number_format($in_out7); ?></td>
    <td align="center"><?php echo number_format($in_out18); ?></td>
  </tr>
  <tr>
    <td ><span class="para1">ลาว</span></td>
    <td align="center"><?php echo number_format($in_out8); ?></td>
    <td align="center"><?php echo number_format($in_out19); ?></td>
  </tr>
  <tr>
    <td><span class="para1">เวียดนาม</span></td>
    <td align="center"><?php echo number_format($in_out9); ?></td>
    <td align="center" ><?php echo number_format($in_out20); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ยุโรป</span></td>
    <td align="center" ><?php echo number_format($in_out10); ?></td>
    <td align="center" ><?php echo number_format($in_out21); ?></td>
  </tr>
  <tr>
    <td><span class="para1">อเมริกา</span></td>
    <td align="center" ><?php echo number_format($in_out11); ?></td>
    <td align="center" ><?php echo number_format($in_out22); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ไม่ทราบสัญชาติ</span></td>
    <td align="center" ><?php echo number_format($in_out12); ?></td>
    <td align="center" ><?php echo number_format($in_out23); ?></td>
  </tr>
  <tr>
    <td><span class="para1">ไม่ระบุ</span></td>
    <td align="center" ><?php echo number_format($in_out13); ?></td>
    <td align="center" ><?php echo number_format($in_out24); ?></td>
  </tr>
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center"><strong><?php echo number_format($total3); ?></strong></td>
    <td align="center"><strong><?php echo number_format($total4); ?></strong></td>
  </tr>
  <tr>
  	<td colspan="3"><div id="container" style="width: 750px; height: 400px; margin: 0 auto"></div><div ><a href="javascript:void()" name="close" title="close">close</a></div></td>
  </tr>
  <tr>
    <td><strong>3. ชนิดของอิมมูโนโกลบุลิน (RIG) (โด๊ส)
    	  <a href="javascript:void()" class="bar-chart img"></a>
    	<a href="javascript:void()" class="pie-chart img" ></a>
    	<a href="javascript:void()" class="horizontal-chart img" ></a>
    	</td>
    <td ></td>
    <td ></td>
  </tr>
  <tr>
    <td><span class="para1">ERIG</span></td>
    <td align="center" ><?php echo number_format($in_out25); ?></td>
    <td align="center" ><?php echo number_format($in_out26); ?></td>
  </tr>
  <tr>
    <td><span class="para1">HRIG</span></td>
    <td align="center" ><?php echo number_format($in_out27); ?></td>
    <td align="center" ><?php echo number_format($in_out28); ?></td>
  </tr>
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center"><strong><?php echo number_format($total3); ?></strong></td>
    <td align="center"><strong><?php echo number_format($total4); ?></strong></td>
  </tr>            
  <tr>
    <td><strong>4. ชนิดของวัคซีน (โด๊ส)</strong>
    	 <a href="javascript:void()" class="bar-chart img"></a>
    	<a href="javascript:void()" class="pie-chart img" ></a>
    	<a href="javascript:void()" class="horizontal-chart img" ></a>
   </td>
    <td ></td>
    <td ></td>
  </tr>
  <tr>
    <td><span class="para1">PVRV</span></td>
    <td align="center" ><?php echo number_format($in_out29); ?></td>
    <td align="center" ><?php echo number_format($in_out30); ?></td>
  </tr>
  <tr>
    <td><span class="para1">PCEC</span></td>
    <td align="center" ><?php echo number_format($in_out31); ?></td>
    <td align="center" ><?php echo number_format($in_out32); ?></td>
  </tr>
  <tr>
    <td><span class="para1">HDCV</span></td>
    <td align="center" ><?php echo number_format($in_out33); ?></td>
    <td align="center" ><?php echo number_format($in_out34); ?></td>
  </tr>
  <tr>
    <td><span class="para1">PDEV</span></td>
    <td align="center" ><?php echo number_format($in_out35); ?></td>
    <td align="center" ><?php echo number_format($in_out36); ?></td>
  </tr>
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center" ><strong><?php echo number_format($total5); ?></strong></td>
    <td align="center" ><strong><?php echo number_format($total6); ?></strong></td>
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



