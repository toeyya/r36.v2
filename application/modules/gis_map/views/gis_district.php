<!doctype html>
<html lang="en">
<head>
<base href="<?php echo base_url(); ?>" />
<title><?php echo $template['title']; ?></title>
<?php echo $template['metadata']; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<!--<meta http-equiv="Content-Type" content="text/html; charset=tis-620">-->

<meta http-equiv="imagetoolbar" content="no">

<link rel="stylesheet" href="themes/map/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="themes/map/media/css/set_map.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="themes/map/media/js/jquery-1.4.2.min.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="themes/map/media/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="themes/map/media/js/jquery-ui1.10.3.js"></script>
<script type="text/javascript" src="themes/map/media/js/highcharts.js"></script>

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php?key=7a19bf7e66f74a0b39843f76eaf11371"></script>
<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/js/mmmapig.js"></script>


<script>
var mmmap;
var objectlayers = {};
var currentlayer;
var showallamphoe = false;
var showtambol = false;
var showtambolfromzoom ;
var showonetambol = false;
var showonetambolfromzoom;
var tambolinamphoe;
var clicked = false;

var fillcolor = "#FF3F3F";
var linecolor = "#FF3F3F";
var clicklock = false;

var amphoearray = [];

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");
	window.onresize = myRepaint;
	mmmap = new MMMap(mmmap_div,18.85431,98.80005,7, 'political');
  mmmap.hideScale();
  mmmap.hideModeSelector();
  mmmap.hideCenterMark();
  mmmap.setZoom(7);
	myRepaint();
  drawObjectSet(0);
  
  
  
  	// เชียงใหม่ เริ่มแรก id = 50
     mmmapig.hideObjects('id', nowshowing);
	 mmmapig.showObjects('id', '50');
	 mmmapig.moveTo('id', '50');
	 nowshowing = "50";
  
}

var objs = new Array();
var mmmapig;
var nowshowing = '';

function drawObjectSet(set) {



  var group_id = [
    "mymap",
  ];
  var objset = [
    [
    '58',
      '5803',
        '580302', //เวียงเหนือ
        '580307', //โป่งสา
      '5807',
        '580704', //นาปู่ป้อม
        '580701', //สบป่อง
      '5805',
    '50',
      '5004',
        '500404', //แม่นะ
        '500402', //เมืองนะ
      '5003',
    '51',
      '5107',
      '5104',
      '5105',
    '52',
      '5205',
      '5204',
        '520403' //เสริมซ้าย
    ]
  ];
  
  var setname = [
    'mygroup'
  ];
  
  var positionset = [
    [18.78516, 98.94847],
  ];
  

  mmmapig = new MMMapIG(mmmap);
  
    var object = {
      "groupid" : group_id[set],
      "mmmap" : mmmap,
      "id" : objset[set],
      "ds" : "IG",
      "simplify" : 0.0008,
      "center" : positionset[set],
      "linewidth" : 4,
      "linecolor" : linecolor,
      "fillcolor" : fillcolor,
      "lineopacity" : 0.7,
      "fillopacity" : 0.1,
      "hidden" : true,
      "showlabel" : true,
      "zoom" : 8,
      "minzoom" : 1,
      "maxzoom" : 20,
      "handler" : {
        "onload" : function() {
          //do somethings when first time load
        },
        "onclick" : function() {
          this.lineobject.setFillColor("#2F8EFF");
          this.lineobject.rePaint();
          var igdesc = mmmapig.getIGDesc(this.IG);
          var objdata = eval('('+igdesc+')');
          alert(this.lineobject.attributes.title+'\n\n'+igdesc+"\n\nThis object is in '"+objdata.province.desc+"' of group '"+objdata.groupid+"'.");
        },
        "ondraw" : function() {
          //do somethings every time before object render
          loading(true);
        },
        "ondrawsuccess" : function() {
          //do somethings every time after object render
          loading(false);
        },
        "onmouseover" : function() {
          //do somethings when mouse is over
          //alert("Mouse is over on "+this.lineobject.attributes.title);
          this.lineobject.setFillColor("#000000");
          this.lineobject.rePaint();
        },
        "onmouseout" : function() {
          //do somethings when mouse is out
          //alert("Mouse is out off  "+this.lineobject.attributes.title);
          this.lineobject.setFillColor("#ffffff");
          this.lineobject.rePaint();
        }
      }
    }
    mmmap.moveTo(positionset[set][0], positionset[set][1]);
    
    
    var objgroup = new MMMapIGGroup(object)
    mmmapig.addObjectGroup(objgroup);
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

	var newwidth = parseInt(ww) - 255 - 5;
	var newheight = parseInt(wh) - 5 - 5;
	
	document.getElementById('loading-bar').style.top =    newheight/2 - 50 + 'px';
	document.getElementById('loading-bar').style.left = newwidth/2 - 40 + 245 +'px';
	document.getElementById('loading-bar').style.visibility = 'visible';

	mmmap.setSize(860,1600);
	mmmap.rePaint();

}


