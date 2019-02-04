let backdrop = document.querySelector('.backdrop');

function openModal(modal)
{
	backdrop.style.display = 'block';
	modal.style.display = 'block';
}

function closeModal(modal)
{
	backdrop.style.display = 'none';
	for (i = 0; i < modal.length; i++)
	{
		modal[i].style.display = 'none';
	}
}

/*
function addModalContent(modalName, modalContent) 
{
	let modal = document.getElementById(modalName + "-modal");
	let modalBody = document.querySelectorAll("#" + modalName + "-modal .modal-body")[0];
	modalBody.innerHTML = modalContent;
}*/