<ul class="menu">
	<li <?php echo menu_active('users','profiles')?>><a href="users/admin/users/form/<?php echo $this->session->userdata('R36_UID') ?>/profile">ประวัติส่วนตัว</a></li>
	<?php //if(permission('permissions', 'act_read')): ?>
	<li <?php echo menu_active('permissions','permissions')?>><a href="permissions/admin/permissions">สิทธิ์การใช้งาน</a></li>
	<?php //endif; ?>
	<li <?php echo menu_active('users','users')?>><a href="users/admin/users">ผู้ใช้ระบบ</a></li>
	<li><a href="javascript:void(0)">ตั้งค่าระบบโปรแกรมร.36</a>
		<ul class="sublist">
                <li><a href="area/index">เขตความรับผิดชอบ</a></li>
                <li><a href="province/index">จังหวัด</a></li>
                <li><a href="amphur/index">อำเภอ</a></li>
				<li><a href="district/index">ตำบล</a></li>
				<li><a href="hospital/index">สถานพยาบาล</a></li>					
		</ul>
	</li>

	<li <?php echo menu_active('content','content')?>><a href="content/admin/content/index/1">เกี่ยวกับโรคพิษสุนัขบ้า</a></li>
	<li <?php echo menu_active('content','content')?>><a href="identify/admin/identify/index">สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</a></li>	
	<li <?php echo menu_active('contents','content')?>><a href="research/admin/research/index">งานศึกษาวิจัย</a></li>
	<li <?php echo menu_active('contents','contents')?>><a href="document/admin/document/index">เอกสารเผยแพร่</a></li>
	<li <?php echo menu_active('download','download')?>><a href="content/admin/content/index/6">ข่าวประชาสัมพันธ์</a></li>
	<li <?php echo menu_active('contents','contents')?>><a href="content/admin/content/index/7">สาระน่ารู้</a></li>
	<li <?php echo menu_active('contents','contents')?>><a href="content/admin/content/index/8">ตัววิ่ง</a></li>
	<li <?php echo menu_active('webboards','webboards')?>><a href="webboards/admin/webboard_categories">เว็บบอร์ด</a></li>
	<li <?php echo menu_active('contact','contacts')?>><a href="question/admin/question/index">คำถามที่พบบ่อย</a></li>
	<li <?php echo menu_active('contact','contacts')?>><a href="content/admin/content/index/8">ติดต่อเรา</a></li>
	<li <?php echo menu_active('dashboards','dashboards')?>><a href="dashboards/admin/dashboards/index">จำนวนคนเข้าเว็บไซต์</a></li> 
	<li <?php echo menu_active('log','log')?>><a href="log/admin/log/index">ประวัติเข้าใช้ระบบ</a></li>

</ul>
<script>
			$(function(){
				$('.menu ul').hide();			
			    $('.menu li:has(ul) > a').prepend('<span class="symbol">+</span> ').click(function(){
			    	var checkElement = $(this).next();
					if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
						checkElement.slideUp('normal');
						$(this).find('span.symbol').text('+');
			    		return false;
			    	}
			    	if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
			    		checkElement.slideDown('normal');
						checkElement.parent().siblings().find('ul:visible').slideUp('normal');
						checkElement.parent().siblings().find('span.symbol').text('+');
						$(this).find('span.symbol').text('-');
			    		return false;
			    	}
			    });
			})
</script>