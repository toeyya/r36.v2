<html>
<head>
<title>test connect mysql</title>
</head>
<body>
<?
$objConnect = mysql_connect("localhost","r36admin","1234") or die("Error Connect to Database");
$objDB = mysql_select_db("r36_db");
$strSQL = "SELECT * FROM summary_province";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">id </div></th>
    <th width="98"> <div align="center">Name </div></th>
    <th width="198"> <div align="center">no_ppe </div></th>
    <th width="97"> <div align="center">pop </div></th>
    <th width="59"> <div align="center">s_value </div></th>
    <th width="71"> <div align="center">up_date </div></th>
  </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr>
    <td><div align="center"><?=$objResult["id"];?></div></td>
    <td><?=$objResult["name"];?></td>
    <td><?=$objResult["no_ppe"];?></td>
    <td><div align="center"><?=$objResult["pop"];?></div></td>
    <td align="right"><?=$objResult["s_value"];?></td>
    <td align="right"><?=$objResult["up_date"];?></td>
  </tr>
<?
}
?>
</table>
<?
mysql_close($objConnect);
?>
</body>
</html>