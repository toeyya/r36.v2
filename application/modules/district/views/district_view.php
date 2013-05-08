<div id="title">ข้อมูลตำบล</div>
<table class="tbform">
    <tr> 
      <th width="110" >จังหวัด :</th>
      <td width="242" height="20"><?php echo $province_name;?></td>
    </tr>
    <tr> 
      <th height="20">อำเภอ :</th>
      <td height="20"><?php echo $amphur_name; ?></td>
    </tr>
    <tr> 
      <th  class="topic">ตำบล:</th>
      <td><?php echo $district_name;?></td>
    </tr>
    <tr align="center"> 
      <td height="20" colspan="2">
      	
      	<input type="button" name="main" value="กลับหน้าหลัก"  class="Submit" onClick="document.form1.process.value='';document.form1.submit();"></td>
    </tr>
</table>