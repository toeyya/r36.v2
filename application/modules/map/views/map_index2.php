<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo base_url(); ?>" />
<title><?php echo $template['title']; ?></title>
<?php echo $template['metadata']; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<link rel="stylesheet" href="themes/map/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="media/js/jquery-1.6.4.min.js"></script>
 <link rel="stylesheet" href="media/css/tabs.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php?key=7a19bf7e66f74a0b39843f76eaf11371"></script>

<script id="mmmap_init_includeobject_script"> 
var MMMapData = new Object(); MMMapData.IG = new Array() </script>

<script type="text/javascript">
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
	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,7, 'politicalwhite');
  //mmmap.initVector();
  //mmmap.hideScale();
  //mmmap.hideModeSelector();
  mmmap.hideCenterMark();
  //mmmap.moveTo(18.79613, 99.43143);
   mmmap.showObject('ชลบุรี', "ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // Chon Buri, with line and fill colors
   mmmap.showObject('ระยอง', "ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); 
   mmmap.showObject('เพชรบุรี',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); 
   mmmap.showObject('ราชบุรี',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); 
   
   mmmap.showObject('สกลนคร', "ADM", true, null, null, "FCE005", "FCE005", 0.7, 0.5); 
   mmmap.showObject('บึงกาฬ',"ADM", true, null, null, "FCE005", "FCE005", 0.7, 0.5); 
   mmmap.showObject('อุดรธานี',"ADM", true, null, null, "FCE005", "FCE005", 0.7, 0.5); 
   
  /* mmmap.showObject('5010;5011;5009', "IG", false, null, null, "00FF00", "00FF00", 0.7, 0.5); 
   mmmap.showObject('5001;5003;5008;5016;5017', "IG", false, null, null, "FCE005", "FCE005", 0.7, 0.5);//เหลือง
   mmmap.showObject('5005;5004;5002', "IG", true, null, null, "FA6000", "FA6000", 0.7, 0.5); //ส้ม
   mmmap.showObject('5006;5007;5013;5014;5015;5018;5019;5020;5021', "IG", false, null, null, "FF3F3F", "FF3F3F", 0.7, 0.5); //แดง
   mmmap.showObject('500501;500401;500201', "IG", false, null, null, "FF3F3F", "FF3F3F", 0.7, 0.5); //แดง
   */
  var object = {
    "mmmap" : mmmap,
    "id" : '50',
    "ds" : "IG",
    "simplify" : 0.01,
    "linewidth" : 4,
    "clearcache" : true,
    "linecolor" : linecolor,
    "fillcolor" : fillcolor,
    //"lineopacity" : 0.7,
    //"fillopacity" : 0.1,
    "zoom" : 7,
    "minzoom" : 1,
    "maxzoom" : 7,
    "showlabel" : true,
    "handler" : {
      "onclick" : function(e) {
        document.getElementById('loading').style.display = 'block';
        document.getElementById('loading').style.zIndex = '9999';
        mmmap.disableMouseWheel();
        var position = getPosition();
        var newlat = position.latitude;
        var newlon = position.longitude;
        mmmap.moveTo(newlat, newlon);
        mmmap.setZoom(mmmap.getZoom()+1);
        
      },
      "onload" : function() {
        var title = this.getAttribute('title');
        var id = this.getAttribute('id');
        setBreadcrumbs('add', id, title, null, function(){mmmap.setZoom(7)});
        document.getElementById('loading').style.display = 'none';
        document.getElementById('loading').style.zIndex = '-9999';
        mmmap.enableMouseWheel();
      },
      "ondraw" : function() {
        document.getElementById('loading').style.display = 'block';
        document.getElementById('loading').style.zIndex = '9999';
        mmmap.disableMouseWheel();
      },
      "ondrawsuccess" : function() {
        document.getElementById('loading').style.display = 'none';
        document.getElementById('loading').style.zIndex = '-9999';
        mmmap.enableMouseWheel();
      }
    }
  }
	/*mmmap.showObject(myid,ds,showdefaulttitle,forcetitle,forcemode,linecolor,fillcolor,linetransp,filltransp);
		Note that by using this API to display too many data, the client browser might become less responsive.  */
   drawObjectSet(0);
  currentlayer = objectlayers.province = mmmap.showObject2(object);
  mmmap.setResolutionChangedHandler(checkZoom)  
  myRepaint();
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
      "linewidth" : 0,
      "linecolor" : linecolor,
      "fillcolor" : fillcolor,
      "lineopacity" : 0.7,
      "fillopacity" : 0.1,
      "hidden" : true,
      "showlabel" : false,
      "zoom" : 7,
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


function checkZoom() {
  var zoom = mmmap.getZoom();
  if(zoom > 7) {
    if(!objectlayers.amphoe) {
      mmmap.disableMouseWheel();
      document.getElementById('loading').style.display = 'block';
      document.getElementById('loading').style.zIndex = '9999';
      showallamphoe = true;
      var object = {
        "mmmap" : mmmap,
        "id" : '50__',
        "ds" : "IG",
        "simplify" : 0.001,
        "linewidth" : 0,
        "linecolor" : linecolor,
        "fillcolor" : fillcolor,
        //"lineopacity" : 0.7,
        "fillopacity" : 0.1,
        "minzoom" : (8),
        "maxzoom" : 20,
        "handler" : {
          "onclick" : function(e) {
            document.getElementById('loading').style.display = 'block';
            document.getElementById('loading').style.zIndex = '9999';
            mmmap.disableMouseWheel();
            clicked = true;
            if(mmmap.getZoom() == 8) {
              showtambolfromzoom = 9;
              setBreadcrumbs('add',this.getAttribute('id'), this.getAttribute('title'), "amphoe", function(){mmmap.setZoom(showtambolfromzoom+1)});
              var lat = mmmap.mouseCursorLat();
              var lon = mmmap.mouseCursorLong();
              var position = getPosition(lat, lon);
              var newlat = position.latitude;
              var newlon = position.longitude;
              mmmap.moveTo(newlat, newlon);
              mmmap.setZoom(10)
              
            }
            else {
              showtambolfromzoom = mmmap.getZoom();
              setBreadcrumbs('add',this.getAttribute('id'), this.getAttribute('title'), "amphoe", function(){mmmap.setZoom(showtambolfromzoom+1)});
              var position = getPosition();
              var newlat = position.latitude;
              var newlon = position.longitude;
              mmmap.moveTo(newlat, newlon);
              mmmap.setZoom(mmmap.getZoom()+1);
            }
            currentlayer.hideGSObjects();
            if(!objectlayers.tambol) objectlayers.tambol = [];
            var object = {
              "mmmap" : mmmap,
              "id" : this.IG+'__',
              "ds" : "IG",
              "simplify" : 0.001,
              "linewidth" : 0,
              //"linecolor" : linecolor,
              "fillcolor" : fillcolor,
             //"lineopacity" : 0.7,
              "fillopacity" : 0.1,
              "minzoom" : 10,
              "maxzoom" : 20,
              "handler" : {
                "onclick" : function(e) {
                    document.getElementById('loading').style.display = 'block';
                    document.getElementById('loading').style.zIndex = '9999';
                    mmmap.disableMouseWheel();
                    clicked = true;
                    showonetambolfromzoom = mmmap.getZoom();
                    setBreadcrumbs('add', this.getAttribute('id'), this.getAttribute('title'), "tambol", function(){mmmap.setZoom(showonetambolfromzoom+1)});
                    var position = getPosition();
                    var newlat = position.latitude;
                    var newlon = position.longitude;
                    mmmap.moveTo(newlat, newlon);
                    mmmap.setZoom(mmmap.getZoom()+1);
                    tambolinamphoe = currentlayer;
                    currentlayer.hideGSObjects();
                    var object = {
                      "mmmap" : mmmap,
                      "id" : this.IG,
                      "ds" : "IG",
                      "simplify" : 0.008,
                      "linewidth" : 0,
                      "linecolor" : linecolor,
                      "fillcolor" : fillcolor,
                      //"lineopacity" : 0.7,
                      "fillopacity" : 0.1,
                      "minzoom" : 11,
                      "maxzoom" : 20,
                      "handler" : {
                        "onclick" : function() {
                          var position = getPosition();
                          var newlat = position.latitude;
                          var newlon = position.longitude;
                          mmmap.moveTo(newlat, newlon);
                          mmmap.setZoom(mmmap.getZoom()+1);   
                        },
                        "onload" : function() {
                          document.getElementById('loading').style.display = 'none';
                          document.getElementById('loading').style.zIndex = '-9999';
                          mmmap.enableMouseWheel();
                        } 
                      }
                    }
                    if(!objectlayers.tambol[this.IG]) {
                      currentlayer = objectlayers.tambol[this.IG] = mmmap.showObject2(object);
                    }
                    else {
                      objectlayers.tambol[this.IG].showGSObjects();
                      currentlayer = objectlayers.tambol[this.IG];
                      document.getElementById('loading').style.display = 'none';
                      document.getElementById('loading').style.zIndex = '-9999';
                      mmmap.enableMouseWheel();
                    }
                    showonetambol = true;
                  },
                  "onload" : function() {
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('loading').style.zIndex = '-9999';
                    mmmap.enableMouseWheel();
                  },
                  "ondraw" : function() {
                    document.getElementById('loading').style.display = 'block';
                    document.getElementById('loading').style.zIndex = '9999';
                    mmmap.disableMouseWheel();
                  },
                  "ondrawsuccess" : function() {
                    document.getElementById('loading').style.display = 'none';
                    mmmap.enableMouseWheel();
                  }
              }
            }
            if(!objectlayers.tambol) objectlayers.tambol = [];
            if(!objectlayers.tambol[this.IG]) {
              currentlayer = objectlayers.tambol[this.IG] = mmmap.showObject2(object);
              amphoearray.push(objectlayers.tambol[this.IG]);
            }
            else {
              objectlayers.tambol[this.IG].showGSObjects();
              currentlayer = objectlayers.tambol[this.IG];
              document.getElementById('loading').style.display = 'none';
              document.getElementById('loading').style.zIndex = '-9999';
              mmmap.enableMouseWheel();
            }
            showtambol = true;
          },
          "onload" : function() {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('loading').style.zIndex = '-9999';
            mmmap.enableMouseWheel();
          },
          "ondraw" : function() {
            document.getElementById('loading').style.display = 'block';
            document.getElementById('loading').style.zIndex = '9999';
            mmmap.disableMouseWheel();
          },
          "ondrawsuccess" : function() {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('loading').style.zIndex = '-9999';
            mmmap.enableMouseWheel();
          }
        }
      }
    mmmap.showObject('5010;5011;5009', "IG", false, null, null, "00FF00", "00FF00"); 
   mmmap.showObject('5001;5003;5008;5016;5017', "IG", false, null, null, "FCE005", "FCE005");//เหลือง
   mmmap.showObject('5005;5004;5002', "IG", true, null, null, "FA6000", "FA6000"); //ส้ม
   mmmap.showObject('5006;5007;5013;5014;5015;5018;5019;5020;5021', "IG", false, null, null, "FF3F3F", "FF3F3F"); //แดง
   mmmap.showObject('500501;500401;500201', "IG", false, null, null, "FF3F3F", "FF3F3F"); //แดง
      currentlayer = objectlayers.amphoe = mmmap.showObject2(object);
    }
    else {
      if(!clicked) {
        if(mmmap.getZoom() == showtambolfromzoom || mmmap.getZoom() < showtambolfromzoom) {
          showtambol = false;
          currentlayer.hideGSObjects();
          showallamphoe = false;
        }
        if(mmmap.getZoom() == showonetambolfromzoom || mmmap.getZoom() < showonetambolfromzoom) {
          showonetambol = false;
          currentlayer.hideGSObjects();
          setBreadcrumbs('delete', null, null, 'tambol');
        }
        if(!showtambol && !showonetambol) {
          showtambol = false;
          currentlayer.hideGSObjects();
          objectlayers.amphoe.showGSObjects();
          currentlayer = objectlayers.amphoe;
          if(!showallamphoe) setBreadcrumbs('delete', null, null, 'amphoe');
        } 
        else if(!showonetambol){
          showonetambol = false;
          if(tambolinamphoe) {
            currentlayer.hideGSObjects();
            tambolinamphoe.showGSObjects();        
            currentlayer = tambolinamphoe;
          }
        }
        if(mmmap.getZoom() == 9) {
          currentlayer.hideGSObjects();
          objectlayers.amphoe.showGSObjects();
          currentlayer = objectlayers.amphoe;
          if(!showallamphoe) setBreadcrumbs('delete', null, null, 'amphoe');
        }
        document.getElementById('loading').style.display = 'none';
        document.getElementById('loading').style.zIndex = '-9999';
      }
      else {
        clicked = false;
      }
    }
  }
  else {
      if(!clicked) {
        if(mmmap.getZoom() == showtambolfromzoom || mmmap.getZoom() < showtambolfromzoom) {
          showtambol = false;
          currentlayer.hideGSObjects();
          clicklock = false;
          showallamphoe = false;
        }
        if(mmmap.getZoom() == showonetambolfromzoom || mmmap.getZoom() < showonetambolfromzoom) {
          showonetambol = false;
          currentlayer.hideGSObjects();
          clicklock = false;
          setBreadcrumbs('delete', null, null, 'tambol');
        }
        if(!showtambol && !showonetambol) {
          showtambol = false;
          currentlayer.hideGSObjects();
          if(objectlayers.ampho) objectlayers.amphoe.showGSObjects();
          currentlayer = objectlayers.amphoe;
          if(!showallamphoe) setBreadcrumbs('delete', null, null, 'amphoe');
        } 
        else if(!showonetambol){
          showonetambol = false;
          if(tambolinamphoe) {
            tambolinamphoe.showGSObjects();        
            currentlayer = tambolinamphoe; 
          }
        }
      }
      else {
        clicked = false;
      }
    currentlayer = objectlayers.province;
   
    currentlayer.showGSObjects();
    setBreadcrumbs('delete', null, null, 'amphoe');
  }
  //if(document.getElementById('showlabel').checked) currentlayer.showGSLabel();
}

function switchLabel(show) {
  if(!currentlayer) return;
  if(show) currentlayer.showGSLabel();
  else currentlayer.hideGSLabel();
}
var bc = {
  "amphoe" : "",
  "tambol" : ""
};
function setBreadcrumbs(cmd, sid, name, level, fn) {
  var bc = document.getElementById('breadcrumbs');
  if(cmd == 'add') {
    var span = document.createElement('span');
    span.id = 'MM-Breadcrumbs-Label-'+sid;
    span.style.fontSize = '11px'
    if(fn) {
      span.onclick = fn;
      span.style.cursor = 'pointer';
    }
    span.innerHTML += ' >> <a href="#">'+name+'</a>';
    span.style.marginLeft = '5px';
    bc.appendChild(span);
    switch(level) {
      case 'amphoe' : bc.amphoe = span.id; break;
      case 'tambol' : bc.tambol = span.id; break;
    }
  }
  else {
    var delid;
    switch(level) {
      case 'amphoe' : delid = bc.amphoe; break;
      case 'tambol' : delid = bc.tambol; break;
    }
    var span = document.getElementById(delid);
    if(span && span!=null) bc.removeChild(span);
    
  }
}

function myRepaint() {
	chkWinSize();

	var newwidth = parseInt(ww) - 5 - 5;
	var newheight = parseInt(wh) - 100 - 5;
	var newwidth =860;
	var newheight =1400;
	document.getElementById('loading-bar').style.top =    newheight/2 - 50 + 'px';
	document.getElementById('loading-bar').style.left = newwidth/2 - 40 + 'px';
	document.getElementById('loading-bar').style.visibility = 'visible';

	mmmap.setSize(newwidth,newheight);
	mmmap.rePaint();

}

function showRasterMap(show) {
  if(show) mmmap.setMapMode('political');
  else mmmap.setMapMode('minimal');
}

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
	mmmap_client_init();
	$( "#tabs-gis" ).tabs();
	$('select[name=province]').change(function(){
		var id=$('select[name=province] option:selected').val();
		 mmmap.removeAllVectors();
		  mmmapig.hideObjects('id', nowshowing); 
		  mmmapig.showObjects('id', id); 
		  mmmapig.moveTo('id', id); 
		  nowshowing = id;
		 
	})
})

