(function(){
	var login = $(".login");
	var register = $(".register");
	var forgot = $(".forgotPass");
	register.addClass("register-js");
	forgot.addClass("forgotPass-js");
	register.hide();
	forgot.hide();
	$("#r1").click(function(){
		login.fadeOut(500);
		register.fadeIn(500);
	});
	$("#l2").click(function(){
		register.fadeOut(500);
		login.fadeIn(500);
	});
	$("#l3").click(function(){
		forgot.fadeOut(500);
		login.fadeIn(500);
	});
	$("#forgot").click(function(){
		login.fadeOut(500);
		forgot.fadeIn(500);
	});
})();