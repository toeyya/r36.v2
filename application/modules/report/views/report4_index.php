<script src="js/Highcharts/js/highcharts.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
$(function () { 
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
                text: 'สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอทั้งหมด'
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
<div id="title">สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ</div>
<div id="search">
<form action="report/index/4" method="get" name="formreport" onsubmit="return Chk_AnalyzeReport(this);">
	<table  class="tb_patient1">
	  <tr>
			<th>รูปแบบเขตความรับผิดชอบ</th>
			<td>
				<select name="area" id="area" class="styled-select" >
					<option value="-">กรุณาเลือกเขต</option>
					<option value="1" <?php echo (@$_GET['area']=="1")? "selected='selected":''; ?>>รูปแบบเดิม (12 เขต)</option>
					<option value="2" <?php echo (@$_GET['area']=="2")? "selected='selected":''; ?>>รูปแบบใหม่ (19 เขต)</option>
				</select>
			 </td>
			 <th>ข้อมูลรายเขต</th>
			<td>
			<span id="grouplist">
				<select name="group" class="styled-select" id="group">
					<option value="">ทั้งหมด</option>
				</select>
			</span>
			</td>
			<th>ข้อมูลรายจังหวัด</th>
			<td>
			<span id="provincelist">
				<select name="province" class="styled-select" id="prvince">
					<option value="">ทั้งหมด</option>
				</select>
			</span>
			</td>			
	  </tr>
	  <tr>

		<th>ข้อมูลรายอำเภอ</th>
		<td>
			<span id="amphurlist">
				<select name="amphur" class="styled-select">
					<option value="">ทั้งหมด</option>
				</select>
			</span></td>
		<th>ข้อมูลรายตำบล</th>
			<td>
				<span id="districtlist">
					<select name="district" class="styled-select" id="district">
						<option value="">ทั้งหมด</option>
					</select>
				</span>					</td>
			<th>ข้อมูลรายโรงพยาบาล</td>
			<td>
				<span id="hospitallist">
				<select name="hospital" class="styled-select" id="hospital">
					<option value="">ทั้งหมด</option>
				</select>
				</span></td>			
	  </tr>

	  <tr>
	    <th>จำแนกรายปีของวันที่สัมผัสโรค</th>
	    <td>
			<select name="year" class="styled-select">
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
			<th>จำแนกรายเดือนของวันที่สัมผัสโรค</th>
	    	<td>
			<select name="month" class="styled-select">
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
	  <th>จำแนกรายปีของวันที่บันทึกรายการ</th>
	    <td>
			<select name="year_report" class="styled-select">
			<option value="">ทั้งหมด</option>
			<?
			$syear = (date('Y')+543)-10;
			for($i=$syear;$i<=(date('Y')+543);$i++){
			?>
				<option value="<?php echo $i;?>"><?php echo $i;?></option>
			<?
			}
			?>
			</select></td>	
		
      </tr>   
	  <tr>  
			<th>จำแนกรายเดือนของวันที่บันทึกรายการ</th>
	    	<td>
			<select name="month_report" class="styled-select">
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
			<th>จำแนกตามสถานะ</th>
		<td  colspan="4">
 			<select name="type" class="styled-select">
				<option value="">ทั้งหมด</option>
				<option value="1">ในเขต</option>
				<option value="2">นอกเขต</option>
			</select>					</td>
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
		<p>สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ <?php echo $texttype;?></p>
	    <p>รูปแบบเขตความรับผิดชอบ<?php echo $textarea;?>   ข้อมูลรายเขต <?php echo $textgroup;?></p>
		<p>จังหวัด<?php echo $textprovince;?>  อำเภอ <?php echo $textamphur;?></p>
		<p>โรงพยาบาล <?php echo $texthospital;?>  ปี  <?php echo $textyear;?>  เดือน  <?php echo $textmonth;?></p>				
	</div>

	<table width="100%">
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

              <tr>
                <td height="20"><span class="bold">1. รายงานประวัติการฉีดวัคซีนคนไข้ (คน) ( N = 206 )</span><img src="media/images/n_execl.gif" width="16px" height="16px"></td>
                <td align="center">181</td>
                <td align="center">25</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>

                  <tr>
                    <td height="20"><span class="bold">2. สัญชาติ (คน) 
                    	<a href="javascript:void()" class="bar-chart img"></a>
                    	<a href="javascript:void()" class="pie-chart img" ></a>
                    	<a href="javascript:void()" class="horizontal-chart img" ></a>
                    </span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr >
                    <td height="20">ไทย</td>
                    <td align="center">179</td>
                    <td align="center">25</td>
                  </tr>
                  <tr>
                    <td height="20">จีน/ฮ่องกง/ใต้หวัน</td>
                    <td align="center">0</td>
                    <td align="center">0</td>
                  </tr>
                  <tr>
                    <td height="20">พม่า</td>
                    <td align="center">5</td>
                    <td align="center">5</td>
                  </tr>
                  <tr>
                    <td height="20">มาเลเซีย</td>
                    <td align="center">1</td>
                    <td align="center">0</td>
                  </tr>
                  <tr>
                    <td height="20">กัมพูชา</td>
                    <td align="center">2</td>
                    <td align="center">3</td>
                  </tr>
                  <tr>
                    <td height="20">ลาว</td>
                    <td align="center">1</td>
                    <td align="center">2</td>
                  </tr>
                  <tr>
                    <td height="20">เวียดนาม</td>
                    <td align="center">1</td>
                    <td align="center">0</td>
                  </tr>
                  <tr>
                    <td height="20">ยุโรป</td>
                    <td align="center">10</td>
                    <td align="center">0</td>
                  </tr>
                  <tr>
                    <td height="20">อเมริกา</td>
                    <td align="center">1</td>
                    <td align="center">1</td>
                  </tr>
                  <tr>
                    <td height="20">ไม่ทราบสัญชาติ</td>
                    <td align="center">0</td>
                    <td align="center">0</td>
                  </tr>
                  <tr>
                    <td height="20">ไม่ระบุ</td>
                    <td align="center">0</td>
                    <td align="center">0</td>
                  </tr>
                  <tr>
                    <td align="right" height="20"><strong>รวม</strong></td>
                    <td align="center">200</td>
                    <td align="center">36</td>
                  </tr>
                  <tr>
                  	<td colspan="3"><div id="container" style="width: 750px; height: 400px; margin: 0 auto"></div><div align="center"><a href="javascript:void()" name="close" title="close">close</a></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>

                  <tr>
                    <td height="20"><span class="bold">3. ชนิดของอิมมูโนโกลบุลิน (RIG) (โด๊ส)
                    	  <a href="javascript:void()" class="bar-chart img"></a>
                    	<a href="javascript:void()" class="pie-chart img" ></a>
                    	<a href="javascript:void()" class="horizontal-chart img" ></a>
                    	</span></td>
                    <td align="center"></td>
                    <td align="center"></td>
                  </tr>
                  <tr>
                    <td height="20">ERIG</td>
                    <td align="center">20</td>
                    <td align="center">10</td>
                  </tr>
                  <tr>
                    <td height="20">HRIG</td>
                    <td align="center">5</td>
                    <td align="center">6</td>
                  </tr>
                  <tr>
                    <td height="20" align="right"><strong>รวม</strong></td>
                    <td align="center">25</td>
                    <td align="center">16</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                
                  <tr>
                    <td height="20"><span class="bold">4. ชนิดของวัคซีน (โด๊ส)
                    	 <a href="javascript:void()" class="bar-chart img"></a>
                    	<a href="javascript:void()" class="pie-chart img" ></a>
                    	<a href="javascript:void()" class="horizontal-chart img" ></a>
                    </span></td>
                    <td align="center"></td>
                    <td align="center"></td>
                  </tr>
                  <tr>
                    <td height="20">PVRV</td>
                    <td align="center">334</td>
                    <td align="center">37</td>
                  </tr>
                  <tr>
                    <td height="20">PCEC</td>
                    <td align="center">148</td>
                    <td align="center">19</td>
                  </tr>
                  <tr>
                    <td height="20">HDCV</td>
                    <td align="center">0</td>
                    <td align="center">0</td>
                  </tr>
                  <tr>
                    <td height="20">PDEV</td>
                    <td align="center">0</td>
                    <td align="center">0</td>
                  </tr>
                  <tr>
                    <td height="20" align="right"><strong>รวม</strong></td>
                    <td align="center">482</td>
                    <td align="center">56</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3"><hr align="center" width="100%" size="1" /></td>
                  </tr>
                </table>

		<div id="btn_printout"><a href="report/index/4/preview"  ><img src="images/printer.gif" width="16" height="16" align="absmiddle" style="border:none" />&nbsp;พิมพ์รายงาน</a></div>
		<div id="area_btn_print">
			<input type="button" name="printreport" value="พิมพ์รายงาน" onClick="window.print();" class="Submit">
			<input type="button" name="closereport" value="ปิดหน้าต่างนี้" onClick="window.close();" class="Submit">
		</div>
</div>




