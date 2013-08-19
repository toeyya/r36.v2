<? 
session_start();

include('include/filemaster.php');
//include("session_level_00_01_02_04_03_05.php");
// n_information,n_history,n_vaccince
if(empty($_SESSION['R36_LEVEL'])  || $_SESSION['R36_LEVEL']=='' || empty($_SESSION)){
  alert_message('save');
  include("session_level_00_01_02_04_03_05.php");
}else{
		sleep(10);
		$process=$_POST['process'];
		if($in_out){
			$in_out=$_POST['in_out'];			
		}else{
			$in_out="1";		
		}
		if($in_out=="1"){
			echo $title_log="ข้อมูลคนไข้ที่สัมผัสโรค (ในเขต)  ";
		}else if($in_out=="2"){
			echo $title_log="ข้อมูลคนไข้ที่สัมผัสโรค (นอกเขต)  ";
		}
		$prefix_name=$_POST['prefix_name'];
		$save=$_POST['save'];
		$historyid=$_POST['historyid']; 
		$addnewinform=$_POST['addnewinform']; 
		$cardW0=$_POST['cardW0'];
		$cardW1=$_POST['cardW1'];
		$cardW2=$_POST['cardW2'];
		$cardW3=$_POST['cardW3'];
		$cardW4=$_POST['cardW4'];
		$firstname=$_POST['firstname'];
		$surname=$_POST['surname'];
		$statusid=$_POST['statusid'];
		$idpassport=$_POST['idpassport'];
		$chkage=$_POST['chkage'];
		$age=$_POST['age'];
		$age_group=$_POST['age_group'];
		$nationality=$_POST['nationality'];
		$nationalityname=$_POST['nationalityname'];
		$othernationalityname=$_POST['othernationalityname'];
		$typeforeign=$_POST['typeforeign'];
		$occupationname=$_POST['occupationname'];
		$occupationname_b=$_POST['occupationname_b']; 
		$otheroccupationname=$_POST['otheroccupationname'];
		$nohome=$_POST['nohome'];
		$moo=$_POST['moo'];
		$villege=$_POST['villege'];
		$soi=$_POST['soi'];
		$road=$_POST['road'];
		$provinceid=$_POST['provinceid'];
		$amphurid=$_POST['amphurid'];
		$districtid=$_POST['districtid'];
		$telephone=$_POST['telephone'];
		$occparentsname=$_POST['occparentsname'];
		$otheroccparentsname=$_POST['otheroccparentsname'];
		if($hospital==''){	
				$hospital=$_POST['hospital1'];
		}else{
				$hospital=$_POST['hospital'];
		}
		if($hospitalamphur==''){	
				$hospitalamphur=$_POST['hospitalamphur1'];
		}else{
				$hospitalamphur=$_POST['hospitalamphur'];
		}
		$hospitalprovince=$_POST['hospitalprovince'];
		$hn=$_POST['hn'];
		$hn_no=$_POST['hn_no'];
		$placetouch=$_POST['placetouch'];
		$detailplacetouch=$_POST['detailplacetouch'];
		$mooplace=$_POST['mooplace'];
		$villegeplace=$_POST['villegeplace'];
		$provinceidplace=$_POST['provinceidplace'];
		$amphuridplace=$_POST['amphuridplace'];
		$districtidplace=$_POST['districtidplace'];
		$datetouch=$_POST['datetouch'];
		$typeanimal=$_POST['typeanimal'];
		$typeother=$_POST['typeother'];
		$ageanimal=$_POST['ageanimal'];
		$statusanimal=$_POST['statusanimal'];
		$detain=$_POST['detain'];
		$detaindate=$_POST['detaindate'];
		$historyvacine=$_POST['historyvacine'];
		$historyvacine_within=$_POST['historyvacine_within'];
		$reasonbite=$_POST['reasonbite'];
		$causedetail=$_POST['causedetail'];
		$causetext=$_POST['causetext'];
		$headanimal=$_POST['headanimal'];
		$headanimalplace=$_POST['headanimalplace'];
		$otherheadanimalplace=$_POST['otherheadanimalplace'];
		$batteria=$_POST['batteria'];
		$washbefore=$_POST['washbefore'];
		$washbeforedetail=$_POST['washbeforedetail'];
		$washbeforetext=$_POST['washbeforetext'];
		$putdrug=$_POST['putdrug'];
		$putdrugdetail=$_POST['putdrugdetail'];
		$putdrugtext=$_POST['putdrugtext'];
		$historyprotect=$_POST['historyprotect'];
		$historyprotectdetail=$_POST['historyprotectdetail'];
		$use_rig=$_POST['use_rig'];
		$erig_hrig=$_POST['erig_hrig'];
		$erig_no=$_POST['erig_no'];
		$hrig_no=$_POST['hrig_no'];
		$quantityiu=$_POST['quantityiu'];
		$weight_patient=$_POST['weight_patient'];
		$daterig=$_POST['daterig'];
		$after_rig=$_POST['after_rig'];
		$after_rigdetail1=$_POST['after_rigdetail1'];
		$after_rigdetail2=$_POST['after_rigdetail2'];
		$after_rigdetail3=$_POST['after_rigdetail3'];
		$after_rigdetail4=$_POST['after_rigdetail4'];
		$after_rigdetail5=$_POST['after_rigdetail5'];
		$after_rigdetail6=$_POST['after_rigdetail6'];
		$after_rigdetail7=$_POST['after_rigdetail7'];
		$after_rigtext=$_POST['after_rigtext'];
		$longfeel=$_POST['longfeel'];
		$datelongfeel=$_POST['datelongfeel'];
		$cure_comment=$_POST['cure_comment'];
		$means=$_POST['means'];
		$after_vaccine=$_POST['after_vaccine'];
		$after_vaccine_detail1=$_POST['after_vaccine_detail1'];
		$after_vaccine_detail2=$_POST['after_vaccine_detail2'];
		$after_vaccine_detail3=$_POST['after_vaccine_detail3'];
		$after_vaccine_detail4=$_POST['after_vaccine_detail4'];
		$after_vaccine_detail5=$_POST['after_vaccine_detail5'];
		$after_vaccine_detail6=$_POST['after_vaccine_detail6'];
		$after_vaccine_detail7=$_POST['after_vaccine_detail7'];
		$after_vaccine_text=$_POST['after_vaccine_text'];
		$after_vaccine_date=$_POST['after_vaccine_date'];
		$after_vaccine_cure_comment=$_POST['after_vaccine_cure_comment'];
		$closecase=$_POST['closecase'];
		$closecase_reason=$_POST['closecase_reason'];
		$closecase_reason_detail1=$_POST['closecase_reason_detail1'];
		$closecase_reason_detail2=$_POST['closecase_reason_detail2']; 
		$doctorname=$_POST['doctorname'];
		$reportname=$_POST['reportname'];
		$positionname=$_POST['positionname'];
		$reportdate=$_POST['reportdate'];
		$head=$_POST['head'];
		$face=$_POST['face'];
		$neck=$_POST['neck'];
		$hand=$_POST['hand'];
		$arm=$_POST['arm'];
		$body=$_POST['body'];
		$leg=$_POST['leg'];
		$feet=$_POST['feet'];
		$head_bite_blood=$_POST['head_bite_blood'];
		$head_bite_noblood=$_POST['head_bite_noblood'];
		$head_claw_blood=$_POST['head_claw_blood'];
		$head_claw_noblood=$_POST['head_claw_noblood'];
		$head_lick_blood=$_POST['head_lick_blood'];
		$head_lick_noblood=$_POST['head_lick_noblood'];
		$face_bite_blood=$_POST['face_bite_blood'];
		$face_bite_noblood=$_POST['face_bite_noblood'];
		$face_claw_blood=$_POST['face_claw_blood'];
		$face_claw_noblood=$_POST['face_claw_noblood'];
		$face_lick_blood=$_POST['face_lick_blood'];
		$face_lick_noblood=$_POST['face_lick_noblood'];
		$neck_bite_blood=$_POST['neck_bite_blood'];
		$neck_bite_noblood=$_POST['neck_bite_noblood'];
		$neck_claw_blood=$_POST['neck_claw_blood'];
		$neck_claw_noblood=$_POST['neck_claw_noblood'];
		$neck_lick_blood=$_POST['neck_lick_blood'];
		$neck_lick_noblood=$_POST['neck_lick_noblood'];
		$hand_bite_blood=$_POST['hand_bite_blood'];
		$hand_bite_noblood=$_POST['hand_bite_noblood'];
		$hand_claw_blood=$_POST['hand_claw_blood'];
		$hand_claw_noblood=$_POST['hand_claw_noblood'];
		$hand_lick_blood=$_POST['hand_lick_blood'];
		$hand_lick_noblood=$_POST['hand_lick_noblood'];
		$arm_bite_blood=$_POST['arm_bite_blood'];
		$arm_bite_noblood=$_POST['arm_bite_noblood'];
		$arm_claw_blood=$_POST['arm_claw_blood'];
		$arm_claw_noblood=$_POST['arm_claw_noblood'];
		$arm_lick_blood=$_POST['arm_lick_blood'];
		$arm_lick_noblood=$_POST['arm_lick_noblood'];
		$body_bite_blood=$_POST['body_bite_blood'];
		$body_bite_noblood=$_POST['body_bite_noblood'];
		$body_claw_blood=$_POST['body_claw_blood'];
		$body_claw_noblood=$_POST['body_claw_noblood'];
		$body_lick_blood=$_POST['body_lick_blood'];
		$body_lick_noblood=$_POST['body_lick_noblood'];
		$leg_bite_blood=$_POST['leg_bite_blood'];
		$leg_bite_noblood=$_POST['leg_bite_noblood'];
		$leg_claw_blood=$_POST['leg_claw_blood'];
		$leg_claw_noblood=$_POST['leg_claw_noblood'];
		$leg_lick_blood=$_POST['leg_lick_blood'];
		$leg_lick_noblood=$_POST['leg_lick_noblood'];
		$feet_bite_blood=$_POST['feet_bite_blood'];
		$feet_bite_noblood=$_POST['feet_bite_noblood'];
		$feet_claw_blood=$_POST['feet_claw_blood'];
		$feet_claw_noblood=$_POST['feet_claw_noblood'];
		$feet_lick_blood=$_POST['feet_lick_blood'];
		$feet_lick_noblood=$_POST['feet_lick_noblood'];
		$food_dangerous=$_POST['food_dangerous'];		
		$vaccine_date=$_POST['vaccine_date'];
		$vaccine_name=$_POST['vaccine_name'];
		$vaccine_no=$_POST['vaccine_no'];
		$vaccine_cc=$_POST['vaccine_cc'];
		$vaccine_point=$_POST['vaccine_point'];
		$byname=$_POST['byname'];
		$byplace=$_POST['byplace'];
		
			//var_dump($statusid);exit;
				if($process=='insert'){				
						$datetoday=date('Y')+543;
						$datetoday=$datetoday.'-'.date('m-d H:i:s');
						if($statusid=='1'){ 
							$idcard=$cardW0.$cardW1.$cardW2.$cardW3.$cardW4;						
						}else if($statusid=='2'){
							$idcard=$idpassport;
						}
					 $Chk_Duplicate=$DB->NUMROWS($DB->QUERY("SELECT historyid FROM  n_history WHERE idcard ='".$idcard."' AND statusid='".$statusid."' AND idcard!=''"));
						if($addnewinform=='addnewinform'){$Chk_Duplicate=0;}	
							if($Chk_Duplicate==0){		
										if($chkage=='Y'){
												$age=0;
												$age_group=1;
										}else if($age < 1){
												$age=0;
												$age_group=1;
										}else if($age>=1 && $age <=5){
												$age=$age;
												$age_group=2;
										}else if($age>=6 && $age <=10){
												$age=$age;
												$age_group=3;
										}else if($age>=11 && $age <=15){
												$age=$age;
												$age_group=4;
										}else if($age>=16 && $age <=25){
												$age=$age;
												$age_group=5;
										}else if($age>=26 && $age <=35){
												$age=$age;
												$age_group=6;
										}else if($age>=36 && $age <=45){
												$age=$age;
												$age_group=7;
										}else if($age>=46 && $age <=55){
												$age=$age;
												$age_group=8;
										}else if($age>=56 && $age <=65){
												$age=$age;
												$age_group=9;
										}else if($age>=66){
												$age=$age;
												$age_group=10;
										}
										if($nationality=='1'){
											$nationalityname=$nationality;
										}else if($nattionality=='2'){
											$nationalityname=$nationalityname;
										}
										if($occupationname_b!='0'){
												$occupationname=$occupationname_b;
										}else{
												$occupationname=$occupationname;
										}
						/// table n_historty
						if($addnewinform=='addnewinform'){		
						$DB->QUERY("update n_history set 
																		idcard = '".$idcard."' ,
																		statusid = '".$statusid."' , 
																		firstname ='".$firstname."' , 
																		surname = '".$surname."' , 
																		age = '".$age."' ,
																		age_group = '".$age_group."' ,
																		gender = '".$gender."' ,
																		marryname = '".$marryname."' ,
																		nationalityname = '".$nationalityname."' ,
																		othernationalityname = '".$othernationalityname."' ,
																		typeforeign = '".$typeforeign."' ,
																		occupationname = '".$occupationname."' ,
																		otheroccupationname = '".$otheroccupationname."' ,
																		nohome = '".$nohome."' ,
																		moo = '".$moo."' ,
																		villege = '".$villege."' ,
																		soi = '".$soi."' ,
																		road = '".$road."' ,
																		provinceid = '".$provinceid."' ,
																		amphurid = '".$amphurid."' ,
																		districtid = '".$districtid."' ,
																		telephone = '".$telephone."' ,
																		occparentsname = '".$occparentsname."' ,
																		otheroccparentsname = '".$otheroccparentsname."' ,
																		updatetime = '".$datetoday."' ,
																		prefix_name='".$prefix_name."'
																		WHERE historyid = '".$historyid."'");
						}else{
								$sql="insert into n_history 
																			( idcard, statusid, firstname,
																			surname, age, age_group, gender, marryname, 
																			nationalityname, othernationalityname, 
																			typeforeign, occupationname, otheroccupationname, 
																			nohome, moo, villege, soi, road, provinceid, 
																			amphurid, districtid, telephone, occparentsname, 
																			otheroccparentsname,updatetime,created,prefix_name)
																	values
																			('".$idcard."', '".$statusid."', '".$firstname."', 
																			'".$surname."', '".$age."', '".$age_group."', '".$gender."', '".$marryname."', 
																			'".$nationalityname."', '".$othernationalityname."', 
																			'".$typeforeign."', '".$occupationname."', '".$otheroccupationname."', 
																			'".$nohome."', '".$moo."', '".$villege."', '".$soi."', '".$road."', '".$provinceid."', 
																			'".$amphurid."', '".$districtid."', '".$telephone."', '".$occparentsname."', 
																			'".$occparentsname."','".$datetoday."','".$datetoday."','".$prefix_name."')";
								//echo $sql;
								$DB->QUERY($sql);
								
							}
						/// End table n_history
								//table n_information
								if($head_bite_blood=='1' || $head_bite_noblood=='1' || $head_claw_blood=='1'|| $head_claw_noblood=='1'|| $head_lick_blood=='1'|| $head_lick_noblood=='1' ){
									$head='1';
								}
								if($face_bite_blood=='1' || $face_bite_noblood=='1' || $face_claw_blood=='1'|| $face_claw_noblood=='1'|| $face_lick_blood=='1'|| $face_lick_noblood=='1' ){
									$face='1';
								}
								if($neck_bite_blood=='1' || $neck_bite_noblood=='1' || $neck_claw_blood=='1'|| $neck_claw_noblood=='1'|| $neck_lick_blood=='1'|| $neck_lick_noblood=='1' ){
									$neck='1';
								}
								if($hand_bite_blood=='1' || $hand_bite_noblood=='1' || $hand_claw_blood=='1'|| $hand_claw_noblood=='1'|| $hand_lick_blood=='1'|| $hand_lick_noblood=='1' ){
									$hand='1';
								}
								if($arm_bite_blood=='1' || $arm_bite_noblood=='1' || $arm_claw_blood=='1'|| $arm_claw_noblood=='1'|| $arm_lick_blood=='1'|| $arm_lick_noblood=='1' ){
									$arm='1';
								}
								if($body_bite_blood=='1' || $body_bite_noblood=='1' || $body_claw_blood=='1'|| $body_claw_noblood=='1'|| $body_lick_blood=='1'|| $body_lick_noblood=='1' ){
									$body='1';
								}
								if($leg_bite_blood=='1' || $leg_bite_noblood=='1' || $leg_claw_blood=='1'|| $leg_claw_noblood=='1'|| $leg_lick_blood=='1'|| $leg_lick_noblood=='1' ){
									$leg='1';
								}
								if($feet_bite_blood=='1' || $feet_bite_noblood=='1' || $feet_claw_blood=='1'|| $feet_claw_noblood=='1'|| $feet_lick_blood=='1'|| $feet_lick_noblood=='1' ){
									$feet='1';
								}
								//--------------------------chk_total_vaccine-----------------------------
								if($means!='3' && $means!=''){		
									$total_vaccine=0;
									for($c=0;$c<count($vaccine_name);$c++){
											if($vaccine_date[$c]!='' && $vaccine_name[$c]!='' && $vaccine_cc[$c]!='' && $vaccine_point[$c]!='' ){
												$total_vaccine++;
											}
									}
									if($total_vaccine>=4 && $means=='2'){
												if($vaccine_point[4]==2){
														$package=1;
												}else if($vaccine_point[4]==1){
														$package=2;
												}
									}
								}
								//-----------------------end chk_total_vaccine--------------------------
								if($historyid==''){
									$rechistoryid=$DB->FETCHARRAY($DB->QUERY("SELECT historyid FROM n_history ORDER BY historyid DESC"));
									$historyid=$rechistoryid['historyid'];
								}
									$DB->QUERY("insert into n_information
																			( information_historyid, hospitalprovince, 
																			hospitalamphur, hospitalcode, 
																			hn, hn_no, placetouch, detailplacetouch, 
																			mooplace, villegeplace, provinceidplace, 
																			amphuridplace, districtidplace, datetouch, 
																			typeanimal, typeother, ageanimal, statusanimal, 
																			detain, detaindate, historyvacine, historyvacine_within, 
																			reasonbite, causedetail, causetext, headanimal, 
																			headanimalplace, otherheadanimalplace, 
																			batteria, washbefore, washbeforedetail, 
																			washbeforetext, putdrug, putdrugdetail, 
																			putdrugtext, historyprotect, historyprotectdetail, 
																			use_rig, erig_hrig, erig_no, hrig_no, 
																			quantityiu, weight_patient, daterig, after_rig, 
																			after_rigdetail1, after_rigdetail2, after_rigdetail3, 
																			after_rigdetail4, after_rigdetail5, after_rigdetail6, 
																			after_rigdetail7, after_rigtext, longfeel, 
																			datelongfeel, cure_comment, means, after_vaccine, 
																			after_vaccine_detail1, after_vaccine_detail2, 
																			after_vaccine_detail3, after_vaccine_detail4, 
																			after_vaccine_detail5, after_vaccine_detail6, 
																			after_vaccine_detail7, after_vaccine_text, 
																			after_vaccine_date, after_vaccine_cure_comment, 
																			closecase, closecase_reason, closecase_reason_detail1, 
																			closecase_reason_detail2, doctorname, 
																			reportname, positionname, reportdate, 
																			head, face, neck, hand, arm, body, leg, 
																			feet, head_bite_blood, head_bite_noblood, 
																			head_claw_blood, head_claw_noblood, head_lick_blood, 
																			head_lick_noblood, face_bite_blood, face_bite_noblood, 
																			face_claw_blood, face_claw_noblood, face_lick_blood, 
																			face_lick_noblood, neck_bite_blood, neck_bite_noblood, 
																			neck_claw_blood, neck_claw_noblood, neck_lick_blood, 
																			neck_lick_noblood, hand_bite_blood, hand_bite_noblood, 
																			hand_claw_blood, hand_claw_noblood, hand_lick_blood, 
																			hand_lick_noblood, arm_bite_blood, arm_bite_noblood, 
																			arm_claw_blood, arm_claw_noblood, arm_lick_blood, 
																			arm_lick_noblood, body_bite_blood, body_bite_noblood, 
																			body_claw_blood, body_claw_noblood, body_lick_blood, 
																			body_lick_noblood, leg_bite_blood, leg_bite_noblood, 
																			leg_claw_blood, leg_claw_noblood, leg_lick_blood, 
																			leg_lick_noblood, feet_bite_blood, feet_bite_noblood, 
																			feet_claw_blood, feet_claw_noblood, feet_lick_blood, 
																			feet_lick_noblood, food_dangerous,in_out,total_vaccine,updatetime,package,created)
																	values
																			('".$historyid."', '".$hospitalprovince."', 
																			'".$hospitalamphur."', '".$hospital."', 
																			'".$hn."', '".$hn_no."', '".$placetouch."', '".$detailplacetouch."', 
																			'".$mooplace."', '".$villegeplace."', '".$provinceidplace."', 
																			'".$amphuridplace."', '".$districtidplace."', '".cld_date2my($datetouch)."', 
																			'".$typeanimal."', '".$typeother."', '".$ageanimal."', '".$statusanimal."', 
																			'".$detain."', '".$detaindate."', '".$historyvacine."', '".$historyvacine_within."', 
																			'".$reasonbite."', '".$causedetail."', '".$causetext."', '".$headanimal."', 
																			'".$headanimalplace."', '".$otherheadanimalplace."', 
																			'".$batteria."', '".$washbefore."', '".$washbeforedetail."', 
																			'".$washbeforetext."', '".$putdrug."', '".$putdrugdetail."', 
																			'".$putdrugtext."', '".$historyprotect."', '".$historyprotectdetail."', 
																			'".$use_rig."', '".$erig_hrig."', '".$erig_no."', '".$hrig_no."',
																			'".$quantityiu."', '".$weight_patient."', '".cld_date2my($daterig)."', '".$after_rig."', 
																			'".$after_rigdetail1."', '".$after_rigdetail2."', '".$after_rigdetail3."', 
																			'".$after_rigdetail4."', '".$after_rigdetail5."', '".$after_rigdetail6."', 
																			'".$after_rigdetail7."', '".$after_rigtext."', '".$longfeel."', 
																			'".cld_date2my($datelongfeel)."', '".$cure_comment."', '".$means."', '".$after_vaccine."', 
																			'".$after_vaccine_detail1."', '".$after_vaccine_detail2."', 
																			'".$after_vaccine_detail3."', '".$after_vaccine_detail4."', 
																			'".$after_vaccine_detail5."', '".$after_vaccine_detail6."', 
																			'".$after_vaccine_detail7."', '".$after_vaccine_text."', 
																			'".cld_date2my($after_vaccine_date)."', '".$after_vaccine_cure_comment."', 
																			'".$closecase."', '".$closecase_reason."', '".$closecase_reason_detail1."', 
																			'".$closecase_reason_detail2."', '".$doctorname."', 
																			'".$reportname."', '".$positionname."', '".cld_date2my($reportdate)."', 
																			'".$head."', '".$face."', '".$neck."', '".$hand."', '".$arm."', '".$body."', '".$leg."', 
																			'".$feet."', '".$head_bite_blood."', '".$head_bite_noblood."', 
																			'".$head_claw_blood."', '".$head_claw_noblood."', '".$head_lick_blood."', 
																			'".$head_lick_noblood."', '".$face_bite_blood."', '".$face_bite_noblood."', 
																			'".$face_claw_blood."', '".$face_claw_noblood."', '".$face_lick_blood."', 
																			'".$face_lick_noblood."', '".$neck_bite_blood."', '".$neck_bite_noblood."', 
																			'".$neck_claw_blood."', '".$neck_claw_noblood."', '".$neck_lick_blood."', 
																			'".$neck_lick_noblood."', '".$hand_bite_blood."', '".$hand_bite_noblood."', 
																			'".$hand_claw_blood."', '".$hand_claw_noblood."', '".$hand_lick_blood."', 
																			'".$hand_lick_noblood."', '".$arm_bite_blood."', '".$arm_bite_noblood."', 
																			'".$arm_claw_blood."', '".$arm_claw_noblood."', '".$arm_lick_blood."', 
																			'".$arm_lick_noblood."', '".$body_bite_blood."', '".$body_bite_noblood."', 
																			'".$body_claw_blood."', '".$body_claw_noblood."', '".$body_lick_blood."', 
																			'".$body_lick_noblood."', '".$leg_bite_blood."', '".$leg_bite_noblood."', 
																			'".$leg_claw_blood."', '".$leg_claw_noblood."', '".$leg_lick_blood."', 
																			'".$leg_lick_noblood."', '".$feet_bite_blood."', '".$feet_bite_noblood."', 
																			'".$feet_claw_blood."', '".$feet_claw_noblood."', '".$feet_lick_blood."', 
																			'".$feet_lick_noblood."', '".$food_dangerous."','".$in_out."','".$total_vaccine."','".$datetoday."',
																			'".$package."','".$datetoday."')");
												//end information
									$recinformation=$DB->FETCHARRAY($DB->QUERY("SELECT id FROM n_information WHERE information_historyid='".$historyid."' ORDER BY id DESC"));
									$information_id=$recinformation['id'];
												
										//table n_vaccine		
									if($means!='3' && $means!=''){		
												for($i=0;$i<5;$i++){
															if($vaccine_date[$i]!=''){
																$DB->QUERY("insert into n_vaccine 
																								(information_id, vaccine_date, 
																								vaccine_name, vaccine_no, vaccine_cc, 
																								vaccine_point, byname, byplace,updatetime,created)
																								values
																								('".$information_id."', '".cld_date2my($vaccine_date[$i])."', 
																								'".$vaccine_name[$i]."', '".$vaccine_no[$i]."', '".$vaccine_cc[$i]."', 
																								'".$vaccine_point[$i]."', '".$byname[$i]."', '".$byplace[$i]."','".$datetoday."','".$datetoday."')");	
															}	
													}
										}
										//End n_vaccine
										
										/***************** START   บันทึก log **********************/
										if($hn){
											$label="hn  ";
											$label_val=$hn;
										}else{
											$label="เลขบัตรประชาชน / เลขที่ passport  ";
											$label_val=$idcard;
										}
										save_log($process,$title_log,$label,$label_val);								
										/***************** END   บันทึก log **********************/
											?>
											<form action="inform_hn.php" method="post" name="formreturn">
													<script language="javascript">
														alert('ได้ทำการเพิ่มรายละเอียดคนไข้เรียบร้อยแล้ว');
														document.formreturn.submit();
													</script>
												</form>
										<?
								}else{
									if($statusid=='1'){
											$alert_name='เลขบัตรประชาชนซ้ำ';
									}else if($statusid=='2'){
											$alert_name='เลขที่ passport';
									}
											?>
												<form action="inform.php" method="post" name="formreturn">
                                                	<input type="hidden" name="prefix_name" value="<?php echo $prefix_name?>"  />                                                    
													<input type="hidden" name="historyid" value="<?=$historyid?>">
													<input type="hidden" name="statusid" value="<?=$statusid?>">
													<input type="hidden" name="firstname" value="<?=$firstname?>">
													<input type="hidden" name="surname" value="<?=$surname?>">
													<input type="hidden" name="idpassport" value="<?=$idpassport?>">
													<input type="hidden" name="chkage" value="<?=$chkage?>">
													<input type="hidden" name="gender" value="<?=$gender?>">
													<input type="hidden" name="age" value="<?=$age?>">
													<input type="hidden" name="marryname"  value="<?=$marryname?>">
													<input type="hidden" name="age_group"  value="<?=$age_group?>">
													<input type="hidden" name="nationality"  value="<?=$nationality?>">
													<input type="hidden" name="nationalityname" value="<?=$nationalityname?>">
													<input type="hidden" name="othernationalityname"   value="<?=$othernationalityname?>">
													<input type="hidden" name="typeforeign" value="<?=$typeforeign?>">
													<input type="hidden" name="occupationname" value="<?=$occupationname?>">
													<input type="hidden" name="otheroccupationname" value="<?=$otheroccupationname?>">
													<input type="hidden" name="nohome" value="<?=$nohome?>">
													<input type="hidden" name="moo" value="<?=$moo?>">
													<input type="hidden" name="villege" value="<?=$villege?>">
													<input type="hidden" name="soi" value="<?=$soi?>">
													<input type="hidden" name="road" value="<?=$road?>">
													<input type="hidden" name="provinceid" value="<?=$provinceid?>">
													<input type="hidden" name="amphurid" value="<?=$amphurid?>">
													<input type="hidden" name="districtid" value="<?=$districtid?>">
													<input type="hidden" name="telephone" value="<?=$telephone?>">
													<input type="hidden" name="occparentsname" value="<?=$occparentsname?>">
													<input type="hidden" name="otheroccparentsname" value="<?=$otheroccparentsname?>">
													
													<input type="hidden" name="hospitalprovince" value="<?=$hospitalprovince?>">
													<input type="hidden" name="hospitalamphur" value="<?=$hospitalamphur?>">
													<input type="hidden" name="hospitalcode" value="<?=$hospitalcode?>">
													<input type="hidden" name="hn" value="<?=$hn?>">
													<input type="hidden" name="hn_no" value="<?=$hn_no?>">
													<input type="hidden" name="placetouch" value="<?=$placetouch?>">
													<input type="hidden" name="detailplacetouch" value="<?=$detailplacetouch?>">
													<input type="hidden" name="mooplace" value="<?=$mooplace?>">
													<input type="hidden" name="villegeplace" value="<?=$villegeplace?>">
													<input type="hidden" name="provinceidplace" value="<?=$provinceidplace?>">
													<input type="hidden" name="amphuridplace" value="<?=$amphuridplace?>">
													<input type="hidden" name="districtidplace" value="<?=$districtidplace?>">
													<input type="hidden" name="datetouch" value="<?=$datetouch?>">
													<input type="hidden" name="typeanimal" value="<?=$typeanimal?>">
													<input type="hidden" name="typeother" value="<?=$typeother?>">
													<input type="hidden" name="ageanimal" value="<?=$ageanimal?>">
													<input type="hidden" name="statusanimal" value="<?=$statusanimal?>">
													<input type="hidden" name="detain" value="<?=$detain?>">
													<input type="hidden" name="detaindate" value="<?=$detaindate?>">
													<input type="hidden" name="historyvacine" value="<?=$historyvacine?>">
													<input type="hidden" name="historyvacine_within" value="<?=$historyvacine_within?>">
													<input type="hidden" name="reasonbite" value="<?=$reasonbite?>">
													<input type="hidden" name="causedetail" value="<?=$causedetail?>">
													<input type="hidden" name="causetext" value="<?=$causetext?>">
													<input type="hidden" name="headanimal" value="<?=$headanimal?>">
													<input type="hidden" name="headanimalplace" value="<?=$headanimalplace?>">
													<input type="hidden" name="otherheadanimalplace" value="<?=$otherheadanimalplace?>">
													<input type="hidden" name="batteria" value="<?=$batteria?>">
													<input type="hidden" name="washbefore" value="<?=$washbefore?>">
													<input type="hidden" name="washbeforedetail" value="<?=$washbeforedetail?>">
													<input type="hidden" name="washbeforetext" value="<?=$washbeforetext?>">
													<input type="hidden" name="putdrug" value="<?=$putdrug?>">
													<input type="hidden" name="putdrugdetail" value="<?=$putdrugdetail?>">
													<input type="hidden" name="putdrugtext" value="<?=$putdrugtext?>">
													<input type="hidden" name="historyprotect" value="<?=$historyprotect?>">
													<input type="hidden" name="historyprotectdetail" value="<?=$historyprotectdetail?>">
													<input type="hidden" name="use_rig" value="<?=$use_rig?>">
													<input type="hidden" name="erig_hrig" value="<?=$erig_hrig?>">
													<input type="hidden" name="erig_no" value="<?=$erig_no?>">
													<input type="hidden" name="hrig_no" value="<?=$hrig_no?>">
													<input type="hidden" name="quantityiu" value="<?=$quantityiu?>">
													<input type="hidden" name="weight_patient" value="<?=$weight_patient?>">
													<input type="hidden" name="daterig" value="<?=$daterig?>">
													<input type="hidden" name="after_rig" value="<?=$after_rig?>">
													<input type="hidden" name="after_rigdetail1" value="<?=$after_rigdetail1?>">
													<input type="hidden" name="after_rigdetail2" value="<?=$after_rigdetail2?>">
													<input type="hidden" name="after_rigdetail3" value="<?=$after_rigdetail3?>">
													<input type="hidden" name="after_rigdetail4" value="<?=$after_rigdetail4?>">
													<input type="hidden" name="after_rigdetail5" value="<?=$after_rigdetail5?>">
													<input type="hidden" name="after_rigdetail6" value="<?=$after_rigdetail6?>">
													<input type="hidden" name="after_rigdetail7" value="<?=$after_rigdetail7?>">
													<input type="hidden" name="after_rigtext" value="<?=$after_rigtext?>">
													<input type="hidden" name="longfeel" value="<?=$longfeel?>">
													<input type="hidden" name="datelongfeel" value="<?=$datelongfeel?>">
													<input type="hidden" name="cure_comment" value="<?=$cure_comment?>">
													<input type="hidden" name="means" value="<?=$means?>">
													<input type="hidden" name="after_vaccine" value="<?=$after_vaccine?>">
													<input type="hidden" name="after_vaccine_detail1" value="<?=$after_vaccine_detail1?>">
													<input type="hidden" name="after_vaccine_detail2" value="<?=$after_vaccine_detail2?>">
													<input type="hidden" name="after_vaccine_detail3" value="<?=$after_vaccine_detail3?>">
													<input type="hidden" name="after_vaccine_detail4" value="<?=$after_vaccine_detail4?>">
													<input type="hidden" name="after_vaccine_detail5" value="<?=$after_vaccine_detail5?>">
													<input type="hidden" name="after_vaccine_detail6" value="<?=$after_vaccine_detail6?>">
													<input type="hidden" name="after_vaccine_detail7" value="<?=$after_vaccine_detail7?>">
													<input type="hidden" name="after_vaccine_text" value="<?=$after_vaccine_text?>">
													<input type="hidden" name="after_vaccine_date" value="<?=$after_vaccine_date?>">
													<input type="hidden" name="after_vaccine_cure_comment" value="<?=$after_vaccine_cure_comment?>">
													<input type="hidden" name="closecase" value="<?=$closecase?>">
													<input type="hidden" name="closecase_reason" value="<?=$closecase_reason?>">
													<input type="hidden" name="closecase_reason_detail1" value="<?=$closecase_reason_detail1?>">
													<input type="hidden" name="closecase_reason_detail2" value="<?=$closecase_reason_detail2?>">
													<input type="hidden" name="doctorname" value="<?=$doctorname?>">
													<input type="hidden" name="reportname" value="<?=$reportname?>">
													<input type="hidden" name="positionname" value="<?=$positionname?>">
													<input type="hidden" name="reportdate" value="<?=$reportdate?>">
													<input type="hidden" name="head_bite_blood" value="<?=$head_bite_blood?>">
													<input type="hidden" name="head_bite_noblood" value="<?=$head_bite_noblood?>">
													<input type="hidden" name="head_claw_blood" value="<?=$head_claw_blood?>">
													<input type="hidden" name="head_claw_noblood" value="<?=$head_claw_noblood?>">
													<input type="hidden" name="head_lick_blood" value="<?=$head_lick_blood?>">
													<input type="hidden" name="head_lick_noblood" value="<?=$head_lick_noblood?>">
													<input type="hidden" name="face_bite_blood" value="<?=$face_bite_blood?>">
													<input type="hidden" name="face_bite_noblood" value="<?=$face_bite_noblood?>">
													<input type="hidden" name="face_claw_blood" value="<?=$face_claw_blood?>">
													<input type="hidden" name="face_claw_noblood" value="<?=$face_claw_noblood?>">
													<input type="hidden" name="face_lick_blood" value="<?=$face_lick_blood?>">
													<input type="hidden" name="face_lick_noblood" value="<?=$face_lick_noblood?>">
													<input type="hidden" name="neck_bite_blood" value="<?=$neck_bite_blood?>">
													<input type="hidden" name="neck_bite_noblood" value="<?=$neck_bite_noblood?>">
													<input type="hidden" name="neck_claw_blood" value="<?=$neck_claw_blood?>">
													<input type="hidden" name="neck_claw_noblood" value="<?=$neck_claw_noblood?>">
													<input type="hidden" name="neck_lick_blood" value="<?=$neck_lick_blood?>">
													<input type="hidden" name="neck_lick_noblood" value="<?=$neck_lick_noblood?>">
													<input type="hidden" name="hand_bite_blood" value="<?=$hand_bite_blood?>">
													<input type="hidden" name="hand_bite_noblood" value="<?=$hand_bite_noblood?>">
													<input type="hidden" name="hand_claw_blood" value="<?=$hand_claw_blood?>">
													<input type="hidden" name="hand_claw_noblood" value="<?=$hand_claw_noblood?>">
													<input type="hidden" name="hand_lick_blood" value="<?=$hand_lick_blood?>">
													<input type="hidden" name="hand_lick_noblood" value="<?=$hand_lick_noblood?>">
													<input type="hidden" name="arm_bite_blood" value="<?=$arm_bite_blood?>">
													<input type="hidden" name="arm_bite_noblood" value="<?=$arm_bite_noblood?>">
													<input type="hidden" name="arm_claw_blood" value="<?=$arm_claw_blood?>">
													<input type="hidden" name="arm_claw_noblood" value="<?=$arm_claw_noblood?>">
													<input type="hidden" name="arm_lick_blood" value="<?=$arm_lick_blood?>">
													<input type="hidden" name="arm_lick_noblood" value="<?=$arm_lick_noblood?>">
													<input type="hidden" name="body_bite_blood" value="<?=$body_bite_blood?>">
													<input type="hidden" name="body_bite_noblood" value="<?=$body_bite_noblood?>">
													<input type="hidden" name="body_claw_blood" value="<?=$body_claw_blood?>">
													<input type="hidden" name="body_claw_noblood" value="<?=$body_claw_noblood?>">
													<input type="hidden" name="body_lick_blood" value="<?=$body_lick_blood?>">
													<input type="hidden" name="body_lick_noblood" value="<?=$body_lick_noblood?>">
													<input type="hidden" name="leg_bite_blood" value="<?=$leg_bite_blood?>">
													<input type="hidden" name="leg_bite_noblood" value="<?=$leg_bite_noblood?>">
													<input type="hidden" name="leg_claw_blood" value="<?=$leg_claw_blood?>">
													<input type="hidden" name="leg_claw_noblood" value="<?=$leg_claw_noblood?>">
													<input type="hidden" name="leg_lick_blood" value="<?=$leg_lick_blood?>">
													<input type="hidden" name="leg_lick_noblood" value="<?=$leg_lick_noblood?>">
													<input type="hidden" name="feet_bite_blood" value="<?=$feet_bite_blood?>">
													<input type="hidden" name="feet_bite_noblood" value="<?=$feet_bite_noblood?>">
													<input type="hidden" name="feet_claw_blood" value="<?=$feet_claw_blood?>">
													<input type="hidden" name="feet_claw_noblood" value="<?=$feet_claw_noblood?>">
													<input type="hidden" name="feet_lick_blood" value="<?=$feet_lick_blood?>">
													<input type="hidden" name="feet_lick_noblood" value="<?=$feet_lick_noblood?>">
													<input type="hidden" name="food_dangerous" value="<?=$food_dangerous?>">
													
													<? for($k=0;$k<count($vaccine_date);$k++){?>
														<input type="hidden" name="vaccine_date[<?=$k?>]" value="<?=$vaccine_date[$k]?>">
														<input type="hidden" name="vaccine_name[<?=$k?>]" value="<?=$vaccine_name[$k]?>">
														<input type="hidden" name="vaccine_no[<?=$k?>]" value="<?=$vaccine_no[$k]?>">
														<input type="hidden" name="vaccine_cc[<?=$k?>]" value="<?=$vaccine_cc[$k]?>">
														<input type="hidden" name="vaccine_point[<?=$k?>]" value="<?=$vaccine_point[$k]?>">
														<input type="hidden" name="byname[<?=$k?>]" value="<?=$byname[$k]?>">
														<input type="hidden" name="byplace[<?=$k?>]" value="<?=$byplace[$k]?>">
													<? }?>
													<script language="javascript">
														alert('<?=$alert_name?> กรุณาตรวจสอบ');
														document.formreturn.submit();
													</script>
												</form>
										<?
								}
				}
		if($process=='addnew'){ 
			$idcard=$cardW0.$cardW1.$cardW2.$cardW3.$cardW4;
			//echo "idcard =".$idcard."<br/>";
			//echo "historyid =".$historyid."<br/>";
			if($historyid!=''){
				$rechistory=$DB->FETCHARRAY($DB->QUERY("SELECT *FROM n_history WHERE historyid='".$historyid."'"));
			}else{
				$rechistory=$DB->FETCHARRAY($DB->QUERY("SELECT *FROM n_history WHERE idcard='".$idcard."'"));
			}
					$prefix_name=$rechistory['prefix_name'];
					$cardW0=substr($rechistory['idcard'],0,1);
					$cardW1=substr($rechistory['idcard'],1,4);
					$cardW2=substr($rechistory['idcard'],5,5);
					$cardW3=substr($rechistory['idcard'],10,2);
					$cardW4=substr($rechistory['idcard'],12,13);
					$historyid=$rechistory['historyid'];
					$firstname=$rechistory['firstname'];
					$surname=$rechistory['surname'];
					$age=$rechistory['age'];
					$age_group=$rechistory['age_group'];
					$gender=$rechistory['gender'];
					$marryname=$rechistory['marryname'];
					$nationality=$rechistory['nationalityname'];
					if($nationality!='1'){
						$nationalityname=$rechistory['nationalityname'];
					}
					$othernationalityname=$rechistory['othernationalityname'];
					$typeforeign=$rechistory['typeforeign'];
					$occupationname=$rechistory['occupationname'];
					$otheroccupationname=$rechistory['otheroccupationname'];
					$nohome=$rechistory['nohome'];
					$moo=$rechistory['moo'];
					$villege=$rechistory['villege'];
					$soi=$rechistory['soi'];
					$road=$rechistory['road'];
					$provinceid=$rechistory['provinceid'];
					$amphurid=$rechistory['amphurid'];
					$districtid=$rechistory['districtid'];
					$telephone=$rechistory['telephone'];
					$occparentsname=$rechistory['occparentsname'];
					$otheroccparentsname=$rechistory['otheroccparentsname'];
					$value_disabled=' disabled="disabled"';
		}
		if($cardW0!=''){
			$value_disabled=' disabled="disabled"';
		}
		if($historyid){
			$sql="SELECT id FROM n_information WHERE information_historyid='".$historyid."'";
			//echo $sql;
			$counthn_no=$DB->NUMROWS($DB->QUERY($sql));
		}          	  

}// empty session
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?=$titlepage?></title>
<link href="css/Styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/checkobj.js"></script>
<!---<script language="JavaScript"  type="text/javascript" src="js/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="js/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="js/calendar-th.js"></script>
<script src="js/selectlist2.js" language="javascript1.2"></script>
<script src="js/AjaxRequest.js" language="javascript1.2"></script>-->
<script src="js/jquery/jquery-1.4.2.js" type="text/javascript"></script>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<script src="js/jquery/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/jquery/jquery.livequery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery/jquery.datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="js/jquery/jquery.datepick/jquery.datepick-th.js"></script>
<link type="text/css" href="js/jquery/jquery.datepick/redmond.datepick.css" rel="stylesheet" />

<style type="text/css">
<!--
.style1 {color: #E60000}
.style2 {color: #669966}
.style3 {color: #6394bd}
-->
</style>
<script type="text/javascript">
var means
function show_hide_clear_means(){
means=$('input[name=means]:checked').val();
var information_id=$('input[name=information_id]').val();
var tomorrow,clear;
	if(means=="2" || means=="1"){		
			if(means=="2"){
				$("#meanstr tr:eq(5)").hide();
			}else{
				$("#meanstr tr:eq(5)").show();
			}
			if(information_id ==''){			
				for(clear=0;clear<5;clear++)
				{
								if(means=="2" && clear==3){continue;}							
								if($("#vaccine_date["+clear+"]").val() == '' || typeof $("#vaccine_date["+clear+"]").val() == "undefined"){											
										var tomorrow=increment_vaccine_date($('#datetouch').val(),clear);							
											if( means=="2" && clear==4){  
												document.getElementById("vaccine_date[3]").value=tomorrow;
											}else{
												document.getElementById("vaccine_date["+clear+"]").value=tomorrow;	
											}	
								}//vaccine_date							
				 }//for
			 }
			$("#meanstr").css('display','');
			$('#after_symptom_vaccine').css('display','');
		}else{
				$("#meanstr").css('display','none');
				$('#after_symptom_vaccine').css('display','none');
				for(clear=0;clear<5;clear++){
					$("#vaccine_date["+clear+"]").val('');
					$("#vaccine_name["+clear+"]").val('0');
					$("#vaccine_no["+clear+"]").val('');
					$("#vaccine_cc["+clear+"]").val('');
					$("#vaccine_point["+clear+"]").val('');
					$("#byname["+clear+"]").val('');
					//document.getElementById("byplace["+clear+"]").value='';
				}
		}
}//function
function calculateClose(dateText, inst)
{
		means=$('#means:checked').val();
		if(dateText!='')
		{
			var dt = dateText;
			selectdate = dt.split('/');
			if(selectdate[2].length=="4"){
			
			}else{
				dt = selectdate[2]+'/'+selectdate[1]+'/'+(parseInt(selectdate[0])+543);
			}					
			this.value = dt;		
			if(document.getElementById("vaccine_date[0]").value==dt){			
				for(var clear=0;clear<5;clear++){
						if(means=="2" && clear==3){continue;}			
						var tomorrow=increment_vaccine_date(dt,clear);					
						if( means=="2" && clear==4){  
							document.getElementById("vaccine_date[3]").value=tomorrow;					
						}else{
							document.getElementById("vaccine_date["+clear+"]").value=tomorrow;	
						}													
				}//for
			}//if
		}//if dateText
}//function
function  disableChkage(){
	var prefix=$('select[name=prefix_name] option:selected').index();
	$('input[name=chkage]').attr('disabled',true);
	if(prefix==4 || prefix==5){
		$('input[name=chkage]').attr('disabled',false);
	}
	if(prefix==1 || prefix==4){
		$("input[name=gender]").eq(0).attr('checked','checked');
	}else{
		$("input[name=gender]").eq(1).attr('checked','checked');
	}
}
$(document).ready(function(){
$.datepick.regional['th'] = {
		clearText: 'ลบ', clearStatus: '',
		closeText: 'ปิด', closeStatus: '',
		prevText: '&laquo;&nbsp;ย้อน', prevStatus: '',
		prevBigText: '&#x3c;&#x3c;', prevBigStatus: '',
		nextText: 'ถัดไป&nbsp;&raquo;', nextStatus: '',
		nextBigText: '&#x3e;&#x3e;', nextBigStatus: '',
		currentText: 'วันนี้', currentStatus: '',
		monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
		monthStatus: '', yearStatus: '',
		weekHeader: 'Sm', weekStatus: '',
		dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
		dayNamesShort: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		dayStatus: 'DD', dateStatus: 'D, M d',
		dateFormat: 'yy/mm/dd', firstDay: 0,
		initStatus: '', isRTL: false,
		beforeShow: calculateShow,
		onClose: calculateClose,
		showMonthAfterYear: false, yearSuffix: ''};		
		$.datepick.setDefaults($.datepick.regional['th']);	


$('.datepicker').datepick({format: 'Y-m-d', showOn: 'both', buttonImageOnly: true, buttonImage: 'js/jquery/jquery.datepick/calendar.gif' },$.datepick.regional['th']);  
//$('input[name=means]').click(show_hide_clear_means);
$('input[name=means]').change(show_hide_clear_means);
$('input[name=chkage]').attr('disabled',true);
$('select[name=prefix_name]').change(disableChkage);
$('select[name=prefix_name]').click(disableChkage);
	var ref1,ref3;
	$("#provinceid").change(function(){
		ref1=$("#provinceid option:selected").val();
		$.ajax({
			type:'get',
			url:'js/getlist.php',
			data:'mode=A_amphur&ref1='+ref1,
			success:function(data){
				$("#address_amphur").html(data);
				$("#districtid").val('');
			}
		});
	});
	$("#amphurid").livequery('change',function(){	
		var ref2=$("#amphurid option:selected").val();
		$.ajax({
			type:'get',
			url:'js/getlist.php',
			data:'mode=A_district&ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#address_district").html(data);
			}
		})
	});


 <? if($_SESSION['R36_HOSPITAL']==''){?>
	$("#hospitalprovince").change(function(){
		var ref4=$("#hospitalprovince option:selected").val();
		$.ajax({
			type:'get',		
			url:'js/getlist.php',
			data:'mode=History_hospital_amphur&ref1='+ref4,
			success:function(data){
				$("#input_Hamphur").html(data);				
			}	
		});				
	});	
	<?php } ?>


	$("input[name=placetouch]").click(function(){
		var obj=$(this).val();
		var ref,mode;
		mode="place_amp";
		if(obj=="1"){
			ref=10;
			ref3=10;	
			$('#districtidplace').rules("add",{required: true, messages: { required: "ระบุตำบล"}});
			$('#amphuridplace').rules("add",{required: true,  messages: { required: "ระบุอำเภอ"}});
		
			$("#amphur_place").find('span').html('*');	
		}else if(obj=="2"){
			ref=20;	
			$("#amphur_place").find('span').html('');	
			$("#input_place_district").html('<select name="districtidplace" class="textbox" id="districtidplace"><option value="">-โปรดเลือก-</option></select>');
			$('#districtidplace').rules("remove", "required");
			$('#amphuridplace').rules("remove", "required");
			mode="place_amppattaya";
		}else if(obj=="3" || obj=="4"){
			ref='';
			ref3='';
			$("#amphur_place").find('span').html('*');	
			$('#districtidplace').rules("add",{required: true, messages: { required: "ระบุตำบล"}});
			$('#amphuridplace').rules("add",{required: true,  messages: { required: "ระบุอำเภอ"}});
		}
		show_hide_clear_placetouch(document.form1);	
		 $.ajax({
		 	type:'get',
			url:'js/getlist.php',
			data:'mode=place_pv&ref1='+ref,
			success:function(data){
				$("#input_place_province").html(data);
			}
		 })
		 $.ajax({
			type:'get',
			url:'js/getlist.php',
			data:'mode='+mode+'&ref1='+ref,
			success:function(data){
				$("#input_place_amphur").html(data);			
			}
		 })
	});
		 $("#provinceidplace").livequery('change',function(){
	  		ref3=$("#provinceidplace option:selected").val();
		 	$.ajax({
		 	type:'get',
			url:'js/getlist.php',
			data:'mode=place_amp&ref1='+ref3,
			success:function(data){
				$("#input_place_amphur").html(data);
				$("#districtidplace").val('');
			}
		 });
	});
	$("#amphuridplace").livequery('change',function(){
		var ref4=$("#amphuridplace option:selected").val();
		$.ajax({
			type:'get',		
			url:'js/getlist.php',
			data:'mode=place_district&ref1='+ref3+'&ref2='+ref4,
			success:function(data){
				$("#input_place_district").html(data);
				$("#districtidplace").val('');
			}	
		});		
	});

	if(ref3=="20"){
		$("#amphur_place").find(span).html('');
	}
	
	
		/***********  prevent double submit  ***********/
	$("input[type=submit]").attr( 'disabled',false); 
	 $.validator.setDefaults({
		   	  submitHandler: function() {	
			  	 
				   var answer;							
					var idcard=$('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val();
					var digit_last=$('#cardW4').val();
					$.ajax({
						type:'get',
						url:'chk_idcard.php',
						data:'idcard='+idcard+'&digit_last='+digit_last,
						dataType: "json",
						success:function(data){									  							
							if(data.chk=="no"){
								alert("กรุณาระบุบัตรประชาชนให้ถูกต้องและครบถ้วน");						
							}else{							
								/***********  prevent double submit  ***********/
								
								$('input[name=cardW0]').removeAttr('disabled');
								$('input[name=cardW1]').removeAttr('disabled');
								$('input[name=cardW2]').removeAttr('disabled');
								$('input[name=cardW3]').removeAttr('disabled');
								$('input[name=cardW4]').removeAttr('disabled');
								$('select[name=statusid]').removeAttr('disabled');
								$('input[name=hn_s]').removeAttr('disabled');
								$(":disabled").removeAttr('disabled');
								$("input[type=submit]").attr( 'disabled',true); 	
								document.form1.submit();								
							}// if*/							
						}//success function
					})// ajax				
			}	//submitHandler			
	  });// validator.setDefaults
	 
	$("#form1").validate({
		rules:{
			firstname:"required",
			surname:"required",
			age:{
				required:true,
				number:true
			},
			provinceid:"required",
			amphurid:"required",
			districtid:"required",		
		     doctorname:"required",
			 reportname:"required",
			 positionname:"required",
			 reportdate:"required",
			 telephone:{
			 		required:true,
					minlength:6,
					maxlength:10
			},
			 datetouch:"required",	
			 provinceidplace:"required",
			// amphuridplace:"required",		
			// districtidplace:"required",			
			 typeanimal:"required",
			 ageanimal:"required",
			statusanimal:"required",
			historyvacine:"required",
			historyprotect:"required",
			use_rig:"required",
			means:"required"
			  
		},
		messages:{
			firstname:"ระบุชื่อ",
			surname:"ระบุนามสกุล",
			age:{
			required:"ระบุอายุ",
			number:"ระบุตัวเลขเท่านั้น"
			},			
			provinceid:"ระบุจังหวัด",
			amphurid:"ระบุอำเภอ",
			districtid:"ระบุตำบล",
			doctorname:"ระบุแพทย์",
			 reportname:"ระบุผู้รายงาน",
			 positionname:"ระบุตำแหน่ง",
			 reportdate:"ระบุวันที่รายงาน",
			 telephone:{
			 		required:"ระบุเบอร์โทร",
					minlength:"ระบุอย่างน้อย 6 หลัก",
					maxlength:"ระบุเกินกว่า 10 หลัก"
				},
			 datetouch:"ระบุวันที่สัมผัสโรค"	,
			 provinceidplace:"ระบุจังหวัด",
			// amphuridplace:"ระบุอำเภอ",			
			// districtidplace:"ระบุตำบล",			 
			 typeanimal:"ระบุชนิดสัตว์",
			 ageanimal:"ระบุอายุสัตว์",
			statusanimal:"ระบุสถานภาพสัตว์",
			historyvacine:"ระบุประวัติฉีดวัคซีน",
			historyprotect:"ระบุประวัติฉีดวัคซีน",
			use_rig:"ระบุการฉีดอิมมูโนโกลบูลิน",
			means:"ระบุการฉีดโดยวิธี"	 
		},
			errorPlacement: function(error, element){								
				if((element.attr('name')=='firstname') || (element.attr('name')=='surname') || (element.attr('name')=='age'))
				{					
					element.next().html(error);				
				}else{
					if(element.is(':radio'))
					{ 
						var name=element.attr('name');
						$('input[name='+name+']').eq($('input[name='+name+']').length-1).closest("td").next().find('span').html(error);
						if(name=='use_rig' || name =='means')$('input[name='+name+']').eq($('input[name='+name+']').length-1).closest("td").find('span').html(error);
					}else{
					error.appendTo(element.parent());
					}
				}						
			}	
	});	

// ????????????????????????????
 	if($('input[name=information_id]').val()==''){
			var today= new Date();
			var dd = today.getDate();
			var mm = today.getMonth() +1;
			var y = today.getFullYear()+543;
			var tomorrow = dd + '/' + mm + '/' + y;
			$('#datetouch').val(tomorrow);
	}	
	
});
</script>
</head>
<body>
<table width="750" border="0" cellspacing="0" cellpadding="0" align="left" height="100%">
  <tr>
    	<td valign="top" height="1">
		 <? include("comtop.php");?>
	 	</td>
  </tr>
  <tr>
    <td valign="top" height="400" class="pattern"><br>
	<form id="form1" name="form1" method="post" action="<?=$_SERVER['PHP_SELF'];?>" > 
		<input name="process" type="hidden" value="insert" />
		<input type="hidden" name="information_id"   />
		<input type="hidden" name="historyid"  value="<?=$historyid?>"/>
		<input type="hidden" name="idcard"  id="idcard"  />
		<input type="hidden" name="in_out"  value="<?=$in_out?>" />
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="100%" height="30" bgcolor="#6E94B7"><div align="center" class="headtable">รายงานผู้สัมผัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า ( คนไข้<? if($in_out=='2'){echo 'นอก';}else if($in_out=='1'){echo 'ใน';}?>เขตอำเภอ ) </div></td>
              </tr>
              <tr>
                <td align="center" bgcolor="#C3DAEB">
				จังหวัด<span class="alertred">*</span>
				<select name="hospitalprovince" class="textbox" disabled="disabled" id="hospitalprovince"
				<? if($_SESSION['R36_HOSPITAL']==''){?>
					 onchange="	url='js/getlist.php?mode=History_hospital_amphur&ref1='+form1.hospitalprovince.value;load_divForm(url,'input_Hamphur'); "
					<?	
					}
				?>
				>
					<option value="">-โปรดเลือก-</option>
					<?
					if($_SESSION['R36_PROVINCE']!='' && $_SESSION['R36_LEVEL']=='02'){
						$wh="AND province_id='".$_SESSION['R36_PROVINCE']."'";
					}else if($_SESSION['R36_HOSPITAL_PROVINCE']!=''){
						$wh="AND province_id='".$_SESSION['R36_HOSPITAL_PROVINCE']."'";
					}
					$query_h_province=$DB->QUERY("SELECT province_id,province_name FROM n_province WHERE province_id!='' $wh ORDER BY province_name ASC");
						while($rec_h_province=$DB->FETCHARRAY($query_h_province)){
					?>
						<option value="<?=$rec_h_province['province_id'];?>" <? if($rec_h_province['province_id']==$hospitalprovince){ echo 'selected';}?>><?=$rec_h_province['province_name'];?></option>
					<?	
					}
					?>
				</select>
				อำเภอ<span class="alertred">*</span>
			<span id="input_Hamphur">
				<select name="hospitalamphur" class="textbox" disabled="disabled">
						<option value="">-โปรดเลือก-</option>
						<?
						 if($_SESSION['R36_HOSPITAL_AMPHUR']!=''){
								$whamphur="AND amphur_id ='".$_SESSION['R36_HOSPITAL_AMPHUR']."' AND province_id='".$_SESSION['R36_HOSPITAL_PROVINCE']."' ";
						}else if($hospitalprovince){
								$whamphur="AND province_id ='".$hospitalprovince."'";
						}
						if($whamphur!=''){
							$queryh_h_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur  WHERE amphur_id <> '' $whamphur ORDER BY amphur_name ASC");
									while($rech_h_amphur=$DB->FETCHARRAY($queryh_h_amphur)){
									?>
									<option value="<?=$rech_h_amphur['amphur_id']?>" <? if($rech_h_amphur['amphur_id']==$hospitalamphur){echo 'selected';}?>><?=$rech_h_amphur['amphur_name'];?></option>
									<?
									}
							}
						?>
					</select>
				</span> 
				 โรงพยาบาล<span class="alertred">*</span>
				<span id="input_Hospital">
					<select name="hospital" class="textbox" disabled="disabled">
						<option value="">-โปรดเลือก-</option>
								<?
								if($_SESSION['R36_LEVEL']!='05'){
									 if($hospitalamphur){
										$whhospital="AND hospital_province_id='".$hospitalprovince."' AND hospital_amphur_id ='".$hospitalamphur."'  ";
									}
							 	}else if($_SESSION['R36_HOSPITAL']!=''){
									$whhospital="AND hospital_code ='".$_SESSION['R36_HOSPITAL']."'";
									$hospital=$_SESSION['R36_HOSPITAL'];
								}								
								/*if($_SESSION['R36_HOSPITAL']!='' && $_SESSION['R36_HOSPITAL']!='0' ){
										$whhospital="AND hospital_code ='".$_SESSION['R36_HOSPITAL']."'";
								}else if($hospitalamphur){
										$whhospital="AND hospital_province_id='".$hospitalprovince."' AND hospital_amphur_id ='".$hospitalamphur."' ";
								}*/
								if($whhospital!=''){
									$query_hospital=$DB->QUERY("SELECT hospital_code,hospital_name FROM n_hospital WHERE hospital_id<>'' $whhospital ORDER BY hospital_name ASC");
										while($rec_hospital=$DB->FETCHARRAY($query_hospital)){
										?>
										<option value="<?=$rec_hospital['hospital_code'];?>" <? if($rec_hospital['hospital_code']==$hospital){echo 'selected';}?>><?=$rec_hospital['hospital_name'];?></option>
										<?
										}
									}
								?>
					</select>
				</span> 
			    </td>
              </tr>
              <tr>
                <td bgcolor="#C3DAEB">
				<div align="center">
					HN <span class="alertred">*</span> &nbsp;
					<input name="hn_s" type="text" class="textbox" value="<?=$hn?>" size="20"  readonly=""> - <input type="text" name="hn_no" size="2" value="<? if($counthn_no!=0){echo $counthn_no+1;}else{echo 1;}?>" class="textbox" onKeyPress="return NumberOnly();" style="text-align:center" readonly>
					<input name="hospitalprovince" type="hidden"value="<?=$hospitalprovince?>" >
					<input name="hospitalamphur" type="hidden"value="<?=$hospitalamphur?>" >
					<input name="hospital" type="hidden"value="<?=$hospital?>" >
					<input name="hn" type="hidden"value="<?=$hn?>" >
				</div>
				</td>
              </tr>
              <tr>
                <td bgcolor="#C3DAEB" align="center">
				<? if($process=='addnew'){ 
							echo '<input name="statusid" type="hidden"value="'.$statusid.'" >';
							echo '<input name="idpassport" type="hidden"value="'.$idpassport.'" >';
							echo '<input name="cardW0" type="hidden"value="'.$cardW0.'" >';
							echo '<input name="cardW1" type="hidden"value="'.$cardW1.'" >';
							echo '<input name="cardW2" type="hidden"value="'.$cardW2.'" >';
							echo '<input name="cardW3" type="hidden"value="'.$cardW3.'" >';
							echo '<input name="cardW4" type="hidden"value="'.$cardW4.'" >';
							echo '<input name="addnewinform" type="hidden"value="addnewinform" >';
				
				}
				 if($statusid==''){$statusid=1;}?>
					เลขประจำตัวประชาชน/เลขที่ passport : 
					<select name="statusid"  class="textbox" onChange="return selectType_id(this.value);" <?=$value_disabled?>>
						<option value="1" <? if($statusid=='1'){ echo 'checked';}?>>เลขประจำตัวประชาชน</option>
						<option value="2" <? if($statusid=='2'){ echo 'checked';}?>>เลขที่ passport</option>
					</select>
					&nbsp;&nbsp;
					<span id="Show_idpassport" <? if($statusid=='1'){print "style='display:none'";}?>>
						<input name="idpassport" type="text" class="textbox" value="<?=$idpassport;?>" size="20" maxlength="50" <?=$value_disabled?>>
					</span>
					<span id="Show_idcard" <? if($statusid=='2'){print 'style = "display:none"';  }?>> 
						<input name="cardW0" id="cardW0" type="text" class="textbox" size="1" maxlength="1" value="<?=$cardW0?>" onKeyPress="return NumberOnly();" onKeyUp=" if(this.value.length==1) {this.form.cardW1.value='';this.form.cardW1.focus();}" <?=$value_disabled?> />
						  -
						  <input name="cardW1"  id="cardW1" type="text" class="textbox" size="4" maxlength="4"  value="<?=$cardW1?>" onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==4){this.form.cardW2.value='';this.form.cardW2.focus();}" <?=$value_disabled?>/>
						  -
						  <input name="cardW2"  id="cardW2" type="text" class="textbox" size="5" maxlength="5"   value="<?=$cardW2?>" onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==5){this.form.cardW3.value='';this.form.cardW3.focus();}" <?=$value_disabled?>/>
						  -
						  <input name="cardW3" id="cardW3" type="text" class="textbox" size="2" maxlength="2"  value="<?=$cardW3?>" onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==2){this.form.cardW4.value='';this.form.cardW4.focus();}" <?=$value_disabled?>/>
						  -
						<input name="cardW4" id="cardW4" type="text" class="textbox" size="1" maxlength="1"  value="<?=$cardW4?>"  onKeyPress="return NumberOnly();" onKeyUp="if(this.value.length==1){FChkCardID(this.form);}" <?=$value_disabled?>/>				
					</span>&nbsp;&nbsp;<input name="checkerHN" type="button" value="ตรวจสอบ" class="Submit"  onClick="m = window.open('popup_chk_idcard.php?process=insert&idpassport='+form1.idpassport.value+'&cardW0='+form1.cardW0.value+'&cardW1='+form1.cardW1.value+'&cardW2='+form1.cardW2.value+'&cardW3='+form1.cardW3.value+'&cardW4='+form1.cardW4.value+'','popup_chk_idcard','width=500,height=425,location=0,scrollbars=1');m.focus();" <?=$value_disabled?>>
				</td>
              </tr>
              <tr>
                <td align="center" bgcolor="#C3DAEB">
					
				</td>
              </tr>
            </table>
			</td>
		  </tr>
		  <tr>
		  	<td height="30" colspan="4" bgcolor="#6E94B7" class="topic">ส่วนที่ 1 : ข้อมูลทั่วไป</td>
		  </tr>
		  <tr>
			<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#C3DAEB">
				  <tr>
					<td width="3%" valign="top">1.1</td>
					<td width="97%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                      <tr>
					  <td valign="top">
					   คำนำหน้า : <select name="prefix_name" class="textbox">
							 	<option value="">- โปรดเลือก -</option>
								<option value="นาย" <?php  echo ($prefix_name=='นาย')? "selected='selected'":"" ?>>นาย</option>
								<option value="นาง" <?php  echo ($prefix_name=='นาง')? "selected='selected'":"" ?>>นาง</option>
								<option value="นางสาว" <?php  echo ($prefix_name=='นางสาว')? "selected='selected'":"" ?>>นางสาว</option>
								<option value="ด.ช." <?php  echo ($prefix_name=='ด.ช.')? "selected='selected'":"" ?>>ด.ช.</option>
								<option value="ด.ญ." <?php  echo ($prefix_name=='ด.ญ.')? "selected='selected'":"" ?>>ด.ญ.</option>							
							 </select>
					  </td>
					  </tr>
					  <tr>
                        <td valign="top">
							
							 ชื่อ<span class="alertred">*</span> :
                               <input name="firstname" type="text" class="textbox" id="firstname" value="<?=$firstname;?>" size="20" />
							   <span></span> &nbsp;&nbsp;
							  นามสกุล<span class="alertred">*</span> :
                              <input name="surname" type="text" value="<?=$surname;?>" size="20"  class="textbox">
							  <span></span>&nbsp;&nbsp;
							อายุ<span class="alertred">*</span> :
                            <input name="age" id="age"  type="text" size="2" maxlength="2" value="<?=$age;?>" class="textbox"  onKeyUp="chk_than15(this.value);">
							<span></span> &nbsp;&nbsp;
							 ปี (
                             <input name="chkage" type="checkbox" value="Y" <? if($chkage=='Y'){print "checked";}?> onClick="chk_than1(document.form1);"/>
                        ต่ำกว่า 1 ปี  ) </p>
					    </td>
					</tr>
					<tr><td>
							เพศ : <input name="gender" type="radio" value="1" <? if($gender=='1'){ print "checked";}?>> ชาย&nbsp;&nbsp;
							  		 <input name="gender" type="radio" value="2" <? if($gender=='2'){ print "checked";}?>> หญิง</td>
						
                      </tr>
                      <tr>
                        <td>สถานภาพสมรส: <input name="marryname" type="radio" value="1" <? if($marryname=='1'){print "checked";}?>> โสด&nbsp;&nbsp;<input name="marryname" type="radio" value="2" <? if($marryname=='2'){print "checked";}?>> คู่&nbsp;&nbsp;<input name="marryname" type="radio" value="3" <? if($marryname=='3'){print "checked";}?>> หย่าร้าง&nbsp;&nbsp;<input name="marryname" type="radio" value="4" <? if($marryname=='4'){print "checked";}?>> หม้าย</td>
                      </tr>
                      <tr>
                        <td height="40">
						สัญชาติ : <input name="nationality" type="radio" value="1" <? if($nationality=='1'){ print "checked";}?> onClick="show_hide_nationality(document.form1);"> ไทย&nbsp;&nbsp;<input name="nationality" type="radio" value="2" <? if($nationality=='2'){ print "checked";}?> onClick="show_hide_nationality(document.form1);"> อื่นๆ 
						<span id="nationality_tr1" <? if($nationality!='2'){ print 'style = "display:none"';}?>>
						สัญชาติ :&nbsp; 
							<select name="nationalityname"  class="textbox" onChange="show_hide_clear_nationality_text(this)">
								<option value="0" <? if($nationalityname=='0'){print "selected";}?>>เลือกสัญชาติ</option>
								<option value="2" <? if($nationalityname=='2'){print "selected";}?>>จีน/ฮ่องกง/ใต้หวัน</option>
								<option value="3" <? if($nationalityname=='3'){print "selected";}?>>พม่า</option>
								<option value="4" <? if($nationalityname=='4'){print "selected";}?>>มาเลเซีย</option>
								<option value="5" <? if($nationalityname=='5'){print "selected";}?>>กัมพูชา</option>
								<option value="6" <? if($nationalityname=='6'){print "selected";}?>>ลาว</option>
								<option value="7" <? if($nationalityname=='7'){print "selected";}?>>เวียดนาม</option>
								<option value="8" <? if($nationalityname=='8'){print "selected";}?>>ยุโรป</option>
								<option value="9" <? if($nationalityname=='9'){print "selected";}?>>อเมริกา</option>
								<option value="10" <? if($nationalityname=='10'){print "selected";}?>>ไม่ทราบสัญชาติ</option>
								<option value="11" <? if($nationalityname=='11'){print "selected";}?>>อื่นๆ</option>
                          </select>&nbsp;
							<span id="nationality_div" <? if($nationalityname!='11'){ print 'style = "display:none"';}?>>
								  <span class="alertred">(โปรดระบุ)</span>&nbsp;
								  <input name="othernationalityname" id="othernationalityname" type="text" value="<?=$othernationalityname;?>" class="textbox" size="20">
						  </span>
						</span>
						</td>
                      </tr>
                      <tr>
                        <td height="30">&nbsp;
						<span id="nationality_tr2" <? if($nationality!='2'){ print 'style = "display:none"';}?>>
						เลือกประเภทของต่างด้าว :&nbsp;
                          <select name="typeforeign"  class="textbox">
								<option value="0">เลือกประเภท</option>
								<option value="1" <? if($typeforeign=='1'){ print "selected";}?>>ชาวต่างด้าวที่เข้ามาขายแรงงาน</option>
								<option value="2" <? if($typeforeign=='2'){ print "selected";}?>>ชาวต่างด้าวที่เข้ามารักษาเมื่อหายแล้วกลับประเทศ</option>
								<option value="3" <? if($typeforeign=='3'){ print "selected";}?>>นักท่องเที่ยว</option>
						  </select>
						  </span>
					    </td>
                      </tr>
                      <tr>
                        <td>
							อาชีพขณะสัมผัสโรค :&nbsp;
							<select name="occupationname" class="textbox" onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_than15">
								  <option value="0" <? if($occupationname=='0'){ echo 'selected';}?>>- กรุณาเลือกอาชีพ -</option>
								  <option value="1" <? if($occupationname=='1'){ echo 'selected';}?>>นักเรียน นักศึกษา</option>
								  <option value="2" <? if($occupationname=='2'){ echo 'selected';}?>>ในปกครอง</option>
								  <option value="3" <? if($occupationname=='3'){ echo 'selected';}?>>เกษตร ทำนา ทำสวน</option>
								  <option value="4" <? if($occupationname=='4'){ echo 'selected';}?>>ข้าราชการ</option>
								  <option value="5"  <? if($occupationname=='5'){ echo 'selected';}?>>กรรมกร</option>
								  <option value="6" <? if($occupationname=='6'){ echo 'selected';}?>>รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)</option>
								  <option value="7" <? if($occupationname=='7'){ echo 'selected';}?>>ค้าขาย</option>
								  <option value="8" <? if($occupationname=='8'){ echo 'selected';}?>>งานบ้าน</option>
								  <option value="9" <? if($occupationname=='9'){ echo 'selected';}?>>ทหาร ตำรวจ</option>
								  <option value="10" <? if($occupationname=='10'){ echo 'selected';}?>>ประมง</option>
								  <option value="11" <? if($occupationname=='11'){ echo 'selected';}?>>ครู</option>
								  <option value="12" <? if($occupationname=='12'){ echo 'selected';}?>>เลี้ยงสัตว์ / จับสุนัข</option>
								  <option value="13" <? if($occupationname=='13'){ echo 'selected';}?>>นักบวช / ภิกษุสามเณร</option>
								  <option value="14" <? if($occupationname=='14'){ echo 'selected';}?>>ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ</option>
								  <option value="15" <? if($occupationname=='15'){ echo 'selected';}?>>สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า</option>
								  <option value="16"<? if($occupationname=='16'){ echo 'selected';}?>>อาสาสมัครฉีดวัคซีนสุนัข</option>
								  <option value="17" <? if($occupationname=='17'){ echo 'selected';}?>>เจ้าหน้าที่สวนสัตว์</option>
								  <option value="18" <? if($occupationname=='18'){ echo 'selected';}?>>ไปรษณีย์</option>
								  <option value="19" <? if($occupationname=='19'){ echo 'selected';}?>>ป่าไม้</option>
								  <option value="20" <? if($occupationname=='20'){ echo 'selected';}?>>พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า</option>
								  <option value="21" <? if($occupationname=='21'){ echo 'selected';}?>>อื่นๆ (ระบุ)</option>
							</select>
							
							<select name="occupationname_b" class="textbox" onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_less15">
								  <option value="0" <? if($occupationname_b=='0'){ echo 'selected';}?>>- กรุณาเลือกอาชีพ -</option>
								  <option value="1" <? if($occupationname_b=='1'){ echo 'selected';}?>>นักเรียน นักศึกษา</option>
								  <option value="2" <? if($occupationname_b=='2'){ echo 'selected';}?>>ในปกครอง</option>
							</select>&nbsp;&nbsp;
						<? if($age>15){ 
										echo	"<script>document.getElementById ('occupation_less15').style.display='none'</script>";
								}else{ 
										echo	"<script>document.getElementById ('occupation_than15').style.display='none'</script>";
								}
						?>
							<span  id="otheroccupationname_tr" <? if($occupationname!='20'){ print 'style = "display:none"'; }?>>
							<span class="alertred">(โปรดระบุ)&nbsp;
						<input name="otheroccupationname" id="otheroccupationname"  type="text" class="textbox" size="10" value="<?=$otheroccupationname;?>" /></span>
						</span>
						</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr>
                            <td width="10%">ที่อยู่ปัจจุบัน</td>
                            <td width="8%"><div align="right">เลขที่ : </div></td>
                            <td width="19%">
                              <input name="nohome" type="text" class="textbox" size="20" value="<?=$nohome;?>"></td>
                            <td width="12%"><div align="right">หมู่ที่ : </div></td>
                            <td width="19%"><input name="moo" type="text" class="textbox" size="20" value="<?=$moo;?>" /></td>
                            <td width="11%"><div align="right">หมู่บ้าน : </div></td>
                            <td width="21%"><input name="villege" type="text" class="textbox" size="20" value="<?=$villege;?>"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><div align="right">ซอย : </div></td>
                            <td><input name="soi" type="text" class="textbox" size="20" value="<?=$soi;?>" /></td>
                            <td><div align="right">ถนน : </div></td>
                            <td><input name="road" type="text" class="textbox" id="road" value="<?=$road;?>" size="20" /></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><div align="right">จังหวัด<span class="alertred">*</span> :</div></td>
                            <td>
							<select name="provinceid"  class="textbox"  id="provinceid">
								<option value="">-โปรดเลือก-</option>
								<?
								$query_province=$DB->QUERY("SELECT province_id,province_name FROM n_province WHERE province_id!='' ORDER BY province_name ASC");
									while($rec_province=$DB->FETCHARRAY($query_province)){
								?>
									<option value="<?=$rec_province['province_id'];?>" <? if($rec_province['province_id']==$provinceid){ echo 'selected';}?>><?=$rec_province['province_name'];?></option>
								<?	
								}
								?>
                            </select>                            
							</td>
                            <td><div align="right">อำเภอ/เขต<span class="alertred">*</span> : </div></td>
                            <td>
							<span id="address_amphur">
							<select name="amphurid"  class="textbox" 
									onchange="
										url='js/getlist.php?mode=A_district&ref1='+form1.provinceid.value+'&ref2='+form1.amphurid.value;
										load_divForm(url,'address_district');
									">
								<option value="">-โปรดเลือก-</option>
								<?
								if($provinceid!=''){
										if($amphurid!=''){
											$whamp="AND amphur_id ='".$amphurid."' AND province_id='".$provinceid."'";
										}else{
											$whamp="AND province_id='".$provinceid."'";
										}
										$query_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur WHERE amphur_id!='' $whamp ORDER BY amphur_name ASC");
											while($rec_amphur=$DB->FETCHARRAY($query_amphur)){
										?>
											<option value="<?=$rec_amphur['amphur_id'];?>" <? if($rec_amphur['amphur_id']==$amphurid){ echo 'selected';}?>><?=$rec_amphur['amphur_name'];?></option>
										<?	
										}
									}
								?>
                            </select>      
							</span>     
							</td>
                            <td><div align="right">ตำบล/แขวง<span class="alertred">*</span> : </div></td>
                            <td>
							<span id="address_district">
							<select name="districtid"  class="textbox" id="districtid">
								<option value="">-โปรดเลือก-</option>
								<?
								if($amphurid!=''){
										if($districtid!=''){
											$whdis="AND district_id ='".$districtid."' AND amphur_id ='".$amphurid."' AND province_id='".$provinceid."'";
										}else{
											$whdis="AND amphur_id ='".$amphurid."' AND province_id='".$provinceid."'";
										}
										$query_district=$DB->QUERY("SELECT district_id,district_name FROM n_district WHERE district_id!='' $whdis ORDER BY district_name ASC");
											while($rec_district=$DB->FETCHARRAY($query_district)){
										?>
											<option value="<?=$rec_district['district_id'];?>" <? if($rec_district['district_id']==$districtid){ echo 'selected';}?>><?=$rec_district['district_name'];?></option>
										<?	
										}
									}
								?>
                            </select>    
							</span>                        
							</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td ><div align="right" style="width:50px;">โทร<span class="alertred">*</span> : </div></td>
                            <td><input name="telephone" type="text" class="textbox" size="20" id="telephone" value="<?=$telephone;?>"></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="7">อาชีพผู้ปกครอง : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <select name="occparentsname"  id="occparentsname" class="textbox" onChange="show_hide_clear_otheroccparentsname(this);" <? if($age>15){ echo 'disabled="disabled"';}?> >
                                <option value="0" <? if($occparentsname=='0'){ echo 'selected';}?>>- กรุณาเลือกอาชีพ - </option>
								<option value="1" <? if($occparentsname=='1'){ echo 'selected';}?>>เกษตร ทำนา ทำสวน</option>
								<option value="2" <? if($occparentsname=='2'){ echo 'selected';}?>>ข้าราชการ</option>
								<option value="3" <? if($occparentsname=='3'){ echo 'selected';}?>>กรรมกร</option>
								<option value="4" <? if($occparentsname=='4'){ echo 'selected';}?>>รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)</option>
								<option value="5" <? if($occparentsname=='5'){ echo 'selected';}?>>ค้าขาย</option>
								<option value="6" <? if($occparentsname=='6'){ echo 'selected';}?>>งานบ้าน</option>
								<option value="7" <? if($occparentsname=='7'){ echo 'selected';}?>>ทหาร ตำรวจ</option>
								<option value="8" <? if($occparentsname=='8'){ echo 'selected';}?>>ประมง</option>
								<option value="9" <? if($occparentsname=='9'){ echo 'selected';}?>>ครู</option>
								<option value="10" <? if($occparentsname=='10'){ echo 'selected';}?>>เลี้ยงสัตว์ / จับสุนัข</option>
								<option value="11" <? if($occparentsname=='11'){ echo 'selected';}?>>นักบวช / ภิกษุสามเณร</option>
								<option value="12" <? if($occparentsname=='12'){ echo 'selected';}?>>ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ</option>
								<option value="13" <? if($occparentsname=='13'){ echo 'selected';}?>>สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า</option>
								<option value="14" <? if($occparentsname=='14'){ echo 'selected';}?>>อาสาสมัครฉีดวัคซีนสุนัข</option>
								<option value="15" <? if($occparentsname=='15'){ echo 'selected';}?>>เจ้าหน้าที่สวนสัตว์</option>
								<option value="16" <? if($occparentsname=='16'){ echo 'selected';}?>>ไปรษณีย์</option>
								<option value="17" <? if($occparentsname=='17'){ echo 'selected';}?>>ป่าไม้</option>
								<option value="18" <? if($occparentsname=='18'){ echo 'selected';}?>>พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า</option>
								<option value="19" <? if($occparentsname=='19'){ echo 'selected';}?>>อื่นๆ (ระบุ)</option>
                              </select>
							  <span id="otheroccparentsname_tr"  <? if($otheroccparentsname!='19'){ print 'style = "display:none"';}?>>
							  <span class="alertred">(โปรดระบุ)</span>
                              	<input name="otheroccparentsname" id="otheroccparentsname" type="text" class="textbox" size="10" value="<?=$otheroccparentsname;?>" />
							  </span>
							  </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top">1.2</td>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="15%" valign="top">สถานที่สัมผัสโรค : </td>
                        <td width="85%">
<!-- onClick="show_hide_clear_placetouch(document.form1);	url='js/getlist.php?mode=place_pv&ref1=10';load_divForm(url,'input_place_province');url='js/getlist.php?mode=place_amp&ref1=10';load_divForm(url,'input_place_amphur');document.getElementById ('districtidplace').value='';"-->
						<input name="placetouch" type="radio" value="1"  <? if($placetouch=='1'){ echo 'checked';}?>>  &nbsp;เขต กทม. </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>
<!--onClick="show_hide_clear_placetouch(document.form1);url='js/getlist.php?mode=place_pv&ref1=20';load_divForm(url,'input_place_province');url='js/getlist.php?mode=place_amppattaya&ref1=20';load_divForm(url,'input_place_amphur');document.getElementById ('districtidplace').value='';" -->	
						<input name="placetouch" type="radio" value="2" <? if($placetouch=='2'){ echo 'checked';}?>> &nbsp;เขตเมืองพัทยา</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="17%">
<!-- 	onClick="show_hide_clear_placetouch(document.form1);url='js/getlist.php?mode=place_pv&ref1=';load_divForm(url,'input_place_province');
		url='js/getlist.php?mode=place_amp&ref1=';load_divForm(url,'input_place_amphur');document.getElementById ('districtidplace').value='';"-->
							  <input name="placetouch" type="radio" value="3"  <? if($placetouch=='3'){ echo 'checked';}?>> &nbsp;เขตเทศบาล</td>
                              <td width="83%">
							  <span id="detailplacetouch_td1" <? if($placetouch!='3'){ print 'style = "display:none"';}?>>
								<input name="detailplacetouch" type="radio" value="1" <? if($detailplacetouch=='1'){ print "checked";}?>>นคร&nbsp;&nbsp;&nbsp;
                                <input name="detailplacetouch" type="radio" value="2"  <? if($detailplacetouch=='2'){ print "checked";}?>>เมือง&nbsp;&nbsp;&nbsp;
                                <input name="detailplacetouch" type="radio" value="3"  <? if($detailplacetouch=='3'){ print "checked";}?>>ตำบล
								</span></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="17%">
	<!-- onclick="show_hide_clear_placetouch(document.form1);url='js/getlist.php?mode=place_pv&ref1=';
			load_divForm(url,'input_place_province');url='js/getlist.php?mode=place_amp&ref1=';
			load_divForm(url,'input_place_amphur');document.getElementById ('districtidplace').value='';"-->						  
							  	<input name="placetouch" type="radio" value="4"   <? if($placetouch=='4'){ echo 'checked';}?>>&nbsp;&nbsp;เขตอบต.</td>
                              <td width="83%"><span id="detailplacetouch_td2" <? if($placetouch!='4'){ print 'style = "display:none"';}?>><input name="detailplacetouch" type="radio" value="4"  <? if($detailplacetouch=='4'){ print "checked";}?>>
                                ในชุมชน/ตลาด&nbsp;&nbsp;&nbsp;
                                <input name="detailplacetouch" type="radio" value="5"   <? if($detailplacetouch=='5'){ print "checked";}?>>
                                ชนบท</span></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td width="17%"><div align="right">หมู่ที่ : </div></td>
                              <td width="25%"><input name="mooplace" type="text" class="textbox" size="20" value="<?=$mooplace;?>"></td>
                              <td width="18%"><div align="right">หมู่บ้าน/ชุมชน : </div></td>
                              <td width="40%"><input name="villegeplace" type="text" class="textbox" size="20" value="<?=$villegeplace;?>"></td>
                            </tr>
                            <tr>
							<? if($placetouch=='1' || $placetouch=='2'){
										$wh_pt="AND province_id = '$provinceidplace'";
							}?>
                              <td><div align="right">จังหวัด<span class="alertred">*</span> : </div></td>
                              <td>
							 <span id="input_place_province">
							<select name="provinceidplace"  class="textbox"  id="provinceidplace">
								<option value="">-โปรดเลือก-</option>
								<?
								$query_province=$DB->QUERY("SELECT province_id,province_name FROM n_province WHERE province_id!='' ".$wh_pt." ORDER BY province_name ASC");
									while($rec_province=$DB->FETCHARRAY($query_province)){
								?>
									<option value="<?=$rec_province['province_id'];?>" <? if($rec_province['province_id']==$provinceidplace){ echo 'selected';}?>><?=$rec_province['province_name'];?></option>
								<?	
								}
								?>
                            </select> 
							</span>                           
							  </td>
                              <td><div align="right">อำเภอ<span class="alertred">*</span> : </div></td>
                              <td>
							  <span id="input_place_amphur">
							  <? if($placetouch!='2'){?>
							  <select name="amphuridplace"  class="textbox"  id="amphuridplace">
                                  <option value="">-โปรดเลือก-</option>
								  <?
										if($provinceidplace!=''){
										  $query_amphur=$DB->QUERY("SELECT amphur_id,amphur_name FROM n_amphur WHERE province_id = '".$provinceidplace."' ORDER BY amphur_name ASC");
												while($rec_amphur=$DB->FETCHARRAY($query_amphur)){
											?>
											<option value="<?=$rec_amphur['amphur_id'];?>" <? if($rec_amphur['amphur_id']==$amphuridplace){ echo 'selected';}?>><?=$rec_amphur['amphur_name'];?></option>
											<?	
												}
											}
								  ?>
                              </select>
							  <? }else{?>
							  <select name="amphuridplace" class="textbox" id="amphuridplace">
                                  <option value="">-โปรดเลือก-</option>
                                  <option value="99" selected="selected">เมืองพัทยา</option>
							  </select>
							  <? }?>
							  </span>
							  </td>
                            </tr>
                            <tr>
                              <td id="amphur_place"><div align="right">ตำบล/แขวง<span class="alertred">*</span> : </div></td>
                              <td>
							  <span id="input_place_district">
							  <select name="districtidplace"  class="textbox" id="districtidplace">
                                  <option value="">-โปรดเลือก-</option>
								  <?
								  		if($amphuridplace!=''){
											$query_district=$DB->QUERY("SELECT district_id,district_name FROM n_district WHERE amphur_id = '".$amphuridplace."' AND  province_id = '".$provinceidplace."'  ORDER BY district_name ASC");
												while($rec_district=$DB->FETCHARRAY($query_district)){
												?>
													<option value="<?=$rec_district['district_id'];?>" <? if($rec_district['district_id']==$districtidplace){ echo 'selected';}?>><?=$rec_district['district_name'];?></option>
												<?	
												}
										}
								  ?>
                              </select>
							  </span>
							  </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
				    <td>1.3</td>
				    <td>วันที่สัมผัสโรค : <span class="alertred">*</span>
						<!--<input name="datetouch" type="text" size="10" class="textbox" readonly="" value="<?php //echo $datetouch;?>"  onClick="return showCalendar('datetouch', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"> 
						<img src="images/calendar.gif" alt="เปิดปฏิทิน"  align="absmiddle"   onClick="return showCalendar('datetouch', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"/>-->
						<input name="datetouch" type="text" size="10"  id="datetouch" class="textbox datepicker" readonly=""  value="<?php echo $datetouch; ?>" />
					</td>
			      </tr>
				</table>			
			</td>
		  </tr>
		  <tr>
		  	<td height="30" bgcolor="#6E94B7" class="topic">ส่วนที่ 2 : ตำแหน่งและลักษณะการสัมผัส</td>
		  </tr>
		  <tr>
			<td bgcolor="#C3DAEB">
			<table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr> 
                  <td width="25%" height="216" align="left" valign="middle" bgcolor="#CCCCCC"> 
                    <table width="218" height="259" border="0" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="211" height="196" colspan="5" align="center" valign="middle" >
							<div  style="position:relative;width:222px;height:264px;background:url(images/body_man1.gif);  "  id="body_man">
										<div id="markhead" style="position:absolute; left:160px; top:15px; width:12px; height:12px; z-index:8;"></div>
										<div id="markface" style="position:absolute; left:57px; top:24px; width:12px; height:12px; z-index:1;"></div>
										<div id="markneck" style="position:absolute; left:57px; top:45px; width:12px; height:12px; z-index:2;"></div>
										<div id="markbody" style="position:absolute; left:57px; top:72px; width:12px; height:12px; z-index:3;"></div>
										<div id="markarm" style="position:absolute; left:25px; top:92px; width:12px; height:12px; z-index:4;"></div>
										<div id="markhand" style="position:absolute; left:22px; top:135px; width:12px; height:12px; z-index:5;"></div>
										<div id="markleg" style="position:absolute; left:47px; top:192px; width:12px; height:12px; z-index:6;"></div>
										<div id="markfeet" style="position:absolute; left:49px; top:232px; width:12px; height:12px; z-index:7;"></div>									
								</div>								
						</td>
                      </tr>
                    </table></td>
                  <td rowspan="2" align="left" valign="top" bgcolor="#C3DAEB"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td width="45" rowspan="5" align="center" bgcolor="#FFFFFF">ลำดับที่</td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td width="90" rowspan="5" align="center" bgcolor="#FFFFFF">ตำแหน่งที่สัมผัส</td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="20" colspan="11" align="center" bgcolor="#FFFFFF">ลักษณะการสัมผัส</td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="20" colspan="3" align="center" bgcolor="#FFFFFF"><span class="style1">ถูกกัด</span></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td colspan="3" align="center" bgcolor="#FFFFFF"><span class="style2">ถูกข่วน</span></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td colspan="3" align="center" bgcolor="#FFFFFF"><span class="style3">ถูกเลีย 
                          / ถูกน้ำลาย</span></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td height="20" align="center" bgcolor="#E60000"><font color="#FFFFFF">มีเลือดออก</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" bgcolor="#FF777A"><font color="#FFFFFF">ไม่มีเลือดออก</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"></td>
                        <td align="center" bgcolor="#669966"><font color="#FFFFFF">มีเลือดออก</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"> 
                        </td>
                        <td align="center" bgcolor="#36CF74"><font color="#FFFFFF">ไม่มีเลือดออก</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"> 
                        </td>
                        <td align="center" bgcolor="#6394bd"><font color="#FFFFFF">ที่มีแผล</font></td>
                        <td width="1" align="center" background="images/pixel.gif" bgcolor="#FFFFFF"> 
                        </td>
                        <td align="center" bgcolor="#35ADF4"><font color="#FFFFFF">ที่ไม่มีแผล</font></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
					  <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">1</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">ศีรษะ</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="head_bite_blood"  id="head_bite_blood" <? if($head_bite_blood=='1'){ echo 'checked';}?> type="checkbox" value="1"  onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="head_bite_noblood" id="head_bite_noblood" <? if($head_bite_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="head_claw_blood" id="head_claw_blood" <? if($head_claw_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="head_claw_noblood"  id="head_claw_noblood" <? if($head_claw_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="head_lick_blood" id="head_lick_blood" <? if($head_lick_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="head_lick_noblood" id="head_lick_noblood" <? if($head_lick_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#E60000"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#FF777A"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#669966"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#36CF74"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#6394bd"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#35ADF4"></td>
                        <td height="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">&nbsp;</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">หน้า</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="face_bite_blood" id="face_bite_blood" <? if($face_bite_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="face_bite_noblood"  id="face_bite_noblood" <? if($face_bite_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="face_claw_blood" id="face_claw_blood" <? if($face_claw_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="face_claw_noblood" id="face_claw_noblood" <? if($face_claw_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="face_lick_blood"  id="face_lick_blood" <? if($face_lick_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="face_lick_noblood"  id="face_lick_noblood" <? if($face_lick_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#E60000"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#FF777A"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#669966"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#36CF74"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#6394bd"></td>
                        <td height="1" background="images/pixel.gif"></td>
                        <td height="1" background="images/pixel.gif" bgcolor="#35ADF4"></td>
                        <td height="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">&nbsp;</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">ลำคอ</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="neck_bite_blood"  id="neck_bite_blood" <? if($neck_bite_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="neck_bite_noblood"  id="neck_bite_noblood" <? if($neck_bite_noblood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="neck_claw_blood"  id="neck_claw_blood" <? if($neck_claw_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="neck_claw_noblood" id="neck_claw_noblood" <? if($neck_claw_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="neck_lick_blood" id="neck_lick_blood" <? if($neck_lick_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="neck_lick_noblood" id="neck_lick_noblood" <? if($neck_lick_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">2</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">มือ</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="hand_bite_blood" id="hand_bite_blood" <? if($hand_bite_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="hand_bite_noblood" id="hand_bite_noblood" <? if($hand_bite_noblood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="hand_claw_blood" id="hand_claw_blood" <? if($hand_claw_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="hand_claw_noblood"  id="hand_claw_noblood" <? if($hand_claw_noblood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="hand_lick_blood"  id="hand_lick_blood" <? if($hand_lick_blood=='1'){ echo 'checked';}?>  type="checkbox" value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="hand_lick_noblood" id="hand_lick_noblood" <? if($hand_lick_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">3</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">แขน</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="arm_bite_blood" id="arm_bite_blood" <? if($arm_bite_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="arm_bite_noblood"  id="arm_bite_noblood" <? if($arm_bite_noblood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="arm_claw_blood" id="arm_claw_blood"  <? if($arm_claw_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="arm_claw_noblood" id="arm_claw_noblood"  <? if($arm_claw_noblood=='1'){ echo 'checked';}?>  type="checkbox" value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="arm_lick_blood" id="arm_lick_blood" <? if($arm_lick_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="arm_lick_noblood" id="arm_lick_noblood" <? if($arm_lick_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">4</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">ลำตัว</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="body_bite_blood" id="body_bite_blood" <? if($body_bite_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="body_bite_noblood" id="body_bite_noblood" <? if($body_bite_noblood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="body_claw_blood" id="body_claw_blood" <? if($body_claw_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="body_claw_noblood" id="body_claw_noblood"  <? if($body_claw_noblood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="body_lick_blood" id="body_lick_blood" <? if($body_lick_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="body_lick_noblood"  id="body_lick_noblood" <? if($body_lick_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">5</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">ขา</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="leg_bite_blood"  id="leg_bite_blood" <? if($leg_bite_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="leg_bite_noblood"  id="leg_bite_noblood" <? if($leg_bite_noblood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="leg_claw_blood" id="leg_claw_blood" <? if($leg_claw_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="leg_claw_noblood" id="leg_claw_noblood"  <? if($leg_claw_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="leg_lick_blood"  id="leg_lick_blood" <? if($leg_lick_blood=='1'){ echo 'checked';}?> type="checkbox"  value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="leg_lick_noblood"  id="leg_lick_noblood"<? if($leg_lick_noblood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td align="center">6</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center">เท้า</td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#E60000"> <input name="feet_bite_blood"  id="feet_bite_blood"<? if($feet_bite_blood=='1'){ echo 'checked';}?> type="checkbox" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="feet_bite_noblood" <? if($feet_bite_noblood=='1'){ echo 'checked';}?> type="checkbox" id="touch_type[44]" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#669966"> <input name="feet_claw_blood"  <? if($feet_claw_blood=='1'){ echo 'checked';}?> type="checkbox" id="touch_type[45]" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="feet_claw_noblood" <? if($feet_claw_noblood=='1'){ echo 'checked';}?> type="checkbox" id="touch_type[46]" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="feet_lick_blood" <? if($feet_lick_blood=='1'){ echo 'checked';}?> type="checkbox" id="touch_type[47]" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'))"></td>
                        <td width="1" align="center" background="images/pixel.gif"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="feet_lick_noblood" <? if($feet_lick_noblood=='1'){ echo 'checked';}?> type="checkbox" id="touch_type[48]" value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'))"></td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td width="1" background="images/pixel.gif"></td>
                        <td height="20" colspan="15"><input type="checkbox" name="food_dangerous" value="1" id="food_dangerous" <? if($food_dangerous=='1'){ echo 'checked';}?>>
                          กินอาหารดิบหรือดื่มน้ำที่สัมผัสเชื้อโรคพิษสุนัขบ้า</td>
                        <td width="1" background="images/pixel.gif"></td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="17" background="images/pixel.gif"></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td align="center" valign="middle" bgcolor="#C3DAEB">&nbsp;</td>
                </tr>
              </table>
		    </td>
		  </tr>
		  <tr>
			<td height="30" bgcolor="#6E94B7" class="topic">ส่วนที่ 3 : สัตว์นำโรค</td>
		  </tr>
		  <tr>
			<td>
				<table width="100%" border="0" cellpadding="2" cellspacing="0" bgcolor="#C3DAEB">
				  <tr>
					<td width="4%" valign="top"><div align="center">3.1</div></td>
				    <td width="96%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="28%" valign="top">ชนิดสัตว์นำโรค<span class="alertred">*</span> : </td>
                        <td width="3%"><div align="center">
                          <input name="typeanimal"  id="typeanimal"   type="radio" value="1" <? if($typeanimal=='1'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td width="23%">สุนัข</td>
                        <td width="3%"><div align="center">
                          <input name="typeanimal" id="typeanimal"  type="radio" value="2" <? if($typeanimal=='2'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td width="11%">แมว</td>
                        <td width="3%"><div align="center">
                          <input name="typeanimal" id="typeanimal" type="radio" value="3" <? if($typeanimal=='3'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td width="29%">ลิง</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="typeanimal" id="typeanimal" type="radio" value="4" <? if($typeanimal=='4'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td>ชะนี</td>
                        <td><div align="center">
                          <input name="typeanimal" id="typeanimal" type="radio" value="5" <? if($typeanimal=='5'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);">
                        </div></td>
                        <td>หนู</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="typeanimal"  id="typeanimal" type="radio" value="6" <? if($typeanimal=='6'){ print "checked";}?> onClick="show_hide_clear_typeanimal(document.form1);" >
                        </div></td>
                        <td colspan="5">อื่นๆ
                        <span class="alertred" id="typeotherspan" <? if($typeanimal!='6'){echo 'style="display:none"';}?>>(โปรดระบุ)&nbsp;&nbsp;
						<select name="typeother" class="textbox" id="typeother">
							  <option value="0" <? if($typeother=='0'){echo 'selected';}?> selected="selected">กรุณาเลือก</option>
							  <option value="1" <? if($typeother=='1'){echo 'selected';}?>>คน</option>
							  <option value="2" <? if($typeother=='2'){echo 'selected';}?>>วัว</option>
							  <option value="3" <? if($typeother=='3'){echo 'selected';}?>>กระบือ</option>
							  <option value="4" <? if($typeother=='4'){echo 'selected';}?>>สุกร</option>
							  <option value="5" <? if($typeother=='5'){echo 'selected';}?>>แพะ</option>
							  <option value="6" <? if($typeother=='6'){echo 'selected';}?>>แกะ</option>
							  <option value="7" <? if($typeother=='7'){echo 'selected';}?>>ม้า</option>
							  <option value="8" <? if($typeother=='8'){echo 'selected';}?>>กระรอก</option>
							  <option value="9" <? if($typeother=='9'){echo 'selected';}?>>กระแต</option>
							  <option value="10" <? if($typeother=='10'){echo 'selected';}?>>พังพอน</option>
							  <option value="11" <? if($typeother=='11'){echo 'selected';}?>>กระต่าย</option>
							  <option value="12" <? if($typeother=='12'){echo 'selected';}?>>สัตว์ป่า (สัตว์ที่อยู่ในป่าแล้วกัด)</option>
							  <option value="13" <? if($typeother=='13'){echo 'selected';}?>>ไม่ทราบ</option>
						</select></span>
						<span></span>
						</td>
                      </tr>
                      <tr>
                        <td>อายุสัตว์<span class="alertred">*</span> : </td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="1" <? if($ageanimal=='1'){ print "checked";}?>>
                        </div></td>
                        <td>น้อยกว่า 3 เดือน </td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="2" <? if($ageanimal=='2'){ print "checked";}?>>
                        </div></td>
                        <td>3 - 6 เดือน </td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="3" <? if($ageanimal=='3'){ print "checked";}?>>
                        </div></td>
                        <td>6 - 12 เดือน </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="4" <? if($ageanimal=='4'){ print "checked";}?>>
                        </div></td>
                        <td>มากกว่า 1 ปี </td>
                        <td><div align="center">
                          <input name="ageanimal" type="radio" value="5" <? if($ageanimal=='5'){ print "checked";}?>>
                        </div></td>
                        <td colspan="3">ไม่ทราบ <span></span></td>
						
                      </tr>
                    </table></td>
				  </tr>
				  
				  <tr>
					<td valign="top"><div align="center">3.2</div></td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="28%" valign="top">สถานภาพสัตว์<span class="alertred">*</span> :</td>
                        <td width="3%"><div align="center">
                          <input name="statusanimal" type="radio" value="1" <? if($statusanimal=='1'){ print "checked";}?>>
                        </div></td>
                        <td width="69%">มีเจ้าของ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="statusanimal" type="radio" value="2" <? if($statusanimal=='2'){ print "checked";}?>>
                        </div></td>
                        <td>ไม่มีเจ้าของ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="statusanimal" type="radio" value="3" <? if($statusanimal=='3'){ print "checked";}?>>
                        </div></td>
                        <td>ไม่ทราบ <span></span></td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top"><div align="center">3.3</div></td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="29%" valign="top">การกักขังติดตามดูอาการของสุนัข / แมว :</td>
                        <td width="3%"><div align="center">
                          <input name="detain" type="radio" value="1" <? if($detain=='1'){ print "checked";}?> onClick="show_hide_clear_detaindate(document.form1);">
                        </div></td>
                        <td width="15%">กักขังได้ / ติดตามได้</td>
                        <td width="54%">
						<table width="100%" border="0" cellspacing="0" cellpadding="2" id="detaindatetable" <? if($detain!='1'){ print 'style = "display:none"';}?>>
                          <tr>
                            <td width="39%"><input name="detaindate" type="radio" value="1" <? if($detaindate=='1'){ print "checked";}?>>
                              ตายเองภายใน 10 วัน </td>
                            <td width="61%"><input name="detaindate" type="radio" value="2"  <? if($detaindate=='2'){ print "checked";}?>>
                              &nbsp;ไม่ตายภายใน 10 วัน </td>
                          </tr>
                        </table>
						</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="detain" type="radio" value="2" <? if($detain=='2'){ print "checked";}?> onClick="show_hide_clear_detaindate(document.form1);">
                        </div></td>
                        <td>กักขังไม่ได้</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="detain" type="radio" value="3" <? if($detain=='3'){ print "checked";}?> onClick="show_hide_clear_detaindate(document.form1);">
                        </div></td>
                        <td>ถูกฆ่าตาย</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="center">
                          <input name="detain" type="radio" value="4" <? if($detain=='4'){ print "checked";}?> onClick="show_hide_clear_detaindate(document.form1);">
                        </div></td>
                        <td>หนีหาย / จำไม่ได้ </td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top" align="center">3.4</td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="28%">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้า<span class="alertred">*</span></td>
                        <td width="3%" align="center"><input name="historyvacine" type="radio" value="1" <? if($historyvacine=='1'){print "checked";}?> onClick="show_hide_clear_historyvacine(document.form1);"></td>
                        <td width="69%">ไม่ทราบ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="center">
                          <input name="historyvacine" type="radio" value="2" <? if($historyvacine=='2'){print "checked";}?> onClick="show_hide_clear_historyvacine(document.form1);">
                        </td>
                        <td>ไม่เคยฉีด</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td  align="center">
                          <input name="historyvacine" type="radio" value="3" <? if($historyvacine=='3'){print "checked";}?> onClick="show_hide_clear_historyvacine(document.form1);">
                        </td>
                        <td>เคยฉีด 1 ครั้ง </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="center">
                          <input name="historyvacine" type="radio" value="4" <? if($historyvacine=='4'){print "checked";}?> onClick="show_hide_clear_historyvacine(document.form1);">
                        </td>
                        <td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td width="34%">เคยฉีดเกิน 1 ครั้ง ครั้งสุดท้าย </td>
								<td width="66%"><span></span>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" id="historyvacine_withintable"<? if($historyvacine!='4'){print 'style = "display:none"';}?>>
									  <tr>
										<td width="33%"><input name="historyvacine_within" type="radio" value="1" <? if($historyvacine_within=='1'){print "checked";}?>>
									    ภายใน 1 ปี </td>
										<td width="67%"><input name="historyvacine_within" type="radio" value="2" <? if($historyvacine_within=='2'){print "checked";}?>>
										  เกิน 1 ปี </td>
									  </tr>
									</table>
									
								</td>
							  </tr>
							</table>	
						</td>
                      </tr>
                    </table>
					</td>
				  </tr>
				  <tr>
					<td valign="top"><div align="center">3.5</div></td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="28%" valign="top">สาเหตุที่ถูกกัด</td>
                        <td width="3%" align="center"><input name="reasonbite" type="radio" value="1" <? if($reasonbite=='1'){ print "checked";}?> onClick="show_hide_clear_cousedetail(document.form1);"></td>
                        <td width="23%">ถูกกัดโดย<span class="alertred"><b>ไม่มี</b></span>สาเหตุโน้มนำ</td>
                        <td width="3%" align="center"><div align="left">
                          <input name="reasonbite" type="radio" value="2"  <? if($reasonbite=='2'){ print "checked";}?> onClick="show_hide_clear_cousedetail(document.form1);">
                        </div></td>
                        <td width="44%">ถูกกัดโดย<span class="alertred"><b>มี</b></span>สาเหตุโน้มนำ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="causedetailtable" <? if($reasonbite!='2'){print 'style = "display:none"';}?>>
                          <tr>
                            <td width="89%"><input name="causedetail" type="radio" value="1" <? if($causedetail=='1'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              ทำให้สัตว์เจ็บปวด โมโหหรือตกใจ </td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="2" <? if($causedetail=='2'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              พยายามแยกสัตว์ที่กำลังต่อสู้กัน</td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="3" <? if($causedetail=='3'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              เข้าใกล้สัตว์แม่ลูกอ่อน</td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="4" <? if($causedetail=='4'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              รบกวนสัตว์ขณะกินอาหาร</td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="5" <? if($causedetail=='5'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              เข้าไปในบริเวณที่สัตว์คิดว่าเป็นเจ้าของ</td>
                            </tr>
                          <tr>
                            <td><input name="causedetail" type="radio" value="6" <? if($causedetail=='6'){print "checked";}?> onClick="show_hide_clear_causetext(document.form1);">
                              อื่นๆ <span class="alertred" id="causetextspan" <? if($causedetail!='6'){print 'style = "display:none"'; }?>>(โปรดระบุ)&nbsp;
                              <input name="causetext" type="text" class="textbox" size="20" value="<?=$causetext;?>">
                              </span></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top" align="center">3.6</td>
				    <td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="28%" valign="top">การส่งหัวสัตว์ตรวจ</td>
                        <td width="3%"><input name="headanimal" type="radio" value="1" <? if($headanimal=='1'){ print "checked";}?> onClick="show_hide_clear_headanimalplace(document.form1);"></td>
                        <td width="69%">ไม่ได้ส่งตรวจ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><input name="headanimal" type="radio" value="2" <? if($headanimal=='2'){ print "checked";}?> onClick="show_hide_clear_headanimalplace(document.form1);"></td>
                        <td>ส่งที่</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="2" id="headanimalplacetable"  <? if($headanimal!='2'){print 'style = "display:none"'; }?>>
                          <tr>
                            <td colspan="2"><span class="alertred">(โปรดระบุ)</span>&nbsp;
								<select name="headanimalplace"  id="headanimalplace" class="textbox" onChange="show_hide_clear_otherheadanimalplace(this);">
									  <option value="0" <? if($headanimalplace=='0'){echo 'selected';}?>>กรุณาเลือก</option>
									  <option value="1" <? if($headanimalplace=='1'){echo 'selected';}?>>สถาบันวิจัยวิทยาศาสตร์สาธารณสุข กรมวิทยาศาสตร์</option>
									  <option value="2" <? if($headanimalplace=='2'){echo 'selected';}?>>โรงพยาบาลปกเกล้า จ.จันทบุรี</option>
									  <option value="3" <? if($headanimalplace=='3'){echo 'selected';}?>>ศูนย์วิทยาศาสตร์การแพทย์เชียงราย</option>
									  <option value="4" <? if($headanimalplace=='4'){echo 'selected';}?>>ศูนย์วิทยาศาสตร์การแพทย์ขอนแก่น</option>
									  <option value="5" <? if($headanimalplace=='5'){echo 'selected';}?>>ศูนย์วิทยาศาสตร์การแพทย์นครราชสีมา</option>
									  <option value="6" <? if($headanimalplace=='6'){echo 'selected';}?>>คณะแพทยศาสตร์ศิริราชพยาบาล 
									  (ภาควิชาจุลชีววิทยา)</option>
									  <option value="7" <? if($headanimalplace=='7'){echo 'selected';}?>>คณะแพทย์ศาสตร์มหาวิทยาลัยเชียงใหม่ 
									  จังหวัดเชียงใหม่ (ภาควิชาจุลชีววิทยา)</option>
									  <option value="8" <? if($headanimalplace=='8'){echo 'selected';}?>>ศูนย์ปฎิบัติการโรคทางสมอง 
									  โรงพยาบาลจุฬาลงกรณ์</option>
									  <option value="9" <? if($headanimalplace=='9'){echo 'selected';}?>>สถานเสาวภา สภากาชาดไทย</option>
									  <option value="10" <? if($headanimalplace=='10'){echo 'selected';}?>>ศูนย์วิจัยและพัฒนาการสัตวแพทย์ 
									  ภาคเหนือ (ตอนบน) จ.ลำปาง</option>
									  <option value="11" <? if($headanimalplace=='11'){echo 'selected';}?>>ศูนย์วิจัยและพัฒนาการสัตวแพทย์ 
									  ภาคเหนือ (ตอนล่าง) จ.พิษณุโลก</option>
									  <option value="12" <? if($headanimalplace=='12'){echo 'selected';}?>>ศูนย์วิจัยและพัฒนาการสัตวแพทย์ 
									  ภาคตะวันออกเฉียงเหนือ จ.ขอนแก่น</option>
									  <option value="13" <? if($headanimalplace=='13'){echo 'selected';}?>>ศูนย์วิจัยและพัฒนาการสัตวแพทย์ 
									  ภาคตะวันออกเฉียงเหนือ (ตอนล่าง) จ.สุรินทร์</option>
									  <option value="14" <? if($headanimalplace=='14'){echo 'selected';}?>>ศูนย์วิจัยและพัฒนาการสัตวแพทย์ 
									  ภาคใต้ จ.นตรศรีธรรมราช</option>
									  <option value="15" <? if($headanimalplace=='15'){echo 'selected';}?>>ศูนย์วิจัยและพัฒนาการสัตวแพทย์ 
									  ภาคตะวันออก จ.ชลบุรี</option>
									  <option value="16" <? if($headanimalplace=='16'){echo 'selected';}?>>สำนักสุขศาสตร์สัตว์และสุขอนามัยที่ 
									  1 จ.ปทุมธานี</option>
									  <option value="17" <? if($headanimalplace=='17'){echo 'selected';}?>>สำนักสุขศาสตร์สัตว์และสุขอนามัยที่ 
									  2 จ.ฉะเชิงเทรา</option>
									  <option value="18" <? if($headanimalplace=='18'){echo 'selected';}?>>สำนักสุขศาสตร์สัตว์และสุขอนามัยที่ 
									  3 จ.นครราชสีมา</option>
									  <option value="19" <? if($headanimalplace=='19'){echo 'selected';}?>>สำนักสุขศาสตร์สัตว์และสุขอนามัยที่ 
									  5 จ.เชียงใหม่</option>
									  <option value="20" <? if($headanimalplace=='20'){echo 'selected';}?>>สำนักสุขศาสตร์สัตว์และสุขอนามัยที่ 
									  7 จ.นครปฐม</option>
									  <option value="21" <? if($headanimalplace=='21'){echo 'selected';}?>>สำนักสุขศาสตร์สัตว์และสุขอนามัยที่ 
									  8 จ.สุราษฎร์ธานี</option>
									  <option value="22" <? if($headanimalplace=='22'){echo 'selected';}?>>สำนักสุขศาสตร์สัตว์และสุขอนามัยที่ 
									  9 จ.สงขลา</option>
									  <option value="23" <? if($headanimalplace=='23'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดชัยนาท</option>
									  <option value="24" <? if($headanimalplace=='24'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดเพชรบูรณ์</option>
									  <option value="25" <? if($headanimalplace=='25'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดกำแพงเพชร</option>
									  <option value="26" <? if($headanimalplace=='26'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดสกลนคร</option>
									  <option value="27" <? if($headanimalplace=='27'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดชัยภูมิ</option>
									  <option value="28" <? if($headanimalplace=='28'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดอุดรธานี</option>
									  <option value="29" <? if($headanimalplace=='29'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดอำนาจเจริญ</option>
									  <option value="30" <? if($headanimalplace=='30'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดกาฬสินธุ์</option>
									  <option value="31" <? if($headanimalplace=='31'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดบุรีรัมย์</option>
									  <option value="32" <? if($headanimalplace=='32'){echo 'selected';}?>>สำนักงานปศุสัตว์จังหวัดศรีสะเกษ</option>
									  <option value="33" <? if($headanimalplace=='33'){echo 'selected';}?>>สถาบันสุขภาพสัตว์แห่งชาติ</option>
									  <option value="34" <? if($headanimalplace=='34'){echo 'selected';}?>>อื่นๆ</option>
					  		</select></td>
                            </tr>
                          <tr id="otherheadanimalplacetr" <? if($headanimalplace!='34'){print 'style = "display:none"'; }?>>
                            <td colspan="2"><span class="alertred">(โปรดระบุ)</span>&nbsp;&nbsp;<input name="otherheadanimalplace" id="otherheadanimalplace" type="text" class="textbox" value="<?=$otherheadanimalplace;?>" size="40"></td>
                            </tr>
                          <tr>
                            <td width="4%"><input name="batteria" type="radio" value="1" <? if($batteria=='1'){ print "checked";}?>></td>
                            <td width="96%">พบเชื้อ</td>
                          </tr>
                          <tr>
                            <td><input name="batteria" type="radio" value="2" <? if($batteria=='2'){ print "checked";}?> /></td>
                            <td>ไม่พบเชื้อ</td>
                          </tr>
                        </table>
						</td>
                      </tr>
                    </table>
					</td>
				  </tr>
			  </table>			
		    </td>
		  </tr>
		  <tr>
			<td height="30" bgcolor="#6E94B7" class="topic">ส่วนที่ 4 : ประวัติและการดูแลของผู้สัมผัสก่อนพบเจ้าหน้าที่</td>
		  </tr>
		  <tr>
			<td bgcolor="#C3DAEB"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="4%" valign="top"><div align="center">4.1</div></td>
                <td width="96%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="29%" valign="top">การล้างแผลก่อนพบเจ้าหน้าที่สาธารณสุข</td>
                    <td width="3%"><input name="washbefore" type="radio" value="1" <? if($washbefore=='1'){ echo "checked";}?>  onclick="show_hide_clear_washbefore(document.form1);"></td>
                    <td width="19%">ไม่ได้ล้าง</td>
                    <td width="3%"><div align="center">
                      <input name="washbefore" type="radio" value="2"  <? if($washbefore=='2'){ echo "checked";}?>   onclick="show_hide_clear_washbefore(document.form1);" />
                    </div></td>
                    <td width="46%">ล้างด้วย</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0"  id="washbeforetr" <? if($washbefore!='2'){ echo ' style="display:none"';}?>>
                      <tr>
                        <td width="5%"><div align="center">
                            <input name="washbeforedetail" type="radio" value="1"  <? if($washbeforedetail=='1'){print "checked";}?> onClick="show_hide_clear_washbeforedetail(document.form1);">
                        </div></td>
                        <td width="95%">น้ำ</td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="washbeforedetail" type="radio" value="2" <? if($washbeforedetail=='2'){print "checked";}?> onClick="show_hide_clear_washbeforedetail(document.form1);">
                        </div></td>
                        <td>น้ำและสบู่/ผงซักฟอก</td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="washbeforedetail" type="radio" value="3"  <? if($washbeforedetail=='3'){print "checked";}?> onClick="show_hide_clear_washbeforedetail(document.form1);">
                        </div></td>
                        <td>อื่นๆ 
							<span class="alertred"  id="washbeforedetailtd" <? if($washbeforedetail!='3'){print 'style = "display:none"';}?>>(โปรดระบุ)&nbsp;
								  <input name="washbeforetext" type="text" class="textbox" size="20" value="<?=$washbeforetext;?>">
							</span>
						</td>
                      </tr>
                    </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top"><div align="center">4.2</div></td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="30%" valign="top">การใส่ยาฆ่าเชื้อก่อนพบเจ้าหน้าที่สาธารณสุข</td>
                    <td width="3%"><input name="putdrug" type="radio" value="1" <? if($putdrug=='1'){print "checked";}?> onClick="show_hide_clear_putdrug(document.form1);"></td>
                    <td width="18%">ไม่ได้ใส่ยา</td>
                    <td width="3%"><div align="center">
                      <input name="putdrug" type="radio" value="2" <? if($putdrug=='2'){print "checked";}?> onClick="show_hide_clear_putdrug(document.form1);">
                    </div></td>
                    <td width="46%">ใส่ยา</td>
                    </tr>
                  <tr >
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="putdrugtr" <? if($putdrug!='2'){print 'style = "display:none"'; }?>>
                      <tr>
                        <td width="5%"><div align="center">
                            <input name="putdrugdetail" type="radio" value="1" <? if($putdrugdetail=='1'){print "checked";}?> onClick="show_hide_clear_putdrugdetail(document.form1);">
                        </div></td>
                        <td width="95%">สารละลายไอโอดีนที่ไม่มีแอลกอฮอล์เช่น โพวีดีน เบตาดีนฯลฯ</td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="putdrugdetail" type="radio" value="2"  <? if($putdrugdetail=='2'){print "checked";}?> onClick="show_hide_clear_putdrugdetail(document.form1);">
                        </div></td>
                        <td>ทิงเจอร์ไอโอดีน / แอลกอฮอล์</td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="putdrugdetail" type="radio" value="3" <? if($putdrugdetail=='3'){print "checked";}?> onClick="show_hide_clear_putdrugdetail(document.form1);">
                        </div></td>
                        <td>อื่นๆ <span class="alertred" id="putdrugdetailtr" <? if($putdrugdetail!='3'){echo 'style="display:none"'; }?>>(โปรดระบุ)&nbsp;
                              <input name="putdrugtext" type="text" class="textbox" size="20" value="<?=$putdrugtext?>">
                        </span></td>
                      </tr>
                    </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top"><div align="center">4.3</div></td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าของผู้สัมผัส หรือสงสัยว่าสัมผัส<span class="alertred">*</span></td>
                    <td width="3%"><div align="center">
                        <input name="historyprotect" id="historyprotect" type="radio" value="1" <? if($historyprotect=='1'){ print "checked";}?> onClick="show_hide_clear_historyprotect(document.form1);">
                    </div></td>
                    <td width="46%">ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div align="center"><input name="historyprotect"  id="historyprotect" type="radio" value="2" <? if($historyprotect=='2'){ print "checked";}?> onClick="show_hide_clear_historyprotect(document.form1);"></div></td>
                    <td>เคยฉีด 3 เข็มหรือมากกว่า<span></span> </td>
                  </tr>
                  <tr id="historyprotecttr" <? if($historyprotect!='2'){print 'style = "display:none"'; }?>>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="5%"><div align="center">
                              <input name="historyprotectdetail" type="radio" value="1" <? if($historyprotectdetail=='1'){print "checked";}?>>
                          </div></td>
                          <td width="95%">ภายใน 6 เดือน</td>
                        </tr>
                        <tr>
                          <td><div align="center">
                              <input name="historyprotectdetail" type="radio" value="2" <? if($historyprotectdetail=='2'){print "checked";}?>>
                          </div></td>
                          <td>เกิน 6 เดือน</td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
		  </tr>
		  <tr>
			<td height="30" bgcolor="#6E94B7" class="topic">ส่วนที่ 5 : การฉีดอิมมูโนโกลบุลินและวัคซีนในครั้งนี้</td>
		  </tr>
		  <tr>
			<td bgcolor="#C3DAEB"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="4%" valign="top"><div align="center">5.1</div></td>
                <td width="96%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="20%" valign="top">การฉีดอิมมูโนโกลบูลิน(RIG)<span class="alertred">*</span></td>
								<td width="80%"> 
									<input name="use_rig" type="radio" value="1" <? if($use_rig=='1'){print "checked";}?>  onclick="show_hide_clear_use_rig(document.form1);">ไม่ฉีด&nbsp;&nbsp;
									<input name="use_rig" type="radio" value="2" <? if($use_rig=='2'){print "checked";}?>  onclick="show_hide_clear_use_rig(document.form1);">ฉีด 								
									<span></span>
								</td>

						  </tr>
						</table>					
						</td>
                  </tr>
                  <tr id="use_rigtr1" <? if($use_rig!='2'){ echo 'style="display:none"'; }?>>
                    <td height="22">&nbsp;&nbsp;<input name="erig_hrig" type="radio" value="1" <? if($erig_hrig=='1'){ print "checked";}?> onClick="show_hide_clear_erig_hrig(document.form1);">
                      ERIG Lot. No. 
					  <span class="alertred" id="erig_hrig_textbox1" <? if($erig_hrig!='1'){ echo 'style="display:none"';}?>>
                      <input name="erig_no" type="text" class="textbox" size="20" value="<?=$erig_no;?>" ><!-- onBlur="check_ui(this);"-->
                      </span></td>
                  </tr>
                  <tr id="use_rigtr2" <? if($use_rig!='2'){print 'style = "display:none"'; }?>>
                    <td height="22">&nbsp;&nbsp;<input name="erig_hrig" type="radio" value="2"  <? if($erig_hrig=='2'){ print "checked";}?> onClick="show_hide_clear_erig_hrig(document.form1);">
                      HRIG Lot. No. 
					  <span class="alertred"  id="erig_hrig_textbox2" <? if($erig_hrig!='32'){ echo 'style="display:none"';}?>>
                      <input name="hrig_no" type="text" class="textbox" size="20" value="<?=$hrig_no;?>" ><!-- onBlur="check_ui(this);" -->
                      </span></td>
                  </tr>
                  <tr id="use_rigtr3" <? if($use_rig!='2'){print 'style = "display:none"';  }?>>
                    <td>ปริมาณที่ฉีด&nbsp;
					<input name="quantityiu" id="quantityiu" type="text" class="textbox" size="5" value="<?=$quantityiu;?>"  onKeyUp="chkFormatNam (this.value,this.name);" > IU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;น้ำหนักคนไข้&nbsp; <!-- onBlur="check_ui(this);" -->
					<input name="weight_patient" id="weight_patient" type="text" size="5" class="textbox" value="<?=$weight_patient;?>"  onKeyUp="chkFormatNam (this.value,this.name);" ><!--  onBlur="check_ui(this);"-- >
                    &nbsp;กิโลกรัม&nbsp;&nbsp;&nbsp;&nbsp;เมื่อวันที่&nbsp;
						<!--<input name="daterig" type="text" size="10" class="textbox" readonly="" value="<?php //echo  $daterig;?>"  onClick="return showCalendar('daterig', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"  onblur="check_ui(this);" > 
						<img src="images/calendar.gif" alt="เปิดปฏิทิน"  align="absmiddle"   onClick="return showCalendar('daterig', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"/>
					-->
					<input name="daterig" type="text" size="10" class="textbox datepicker" readonly=""  value="<?php echo $daterig ?>" />
					</td>
                  </tr>
                  <tr id="use_rigtr4" <? if($use_rig!='2'){print 'style = "display:none"';  }?>>
                    <td>อาการหลังฉีด RIG&nbsp;&nbsp;&nbsp; 
					  <input name="after_rig" type="radio" value="1" <? if($after_rig=='1'){ print "checked";}?> onClick="show_hide_clear_after_rig(document.form1);">ไม่มี&nbsp;&nbsp;&nbsp;
                      <input name="after_rig" type="radio" value="2" <? if($after_rig=='2'){ print "checked";}?> onClick="show_hide_clear_after_rig(document.form1);">มี (ระบุอาการ)</td>
                  </tr>
                  <tr id="use_rigtr5" <? if($use_rig!='2'){print 'style = "display:none"'; }?>>
                    <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" id="after_rigtr" <? if($after_rig!='2'){print 'style = "display:none"'; }?>>
						  <tr>
							<td width="23%">&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail1" value="1" <? if($after_rigdetail1=='1'){print "checked";}?>> บวมแดง</td>
							<td width="8%">&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail2" value="1" <? if($after_rigdetail2=='1'){print "checked";}?>>
							  คันบริเวณที่ฉีด</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail3" value="1" <? if($after_rigdetail3=='1'){print "checked";}?>>
							  เป็นไข้</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail4" value="1" <? if($after_rigdetail4=='1'){print "checked";}?>>
							  ปวดศีรษะ</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail5" value="1" <? if($after_rigdetail5=='1'){print "checked";}?>>
							  เป็นผื่นคันทั่วไป</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail6" value="1" <? if($after_rigdetail6=='1'){print "checked";}?>>
							  ช็อค</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2"><input type="checkbox" name="after_rigdetail7" value="1" <? if($after_rigdetail7=='1'){print "checked";}?> onClick="show_hide_clear_after_rigdetail7(document.form1);">
							  อื่นๆ&nbsp;<span class="alertred" id="otherafter_rigdetail7" <? if($after_rigdetail7!='1'){print 'style = "display:none"';  }?>>(โปรดระบุ)&nbsp;&nbsp;
							  <input name="after_rigtext" type="text" class="textbox" size="20" value="<?=$after_rigtext?>">
							  </span></td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2">ระยะเวลาที่มีอาการ</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;&nbsp;&nbsp;
							  <input name="longfeel" type="radio" value="1" <? if($longfeel=='1'){ print "checked";}?>>
							  ภายใน 2 ชม. </td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;&nbsp;&nbsp;
							  <input name="longfeel" type="radio" value="2" <? if($longfeel=='2'){ print "checked";}?>>
							  หลัง 2 ชม. <span class="alertred">(ระบุวันที่)&nbsp;
							<!--<input name="datelongfeel" type="text" size="10" class="textbox" readonly="" value="<?php //echo $datelongfeel;?>"  onClick="return showCalendar('datelongfeel', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"> 
							<img src="images/calendar.gif" alt="เปิดปฏิทิน"  align="absmiddle"   onClick="return showCalendar('datelongfeel', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"/>-->
							<input name="datelongfeel" type="text" size="10" class="textbox datepicker" readonly="" value="<?php echo $datelongfeel;?>" />
							  </span></td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td height="15">&nbsp;</td>
							<td width="9%" valign="top">การรักษา</td>
							<td width="60%"><textarea name="cure_comment" cols="30" rows="5" class="textbox"><?=$cure_comment;?></textarea></td>
							<td>&nbsp;</td>
						  </tr>
						</table>&nbsp;
					</td>
                  </tr>
                </table>
				</td>
              </tr>
              <tr>
                <td valign="top"><div align="center">5.2</div></td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="15%" valign="top">การฉีดวัคซีนโดยวิธี <span class="alertred">*</span></td>
							<td width="85%">
							  <input name="means"  id="means" type="radio" value="1" <? if($means=='1'){print "checked";}?> ><!-- onClick="show_hide_clear_means(document.form1);"-->
							  &nbsp;เข้ากล้ามเนื้อ&nbsp;&nbsp;&nbsp;
							  <input name="means"  id="means" type="radio" value="2" <? if($means=='2'){print "checked";}?>><!-- onClick="show_hide_clear_means(document.form1);"-->
							  เข้าในผิวหนัง&nbsp;&nbsp;&nbsp;
							  <input name="means"   id="means"type="radio" value="3" <? if($means=='3'){print "checked";}?> ><!-- onClick="show_hide_clear_means(document.form1);"-->
							  ไม่ฉีด
							<span></span>
							  </td>
						  </tr>
						  <tr>
						    <td colspan="2" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td colspan="3" align="center">
									<table width="100%"border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" id="meanstr" <? if($means=='3' || $means==''){ print "style='display:none'";}?>>
										  <tr bgcolor="#FFFFFF">
												<td align="center" height="20">ครั้งที่</td>
												<td align="center" height="20">วันที่ฉีด</td>
												<td align="center" height="20">ชื่อวัคซีน</td>
												<td align="center" height="20">เลขที่วัคซีน</td>
												<td align="center" height="20">ขนาด(c.c)</td>
												<td align="center" height="20">จำนวนจุดที่ฉีด</td>
												<td align="center" height="20">ชื่อผู้ฉีด</td>
												<td align="center" height="20">สถานที่</td>
										  </tr>
										  <? 
										$rechospitalname=$DB->FETCHARRAY($DB->QUERY("SELECT hospital_name FROM n_hospital WHERE hospital_code ='".$hospital."'"));
										$hospital_name=$rechospitalname['hospital_name'];
										  for($i=0;$i<5;$i++){
												if($byplace[$i]==''){ $byplace[$i]=$hospital_name;$hospital_name='';}
										  ?>
										  <tr bgcolor="#C3DAEB">
												<td align="center" valign="middle"><?=$i+1;?></td>
												<td align="center">
													<!--<input name="vaccine_date[<?php //echo $i?>]" type="text" size="10" class="textbox" readonly="" value="<? //=$vaccine_date[$i];?>"  onClick="if(document.getElementById('vaccine_name['+<? //=$i?>+']').value=='0'){alert('กรุณาเลือกชื่อวัคซีนก่อนกรอกวันที่');}else{return showCalendar('vaccine_date[<?//=$i?>]', 'dd-mm-y');}" onMouseOver="this.style.cursor='hand';"> 
													<img src="images/calendar.gif" alt="เปิดปฏิทิน"  align="absmiddle"   onClick="if(document.getElementById('vaccine_name['+<? //=$i?>+']').value=='0'){alert('กรุณาเลือกชื่อวัคซีนก่อนกรอกวันที่');}else{return showCalendar('vaccine_date[<? //=$i?>]', 'dd-mm-y');}" onMouseOver="this.style.cursor='hand';"/>-->
									<input name="vaccine_date[<?php echo $i?>]" type="text" size="10" class="textbox datepicker" id="vaccine_date[<?php echo $i?>]" readonly="" value="<?php echo $vaccine_date[$i];?>" />
												</td>
												<td align="center" valign="middle">
													<select name="vaccine_name[<?=$i?>]" id="vaccine_name[<?=$i?>]" >
														<option value="0" <? if($vaccine_name[$i]=='0'){ echo 'selected';}?>>เลือกชนิด</option>
														<option value="1" <? if($vaccine_name[$i]=='1'){ echo 'selected';}?>>PVRV</option>
														<option value="2" <? if($vaccine_name[$i]=='2'){ echo 'selected';}?>>PCEC</option>
														<option value="3" <? if($vaccine_name[$i]=='3'){ echo 'selected';}?>>HDCV</option>
														<option value="4" <? if($vaccine_name[$i]=='4'){ echo 'selected';}?>>PDEV</option>
												  </select> 
												</td>
												<td align="center" valign="middle"><input name="vaccine_no[<?=$i?>]" type="text" id="vaccine_no[<?=$i?>]" size="10" value="<?=$vaccine_no[$i]?>"></td>
												<td align="center" valign="middle"><input name="vaccine_cc[<?=$i?>]" type="text" id="vaccine_cc[<?=$i?>]"  value="<?=$vaccine_cc[$i]?>" size="3" maxlength="10"  onKeyUp="chkFormatNam (this.value,this.name);" >
<!-- 	onBlur="check_vaccine_cc(document.getElementById('means').value,document.getElementById('vaccine_name['+<?//=$i?>+']').value,document.getElementById('vaccine_cc['+<?//=$i?>+']').value,<?//=$i?>)" -->												
												</td>
												<td align="center" valign="middle">
												<!--<select name="vaccine_point[<?php//echo $i?>]" id="vaccine_point[<?php//echo $i?>]"  style="background-color:#FF3300">
														<option value="1" <?//if($vaccine_point[$i]=='1'){ echo 'selected';}?>>1</option>
														<option value="2" <?//if($vaccine_point[$i]=='2'){ echo 'selected';}?>>2</option>
													</select>-->
											
													<input type="text" name="vaccine_point[<?=$i?>]" size="2" id="vaccine_point[<?=$i?>]"  value="<?=$vaccine_point[$i];?>" onKeyPress="return NumberOnly();"   maxlength="1"/><!-- onBlur="check_point(this);" -->
												</td>
												<td align="center" valign="middle">
												<input name="byname[<?=$i?>]" type="text" id="byname[<?=$i?>]" value="<?=$byname[$i]?>" size="10"></td>
												<td align="center" valign="middle"><input name="byplace[<?=$i?>]" type="text" id="byplace[<?=$i?>]" value="<?=$byplace[$i];?>" size="20"></td>
										  </tr>
										  <?  
										  }
										  ?>
									</table>
								</td>
                                </tr>
                              <tr id="after_symptom_vaccine">
                                <td width="15%">อาการหลังฉีดวัคซีน</td>
                                <td width="12%"><input name="after_vaccine" type="radio" value="1" <? if($after_vaccine=='1'){ print "checked";}?> onClick="show_hide_after_vaccine(document.form1);">ไม่มี</td>
                                <td width="73%"><input name="after_vaccine" type="radio" value="2" <? if($after_vaccine=='2'){ print "checked";}?> onClick="show_hide_after_vaccine(document.form1);">มี (ระบุอาการ) </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" id="after_vaccinetr" <? if($after_vaccine!='2'){echo 'style="display:none"'; }?>>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail1" value="1" <? if($after_vaccine_detail1=='1'){echo 'checked';}?> />
                                      บวมแดง</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail2" value="1"<? if($after_vaccine_detail2=='1'){echo 'checked';}?> />
                                      คันบริเวณที่ฉีด</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail3" value="1" <? if($after_vaccine_detail3=='1'){echo 'checked';}?>/>
                                      เป็นไข้</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail4" value="1" <? if($after_vaccine_detail4=='1'){echo 'checked';}?>/>
                                      ปวดศีรษะ</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail5" value="1" <? if($after_vaccine_detail5=='1'){echo 'checked';}?>/>
                                      เป็นผื่นคันทั่วไป</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail6" value="1"  <? if($after_vaccine_detail6=='1'){echo 'checked';}?>/>
                                      ช็อค</td>
                                    </tr>
                                  <tr>
                                    <td colspan="2"><input type="checkbox" name="after_vaccine_detail7" value="1"  <? if($after_vaccine_detail7=='1'){echo 'checked';}?> onClick="show_hide_after_vaccinedetail7(document.form1);"/> 
                                      อื่นๆ 
									  <span class="alertred" id="otherafter_vaccinedetail7" <? if($after_vaccine_detail7!='1'){print 'style = "display:none"';  }?>>
									  (โปรดระบุ)&nbsp;&nbsp;
                                      <input name="after_vaccine_text" type="text" class="textbox" size="20" value="<?=$after_vaccine_text;?>">
                                      </span></td>
                                    </tr>
                                  <tr>
                                    <td width="22%">วันที่มีอาการ</td>
                                    <td width="78%">
									<!--<input name="after_vaccine_date" type="text" size="10" class="textbox" readonly="" value="<? //=$after_vaccine_date;?>"  onClick="return showCalendar('after_vaccine_date', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"> 
									<img src="images/calendar.gif" alt="เปิดปฏิทิน"  align="absmiddle"   onClick="return showCalendar('after_vaccine_date', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"/>-->
									<input name="after_vaccine_date" type="text" size="10" class="textbox datepicker" readonly="" value="<?php echo $after_vaccine_date;?>" />
									</td>
                                  </tr>
                                  <tr>
                                    <td valign="top">การรักษา</td>
                                    <td><textarea name="after_vaccine_cure_comment" cols="30" rows="5" class="textbox"><?=$after_vaccine_cure_comment;?></textarea></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
						    </tr>
						</table>				
						</td>
                  </tr>
                </table></td>
              </tr>
			  <?
			   if($in_out=='1'){?>
              <tr id="closecasemaintr" >
                <td valign="top"  align="center">5.3  <?php //echo "in_out=".$in_out; ?></td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="22%">ท่านต้องการปิด Case หรือไม่ </td>
                    <td width="78%">
					<input name="closecase" type="radio" value="1" <? if($closecase=='1'){print "checked";}?>  onclick="show_hide_closecase_chk(document.form1);">
                      ไม่ต้องการ&nbsp;&nbsp;&nbsp;
                      <input name="closecase" type="radio" value="2" <? if($closecase=='2'){print "checked";}?>  onclick="if(confirm('คุณแน่ใจหรือไม่ที่ต้องการปิดเคสข้อมูลนี้')){show_hide_closecase_chk(document.form1);}else{document.form1.closecase[1].checked=false;}">
                      ต้องการ</td>
                  </tr>
                  <tr>
                    <td colspan="2">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="closecasetr" <? if($closecase!='2'){echo 'style="display:none" ';}?>>
                      <tr>
                        <td width="38%">&nbsp;</td>
                        <td width="6%">สาเหตุ</td>
                        <td width="56%"><input name="closecase_reason" type="radio" value="1" <? if($closecase_reason=='1'){ print "checked";}?> onClick="show_hide_closecase_reason(document.form1);">
                          ฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าครบตามมาตรฐาน</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input name="closecase_reason" type="radio" value="2" <? if($closecase_reason=='2'){ print "checked";}?>  onclick="show_hide_closecase_reason(document.form1);">
                          ฉีดวัคซีนกระตุ้นครบตามมาตรฐาน</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input name="closecase_reason" type="radio" value="3" <? if($closecase_reason=='3'){ print "checked";}?>  onclick="show_hide_closecase_reason(document.form1);">
                          ฉีดวัคซีนไม่ครบ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" id="closecase_reasontr" <? if($closecase_reason!='3'){ echo 'style="display:none" ';}?>>
                          <tr>
                            <td width="11%"><div align="right">
                              <input type="checkbox" name="closecase_reason_detail1"  id="closecase_reason_detail1" value="1" <? if($closecase_reason_detail1=='1'){ print "checked";}?>>
                            </div></td>
                            <td width="89%">สุนัข/แมว มีอาการปกติภายใน 10 วัน </td>
                          </tr>
                          <tr>
                            <td><div align="right">
                              <input type="checkbox" name="closecase_reason_detail2"  id="closecase_reason_detail2" value="1" <? if($closecase_reason_detail2=='1'){ print "checked";}?>>
                            </div></td>
                            <td>ติดต่อคนไข้ไม่ได้/คนไข้ไม่มาฉีด</td>
                          </tr>
                        </table>
						</td>
                      </tr>
                    </table></td>
                    </tr>
                </table></td>
              </tr>
			  <? }?>
            </table></td>
		  </tr>
		  <tr>
		    <td bgcolor="#C3DAEB">&nbsp;</td>
	      </tr>
		  <tr>
			<td bgcolor="#C3DAEB">&nbsp;</td>
		  </tr>
		  <tr>
			<td bgcolor="#C3DAEB">
				<table width="65%" border="0" align="right" cellpadding="3" cellspacing="0">
				  <tr>
					<td width="31%"><div align="right"><b>ชื่อแพทย์ผู้สั่งการรักษา <span class="alertred">*</span> </b></div></td>
					<td width="69%"><span class="alertred">
					  <input name="doctorname" type="text" class="textbox" size="20" value="<?=$doctorname;?>">
					</span></td>
				  </tr>
				  <tr>
					<td><div align="right"><b>ชื่อผู้รายงาน <span class="alertred">*</span> </b></div></td>
					<td><span class="alertred">
					  <input name="reportname" type="text" class="textbox" id="reportname" value="<?=$reportname;?>" size="20" />
					</span></td>
				  </tr>
				  <tr>
					<td><div align="right"><b>ตำแหน่ง <span class="alertred">*</span> </b></div></td>
					<td><span class="alertred">
					  <input name="positionname" type="text" class="textbox" id="positionname" value="<?=$positionname;?>" size="20" />
					</span></td>
				  </tr>
				  <tr>
					<td><div align="right"><b>วันที่รายงาน <span class="alertred">*</span> </b></div></td>
					<td>
					<?
						$Ydate=date('Y')+543;
						$datedeflaut=date("-m-d");
						$reportdate=cld_my2date($Ydate.$datedeflaut);
					?>
			        <input name="reportdate" type="text" size="10" class="textbox" readonly="" value="<?php echo $reportdate;?>"> 
			      <!--  <img src="images/calendar.gif" alt="เปิดปฏิทิน"  align="absmiddle"   onClick="return showCalendar('reportdate', 'dd-mm-y');" onMouseOver="this.style.cursor='hand';"/>-->
				    </td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>
					<input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>"  />
					<input type="submit" name="save" value=" ตกลง " class="Submit">&nbsp;&nbsp;
					<input  type="button" name="button" value=" ยกเลิก " class="Submit" onClick="window.location.href='inform_hn.php'"></td>
				  </tr>
			  </table>
		    </td>
		  </tr>
		</table>
	</form>	
	</td>
  </tr>
  <tr>
    <td height="1"><? include("combottom.php");?></td>
  </tr>
</table>
</body>
</html>
<? if($head_bite_blood=='1'){ 
	echo "<script language='javascript'>show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if($head_bite_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if($head_claw_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if($head_claw_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if($head_lick_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if($head_lick_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if($face_bite_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if($face_bite_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if($face_claw_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if($face_claw_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if($face_lick_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if($face_lick_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if($neck_bite_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if($neck_bite_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if($neck_claw_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if($neck_claw_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if($neck_lick_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if($neck_lick_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if($hand_bite_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if($hand_bite_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if($hand_claw_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if($hand_claw_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if($hand_lick_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if($hand_lick_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if($arm_bite_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if($arm_bite_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if($arm_claw_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if($arm_claw_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if($arm_lick_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if($arm_lick_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if($body_bite_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if($body_bite_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if($body_claw_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if($body_claw_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if($body_lick_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if($body_lick_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if($leg_bite_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if($leg_bite_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if($leg_claw_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if($leg_claw_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if($leg_lick_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if($leg_lick_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if($feet_bite_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'));</script>";}?>
<? if($touch_type[44]=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'));</script>";}?>
<? if($feet_claw_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'));</script>";}?>
<? if($feet_claw_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'));</script>";}?>
<? if($feet_lick_blood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'));</script>";}?>
<? if($feet_lick_noblood=='1'){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('touch_type[44]').checked,document.getElementById('touch_type[45]').checked,document.getElementById('touch_type[46]').checked,document.getElementById('touch_type[47]').checked,document.getElementById('touch_type[48]').checked,document.getElementById('markfeet'));</script>";}?>



