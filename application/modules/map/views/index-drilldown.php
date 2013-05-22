
<html>
<head>
<title>Longdo Map Demo Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="imagetoolbar" content="no">

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php"></script>

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
	var mode = (document.getElementById('showrastermap').checked) ? 'political' : 'minimal';
	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,7, mode);
  mmmap.initVector();
  mmmap.hideScale();
  mmmap.hideModeSelector();
  mmmap.hideCenterMark();
  mmmap.moveTo(18.79613, 99.43143);
  var object = {
    "mmmap" : mmmap,
    "id" : '50',
    "ds" : "IG",
    "simplify" : 0.01,
    "showdefaulttitle" : document.getElementById('showlabel').checked,
    "linewidth" : 4,
    "clearcache" : true,
    "linecolor" : linecolor,
    "fillcolor" : fillcolor,
    "lineopacity" : 0.7,
    "fillopacity" : 0.1,
    "zoom" : 7,
    "minzoom" : 1,
    "maxzoom" : 7,
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
  currentlayer = objectlayers.province = mmmap.showObject2(object);
  mmmap.setResolutionChangedHandler(checkZoom)
	myRepaint();
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
        "showdefaulttitle" : document.getElementById('showlabel').checked,
        "linewidth" : 4,
        "linecolor" : linecolor,
        "fillcolor" : fillcolor,
        "lineopacity" : 0.7,
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
                      "showdefaulttitle" : document.getElementById('showlabel').checked,
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
  if(document.getElementById('showlabel').checked) currentlayer.showGSLabel();
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

</script>

</head>
<body onLoad="mmmap_client_init()" scroll="no" style="overflow:hidden;margin: 0px 0px 0px 5px;" marginwidth=0 marginheight=0>
<div style="float:left;"><IMG SRC=images/logo_map.png BORDER=0 ALT="Logo"></a></div>
<div id="breadcrumbs" style="float:left; margin:30px;"></div>
<div style="width:150px; float:right;">
<div style="width:100%; background-color:#000000; color:#FFFFFF; text-align:center;">settings</div>
<input id="showlabel" type="checkbox" onclick="switchLabel(this.checked)"> Show label <br>
<input id="showrastermap" type="checkbox" onclick="showRasterMap(this.checked)" checked> Show raster map
</div>
<div id="mmmap_div" style="position: absolute; left: 5px; top: 100px; width: 800px; height: 500px; border: 0px solid red"></div>
<div id="loading" style="width:100%; height:100%; position:absolute; top:100px; left: 5px; z-index:9999;">
<div id="loading-bar" style="width:80px; height:50px; position:absolute; padding:5px; font-family:Arial, Helvetica; background-color:#FFFFFF; color:#1F85FF; font-size11px; font-weight:bold; text-align:center; visibility:hidden;"><img src="images/loading.gif"><br><b>Loading...</b</div>
</div> 
</body>
</html>
