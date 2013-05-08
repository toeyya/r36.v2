<ul class="menu">
	<li <?php echo menu_active('users','profiles')?>><a href="users/admin/profiles">ประวัติส่วนตัว</a></li>
	<?php //if(permission('permissions', 'act_read')): ?>
	<!--<li <?php echo menu_active('permissions','permissions')?>><a href="permissions/admin/permissions">สิทธิ์การใช้งาน</a></li>-->
	<?php //endif; ?>
	<li <?php echo menu_active('coverpages','coverpages')?>><a href="content/admin/content/index/1">เกี่ยวกับโรคพิษสุนัขบ้า</a>
	<li <?php echo menu_active('users','users')?>><a href="content/admin/content/index/2">สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</a></li>	
	<li <?php echo menu_active('contents','categories')?>><a href="ccontent/admin/content/index/3">สถานที่ให้คำปรึกษาเกี่ยวกับพิษสุนัขบ้า</a></li>
	<li <?php echo menu_active('calendars','calendars')?>><a href="content/admin/content/index/4">งานศึกษาวิจัย</a></li>
	<li <?php echo menu_active('download','download')?>><a href="content/admin/content/index/5">เอกสารเผยแพร่</a></li>
	<li <?php echo menu_active('download','download')?>><a href="content/admin/content/index/6">ข่าวประชาสัมพันธ์</a></li>
	<li <?php echo menu_active('download','download')?>><a href="content/admin/content/index/7">สาระน่ารู้</a></li>
	<li <?php echo menu_active('webboards','webboards')?>><a href="webboards/admin/webboard_categories">เว็บบอร์ด</a></li>
	<li <?php echo menu_active('contact','contacts')?>><a href="#">ถาม-ตอบ</a></li>
	<li <?php echo menu_active('contact','contacts')?>><a href="content/admin/content/index/8">ติดต่อเรา</a></li>
	<li <?php echo menu_active('dashboards','dashboards')?>><a href="dashboards/admin/dashboards/index">จำนวนคนเข้าเว็บไซต์</a></li> 
	<!--<li <?php echo menu_active('logs','logs')?>><a href="logs/admin/logs/index">ประวัติเข้าใช้ระบบ</a></li> -->

</ul>
<script>
			$(function(){
				$('.menu ul').hide();
				<?php if(!empty($_GET['agency_id'])): ?>$('.menu li#agency-<?php echo $_GET['agency_id']; ?> ul').show();<?php endif; ?>
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