$(document).ready(function(){
	$('#btn-entry').click(function() {
		$.post(
			"Login", 
			$('#form_login').serialize(), 
			function(data){
				console.log(data);
				if(data.status == 1){
					$('.pn-error').html($(data.msg).first());
					setTimeout(function(){
						window.location.replace('welcome');						
					}, 3000);
				}else{
					$('.pn-error').html($(data.msg).first());
				}
			},
			'json'
		);
	});

	$('#btn-create').click(function() {
		$.post(
			"NewUser", 
			$('#form_new_user').serialize(), 
			function(data){
				console.log(data);
				if(data.status == 1){
					$('.pn-error').html($(data.msg));
					setTimeout(function(){
						window.location.replace('welcome');						
					}, 3000);
				}else{
					$('.pn-error').html($(data));
				}
			},
			'json'
		);
	});
});
