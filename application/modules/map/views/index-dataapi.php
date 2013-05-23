
<html>
<head>
<title>Longdo Map Demo Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="imagetoolbar" content="no">

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php?key=7a19bf7e66f74a0b39843f76eaf11371"></script>
<script>

var mmmap;

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");

	window.onresize = myRepaint;

	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,3, "minimal");

  mmmap.initVector();

  mmmap.hideScale();
  mmmap.hideZoomBar();
  mmmap.hideModeSelector();
  mmmap.hideCenterMark();

  // Data API
  // mmmap.showObject(myid,ds,showdefaulttitle,forcetitle,forcemode,linecolor,fillcolor,linetransp,filltransp)
  //
  // Administrative areas
  mmmap.showObject('5710', "IG"); // Geocode for อ.แม่สรวย 
  //mmmap.showObject('5_', "IG", true, null, null, "FF0000"); // some provinces, in red
  mmmap.showObject('42;43', "IG"); // some provinces, without labels
  //mmmap.showObject('57', "IG"); // a province
  //mmmap.showObject('77__', "IG", true, null, null,"0000FF", "0000FF", 0.7, 0.5); // all amphoes in a province
  mmmap.showObject('77', "IG", true, null, null, "FF0000", "FF0000", 0.7, 0.1); // a province
  setTimeout('mmmap.showObject("7701;7704", "IG", true, null, null,"0000FF", "0000FF", 1, 1)', 2000); // all amphoes in a province -- force later draw
  //mmmap.showObject('__', "IG",true); // all provinces, with labels
  //mmmap.showObject('จ.นนทบุรี', "ADM", "เมืองนนทน์", "polygon", "FF0000", "FF0000");
  //mmmap.showObject('อ.ลำลูกกา', "ADM");
  //mmmap.showObject('สมุทรปราการ', "ADM");
  //mmmap.showObject('ต.ศรีดอนมูล', "ADM"); 
  //mmmap.showObject('อ.ปาย', "ADM"); 
  //mmmap.showObject('ชลบุรี', "ADM", true, null, null, "00FF00", "00FF00", 0.7, 0.5); // Chon Buri, with line and fill colors

  // Roads
  //mmmap.showObject('ถนนพญาไท', "RNM"); // show a road by specifiying its name
  mmmap.showObject('895717', "RID"); //  show a road by specifiying its ID

  // Contributed objects
  //mmmap.showObject('M00000001', "LONGDO"); // show Longdo Map contributed lines (new 10 metropolitan train routes)
  mmmap.showObject('A10000001', "LONGDO"); // show Longdo Map contributed POI

  // the return value of showObject is of MMMapObject class, you can also do 
  // new MMMapObject(mymmmap, myid,ds,showdefaulttitle,forcetitle,forcemode,linecolor,fillcolor,linetransp,filltransp)
  //
  //x1 = new MMMapObject(mmmap, 'จ.นนทบุรี', "ADM", true, "เมืองนนทน์", "polygon", "FF0000", "FF0000");
  //setTimeout('alert(x1.getGSObjects().length)', 200);

  //setTimeout("mmmap.updatevector()", 2000); // *** to ensure that all objects are properly displayed ***

	myRepaint();
}

function myRepaint() {
	chkWinSize();

	var newwidth = parseInt(ww) - 5 - 5;
	var newheight = parseInt(wh) - 100 - 5;

	mmmap.setSize(newwidth,newheight);
	mmmap.rePaint();

}

</script>

</head>

<body onLoad="mmmap_client_init()" scroll="no" style="overflow:hidden;margin: 0px 0px 0px 5px;" marginwidth=0 marginheight=0>

<form action="javascript:">

<table width=100% cellpadding=0 cellspacing=0><tr>
<td>
<a href='/'><IMG SRC=http://map.longdo.com/themes/longdo/logo.png BORDER=0 ALT="Logo"></a>
</td>
<td align=right>
&nbsp;
</td>
</tr>
</table>

</td>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%><tr>
<td bgcolor="#cce0fb" style="padding:0px;" valign="bottom" align=left>
</td>
<td bgcolor="#cce0fb" style="padding:0px;" valign="middle" align=right>
&nbsp;
</td>
</tr>
</table>

</form>

<div id="mmmap_div" style="position: absolute; left: 5px; top: 100px; width: 800px; height: 500px; border: 0px solid red"></div>

</body>
</html>
