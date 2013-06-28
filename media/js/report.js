	function Clear(list){
		var option='<option value="" selected="selected">ทั้งหมด<option>';
		if(list=="all"){
			$('#group,#province,#amphur,#district,#hospital').empty().append(option);			
		}else if(list=="group"){
			$('#province,#amphur,#district,#hospital').empty().append(option);
		}else if(list=="province"){
			$('#amphur,#district,#hospital').empty().append(option);
		}else if(list=="amphur"){
			$('#district,#hospital').empty().append(option);
		}else if(list=="district"){
			$('#hospital').empty().append(option);
		}	
		return false;	
	}	
	function List(funct,place,name){		
		var objarea_id = $('#area option:selected').val();
		var objgroup_id=$('#group option:selected').val();
		var objprovince_id=$('#province option:selected').val();
		var objamphur_id=$('#amphur option:selected').val();
		var objdistrict_id=$('#district option:selected').val();		 
		var module='district';
		place='#'+place;
		if(name=="hospital")module="hospital";
		$.ajax({						
			url:module+'/'+funct,
			data:'area='+objarea_id+'&group='+objgroup_id+'&ref1='+objprovince_id+'&ref2='+objamphur_id+'&ref3='+objdistrict_id+'&class=widthselect&default=ทั้งหมด&name='+name,
			success:function(data){$(place).html(data);}
		})
		return false;
	}
$(function(){
	$('#area').click(List("GetGroupByArea","grouplist"))
			  		.change(function(){Clear("all");	List("GetGroupByArea","grouplist");});
					
	$('#group').live('click',function(){List("GetProvinceByGroup","provincelist","province")})
			   		   .change(function(){Clear('group');List("GetProvinceByGroup","provincelist","amphur"); });
					   
	$('#province').live('click',function(){List("getAmphur","amphurlist","amphur")})
				  			.change(function(){Clear('province');List("getAmphur","amphurlist","amphur");});							
	
	$('#amphur').live('click',function(){List("getDistrict","districtlist","district")})
				.change(function(){Clear('amphur');List("getDistrict","districtlist","district");});
							
	$('#district').live('click',function(){List("getHospital","hospitallist","hospital")})
				  .change(function(){Clear('district');List("getHospital","hospitallist","hospital");});							
});
