function provjeriFormu(event)
{
	event.preventDefault();

	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var password2 = document.getElementById("password2").value;
	var email = document.getElementById("email").value;
	var error = false;

	var usernameRegex = /[a-zA-Z0-9-_]{4}[a-zA-Z0-9]*/;
	if (!usernameRegex.test(username)) 
	{
		document.getElementById("username-error").style.display = "block";
		error = true;
	}
	else
		document.getElementById("username-error").style.display = "none";	

	if (password.length < 8) 
	{
		document.getElementById("password-error").style.display = "block";
		error = true;
	}
	else
		document.getElementById("password-error").style.display = "none";		


	if (password != password2)
	{
		document.getElementById("password-unmatch-error").style.display = "block";
		error = true;
	}
	else
		document.getElementById("password-unmatch-error").style.display = "none";		

	var emailRegex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	if (!emailRegex.test(email)) 
	{
		document.getElementById("email-error").style.display = "block";
		error = true;
	}
	else
		document.getElementById("email-error").style.display = "none";	

	if(!error)
		document.getElementById("registerform").submit();
}

document.getElementById("registerform").addEventListener("submit", provjeriFormu, false);