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
<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php"></script>

<!-- pre-loading objects data-->
<!--include province level-->
<script src="http://mmmap15.longdo.com/search/objectcache/900.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/910.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/940.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/950.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/960.0007.js"></script>

<script src="http://mmmap15.longdo.com/search/objectcache/580.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/500.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/510.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/580.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/520.0007.js"></script>

<script src="http://mmmap15.longdo.com/search/objectcache/230.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/220.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/210.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/200.0007.js"></script>

<!--include amphoe level-->
<script src="http://mmmap15.longdo.com/search/objectcache/90__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/91__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/94__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/95__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/96__0.0007.js"></script>

<script src="http://mmmap15.longdo.com/search/objectcache/58__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/50__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/51__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/58__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/52__0.0007.js"></script>

<script src="http://mmmap15.longdo.com/search/objectcache/23__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/22__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/21__0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/20__0.0007.js"></script>

<!--include tambol level-->
<script src="http://mmmap15.longdo.com/search/objectcache/90____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/91____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/94____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/95____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/96____0.0007.js"></script>

<script src="http://mmmap15.longdo.com/search/objectcache/58____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/50____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/51____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/58____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/52____0.0007.js"></script>

<script src="http://mmmap15.longdo.com/search/objectcache/23____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/22____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/21____0.0007.js"></script>
<script src="http://mmmap15.longdo.com/search/objectcache/20____0.0007.js"></script>

<script>


var fillcolor = "#FF3F3F";
var linecolor = "#FF3F3F";

var mmmap;
var mmmapig;

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");
	window.onresize = myRepaint;
	var mode = (document.getElementById('showrastermap') && document.getElementById('showrastermap').checked) ? 'political' : 'minimal';
	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,7, mode);
  mmmap.hideScale();
  mmmap.hideModeSelector();
  mmmap.hideCenterMark();
  mmmap.setZoom(7);
	myRepaint();
	var attr = [
	 {"id" : "90", "linecolor" : "#E6FF7F", "fillcolor":"#E6FF7F", "fillopacity":"0.8", "label":"สงขลา  30%", "title":"จังหวัดสงขลา"},
	 {"id" : "91", "linecolor" : "#77EF93", "fillcolor":"#77EF93", "fillopacity":"0.8", "label":"สตูล 20%"},
	 {"id" : "94", "linecolor" : "#EF8B3B", "fillcolor":"#EF8B3B", "fillopacity":"0.8", "label":"ปัตตานี  53%"},
	 {"id" : "95", "linecolor" : "#EF593B", "fillcolor":"#EF593B", "fillopacity":"0.8", "label":"ยะลา 61%"},
	 {"id" : "96", "linecolor" : "#EF483B", "fillcolor":"#EF483B", "fillopacity":"0.8", "label":"นราธิวาส 64%"}
  ];
  if(!mmmapig) {
    mmmapig = new MMMapIG(mmmap);
  }
	//mmmapig.addObjectsAtrributes(attr);
  drawObjectSet(0);
	document.getElementById('south').checked = true;
}

var objs = new Array();


function drawObjectSet(set) {
    
  var objset = [
    ['91','90','94','95','96'],
    ['58','50','51','52'],
    ['20','21','22','23']
  ];
  
  var setid = [
    "south",
    "north",
    "east"
  ];
  
  var setname = [
    'กลุ่มจังหวัดชายแดนภาคใต้',
    'กลุ่มจังหวัดภาคเหนือตอนบน 1',
    'กลุ่มจังหวัดภาคตะวันออก'
  ];
  
  var positionset = [
    [6.65605, 100.88034],
    [18.78516, 98.94847],
    [12.94563, 101.86823]
  ];
  
  
  
  var initzoom = [4,4,4];
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
      "linewidth" : 4,
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
        "breadcrumbbullet" : "&nbsp;&nbsp;<img src='images/bullet-active.png'>&nbsp;&nbsp;",
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
  	 {"id" : "90", "linecolor" : "#E6FF7F", "fillcolor":"#E6FF7F", "fillopacity":"0.8", "label":"สงขลา  30%", "title":"จังหวัดสงขลา"},
  	 {"id" : "91", "linecolor" : "#77EF93", "fillcolor":"#77EF93", "fillopacity":"0.8", "label":"สตูล 20%"},
  	 {"id" : "94", "linecolor" : "#EF8B3B", "fillcolor":"#EF8B3B", "fillopacity":"0.8", "label":"ปัตตานี  53%"},
  	 {"id" : "95", "linecolor" : "#EF593B", "fillcolor":"#EF593B", "fillopacity":"0.8", "label":"ยะลา 61%"},
  	 {"id" : "96", "linecolor" : "#EF483B", "fillcolor":"#EF483B", "fillopacity":"0.8", "label":"นราธิวาส 64%"}
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

	mmmap.setSize(newwidth,newheight);
	mmmap.rePaint();

}

