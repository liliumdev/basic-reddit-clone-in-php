function provjeriFormu(event)
{
	event.preventDefault();

	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
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


	if(!error)
		document.getElementById("loginform").submit();
}

document.getElementById("loginform").addEventListener("submit", provjeriFormu, false);