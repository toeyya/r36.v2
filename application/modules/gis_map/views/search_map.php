

<html>
<head>
<title>Longdo Map Demo Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="imagetoolbar" content="no">

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php"></script>
<!--script type="text/javascript" src="http://"></script-->
<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/suggest.js.php"></script>

<script>

var mmmap;
var mylang = "th";
var currentmode = "mm";
var gmapjsloaded;

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");
	window.onresize = myRepaint;

	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,7, "icons");

	if (gmapjsloaded) {
		currentmode == "gmap";
		var googlemap_div = document.getElementById("googlemap_div");
		gmap = new GoogleMap(googlemap_div, 13.767734, 100.5351375, 7);

		showGMap();
	}

	myRepaint();

	var rightbar = document.getElementById("rightbar");
	rightbar.style.visibility = "visible";

	document.getElementById('normmodespan').style.textDecoration = 'none';
	document.getElementById('normmodespan').style.fontWeight = 'Bold';
	document.getElementById('satmodespan').style.textDecoration = 'underline';
	document.getElementById('satmodespan').style.fontWeight = 'normal';

	switchmapmode();
	json_init(document.getElementById('scrdiv'));
}

var arraytestdiv;

function mapresize() {
	chkWinSize();

	var newwidth = parseInt(ww) - 5 - 250;
	var newheight = parseInt(wh) - 98 - 5;

	mmmap.setSize(newwidth,newheight);
	mmmap.rePaint();

	document.getElementById("rightbar").style.left = newwidth + 10;
	document.getElementById("rightbar").style.height = newheight;

	document.getElementById("search_result_set").style.height = newheight - (parseInt(document.getElementById("searchbox_option").offsetHeight) + parseInt(document.getElementById("searchform").offsetHeight)) - 20;

	if (gmapjsloaded) {
		gmap.setSize(newwidth,newheight);
	}

}

function myRepaint() {
	mapresize();
}

function switchmapmode(){
	var r = document.getElementById('showroadcheck');
	var e = document.getElementById('showengcheck');

	var mode;

	mode = (r.checked?'icons':'normal') + (e.checked?'-en':'');
	mmmap.setMapMode(mode);
	mmmap.showCustomDivs();
	mapresize();
}

function showMMMap() {
	if (! document.getElementById("mmmap_div") ) {
		window.location="/";
		return;
	}

	if (currentmode == "mm" ) {
		return;
	}
	currentmode = "mm";

	// calc the resolution
	mresolution = res_g2m(gmap.gmap_object.getZoom());

	// grab the lat,long
	latitude = gmap.gmap_object.getCenter().lat();
	longitude = gmap.gmap_object.getCenter().lng();

	mmmap.setCenter(latitude, longitude, mresolution);
	mmmap.showMap();
	gmap.hideMap();

	// force traffic refresh & redraw
	mmmap.rePaint();

	document.getElementById('normmodespan').style.textDecoration = 'none';
	document.getElementById('normmodespan').style.fontWeight = 'Bold';
	document.getElementById('satmodespan').style.textDecoration = 'underline';
	document.getElementById('satmodespan').style.fontWeight = 'normal';
}


function showGMap() {
	if (! document.getElementById("mmmap_div") ) {
		window.location="?gmap=1";
		return;
	}

	if (currentmode == "gmap" ) {
		return;
	}

	currentmode = "gmap";
	if ( ! gmapjsloaded ) {
		window.location = "?lat="+latitude+"&long="+longitude+"&res="+resolution+"&gmap=1";
		return;
	}

	mmmap.hideMap();

	gmap.setCenter(latitude, longitude, resolution);
	gmap.showMap();

	mmmap.rePaint();

	document.getElementById('satmodespan').style.textDecoration = 'none';
	document.getElementById('satmodespan').style.fontWeight = 'Bold';
	document.getElementById('normmodespan').style.textDecoration = 'underline';
	document.getElementById('normmodespan').style.fontWeight = 'normal';

}

</script>

</head>

<body onLoad="mmmap_client_init()" scroll="no" style="overflow:hidden;margin: 0px 0px 0px 5px;" marginwidth=0 marginheight=0>