$(document).ready(function(){
	
	
	
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
            name: 'อัตราการสัมผัสโรค ของแต่ละจังหวัด',
            data: [
            
			<?php 
			
				foreach ($S_province_pie->result_array() as $row)
				{
					
						
						if(number_format($row['rate_ppe'],0) > 80 )
						{
							$color = "#F70707";
						}
						elseif(number_format($row['rate_ppe'],0) > 60 )
						{
							$color = "#FA6000";
						}
						elseif(number_format($row['rate_ppe'],0) > 40 )
						{
							$color = "#00FF00";
						}
						elseif(number_format($row['rate_ppe'],0) > 20 )
						{
							$color = "#FAC802";
						}
						
						$province_name = $row['name'];
					
	
						echo "{name: '".$province_name."',y: ".number_format($row['rate_ppe'],2).",color :'".$color."'},";
			

				}
			?>
			
            ]
        }]
    });
	
})

</script>
	
</head>
<body onLoad="mmmap_client_init()">

<a href="<?php echo site_url('gis_map/index'); ?>"><div id="header"></div></a>

	<div id="map">
	<div class="search">
    
<p>จังหวัด</p>  

<div style="font-size:14px;">

<?php
/*echo "<ul>";
foreach ($S_province->result_array() as $row)
{

	echo "<li>";
	echo "<input type=\"button\" onClick=\"mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '".$row['s_value']."'); mmmapig.moveTo('id', '".$row['s_value']."'); nowshowing = ".$row['s_value'].";\" value=\"".$row['name']."\">";*/
	
	

	echo "<ul>";

	
	$tbAmphur = $this->db->query("SELECT * FROM n_district where amphur_id=".$pro_id);
 	foreach ($tbAmphur->result_array() as $row2)
	{
		echo "<li>";
		$amp_id = $row2['province_id'].$row2['amphur_id'].$row2['district_id'];
		$amp_name = $row2['district_name'];
		
		echo "<img src=\"themes/map/media/images/number_back_01.gif\">
	<input type=\"button\" onClick=\"mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '".$amp_id."'); mmmapig.moveTo('id', '".$amp_id."'); nowshowing = ".$amp_id.";\" value=\"".$amp_name."\">";
		
		echo "</li>";
	}
	
	echo "</ul>";
	
/*	echo "</li>";	
	
}
echo "</ul>";*/

?>


<!--
<ul>
  <li>
  
  <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '58'); mmmapig.moveTo('id', '58'); nowshowing = 58;" value="แม่ฮ่องสอน">
  
  <ul>
    <li>
    
     <img src="themes/map/media/images/number_back_01.gif"><input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5803'); mmmapig.moveTo('id', '5803'); nowshowing = 5803;" value="อ.ปาย">
    
    <ul>
      <li>
       <img src="themes/map/media/images/number_back_02.jpg" style="margin-left:15px;"><input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '580302'); mmmapig.moveTo('id', '580302'); nowshowing = 580302;" value="ต.เวียงเหนือ">
      </li>
      <li>
       <img src="themes/map/media/images/number_back_02.jpg" style="margin-left:15px;"><input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '580307'); mmmapig.moveTo('id', '580307'); nowshowing = 580307;" value="ต.โป่งสา">
      </li>
    </ul>
    
    </li>
    
    <li>
    
   <img src="themes/map/media/images/number_back_01.gif"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5807'); mmmapig.moveTo('id', '5807'); nowshowing = 5807;" value="อ.ปางมะผ้า">
    
    <ul>
      <li>
        <img src="themes/map/media/images/number_back_02.jpg" style="margin-left:15px;"><input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '580704'); mmmapig.moveTo('id', '580704'); nowshowing = 580704;" value="ต.นาปู่ป้อม">
       </li>
      <li>
       <img src="themes/map/media/images/number_back_02.jpg" style="margin-left:15px;"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '580701'); mmmapig.moveTo('id', '580701'); nowshowing = 580701;" value="ต.สบป่อง">
      </li>
    </ul>
    </li>
    <li>
    <img src="themes/map/media/images/number_back_01.gif"><input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5805'); mmmapig.moveTo('id', '5805'); nowshowing = 5805;" value="อ.แม่ลาน้อย">
    </li>
  </ul>
  </li>
