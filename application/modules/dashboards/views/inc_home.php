<div class="content-left dashboard">
	<span class="title_counter">จำนวนผู้เยี่ยมชมเว็บไซต์ (คน)</span>
	<ul>
		<li class="counter"><span>วันนี้</span><span class="right"><?php echo $summary_today[0]['ga:visits']; ?> </span></li>
		<li class="counter monthly"><span>เดือนนี้</span><span class="right"><?php echo $summary_month[0]['ga:visits']; ?></span></li>
		<li class="counter summary"><span>รวม</span><span class="right"><?php echo $allTimeSummery['ga:visits']?></span></li>
	</ul>
	
</div>

