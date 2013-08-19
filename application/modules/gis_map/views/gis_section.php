

<html>
<head>
<title>Longdo Map Demo Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="imagetoolbar" content="no">

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
</script>

</head>
<body onLoad="mmmap_client_init()" scroll="no" style="overflow:hidden;margin: 0px 0px 0px 5px;" marginwidth=0 marginheight=0>
<div style="float:left;"></div>
<div style="float:left; margin:15px; width:550px;">

  <div style="font-size:12px; font-family:Tahoma; border-bottom:1px solid black; height:30px;">
    <input  id="south" name="objset" type="radio" value="0" checked="true" onClick="drawObjectSet(this.value)"><label for="south">กลุ่มจังหวัดชายแดนภาคใต้</label>
    <input  id="north" name="objset" type="radio" value="1" onClick="drawObjectSet(this.value)"><label for="north">กลุ่มจังหวัดภาคเหนือตอนบน 1</label>
    <input  id="east" name="objset" type="radio" value="2" onClick="drawObjectSet(this.value)"><label for="east">กลุ่มจังหวัดภาคตะวันออก</label>
  </div>
  
  <div id="breadcrumbs" style="margin-top:10px; font-size:12px; font-family:Tahoma; "></div>
  
</div>

<div id="mmmap_div" style="position: absolute; left: 5px; top: 100px; width: 800px; height: 500px; border: 0px solid red"></div>

<div id="loading" style="width:100%; height:100%; position:absolute; top:100px; left: 5px; z-index:9999;">

<div id="loading-bar" style="width:80px; height:50px; position:absolute; padding:5px; font-family:Arial, Helvetica; color:#1F85FF; font-size11px; font-weight:bold; text-align:center; visibility:hidden;"><img src="images/ajax-loader.gif"><br><b>Loading...</b></div>

</div>
</body>
</html>
