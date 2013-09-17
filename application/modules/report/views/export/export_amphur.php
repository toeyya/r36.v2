<script type="text/javascript">
$(document).ready(function(){
	
})
</script>
<div id="title">ส่งออก - ข้อมูลอำเภอ</div>
<div id="search">
<form action="report/export/index/amphur">
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