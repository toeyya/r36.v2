<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=3.11&amp;key=AIzaSyCbZ3C2tIqbRbftg_smA1mmPw9TfWJYqNk&sensor=true_or_false"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=th-TH"></script>
<script type="text/javascript">
      var geocoder;
	  var map;
	  var infowindow = new google.maps.InfoWindow();
	  var marker;
	  function initialize() {
	        geocoder = new google.maps.Geocoder();
	        var latlng = new google.maps.LatLng(15.432501,100.806884);
	        var mapOptions = {
	          zoom: 6,
	          center: latlng,
	          mapTypeId: 'roadmap'
	        }
	        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);		      
	  	
		  	/*google.maps.event.addListener(map, 'click', function(event) {
	    				placeMarker(event.latLng);
	 		 });*/	
	   		   	  		 
		 	 // Add 5 markers to the map at target locations.
			  var lat=[18.701224,9.497690,6.148097,14.393248,13.092678,17.431759,17.206392,13.719138];
			  var lng=[98.789770,99.961275,101.223482,100.518009,101.241729,103.841824,104.309393,100.576031];
			  var image=[1,4,1,2,3,1,1,4];
			  for (var i = 0; i < 8; i++) {
				    var location = new google.maps.LatLng(lat[i],lng[i]);
					placeMarker(location,image[i],i);
					
			  }
		    
		}
		google.maps.event.addDomListener(window, 'load', initialize);	
		function customMarker(i){
			switch(i){
				case 1 : icon="pin_red.png"; 		break;
				case 2 : icon='pin_orange.png';	break;
				case 3 : icon='pin_yellow.png';	break;
				case 4 : icon='pin_green.png';		break;
			}			
			var image = new google.maps.MarkerImage( '<?php echo base_url() ?>images/maps/'+icon,
			    				  new google.maps.Size(24,24),    // size of the image
			    				  new google.maps.Point(0,0), // origin, in this case top-left corner
			    				  new google.maps.Point(9, 25)    // anchor, i.e. the point half-way along the bottom of the image
			);
			return image;
		}
		function placeMarker(location,i,order) {
			  var image=customMarker(i);
			  marker = new google.maps.Marker({
			      position: location,
			      map: map,
			      icon:image
			  });		
			  map.setCenter(location);
			  attachSecretMessage(marker, order);
		}
		// The five markers show a secret message when clicked
		// but that message is not within the marker's instance data.
		function attachSecretMessage(marker, number) {
			  var message = ["จ.เชียงใหม่","เกาะสมุย จ.สุราษฎร์ธานี","จ.ยะลา","จ.อยุธยา","จ.ชลบุรี","อ. โพนาแก้ว จ.สกลนคร","อ.เมืองนครพนม จ.นครพนม","คลองเตย กรุงเทพฯ"];
			  var infowindow = new google.maps.InfoWindow(
			      { content: message[number],
			        size: new google.maps.Size(20,40)
			      });
			  google.maps.event.addListener(marker, 'click', function() {
			    infowindow.open(map,marker);
			  });
		}	
		
</script>		
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
					<option value="">สุพรรณบุรี</option>
					<option value="">สระบุรี</option>					
					<option value="">อ่าทอง</option>
					</select>
				</span>
			
			</li>
			<li><label>อำเภอ</label><span id="amphurlist">
				<select name="amphur" class="textbox widthselect">
					<option value="">ทั้งหมด</option>
					<option value="">ไก่เส้า</option>
				</select>
				</span></li>
			<li><label>ตำบล</label><span id="districtlist"><select name="district" class="textbox widthselect">
				<option value="">ทั้งหมด</option>
				<option value="">ไก่เส้า</option>
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
			<li><input type="checkbox" name="" value="1" checked="checked"><span class="red"></span>จำนวนผู้สัมผัสโรคระหว่าง 150-200</li>
			<li><input type="checkbox" name="" value="2" checked="checked"><span class="orange"></span>จำนวนผู้สัมผัสโรคระหว่าง 100-149</li>
			<li><input type="checkbox" name="" value="3" checked="checked"><span class="yellow"></span>จำนวนผู้สัมผัสโรคระหว่าง 50-99</li>
			<li><input type="checkbox" name="" value="4" checked="checked"><span class="green"></span>จำนวนผู้สัมผัสโรคระหว่าง 0-49</li>
		</ul>
		<div align="center"><input type="submit" name="search" value="ค้นหา" class="Submit" title="ปุ่มค้นหา"></div>
	</div>		
	<div class="canvas" id="map_canvas"></div>
	</div>
