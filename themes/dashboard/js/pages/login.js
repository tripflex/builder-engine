$(document).ready(function() {

	//------------- Login page simple functions -------------//
 	$("html").addClass("loginPage");

 	$("#login").toggle('fast');

 	wrapper = $(".login-wrapper");
 	barBtn = $("#bar .btn");

 	//change the tabs
 	barBtn.click(function() {
	  btnId = $(this).attr('id');
	  wrapper.attr("data-active", btnId);
	  $("#bar").attr("data-active", btnId);
	});

 	//show register tab
	$("#register").click(function() {
	  btnId = "reg";
	  wrapper.attr("data-active", btnId);
	  $("#bar").attr("data-active", btnId);
	});

	//check if user is change remove avatar
	var userField = $("input#user");
	var avatar = $("#avatar>img");

	//if user change email or username change avatar
	userField.change(function() {
        
        $.get("http://" + document.domain + '/index.php/admin/ajax/is_valid_avatar/' + encodeURIComponent($("#user").val()), function (data) {
            if(data == "true")
                avatar.attr('src', '/files/avatars/' +  encodeURIComponent($("#user").val()) +'.jpg')
            else
                avatar.attr('src', '/themes/dashboard/images/avatars/no_avatar.jpg')
        });
        


	});

	//------------- Validation -------------//
    $.validator.addMethod('authenticate', function (value) { 
    $.post("http://" + document.domain + '/index.php/admin/ajax/verify_login/',
    {
    	user: encodeURIComponent($("#user").val()),
    	pass: encodeURIComponent($("#password").val())
    }, function (data) {
        return true;
    });
               
    }, 'Wrong username or password.');
	$("#login-form").validate({ 
		rules: {
			user: {
				required: true,
				minlength: 3
			}, 
			password: {
				required: true,
				minlength: 5
			}
		}, 
		messages: {
			user: {
				required: "Please provide a username",
				minlength: "Username must be at least 3 characters long"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			}
		},
		submitHandler: function(form){
	        var btn = $('#loginBtn');
	        btn.removeClass('btn-primary');
	        btn.addClass('btn-warning');
	        btn.text('Authenticating');
	        btn.attr('disabled', 'disabled');
	        
	        setTimeout(function() {
	            $.post("http://" + document.domain + '/index.php/admin/ajax/verify_login/',
			    {
			    	user: encodeURIComponent($("#user").val()),
			    	pass: encodeURIComponent($("#password").val())
			    }, function (data) {
	                btn.removeClass('btn-warning');

	                if (data == "success") {
	                    btn.addClass('btn-success');
	                    btn.text('Authenticated');
                        setTimeout(function() {
                            window.location.href = "/index.php/admin/main/dashboard";
                        },1500);
	                } else {
	                    btn.addClass('btn-danger');
	                    btn.text('Failed');
                        $("#login-form").validate().showErrors({ 
                            password: "Invalid username or password."
                        });
                        setTimeout(function() {
                            btn.removeAttr('disabled');
                            btn.text('Login');
                            btn.removeClass('btn-danger');
                            btn.addClass('btn-primary');

                        },1500);
	                }
	            });

	        	

	        }, 1500);
	        
		}
	});

});