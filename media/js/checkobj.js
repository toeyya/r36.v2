function clearid(f)
{
	f.cardW0.value='';
	f.cardW1.value='';
	f.cardW2.value='';
	f.cardW3.value='';
	f.cardW4.value='';
	return true;
}
function chkid(f)
{
		if (f.statusid.value=='1'){
			if(f.cardW0.value==''){
			    alert("กรุณากรอกเลขประจำตัวประชาชนให้ครบถ้วน");
				f.cardW0.focus();
  			    return false;
			}
			if(f.cardW1.value==''){
			   alert("กรุณากรอกเลขประจำตัวประชาชนให้ครบถ้วน");
				f.cardW1.focus();
  			    return false;
			}
			if(f.cardW2.value==''){
			   alert("กรุณากรอกเลขประจำตัวประชาชนให้ครบถ้วน");
				f.cardW2.focus();
  			    return false;
			}
			if(f.cardW3.value==''){
			   alert("กรุณากรอกเลขประจำตัวประชาชนให้ครบถ้วน");
				f.cardW3.focus();
  			    return false;
			}
			if(f.cardW4.value==''){
			    alert("กรุณากรอกเลขประจำตัวประชาชนให้ครบถ้วน");
				f.cardW4.focus();				
  			    return false;
			}
		}
		if (f.statusid.value=='2'){
			if(f.idpassport.value==''){
			    alert("กรุณากรอกเลขที่ passport");
				f.idpassport.focus();		
  			    return false;
			}
		}
		
	return true;
}
function chkhn(f)
{
		if (f.hospitalprovince.value==''){
			  alert("กรุณาเลือกจังหวัด");
			  f.hospitalprovince.focus();
			  return false;
		}
		if (f.hospitalamphur.value==''){
			  alert("กรุณาเลือกอำเภอ");
			  f.hospitalamphur.focus();
			  return false;

		}
		if (f.hospital.value==''){
			  alert("กรุณาเลือกสถานพยาบาล");
			  f.hospital.focus();
  			  return false;

		}
		if (f.hn.value==''){
			  alert("กรุณากรอกรหัสHN");
			  f.hn.focus();
 			  return false;

		}
		if(f.hospitalprovince.value!='' && f.hospitalamphur.value!='' && f.hospital.value!='' && f.hn.value!=''){
		
			var hospital=$('select[name=hospital] option:selected').val();
			var hn=$('input[name=hn]').val();
			var hospitalprovince=$("select[name=hospitalprovince] option:selected").val();
			var hospitalamphur=$('select[name=hospitalamphur] option:selected').val();
			var in_out=$("input[name=in_out]").val();
			var idcard=$('input[name=idcard]').val();
			var statusid=$('input[name=statusid]').val();
			$('#checkerHN').attr('href','inform/chk_hn?hn='+hn+'&hospital='+hospital+'&hospitalprovince='+hospitalprovince+'&hospitalamphur='+hospitalamphur
														 +'&in_out='+in_out+'&idcard='+idcard+'&statusid='+statusid);
			$("#checkerHN").colorbox({iframe:true, innerWidth:500, innerHeight:425, overlayClose: true});
			
			return true;
		}
		
}
function chk_HN(f){
	if (f.hospitalprovince.value==''){
	  alert("กรุณาเลือกจังหวัดของสถานพยาบาล");
	  f.hospitalprovince.focus();
	} else if (f.hospitalamphur.value==''){
	  alert("กรุณาเลือกเขต/อำเภอของสถานพยาบาล");
	  f.hospitalamphur.focus();
	} else if (f.hospital.value==''){
	  alert("กรุณาเลือกสถานพยาบาล");
	  f.hospital.focus();
	} else if (f.hn.value==''){
	  alert("กรุณากรอกHN");
	  f.hn.focus();
	}else {
	  return true;
	}
	return false;
}

function ChkEmail(f){
	if(f.mail.value==''){
	  alert("กรุณากรอก E-mail ของท่าน");
	  f.mail.focus();
  	  return false;
	}
	if(f.mail.value!=''){
		if(chkmail(f.mail)==false){
			alert('กรุณากรอกแบบฟอร์ม E-mail ให้ถูกต้อง');
			f.mail.focus();
			return false;
		}
    }
}


function ChkAddUser(f){
	var radio_choice= false;
	for (counter = 0; counter < f.r_level.length; counter++)
	{
			if (f.r_level[counter].checked){
				radio_choice = true; 
			}
	}
	 if (f.userfirstname.value==''){
	  alert("กรุณากรอกชื่อของท่าน");
	  f.userfirstname.focus();
	  return false;
	} 
	if (f.usersurname.value==''){
	  alert("กรุณากรอกนามสกุลของท่าน");
	  f.usersurname.focus();
  	  return false;

	}
	if(f.usermail.value!=''){
		if(chkmail(f.usermail)==false){
			alert('กรุณากรอกแบบฟอร์ม Email ให้ถูกต้อง');
			f.usermail.focus();
			return false;
		}
    }
	if (!radio_choice){
		alert('กรุณาเลือกระดับตำแหน่งของท่าน');
	    return false;

	}
	if(f.level.value=='02' && f.user_province.value==''){
	  alert("กรุณาเลือกจังหวัด");
	  f.user_province.focus();
	  return false;
	}
	if((f.level.value=='05' || f.level.value=='03' ) && f.h_province.value==''){
	  alert("กรุณาเลือกจังหวัด");
	  f.h_province.focus();
	  	  return false;
	}
	if((f.level.value=='05' || f.level.value=='03' ) && f.h_amphur.value==''){
	  alert("กรุณาเลือกอำเภอ");
	  f.h_amphur.focus();
	  	  return false;
	}
	if((f.level.value=='05' || f.level.value=='03' ) && f.hospital.value==''){
	  alert("กรุณาเลือกสถานพยาบาล");
	  f.hospital.focus();
	  return false;
	}
	if (f.username.value==''){
	  alert("กรุณากรอก username ของท่าน");
	  f.username.focus();
	  return false;
	}
	if (f.userpassword.value==''){
	  alert("กรุณากรอก password ของท่าน");
	  f.userpassword.focus();
	  return false;
	}
	if (f.repassword.value==''){
	  alert("กรุณากรอก password ของท่าน อีกครั้ง");
	  f.repassword.focus();
	  return false;
	}
	if (f.userpassword.value!=f.repassword.value){
	  alert("กรุณากรอก Password กับ Re-password ให้ตรงกัน");
	  f.userfirstname.focus();
	  return false;
	}
}

