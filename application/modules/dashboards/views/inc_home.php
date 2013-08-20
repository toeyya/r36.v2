<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21" height="21"><img src="themes/default/media/images/tbCol1_topLeft.png" width="21" height="21" /></td>
    <td background="themes/default/media/images/tbCol1_top.png">&nbsp;</td>
    <td width="21" height="21"><img src="themes/default/media/images/tbCol1_topRight.png" width="21" height="21" /></td>
  </tr>
  <tr>
    <td background="themes/default/media/images/tbCol1_left.png">&nbsp;</td>
    <td bgcolor="#FFFFFF" valign="top">
    	<span class="title_counter">จำนวนผู้เยี่ยมชมเว็บไซต์</span><br><br>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="17%" align="center"><img src="themes/default/media/images/counter_1.png" width="16" height="16" /></td>
            <td width="60%">วันนี้</td>
            <td width="23%" align="right"><?php echo $summary_today[0]['ga:visits']; ?></td>
            <td width="23%">คน</td>
          </tr>
          <tr>
            <td align="center"><img src="themes/default/media/images/counter_2.png" width="16" height="16" /></td>
            <td>เดือนนี้</td>
            <td align="right"><?php echo $summary_month[0]['ga:visits']; ?></td>
            <td>คน</td>
          </tr>
          <tr>
            <td align="center"><img src="themes/default/media/images/counter_3.png" width="26" height="23" /></td>
            <td>รวม</td>
            <td align="right"><?php echo $allTimeSummery['ga:visits']?></td>
            <td>คน</td>
          </tr>
        </table>        
    </td>
    <td background="themes/default/media/images/tbCol1_right.png">&nbsp;</td>
  </tr>
  <tr>
    <td width="21" height="21"><img src="themes/default/media/images/tbCol1_bottomLeft.png" width="21" height="21" /></td>
    <td background="themes/default/media/images/tbCol1_bottom.png">&nbsp;</td>
    <td width="21" height="21"><img src="themes/default/media/images/tbCol1_bottomRight.png" width="21" height="21" /></td>
  </tr>
</table>

