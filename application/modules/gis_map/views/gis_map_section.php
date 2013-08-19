<?php error_reporting(0); ?>
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

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php"></script>


<script>


var fillcolor = "#FF3F3F";
var linecolor = "#FF3F3F";

var mmmap;
var mmmapig;

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");
	window.onresize = myRepaint;
	//var mode = (document.getElementById('showrastermap') && document.getElementById('showrastermap').checked) ? 'political' : 'minimal';
	
	var mode = (document.getElementById('showrastermap') && document.getElementById('showrastermap').checked) ? 'political' : 'political';
	
	mmmap = new MMMap(mmmap_div,8.02457,100.9314,8, mode);
  mmmap.hideScale();
  mmmap.hideModeSelector();
  mmmap.hideCenterMark();
  mmmap.setZoom(8);
	myRepaint();



  if(!mmmapig) {
    mmmapig = new MMMapIG(mmmap);
  }
	//mmmapig.addObjectsAtrributes(attr);
	
  drawObjectSet(<?php echo $map_id; ?>);
	//document.getElementById('south').checked = true;
}

var objs = new Array();


function drawObjectSet(set) {
    
  var objset = [
    ['81','86','92','80','96','94','82','93','83','95','85','90','91','84'],
    ['50','51','52','53','54','55','56','57','58'],
    ['37','31','36','46','40','42','44','48','49','30','39','43','45','47','32','33','34','35','41'],
	['10','62','18','26','73','60','12','13','14','66','65','67','16','11','75','74','17','19','72','64','15','61']
  ];
  
  var setid = [
    "south",
    "north",
    "west_east",
	"middle"
  ];
  
  var setname = [
    'ภาคใต้',
    'ภาคเหนือ',
    'ภาคตะวันออกเฉียงเหนือ',
	'ภาคกลาง'
  ];
  
  var positionset = [
    [6.65605, 100.88034],
    [18.78516, 98.94847],
    [16.48876, 102.59033],
	[13.41099, 94.74609]
  ];
  
  
  
  var initzoom = [4,4,4,4];
  mmmapig.hideCurrentObjectGroup();
  if(mmmapig.getCurrentObjectGroup()) mmmapig.clearCache();
  if(!objs[set]) {
    var object = {
      "mmmap" : mmmap,
      "mmmapig" : mmmapig,
      "groupid" : setid[set],
      //"autocenter" : true,
      "id" : objset[set],
      "ds" : "IG",
      "simplify" : 0.0007,
      "clearcache" : true, // enable this if you want to use fresh data
      "center" : positionset[set],
      "linewidth" : 2,
      "linecolor" : linecolor,
      "fillcolor" : fillcolor,
      "lineopacity" : 0.7,
      "fillopacity" : 0.1,
      "showlabel" : true,
      "zoom" : initzoom[set],
      "autocenter" : true,
      "minzoom" : 1,
      "maxzoom" : 20,
      "drilldown" : true,
      //"ignorefeagment" : true,
      "drilldownconfig" : {
        "initbreadcrumb" : setname[set],
        "breadcrumbdiv" : "breadcrumbs",
        "breadcrumbbullet" : "&nbsp;&nbsp;<img src='themes/map/media/images/number_back_01.gif'>&nbsp;&nbsp;",
        "breadcrumbhandler" : {
          "provincegroup" : function(){
            //alert('provincegroup breadcrumb clicked : '+this.IG);
          },
          "province" : function(){
            //alert('province breadcrumb clicked : '+this.IG);
          },
          "amphoe" : function(){
            //alert('amphoe breadcrumb clicked : '+this.IG);
          },
          "tambol" : function(){
            //alert('tambol breadcrumb clicked : '+this.IG);
          }
        },
        "showlabellevel" : {
          "province" : [7,20],
          "amphoe" : [8,20],
          "tambol" : [10,20]
        },
        "defaultzoomlevel" : {
          "provincegroup" : 7,
          "province" : 7,
          "amphoe" : 10,
          "tambol" : 11        },
        "handler" : {
          "ondraw" : function(){loading(true)},
          "ondrawsuccess" : function(){loading(false);},
          "onclick" : function() {
            loading(true);
            //mmmapig.updateObject(this.IG, 'fillcolor', '#000000'); 
            //alert('Show detail for object ID: '+this.IG)
          },
          "onload" : function() {}
        },
        "minlevel" : "amphoe"
      } 
    }
    
    //mmmap.moveTo(positionset[set][0], positionset[set][1]);
    //mmmap.setZoom(initzoom[set]);
    
    var objgroup = new MMMapIGGroup(object);
    mmmapig.addObjectGroup(objgroup);
    
    var attr = [
	
	
	  
    			<?php 
			
				foreach ($S_province_js->result_array() as $row)
				{
				
						$p_name = $row['name'];
						$p_code = $row['s_value'];
						$p_percent = $row['rate_ppe'];
						
						
						if(number_format($p_percent,0) > 80 )
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
						else
						{
							$color = "#FAC802";
						}
						
						
						echo "{'id' : '".$p_code."', 'linecolor' : '#E6FF7F', 'fillcolor':'".$color."', 'fillopacity':'0.8', 'label':'".$p_name."  ".$p_percent."%', 'title':'".$p_name."'},";

				}
			?>
			
	 //{"id" : "90", "linecolor" : "#E6FF7F", "fillcolor":"#FAC802", "fillopacity":"0.8", "label":"ชุมพร  30%", "title":"จังหวัดสงขลา"},
	 //{"id" : "91", "linecolor" : "#77EF93", "fillcolor":"#F70707", "fillopacity":"0.8", "label":"กระบี่ 20%"}
	   
	 
    ];
    setTimeout(function(){mmmapig.updateObjectsAttributes(attr);},3000); // update after 3 seconds
    

    objs[set] = mmmapig.getCurrentObjectGroup();
    
  }
  else {
    mmmapig.clearCache();
    mmmapig.setCurrentObjectGroup(objs[set]);
    mmmapig.moveTo("groupid", setid[set]);
    mmmapig.showCurrentObjectGroup();
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
						else
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


	function chkSubmit()
	{

		
		 
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
<body onLoad="mmmap_client_init()">
<a href="<?php echo site_url('gis_map/index'); ?>">
<div id="header"></div>
</a>
	<div id="map">
	<div class="search">
    
    
   <form method="get" action="gis_map/gis_search" OnSubmit="return chkSubmit();" id="frm1" name="frm1">
    
       <?php
		$sector_link = 'gis_map/index';	
	?>
    
<div style="display:block; width:95%; border:1; border-style:solid; border-color:#F00; padding:5px 5px 5px 5px; margin-top:10px; margin-bottom:10px; background-color:#FFD7D7; text-align:center; font-weight:bold; font-size:16px; color:#F00;">

 > <a href="<?php echo site_url($sector_link); ?>" target="_self">ภาค</a>

</div>   
    
    <p>จังหวัด</p>  



<?php
//echo "<ul>";
foreach ($S_province->result_array() as $row)
{

	//echo "<li>";
	$province_link = 'gis_map/map_province/'.$map_id.'/'.$row['s_value'];	
?>

 <input type="button" title="<?php echo $row['name']; ?>" value="<?php echo $row['name']; ?>" onClick="window.location='<?php echo site_url($province_link); ?>'" />

<?php
	
	
	//echo "</li>";	
	
}
//echo "</ul>";

?>


    
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
					<option value="0" >ทั้งหมด</option>
					<option value="1" <?php if($map_id == "1"){echo "selected";} ?>>เหนือ</option>
					<option value="3" <?php if($map_id == "2"){echo "selected";} ?>>กลาง</option>
					<option value="2" <?php if($map_id == "3"){echo "selected";} ?>>ตะวันออกเฉียงเหนือ</option>
					<option value="0" <?php if($map_id == "0"){echo "selected";} ?>>ใต้</option>
				</select>
				</li>
                
			<li><label>เขตตรวจราชการ</label>
				<select name="area" id="area" class="textbox widthselect">
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
แผนที่ 2 อัตราการให้วัคซีนป้องกันโรคพิษสุนัขบ้า แยกรายจังหวัด ปี 2556<br>
Map  2.     Comparative Risk Analysis on Post Exposure Prophylaxis by Province, Thailand, 2013<br><br>


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
    
    <td align="left" valign="top" bgcolor="#99FF66"><span id="font_header">จำนวนประชากร<br>
(Population)</span></td>
    
  </tr>
<?php 


foreach ($S_province->result_array() as $row)
{
	
		$province_link = 'gis_map/map_province/'.$map_id.'/'.$row['s_value'];	
 ?>

  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><a href="<?php echo site_url($province_link); ?>"><?php echo $row['name']; ?></a> </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['no_ppe'],0); ?></td>
    
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['rate_ppe'],2); ?> %</td>
    
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['pop'],0); ?></td>
    
  </tr>

<?php } ?>


</table>
        
  <br>
  หมายเหตุ : * อัตราการรับวัคซีนป้องกันโรคพิษสุนัขบ้า ต่อแสนประชากร <br>
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
