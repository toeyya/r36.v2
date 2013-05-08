<div id="topmenu-left"></div>
<div id="topmenu">
            <div id='toplevel'>
            <ul>
              <li class="line_topmenu3"><a href="log/index">ประวัติเข้าใช้ระบบ</a></li>
              <li class="line_topmenu4"><a href="user/form/<?php echo $this->session->userdata('R36_UID') ?>"><span>ประวัติส่วนตัว</span></a></li> 
             <?php if($this->session->userdata('R36_LEVEL')=="00" || $this->session->userdata('R36_LEVEL')=="02" ): ?>
              <li class="line_topmenu4"><a href="user/search"><span>ผู้ใช้ระบบ</span></a></li>                       
              <?php endif; ?>
              <li class="line_topmenu4"><a href="javascript:void(0);">กรอกแบบฟอร์ม</a>
                <ul class="submenu4">
                     <li><a href="inform/index">แบบฟอร์มคนไข้ที่สัมผัสโรค</a></li>
                     <li><a href="inform/index_dead">แบบฟอร์มคนไข้ที่เสียชีวิต</a></li>
                  </ul>
               </li>
               <li class="line_topmenu4"><a href="javascript:void(0);">ตั้งค่า</a>
                <ul class="submenu5">                  
                     <li><a href="area/index">ข้อมูลเขตความรับผิดชอบ</a></li>
                     <li><a href="province/index">ข้อมูลจังหวัด</a></li>
                    <li><a href="amphur/index">ข้อมูลอำเภอ</a></li>
					<li><a href="district/index">ข้อมูลตำบล</a></li>
					 <li><a href="hospital/index">ข้อมูสถานพยาบาล</a></li>
					
                 </ul>
               </li>
               <li class="line_topmenu4"><a href="javascript:void(0);">รายงาน</a>
                <ul class="submenu8">                 
                     <li class="menu8"><a href="javascript:void(0);">วิเคราะห์เชิงพรรณา</a>
                     		<ul class="submenu8-1">
                     			<li><a href="report/index/1">สรุปข้อมูล ร.36</a></li>
                     			<li><a href="report/index/2">สรุปข้อมูลการสัมผัสโรครายปี (เดือน)</a></li>
                     			<li><a href="report/index/3">ข้อมูลการสัมผัสโรครายปี (ไตรมาส)</a></li>
                     			<li><a href="report/index/5">สรุปประวัติการฉีดวัคซีน</a></li>
                     			<li><a href="report/index/4">สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ   </a></li>
                     			<li><a href="report/index/6">รายงานสรุปรายจังหวัด   </a></li>
                     			<li><a href="report/index/7">รายงานรายชื่อคนไข้ที่เสียชีวิต   </a></li>
                     			<li><a href="report/index8">สรุปผลการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าและอิมมูโนโกลบุลิน </a></li>
                     			<li><a href="map/index">GIS</a></li>
                     		</ul>
                     </li>                    
                     <li><a href="javascript:void(0);">วิเคราะห์ตามปัจจัยต่างๆ</a></li>
                     <li><a href="javascript:void(0);">ส่งออก ข้อมูลคนไข้ที่สัมผัสโรค</a></li>
                     <li><a href="javascript:void(0);">ส่งออก ข้อมูลโรงพยาบาล</a></li>
                     <li><a href="javascript:void(0);">ส่งออก ข้อมูลตำบล</a></li>
                     <li><a href="javascript:void(0);">ตารางนัดหมายคนไข้</a></li>
                 </ul>
                </li>
               <li class="line_topmenu9"><a href="javascript:void(0);">Help</a>
                 <ul class="submenu9">
                     <li><a href="javascript:void(0);">คู่มือการใช้งานโปรแกรม ร.36</a></li>
                     <li><a href="javascript:void(0);">แบบรายงาน ร.36</a></li>
                     <li><a href="javascript:void(0);">Download โปรแกรม Offline</a></li>
                     <li><a href="upload/Rabies_CPG56_QA_Low.pdf">แนวทางเวชปฏิบัติโรคพิษสุนัขบ้าและคำถามที่พบบ่อย</a></li>
                 </ul>
               </li>
            </ul>
            </div>
</div>
<div id="topmenu-right"></div>
