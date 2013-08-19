

<html>
<head>
<base href="<?php echo base_url(); ?>" />
<title><?php echo $template['title']; ?></title>
<?php echo $template['metadata']; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

<link rel="stylesheet" href="themes/map/media/css/stylesheet.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="themes/map/media/css/set_map.css" type="text/css" media="screen" charset="utf-8" />

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="themes/map/media/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="themes/map/media/js/jquery-ui1.10.3.js"></script>
<script type="text/javascript" src="themes/map/media/js/highcharts.js"></script>

<meta http-equiv="imagetoolbar" content="no">

<script type="text/javascript" src="http://mmmap15.longdo.com/mmmap/mmmap.php?key=7a19bf7e66f74a0b39843f76eaf11371"></script>
<script>

var mmmap;

function mmmap_client_init() {
	var mmmap_div = document.getElementById("mmmap_div");

	window.onresize = myRepaint;

	mmmap = new MMMap(mmmap_div,13.767734,100.5351375,7, "normal");

  mmmap.initVector();

  mmmap.hideScale();
  mmmap.hideZoomBar();
  mmmap.hideModeSelector();
  mmmap.hideCenterMark();
  mmmap.setZoom(7);

//   mmmap.showObject({id:'50;58', ds:'IG', combine:true, forcetitle:"เชียงใหม่ แม่ฮ่องสอน"});
  
  mmmap.showObject({id:'23;2202',dozoom:false, ds:'IG', autoshowpopup:false, combine:true,fillcolor:"F6358A", forcetitle:"จ.ตราด และ อ.ขลุง(จ.จันทบุรี)"});
  mmmap.showObject({id:'57;50;55;56;54;58;52;51;53',dozoom:false, ds:'IG', autoshowpopup:false,fillcolor:"F00", combine:true, forcetitle:"ภาคเหนือ"});
  mmmap.showObject({id:'อ.ศรีเทพ;อ.วิเชียรบุรี',dozoom:false, ds:'ADM', autoshowpopup:false, combine:true, forcetitle:"อ.ศรีเทพ และ อ.วิเชียรบุรี"});
  mmmap.showObject({id:'จ.ปัตตานี;จ.ยะลา;จ.นราธิวาส',dozoom:false, ds:'ADM', filltransp : '0.2',  autoshowpopup:false, combine:true, fillcolor:"FF0F0F", linecolor:"4F4F4F", forcetitle:"3 จังหวัดชายแดนภาคใต้"});
  mmmap.showObject({id:'จ.กระบี่',dozoom:false, ds:'ADM', autoshowpopup:false, combine:true,fillcolor:"5CB3FF", forcetitle:"กระบี่"});
  mmmap.showObject({id:'จ.พัทลุง;จ.สงขลา',dozoom:false, ds:'ADM', autoshowpopup:false, combine:true,fillcolor:"F88017", forcetitle:"จ.พัทลุง, จ.สงขลา"});
  
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
<div style="color:#F00"></div>
<!--<form action="javascript:">

<table width=100% cellpadding=0 cellspacing=0><tr>
<td>

</td>
<td align=right>
<button onclick="mmmap.removeAllVectors();">Remove all objects</button>
</td>
</tr>
</table>

</td>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%><tr>
<td bgcolor="#cce0fb" style="padding:0px;" valign="bottom" align=left>
</td>
<td bgcolor="#cce0fb" style="padding:0px;" valign="middle" align=right>
</td>
</tr>
</table>

</form>-->
<div id="header"></div>

<div id="mmmap_div" style="position: absolute; left: 310px; top: 160px; width: 800px; height: 500px; border: 0px solid red"></div>
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
			<li><input type="checkbox" name="" value="1" ><span class="red"></span>ระดับความเสี่ยงสูงสุด (Very high)  
            
            <div class="show_sub1"></div>
			
            </li> 
			<li><input type="checkbox" name="" value="2" ><span class="orange"></span>ระดับความเสี่ยงสูง (High) 
            
            <div class="show_sub2"></div>
            
            </li>
			<li><input type="checkbox" name="" value="3" ><span class="yellow"></span>ระดับความเสี่ยงปานกลาง (Moderate)
            
            <div class="show_sub3"></div>
            
            </li>
			<li><input type="checkbox" name="" value="4" ><span class="green"></span>ระดับความเสี่ยงน้อย (Low)
            
            <div class="show_sub4"></div>
            
            </li>
		</ul>
		<div align="center"><input type="submit" name="search" value="ค้นหา" class="Submit" title="ปุ่มค้นหา">
			<input type="submit" name="print" value="พิมพ์" class="Submit" title="ปุ่มพิมพ์">
		</div>
	</div>
    </div>
    
    
</body>
</html>
