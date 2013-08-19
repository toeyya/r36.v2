<?php 

error_reporting(0); 

$tdate=date("Y-m-d");

$d11 = explode("-",date("Y-m-d"));
				
$sdate = $d11[2]."-".$d11[1]."-".($d11[0]+543);

$edate = $d11[2]."-".sprintf("%02d",($d11[1]+1))."-".($d11[0]+543);
				
?>

<!doctype html>
<html lang="en">
<head>
<base href="<?php echo base_url(); ?>" />
<title><?php echo $template['title']; ?></title>
<?php echo $template['metadata']; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<!--<meta http-equiv="Content-Type" content="text/html; charset=tis-620">-->

<link rel="stylesheet" href="themes/map/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="themes/map/media/css/set_map.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="themes/map/media/js/jquery-1.4.2.min.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="themes/map/media/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="themes/map/media/js/jquery-ui1.10.3.js"></script>
<script type="text/javascript" src="themes/map/media/js/highcharts.js"></script>
<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php?key=7a19bf7e66f74a0b39843f76eaf11371"></script>

    <!--calendare-->
<link rel="stylesheet" type="text/css" href="themes/map/tcal.css" />
<script type="text/javascript" src="themes/map/tcal.js"></script> 


<script type="text/javascript">

var fillcolor = "#FF3F3F";
var linecolor = "#FF3F3F";

// เขียว 00FF00
// แดง F70707
// ส้ม FA6000
// เหลือง FAC802



var mmmap;
var mmmapig;

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");
	window.onresize = myRepaint;
	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,6, 'political');
  mmmap.hideScale();
  mmmap.hideModeSelector();
  mmmap.hideCenterMark();
  mmmap.setZoom(6);
  
	myRepaint();

  if(!mmmapig) {
    mmmapig = new MMMapIG(mmmap);
  }
  
  drawObjectSet(0);
}

var objs = new Array();


function drawObjectSet(set) {

  var area = [
    [
      ['Head office'],
      ['10','11'],
      ['#FA6000']
    ],
    [
      ['Khet1'],
      ['12','13','14','15','16','17','18','19'],
      ['#FA6000']
    ],
    [
      ['Khet2'],
      ['20','21','22','23','24','25','26','27'],
      ['#FA6000']
    ],
    [
      ['Khet3'],
      ['30','31','32','33','34','35','36','37'],
      ['#F70707']
    ],
    [
      ['Khet4'],
      ['40','41','42','43','44','45','46','47','48','49','01','39'],
      ['#F70707']
    ],
    [
      ['Khet5'],
      ['50','51','52','53','54','55','56','57','58'],
      ['#F70707']
    ],
    [
      ['Khet6'],
      ['60','61','62','63','64','65','66','67'],
      ['#FA6000']
    ],
    [
      ['Khet7'],
      ['70','71','72','73','74','75','76','77'],
      ['#F70707']
    ],
    [
      ['Khet8'],
      ['80','81','82','83','84','85','86'],
      ['#F70707']
    ],
    [
      ['Khet9'],
      ['90','91','92','93','94','95','96'],
      ['#F70707']
    ]
  ]
  
  for(var i=0; i<area.length; i++) {
    mmmapig.hideCurrentObjectGroup();
    if(mmmapig.getCurrentObjectGroup()) mmmapig.clearCache();
    
    var object = {
      "combine" : true,
      "mmmap" : mmmap,
      "mmmapig" : mmmapig,
      "groupid" : area[i][0],
      "id" : area[i][1],
      "ds" : "IG",
      "simplify" : 0.0007,
      "clearcache" : false, // enable this if you want to use fresh data
      "linewidth" : 2,
      "linecolor" : "#474747",
      "fillcolor" : area[i][2].toString(),
      "lineopacity" : 1,
      "fillopacity" : 0.3,
      "showlabel" : false,
  		"ignorefragment" : true,
      "minzoom" : 1,
      "maxzoom" : 20,
      "handler" : {
        "ondraw" : function(){loading(true)},
        "ondrawsuccess" : function(){loading(false);},
        "onload" : function() {},
        "onmouseover" : function() {},
        "onmouseout" : function() {} 
      }
    }
    
    var objgroup = new MMMapIGGroup(object);
    mmmapig.addObjectGroup(objgroup);
    
  }
}
var loadingtimeout = false;
function loading(bool) {
  if(bool) {
    document.getElementById('loading').style.zIndex = '9999';
    document.getElementById('loading').style.display = 'inline';
    document.getElementById('loading-bar').style.zIndex = '9999';
    document.getElementById('loading-bar').style.visibility = 'visible';
    
  }else {
    var clear = function() {
      document.getElementById('loading').style.zIndex = '-9999';
      document.getElementById('loading').style.display = 'none';
      document.getElementById('loading-bar').style.zIndex = '-9999';
      document.getElementById('loading-bar').style.visibility = 'hidden';
    }
    if(loadingtimeout) clearTimeout(loadingtimeout)
    loadingtimeout = setTimeout(clear, 100);
  }
}