function ChkEditUser(f){
	 if (f.userfirstname.value==''){
	  alert("กรุณากรอกชื่อของท่าน");
	  f.userfirstname.focus();
	  return false;
	} 
	if (f.usersurname.value==''){
	  alert("กรุณากรอกนามสกุลของท่าน");
	  f.usersurname.focus();
  	  return false;

	}
	if(f.usermail.value!=''){
		if(chkmail(f.usermail)==false){
			alert('กรุณากรอกแบบฟอร์ม E-mail ให้ถูกต้อง');
			f.usermail.focus();
			return false;
		}
    }
	/*if (f.userpassword.value==''){
	  alert("กรุณากรอก password ของท่าน");
	  f.userpassword.focus();
	  return false;
	}
	if (f.repassword.value==''){
	  alert("กรุณากรอก password ของท่าน อีกครั้ง");
	  f.repassword.focus();
	  return false;
	}*/
	if (f.userpassword.value!=f.repassword.value){
	  alert("กรุณากรอก Password กับ Re-password ให้ตรงกัน");
	  f.userfirstname.focus();
	  return false;
	}
}

 function chkmail(chk){
	  if (chk.value.search("^.+@.+\\..+$") != -1){
		   return true;
	  }else{ 
		   return false;
	  }
 }

_editor_url = "js/";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }


function ChkShow(){
	var userposition=$('input[name=userposition]:checked').val()
	if(userposition=='00'){
		 $ ('#pv_level02,#Chk_level03,#Chk_level05,#hospital_level05,#Chk_level04').css('display','none'); 
		 $("#userprovince option[value=''],#h_province option[value=''],#h_amphur option[value=''],#hospital option[value=''],#h_district option[value='']").attr('selected', 'selected');
		 $('#form_add03,#form_edit03,#form_del03').attr('checked',false);		 $('#form_add05,#form_edit05,#form_del05').attr('checked',false);

	}else if(userposition=='01'){
		  $('#pv_level02,#Chk_level03,#Chk_level05,#Chk_level04,#hospital_level05').css('display','none'); 
		  $("#userprovince option[value=''],#h_province option[value=''],#h_amphur option[value=''],#hospital option[value=''],#h_district option[value='']").attr('selected','selected');		  	  
		  $('#form_add03,#form_edit03,#form_del03').attr('checked',false);
		  $('#form_add05,#form_edit05,#form_del05').attr('checked',false);
	}else if(userposition=='02'){
		 $('#pv_level02').css('display',''); 
		 $ ('#Chk_level03,#Chk_level05,#Chk_level04,#hospital_level05').css('display','none');
	 	 $("#h_province option[value=''],#h_amphur option[value=''],#hospital option[value=''],#h_district option[value='']").attr('selected','selected');		  
		 $('#form_add03,#form_edit03,#form_del03').attr('checked',false);
		 $('#form_add05,#form_edit05,#form_del05').attr('checked',false);
	}else if(userposition=='03'){
		$('#pv_level02,#Chk_level05,#Chk_level04').css('display','none'); 		
		$('#Chk_level03,#hospital_level05').css('display','');	
		$("#userprovince option[value=''],#h_province option[value=''],#h_amphur option[value=''],#hospital option[value=''],#h_district option[value='']").attr('selected','selected');					
		$('#form_add05,#form_edit05,#form_del05').attr('checked',false);
	}else if(userposition=='04'){
		$('#pv_level02,#Chk_level03,#Chk_level05,#hospital_level05').css('display','none');
		$('#Chk_level04,#hospital_level05').css('display','');		  
		$("#userprovince option[value=''],#h_province option[value=''],#h_amphur option[value=''],#hospital option[value=''],#h_district option[value='']").attr('selected','selected');
		$('#form_add03,#form_edit03,#form_del03').attr('checked',false);
		$('#form_add05,#form_edit05,#form_del05').attr('checked',false);			  
	}else if(userposition=='05'){
		$('#pv_level02,#Chk_level03,#Chk_level04').css('display','none'); 
		$('#Chk_level05,#hospital_level05').css('display',''); 
		$("#userprovince option[value=''],#h_province option[value=''],#h_amphur option[value=''],#hospital option[value=''],#h_district option[value='']").attr('selected','selected');
		$('#form_add03,#form_edit03,#form_del03').attr('checked',false);
	}else if(userposition=='06'){
	  	$('#pv_level02,#Chk_level03,#Chk_level05,#hospital_level05').css('display','none'); 	  
	  	$("#userprovince option[value=''],#h_province option[value=''],#h_amphur option[value=''],#hospital option[value=''],#h_district option[value='']").attr('selected','selected');
	 	$('#form_add03,#form_edit03,#form_del03').attr('checked',false);
	 	$('#form_add05,#form_edit05,#form_del05').attr('checked',false);
	}	
}

//--------ข้อ1.1 chk age----------
function chk_than15(agechk){
		if(agechk>15){
			 document.getElementById ('occparentsname').value='0'; 
			 document.getElementById ('otheroccparentsname').value=''; 
			 document.form1.occparentsname.disabled=true;
			 document.getElementById ('otheroccparentsname_tr').style.display='none'; 
			 document.getElementById ('occupation_than15').style.display=''; 
			 document.getElementById ('occupation_less15').style.display='none'; 
			 document.getElementById ('occupation_less15').value='0'; 
			 document.getElementById ('occupation_than15').value='0'; 
			 document.getElementById ('otheroccupationname').value=''; 
			 document.getElementById ('otheroccupationname_tr').style.display='none'; 
		}else{
			 document.form1.occparentsname.disabled=false;
			 document.getElementById ('occupation_less15').value='0'; 
			 document.getElementById ('occupation_than15').value='0'; 
			 document.getElementById ('occupation_than15').style.display='none'; 
			 document.getElementById ('occupation_less15').style.display=''; 
			 document.getElementById ('occupation_than15').value=''; 
			 document.getElementById ('otheroccupationname').value=''; 
			 document.getElementById ('otheroccupationname_tr').style.display='none'; 
		}
}

