function openModal(modal) 
{
	modal.style.display = 'block';
}

function closeModal(modal) 
{
	modal.style.display = 'none';
}

function outsideClick(e) 
{
	let modal = document.querySelectorAll('.modal');
	for (i = 0; i < modal.length; i++)
	{
		if (e.target == modal[i]) 
	  	{
	    	modal[i].style.display = 'none';
	  	}
  	}
}

window.addEventListener('click', outsideClick);