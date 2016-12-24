function load_tab(file) 
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
		if(this.readyState == 4 && this.status == 200) {
			document.getElementById("mainContent").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", file, true);
	xhttp.send();
}

document.addEventListener('click', function (e) 
{
    if (gotClass(e.target, 'ajax-tab')) 
    {        
    	var allTabs = document.querySelectorAll('.ajax-tab');
		for (var i = 0; i < allTabs.length; i++) 
		{
			if (allTabs[i].parentElement.classList.contains('active'))
	        	allTabs[i].parentElement.classList.remove('active');
		}

		e.target.parentElement.classList.add('active');
		load_tab(e.target.dataset.file);
    }
}, false);
