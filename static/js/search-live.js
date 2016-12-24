function dajRezultate(max)
{
	var query = document.getElementById("query").value;
	if(query != '')
	{	
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '/main/search_ajax/' + max, true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.onload = function () 
		{
			document.getElementById("quickRezultati").innerHTML = "";
		    var results = JSON.parse(this.responseText);
		    results.forEach(function(elem) {
		    	document.getElementById("quickRezultati").innerHTML += '<li><a href="#">&gt; ' + elem.title + '<p style="font-size: 9px;">' + elem.description + '</p></a></li>';
		    });
		};
		xhr.send('query=' + query);
	}
}

document.getElementById("query").addEventListener("input", function() { 
	document.getElementById("suggestionsTitle").innerHTML = "Suggestions";
	dajRezultate(10); 
});
document.getElementById("searchform").addEventListener("submit", function() { 
	event.preventDefault();
	dajRezultate(-1); 
	document.getElementById("suggestionsTitle").innerHTML = "Search results (without limit to 10 results)"
}, false);