</ul>
<ul>
  <li>
  <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '50'); mmmapig.moveTo('id', '50'); nowshowing = 50;" value="เชียงใหม่">
  <ul>
    <li>
    <img src="themes/map/media/images/number_back_01.gif"><input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5004'); mmmapig.moveTo('id', '5004'); nowshowing = 5004;" value="อ.เชียงดาว">
    <ul>
      <li>
      <img src="themes/map/media/images/number_back_02.jpg" style="margin-left:15px;"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '500404'); mmmapig.moveTo('id', '500404'); nowshowing = 500404;" value="ต.แม่นะ">
      </li>
      <li>
      <img src="themes/map/media/images/number_back_02.jpg" style="margin-left:15px;"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '500402'); mmmapig.moveTo('id', '500402'); nowshowing = 500402;" value="ต.เมืองนะ">
      </li>
    </ul>  
    </li>
    <li>
   <img src="themes/map/media/images/number_back_01.gif"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5003'); mmmapig.moveTo('id', '5003'); nowshowing = 5003;" value="อ.แม่แจ่ม">
    </li>
  </ul>
  </li>
</ul>
<ul>
  <li>
  
  <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '51'); mmmapig.moveTo('id', '51'); nowshowing = 51;" value="ลำพูน">
  
  <ul>
    <li>
  <img src="themes/map/media/images/number_back_01.gif">  <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5107'); mmmapig.moveTo('id', '5107'); nowshowing = 5107;" value="อ.บ้านธิ">
    </li>
    <li>
   <img src="themes/map/media/images/number_back_01.gif"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5104'); mmmapig.moveTo('id', '5104'); nowshowing = 5104;" value="อ.ลี้">
    </li>
    <li>
   <img src="themes/map/media/images/number_back_01.gif"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5105'); mmmapig.moveTo('id', '5105'); nowshowing = 5105;" value="อ.ทุ่งหัวช้าง">
    </li>
  </ul>
  </li>
</ul>
<ul>
  <li>
  <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '52'); mmmapig.moveTo('id', '52'); nowshowing = 52;" value="ลำปาง">
  <ul>
    <li>
    <img src="themes/map/media/images/number_back_01.gif"><input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5205'); mmmapig.moveTo('id', '5205'); nowshowing = 5205;" value="อ.งาว">
    </li>
    <li>
   <img src="themes/map/media/images/number_back_01.gif"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5204'); mmmapig.moveTo('id', '5204'); nowshowing = 5204;" value="อ.เสริมงาม">
    <ul>
      <li>
      <img src="themes/map/media/images/number_back_02.jpg" style="margin-left:15px;"> <input type="button" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '520403'); mmmapig.moveTo('id', '520403'); nowshowing = 520403;" value="ต.เสริมซ้าย">
      </li>
    </ul>
    </li>
  </ul>
  </li>