function chk_than1(c){
	if(c.chkage.checked==true){
			 document.form1.age.disabled=true;
			 document.getElementById ('age').value=''; 
			 document.form1.occparentsname.disabled=false;
			 document.getElementById ('occupation_less15').value='0'; 
			 document.getElementById ('occupation_than15').value='0'; 
			 document.getElementById ('occupation_than15').style.display='none'; 
			 document.getElementById ('occupation_less15').style.display=''; 
			 document.getElementById ('occupation_than15').value=''; 
			 document.getElementById ('otheroccupationname').value=''; 
			 document.getElementById ('otheroccupationname_tr').style.display='none'; 
	}else{ 
			 document.form1.age.disabled=false;
	}
}
//------end ข้อ1.1 chk age-------

function show_hide_nationality(c){
	if(c.nationality[0].checked==true){
		document.getElementById("nationality_tr1").style.display='none';
		document.getElementById("nationality_tr2").style.display='none';
		
	}else if(c.nationality[1].checked==true){
		document.getElementById("nationality_tr1").style.display='';
		document.getElementById("nationality_tr2").style.display='';
	}
}
function show_hide_clear_nationality_text(c){
	if(c.value=='11'){
		document.getElementById("nationality_div").style.display='';
	}else{
		document.getElementById("nationality_div").style.display='none';
		document.getElementById("othernationalityname").value='';
	}
}
function show_hide_clear_otheroccupationname(c){
	if(c.value=='21'){
		document.getElementById("otheroccupationname_tr").style.display='';
	}else{
		document.getElementById("otheroccupationname_tr").style.display='none';
		document.getElementById("otheroccupationname").value='';
	}
}
function show_hide_clear_otheroccparentsname(c){
	if(c.value=='19'){
		document.getElementById("otheroccparentsname_tr").style.display='';
	}else{
		document.getElementById("otheroccparentsname_tr").style.display='none';
		document.getElementById("otheroccparentsname").value='';
	}
}
function show_hide_clear_placetouch(c){
	if(c.placetouch[2].checked==true){
		document.getElementById("detailplacetouch_td1").style.display='';
		document.getElementById("detailplacetouch_td2").style.display='none';
		document.getElementById("provinceidplace").value='';
		document.getElementById("amphuridplace").value='';
		document.getElementById("districtidplace").value='';
	}else if(c.placetouch[3].checked==true){
		document.getElementById("detailplacetouch_td1").style.display='none';
		document.getElementById("detailplacetouch_td2").style.display='';
		document.getElementById("provinceidplace").value='';
		document.getElementById("amphuridplace").value='';
		document.getElementById("districtidplace").value='';
	}else{
		document.getElementById("detailplacetouch_td1").style.display='none';
		document.getElementById("detailplacetouch_td2").style.display='none';
		document.getElementById("provinceidplace").value='';
		document.getElementById("amphuridplace").value='';
		document.getElementById("districtidplace").value='';
	}
	for(i=0;i<c.detailplacetouch.length;i++){
		c.detailplacetouch[i].checked = false;
	}
}

function chkvalLogin(c){
		if(c.username.value==''){
			alert('กรุณากรอกชื่อผู้ใช้ ก่อนเข้าสู่ระบบ');
			return false;
		}
		if(c.userpassword.value==''){
			alert('กรุณากรอกรหัสผ่าน ก่อนเข้าสู่ระบบ');
			return false;
		}
}

	function show_hide_clear_typeanimal(c){
		if(c.typeanimal[0].checked==true || c.typeanimal[1].checked==true || c.typeanimal[2].checked==true || c.typeanimal[3].checked==true ||c.typeanimal[4].checked==true){
			document.getElementById("typeotherspan").style.display='none';
			//c.typeother.value='0';
		}else{
			document.getElementById("typeotherspan").style.display='';
		}
	}
	function show_hide_clear_detaindate(c){
		if(c.detain[1].checked==true || c.detain[2].checked==true || c.detain[3].checked==true){
			document.getElementById("detaindatetable").style.display='none';
			c.detaindate[0].checked=false;
			c.detaindate[1].checked=false;
		}else{
			document.getElementById("detaindatetable").style.display='';
		}
	}
	function show_hide_clear_historyvacine(c){
		if(c.historyvacine[0].checked==true || c.historyvacine[1].checked==true || c.historyvacine[2].checked==true){
			document.getElementById("historyvacine_withintable").style.display='none';
			c.historyvacine_within[0].checked=false;
			c.historyvacine_within[1].checked=false;
		}else{
			document.getElementById("historyvacine_withintable").style.display='';
		}
	}
	function show_hide_clear_cousedetail(c){
		if(c.reasonbite[0].checked==true){
			document.getElementById("causedetailtable").style.display='none';
			c.causedetail[0].checked=false;
			c.causedetail[1].checked=false;
			c.causedetail[2].checked=false;
			c.causedetail[3].checked=false;
			c.causedetail[4].checked=false;
			c.causedetail[5].checked=false;
			c.causetext.value='';
			document.getElementById("causetextspan").style.display='none';
		}else{
			document.getElementById("causedetailtable").style.display='';
		}
	}
	function show_hide_clear_causetext(c){
		if(c.causedetail[0].checked==true || c.causedetail[1].checked==true || c.causedetail[2].checked==true || c.causedetail[3].checked==true || c.causedetail[4].checked==true){
			document.getElementById("causetextspan").style.display='none';
			c.causetext.value='';
		}else{
			document.getElementById("causetextspan").style.display='';
		}
	}
	function show_hide_clear_headanimalplace(c){
		if(c.headanimal[0].checked==true){
			document.getElementById("headanimalplacetable").style.display='none';
			document.getElementById("otherheadanimalplacetr").style.display='none';
			c.headanimalplace.value='0';
			c.otherheadanimalplace.value='';
			c.batteria[0].checked=false;
			c.batteria[1].checked=false;
		}else{
			document.getElementById("headanimalplacetable").style.display='';
		}
	}
	function show_hide_clear_otherheadanimalplace(c){
		if(c.value=='34'){
			document.getElementById("otherheadanimalplacetr").style.display='';
		}else{
			document.getElementById("otherheadanimalplacetr").style.display='none';
			document.getElementById("otherheadanimalplace").value='0';
		}
	}

