<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li><a href="research/index">งานศึกษาวิจัย</a><span class="divider">/</span></li>
    <li><?php echo $research_name; ?></li>
</ul>
<h1><img src="themes/default/media/images/title_research.png" width="101" height="24"></h1>
<hr class="hr1">
<ul id="description">
	<li><i class="icon-calendar"></i><?php echo (!empty($rs['upated']))?db_to_th($rs['updated'],false,false):db_to_th($rs['created'],false,false) ; ?></li>
	<li><a href="research/download/<?php echo $rs['id'] ?>"><i class="icon-file"></i><? echo $rs['file_title']?></a></li>
</ul>
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