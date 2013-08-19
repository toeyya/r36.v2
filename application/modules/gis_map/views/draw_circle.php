

<html>
<head>
<title>Longdo Map Demo Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="imagetoolbar" content="no">

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php"></script>

<script>

var mmmap;
var mylang = "th";
var polygon, polygon2, polygon3;

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");

	window.onresize = myRepaint;

	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,11, "traffic");
  mmmap.initVector();

  mmmap.setCenter(13.767734,100.5351375, Math.pow(2, 11));
  myRepaint();
  
  var points = [
    [13.68105, 100.57505],
    [13.78945, 100.73627],
    [13.67694, 100.93248]
  ];
  
  polygon = new MMLine(mmmap);
  polygon.setMode("polygon") // line or polygon
  polygon.setLineColor("#000000");
  polygon.setLineOpacity(1); // 0-1
  polygon.setFillColor("#47BF4C");
  polygon.setFillOpacity(0.5); // 0-1
  polygon.setTitle("This is title");
  polygon.setDescription("Popup content");
  polygon.setPoints(points);

  var points2 = [
    [13.80, 100.44],
    [13.80, 100.70],
    [13.70, 100.70],
    [13.70, 100.44]
  ];
  
  polygon2 = new MMLine(mmmap);
  polygon2.setMode("polygon") // line or polygon
  polygon2.setLineColor("#0000FF");
  polygon2.setLineOpacity(1); // 0-1
  polygon2.setFillColor("#FF0000");
  polygon2.setFillOpacity(0.5); // 0-1
  polygon2.setTitle("This is title");
  polygon2.setDescription("Popup content");
  polygon2.setPoints(points2);
  polygon2.setFillColor("#AFA42B");
  polygon2.rePaint();
  
  
  var points3 = [13.8337, 100.59461];
  polygon3 = new MMLine(mmmap);
  polygon3.setMode("ellipse");
  polygon3.setLineOpacity(0.5);
  polygon3.setFillOpacity(0.5);
  polygon3.setWidth("5"); // 5 km
  polygon3.setHeight("6"); // 3 km
  polygon3.setTitle("This is Ellipse");
  polygon3.setDescription("Popup content");
  polygon3.setPoints(points3);
  polygon3.setFillColor("#AF2BA0");
  polygon3.rePaint();
  
  //setTimeout("mmmap.reDrawLines()", 2000); // *** to ensure that all objects are properly displayed ***
}

function doShow() {
  setTimeout("updateP3();",2000);
  setTimeout("updateP2()",4000);
  setTimeout("updateP1()",6000);
  setTimeout("alert('About to update the square as following: \\n- hide square');polygon2.hide()",8000);
  setTimeout("alert('About to update the square as following: \\n- show square');polygon2.show()",10000);
  setTimeout("alert('About to update the square as following: \\n- remove square');polygon2.remove()",12000);
  setTimeout("alert('About to update the ellipse as following: \\n- reset center to 13.86457, 100.75137');setP3Center()",14000);
  document.getElementById('doshowbutton').disabled = true;
}

function updateP1(){
  alert('About to update the triangle as following:\n- set lineopacity = 0.2\n- set fillopacity = 0.3\n- set fillcolor = #DBEF2C\n- set order = 13');
  polygon.setLineOpacity(0.2);
  polygon.setFillOpacity(0.3);
  polygon.setFillColor('#DBEF2C');
  polygon.setOrder(13);
  polygon.rePaint(); //update polygon
}

function updateP2(){
  alert('About to update the square as following:\n- set fillopacity = 1\n- set order = 12');
  polygon2.setFillOpacity(1);
  polygon2.setOrder(12); //bring it to front (default order = 0)
  polygon2.rePaint(); //update polygon
  
}

function updateP3(){
  alert('About to update the ellipse as following:\n- set fillcolor = #1735BF\n- set lineopacity = 1\n- set fillopacity = 0.5\n- set order = 11\n- set linewidth = 15;');
  polygon3.setFillColor('#1735BF');
  polygon3.setLineOpacity(1);
  polygon3.setFillOpacity(0.5);
  polygon3.setOrder(11);
  polygon3.setLineWidth(10);
  polygon3.rePaint(); //update polygon
}

function setP3Center() {
  var newpoints = [13.86457, 100.75137]
  polygon3.setPoints(newpoints);
}

var arraytestdiv;

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
<a href='/'><IMG SRC=images/logo_map.png BORDER=0 ALT="Logo"></a>
</td>
<td align=right>

<table cellpadding=5 cellspacing=5>
<tr>
<td align=center bgcolor=#EEEEEE>
Actions
</td>
</tr>
<tr>
<td>
<input id=doshowbutton type=button onclick="doShow()" value="Update polygons">
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
