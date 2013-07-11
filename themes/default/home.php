<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $template['title']; ?></title>
<?php include('_script.php'); ?>
 <?php echo $template['metadata']; ?>
</head>
<body>
<div id="wrap">
    <div class="main">
    	<div class="logo"></div>
        <div class="name"></div>
        <div class="clr"></div>
		<?php include('_menu_top.php'); ?>
        <div class="animal"></div>
        <div class="clr"></div>
        <div id="col1">
			<?php include('_menu_left.php'); ?>
			<br>
				<?php echo modules::run('users/inc_login'); ?>
            <br>
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
                        <td width="23%" align="right">999</td>
                        <td width="23%">คน</td>
                      </tr>
                      <tr>
                        <td align="center"><img src="themes/default/media/images/counter_2.png" width="16" height="16" /></td>
                        <td>เดือนนี้</td>
                        <td align="right">12389</td>
                        <td>คน</td>
                      </tr>
                      <tr>
                        <td align="center"><img src="themes/default/media/images/counter_3.png" width="26" height="23" /></td>
                        <td>รวม</td>
                        <td align="right">987698</td>
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
            <br>
        </div>
        <div id="col2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_topLeft.png" width="22" height="22" /></td>
            <td background="themes/default/media/images/tbCol2_top.png">&nbsp;</td>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_topRight.png" width="22" height="22" /></td>
          </tr>
          <tr>
            <td background="themes/default/media/images/tbCol2_left.png">&nbsp;</td>
            <td bgcolor="#FFFFFF"><img src="themes/default/media/images/title_pr.png" width="141" height="25" /><hr class="hr1">
            <div id="news-pr">
              <ul>
            	<li><a href="#">โครงการประกวด รางวัลโรคพิษสุนัขบ้าประจำปี 2554 (MoPH.-MoAC. Rabies Award 2011)</a></li>
                <li><a href="#">ผลการประกวดรางวัลโรคพิษสุนัขบ้าประจำปี 2554 ระดับเทศบาล และ อบต.</a></li>
                <li><a href="#">โครงการประกวดรางวัลโรคพิษสุนัขบ้าประจำปี 2554</a></li>
                <li><a href="#">เกณฑ์การประเมินผลงานการควบคุมโรคพิษสุนัขบ้าประจำปี 2554</a></li>
                <li><a href="#">กฎกระทรวง ฉบับที่ 2 (พ.ศ. 2535) ออกในพรบ.โรคพิษสุนัขบ้า พ.ศ. 2535</a></li>
                <li><a href="#">กฎกระทรวง (พ.ศ. 2535) ออกในพรบ.โรคพิษสุนัขบ้า พ.ศ. 2535</a></li>
                <li><a href="#">พระราชบัญญัติโรคพิษสุนัขบ้า พ.ศ. 2535</a></li>
                <li><a href="#">คู่มือแนวทางเวชปฏิบัติโรคพิษสุนัขบ้า</a></li>
                <li><a href="#">การประเมินเพื่อพัฒนาแนวทางเวชปฏิบัติโรคพิษสุนัขบ้า</a></li>
              </ul>
             </div>
             <input class="btn_readAll" type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;" >
             <br><br><br>
            <img src="themes/default/media/images/title_2.png" width="69" height="25" /><hr class="hr1">
               <div class="pic">
                <ul>
                 <li><img src="themes/default/media/images/pic1.png" width="133" height="94" /><li>
                 <li><img src="themes/default/media/images/pic2.png" width="133" height="94" /><li>
                 <li><img src="themes/default/media/images/pic3.png" width="133" height="94" /><li>
                 <li><img src="themes/default/media/images/pic4.png" width="133" height="94" /><li>
                </ul>
               </div>
               <div class="content-rabies">
               <span class="title-rabies">โรคพิษสุนัขบ้า (Rabies)</span>
               <p>โรคพิษสุนัขบ้า เป็นโรคติดต่อจากสัตว์มาสู่คนที่มีความรุนแรงมาก ผู้ป่วยต้องเสียชีวิตทุกราย อาการแสดงของโรคมักเป็นแบบสมองและเยื่อสมองอักเสบเฉียบพลัน ผู้ป่วยจะมีไข้ ปวดเมื่อยตามเนื้อตัว คันหรือปวดบริเวณรอยแผลที่ถูกสัตว์กัด  ต่อมาจะหงุดหงิด ตื่นเต้นไวต่อสิ่งเร้า (แสง เสียง ลมฯ) ม่านตาขยาย น้ำลายไหลมาก</p>
               
               </div>
               <br><br>
            </td>
            <td background="themes/default/media/images/tbCol2_right.png">&nbsp;</td>
          </tr>
          <tr>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_bottomLeft.png" width="22" height="22" /></td>
            <td background="themes/default/media/images/tbCol2_bottom.png"> </td>
            <td width="22" height="22"><img src="themes/default/media/images/tbCol2_bottomRight.png" width="22" height="22" /></td>
          </tr>
        </table>
        </div>
         <div class="clr"></div>
           <div id="footer">© Copyright All Right Reserved. ระบบการรายงานผู้สัมผัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า</div>     
    </div>
</div>
</body>
</html>