$(document).ready(function(){
	
	
/*				$('#province').change(function() {
					
					
						var pid = $("#province").val();
						
						//alert("<?php echo base_url(); ?>application/modules/map/views/show_amphur.php?pid="+pid);
						
						$("#show_amphur").load("<?php echo base_url(); ?>application/modules/map/views/show_amphur.php?pid="+pid);		
								
					
				});
				
				$('#amphur').change(function() {
					
						var pid = $("#province").val();
						var aid = $("#amphur").val();
						$("#show_dis").load("<?php echo base_url(); ?>application/modules/map/views/show_dis.php?pid="+pid+"&aid="+aid);		
								
					
				});*/
				
	
	
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
                {name: 'เหนือ',y: <?php echo number_format($section1,2); ?>,color :'#F70707'},     
                {name: 'ตะวันออกเฉียงเหนือ',y: <?php echo number_format($section2,2); ?>,color :'#FA6000'},
                {name: 'กลาง',y: <?php echo number_format($section3,2); ?>,color :'#00FF00'},
                {name: 'ใต้',y: <?php echo number_format($section4,2); ?>,color :'#FAC802'} 
            ]
        }]
    });
	
})

</script>

</head>
<body onLoad="mmmap_client_init()" style="overflow:hidden;margin: 0px 0px 0px 5px;" marginwidth=0 marginheight=0>
<div id="header"></div>
	<div id="map">
	<div class="search">
    
    
   <form method="get" action="">
    
		<p>ค้นหา</p>
		<ul>
			<li><label>ปีที่สัมผัสโรค</label>			
				<select name="years" id="years" class="textbox widthselect">
					<option value="0">ทั้งหมด</option>
					<option value="2556" selected>2556</option>
					<option value="2555">2555</option>
					<option value="2554">2554</option>
					<option value="2553">2553</option>
				</select>
				</li>
                
                
              <li><label>ภาค</label>			
				<select name="section" id="section" class="textbox widthselect" >
					<option value="0" >ทั้งหมด</option>
					<option value="1">เหนือ</option>
					<option value="2">กลาง</option>
					<option value="3">ตะวันออกเฉียงเหนือ</option>
					<option value="4">ใต้</option>
				</select>
				</li>
                
			<li><label>เขตตรวจราชการ</label>
				<select name="area" id="area" class="textbox widthselect">
					<option value="-">กรุณาเลือกเขต</option>
					<option value="1">รูปแบบเดิม (12 เขต)</option>
					<option value="2">รูปแบบใหม่ (19 เขต)</option>
				</select>
			</li>
			<li><label>จังหวัด</label><span id="provincelist">
				<select name="province" id="province" class="textbox widthselect">
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
            
               
                
                    <select name="amphur" id="amphur" class="textbox widthselect">
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
            
           
            
            <select name="district" id="district" class="textbox widthselect">
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
                		
			<li><label>สถานที่</label><span id="hospitallist"><select name="hospital" class="textbox widthselect">
				<option value="">ทั้งหมด</option>
				<option value="">โรงพยาบาลไก่เส้า</option>
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
			<li><input type="checkbox" name="" value="1" ><span class="red"></span>ระดับความเสี่ยงสูงสุด (Very high)  
            
            <div class="show_sub1"></div>
			
            </li> 
			<li><input type="checkbox" name="" value="2" ><span class="orange"></span>ระดับความเสี่ยงสูง (High) 
            
            <div class="show_sub2"></div>
            
            </li>
			<li><input type="checkbox" name="" value="3" ><span class="yellow"></span>ระดับความเสี่ยงปานกลาง (Moderate)
            
            <div class="show_sub3"></div>
            
            </li>
			<li><input type="checkbox" name="" value="4" ><span class="green"></span>ระดับความเสี่ยงน้อย (Low)
            
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
		<div id="tabs1">
			<div id="breadcrumbs"></div>	
		
        <!--<div id="mmmap_div">	</div>-->
        
        <div id="mmmap_div"></div>
		
        <div id="loading"><div id="loading-bar"></div></div>
		</div>	
		<div id="tabs2">