<table width=100% cellpadding=0 cellspacing=0><tr>
<td>

</td>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%><tr>
<td bgcolor="#cce0fb" style="padding:0px;" valign="bottom" align=left>
</td>
<td bgcolor="#cce0fb" style="padding:0px;font-family: tahoma, loma;font-size: 10pt;" valign="middle" align=right>Map mode: 
<span onclick="showMMMap();" style="cursor: pointer;" id="normmodespan">normal</span> or
<span onclick="showGMap();" style="cursor: pointer;" id="satmodespan">satellite</span> |
<a href="javascript:linkToPage()" title="Link to current location">Link to page</a>
&nbsp; &nbsp;
</td>
</tr>
</table>

<div id="googlemap_div" style="position: absolute;visibility: hidden;z-index:2;left: 5px; top: 98px; width: 800px; height: 500px; border: 0px solid red"></div>
<div id="mmmap_div" style="position: absolute; left: 5px; top: 98px; width: 800px; height: 500px; border: 0px solid red"></div>

<div id="rightbar" style="visibility: hidden; overflow: hidden;position: absolute; top: 98;width: 240px;background-color: #FFFFFF; padding: 0px 5px 0px 5px;">

<form id="searchform" onsubmit="mmmap.do_search(0,document.getElementById('searchtab_keywordform').value, 'search_result_set'); return false;" action="?">

<div style="background-color: #FFEFCF;font-weight: Bold;margin-top:0px;font-family: tahoma, loma;font-size: 10pt;">Search</div>

<input type="text" style="padding-left:3px;padding-right:3px;width:180px;" autocomplete="off" id="searchtab_keywordform" onkeyup="_suggest_load()" onkeydown="suggest_navigation_keys_check(event)" onblur="setTimeout('clearSuggestDiv()',300)" />

<input id="dosuggest" type="checkbox" style="display: none;" checked="checked" name="dosuggest"/>
<input type="submit" value="ค้น">

<div id="_suggest_disp" style="padding-left:3px;padding-right:3px; z-index:10; border:1px #7F9DB9 solid; background:#fff; width:231px; visibility:hidden;"></div>

<div style="font-size: 8pt;">
ตัวอย่าง: 
<a href="#" onclick="document.getElementById('searchtab_keywordform').value='ธนาคาร';mmmap.do_search(0,document.getElementById('searchtab_keywordform').value, 'search_result_set'); return false;">ธนาคาร</a>,
	<a href="#" onclick="document.getElementById('searchtab_keywordform').value='โรงพยาบาล';mmmap.do_search(0,document.getElementById('searchtab_keywordform').value, 'search_result_set'); return false;">โรงพยาบาล</a>,
	<a href="#" onclick="document.getElementById('searchtab_keywordform').value='เพชรบุรี';mmmap.do_search(0,document.getElementById('searchtab_keywordform').value, 'search_result_set'); return false;">เพชรบุรี</a>
	</div>
	</form>

	<div id="search_result_set" style="font: 10pt Tahoma;overflow: auto;margin-top: 0px;border: 0px solid red">&nbsp;</div>

	<div style="background-color: #cce0fb; padding: 3px;font: 10pt Tahoma;" id="searchbox_option">
	<div style="background-color: #FFEFCF;font-weight: Bold;cursor: default;" onclick="if ((o=document.getElementById('optionbody')).style.display == 'none') {o.style.display='block'; document.getElementById('optionimg').src = 'images/down.gif';} else {o.style.display='none'; document.getElementById('optionimg').src = 'images/up.gif';} mapresize();">
	<div style="background-color: #FFEFCF;font-weight: Bold;float: right;margin-top:3px;"><img src="images/down.gif" id="optionimg"></div>
	ตัวเลือก
	</div>

	<div id="optionbody" style="display: block;">
	<input type="checkbox" onclick="switchmapmode();" id="showroadcheck" CHECKED> แสดงแผนที่ละเอียด<br>
	<input type="checkbox" onclick="switchmapmode();" id="showengcheck"> Map in English<br>
	</div>
	</div>


	</div>

	<div id="scrdiv"></div>
	<!-- google map -->
	
</body>
</html>
