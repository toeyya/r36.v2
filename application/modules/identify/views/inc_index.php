<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</li>   
</ul>
<h1><img src="themes/default/media/images/title_place.png" width="253px" height="34px"></h1>

<hr clas="hr1">	
<div class="accordion" id="accordion2">
<ul style="margin-left:50px;">
<?php foreach($result as $key=>$item): ?>
	<li style="padding:5px;"><span style="font-weight: bold;color: #E01B5D; font-size: 14px"><?php echo $item['name']; ?></span>
		<ul style="margin-left:15px;">
			<?php 			
			$rs = $this->detail->where("identify_id=".$item['id'])->get();
				foreach($rs as $detail){
			?>
			<li><span style="font-weight: bold"><?php echo $detail['name'] ?></span><br/>
				<img src="media/images/home.gif" width="15px" height="15px"> : <?php echo $detail['address'] ?><br/>
				<img src="media/images/i_phone.gif" width="15px" height="17px" > : <?php echo $detail['telephone'] ?><br/>
				
			</li>

		
			<?php } ?>
		</ul>
	</li>
<?php endforeach; ?>
</ul>
</div>

