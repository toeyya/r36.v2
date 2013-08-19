select * from n_vaccine where information_id = 1191141;
UPDATE n_vaccine    SET vaccine_date  = DATEADD(YEAR, -543,vaccine_date) where year(vaccine_date)=2549;

select vaccine_id,information_id,vaccine_date,vaccine_name,vaccine_no,vaccin_cc,vaccine_point,byname,byplace,user_id,hospital_id from n_vaccine where information_id='1191141' order by vaccine_date asc;

select count(id) from n_information group by id having count(id)>1;  

 select * from n_vaccine where information_id='1191141' ORDER BY vaccine_date ASC;  
 
 SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id 
 WHERE 1=1 AND hospitalprovince = '25' 
 AND year(datetouch)='2556' AND month(datetouch)='1' and historyprotect=1; 
 select count(id) from n_information group by id having count(id)>1;
 select * from n_history where idcard='1101499061703';
 select * from n_information where information_historyid=1137729;