function myRepaint() {
	chkWinSize();

	var newwidth = parseInt(ww) - 5 - 5;
	var newheight = parseInt(wh) - 100 - 5;
  
  document.getElementById('loading-bar').style.top =    newheight/2 - 50 + 'px';
	document.getElementById('loading-bar').style.left = newwidth/2 - 40 + 'px';
	document.getElementById('loading-bar').style.visibility = 'visible';

	mmmap.setSize(860,newheight);
	mmmap.rePaint();

}


$(document).ready(function(){
	
	
	

		

  
	
					
					
			    $('#section').change(function() {
					
					
			    var txt = $("#section").val();
				var mode = 'm_sec';
				
						$("#show_province").load("gis_map/show_province/"+txt+"/"+mode);
						
				});
				
				
				$('#sub_area').change(function() {
					
					
			    		var txt = $("#sub_area").val();
						var mode = 'm_area';
				
						$("#show_province").load("gis_map/show_province/"+txt+"/"+mode);
						
				});
				
				
				

	
		
	
$('ul.tabs').each(function(){
  // For each set of tabs, we want to keep track of
  // which tab is active and it's associated content
  var $active, $content, $links = $(this).find('a');

  // If the location.hash matches one of the links, use that as the active tab.
  // If no match is found, use the first link as the initial active tab.
  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
  $active.addClass('active');
  $content = $($active.attr('href'));

  // Hide the remaining content
  $links.not($active).each(function () {
    $($(this).attr('href')).hide();
  });

  // Bind the click event handler
  $(this).on('click', 'a', function(e){
    // Make the old tab inactive.
    $active.removeClass('active');
    $content.hide();

    // Update the variables with the new link and content
    $active = $(this);
    $content = $($(this).attr('href'));

    // Make the tab active.
    $active.addClass('active');
    $content.show();

    // Prevent the anchor's default click action
    e.preventDefault();
  });
});

  $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'ความเสี่ยงของการถูกกัด คือ ประวัติฉีดวัคซีน 1 เข็ม'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'อัตราการสัมผัสโรค ของแต่ละภาค',
            data: [

				
				
			<?php 
			
				foreach ($tbSumS_pie->result_array() as $row)
				{
					
						$sector_percent = $row['rate_ppe'];
						$sector_name = $row['sector_name'];
						
						if(number_format($sector_percent,0) > 80 )
						{
							$color = "#F70707";
						}
						elseif(number_format($sector_percent,0) > 60 )
						{
							$color = "#FA6000";
						}
						elseif(number_format($sector_percent,0) > 40 )
						{
							$color = "#00FF00";
						}
						elseif(number_format($sector_percent,0) > 20 )
						{
							$color = "#FAC802";
						}
						
						
					
	
						echo "{name: '".$sector_name."',y: ".number_format($sector_percent,2).",color :'".$color."'},";
			

				}
			?>
			
            ]
        }]
    });
	
})




	
		
</script>

