let form = document.querySelector('#form');
let error = document.querySelector('#error');
let success = document.querySelector('#success');

form.addEventListener('submit', function (e){
	
	e.preventDefault();

	let data = new FormData(form);
	let xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function () 
	{
		
		if (this.readyState == 4 && (this.status == 200))
		{
			let postback = this.responseText;

			//alert(postback.length);
			if (postback.length == 6)
			{
				document.location.href = "../index.php";
			}
			else if (postback.length == 3)
			{
				error.innerHTML = "";
				success.innerHTML = "Votre mot de passe a bien été réinitialiser."
				form.reset();
			}
			else
				error.innerHTML = postback;
		}
	};

	xhr.open('POST', form.getAttribute('action'), true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
});