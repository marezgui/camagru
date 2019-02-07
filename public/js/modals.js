let body = 	document.getElementsByTagName("body")[0];

function openModal(modal) 
{
	modal.style.display = 'block';
	body.style.overflowY = "hidden";

}

function closeModal(modal) 
{
	modal.style.display = 'none';
	body.style.overflowY = "auto";
}

function outsideClick(e) 
{
	let modal = document.querySelectorAll('.modal');
	for (i = 0; i < modal.length; i++)
	{
		if (e.target == modal[i]) 
	  	{
	    	modal[i].style.display = 'none';
	    	body.style.overflowY = "auto";
	  	}
  	}
}

window.addEventListener('click', outsideClick);