function FChkCardID(me){
 if(!chkIDcard(me.cardW0.value,me.cardW1.value,me.cardW2.value,me.cardW3.value,me.cardW4.value)){
	      alert ('หมายเลขบัตรประชาชนไม่สมบูรณ์ กรุณาตรวจสอบ');
		  me.cardW0.value = '';
		  me.cardW0.focus (); 
		 return false;
	}else{
		return true;
	}

} 

function Chk_AnalyzeReport(c){
	if(c.area.value=='-'){
		alert('กรุณาเลือกรูปแบบเขตความรับผิดชอบในการออกรายงาน');
		return false;
	}
}

function Chk_AnalyzeCause(c){
	if(c.detail_main.value=='-'){
		alert('กรุณาเลือกปัจจัยหลัก');
		return false;
	}
	if(c.detail_minor.value=='-'){
		alert('กรุณาเลือกปัจจัยรอง');
		return false;
	}
	if(c.area.value=='-'){
		alert('กรุณาเลือกรูปแบบเขตความรับผิดชอบในการออกรายงาน');
		return false;
	}
}

function Chk_Analyze5(c){
	if(c.area.value=='-'){
		alert('กรุณาเลือกรูปแบบเขตความรับผิดชอบในการออกรายงาน');
		return false;
	}
	if(c.group.value=='-'){
		alert('กรุณาเลือกข้อมูลรายเขต');
		return false;
	}
	if(c.province.value=='-'){
		alert('กรุณาเลือกจังหวัดในการออกรายงาน');
		return false;
	}
}

function Chk_Analyze_Dead(c){
	if(c.areaonprovince.value==''){
		alert('กรุณาเลือกจังหวัดในการออกรายงาน');
		return false;
	}
}

function Chk_AnalyzeReport6(c){
	if(c.area.value=='-'){
		alert('กรุณาเลือกรูปแบบเขตความรับผิดชอบในการออกรายงาน');
		return false;
	}
	if(c.startmonth.value=='' || c.startyear.value==''){
		alert('กรุณาเลือกตั้งแต่ เดือน ปี');
		return false;
	}
	if(c.endmonth.value=='' || c.endyear.value==''){
		alert('กรุณาเลือกถึง เดือน ปี');
		return false;
	}

}

function ChkExport(c){
	if(c.startdate.value==''){
		alert("กรุณาเลือกวันเริ่มต้น");
		return false;
	}
	if(c.enddate.value==''){
		alert("กรุณาเลือกวันสิ้นสุด");
		return false;
	}
}

function chkIDcard (SubCardID1,SubCardID2,SubCardID3,SubCardID4,SubCardID5){
   var CardID=SubCardID1+SubCardID2+SubCardID3+SubCardID4+SubCardID5;
   		FcardID=(CardID.substr(0,1))*13;
		for(i=1;i<12;i++) {
			subNum = CardID.substr(i,1);
			FcardID=parseInt(FcardID)+ (parseInt(subNum)*(14-(i+1)));
		}
			chk=CardID.substr(CardID.length-1,1);
			temp=11-(parseInt(FcardID)%11);
			temtStr=temp+'';
			chkAnswer=temtStr.substr(temtStr.length-1,1);
		if(parseInt(chk)==parseInt(chkAnswer)) {
			return true;
		} else {
			return false;
		}
}
	function chkFormatNam (str,input) {//0-9
	  strlen = str.length;
	  var amount = '';
	  var dot = 0;
	  for (i=0;i<strlen;i++)
	  {
		  var charCode = str.charCodeAt(i);
		  if (!isNum(charCode)) {
		  	if(charCode=='46'&&dot!=1){
				dot = 1; 
				if(i==0){
					amount = 0;
				}
			} else if(dot==1){
				amount = 0;
			} else{ 
				 alert('โปรดกรอกเป็นตัวเลขเท่านั้น');
				 document.getElementById(input).value='';
				 document.getElementById(input).focus();
				  return false;
			 }
		  }
		  amount += str.charAt(i);
	   }//for
	   document.getElementById(input).value=amount;
	   return true;
	} 
 function isNum (charCode) 
   {
       if (charCode >= 48 && charCode <= 57 )
	       return true;
      else
	     return false;
   }
function NumberOnly()
{
		//alert(event.keyCode);
		if(this.keyCode < 48 || this.keyCode > 57)
			return false;						
}

function selectType_id(type){
	if(type==1){
			document.getElementById ('Show_idpassport').style.display='none'; 
			document.getElementById ('Show_idcard').style.display=''; 
		    //document.getElementById ('idpassport').value=''; 
	}else if(type==2){
			document.getElementById ('Show_idpassport').style.display=''; 
			document.getElementById ('Show_idcard').style.display='none'; 
		    //document.getElementById ('cardW0').value=''; 
		    //document.getElementById ('cardW1').value=''; 
		   // document.getElementById ('cardW2').value=''; 
		    //document.getElementById ('cardW3').value=''; 
		   // document.getElementById ('cardW4').value=''; 
	}
}