</script>

</head>
<body>
<div id="header"></div>
	<div id="map">
	<div class="search">
		<p>ค้นหา</p>
		<ul>
			<li><label>ปีที่สัมผัสโรค</label>			
				<select name="years" id="years" class="textbox widthselect">
					<option value="">ทั้งหมด</option>
					<option value="">2556</option>
					<option value="">2555</option>
					<option value="">2554</option>
					<option value="">2553</option>
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
				<select name="province" class="textbox widthselect">
					<option value="">ทั้งหมด</option>
					<option value="50">เชียงใหม่</option>
					<option value="58">แม่ฮ่องสอน</option>					
					
					</select>
				</span>
			
			</li>
			<li><label>อำเภอ</label><span id="amphurlist">
				<select name="amphur" class="textbox widthselect">
					<option value="">ทั้งหมด</option>					
					<option value="เชียงดาว">เชียงดาว</option>
					<option value="แม่แจ่ม">แม่แจ่ม</option>
				</select>
				</span></li>
			<li><label>ตำบล</label><span id="districtlist"><select name="district" class="textbox widthselect">
				<option value="">ทั้งหมด</option>
				<option value="แม่งะ">แม่งะ</option>
				<option value="แม่งอน">แม่งอน</option>
				</select></span></li>		
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
			<li><input type="checkbox" name="" value="1" checked="checked"><span class="red"></span>จำนวนผู้สัมผัสโรคระหว่าง 150-200</li>
			<li><input type="checkbox" name="" value="2" checked="checked"><span class="orange"></span>จำนวนผู้สัมผัสโรคระหว่าง 100-149</li>
			<li><input type="checkbox" name="" value="3" checked="checked"><span class="yellow"></span>จำนวนผู้สัมผัสโรคระหว่าง 50-99</li>
			<li><input type="checkbox" name="" value="4" checked="checked"><span class="green"></span>จำนวนผู้สัมผัสโรคระหว่าง 0-49</li>
		</ul>
		<div align="center"><input type="submit" name="search" value="ค้นหา" class="Submit" title="ปุ่มค้นหา"></div>
	</div>
<div id="breadcrumbs"></div>	
<div id="tabs-gis">
<ul>
<li><a href="#tabs-1">GIS</a></li>
<li><a href="#tabs-2">TABLE</a></li>
<li><a href="#tabs-3">REPORT</a></li>
</ul>
<div id="tabs-1">
<div id="mmmap_div">	</div>
<div id="loading"><div id="loading-bar"></div></div>
</div>	

<div id="tabs-2"></div>
<div id="tabs-3"></div>
</div>


</div>

</div> 
</body>
</html>
