<?php error_reporting(0); ?>

<!doctype html>
<html lang="en">
<head>
<base href="<?php echo base_url(); ?>" />
<title><?php echo $template['title']; ?></title>
<?php echo $template['metadata']; ?>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

<link rel="stylesheet" href="themes/map/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="themes/map/media/css/set_map.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="themes/map/media/js/jquery-1.4.2.min.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="themes/map/media/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="themes/map/media/js/jquery-ui1.10.3.js"></script>
<script type="text/javascript" src="themes/map/media/js/highcharts.js"></script>
<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php?key=7a19bf7e66f74a0b39843f76eaf11371"></script>

<script type="text/javascript">

var fillcolor = "#FF3F3F";
var linecolor = "#FF3F3F";

// แดง F00
// ส้ม F60
//เขียว 0F0
// เหลือง FF0


            //ตัวแปรเพื่อใช้อ้างอิงไปยัง map object
            var mmmap;
			var mmmapig;

            //function initialize สำหรับสร้าง map object
            function initialize(){
                var mmMapDiv = document.getElementById("mmMapDiv");
                mmmap = new MMMap(mmMapDiv, <?php echo $li; ?>,<?php echo $lo; ?>, 13, "political");

                //ปรับขนาดของแผนที่ให้กว้าง 600 px และสูง 600 px ด้วย method setSize ของ map object
                mmmap.setSize(860,800);
                //เปลี่ยนจุดศูนย์กลางของแผนที่มายังจุดเริ่มต้น
                //mmmap.moveTo(13.71804,100.57022);
				 mmmap.moveTo(<?php echo $li; ?>,<?php echo $lo; ?>);
                //ปรับระดับการ zoom ของแผนที่เป็นค่าเริ่มต้น
                mmmap.setZoom(13);
                //ทำการแสดงผลแผนที่ใหม่ เพื่อปรับปรุงการแสดงผลของแผนที่ให้ถูกต้อง
                //mmmap.rePaint();
				
				myRepaint();


				  if(!mmmapig) {
					mmmapig = new MMMapIG(mmmap);
				  }
  
				  //drawObjectSet(0);
				
				  //mmmap.showObject(myid,ds,showdefaulttitle,forcetitle,forcemode,linecolor,fillcolor,linetransp,filltransp);
				  
				  //mmmap.showObject('77__', 'IG', true, null, null,'0000FF', '0000FF', 0.7, 0.5);
				  //แสดงทุกอำเภอของจังหวัดประจวบคีรีขันธ์ ด้วยสีขอบ, สีภายใน, ความโปร่งแสงสีขอบ, ความโปร่งแสงสีภายใน ตามที่กำหนด
				  
				  //mmmap.showObject('ต.ศรีดอนมูล', 'ADM');
				  //แสดงตามชื่อ
				  
				  //mmmap.showObject('5_', 'IG', true, null, null, 'FF0000');
				  //แสดงทุกจังหวัดที่รหัส Geocode ขึ้นต้นด้วย 5 ด้วยสีแดง และให้แสดงชื่อจังหวัดด้วย

				
				
				mmmap.showObject('<?php echo $s_value; ?>', 'IG', true, null, null,'<?php echo $risk_color; ?>', '<?php echo $risk_color; ?>', 0.7, 0.5);
					//แสดงตาม code ด้วยสีขอบ, สีภายใน, ความโปร่งแสงสีขอบ, ความโปร่งแสงสีภายใน ตามที่กำหนด


               // var userDivIdB = createUserDivImage(13.86937, 100.65601,"themes/map/media/images/hospital.png","Ms B's house, number 60");
   

                //var userDivIdC = createUserDivImage(13.7699, 100.6145,"themes/map/media/images/hospital.png","Mr C's house, number 99");
				
				//var markerIdA = mmmap.createMarker(13.75509,100.53177,"<img src='themes/map/media/images/hospital.png'>","Mr A's house","Mr A's house, number 48");
				
				//mmmap.showPopUp(13.75509,100.53177,"<img src='themes/map/media/images/hospital.png'>","Mr A's house", "Mr A's house, number 48");
				
/*				var popup_params0 = {
					"link" : "http://www.r36.ddc.moph.go.th",
					"width" : 300, height: 200,
					"fixpopupsize" : true,
				};
				
				var content0 = "<img src='themes/map/media/images/hospital.png'><br>คลิกที่รูปภาพเพื่อแสดงรายละเอียดของสถานพยาบาล";
				mmmap.showPopUp(14.80816,100.63515, 'ข้อแนะนำ', content0, popup_params0);*/
				
				
				
				
				
				
				var popup_params = {
					"link" : "http://www.r36.ddc.moph.go.th",
					"width" : 250, height: 200,
					"fixpopupsize" : true,
				};
				
				var la = mmmap.centerLat();
				var lo = mmmap.centerLong();
				
				

			 //alert(la+"_"+lo);
				
			<?php 
			
				//foreach ($tbHos_map->result_array() as $row00)
				//{
				
				//		$h_name = $row00['hospital_name'];
				//		$h_code = $row00['hospital_code'];
				
			?>
			
/*				var content<?php echo $h_code; ?> = "<img src='themes/map/media/images/hospital.png'><br><?php echo "รหัสสถานพยาบาล :".$h_code; ?><br><?php echo "ชื่อสถานพยาบาล :".$h_name; ?>";
								// create div data
				var testdiv<?php echo $h_code; ?> = document.createElement('div')
				testdiv<?php echo $h_code; ?>.style.border = '1px solid red';
				testdiv<?php echo $h_code; ?>.innerHTML = "<img src='themes/map/media/images/hospital.png'>";
				testdiv<?php echo $h_code; ?>.onclick = show_place<?php echo $h_code; ?>;
				testdiv<?php echo $h_code; ?>.latitude = la;
				testdiv<?php echo $h_code; ?>.longitude = lo;
				
				var customdiv_id<?php echo $h_code; ?> = mmmap.drawCustomDiv(testdiv<?php echo $h_code; ?>, la,lo, '<?php echo $h_name; ?>');
				
				function show_place<?php echo $h_code; ?>(){
					mmmap.showPopUp(la,lo, '<?php echo $h_name; ?>', content<?php echo $h_code; ?>, popup_params);
				}*/
				
			<?php //} ?>	
				
				
				mmmap.showOOITag('hospital');
				
				//mmmap.showOOITagWithShowLevel('education',3,0,11,0);
				
				
				
/*				var content2 = "<img src='themes/map/media/images/hospital.png'><br>zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz";
				//mmmap.showPopUp(13.75509, 100.53177, 'โรงพยาบาลบางแค', content, popup_params);
				
				var testdiv2 = document.createElement('div')
				testdiv2.style.border = '1px solid red';
				testdiv2.innerHTML = "<img src='themes/map/media/images/hospital.png'>";
				testdiv2.onclick = testclick2;
				testdiv2.latitude = 14.80812;
				testdiv2.longitude = 100.64485;
				
				var customdiv_id = mmmap.drawCustomDiv(testdiv2, 14.80812,100.64485, 'Hospital001');
				

				function testclick2(){
					mmmap.showPopUp(14.80812,100.64485, 'โรงพยาบาลพุทธมณฑน', content2, popup_params);
				}
				*/
				


            }
 
			 var objs = new Array();
			
			
			function drawObjectSet(set) {
			
			
			
			  var area = [
			  
  			<?php 
			
				foreach ($S_district_js->result_array() as $row)
				{
				
						$dist_name = $row['name'];
						$dist_code = $row['id_province'].$row['id_amphur'].$row['id_district'];
						$dist_color = $row['risk_color'];

						
			    		echo "[['".$dist_name."'],['".$dist_code."'],['".$dist_color."']],";

				}
			?>
			
				
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
					  "showlabel" : true,
						"ignorefragment" : true,
					  "minzoom" : 1,
					  "maxzoom" : 20,
					  "handler" : {
						"ondraw" : function()
						{

							},
						"ondrawsuccess" : function()
						{
							},
						"onload" : function() 
						
						{
							

							
							},
						"onmouseover" : function() {},
						"onmouseout" : function() {} 
					  }
					}
					
					var objgroup = new MMMapIGGroup(object);
					mmmapig.addObjectGroup(objgroup);
					

				  }
				} /// end draw object
				 
        
				function myRepaint() {
					//chkWinSize();
				
					var newwidth = parseInt(ww) - 5 - 5;
					var newheight = parseInt(wh) - 100 - 5;
				  
				  document.getElementById('loading-bar').style.top =    newheight/2 - 50 + 'px';
					document.getElementById('loading-bar').style.left = newwidth/2 - 40 + 'px';
					document.getElementById('loading-bar').style.visibility = 'visible';
				
					mmmap.setSize(860,newheight);
					mmmap.rePaint();
					
						 
				
				}/// end repaint


			function getPosition(lat, lon) {
			  var l = (lat) ? lat : mmmap.mouseCursorLat();
			  var lg = (lon) ? lon : mmmap.mouseCursorLong();
				newlat = (l + parseFloat(mmmap.centerLat())) / 2;
				newlong = (lg + parseFloat(mmmap.centerLong())) / 2;
				if(lat && lon) {
				 newlat = (lat+newlat)/2;
				 newlong = (lon+newlong)/2
			  }
				return {"latitude" : newlat, "longitude" : newlong}
			}


