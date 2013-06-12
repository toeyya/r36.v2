<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="research/index">งานศึกษาวิจัย</a><span class="divider">/</span></li>
    <li><?php echo $research_name; ?></li>
</ul>
<h1><img src="themes/default/media/images/" width="121" height="28"></h1>
<hr class="hr1">
<div id="description">
	<i class="icon-calendar"></i><?php echo (!empty($rs['upated']))?db_to_th($rs['updated'],false,false):db_to_th($rs['created'],false,false) ; ?>
	<a href="uploads/research/<?php echo $rs['file'] ?>"><i class="icon-file"></i><? echo $rs['file_title']?></a>
</div>
<div id="research">
	<ul>		
		<li class="title"><? echo $rs['title'] ?></li>	
		<li><? echo $rs['researcher'] ?><p><i><? echo $rs['agency'] ?></i></p></li>	
		<li></li>
		<li><label>วัตถุประสงค์:</label><? echo $rs['objective']?></li>
		<li><label>วัสดุและวิธีการ :</label><? echo $rs['method'] ?></li>
		<li><label>ผลการศึกษา :</label><? echo $rs['result'] ?></li>
		<li><label>สรุป :</label><? echo $rs['conclusion']?></li>
		
	</ul>
</div>