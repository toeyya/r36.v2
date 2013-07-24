<div id="topmenu-left"></div>
<div id="topmenu">
            <div id='toplevel'>
            <ul>
              <li class="line_topmenu4"><a href="home">หน้าแรก</a></li>
              <li class="line_topmenu4"><a href="users/r36/users/index/<?php echo $this->session->userdata('R36_UID') ?>"><span>ประวัติส่วนตัว</span></a></li> 
              <?php if($this->session->userdata('confirm_email')=="1" && $this->session->userdata('confirm_province')=="1" && $this->session->userdata('confirm_admin')=="1"):  ?>
              <li class="line_topmenu4"><a href="javascript:void(0);">กรอกแบบฟอร์ม</a>
                <ul class="submenu4">
                     <li><a href="inform/index">แบบฟอร์มคนไข้ที่สัมผัสโรค</a></li>
                     <li><a href="inform/dead/index">แบบฟอร์มคนไข้ที่เสียชีวิต</a></li>
                  </ul>
               </li>
               <li class="line_topmenu4"><a href="javascript:void(0);">รายงาน</a>
                <ul class="submenu8">                 
                     <li class="menu8"><a href="javascript:void(0);">วิเคราะห์เชิงพรรณา</a>
                     		<ul class="submenu8-1">

                     			<li><a href="report/index/1" >ข้อมูลการสัมผัสโรค - ภาพรวม</a></li>
                     			<li><a href="report/index/2">ข้อมูลการสัมผัสโรค - รายเดือน</a></li>
                     			<li><a href="report/index/3" >ข้อมูลการสัมผัสโรค - รายไตรมาส</a></li>
                     			<li><a href="report/index/5" >ข้อมูลการฉีดวัคซีน</a></li>
                     			<li><a href="report/index/4">ข้อมูลผู้รับวัคซีนจำแนกตามสิทธิการรักษาของสถานบริการ</a></li>
                     			<li><a href="report/index/6">ข้อมูลรายจังหวัด   </a></li>
                     			<li><a href="report/index/7">ข้อมูลผู้เสียชีวิต   </a></li>
                     			<li><a href="report/index/8">ข้อมูลการฉีดวัคซีนและอิมมูโนโกลบุลิน </a></li>
                     		</ul>
                     </li>                    
                     <li><a href="report/analyze/index/1">วิเคราะห์ตามปัจจัยต่างๆ</a></li>
                     <li><a href="report/export/export_rabies">ส่งออก ข้อมูลคนไข้ที่สัมผัสโรค</a></li>
                     <li><a href="javascript:void(0);">ส่งออก ข้อมูลโรงพยาบาล</a></li>
                     <li><a href="javascript:void(0);">ส่งออก ข้อมูลตำบล</a></li>
                     <?php if($this->session->userdata('schedule')): ?>
                     <li><a href="report/schedule">ตารางนัดหมายคนไข้</a></li>
                     <?php endif; ?>
                 </ul>
                </li>
                <?php     	
                $result=$this->db->execute("select * from n_document_detail where shw_help='1'"); 
                  if($result){ ?>
               <li class="line_topmenu9"><a href="javascript:void(0);">Help</a>
                 <ul class="submenu9">
                 	<?php     	
                 		  foreach($result as $item){ ?>                		                  	
                     <li><a href="document/download/<?php echo $item['id']  ?>"><?php echo $item['title']  ?></a></li>                 
                    <?php } ?>                  
                 </ul>
               </li>
               <? } ?> 
               <?php endif; ?>
            </ul>
            </div>
</div>
<div id="topmenu-right"></div>