$(document).ready(function(){
	
	
				    $('#section').change(function() {
					
					
			    var txt = $("#section").val();
				
						$("#show_province").load("gis_map/show_province/"+txt);
						
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
            name: 'อัตราการสัมผัสโรค ของตำบล',
            data: [
            
						<?php 
			
				foreach ($S_district_pie->result_array() as $row)
				{
					
					
						
						$dist_name = $row['name'];
					
	
						echo "{name: '".$dist_name."',y: ".$row['no_ppe'].",color :'".$row['risk_color']."'},";
			

				}
			?>
			
            ]
        }]
    });
	
})


	function chkSubmit()
	{
		 /*if(isNaN(document.frmMain.txtNumber.value))
		 {
			alert('Please input Number only.');
			return false;
		 }
		 */
/*		 if(document.frm1.section.value=='99')
		 {
			alert('กรุณาเลือกภาค');
			return false;
		 }
		 
		 if(document.frm1.province.value=='0')
		 {
			alert('กรุณาเลือกจังหวัด');
			return false;
		 }
		 
		 if(document.frm1.amphur.value=='0')
		 {
			alert('กรุณาเลือกอำเภอ');
			return false;
		 }
		 
		 if(document.frm1.district.value=='0')
		 {
			alert('กรุณาเลือกตำบล');
			return false;
		 }*/
		
		 
	}

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
<body onLoad="initialize()">