<style type="text/css">
#map #tab_right #tabs2 strong {
	color: #F00;
	font-weight: bold;
}
.hilight {
	color: #F00;
	font-weight: bold;
}
</style>
</head>
<body onLoad="mmmap_client_init()">
<a href="<?php echo site_url('gis_map/index'); ?>">
<div id="header"></div>
</a>
	<div id="map">
	<div class="search">
    
    <p>ภาค</p> 
    
    <?php

		$s_link1 = "gis_map/map_section/1";
		$s_link2 = "gis_map/map_section/2";
		$s_link3 = "gis_map/map_section/3";
		$s_link4 = "gis_map/map_section/0";
		
		echo "<input type='button' onClick=\"window.location='".site_url($s_link1)."'\" value='ภาคเหนือ'>";
		echo "<input type='button' onClick=\"window.location='".site_url($s_link2)."'\" value='ภาคตะวันออกเฉียงเหนือ'>";
		echo "<input type='button' onClick=\"window.location='".site_url($s_link3)."'\" value='ภาคกลาง'>";
		echo "<input type='button' onClick=\"window.location='".site_url($s_link4)."'\" value='ภาคใต้'>";
	?>
    
   <form method="get" action="gis_map/gis_search" id="frm1" name="frm1">
    
		<p>ค้นหา</p>
		<ul>
			<li><label>ปีที่สัมผัสโรค</label>			
				<select name="years" id="years" class="textbox widthselect" style="width:150px;">
					<option value="0">ทั้งหมด</option>
					<option value="2556" selected>2556</option>
					<option value="2555">2555</option>
					<option value="2554">2554</option>
					<option value="2553">2553</option>
				</select>
				</li>
                
                
              <li><label>ภาค</label>			
				<select name="section" id="section" class="textbox widthselect" style="width:150px;" >
					<option value="99" >ทั้งหมด</option>
					<option value="1">เหนือ</option>
					<option value="3">กลาง</option>
					<option value="2">ตะวันออกเฉียงเหนือ</option>
					<option value="0">ใต้</option>
				</select>
				</li>
                
			<li><label>เขตตรวจราชการ</label>
				<select name="area" id="area" class="textbox widthselect" style="width:150px;" >
					<option value="-">กรุณาเลือกเขต</option>
					<option value="1">รูปแบบเดิม (12 เขต)</option>
					<option value="2">รูปแบบใหม่ (19 เขต)</option>
				</select>
			</li>
            
            <li><label> สำนักงานควบคุมโรคที่ </label>
             
                
                <select name="sub_area" id="sub_area" class="textbox widthselect" style="width:150px;" >
					<option value="0">กรุณาเลือกสำนักงาน</option>
					<option value="1">สำนักงานป้องกันควบคุมโรคที่ 1 กรุงเทพฯ</option>
					<option value="2">สำนักงานป้องกันควบคุมโรคที่ 2 สระบุรี</option>
                    <option value="3">สำนักงานป้องกันควบคุมโรคที่ 3 ชลบุรี</option>
                    <option value="4">สำนักงานป้องกันควบคุมโรคที่ 4 ราชบุรี</option>
                    <option value="5">สำนักงานป้องกันควบคุมโรคที่ 5 นครราชสีมา</option>
                    <option value="6">สำนักงานป้องกันควบคุมโรคที่ 6 ขอนแก่น</option>
                    <option value="7">สำนักงานป้องกันควบคุมโรคที่ 7 อุบลราชธานี</option>
                    <option value="8">สำนักงานป้องกันควบคุมโรคที่ 8 นครสวรรค์</option>
                    <option value="9">สำนักงานป้องกันควบคุมโรคที่ 9 พิษณุโรค</option>
                    <option value="10">สำนักงานป้องกันควบคุมโรคที่ 10 เชียงใหม่</option>
                    <option value="11">สำนักงานป้องกันควบคุมโรคที่ 11 นครศรีธรรมราช</option>
                    <option value="12">สำนักงานป้องกันควบคุมโรคที่ 12 สงขลา</option>
				</select>
                 

			
			</li>
            
            
           <li>
             <label> วันที่สัมผัสโรค<br>
( เริ่มต้น ) </label>
             
                <div id="show_sdate" style="float:right; margin-right:50px;"> 
                <input type="text" name="sdate" class="tcal" value="<?php echo $sdate; ?>" style="width:100px;" />  
             </div>

			
		  </li>
            
           <li>
             <label>วันที่สัมผัสโรค<br>
( สิ้นสุด ) </label>
             
                <div id="show_edate" style="float:right; margin-right:50px;"> 
                 <input type="text" name="edate" class="tcal" value="<?php echo $edate; ?>" style="width:100px;" />  
             </div>

			
		  </li>
            
            
			<li><label>จังหวัด</label>
            <span id="provincelist" style="width:150px;" >
				<div id="show_province" style="float:right; margin-right:50px;">  กรุณาเลือกภาค  </div>
			</span>
			
			</li>
			<li><label>อำเภอ</label>
            <span id="amphurlist" style="width:150px;" >
              <div id="show_amphur" style="float:right; margin-right:50px;">  กรุณาเลือกจังหวัด  </div>
            </span>    
                </li>
                
			<li><label>ตำบล</label>
            <span id="districtlist" style="width:150px;" >
                <div id="show_district" style="float:right;  margin-right:50px;">  กรุณาเลือกอำเภอ  </div>
            </span>    
            </li>
                		
			<li><label>สถานที่</label>
            <span id="placelist" style="width:150px;" >
            <div id="show_place" style="float:right;  margin-right:50px;">  กรุณาเลือกตำบล  </div>
            </span>
            </li>				
			<li><label>ช่วงอายุ</label><select name="age" id="age">
				<option value="0">ทั้งหมด</option>
				<option value="1">0-20</option>
				<option value="2">21-40</option>
				<option value="3">41-60</option>
		  </select></li>
