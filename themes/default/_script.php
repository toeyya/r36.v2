<link rel="stylesheet" type="text/css" href="media/css/bootstrap.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="themes/default/media/css/style.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="themes/default/media/css/merge_style.css" media="screen"/>
<script type="text/javascript" src="media/js/jquery-1.7.2.min.js"></script>
<!--<script type="text/javascript" src="media/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="media/js/jquery.livequery.js" ></script>-->
<script type="text/javascript" src="media/js/bootstrap.js"></script>
<script type="text/javascript" src="media/js/jquery.validate.js"></script>


<script type="text/javascript">
$(document).ready(function(){
		$('#relate-quiz').click(function(){
        var quiz_id = $('input[name=quiz-id]').val();
        $('input[name=webboard_quiz_id]').val(quiz_id);
        $('input[name=webboard_answer_id]').val("0");
    });
   
})
</script>
<!-- รอแก้ jquery version -->
