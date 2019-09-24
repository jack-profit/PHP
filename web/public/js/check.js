$(document).ready(function() {

	var nameFlag = true;    // for name
	var emailFlag = true;    // for email
	var pwdFlag = true;   // for pwd

	// methods

	function checkName (){
		$('#username').keyup(function(){
			var length = $(this).val().length;
			if(length >= 2 && length <= 20){
				$.post('web/admin/register.php', {username: $(this).val(), type:'name'}, function(data, textStatus, xhr){
					if(textStatus == 'success'){
						if(data == '1'){ // registered before
							$('#dis_un').text('This username is already registered!');
							nameFlag = false;
						}else{// pass
							$('#dis_un').text('');
							nameFlag = true;
						}
					}
				});
			}else{
				$('#dis_un').text('');
			}
		});
	}

	function checkEmail (){
		$('#remail').blur(function(){
			if($(this).val() != ''){
				var reg = /\w+([-+.]\w+)*@\w+([-.]\w+)*/;
				if(reg.test($(this).val())){
					$.post('web/admin/register.php', {email: $(this).val(), type:'email'}, function(data, textStatus, xhr){
						if(textStatus == 'success'){
							if(data == '1'){ // registered before
								$('#dis_em').text('This E-mail is already registered!');
								emailFlag = false;
							}else{// pass
								$('#dis_em').text('');
								emailFlag = true;
							}
						}
					});
				}else{
					$('#dis_em').text('E-mail format is incorrect');
					emailFlag = false;
				}
			}else{
				$('#dis_em').text('');
			}
		});
	}

	function checkPassword (){
		$('#password').blur(function(){
			if($(this).val() == ''){
				$('#dis_pwd').text('Password cannot be empty');
			}else if($(this).val().length < 6){
				$('#dis_pwd').text('Password must be at least six');
			}else{
				$('#dis_pwd').text('');
			}

			$('#confirm').blur(function(){
				var val = $('#password').val();
				if(val != ''){
					if($(this).val() == ''){
						$('#dis_con_pwd').text('Please confirm your password');
						pwdFlag = false;
					}else if($(this).val() != val){
						$('#dis_con_pwd').text('Confirm password inconsistent');
						pwdFlag = false;
					}else{
						$('#dis_con_pwd').text('');
						pwdFlag = true;
					}
				}else{
					$('#dis_con_pwd').text('');
					pwdFlag = false;
				}
			});
		});
	}

	function checkSubmit (){
		$('#reg').click(function(){
			if(!(nameFlag && emailFlag && pwdFlag)){
				// alert('Please check page info');
				return false;
			}
		});
	}

	checkName ();
	checkEmail ();
	checkPassword ();
	checkSubmit ();
});