<!--			<li><label>เพศ</label><input name="sex" type="radio" value="1" checked="CHECKED">ชาย<input type="radio" value="2" name="">หญิง</li>-->
			<li><label>ชนิดสัตว์</label><select name="ani" id="ani">
				<option value="0">ทั้งหมด</option>
				<option value="1">สุนัข</option>
				<option value="2">แมว</option>
		  </select></li>
			<li><label>การฉีด rig</label><input name="rig" type="radio" value="1" checked="CHECKED">ฉีด<input type="radio" value="2" name="rig">ไม่ฉีด</li>
			<li><label>จำนวนเข็ม</label><select name="qty" id="qty">
				<option value="0">ทั้งหมด</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
                <option value="4">4</option>
		  </select></li>
		</ul>
		<ul class="box">
			<li><input name="risk" type="checkbox" value="1" checked="CHECKED" id="risk" >ระดับความเสี่ยงสูงสุด (Very high)  
            
            <div class="show_sub1"></div>
			
            </li> 
			<li><input name="risk" type="checkbox" value="2" checked="CHECKED" id="risk" >ระดับความเสี่ยงสูง (High) 
            
            <div class="show_sub2"></div>
            
            </li>
			<li><input name="risk" type="checkbox" id="risk" value="3" checked="CHECKED" >ระดับความเสี่ยงปานกลาง (Moderate)
            
            <div class="show_sub3"></div>
            
            </li>
			<li><input name="risk" type="checkbox" id="risk" value="4" checked="CHECKED" >ระดับความเสี่ยงน้อย (Low)
            
            <div class="show_sub4"></div>
            
            </li>
		</ul>
        
        <script>
	
	 	function print_data()
		{
			window.print();
		}
		
		</script>
        
		<div align="center"><input type="submit" name="search" value="ค้นหา" class="Submit" title="ปุ่มค้นหา">
			<input type="button" name="print" id="print" value="พิมพ์" class="Submit" title="ปุ่มพิมพ์" onClick="print_data();">
		</div>
        
        </form>
        
	</div>

	<div id="tab_right">
		<ul class="tabs">
		<li><a href="#tabs1">GIS</a></li>
		<li><a href="#tabs2">TABLE</a></li>
		<li><a href="#tabs3">GRAPH</a></li>
        
		</ul>
        
        แผนที่ภูมิศาสตร์สารสนเทศ (GIS)<br>
แผนที่ 1 อัตราการให้วัคซีนป้องกันโรคพิษสุนัขบ้า แยกรายภาค ปี 2556<br>
Map 1. Comparative Risk Analysis on Post Exposure Prophylaxis by Region, Thailand, 2013<br><br>

		<div id="tabs1">
			<div id="breadcrumbs"></div>	
		
        <!--<div id="mmmap_div">	</div>-->
        
        <div id="mmmap_div"></div>
		
        <div id="loading"><div id="loading-bar"></div></div>
		</div>	
		<div id="tabs2">

        
 <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="25%" align="left" valign="top" bgcolor="#99FF66"><span id="font_header">ภาค</span></td>
    <td align="left" valign="top" bgcolor="#99FF66">จำนวน (คน)<br>
(No. of PPE.)</td>
    
    <td align="left" valign="top" bgcolor="#99FF66"><span class="hilight">อัตราการรับวัคซีน<br>
    </span> (PPE.<span class="hilight"><span class="hilight">R</span></span>ate<span class="hilight">*</span>)</td>
    
    <td align="left" valign="top" bgcolor="#99FF66"><span id="font_header">จำนวนประชากร <br>
      (Population)</span></td>
    
  </tr>
  
  <?php
  
  	foreach ($tbSumS->result_array() as $row)
	{
		$sector_link = 'gis_map/map_section/'.$row['s_value'];			
  ?>
  
  <tr style="border-bottom:2px solid #FF3F3F;text-align: center"> 
    <td align="left" valign="top" bgcolor="#FFFFFF" ><a href="<?php echo site_url($sector_link); ?>"><?php echo $row['sector_name']; ?></a></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['no_ppe'],0); ?></td>
   
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['rate_ppe'],2); ?> %</td>
    
     <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['pop'],0); ?></td>
     
  </tr>
  
  
 <?php } ?>
  

</table>
        
 <br>
 
 หมายเหตุ : * อัตราการรับวัคซีนป้องกันโรคพิษสุนัขบ้า ต่อแสนประชากร
 
 <br>
 <br>
 
 <strong> Ramarks  : * Post Exposure Prophylaxis Rate (PPE.Rate) / 100,000 pop</strong><br>
 <br>       
        
        
  </div>
		<div id="tabs3">
			<div id="container"></div>
		</div>
	</div>
</div>





</body>
</html>
