<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<script type="text/javascript">
$(document).ready(function(){
	$("input[name=close]").click(function(){
			parent.$.colorbox.close();
	});	
	$('a[name=link]').click(function(){
		$(this).attr('href','inform/addnew/'+$('input[name=hospitalprovince]').val()+'/'
																   +$('input[name=hospitalamphur]').val()+'/'
																   +$('input[name=hospital]').val()+'/'
																   +$('input[name=in_out]').val()+'/'+'?hn='+$('input[name=hn]').val()
																   +'&idcard='+$('input[name=idcard]').val()+'&statusid='+$('input[name=statusid]').val());		
	})
});
</script>
</head>
<body>

<table width="100%" class="tbform noborder">
  <tr>
    <td>	
	<table width="450" border="0" align="center" cellpadding="0" cellspacing="0" class="noborder">  
        <tr>
          <td>
		  <h4><?php echo $show_title ?></h4></td>
        </tr>
        <tr>
          <td align="center">
		  <table width="450"  border="0" cellspacing="1" bgcolor="#000066" align="center" >			  
			  <? if($num_chk){ 
					 if($hn!=''){	$number1='Y';?>
					<tr bgcolor="#FFFFFF">
						<td colspan="5" align="left">
							<a href="inform/addnew/<?php echo $hospitalprovince?>/<?php echo $hisamp?>/<?php echo $hospital ?>/<?php echo  $in_out;?>/<?php echo $historyid; ?>?hn=<?php echo $hn; ?>" target="_top">
								<img src="images/add2.gif"  align="absmiddle" border="0" />เพิ่มข้อมูลการสัมผัสของ <?php echo @$idcard?> รหัส <?php echo $hn?></a>
						</td>
					</tr>
				<?	} 
				}?>
				
              <tr align="center"> 
                <th>ลำดับ</th>
                <th>HN</th>
                <th>ชื่อ-นามสกุล</th>
                <th>โรงพยาบาล</th>
                <th>การกระทำ</th>
              </tr>
			<?php foreach($result as $i =>$rec): ?>
			  <? 			  	
			  	if($num_chk){ 
						//$hn= $rec['hn'];
						//$hospital = $rec['hospitalcode'];
						//$rec_hospitalname=$DB->FETCHARRAY($DB->QUERY("SELECT hospital_name FROM n_hospital WHERE hospital_code='".$hospital."'"));
						//$rec_hospitalname=$this->db->GetRow("SELECT hospital_name FROM n_hospital WHERE hospital_code='".$hospital."'");					
						$rec_hospitalname=$this->hospital->get_row("hospital_code", $rec['hospitalcode']);
						
			  ?>
              <tr> 
                <td align="center"><?=++$i?></td>
                <td><?php echo  $rec['hospitalcode'].'/'.$rec['hn']?></td>
                <td><?php echo $rec['firstname'].' '.$rec['surname'];?></td>
                <td><?php echo $rec_hospitalname['hospital_name']?></td>
                <td>

					<? if($this->session->userdata('R36_LEVEL')=='00' || ($this->session->userdata('R36_LEVEL')=='02' && ($this->session->userdata('R36_PROVINCE')==$rec['hospitalprovince']))){?>
						<a href="inform/form/<?php echo $rec['id']?>/<?php echo $rec['historyid'] ?>/<?php echo $in_out; ?>" target="_top">แก้ไข</a>								
					<? }else if(($this->session->userdata('R36_LEVEL')=='05' || $this->session->userdata('R36_LEVEL')=='03') && $this->session->userdata('R36_FROMEDIT')=='Y'&& ($this->session->userdata('R36_HOSPITAL')==$rec['hospitalcode'])){?>
						<a href="inform/form/<?php echo $rec['id']?>/<?php echo $rec['historyid'] ?>/<?php echo $in_out; ?>" target="_top">แก้ไข</a>
					<? }?>
				</td>
              </tr>
				<? 
					} else { 
				?>
              <tr align="center" bgcolor="#D5F4FF"> 
                <td colspan="5"> -- ไม่พบข้อมูล --</td>
              </tr>
			 <? } ?>
			  <? endforeach; ?>
            </table><br />
			<? 
			if($num_chk){
			?>
				<input name="close" type="button" class="Submit"  value="ปิดหน้าต่าง"/>
			<? 
			}else{
				echo form_hidden('hospitalprovince',$hospitalprovince);
				echo form_hidden('hospitalamphur',$hisamp);
				echo form_hidden('hospital',$hospital);
				echo form_hidden('in_out',$in_out);
				echo form_hidden('hn',$hn);
				echo form_hidden('idcard',$idcard);
				echo form_hidden('statusid',$statusid);
			?>			
				<a  class="Submit" href="javascript:void(0)" target="_top" name="link" title="แบบฟอร์มคนไข้สัมผัสโรค"> ทำขั้นต่อไป</a>
			<? 
			}
			?>
			</td>
        </tr>
       
      </table>
	</td>
  </tr>
</table>


</body>
</html>