var marked_row = new Array;
function setPointer(theRow, theRowNum, theAction, theDefaultColor, thePointerColor, theMarkColor)
{
    var theCells = null;

    // 1. Pointer and mark feature are disabled or the browser can't get the
    //    row -> exits
    if ((thePointerColor == '' && theMarkColor == '') || typeof(theRow.style) == 'undefined') {
        return false;
    }

    // 2. Gets the current row and exits if the browser can't get it
    if (typeof(document.getElementsByTagName) != 'undefined') {
        theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        theCells = theRow.cells;
    }
    else {
      return false;
    }
	
    // 3. Gets the current color...
    var rowCellsCnt  = theCells.length;
    var domDetect    = null;
    var currentColor = null;
    var newColor     = null;
    // 3.1 ... with DOM compatible browsers except Opera that does not return
    //         valid values with "getAttribute"
    if (typeof(window.opera) == 'undefined' && typeof(theCells[0].getAttribute) != 'undefined') {
        currentColor = theCells[0].getAttribute('bgcolor');
        domDetect    = true;
    }
    // 3.2 ... with other browsers
    else {
        currentColor = theCells[0].style.backgroundColor;	
        domDetect    = false;
    } // end 3
	
    // 4. Defines the new color
    // 4.1 Current color is the default one

  if (currentColor == '' ) {		 	  
			if (theAction == 'over' && thePointerColor != '') {
				newColor              = thePointerColor;
			}
			else if (theAction == 'click' && theMarkColor != '') {
				newColor              = theMarkColor;
				marked_row[theRowNum] = true;
			}	  
		
    }
    // 4.1.2 Current color is the pointer one
	else if(currentColor!=null  && currentColor !='' && currentColor!='undefined')
	{
			 if (currentColor.toLowerCase() == thePointerColor.toLowerCase() && (typeof(marked_row[theRowNum]) == 'undefined' || !marked_row[theRowNum])) {
					if (theAction == 'out') {
						newColor              = theDefaultColor;
					}
					else if (theAction == 'click' && theMarkColor != '') {
						newColor              = theMarkColor;
						marked_row[theRowNum] = true;
					}
			}else if(currentColor.toLowerCase() == theDefaultColor.toLowerCase()){			  
						if (theAction == 'over' && thePointerColor != '') {
							newColor              = thePointerColor;
						}
						else if (theAction == 'click' && theMarkColor != '') {
							newColor              = theMarkColor;
							marked_row[theRowNum] = true;
						}	  			
			}
			// 4.1.3 Current color is the marker one
			else if (currentColor.toLowerCase() == theMarkColor.toLowerCase()) {
				if (theAction == 'click') {
					newColor              = (thePointerColor != '')
										  ? thePointerColor
										  : theDefaultColor;
					marked_row[theRowNum] = (typeof(marked_row[theRowNum]) == 'undefined' || !marked_row[theRowNum])
										  ? true
										  : null;
				}
			} // end 4
	
	}

    // 5. Sets the new color...
    if (newColor) {
        var c = null;
        // 5.1 ... with DOM compatible browsers except Opera
        if (domDetect) {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].setAttribute('bgcolor', newColor, 0);
            } // end for
        }
        // 5.2 ... with other browsers
        else {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].style.backgroundColor = newColor;
            }
        }
    } // end 5

    return true;
} // end of the 'setPointer()' function

function show_mark(red, pink, darkgreen, lightgreen, darkblue, lightblue, show) {//รูป คน ที่ ติ๊ก หรือไม่ติ๊ก
//alert("show ="+show);
	if(red==true){
		show.innerHTML = "<img src='images/checkred.gif' width='12' height='12'>";
	}else{
		if(pink==true){
			show.innerHTML = "<img src='images/checkpink.gif' width='12' height='12'>";
		}else{
			if(darkgreen==true){
				show.innerHTML = "<img src='images/checkdarkgreen.gif' width='12' height='12'>";
			}else{
				if(lightgreen==true){
					show.innerHTML = "<img src='images/checklightgreen.gif' width='12' height='12'>";
				}else{
					if(darkblue==true){
						show.innerHTML = "<img src='images/checkdarkblue.gif' width='12' height='12'>";
					}else{
						if(lightblue==true){
							show.innerHTML = "<img src='images/checklightblue.gif' width='12' height='12'>";
						}else{
							show.innerHTML = "";
						}
					}
				}
			}
		}
	}
	/*if(value == true){
		show.style.display = ""
	} else {
		show.style.display = "none";
	}*/
}

	function show_hide_clear_washbefore(c){//ข้อ 4.1
		if(document.getElementsByName('washbefore')[0].checked==true){
			document.getElementById("washbeforetr").style.display='none';
			c.washbeforetext.value='';
			c.washbeforedetail[0].checked=false;
			c.washbeforedetail[1].checked=false;
			c.washbeforedetail[2].checked=false;
		}else{
			document.getElementById("washbeforetr").style.display='';
		}
	}
	
	function show_hide_clear_washbeforedetail(c){
		if(c.washbeforedetail[2].checked==true){
			document.getElementById("washbeforedetailtd").style.display='';
		}else{
			document.getElementById("washbeforedetailtd").style.display='none';
			c.washbeforetext.value='';
		}
	}//end ข้อ4.1

	function show_hide_clear_putdrug(c){ //ข้อ 4.2
		if(document.getElementsByName('putdrug')[0].checked==true){
			document.getElementById("putdrugtr").style.display='none';
			c.putdrugtext.value='';
			c.putdrugdetail[0].checked=false;
			c.putdrugdetail[1].checked=false;
			c.putdrugdetail[2].checked=false;
		}else{
			document.getElementById("putdrugtr").style.display='';
		}
	}
	
	function show_hide_clear_putdrugdetail(c){		
		if(document.getElementsByName('putdrugdetail')[2].checked==true){
			document.getElementById("putdrugdetailtr").style.display='';
		}else{
			document.getElementById("putdrugdetailtr").style.display='none';
			document.getElementById('putdrugtext').value='';
		}
	}//end ข้อ 4.2

function show_hide_clear_historyprotect(c){ //ข้อ 4.3
		if(c.historyprotect[0].checked==true){
			document.getElementById("historyprotecttr").style.display='none';
			c.historyprotectdetail[0].checked=false;
			c.historyprotectdetail[1].checked=false;
		}else{
			document.getElementById("historyprotecttr").style.display='';
		}
	}//end ข้อ 4.3

