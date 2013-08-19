<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</li>   
</ul>
<h1><img src="themes/default/media/images/title_place.png" width="253px" height="34px"></h1>

<hr clas="hr1">	
<div class="accordion" id="accordion2">
<ul style="margin-left:10px;">
<?php foreach($result as $key=>$item): ?>
	<li style="padding:5px;"><span style="font-weight: bold"><?php echo $item['name']; ?></span>
		<ul style="margin-left:10px;">
			<?php 			
			$rs = $this->detail->where("identify_id=".$item['id'])->get();
				foreach($rs as $detail){
			?>
			<li><span style="font-weight: bold"><?php echo $detail['name'] ?></span><br/>
				ที่อยู่ :<?php echo $detail['address'] ?><br/>
				เบอร์โทรศัพท์:<?php echo $detail['telephone'] ?><br/>
				
			</li>
			
				
				
		
			<?php } ?>
		</ul>
	</li>
<?php endforeach; ?>
</ul>
</div>

