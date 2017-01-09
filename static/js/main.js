// Utility function
function gotClass(elem, className) 
{
    return elem.className.split(' ').indexOf(className) > -1;
}

function vote(what, id, direction, counter)
{
	console.log(counter);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '/vote/' + what + '/' + id + '/' + direction, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function() 
	{
    	counter.innerHTML = this.responseText;
    	console.log(this.responseText);
	};
	xhr.send('');
}

// Dropdown module
var dropdowns = document.querySelectorAll('.dropdown-handler');
for (var i = 0; i < dropdowns.length; i++) 
{
    dropdowns[i].addEventListener('click', function(event) 
    {    	
		event.preventDefault();

		// the dropdown content should be the next sibling
		//dropdowns[i].nextSibling.classList.toggle("visible");
		this.parentElement.nextSibling.nextSibling.classList.toggle("visible");
    });
}

window.onclick = function(e) 
{
	if (!e.target.matches('.dropdown-handler')) 
	{
	    var dropdown_contents = document.getElementsByClassName("dropdown");
	    for (var i = 0; i < dropdown_contents.length; i++) 
	    {
	      if (dropdown_contents[i].classList.contains('visible'))
	        dropdown_contents[i].classList.remove('visible');
	    }
  	}
}


// Lightbox module
document.addEventListener('click', function (e) 
{
    if (gotClass(e.target.parentElement, 'lightbox')) 
    {        
		document.body.innerHTML += '<div class="lightbox-window" id="lightbox-window"><a href="javascript:closeLightbox();" class="close">X</a><img src="' + e.target.parentElement.dataset.full + '"></div>';
    }
}, false);


function closeLightbox()
{
	var lightbox = document.getElementById('lightbox-window');
    lightbox.parentNode.removeChild(lightbox);
}

function check_hotkey(e) 
{
    if (e.keyCode == 27)
    	closeLightbox();
}

document.addEventListener('keyup', check_hotkey, false);

