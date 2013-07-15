var xmlHttp;

function createXMLHttpRequest(){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			
	}else if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
	}
	return xmlHttp;
}

function ListGroupByArea(){
	xmlHttp = createXMLHttpRequest();
	var objarea_id = document.getElementById("area").value;
	xmlHttp.onreadystatechange = HandleGroupByArea;
	xmlHttp.open("GET", "district/GetGroupByArea?area="+objarea_id, true);
	xmlHttp.send(null);
}
function ListProvinceByGroup(){
	xmlHttp = createXMLHttpRequest();
	var objarea_id = document.getElementById("area").value;
	var objgroup_id = document.getElementById("group").value;
	xmlHttp.onreadystatechange = HandleProvinceByGroup;
	xmlHttp.open("GET", "district/GetProvinceByGroup?group="+objgroup_id+"&area="+objarea_id, true);
	xmlHttp.send(null);
}
function ListAmphurByProvince(){
	xmlHttp = createXMLHttpRequest();
	var objprovince_id = document.getElementById("province").value;
	xmlHttp.onreadystatechange = HandleAmphurByProvince;
	xmlHttp.open("GET", "district/getAmphur?ref1="+objprovince_id+"&class=widthselect&default=ทั้งหมด&event=ListDistrictByAmphur()&name=amphur", true);
	xmlHttp.send(null);
}
function ListDistrictByAmphur(){
	xmlHttp = createXMLHttpRequest();
	var objprovince_id = document.getElementById("province").value;
	var objamphur_id=document.getElementById('amphur').value;
	
	xmlHttp.onreadystatechange = HandleDistrictByAmphur;
	xmlHttp.open("GET", "district/getDistrict?ref1="+objprovince_id+"&ref2="+objamphur_id
																												  +"&class=widthselect&default=ทั้งหมด&event=ListHospitalByDistrict()&name=district", true);
	xmlHttp.send(null);	
}
function ListHospitalByDistrict(){
	xmlHttp = createXMLHttpRequest();
	var objprovince_id = document.getElementById("province").value;
	var objamphur_id = document.getElementById("amphur").value;
	var objdistrict_id=document.getElementById("district").value;
	xmlHttp.onreadystatechange = HandleHospitalByDistrict;
	xmlHttp.open("GET", "hospital/getHospital?ref1="+objprovince_id+"&ref2="+objamphur_id+"&ref3="+objdistrict_id
																													  +"&class=widthselect&default=ทั้งหมด&name=hospital", true);
	xmlHttp.send(null);
}


//Clear Data//
function ClearProvince(){
	xmlHttp2 = createXMLHttpRequest();
	xmlHttp2.onreadystatechange = HandleClearProvince;
	xmlHttp2.open("GET", "district/GetClear?place=province", true);
	xmlHttp2.send(null);
}
function ClearAmphur(){
	xmlHttp3 = createXMLHttpRequest();
	xmlHttp3.onreadystatechange = HandleClearAmphur;
	xmlHttp3.open("GET", "district/GetClear?place=amphur", true);
	xmlHttp3.send(null);
}
function ClearHospital(){
	xmlHttp5 = createXMLHttpRequest();
	xmlHttp5.onreadystatechange = HandleClearHospital;
	xmlHttp5.open("GET", "hospital/GetClearHospital", true);
	xmlHttp5.send(null);
}
function ClearDistrict(){
	xmlHttp6 = createXMLHttpRequest();
	xmlHttp6.onreadystatechange = HandleClearDistrict;
	xmlHttp6.open("GET", "district/GetClear?place=district", true);
	xmlHttp6.send(null);
}
//Clear Data//

function HandleGroupByArea(){
	if(xmlHttp.readyState==4){
		document.getElementById("grouplist").innerHTML = xmlHttp.responseText;
	}
}
function HandleProvinceByGroup(){
	if(xmlHttp.readyState==4){
		document.getElementById("provincelist").innerHTML = xmlHttp.responseText;
	}
}
function HandleAmphurByProvince(){
	if(xmlHttp.readyState==4){
		document.getElementById("amphurlist").innerHTML = xmlHttp.responseText;
	}
}
function HandleDistrictByAmphur(){
	if(xmlHttp.readyState==4){
		document.getElementById('districtlist').innerHTML =xmlHttp.responseText;
	}
}
function HandleHospitalByDistrict(){
	if(xmlHttp.readyState==4){
		document.getElementById("hospitallist").innerHTML = xmlHttp.responseText;
	}
}


//Clear Handle//
function HandleClearProvince(){
	if(xmlHttp2.readyState==4){
		document.getElementById("provincelist").innerHTML = xmlHttp2.responseText;
	}
}
function HandleClearAmphur(){
	if(xmlHttp3.readyState==4){
		document.getElementById("amphurlist").innerHTML = xmlHttp3.responseText;
	}
}
function HandleClearDistrict(){
	if(xmlHttp6.readyState==4){
		document.getElementById("districtlist").innerHTML = xmlHttp6.responseText;
	}
}
function HandleClearHospital(){
	if(xmlHttp5.readyState==4){
		document.getElementById("hospitallist").innerHTML = xmlHttp5.responseText;
	}
}

//Clear Handle//














