
<html>
<head>
<title>Longdo Map Demo Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="imagetoolbar" content="no">

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php"></script>
<script>

var mmmap;

function checkWidthFromMMMapDiv() {
  var _mmmap_div = document.getElementById('mmmap_div');
  return parseInt(_mmmap_div.offsetWidth/2)>300 ? 300+' px (Width of mmmap_div/2 & no more than 300)' : parseInt(_mmmap_div.offsetWidth/2)+' px (Width of mmmap_div/2)';
}
function checkHeightFromMMMapDiv(fixpopupsize) {
  var _mmmap_div = document.getElementById('mmmap_div');
  return (!fixpopupsize) ? parseInt(_mmmap_div.offsetHeight - 70)+' px (Height of mmmap_div-70)' : parseInt(_mmmap_div.offsetHeight/2)+' px (Height of mmmap_div/2)';
}

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");
	window.onresize = myRepaint;
	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,3, "normal");
  myRepaint();
  mmmap.initVector();
}


function myRepaint() {
	chkWinSize();

	var newwidth = parseInt(ww) - 5 - 5;
	var newheight = parseInt(wh) - 100 - 5;

	mmmap.setSize(newwidth,newheight);
	mmmap.rePaint();
}

function showPopup(option) {
  var lat = 13.72932; //mmmap.mouseCursorLat();
  var lon = 100.53589; //mmmap.mouseCursorLong();
  var title = "Show popup demo";
  
  var option_default = false;
  
  /* link => Link of title
   *
   * width (default: width of mmmap_div/2, but no more than 300px) => 
   *    if "fixpopupsize" = true: "width" = width of popup size (px). (no less than 150px & no more than width of mmmap_div)
   *    otherwise: "width" = max width of popup size (px). (no less than 150px & no more than width of mmmap_div)
   *    
   * height => 
   *    if "fixpopupsize" = true: "height" = height of popup size (px). (default: height of mmmap_div/2) (no less than 150px & no more than height of mmmap_div - 70px). 
   *    otherwise: "height" = max height of popup size (px). (default: height of mmmap_div - 70px) (no less than 150px & no more than height of mmmap_div - 70px). 
   *    
   * fixpopupsize (default: false) => 
   *    if "fixpopupsize" = true: popup size = "width" & "height". 
   *    otherwise: popup size = content size but max width = "width" & max height = "height".
   */
  switch(option) {
    case 1 :
      var popup_params = {
        link : "http://longdo.com", 
        width : 200, 
        height : 100, 
        fixpopupsize : true
      };
      var content = "Case: 1<br>Title link: <font color=deeppink>"+popup_params.link+"</font><br>Width: <font color=deeppink>"+popup_params.width+"</font><br>Height: <font color=deeppink>"+popup_params.height+"</font><br>Fix popup size: <font color=deeppink>"+popup_params.fixpopupsize+"</font><div style='color:#9F9F9F; margin-top:10px'>Value<br> => Width: 200 px<br> => Height: 150 px (no less than 150)<br> => Fix popup size: true</div>";
      break;
    
    case 2 : 
      var popup_params = {
        link : "http://longdo.com", 
        width : 250, 
        height : 250, 
        fixpopupsize : false
      };
      var content = "Case: 2<br>Title link: <font color=deeppink>"+popup_params.link+"</font><br>Width: <font color=deeppink>"+popup_params.width+"</font><br>Height: <font color=deeppink>"+popup_params.height+"</font><br>Fix popup size: <font color=deeppink>"+popup_params.fixpopupsize+"</font><div style='color:#9F9F9F; margin-top:10px'>Value<br> => Max-Width: 250 px<br> => Max-Height: 250 px<br> => Fix popup size: false</div><br><br><img src='../demo/images/logo.png'>";
      break;
    
    case 3 : 
      var popup_params = {
        link : "http://longdo.com", 
        width : 250, 
        height : 250, 
        fixpopupsize : true
      };
      var content = "Case: 3<br>Title link: <font color=deeppink>"+popup_params.link+"</font><br>Width: <font color=deeppink>"+popup_params.width+"</font><br>Height: <font color=deeppink>"+popup_params.height+"</font><br>Fix popup size: <font color=deeppink>"+popup_params.fixpopupsize+"</font><div style='color:#9F9F9F; margin-top:10px'>Value<br> => Width: 250 px<br> => Height: 250 px<br> => Fix popup size: true</div><br><br><img src='../demo/images/logo.png'>";
      break;
    
    case 4 : 
      var popup_params = {
        link : "http://longdo.com", 
        width : 350, 
        height : 350
      };
      var content = "Case: 4<br>Title link: <font color=deeppink>"+popup_params.link+"</font><br>Width: <font color=deeppink>"+popup_params.width+"</font><br>Height: <font color=deeppink>"+popup_params.height+"</font><br>Fix popup size: <font color=deeppink>"+popup_params.fixpopupsize+"</font><div style='color:#9F9F9F; margin-top:10px'>Value<br> => Max-Width: 350 px<br> => Max-Height: 350 px<br> => Fix popup size: false</div>";
      break;
    
    case 5 : 
      var popup_params = {
        link : "http://longdo.com", 
        width : 350, 
        height : 350
      };
      var content = "Case: 4<br>Title link: <font color=deeppink>"+popup_params.link+"</font><br>Width: <font color=deeppink>"+popup_params.width+"</font><br>Height: <font color=deeppink>"+popup_params.height+"</font><br>Fix popup size: <font color=deeppink>"+popup_params.fixpopupsize+"</font><div style='color:#9F9F9F; margin-top:10px'>Value<br> => Max-Width: 350 px<br> => Max-Height: 350 px<br> => Fix popup size: false</div><br><br><img src='../demo/images/logo.png'>";
      break;
    
    case 6 : 
      var popup_params = {
        link : "http://longdo.com", 
        width : 450, 
        fixpopupsize : true
      };
      var content = "Case: 5<br>Title link: <font color=deeppink>"+popup_params.link+"</font><br>Width: <font color=deeppink>"+popup_params.width+"</font><br>Height: <font color=deeppink>"+popup_params.height+"</font><br>Fix popup size: <font color=deeppink>"+popup_params.fixpopupsize+"</font><div style='color:#9F9F9F; margin-top:10px'>Value<br> => Width: 450 px<br> => Height: "+checkHeightFromMMMapDiv(true)+"<br> => Fix popup size: true</div>";
      break;
    
    case 7 : 
      var popup_params = {
        link : "http://longdo.com", 
        fixpopupsize : true
      };
      var content = "Case: 6<br>Title link: <font color=deeppink>"+popup_params.link+"</font><br>Width: <font color=deeppink>"+popup_params.width+"</font><br>Height: <font color=deeppink>"+popup_params.height+"</font><br>Fix popup size: <font color=deeppink>"+popup_params.fixpopupsize+"</font><div style='color:#9F9F9F; margin-top:10px'>Value<br> => Width: "+checkWidthFromMMMapDiv()+"<br> => Height: "+checkHeightFromMMMapDiv(true)+"<br> => Fix popup size: true</div><br><br><img src='../demo/images/logo_map.png'>";
      break;
    
    case 8 : 
      option_default=true;
      var content = "Case: Default<br>All popup parameters: <font color=deeppink>undefined</font><div style='color:#9F9F9F; margin-top:10px'>Default value<br> => Max-Width: "+checkWidthFromMMMapDiv(false)+"<br> => Max-Height: "+checkHeightFromMMMapDiv(false)+"<br> => Fix popup size: false</div><br><br><img src='../demo/images/logo_map.png'>";
      break;
    
    default :
      option_default=true;
      var content = "Case: Default<br>All popup parameters: <font color=deeppink>undefined</font><div style='color:#9F9F9F; margin-top:10px'>Default value<br> => Max-Width: "+checkWidthFromMMMapDiv(false)+"<br> => Max-Height: "+checkHeightFromMMMapDiv(false)+"<br> => Fix popup size: false</div>";
      break;
  }
   
  if(option_default) {
    mmmap.showPopUp(lat, lon, title, content);
  }
  else {
    mmmap.showPopUp(lat, lon, title, content, popup_params);
  }
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

<div id="popup_demo" style="position: absolute; left: 15px; top: 115px; width: 230px; border: 3px solid #FF83CD; background:#FFEFFA; z-index:3;">
  <div onclick="showPopup(1);" style="cursor:pointer; padding:10px 20px">Popup demo case 1</div>
  <div onclick="showPopup(2);" style="cursor:pointer; padding:10px 20px">Popup demo case 2</div>
  <div onclick="showPopup(3);" style="cursor:pointer; padding:10px 20px">Popup demo case 3</div>
  <div onclick="showPopup(4);" style="cursor:pointer; padding:10px 20px">Popup demo case 4</div>
  <div onclick="showPopup(5);" style="cursor:pointer; padding:10px 20px">Popup demo case 4 (+ image)</div>
  <div onclick="showPopup(6);" style="cursor:pointer; padding:10px 20px">Popup demo case 5</div>
  <div onclick="showPopup(7);" style="cursor:pointer; padding:10px 20px">Popup demo case 6</div>
  <div onclick="showPopup(0);" style="cursor:pointer; padding:10px 20px">Popup demo default</div>
  <div onclick="showPopup(8);" style="cursor:pointer; padding:10px 20px">Popup demo default (+ image)</div>
</div>
</body>
</html>