<!--		<table class="tbreport">
		<tr>
			<th rowspan="2">จังหวัด</th>
			<th colspan="5" style="text-align:center;">การแบ่งระดับความเสี่ยงของพื้นที่</th>
		</tr>
		<tr>
		  <td style="border-bottom:2px solid #FF3F3F;text-align: center">สูงสุด <br/>(Very high)</td>
		  <td style="border-bottom:2px solid #FC8105;text-align: center">สูง <br/>(High)</td>
		  <td style="border-bottom:2px solid #FCE005;text-align: center">ปานกลาง<br/> (Moderate)</td>
		  <td style="border-bottom:2px solid #00FF00;text-align: center">ต่ำ <br/>(Low)</td>
		</tr>
		<tr>
			<th>เชียงใหม่</th>
			<td><p>อ.แม่แตง (150)</p>
					 <p>อ.สารภี (200)</p>
					 <p>อ.แม่แตง (260)</p>
					  <p>อ.ไชปราการ (300)</p>
					    <p>อ.หางดง(151)</p>
					      <p>อ.สารภี (161)</p>
			</td>
			<td><p>อ.จอมทอง (140)</p>
					<p>อ.ดอยสะเก็ด (110)</p>
			</td>
			<td><p>อ.สะเมิง (50)</p>
					<p>อ.แม่แจ่ม (51)</p>
					<p>อ.ฮอด (52)</p>
					<p>อ.ดอยเต่า (56)</p>
			</td>
			<td><p>อ.พร้าว (5)</p>
				<p>อ.ฝาก (10)</p>
				<p>อ.แม่อาย (5)</p>
			</td>
		</tr>
		<tr class="total">
			<th>รวม</th>
			<td>1,500</td>
			<td>250</td>
			<td>201</td>
			<td>20</td>
		</tr>
		</table>-->
        
 <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="4" align="left" valign="top" bgcolor="#3399FF"><span id="font_header">ความเสี่ยงของการถูกกัด  คือ ประวัติฉีดวัคซีน 1 เข็ม</span></td>
  </tr>
  <tr>
    <td width="25%" align="left" valign="top" bgcolor="#3399FF"><span id="font_header">ปี 2556</span></td>
    <td align="left" valign="top" bgcolor="#3399FF">&nbsp;</td>
    <td align="left" valign="top" bgcolor="#3399FF">&nbsp;</td>
    <td align="left" valign="top" bgcolor="#3399FF">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">ภาค</span></td>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">จำนวนประชากรเข้ารับการรักษา</span></td>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">จำนวนประชากรรวมแต่ละภาค</span></td>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header"> อัตราการให้วัคซีนป้องกันโรคพิษสุนัขบ้า  แยกรายภาค ปี 2556 (Comparative Risk Analysis on Post Exposure Prophylaxis by Region, Thailand, 2013)</span></td>
  </tr>
  <tr style="border-bottom:2px solid #FF3F3F;text-align: center"> 
    <td align="left" valign="top" bgcolor="#FFFFFF" ><a href="<?php echo site_url('map/map_section/1'); ?>">เหนือ</a></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($tbInfor_count_n,0); ?> คน</td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($noth1,0); ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($section1,2); ?> %</td>
  </tr>
  <tr style="border-bottom:2px solid #FF3F3F;text-align: center">
    <td align="left" valign="top" bgcolor="#FFFFFF"><a href="<?php echo site_url('map/map_section/2'); ?>">ตะวันออกเฉียงเหนือ</a></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($tbInfor_count_en,0); ?> คน</td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($noth_eath1,0); ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($section2,2); ?> %</td>
  </tr>
  <tr style="border-bottom:2px solid #FF3F3F;text-align: center">
    <td align="left" valign="top" bgcolor="#FFFFFF"><a href="<?php echo site_url('map/map_section/3'); ?>">กลาง</a></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($tbInfor_count_m,0); ?> คน</td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($middle,0); ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($section3,2); ?> %</td>
  </tr>
  <tr style="border-bottom:2px solid #FF3F3F;text-align: center">
    <td align="left" valign="top" bgcolor="#FFFFFF"><a href="<?php echo site_url('map/map_section/0'); ?>">ใต้</a></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($tbInfor_count_s,0); ?> คน</td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($south,0); ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($section4,2); ?> %</td>
  </tr>
</table>
        
        
        
        
		</div>
		<div id="tabs3">
			<div id="container"></div>
		</div>
	</div>
</div>





</body>
</html>
