<!doctype html>
<html lang="en">
<head>
<base href="<?php echo base_url(); ?>" />
<title><?php echo $template['title']; ?></title>
<?php echo $template['metadata']; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<link rel="stylesheet" href="themes/map/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="themes/map/media/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="themes/map/media/js/jquery-ui1.10.3.js"></script>
<script type="text/javascript" src="themes/map/media/js/highcharts.js"></script>
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

var fillcolor = "#FF3F3F"; // แดง
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
  
   mmmap.showObject('เชียงราย', "ADM", true, null, null, "F70707", "F70707", 0.7, 0.5); // Chiang Rai, with line and fill colors ภาคเหนือ

   mmmap.showObject('น่าน', "ADM", true, null, null, "DF0101", "DF0101", 0.7, 0.5); // แดง

  mmmap.showObject('พะเยา',"ADM", true, null, null, "F70707", "F70707", 0.7, 0.5); // แดง
  mmmap.showObject('แพร่',"ADM", true, null, null, "F70707", "F70707", 0.7, 0.5); // แดง
  mmmap.showObject('แม่ฮ่องสอน', "ADM", true, null, null, "F70707", "F70707", 0.7, 0.5); // แดง
   mmmap.showObject('ลำปาง', "ADM", true, null, null, "F70707", "F70707", 0.7, 0.5); // แดง
   mmmap.showObject('ลำพูน', "ADM", true, null, null, "F70707", "F70707", 0.7, 0.5); // แดง
   mmmap.showObject('อุตรดิตถ์',"ADM", true, null, null, "F70707", "F70707", 0.7, 0.5); // แดง
  
  mmmap.showObject('กาฬสินธุ์',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // , Kalasin with line and fill colors ภาคตะวันออกเฉียงเหนือ
  mmmap.showObject('ขอนแก่น',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('ชัยภูมิ',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว

  mmmap.showObject('นครพนม',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว

  mmmap.showObject('นครราชสีมา',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('บึงกาฬ',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('บุรีรัมย์',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('มหาสารคาม',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('มุกดาหาร',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('ยโสธร',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('ร้อยเอ็ด',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('เลย',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('สกลนคร',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('สุรินทร์',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว

  mmmap.showObject('ศรีสะเกษ',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('หนองคาย',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('หนองบัวลำภู',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('อุดรธานี',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว

  mmmap.showObject('อุบลราชธานี',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  mmmap.showObject('อำนาจเจริญ',"ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // เขียว
  
   mmmap.showObject('กำแพงเพชร',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ,  	Kamphaeng Phet with line and fill colors ภาคกลาง 
   mmmap.showObject('กรุงเทพมหานคร',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('ชัยนาท',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('นครนายก',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('นครปฐม',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม

  mmmap.showObject('นครสวรรค์',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม

  mmmap.showObject('นนทบุรี',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('ปทุมธานี',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('พระนครศรีอยุธยา',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('พิจิตร',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม 
  mmmap.showObject('พิษณุโลก',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('เพชรบูรณ์',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม

  mmmap.showObject('ลพบุรี',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม

  mmmap.showObject('สมุทรปราการ',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('สมุทรสงคราม',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม 
  mmmap.showObject('สมุทรสาคร',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
 mmmap.showObject('สิงห์บุรี',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('สุโขทัย',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม

  mmmap.showObject('สุพรรณบุรี',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม

  mmmap.showObject('สระบุรี',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม 
  mmmap.showObject('อ่างทอง',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  mmmap.showObject('อุทัยธานี',"ADM", true, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
  


  mmmap.showObject('ฉะเชิงเทรา', "ADM", false, null, null, "A7FA00", "A7FA00", 0.7, 0.5); // เขียวออ่น
  mmmap.showObject('ชลบุรี', "ADM", false, null, null, "A7FA00", "A7FA00", 0.7, 0.5); // เขียวออ่น
  mmmap.showObject('ตราด', "ADM", false, null, null, "A7FA00", "A7FA00", 0.7, 0.5); // เขียวออ่น
  mmmap.showObject('ปราจีนบุรี', "ADM", false, null, null, "A7FA00", "A7FA00", 0.7, 0.5); // เขียวออ่น
  mmmap.showObject('ระยอง', "ADM", false, null, null, "A7FA00", "A7FA00", 0.7, 0.5); // เขียวออ่น
  mmmap.showObject('สระแก้ว', "ADM", false, null, null, "A7FA00", "A7FA00", 0.7, 0.5); // เขียวออ่น
  
  mmmap.showObject('กาญจนบุรี', "ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // , Kanchanaburi with line and fill colors ภาคตะวันตก
  mmmap.showObject('ตาก', "ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // เหลือง

  mmmap.showObject('ประจวบคีรีขันธ์', "ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // เหลือง
  mmmap.showObject('เพชรบุรี', "ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // เหลือง
  mmmap.showObject('ราชบุรี', "ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // เหลือง
  mmmap.showObject('จันทบุรี', "ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // เหลือง

   
     mmmap.showObject('กระบี่',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // , 	Krabi  with line and fill colors ภาคใต้ 
  mmmap.showObject('ชุมพร',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('ตรัง',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('นครศรีธรรมราช',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('นราธิวาส',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('ปัตตานี',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('พังงา',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('พัทลุง',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม


  mmmap.showObject('ภูเก็ต ',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม

  mmmap.showObject('ระนอง',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('สตูล',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('สงขลา',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('สุราษฎร์ธานี',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
  mmmap.showObject('ยะลา',"ADM", true, null, null, "FAC802", "FAC802", 0.7, 0.5); // เหลืองเข้ม
 
   //mmmap.showObject('สกลนคร', "ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // เหลือง
   //mmmap.showObject('บึงกาฬ',"ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // เหลือง
   //mmmap.showObject('อุดรธานี',"ADM", false, null, null, "FCE005", "FCE005", 0.7, 0.5); // เหลือง
   
    mmmap.showObject('พระนครศรีอยุธยา', "ADM", false, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
   mmmap.showObject('สิงห์บุรี',"ADM", false, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
   mmmap.showObject('ลพบุรี',"ADM", false, null, null, "FA6000", "FA6000", 0.7, 0.5); // ส้ม
   mmmap.moveTo(13.767734,100.5351375);
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
    span.innerHTML += ' >> '+name;
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

	//var newwidth = parseInt(ww) - 5 - 5;
	//var newheight = parseInt(wh) - 100 - 5;
	var newwidth =860;
	var newheight =1200;
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
	//$( "#tabs-gis" ).tabs();
	mmmap_client_init();
	
	$('select[name=province]').change(function(){
		var id=$('select[name=province] option:selected').val();
		 mmmap.removeAllVectors();
		  mmmapig.hideObjects('id', nowshowing); 
		  mmmapig.showObjects('id', id); 
		  mmmapig.moveTo('id', id); 
		  nowshowing = id;
		 
	})
	
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
            text: 'ข้อมูลระดับความเสี่ยงของการสัมผัสโรค'
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
            name: 'อัตราการสัมผัสโรค',
            data: [
                {name: 'อ.สารภี',y: 26.8,color :'#E01B1B'},
                {name: 'อ.แม่แตง',y: 45.0,sliced: true,selected: true,color :'#E01B1B'},
                {name: 'อ.ไชปราการ',y: 30.5,color :'#E01B1B'}, 
                {name: 'อ.หางดง',y:55.5,color :'#E01B1B'},   
                {name: 'อ.จอมทอง',y: 12.7,color :'#ED4C1F'},  
                {name: 'อ.ดอยสะเก็ด',y: 10.7,color :'#ED4C1F'},  
                {name: 'อ.สเมิง',y: 8.0,color :'#FAD502'},
                {name: 'อ.แม่แจ่ม',y: 5.1,color :'#FAD502'},
                {name: 'อ.ฮอด',y: 7.0,color :'#FAD502'},
                {name: 'อ.ดอยเต่า',y: 8.9,color :'#FAD502'},     
                {name: 'อ.พร้าว',y: 5.1,color :'#55FA02'},
                {name: 'อ.ฝาก',y: 7.0,color :'#55FA02'},
                {name: 'อ.แม่อาย',y: 8.9,color :'#55FA02'} 
            ]
        }]
    });
	
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
			<li><input type="checkbox" name="" value="1" checked="checked"><span class="red"></span>ระดับความเสี่ยงสูงสุด (Very high)</li>
			<li><input type="checkbox" name="" value="2" checked="checked"><span class="orange"></span>ระดับความเสี่ยงสูง (High)</li>
			<li><input type="checkbox" name="" value="3" checked="checked"><span class="yellow"></span>ระดับความเสี่ยงปานกลาง (Moderate)</li>
			<li><input type="checkbox" name="" value="4" checked="checked"><span class="green"></span>ระดับความเสี่ยงน้อย (Low)</li>
		</ul>
		<div align="center"><input type="submit" name="search" value="ค้นหา" class="Submit" title="ปุ่มค้นหา">
			<input type="submit" name="print" value="พิมพ์" class="Submit" title="ปุ่มพิมพ์">
		</div>
	</div>

	<div id="tab_right">
		<ul class="tabs">
		<li><a href="#tabs1">GIS</a></li>
		<li><a href="#tabs2">TABLE</a></li>
		<li><a href="#tabs3">GRAPH</a></li>
		</ul>
		<div id="tabs1">
			<div id="breadcrumbs"></div>	
		<div id="mmmap_div">	</div>
		<div id="loading"><div id="loading-bar"></div></div>
		</div>	
		<div id="tabs2">
		<table class="tbreport">
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
		</table>
		</div>
		<div id="tabs3">
			<div id="container"></div>
		</div>
	</div>
</div>





</body>
</html>