function show_hide_clear_use_rig(c){//ข้อ 5.1 
	if(c.use_rig[0].checked==true){
		document.getElementById("use_rigtr1").style.display='none';
		document.getElementById("use_rigtr2").style.display='none';
		document.getElementById("use_rigtr3").style.display='none';
		document.getElementById("use_rigtr4").style.display='none';
		document.getElementById("use_rigtr5").style.display='none';
		document.getElementById("after_rigtr").style.display='none';
		document.getElementById("otherafter_rigdetail7").style.display='none';
		c.after_rigdetail1.checked=false;
		c.after_rigdetail2.checked=false;
		c.after_rigdetail3.checked=false;
		c.after_rigdetail4.checked=false;
		c.after_rigdetail5.checked=false;
		c.after_rigdetail6.checked=false;
		c.after_rigdetail7.checked=false;
		c.after_rigtext.value='';
		c.datelongfeel.value='';
		c.cure_comment.value='';
		c.longfeel[0].checked=false;
		c.longfeel[1].checked=false;
		c.erig_hrig[0].checked=false;
		c.erig_hrig[1].checked=false;
		c.erig_no.value='';
		c.hrig_no.value='';
		
		c.quantityiu.value='';
		c.weight_patient.value='';
		c.daterig.value='';
	}else{
		document.getElementById("use_rigtr1").style.display='';
		document.getElementById("use_rigtr2").style.display='';
		document.getElementById("use_rigtr3").style.display='';
		document.getElementById("use_rigtr4").style.display='';
		document.getElementById("use_rigtr5").style.display='';
	}
}

function show_hide_clear_after_rig(c){
	if(c.after_rig[0].checked==true){
		document.getElementById("after_rigtr").style.display='none';
		document.getElementById("otherafter_rigdetail7").style.display='none';
		c.after_rigdetail1.checked=false;
		c.after_rigdetail2.checked=false;
		c.after_rigdetail3.checked=false;
		c.after_rigdetail4.checked=false;
		c.after_rigdetail5.checked=false;
		c.after_rigdetail6.checked=false;
		c.after_rigdetail7.checked=false;
		c.after_rigtext.value='';
		c.datelongfeel.value='';
		c.cure_comment.value='';
		c.longfeel[0].checked=false;
		c.longfeel[1].checked=false;
	}else{
		document.getElementById("after_rigtr").style.display='';
		document.getElementById("otherafter_rigdetail7").style.display='none';
		c.after_rigtext.value='';
		c.datelongfeel.value='';
		c.cure_comment.value='';
		c.longfeel[0].checked=false;
		c.longfeel[1].checked=false;
	}
}
function show_hide_clear_after_rigdetail7(c){
	if(c.after_rigdetail7.checked==true){
		document.getElementById("otherafter_rigdetail7").style.display='';
	}else{ 
		document.getElementById("otherafter_rigdetail7").style.display='none';
		c.after_rigtext.value='';
	}
}
function show_hide_clear_erig_hrig(c){
	//alert("show_hide_clear_erig_hrig="+c.erig_hrig[1].checked);
		if(c.erig_hrig[0].checked==true){
			document.getElementById("erig_hrig_input_box_patient 1").style.display='';
			document.getElementById("erig_hrig_input_box_patient 2").style.display='none';
			c.hrig_no.value='';
		}else{
			document.getElementById("erig_hrig_input_box_patient 1").style.display='none';
			document.getElementById("erig_hrig_input_box_patient 2").style.display='';
			c.erig_no.value='';
		}
}
function check_ui(check) {//CHK ปริมาณที่ฉีด
	if(confirm("คุณแน่ใจว่าต้องการกรอกข้อมูลนี้ใช่หรือไม่?")) {
		check.value = check.value
	} else {
		check.value = ""
		check.focus();
	}
}


//end 5.1
function increment_vaccine_date(datetouch,i){
	var dmy=datetouch.split("/");	

	var today=new Date(dmy[2]-543,dmy[1]-1,dmy[0]);		
	switch(i){
		case 0:
			return datetouch;			
		case 1:
			today.setDate(today.getDate()+3);		
			break;
		case 2:   
			today.setDate(today.getDate()+7);		
			break;
		case 3:
			today.setDate(today.getDate()+14);	
			break;
		case 4:
			today.setDate(today.getDate()+30);	
			break;

	}// switch
			var dd = today.getDate();
			var mm = today.getMonth() +1;
			var y = today.getFullYear()+543;
			var tomorrow = dd + '/' + mm + '/' + y;
			return tomorrow;
}
 function show_hide_clear_means(c){ //ข้อ 5.2
		if(c.means[2].checked==true){
				document.getElementById("meanstr").style.display='none';
				document.getElementById('after_symptom_vaccine').style.display='none';
				for(clear=0;clear<5;clear++){
					document.getElementById("vaccine_date["+clear+"]").value='';
					document.getElementById("vaccine_name["+clear+"]").value='0';
					document.getElementById("vaccine_no["+clear+"]").value='';
					document.getElementById("vaccine_cc["+clear+"]").value='';
					document.getElementById("vaccine_point["+clear+"]").value='';
					document.getElementById("byname["+clear+"]").value='';
					//document.getElementById("byplace["+clear+"]").value='';
				}
		}else{
			document.getElementById("meanstr").style.display='';
			document.getElementById('after_symptom_vaccine').style.display='';
					for(clear=0;clear<5;clear++){
						if(document.getElementById("vaccine_date["+clear+"]").value==""){						
									var tomorrow=increment_vaccine_date(c.datetouch.value,clear);	
									document.getElementById("vaccine_date["+clear+"]").value=tomorrow;	
						}// vaccine_date==""
					}//for
		}//means
	}//function
 function show_hide_means(c){ //ข้อ 5.2
		if(c.means[2].checked==true){
				document.getElementById("meanstr").style.display='none';
				document.getElementById('after_symptom_vaccine').style.display='none';
		}else{
			document.getElementById("meanstr").style.display='';
			document.getElementById('after_symptom_vaccine').style.display='';
			
		}
	}

