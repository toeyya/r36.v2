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

        
        <style type="text/css">
            /*style สำหรับจัดรูปแบบของแผนที่*/
            #mmMapDiv{
                position:absolute;
                left:310px;
                top:200px;
            }
        </style>
        <script
            type="text/javascript"
            src="http://mmmap15.longdo.com/mmmap/mmmap.php?key=18b1fbbda1f980b4e368c631a3d317ea">
        </script>
        <script type="text/javascript">

            //ตัวแปรเพื่อใช้อ้างอิงไปยัง map object
            var mmmap;

            //function initialize สำหรับสร้าง map object
            function initialize(){
                var mmMapDiv = document.getElementById("mmMapDiv");
                mmmap = new MMMap(mmMapDiv, 13.708795,100.386241, 14, "traffic");

                //ปรับขนาดของแผนที่ให้กว้าง 600 px และสูง 600 px ด้วย method setSize ของ map object
                mmmap.setSize(860,500);
                //เปลี่ยนจุดศูนย์กลางของแผนที่มายังจุดเริ่มต้น
                mmmap.moveTo(13.708795,100.386241);
                //ปรับระดับการ zoom ของแผนที่เป็นค่าเริ่มต้น
                mmmap.setZoom(14);
                //ทำการแสดงผลแผนที่ใหม่ -เพื่อปรับปรุงการแสดงผลของแผนที่ให้ถูกต้อง
                mmmap.rePaint();

                //สร้าง user-defined div แบบแสดงข้อความแหน่งบ้านของ Mr A และเก็บค่า id ของ user-defined div ไว้ในตัวแปร userDivIdA
                var userDivIdA = createUserDivImage(13.686874,100.425611,
                "<?php echo base_url(); ?>themes/map/media/images/hospital.png",
                "โรงพยาบาล เอก อัมมรินทร์,  จำนวน ผู้ ป่วย ที่ ถูก กัด 25 คน อยู่ใน พื่นที่ ความเสี่ยงพอประมาณ");

                //สร้าง user-defined div แบบแสดงรูปภาพตำแหน่งบ้านของ Ms B
                //และเก็บค่า id ของ user-defined div ไว้ในตัวแปร userDivIdB
                var userDivIdB = createUserDivImage(13.708795,100.386241,
                "<?php echo base_url(); ?>themes/map/media/images/hospital.png",
                "คลีนิคอนุรักษณ์ เมตตาสัตว์,  จำนวน ผู้ ป่วย ที่ ถูก กัด 25 คน อยู่ใน พื่นที่ ความเสี่ยงพอประมาณ");
   
                //สร้าง user-defined div แบบแสดงรูปภาพตำแหน่งบ้านของ Mr C
                //และเก็บค่า id ของ user-defined div ไว้ในตัวแปร userDivIdC
                var userDivIdC = createUserDivImage(13.710338,100.398622,
                "<?php echo base_url(); ?>themes/map/media/images/hospital.png",
                "โรงพยาบาล เกษมราษฏร์ ,  จำนวน ผู้ ป่วย ที่ ถูก กัด 25 คน อยู่ใน พื่นที่ ความเสี่ยงพอประมาณ");
            }

            //function createUserDivImage เพื่อสร้าง user-defined div ที่มีรูปภาพอยู่ภายใน
            function createUserDivImage(latitude, longitude, imageURL, description){
                //สร้าง div element
                var divElement = document.createElement("div");
                //สร้าง img element
                var imgElement = document.createElement("img");
                imgElement.setAttribute("src", imageURL);
                divElement.appendChild(imgElement);
                // **** เรียกใช้ method drawCustomDiv ของ map object (mmmap) เพื่อวาด user-defined div ลงบนแผนที่
                //และเก็บค่า id ของ user-defined div ไว้ในตัวแปร userDivId
                var userDivId = mmmap.drawCustomDiv(divElement,latitude, longitude,description);
                return userDivId;
            }
        </script>

    </head>
   <body onload="initialize()">
    	<div id="header"></div>
        <div id="mmMapDiv"></div>
        
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