

<html>
<head>
<title>Longdo Map Demo Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="imagetoolbar" content="no">

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
	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,7, 'political');
  mmmap.hideScale();
  mmmap.hideModeSelector();
  mmmap.hideCenterMark();
  mmmap.setZoom(7);
	myRepaint();
  drawObjectSet(0);
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
      "showlabel" : false,
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

	mmmap.setSize(newwidth,newheight);
	mmmap.rePaint();

}
</script>

</head>
<body onLoad="mmmap_client_init()" scroll="no" style="overflow:hidden;margin: 0px 0px 0px 5px;" marginwidth=0 marginheight=0>
<div stlye="clear:both;"></div>
<div id="left-bar" style="position:absolute; top:5px; left:5px; width:245px; height:100%; border-right:1px solid #4F4F4F;">
<div style="float:left;"></a></div>
<div style="font-size:14px; margin-top:80px;">
<ul>
  <li>
  <a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '58'); mmmapig.moveTo('id', '58'); nowshowing = 58;">แม่ฮ่องสอน</a>
  <ul>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5803'); mmmapig.moveTo('id', '5803'); nowshowing = 5803;">อ.ปาย</a>
    <ul>
      <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '580302'); mmmapig.moveTo('id', '580302'); nowshowing = 580302;">ต.เวียงเหนือ</a></li>
      <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '580307'); mmmapig.moveTo('id', '580307'); nowshowing = 580307;">ต.โป่งสา</a></li>
    </ul>
    </li>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5807'); mmmapig.moveTo('id', '5807'); nowshowing = 5807;">อ.ปางมะผ้า</a>
    <ul>
      <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '580704'); mmmapig.moveTo('id', '580704'); nowshowing = 580704;">ต.นาปู่ป้อม</a></li>
      <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '580701'); mmmapig.moveTo('id', '580701'); nowshowing = 580701;">ต.สบป่อง</a></li>
    </ul>
    </li>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5805'); mmmapig.moveTo('id', '5805'); nowshowing = 5805;">อ.แม่ลาน้อย</a></li>
  </ul>
  </li>
</ul>
<ul>
  <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '50'); mmmapig.moveTo('id', '50'); nowshowing = 50;">เชียงใหม่</a>
  <ul>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5004'); mmmapig.moveTo('id', '5004'); nowshowing = 5004;">อ.เชียงดาว</a>
    <ul>
      <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '500404'); mmmapig.moveTo('id', '500404'); nowshowing = 500404;">ต.แม่นะ</a></li>
      <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '500402'); mmmapig.moveTo('id', '500402'); nowshowing = 500402;">ต.เมืองนะ</a></li>
    </ul>  
    </li>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5003'); mmmapig.moveTo('id', '5003'); nowshowing = 5003;">อ.แม่แจ่ม</a></li>
  </ul>
  </li>
</ul>
<ul>
  <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '51'); mmmapig.moveTo('id', '51'); nowshowing = 51;">ลำพูน</a>
  <ul>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5107'); mmmapig.moveTo('id', '5107'); nowshowing = 5107;">อ.บ้านธิ</a></li>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5104'); mmmapig.moveTo('id', '5104'); nowshowing = 5104;">อ.ลี้</a></li>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5105'); mmmapig.moveTo('id', '5105'); nowshowing = 5105;">อ.ทุ่งหัวช้าง</a></li>
  </ul>
  </li>
</ul>
<ul>
  <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '52'); mmmapig.moveTo('id', '52'); nowshowing = 52;">ลำปาง</a>
  <ul>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5205'); mmmapig.moveTo('id', '5205'); nowshowing = 5205;">อ.งาว</a></li>
    <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '5204'); mmmapig.moveTo('id', '5204'); nowshowing = 5204;">อ.เสริมงาม</a>
    <ul>
      <li><a href="#" onClick="mmmapig.hideObjects('id', nowshowing); mmmapig.showObjects('id', '520403'); mmmapig.moveTo('id', '520403'); nowshowing = 520403;">ต.เสริมซ้าย</a></li>
    </ul>
    </li>
  </ul>
  </li>
</ul>
</div>
</div>
<div id="mmmap_div" style="position: absolute; left: 255px; top: 5px; width: 800px; height: 500px; border: 0px solid red"></div>
<div id="loading" style="width:100%; height:100%; position:absolute; top:100px; left: 5px; z-index:9999;">
<div id="loading-bar" style="width:80px; height:50px; position:absolute; padding:5px; font-family:Arial, Helvetica; color:#1F85FF; font-size11px; font-weight:bold; text-align:center; visibility:hidden;"><img src="images/ajax-loader.gif"><br><b>Loading...</b></div>
</div>
</body>
</html>
