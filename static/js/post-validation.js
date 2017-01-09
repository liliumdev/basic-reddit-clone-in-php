function provjeriFormu(event)
{
	event.preventDefault();

	var title = document.getElementById("title").value;
	var description = document.getElementById("content").value;
	var error = false;

	var titleRegex = /^[0-9a-zA-Z \.\,\;\-!\?_]+$/;
	if (!titleRegex.test(title)) 
	{
		document.getElementById("title-error").style.display = "block";
		error = true;
	}
	else
		document.getElementById("title-error").style.display = "none";	

	if (!titleRegex.test(description)) 
	{
		document.getElementById("description-error").style.display = "block";
		error = true;
	}
	else
		document.getElementById("description-error").style.display = "none";	
	

	if(!error)
		document.getElementById("registerform").submit();
}

document.getElementById("registerform").addEventListener("submit", provjeriFormu, false);