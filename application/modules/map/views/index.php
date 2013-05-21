<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo base_url(); ?>" />
<title><?php echo $template['title']; ?></title>
<?php echo $template['metadata']; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<link rel="stylesheet" href="themes/map/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php"></script>
<script id="mmmap_init_includeobject_script"> 
var MMMapData = new Object(); MMMapData.IG = new Array() </script>
<script type="text/javascript">
var mmmap;
var mmmapig;
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
function mmmap_client_init(){		
	var mmmap_div = document.getElementById("mmmap_div");
	window.onresize = myRepaint;
	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,7, 'minimal');
	mmmap.initVector();
	mmmap.hideScale();
	mmmap.hideModeSelector();
	mmmap.hideCenterMark();
	mmmap.setZoom(7);
	myRepaint();
  
  mmmap.setResolutionChangedHandler(function(){
    if(mmmap.getZoom() > 8) {
      mmmap.setMapMode("political");
    }
    else {
      mmmap.setMapMode("minimal");
    }
  });
 if(!mmmapig) {
    mmmapig = new MMMapIG(mmmap);
  } 
  
  drawObjectSet(0);
	
}// initial
var objs = new Array();
function drawObjectSet(set) {
var area = [
[
['Head office'],
['10','11'],
['#EEA755'],
['#000000']
],
[
['Khet1'],
['12','13','14','15','16','17','18','19'],
['#DF1BBF'],
['#000000']
],
[
['Khet2'],
['20','21','22','23','24','25','26','27'],
['#959CEF'],
['#000000']
],
[
['Khet3'],
['30','31','32','33','34','35','36','37'],
['#BEE0E1'],
['#000000']
],
[
['Khet4'],
['40','41','42','43','44','45','46','47','48','49','01','39'],
['#F6E4A2'],
['#000000']
],
[
['Khet5'],
['50','51','52','53','54','55','56','57','58'],
['#ABC78D'],
['#000000']
],
[
['Khet6'],
['60','61','62','63','64','65','66','67'],
['#75AF36'],
['#000000']
],
[
['Khet7'],
['70','71','72','73','74','75','76','77'],
['#D7A2CE'],
['#000000']
],
[
['Khet8'],
['80','81','82','83','84','85','86'],
['#A2DBA6'],
['#000000']
],
[
['Khet9'],
['90','91','92','93','94','95','96'],
['#57AF5D'],
['#000000']
]
]
for(var i=0; i<area.length; i++) {
mmmapig.hideCurrentObjectGroup();
if(mmmapig.getCurrentObjectGroup()) mmmapig.clearCache();
var object_combine = {
"combine" : true,
"mmmap" : mmmap,
"mmmapig" : mmmapig,
"groupid" : area[i][0],
"id" : area[i][1],
"ds" : "IG",
"simplify" : 0.0007,
"clearcache" : false, // enable this if you want to use fresh data
"linewidth" : 7,
"linecolor" : area[i][3].toString(),
"fillcolor" : area[i][2].toString(),
"lineopacity" : 0.7,
"fillopacity" : 0.0000001,
"showlabel" : false,
"ignorefragment" : true,
"minzoom" : 1,
"maxzoom" : 20,
"handler" : {
"ondraw" : function(){loading(true)},
"ondrawsuccess" : function(){loading(false)},
"onload" : function() {},
"onmouseover" : function() {},
"onmouseout" : function() {}
}
}
var objcombinegroup = new MMMapIGGroup(object_combine);
mmmapig.addObjectGroup(objcombinegroup);
var object = {
"combine" : false,
"mmmap" : mmmap,
"mmmapig" : mmmapig,
"groupid" : area[i][0],
"id" : area[i][1],
"ds" : "IG",
"simplify" : 0.0007,
"clearcache" : false, // enable this if you want to use fresh data
"linewidth" : 1,
"linecolor" : area[i][3].toString(),
"fillcolor" : area[i][2].toString(),
"lineopacity" : 0.7,
"fillopacity" : 0.5,
"showlabel" : true,
"ignorefragment" : true,
"minzoom" : 1,
"maxzoom" : 20,
"labelstart" : 7,
"labelstop" : 8,
"handler" : {
"ondraw" : function(){loading(true)},
"ondrawsuccess" : function(){loading(false)},
"onclick" : function() {
alert('Show detail for object ID: '+this.IG)
},
"onload" : function() {}
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
				//"showdefaulttitle" : document.getElementById('showlabel').checked,
				"linewidth" : 4,
				"linecolor" : linecolor,
				"fillcolor" : fillcolor,
				"lineopacity" : 0.7,
				"fillopacity" : 0.1,
				"minzoom" : (8),
				"maxzoom" : 20,
				"handler" : {
				"onclick" : function(e){
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
					}else {
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
				"showdefaulttitle" : document.getElementById('showlabel').checked,
				"linewidth" : 4,
				"linecolor" : linecolor,
				"fillcolor" : fillcolor,
				"lineopacity" : 0.7,
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
							"simplify" : 0.001,
							//"showdefaulttitle" : document.getElementById('showlabel').checked,
							"linewidth" : 4,
							"linecolor" : linecolor,
							"fillcolor" : fillcolor,
							"lineopacity" : 0.7,
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
						}//object
						if(!objectlayers.tambol[this.IG]) {
							currentlayer = objectlayers.tambol[this.IG] = mmmap.showObject2(object);
						}else {
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
			}// handlers
			}//object
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
		}// handler
		}// object topper
		currentlayer = objectlayers.amphoe = mmmap.showObject2(object);
	}else {
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
			wonetambol = false;
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
	}// else !objectlayers.amphoe
}else {// zoom=7
	if(!clicked){
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
	}else{
		clicked = false;
	}// !clicked
	currentlayer = objectlayers.province;
	currentlayer.showGSObjects();
	setBreadcrumbs('delete', null, null, 'amphoe');
}// zoom=7
	if(document.getElementById('showlabel').checked) currentlayer.showGSLabel();
}//function checkZoom
function switchLabel(show) {
	if(!currentlayer) return;
	if(show) currentlayer.showGSLabel();
	else currentlayer.hideGSLabel();
}
var bc = {"amphoe" : "","tambol" : ""};

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
	}else {
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
	//var newwidth ="860";
	//var newheight = "1400";	
	document.getElementById('loading-bar').style.top = newheight/2 - 50 + 'px';
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
</script>
    </head>
    <body onLoad="mmmap_client_init()">
    	<div id="header"></div>
        <div id="mmmap_div"></div>
        <!--<div id="loading-bar"><div id="loading"></div></div>-->		
    </body>
</html>