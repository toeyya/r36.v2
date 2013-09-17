<div id="title">ส่งออก - ข้อมูลจังหวัด</div>
<div id="search">
<form action="report/export/index/province">
<table class="tb_patient1">
	<tr>
	    <th>ประเภทไฟล์</th>	    
		<td><?php echo form_radio('fileType','txt',true);?> text file
			<?php echo form_radio('fileType','execel');?> excel file</td>	
						
      </tr>   	
  </table>
  <div class="btn_inline"><ul><li><button class="btnSubmit" value="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li></ul></div>	
</form>
</div>