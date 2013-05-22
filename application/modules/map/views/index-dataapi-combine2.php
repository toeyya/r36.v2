
<html>
<head>
<title>Longdo Map Demo Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="imagetoolbar" content="no">

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php"></script>

<!-- pre-loading objects data-->
<!--include province level-->
<script>


var fillcolor = "#FF3F3F";
var linecolor = "#FF3F3F";

var mmmap;
var mmmapig;

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");
	window.onresize = myRepaint;
	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,7, 'minimal');
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
}

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
<div style="float:left;"><IMG SRC=images/logo_map.png BORDER=0 ALT="Logo"></a></div>

<div id="mmmap_div" style="position: absolute; left: 5px; top: 100px; width: 800px; height: 500px; border: 0px solid red"></div>
<div id="loading" style="width:100%; height:100%; position:absolute; top:100px; left: 5px; z-index:9999;">
<div id="loading-bar" style="width:80px; height:50px; position:absolute; padding:5px; font-family:Arial, Helvetica; color:#1F85FF; font-size11px; font-weight:bold; text-align:center; visibility:hidden;"><img src="images/ajax-loader.gif"><br><b>Loading...</b</div>
</div>
</body>
</html>