</ul>
-->
</div>

    
    
   <form method="get" action="">
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
					<option value="2" <?php if($map_id == "2"){echo "selected";} ?>>กลาง</option>
					<option value="3" <?php if($map_id == "3"){echo "selected";} ?>>ตะวันออกเฉียงเหนือ</option>
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
			<li><label>จังหวัด</label><span id="provincelist">
				<select name="province" id="province" class="textbox widthselect" style="width:150px;">
					<option value="0">ทั้งหมด</option>
                    
                    
                    <?php
						
						
						foreach ($tbProvince->result() as $row)
						{
							echo "<option value='".$row->province_id."'>".$row->province_name."</option>";
						}
			
					
					?>				
					
					</select>
				</span>
			
			</li>
			<li><label>อำเภอ</label>
            
            <span id="amphurlist">
            
               
                
                    <select name="amphur" id="amphur" class="textbox widthselect" style="width:150px;">
                        <option value="0">ทั้งหมด</option>					
                        <?php
                            
                            
                            foreach ($tbAmp->result() as $row)
                            {
                                echo "<option value='".$row->amphur_id."'>".$row->amphur_name."</option>";
                            }
                
                        
                        ?>
                    </select>
                
              
                
            </span>
                
                </li>
			<li><label>ตำบล</label>
            
            <span id="districtlist">
            
           
            
            <select name="district" id="district" class="textbox widthselect" style="width:150px;">
				<option value="0">ทั้งหมด</option>
                    <?php
						
						
						foreach ($tbDis->result() as $row)
						{
							echo "<option value='".$row->district_id."'>".$row->district_name."</option>";
						}
			
					
					?>
				</select>
            
           
                
                </span>
                
                </li>
                		
			<li><label>สถานที่</label><span id="hospitallist"><select name="hospital" class="textbox widthselect" style="width:150px;">
				<option value="0">ทั้งหมด</option>
                    <?php
						
						
						foreach ($tbHos->result() as $row)
						{
							echo "<option value='".$row->hospital_code."'>".$row->hospital_name."</option>";
						}
			
					
					?>
				</select>
				</span></li>				
			<li><label>ช่วงอายุ</label><select name="area">
				<option value="">ทั้งหมด</option>
				<option value="">0-20</option>
				<option value="">21-40</option>
				<option value="">41-60</option>
				</select></li>
			<li><label>เพศ</label><input type="radio" value="1" name="">ชาย<input type="radio" value="2" name="">หญิง</li>
			<li><label>ชนิดสัตว์</label><select name="area">
				<option value="">ทั้งหมด</option>
				<option value="">สุนัข</option>
				<option value="">แมว</option>
				</select></li>
			<li><label>การฉีด rig</label><input type="radio" value="1" name="">ฉีด<input type="radio" value="2" name="">ไม่ฉีด</li>
			<li><label>จำนวนเข็ม</label><select name="area">
				<option value="">ทั้งหมด</option>
				<option value="">1</option>
				<option value="">2</option>
				<option value="">3</option>
				</select></li>
		</ul>
		<ul class="box">
			<li><input type="checkbox" name="" value="1" >ระดับความเสี่ยงสูงสุด (Very high)  
            
            <div class="show_sub1"></div>
			
            </li> 
			<li><input type="checkbox" name="" value="2" >ระดับความเสี่ยงสูง (High) 
            
            <div class="show_sub2"></div>
            
            </li>
			<li><input type="checkbox" name="" value="3" >ระดับความเสี่ยงปานกลาง (Moderate)
            
            <div class="show_sub3"></div>
            
            </li>
			<li><input type="checkbox" name="" value="4" >ระดับความเสี่ยงน้อย (Low)
            
            <div class="show_sub4"></div>
            
            </li>
		</ul>
		<div align="center"><input type="submit" name="search" value="ค้นหา" class="Submit" title="ปุ่มค้นหา">
			<input type="submit" name="print" value="พิมพ์" class="Submit" title="ปุ่มพิมพ์">
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
    <td width="25%" align="left" valign="top" bgcolor="#3399FF"><span id="font_header">จังหวัด (province) </span></td>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">จำนวนผู้รับการฉีดวัคซีน (No. of PPE)</span></td>
   
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">อัตราการให้วัคซีนป้องกันโรคพิษสุนัขบ้า / 100,000 ปชก (PPE.Rate per 100,000 pop.)</span></td>
    
     <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">จำนวนประชากร (Population)</span></td>
  </tr>
  
<?php 


foreach ($S_province->result_array() as $row)
{
	
		$province_link = 'gis_map/map_province/'.$map_id.'/'.$row['s_value'];	
 ?>

  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><a href="<?php echo site_url($province_link); ?>"><?php echo $row['name']; ?></a> </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['no_ppe'],0); ?> คน</td>
    
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['rate_ppe'],2); ?> %</td>
    
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['pop'],0); ?> คน </td>
    
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