function check_point(check) {//CHK จุดที่ฉีด
	if(confirm("คุณแน่ใจว่าต้องการกรอกข้อมูลจุดที่ฉีดนี้ใช่หรือไม่?")) {
		check.value = check.value
	} else {
		check.value = ""
		check.focus();
	}
}

function show_hide_after_vaccine(c){
	if(c.after_vaccine[0].checked==true){
		document.getElementById("after_vaccinetr").style.display='none';
		document.getElementById("otherafter_vaccinedetail7").style.display='none';
		c.after_vaccine_detail1.checked=false;
		c.after_vaccine_detail2.checked=false;
		c.after_vaccine_detail3.checked=false;
		c.after_vaccine_detail4.checked=false;
		c.after_vaccine_detail5.checked=false;
		c.after_vaccine_detail6.checked=false;
		c.after_vaccine_detail7.checked=false;
		c.after_vaccine_text.value='';
		c.after_vaccine_date.value='';
		c.after_vaccine_cure_comment.value='';
	}else{
		document.getElementById("after_vaccinetr").style.display='';
		document.getElementById("otherafter_vaccinedetail7").style.display='none';
		c.after_vaccine_text.value='';
		c.after_vaccine_date.value='';
		c.after_vaccine_cure_comment.value='';
	}
}
function show_hide_after_vaccinedetail7(c){
	if(c.after_vaccine_detail7.checked==true){
		document.getElementById("otherafter_vaccinedetail7").style.display='';
	}else{ 
		document.getElementById("otherafter_vaccinedetail7").style.display='none';
		c.after_vaccine_text.value='';
	}
}
//-----chk_vaccine 5--------
function check_vaccine_cc(type,v_n,cc,num){ 
	if(type==1){
			if(v_n==1){
						if(cc>0.5){
								if(confirm("คุณแน่ใจว่าต้องการกรอกข้อมูลนี้ใช่หรือไม่?")) {
										document.getElementById('vaccine_cc['+num+']').value=cc;
								} else {
										document.getElementById('vaccine_cc['+num+']').value = "";
										document.getElementById('vaccine_cc['+num+']').focus();
								}
						}else if (cc==''){
							alert('กรุณากรอกขนาด(c.c)');
						}
			}else if(v_n!=1 && v_n!='0'){
						if(cc>1){
								if(confirm("คุณแน่ใจว่าต้องการกรอกข้อมูลนี้ใช่หรือไม่?")) {
										document.getElementById('vaccine_cc['+num+']').value=cc;
								} else {
										document.getElementById('vaccine_cc['+num+']').value = "";
										document.getElementById('vaccine_cc['+num+']').focus();
								}
						}else if (cc==''){
							alert('กรุณากรอกขนาด(c.c)');
						}
			}else if(v_n=='0'){
					alert('กรุณาเลือกชนิดวัคซีน');
			}
	}else if(type==2){
			if(v_n==4){
						if(cc>0){
								if(confirm("คุณแน่ใจว่าต้องการกรอกข้อมูลนี้ใช่หรือไม่?")) {
										document.getElementById('vaccine_cc['+num+']').value=cc;
								} else {
										document.getElementById('vaccine_cc['+num+']').value = "";
										document.getElementById('vaccine_cc['+num+']').focus();
								}
						}
			}else if(v_n!=4 && v_n!='0'){
						if(cc>0.1){
								if(confirm("คุณแน่ใจว่าต้องการกรอกข้อมูลนี้ใช่หรือไม่?")) {
										document.getElementById('vaccine_cc['+num+']').value=cc;
								} else {
										document.getElementById('vaccine_cc['+num+']').value = "";
										document.getElementById('vaccine_cc['+num+']').focus();
								}
						}else if (cc==''){
							alert('กรุณากรอกขนาด(c.c)');
						}
			}else if(v_n=='0'){
					alert('กรุณาเลือกชนิดวัคซีน');
			}
	}
}//----end chk_vaccine 5--------
//end ข้อ 5.2

function show_hide_closecase_reason(c){//ข้อ 5.3
	if(c.closecase_reason[2].checked==true){
		document.getElementById("closecase_reasontr").style.display='';
	}else{ 
		document.getElementById("closecase_reasontr").style.display='none';
		c.closecase_reason_detail1.checked=false;
		c.closecase_reason_detail2.checked=false;
	}
}

function show_hide_closecase(c){
	if(c.closecase[0].checked==true){
		document.getElementById("closecasetr").style.display='none';
		c.closecase_reason_detail1.checked=false;
		c.closecase_reason_detail2.checked=false;
		c.closecase_reason[0].checked=false;
		c.closecase_reason[1].checked=false;
		c.closecase_reason[2].checked=false;
	}else{ 
		document.getElementById("closecasetr").style.display='';
		c.closecase_reason_detail1.checked=false;
		c.closecase_reason_detail2.checked=false;
	}
}

function show_hide_closecase_chk(c){
	if(c.closecase[0].checked==true){
		document.getElementById("closecasetr").style.display='none';
		c.closecase_reason_detail1.checked=false;
		c.closecase_reason_detail2.checked=false;
		c.closecase_reason[0].checked=false;
		c.closecase_reason[1].checked=false;
		c.closecase_reason[2].checked=false;
	}else{ 
		document.getElementById("closecasetr").style.display='';
		c.closecase_reason_detail1.checked=false;
		c.closecase_reason_detail2.checked=false;
	}
}
//end 5.3

