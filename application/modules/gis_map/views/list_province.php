<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<style type="text/css">
#font_header {
	color: #FFF;
	font-weight: bold;
}
</style>
</head>

<body>

<?php
/*			echo "<table>";
			
			foreach ($tbInfor->result() as $row)
			{
				echo "<tr>";
				echo "<td>";
				echo $row->hospitalcode."|";
				echo $row->hospitalprovince."|";
				echo $row->hospitalamphur."|";
				echo "</td>";
				echo "</tr>";
			}
			
			
			echo "</table>";*/
			
/*						foreach ($tbProvince->result() as $row)
						{
							echo "<option value='".$row->province_id."'>".$row->province_name."</option>";
						}*/
			
?>

<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="4" align="left" valign="top" bgcolor="#3399FF"><span id="font_header"><?php echo $heading; ?></span></td>
  </tr>
  <tr>
    <td width="25%" align="left" valign="top" bgcolor="#3399FF"><span id="font_header">ปี 2556</span></td>
    <td align="left" valign="top" bgcolor="#3399FF">&nbsp;</td>
    <td align="left" valign="top" bgcolor="#3399FF">&nbsp;</td>
    <td align="left" valign="top" bgcolor="#3399FF">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">จังหวัด (province) </span></td>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">จำนวนประชากรเข้ารับการรักษา</span></td>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header">จำนวนประชากรรวมแต่ละจังหวัด</span></td>
    <td align="left" valign="top" bgcolor="#3399FF"><span id="font_header"> อัตราการให้วัคซีนป้องกันโรคพิษสุนัขบ้า  แยกรายจังหวัด (Comparative Risk Analysis on Post Exposure Prophylaxis by Province, Thailand, 2013)</span></td>
  </tr>
  
<?php 

foreach ($query->result_array() as $row)
{
	
		$province_count = 0;
		$province_percent = 0;
		
		$query = $this->db->query("SELECT * FROM n_information where datetouch BETWEEN '2556-01-01' AND '2556-12-31' AND provinceidplace=".$row['province_id']);

		$province_count = $query->num_rows();
		
		$province_percent = ($province_count / $row['provincepeople']) * 100000;
		
 ?>

  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $row['province_name']; ?> </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($province_count,0); ?> คน</td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($row['provincepeople'],0); ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($province_percent,2); ?> %</td>
  </tr>

<?php } ?>


</table>
</body>
</html>