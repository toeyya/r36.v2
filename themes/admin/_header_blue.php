<div id="head"></div>
<div id="head_bar">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="65%"  bgcolor="#0099cc" height="20" nowrap="nowrap">			  
					<? if($this->session->userdata('R36_UID')){?>
					<script type="text/javascript" language="JavaScript1.2">
						
						stm_bm(["tubtehr",430,"","menu/blank.gif",0,"","",0,0,0,0,0,1,0,0,"","",0],this);
						stm_bp("p0",[0,4,0,0,0,2,16,0,100,"",-2,"",-2,90,0,0,"#000000","transparent","",3,0,0,"#ffffff"]);
						stm_ai("p0i0",[0,"หน้าแรก ","","",-1,-1,0,"user/index","_self","","","menu/home.gif","menu/home.gif",16,16,0,"","",0,0,0,0,1,"#0099cc",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000","8pt 'Courier New','Courier'","8pt 'Courier New','Courier'",0,0]);
						stm_ai("p0i1",[6,1,"#cccccc","",0,0,0]);
						<? if($this->session->userdata('R36_LEVEL')=='00' ||  $this->session->userdata('R36_LEVEL')=='01' ||  $this->session->userdata('R36_LEVEL')=='02' || $this->session->userdata('R36_LEVEL')=='03' || 
								($this->session->userdata('R36_LEVEL')=='05' && $this->session->userdata('R36_FROMADD')=='Y')){?>
						stm_aix("p0i2","p0i0",[0,"กรอกแบบฟอร์ม ","","",-1,-1,0,"","_self","","","menu/form_blue.gif","menu/form_blue.gif"]);
						<? } ?>
						stm_bp("p1",[1,4,0,0,0,3,16,0,100,"",-2,"",-2,60,0,0,"#000000","#ffffff","",3,1,1,"#73a8b7"]);
						stm_aix("p1i0","p0i0",[0,"แบบฟอร์มคนไข้ที่สัมผัสโรค(ในเขต)","","",-1,-1,0,"inform/hn/1","_self","","","menu/form_blue.gif","menu/form_yellow.gif",-1,-1,0,"","",0,0,0,0,1,"#FFFF99",0,"#FFCC00",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff"]);
						stm_aix("p1i0","p0i0",[0,"แบบฟอร์มคนไข้ที่สัมผัสโรค(นอกเขต)","","",-1,-1,0,"inform/hn/2","_self","","","menu/form_blue.gif","menu/form_blue.gif",-1,-1,0,"","",0,0,0,0,1,"#ebf8ff",0,"#0099cc",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff"]);
						<? if($this->session->userdata('R36_LEVEL')=='00' || $this->session->userdata('R36_LEVEL')=='01' || $this->session->userdata('R36_LEVEL')=='02' ){?>
						stm_aix("p1i1","p0i0",[0,"แบบฟอร์มคนไข้ที่เสียชีวิต","","",-1,-1,0,"inform/form_dead","_self","","","menu/form_blue.gif","menu/form_red.gif",-1,-1,0,"","",0,0,0,0,1,"#FFB0B0",0,"#FF0000",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff"]);
						<? }?>
						stm_ep();
						stm_aix("p0i3","p0i1",[]);
						stm_aix("p0i4","p0i0",[0,"ข้อมูลสถานพยาบาล ","","",-1,-1,0,"","_self","","","menu/first_aid.gif","menu/first_aid.gif"]);
						stm_bpx("p2","p1",[]);
						<? if($this->session->userdata('R36_LEVEL')=='00'){?>
						stm_aix("p2i0","p1i0",[0,"เพิ่มข้อมูลสถานพยาบาล","","",-1,-1,0,"hospital/form","_self","","","menu/add2.gif","menu/add2.gif",16,16]);
						<? }?>
						<? if($this->session->userdata('R36_LEVEL')=='00'){?>
						stm_aix("p2i1","p0i0",[0,"ค้นหา  / แก้ไข / ลบ ข้อมูล  ","","",-1,-1,0,"hospital/index","_self","","","menu/edit16x16.gif","menu/edit16x16.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#0099cc",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff","8pt Arial","8pt Arial"]);
						<? }else{?>
						stm_aix("p2i1","p0i0",[0,"ค้นหา /ดู ข้อมูล ","","",-1,-1,0,"hospital/index","_self","","","menu/edit16x16.gif","menu/edit16x16.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#0099cc",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff","8pt Arial","8pt Arial"]);
						<? }?>
						stm_ep();
						stm_aix("p0i3","p0i1",[]);
						stm_aix("p0i4","p0i0",[0,"ข้อมูลตำบล ","","",-1,-1,0,"","_self","","","menu/first_aid.gif","menu/first_aid.gif"]);
						stm_bpx("p2","p1",[]);
						<? if($this->session->userdata('R36_LEVEL')=='00'){?>
						stm_aix("p2i0","p1i0",[0,"เพิ่มข้อมูลตำบล","","",-1,-1,0,"district/form","_self","","","menu/add2.gif","menu/add2.gif",16,16]);
						stm_aix("p2i1","p0i0",[0,"ค้นหา  / แก้ไข / ลบ ข้อมูล  ","","",-1,-1,0,"district/index","_self","","","menu/edit16x16.gif","menu/edit16x16.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#0099cc",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff","8pt Arial","8pt Arial"]);
						<? }else{?>
						stm_aix("p2i1","p0i0",[0,"ค้นหา  /ดู ข้อมูล  ","","",-1,-1,0,"district/index","_self","","","menu/edit16x16.gif","menu/edit16x16.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#0099cc",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff","8pt Arial","8pt Arial"]);
						<? } ?>
						stm_ep();
						stm_aix("p0i5","p0i1",[]);
						stm_aix("p0i6","p2i1",[0,"ค้นหาข้อมูล ","","",-1,-1,0,"","_self","","","menu/index_view.gif","menu/index_view.gif",16,16,0,"","",0,0,0,0,1,"#0099cc",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000"]);
						stm_bpx("p6","p1",[]);
						stm_aix("p0i6","p2i1",[0,"ค้นหาข้อมูลผู้สัมผัสหรือสงสัย ","","",-1,-1,0,"search_data/index","_self","","","menu/index_view.gif","menu/index_view.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#0099cc",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff","8pt Arial","8pt Arial"]);
									
						<? if($this->session->userdata('R36_LEVEL')=='00' ||$this->session->userdata('R36_LEVEL')=='01'|| $this->session->userdata('R36_LEVEL')=='02' || $this->session->userdata('R36_LEVEL')=='05' ){?>
						stm_aix("p0i6","p2i1",[0,"ค้นหาข้อมูลคนไข้ที่เสียชีวิต ","","",-1,-1,0,"search_data/dead","_self","","","menu/index_view.gif","menu/index_view.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#0099cc",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff","8pt Arial","8pt Arial"]);
						<? }?>
						stm_ep();
						stm_aix("p0i7","p0i1",[]);
						stm_aix("p0i8","p0i6",[0," วิเคราะห์ข้อมูล ","","",-1,-1,0,"#","_self","","","menu/presentation.gif","menu/presentation.gif",16,16,0,"","",0,0,0,0,1,"#0099cc",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000"]);
						stm_bpx("p3","p1",[]);
						stm_aix("p3i0","p2i1",[0,"วิเคราะห์เชิงพรรณา","","",-1,-1,0,"#","_self","","","menu/text_code.gif","menu/text_code.gif"]);
						stm_bpx("p4","p1",[1,2,-10,10]);
						stm_aix("p4i0","p2i1",[0,"สรุปข้อมูล ร.36","","",-1,-1,0,"report/index/1","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i0","p2i1",[0,"สรุปข้อมูลการสัมผัสโรครายปี (เดือน)","","",-1,-1,0,"analyze_describe2.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);	
						stm_aix("p4i0","p2i1",[0,"สรุปข้อมูลการสัมผัสโรครายปี (ไตรมาส)","","",-1,-1,0,"analyze_describe7.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);	
						stm_aix("p4i1","p2i1",[0,"สรุปประวัติการฉีดวัคซีน","","",-1,-1,0,"analyze_describe3.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i2","p2i1",[0,"สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ   ","","",-1,-1,0,"report/index/4","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i2","p2i1",[0,"รายงานสรุปรายจังหวัด   ","","",-1,-1,0,"analyze_describe5.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i2","p2i1",[0,"รายงานรายชื่อคนไข้ที่เสียชีวิต   ","","",-1,-1,0,"analyze_describe_dead.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
					    stm_aix("p4i2","p2i1",[0,"สรุปผลการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าและอิมมูโนโกลบุลิน ","","",-1,-1,0,"analyze_describe6.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i2","p2i1",[0,"SVG View ","","",-1,-1,0,"mainframe.php","_blank","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_ep();
						stm_aix("p3i2","p2i1",[0,"วิเคราะห์ตามปัจจัยต่างๆ   ","","",-1,-1,0,"analyze_cause.php","_self","","","menu/cubes.gif","menu/cubes.gif"]);
						<? if($this->session->userdata('R36_LEVEL')=='00' ||$this->session->userdata('R36_LEVEL')=='01'|| $this->session->userdata('R36_LEVEL')=='02' || $this->session->userdata('R36_LEVEL')=='05' ){?>
						stm_aix("p3i2","p2i1",[0,"นำเข้า ข้อมูลคนไข้ที่สัมผัสโรค","","",-1,-1,0,"import.php","_self","","","menu/import.gif","menu/import.gif",-1,-1]);
						<? } ?>
						stm_aix("p3i2","p2i1",[0,"ส่งออก ข้อมูลคนไข้ที่สัมผัสโรค","","",-1,-1,0,"export.php","_self","","","menu/export.gif","menu/export.gif"]);
						stm_aix("p3i4","p2i1",[0,"ส่งออก ข้อมูลโรงพยาบาล","","",-1,-1,0,"export_hospital.php","_self","","","menu/export.gif","menu/export.gif"]);
						stm_aix("p3i5","p2i1",[0,"ส่งออก ข้อมูลตำบล","","",-1,-1,0,"export_district.php","_self","","","menu/export.gif","menu/export.gif"]);
						stm_ep();
						stm_aix("p0i9","p0i1",[]);
						stm_aix("p0i10","p0i6",[0,"Help   ","","",-1,-1,0,"#","_self","","","menu/help.gif","menu/help.gif",-1,-1,0,"","",0,0,0,0,1,"#0099cc",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000"]);
						stm_bpx("p5","p1",[]);
						stm_aix("p5i0","p3i2",[0,"คู่มือการใช้งานโปรแกรม ร.36","","",-1,-1,0,"lib/Manual_r36_admin.pdf","","","","menu/book_red.gif","menu/book_red.gif"]);
						stm_aix("p5i1","p3i2",[0,"แบบรายงาน ร.36","","",-1,-1,0,"lib/form.pdf","_blank","","","menu/address_book2.gif","menu/address_book2.gif"]);
						stm_aix("p5i2","p3i2",[0,"Download โปรแกรม Offline ","","",-1,-1,0,"warnning.php","","","","menu/information.gif","menu/information.gif"]);
						stm_aix("p5i2","p3i2",[0,"Download SVG View","","",-1,-1,0,"lib/SVGView.zip","_blank","","","menu/information.gif","menu/information.gif"]);
						stm_aix("p5i3","p3i2",[0,"แนวทางเวชปฏิบัติโรคพิษสุนัขบ้า ปี 2547 ","","",-1,-1,0,"lib/jobdog.pdf","_blank","","","menu/download.gif","menu/download.gif"]);
						stm_ep();
						stm_ep();
						stm_em();
						//-->
						</script>


					<? }else if($this->session->userdata('nologin')=='nologin'){?>


					<script type="text/javascript" language="JavaScript1.2">
				
						stm_bm(["tubtehr",430,"","menu/blank.gif",0,"","",0,0,0,0,0,1,0,0,"","",0],this);
						stm_bp("p0",[0,4,0,0,0,2,16,0,100,"",-2,"",-2,90,0,0,"#000000","transparent","",3,0,0,"#ffffff"]);
						stm_ai("p0i0",[0,"หน้าแรก ","","",-1,-1,0,"index.php","_self","","","menu/home.gif","menu/home.gif",16,16,0,"","",0,0,0,0,1,"#0099cc",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000","8pt 'Courier New','Courier'","8pt 'Courier New','Courier'",0,0]);
						stm_ai("p0i1",[6,1,"#cccccc","",0,0,0]);
						stm_bp("p1",[1,4,0,0,0,3,16,0,100,"",-2,"",-2,60,0,0,"#000000","#ffffff","",3,1,1,"#73a8b7"]);
						stm_ep();
						stm_aix("p0i3","p0i1",[]);
						stm_aix("p0i4","p0i0",[0,"ข้อมูลสถานพยาบาล ","","",-1,-1,0,"","_self","","","menu/first_aid.gif","menu/first_aid.gif"]);
						stm_bpx("p2","p1",[]);
						stm_aix("p2i1","p0i0",[0,"ค้นหา /ดู ข้อมูล ","","",-1,-1,0,"hospital.php","_self","","","menu/edit16x16.gif","menu/edit16x16.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#0099cc",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#ffffff","8pt Arial","8pt Arial"]);
						stm_ep();
						stm_aix("p0i5","p0i1",[]);
						//stm_aix("p0i6","p2i1",[0,"ค้นหาข้อมูล ","","",-1,-1,0,"search_data.php","_self","","","menu/index_view.gif","menu/index_view.gif",16,16,0,"","",0,0,0,0,1,"#0099cc",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000"]);
						stm_aix("p0i7","p0i1",[]);
						stm_aix("p0i6","p2i1",[0," วิเคราะห์ข้อมูล ","","",-1,-1,0,"#","_self","","","menu/presentation.gif","menu/presentation.gif",16,16,0,"","",0,0,0,0,1,"#0099cc",0E7Fb3ccd3#94D87B",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000"]);
						stm_bpx("p3","p1",[]);
						stm_aix("p3i0","p2i1",[0,"วิเคราะห์เชิงพรรณา","","",-1,-1,0,"#","_self","","","menu/text_code.gif","menu/text_code.gif"]);
						stm_bpx("p4","p1",[1,2,-10,10]);
						stm_aix("p4i0","p2i1",[0,"สรุปข้อมูล ร.36","","",-1,-1,0,"analyze_describe1.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i0","p2i1",[0,"สรุปข้อมูลการสัมผัสโรครายปี (เดือน)","","",-1,-1,0,"analyze_describe2.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);	
						stm_aix("p4i0","p2i1",[0,"สรุปข้อมูลการสัมผัสโรครายปี (ไตรมาส)","","",-1,-1,0,"analyze_describe7.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);	
						stm_aix("p4i1","p2i1",[0,"สรุปประวัติการฉีดวัคซีน","","",-1,-1,0,"analyze_describe3.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i2","p2i1",[0,"สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ   ","","",-1,-1,0,"analyze_describe4.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i2","p2i1",[0,"รายงานสรุปรายจังหวัด   ","","",-1,-1,0,"analyze_describe5.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i2","p2i1",[0,"รายงานรายชื่อคนไข้ที่เสียชีวิต   ","","",-1,-1,0,"analyze_describe_dead.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
					    stm_aix("p4i2","p2i1",[0,"สรุปผลการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าและอิมมูโนโกลบุลิน ","","",-1,-1,0,"analyze_describe6.php","_self","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_aix("p4i2","p2i1",[0,"SVG View ","","",-1,-1,0,"mainframe.php","_blank","","","menu/scroll.gif","menu/scroll.gif"]);
						stm_ep();
						stm_aix("p3i1","p2i1",[0,"วิเคราะห์ตามปัจจัยต่างๆ   ","","",-1,-1,0,"analyze_cause.php","_self","","","menu/cubes.gif","menu/cubes.gif"]);
						//stm_aix("p3i2","p2i1",[0,"นำเข้า ข้อมูล","","",-1,-1,0,"import.php","_self","","","menu/import.gif","menu/import.gif",-1,-1]);
						//stm_aix("p3i2","p2i1",[0,"ส่งออก ข้อมูลคนไข้ที่สัมผัสโรค","","",-1,-1,0,"export.php","_self","","","menu/export.gif","menu/export.gif"]);
						stm_aix("p3i2","p2i1",[0,"ส่งออก ข้อมูลโรงพยาบาล","","",-1,-1,0,"export_hospital.php","_self","","","menu/export.gif","menu/export.gif"]);
						stm_aix("p3i2","p3i2",[0,"ส่งออก ข้อมูลตำบล","","",-1,-1,0,"export_district.php","_self","","","menu/export.gif","menu/export.gif"]);
						stm_ep();
						stm_aix("p0i9","p0i1",[]);
						stm_aix("p0i10","p0i6",[0,"Help   ","","",-1,-1,0,"#","_self","","","menu/help.gif","menu/help.gif",-1,-1]);
						stm_bpx("p5","p1",[]);
						stm_aix("p5i0","p3i2",[0,"คู่มือการใช้งานโปรแกรม ร.36","","",-1,-1,0,"lib/Manual_r36_admin.pdf","_blank","","","menu/book_red.gif","menu/book_red.gif"]);
						stm_aix("p5i1","p3i2",[0,"แบบรายงาน ร.36","","",-1,-1,0,"lib/form.pdf","_blank","","","menu/address_book2.gif","menu/address_book2.gif"]);
						stm_aix("p5i2","p3i2",[0,"Download โปรแกรม Offline  ","","",-1,-1,0,"warnning.php","_blank","","","menu/information.gif","menu/information.gif"]);
						stm_aix("p5i2","p3i2",[0,"Download SVG View","","",-1,-1,0,"lib/SVGView.zip","_blank","","","menu/information.gif","menu/information.gif"]);
						stm_aix("p5i3","p3i2",[0,"แนวทางเวชปฏิบัติโรคพิษสุนัขบ้า ปี 2547 ","","",-1,-1,0,"lib/jobdog.pdf","_blank","","","menu/download.gif","menu/download.gif"]);
						stm_ep();
						stm_ep();
						stm_em();
					
						</script>
					<? }?>
					</td>
					<td width="35%" align="right" bgcolor="#0099cc" nowrap="nowrap"><span class="top"><?php echo date('H').":".date('i')." น.&nbsp;&nbsp;วันที่ ".date('d').' '.convert_month(date('m'),"shortthai").' '.(date('Y')+543);?> </span>
					</td>
				  </tr>
				</table>
</div>