//-------alert form-------------
function chkValid(f){
		if (f.hospitalprovince.value==''){
			  alert("กรุณาเลือกจังหวัด");
			  f.hospitalprovince.focus();
		} else if (f.hospitalamphur.value==''){
			  alert("กรุณาเลือกอำเภอ");
			  f.hospitalamphur.focus();
		}else if (f.hospital.value==''){
			  alert("กรุณาเลือกสถานพยาบาล");
			  f.hospital.focus();
		}else if (f.hn.value==''){
			  alert("กรุณากรอกรหัสHN");
			  f.hn.focus();
		}else if (f.firstname.value==''){
			  alert("กรุณากรอกชื่อ");
			  f.firstname.focus();
		}else if (f.surname.value==''){
			  alert("กรุณากรอกนามสกุล");
			  f.surname.focus();
		}else if (f.telephone.value==''){
			  alert("กรุณากรอกเบอร์โทรศัพท์");
			  f.telephone.focus();
		}else if (f.doctorname.value==''){
			  alert("กรุณากรอกชื่อแพทย์ผู้สั่งการรักษา");
			  f.doctorname.focus();
		} else if (f.reportname.value==''){
			  alert("กรุณากรอกชื่อผู้รายงาน");
			  f.reportname.focus();
		} else if (f.positionname.value==''){
			  alert("กรุณากรอกตำแหน่ง");
			  f.positionname.focus();
		}else if (f.reportdate.value==''){
			  alert("กรุณาเลือกวันที่รายงานจากปฎิทิน");
			  f.reportdate.focus();
		} else {
			return true;
		}
		return false;
	}
//-----end alert form------
//------chk form inform hn----

//-----end-chk form inform hn----

//------chk form inform id----

//-----end-chk form inform id----

//------chk form คนตาย------
function chk_dead1(c){
	if(c.chk_age.checked==true){
			 document.form1.age.disabled=true;
			 document.getElementById ('age').value=''; 
	}else{ 
			 document.form1.age.disabled=false;
	}
}
//----end chk form คนตาย---

//--alert chk_form คนตาย----
function chkFormDead(f){
		if (f.firstname.value==''){
			  alert("กรุณากรอกชื่อ");
			  f.firstname.focus();
		} else if (f.surname.value==''){
			  alert("กรุณากรอกนามสกุล");
			  f.surname.focus();
		} else if (f.nohome.value==''){
			  alert("กรุณากรอกเลขที่");
			  f.nohome.focus();
		}else if (f.provinceid.value==''){
			  alert("กรุณาเลือกจังหวัด");
			  f.provinceid.focus();
		}else if (f.amphurid.value==''){
			  alert("กรุณาเลือกอำเภอ");
			  f.amphurid.focus();
		}else if (f.districtid.value==''){
			  alert("กรุณาเลือกตำบล");
			  f.districtid.focus();
		}else if (f.provinceidplace.value==''){
			  alert("กรุณาเลือกจังหวัดที่ได้รับเชื้อ");
			  f.provinceidplace.focus();
		}else if (f.amphuridplace.value==''){
			  alert("กรุณาเลือกอำเภอที่ได้รับเชื้อ");
			  f.amphuridplace.focus();
		}else if (f.districtidplace.value==''){
			  alert("กรุณาเลือกตำบลที่ได้รับเชื้อ");
			  f.districtidplace.focus();
		}else if (f.enddate.value==''){
			  alert("กรุณาเลือกวันที่ถึงแก่กรรม");
			  f.enddate.focus();
		}else if (f.reportname.value==''){
			  alert("กรุณากรอกชื่อผู้รายงาน");
			  f.reportname.focus();
		}else if (f.positionname.value==''){
			  alert("กรุณากรอกตำแหน่งผู้รายงาน");
			  f.positionname.focus();
		}else if (f.telname.value==''){
			  alert("กรุณากรอกเบอร์โทรศัพท์ผู้รายงาน");
			  f.telname.focus();
		}else {
			return true;
		}
		return false;
	}
//-end alert chk_form คนตาย-
//------chk_in_out_closecase-----
function show_hide_closecase(){
	if(document.getElementById ('hospitalprovince').value!=document.getElementById ('provinceid').value){
			document.getElementById("closecasemaintr").style.display='none';
	}else{
		if(document.getElementById ('hospitalamphur').value!=document.getElementById ('amphurid').value){
			document.getElementById("closecasemaintr").style.display='none';
		}else{
			document.getElementById("closecasemaintr").style.display='';
		}
	}
}
//---end chk_in_out_closecase---
//--chk_historydead--------
	function show_hide_clear_vaccine_h(c){
		if(c.vaccine_h[1].checked==true){
			document.getElementById("vaccine_table").style.display='none';
			c.erig_hrig[0].checked=false;
			c.erig_hrig[1].checked=false;
		}else{
			document.getElementById("vaccine_table").style.display='';
		}
	}
	function show_hide_clear_vaccinedead(c){
		if(c.vaccine[1].checked==true){
			document.getElementById("vaccine_1").style.display='none';
			c.vaccine_text.value='';
			c.vaccine_date.value='';
		}else{
			document.getElementById("vaccine_1").style.display='';
		}
	}
	function show_hide_clear_status(c){
		if(c.statusanimal[0].checked==true){
			document.getElementById("statusanimal_table").style.display='';			
		}else{		
			document.getElementById("statusanimal_table").style.display='none';
			c.statusanimal_detail[0].checked=false;
			c.statusanimal_detail[1].checked=false;
		}
	}
	function show_hide_clear_ans_exam(c){
		if(c.ans[1].checked==true){
			document.getElementById("ans_exam").style.display='none';
			c.exam.value='';
		}else{
			document.getElementById("ans_exam").style.display='';
		}
	}

	function show_hide_clear_batteria(c){
		if(c.headsend[1].checked==true){
			document.getElementById("batteria_table").style.display='';
		}else{
			document.getElementById("batteria_table").style.display='none';
			c.batteria[0].checked=false;
			c.batteria[1].checked=false;
		}
	}
//-end-chk_historydead--------
///------inform_hn------------
function show_hide_id(c){
	if(c.chk_idhn[0].checked==true){
		document.getElementById("span_hn").style.display='';
		document.getElementById("span_id").style.display='none';
		document.getElementById("idpassport").value='';
		document.getElementById("cardW0").value='';
		document.getElementById("cardW1").value='';
		document.getElementById("cardW2").value='';
		document.getElementById("cardW3").value='';
		document.getElementById("cardW4").value='';
	
	}else if(c.chk_idhn[1].checked==true){
		document.getElementById("span_hn").style.display='none';
		document.getElementById("span_id").style.display='';
		document.getElementById("hn").value='';
		
	}
}
///------ end inform hn