<a href="<?php echo site_url('gis_map/index'); ?>"><div id="header"></div></a>

	<div id="map">
	<div class="search">
    
    <?php
		$sector_link = 'gis_map/index';	
		$province_link = 'gis_map/map_section/'.$map_id;	
		$amphur_link = 'gis_map/map_province/'.$map_id.'/'.$pro_id.'/'.$amp_id;
		$dis_link = 'gis_map/map_place/'.$map_id.'/'.$pro_id.'/'.$amp_id.'/'.$dis_id;
		
	?>
    
<div style="display:block; width:95%; border:1; border-style:solid; border-color:#F00; padding:5px 5px 5px 5px; margin-top:10px; margin-bottom:10px; background-color:#FFD7D7; text-align:center; font-weight:bold; font-size:16px; color:#F00;">

 > <a href="<?php echo site_url($sector_link); ?>" target="_self">ภาค</a> > <a href="<?php echo site_url($province_link); ?>" target="_self">จังหวัด</a> > <a href="<?php echo site_url($amphur_link); ?>" target="_self">อำเภอ</a> > <a href="<?php echo site_url($dis_link); ?>" target="_self">ตำบล</a>

</div>  

<p>ตำบล</p>  

<?php

 	foreach ($S_district_list->result_array() as $row2)
	{

		$dis_id = $row2['id_province'].$row2['id_amphur'].$row2['id_district'];
		$dis_name = $row2['name'];
		$province_link = "gis_map/map_place/".$map_id."/".$row2['id_province']."/".$row2['id_amphur']."/".$row2['id_district']."";
		
		echo "<input type='button' onClick=\"window.location='".site_url($province_link)."'\" value='".$dis_name."'>";
	
		
		
	}
	

?>

  
    
   <form method="get" action="gis_map/gis_search" OnSubmit="return chkSubmit();" id="frm1" name="frm1">
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
					<option value="1" <?php if($map_id == "1"){echo "selected";} ?>>เหนือ</option>
					<option value="3" <?php if($map_id == "3"){echo "selected";} ?>>กลาง</option>
					<option value="2" <?php if($map_id == "2"){echo "selected";} ?>>ตะวันออกเฉียงเหนือ</option>
					<option value="0" <?php if($map_id == "0"){echo "selected";} ?>>ใต้</option>
				</select>
				</li>
                
			<li><label>เขตตรวจราชการ</label>
				<select name="area" id="area" class="textbox widthselect" style="width:150px;">
					<option value="-">กรุณาเลือกเขต</option>
					<option value="1">รูปแบบเดิม (12 เขต)</option>
					<option value="2">รูปแบบใหม่ (19 เขต)</option>
				</select>
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
			<li><label>เพศ</label><input name="sex" type="radio" value="1" checked="CHECKED">ชาย<input type="radio" value="2" name="">หญิง</li>
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
แผนที่ 3 อัตราการให้วัคซีนป้องกันโรคพิษสุนัขบ้า แยกรายภาค ปี 2556<br>
Map 3. Comparative Risk Analysis on Post Exposure Prophylaxis by Region, Thailand, 2013<br><br>

		<div id="tabs1">

			<div id="breadcrumbs"></div>	
		        
            <div id="mmMapDiv"></div>
		
            <div id="loading">
                <div id="loading-bar"></div>
            </div>
            
		</div>	
		
        
        <div id="tabs2">
			
        <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="25%" align="left" valign="top" bgcolor="#99FF66"><span id="font_header">ตำบล (district) </span></td>
    <td align="left" valign="top" bgcolor="#99FF66">จำนวน (คน) <br>
      (No. of PPE.)</td>
     </tr>
  
<?php 

	//$tbAmphur_list = $this->db->query("SELECT * FROM n_amphur where province_id=".$pro_id);
	
 	foreach ($S_district_data->result_array() as $row2)
	{
		
		$dis_id = $row2['id_province'].$row2['id_amphur'].$row2['id_district'];
		$dis_name = $row2['name'];
		
		$province_link = 'gis_map/map_place/'.$row2['id_province'].'/'.$row2['id_province']."/".$row2['id_district'];	
 ?>

  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><!--<a href="<?php echo site_url($province_link); ?>">--><?php echo $dis_name; ?><!--</a>--> </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $row2['no_ppe']; ?></td>
  </tr>

<?php } ?>


</table>
        
		</div>
		
        <div id="tabs3">
		
        	<div id="container"></div>
		
        
        
        </div>
	</div>
</div>



</body>
</html>
